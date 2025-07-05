<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    $(document).ready(() => {

        $("#form2btn").trigger('click')
        $(document).ajaxStop(function() {
            $('#loading-indicator').hide();
            $('#rawat_inap_show').fadeIn(200);
        });
        setTimeout(function() {
            $('#loading-indicator').hide();
            $('#rawat_inap_show').fadeIn(200);
        }, 3000);

    })
</script>
<script type="text/javascript">
    var tableRanap = $("#tableSearchRanap").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
        responsive: true
    })
    var tableKetersediaanTT = $("#ketersediaanTT").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
        "pageLength": 50,
        responsive: true
    })
    var classRoomArray = [];
    var bedArray = [];
    var jsonBed;
    var sAkom;
    var caraKeluar;
    var is_keluar_id;
    var userRoles = <?= json_encode(user()->getRoles()); ?>;

    const quillEditor = document.querySelectorAll('.quill-editor-raber');

    quillEditor.forEach(function(editor, index) {
        new Quill(editor, {
            theme: 'snow',
        });
    });
    flatpickr('.dateflatpickr-ranap', {
        dateFormat: 'Y-m-d h:i',
        defaultDate: moment().format('YYYY-MM-DD HH:mm'),
        enableTime: true,
        time_24hr: true,
        onChange: function(selectedDates, dateStr, instance) {
            console.log(selectedDates);
        }
    });
    $('#historyCpptList').on('shown.bs.modal', function() {
        if (is_keluar_id != 0) {
            $('#btnRaberModal').hide();
        } else {
            $('#btnRaberModal').show();
        }
    });

    $('#btnRaberModal').off().on('click', function(e) {
        $("#inputRaberRanapForm").attr("hidden", true)
        $("#show-slideRaberRanap").attr("hidden", true)
        $("#show-slideRaberRanap1").attr("hidden", false)

        $("#btn-save-raber").attr("hidden", true)
        let visit_id = $(this).attr('visit_id');
        let employee_id = <?= json_encode(user()->employee_id); ?>;
        postData({
            employee_id: employee_id,
            visit_id: visit_id
        }, 'admin/PasienKonsulan/getData', (res) => {
            if (res.respon) {
                if (res?.data.length > 0) {
                    let resultData = ""
                    res?.data.map((e, index) => {

                        const status = e?.isfinish === 1 || e?.isfinish === "1";
                        const btnClass = status ? 'btn-outline-danger' : 'btn-outline-success';
                        const btnIcon = status ? 'fa-clock' : 'fa-check';
                        const btnText = status ? 'Batal' : 'Selesai';
                        const statusText = status ? 'Selesai' : 'On Going';

                        resultData += `<tr data-index="${index}">
                                        <td>${index+1}</td>
                                        <td>${e?.document_date ?moment(e?.document_date).format("DD/MM/YYYY HH:mm") : ""}</td>
                                        <td>${e?.consul_type === 1 ? "Konsulan" : 
                                            e?.consul_type === 2 ? "Rawat Bersama" : 
                                            e?.consul_type === 3 ? "Rawat Alih" : ""}
                                        </td>
                                        <td>${e?.doctor}</td>
                                        <td>${e?.doctor_to}</td>
                                         <td class="status-text">${statusText}</td>
                                        <td>
                                                 <button type="button" class="btn btn-warning btn-show-render-raber" autocomplete="off"
                                                     data-body_id="${e.body_id}" data-index="${index}"><i
                                                        class="fa fa-edit">Check</i></button>
                                                  <button type="button"
                                                        class="btn ${btnClass} btn-action-status-raber"
                                                        data-body_id="${e.body_id}"
                                                        data-visit_id="${e.visit_id}"
                                                        data-index="${index}"
                                                        data-status="${status}">
                                                        <i class="fa ${btnIcon} me-1"></i> ${btnText}
                                                    </button>


                                                <button type="button" class="btn btn-danger btn-delete-raber" data-body_id="${e.body_id}"
                                                    autocomplete="off"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`
                    })

                    $("#history-inraberRanap").html(resultData)
                    deleteRaber()

                    $(document).off().on('click', '.btn-action-status-raber',
                        function() {
                            const $btn = $(this);
                            const body_id = $btn.data('body_id');
                            const visit_id = $btn.data('visit_id');
                            const index = $btn.data('index');

                            let currentStatus = $btn.attr('data-status') === 'true';
                            currentStatus = !currentStatus;

                            const isfinish = currentStatus ? 1 : 0;
                            const btnClass = currentStatus ? 'btn-outline-danger' :
                                'btn-outline-success';
                            const btnIcon = currentStatus ? 'fa-clock' : 'fa-check';
                            const btnText = currentStatus ? 'Batal' : 'Selesai';
                            const statusText = currentStatus ? 'Selesai' : 'On Going';

                            $btn.attr('data-status', currentStatus);
                            $btn.removeClass('btn-outline-success btn-outline-danger').addClass(
                                btnClass);
                            $btn.html(`<i class="fa ${btnIcon} me-1"></i> ${btnText}`);

                            $(`tr[data-index="${index}"] .status-text`).text(statusText);

                            postData({
                                visit_id: visit_id,
                                body_id: body_id,
                                isfinish: isfinish
                            }, 'admin/PasienKonsulan/editStatus', (res) => {
                                if (!res.respon) {
                                    alert("Gagal update status");
                                }
                            });
                        });





                    $('.btn-show-render-raber').on('click', function(e) {
                        $("#show-slideRaberRanap").attr("hidden", false)
                        $("#inputRaberRanapForm").attr("hidden", false)
                        $("#show-slideRaberRanap1").attr("hidden", true)
                        $("#btn-save-raber").attr("hidden", false)
                        let index = $(this).data('index');
                        let item = res?.data[index];

                        console.log(res
                            ?.data);
                        console.log(item);


                        removeAttrDisabledAndReset();
                        $('#right_col_raber').removeAttr('hidden');

                        $('#select_doctor_to').val(item.employee_id_to)
                        $('#select_consul_type').val(item.consul_type)
                        $('#consultation_date_raber').val(item.document_date)
                        $('#consultation_desc_raber').val(item.description)

                        $('#response_date_raber').val(item.respon_date)
                        $('#response_desc_raber').val(item.description_to)

                        $('#raber_doctor').val(item?.doctor);
                        $('#raber_employee_id').val(item?.employee_id);
                        $('#raber_specialist_type_id').val(item.specialist_type_id);
                        $('#raber_body_id').val(item?.body_id);
                        addSignUser("formRaberRanap", "", "raber_body_id", "btn-save-raber", 22, 1,
                            1,
                            "Raber", "valid_user")
                        addSignUser("formRaberRanap", "", "raber_body_id", "btn-save-raber", 22, 1,
                            2,
                            "Raber", "valid_user_to")
                        initializeSpecialistType('select_department_ranap', 'raberModal', res
                            ?.data
                            .specialist_type_id_to)
                        if (item.employee_id == '41') {
                            $('#response_date_raber').attr('disabled', true)
                            $('#response_desc_raber').attr('disabled', true)
                            $('#btn-save-raber').attr('hidden', item.respon_date);
                            $('#btn-cancel-raber').attr('hidden', item.respon_date);
                        }
                        if (res.data.employee_id_to == '41') {
                            $('#select_doctor_to').attr('disabled', true)
                            $('#select_department_ranap').attr('disabled', true)
                            $('#select_consul_type').attr('disabled', true)
                            $('#consultation_date_raber').attr('disabled', true)
                            $('#consultation_desc_raber').attr('disabled', true)
                        }


                    })
                }
            }
        });
    })

    const deleteRaber = () => {
        $('.btn-delete-raber').off().on('click', function(e) {
            let body_id = $(this).data("body_id"); // Ambil body_id dari tombol
            console.log("Body ID:", body_id);


            const id = body_id;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success ms-2",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Apa anda yakin?",
                text: "Anda tidak akan dapat mengembalikannya!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    postData({
                        body_id: id
                    }, 'admin/PasienKonsulan/delete', (res) => {

                        if (res.respon) {
                            successSwal(res.message)
                            $("#formRaberRanap")[0].reset()
                            $("#raberModal").modal("hide")
                        } else {
                            errorSwal(res.message)
                        }

                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Dibatalkan",
                        text: "File Anda aman :)",
                        icon: "error"
                    });
                }
            });
        })
    }


    $("#show-slideRaberRanap1").off().on("click", function() {

        $("#show-slideRaberRanap").attr("hidden", false)
        $("#inputRaberRanapForm").attr("hidden", false)
        $("#show-slideRaberRanap1").attr("hidden", true)
        $("#btn-save-raber").attr("hidden", false)

        removeAttrDisabledAndReset()
        $('#btn-cancel-raber').attr('hidden', true);
        $('#right_col_raber').attr('hidden', true);
        $('#raber_doctor').val('<?= user()->fullname ?>');
        $('#raber_employee_id').val('<?= user()->employee_id ?>');
        $('#raber_specialist_type_id').val("");
        $('#raber_body_id').val(get_bodyid());



        initializeSpecialistType('select_department_ranap', 'raberModal')

        addSignUser("formRaberRanap", "", "raber_body_id", "btn-save-raber", 22, 1,
            1,
            "Raber", "valid_user")
    })

    $("#show-slideRaberRanap").off().on("click", function() {
        $("#show-slideRaberRanap1").attr("hidden", false)
        $("#inputRaberRanapForm").attr("hidden", true)
        $("#show-slideRaberRanap").attr("hidden", true)
        $("#btn-save-raber").attr("hidden", true)
    })

    $("#formsignarmraber").off().on("click", function() {

    })

    function removeAttrDisabledAndReset() {
        $('#select_doctor_to').removeAttr('disabled')
        $('#select_department_ranap').removeAttr('disabled')
        $('#select_consul_type').removeAttr('disabled')
        $('#consultation_date_raber').removeAttr('disabled')
        $('#consultation_desc_raber').removeAttr('disabled')
        $('#response_date_raber').removeAttr('disabled')
        $('#response_desc_raber').removeAttr('disabled')

        $('#formRaberRanap').trigger('reset')
    }

    function initializeSpecialistType(theid, modalParent, data = null) {
        let initialvalue = data;
        postData({

        }, 'admin/PasienKonsulan/getSpecialistType', (result) => {
            $("#" + theid).select2({
                theme: "bootstrap-5",
                // tags: true,
                dropdownParent: '#' + modalParent,
                placeholder: "Pilih Departement",
                allowClear: false,
                data: result?.data
            });

            if (initialvalue != null) {
                $("#" + theid).val(initialvalue).trigger('change');
            }

        });

    }


    $('#btn-save-raber').off().on('click', function(e) {
        let formData = document.querySelector('#formRaberRanap');
        let dataSend = new FormData(formData);
        let jsonObj = {};

        dataSend.forEach((value, key) => {
            jsonObj[key] = value;
        });
        let selectedDoctorTo = $('#select_doctor_to option:selected').text();
        jsonObj['doctor_to'] = selectedDoctorTo;

        postData(jsonObj, 'admin/PasienKonsulan/insert', (res) => {

            if (res.respon) {
                successSwal(res.message)
                // $("#formRaberRanap")[0].reset()
                $("#raberModal").modal("hide")
            }
        });

    })

    $("#form2").on('submit', (function(e) {

        e.preventDefault();
        is_keluar_id = new FormData(this).getAll('keluar_id')[0];
        $("#form2btn").html('<i class="spinner-border spinner-border-sm"></i>')
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getipddatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                tableRanap.clear().draw()
                data.data.forEach((element, key) => {
                    let consul_type = element[10];
                    let color = '';
                    if (consul_type === 1) {
                        element[10] =
                            '<i class="fas fa-user-md" style="font-size: 20px !important;"></i> <p style="font-size: 10px !important" class="fw-bold mb-0">KONSULAN</p>';
                        color = '#fff3cd';
                    } else if (consul_type === 2) {
                        element[10] =
                            '<i class="fas fa-people-carry" styl="font-size: 20px !important;"></i> <p style="font-size: 10px !important" class="fw-bold mb-0">RAWAT BERSAMA</p>';
                        color = '#d1e6dd';
                    } else if (consul_type === 3) {
                        element[10] =
                            '<i class="fas fa-people-arrows" sty="font-size: 20px !important;"></i> <p style="font-size: 10px !important" class="fw-bold mb-0">RAWAT ALIH</p>';
                        color = '#cfe2ff';
                    } else {
                        element[10] = '-';
                    }
                    // stringcolumn += '<tr class="table tablecustom-light">';
                    // element.forEach((element1, key1) => {
                    //     stringcolumn += "<td>" + element1 + "</td>";
                    // });
                    // stringcolumn += '</tr>'

                    let rowNode = tableRanap.row.add(element).draw().node();
                    if (consul_type) {
                        rowNode.style.backgroundColor = color;
                    }
                });
                tableRanap.columns.adjust().responsive.recalc();
                $("#form2btn").html('<i class="fa fa-search"></i> Cari')
            },
            error: function() {

            }
        });

    }));
    $("#formAkomodasiView").on('submit', (function(e) {

        e.preventDefault();
        $("#formAkomodasiViewBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/saveAkomodasi',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == 200) {
                    successSwal(data.metadata.message)
                    if (data.response.lastkeluar == 32) {
                        nextFormRanap()
                        $("#addRanapModal").css("z-index", 2000)
                    }
                } else {
                    errorSwal(data.metadata.message)
                }
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
                $("#formAkomodasiViewBtn").slideUp()
                disableElementTA()
            },
            error: function() {
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
            }
        });

    }));

    function addRanap(id) {
        holdModal('historyRajalModal')
        getHistoryRajalPasien(id)
    }

    function enableElementTA(key) {
        $("#tatreat_date" + key).removeAttr("readonly")
        $("#taexit_date" + key).removeAttr("readonly")
        $("#taquantity" + key).removeAttr("readonly")
        $("#takeluar_id" + key).off('mousedown')
        $("#formAkomodasiViewBtn").slideDown()
    }

    function disableElementTA(key) {
        $('[id^="tatreat_date"]').prop("readonly", true)
        $('[id^="taexit_date"]').prop("readonly", true)
        $('[id^="taquantity"]').prop("readonly", true)
        $('[id^="takeluar_id"]').on('mousedown', function() {
            return false;
        })
    }

    function getAkomodasi(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSinglePV',
            type: "POST",
            data: JSON.stringify({
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data) {
                    skunj = data

                    $("#taidentity").html(skunj.diantar_oleh + '(' + skunj.no_registration + ')')
                    $("#tabiodatatapasien_id").html(skunj.pasien_id)
                    $("#tabiodatatacoverages").html(skunj.coverage_id)
                    $("#tabiodatataaddress").html(skunj.visitor_address)
                    $("#tabiodatatagender").html(skunj.gender)
                    $("#tabiodatataclass_id_plafond").html(skunj.class_id_plafond)
                    $("#tabiodatataage").html(skunj.ageyear + "th " + skunj.agemonth + "bl " + skunj.ageday +
                        "hr")
                    $("#tabiodatatastatus").html(skunj.status_pasien_id)
                    $("#tabiodatatapayor").html(skunj.payor_id)



                    $("#tanorujukan").val(data.norujukan)
                    $("#takdpoli").val(data.kdpoli)
                    $("#tatanggal_rujukan").val((String)(data.tanggal_rujukan).slice(0, 10))
                    $("#tappkrujukan").val(data.ppkrujukan)
                    $("#tadiag_awal").html("")
                    $("#tadiag_awal").append(new Option(data.conclusion, data.diag_awal))
                    $("#taconclusion").val(data.conclusion)
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/rawatinap/getAkomodasi',
                        type: "POST",
                        data: JSON.stringify({
                            'visit': skunj.visit_id,
                            'nomor': skunj.no_registration
                        }),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (typeof data.cara_keluar !== 'undefined') {
                                caraKeluar = data.cara_keluar
                            }
                            if (typeof data.data[0] !== 'undefined') {

                                $("#iidentity").html(skunj.diantar_oleh + " (" + skunj
                                    .no_registration + ")")
                                $("#biodatatapasien_id").html(skunj.pasien_id)
                                coverage.forEach((element, index) => {
                                    if (index == skunj.coverage_id) {
                                        $("#biodatatacoverages").html(element);
                                    }
                                });
                                $("#biodatataaddress").html(skunj.visitor_address)
                                $("#biodatatagender").html(skunj.gender)
                                kelas.forEach(value => {
                                    if (value[0] == skunj.class_id_plafond) {
                                        $("#biodatataclass_id_plafond").html(value[1]);
                                    }
                                });
                                $("#biodatataage").val(skunj.ageyear + "th " + skunj.agemonth +
                                    "bl " + skunj.ageday + "hr")
                                statusPasien.forEach(value => {
                                    if (value[0] == skunj.status_pasien_id) {
                                        $("#biodatatastatus").html(value[1]);
                                    }
                                });
                                payor.forEach(payorvalue => {
                                    if (payorvalue[1] == skunj.payor_id) {
                                        $("#biodatatapayor").html(payorvalue[3]);
                                    }
                                });

                                $("#taasalrujukan").val(skunj.asalrujukan)
                                $("#tanorujukan").val(skunj.norujukan)
                                $("#taspecimenno").val(skunj.specimenno)
                                $("#tano_skp").val(skunj.no_skp)
                                $("#tano_skpinap").val(skunj.no_skpinap)

                                $("#tatujuankunj").val(skunj.tujuankunj)
                                $("#takdpenunjang").val(skunj.kdpenunjang)
                                $("#taflagprocedure").val(skunj.flagprocedure)
                                $("#taassesmentpel").val(skunj.assesmentpel)


                                $("#akomodasiView").modal('show')
                                sAkom = data.data
                                $("#akomodasiViewTableBody").html("")
                                sAkom.forEach((element, key) => {
                                    $("#akomodasiViewTableBody").append($("<tr id='" +
                                            element.bill_id + "'>")
                                        .append(
                                            '<input name="bill_id[]" type="hidden" value="' +
                                            element.bill_id + '">')
                                        .append('<input id="tatagihan' + key +
                                            '" name="tagihan[]" type="hidden" value="' +
                                            element.tagihan + '">')
                                        .append($("<td>").append(key + 1))
                                        .append($("<td>").append(element.name_of_class +
                                            "<br>" + element.fullname + "<br>" +
                                            element.bed_id))
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append(
                                                    '<input name="treat_date[]" class="form-control" type="datetime-local" value="' +
                                                    element.treat_date +
                                                    '" id="tatreat_date' + key +
                                                    '" onchange="changeTreatDateTA(' +
                                                    key + ')" readonly>')
                                            )
                                        )
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append(
                                                    '<input name="exit_date[]" class="form-control" type="datetime-local" value="' +
                                                    element.exit_date +
                                                    '" id="taexit_date' + key +
                                                    '" onchange="changeExitDateTA(' +
                                                    key + ')" readonly>')
                                            )
                                        )
                                        .append($("<td>").append(
                                            '<input id="taquantity' + key +
                                            '" name="quantity[]" class="form-control" type="text" value="' +
                                            parseFloat(element.quantity) +
                                            '" onchange="changeQuantityTA(' + key +
                                            ')" readonly/>'))
                                        .append($("<td>").append(
                                            '<select name="keluar_id[]" id="takeluar_id' +
                                            key +
                                            '" class="form-control" onchange="changeCaraKeluarTA(' +
                                            key + ')"></select>'))
                                        .append($("<td>").append(element.tarif_name))
                                        .append($("<td>").append(
                                            '<input id="tasell_price' + key +
                                            '" name="sell_price[]" class="form-control" type="text" value="' +
                                            parseFloat(element.sell_price) +
                                            '" readonly/>'))
                                        .append($("<td>").append(
                                            '<input id="taamount_paid' + key +
                                            '" name="amount_paid[]" class="form-control" type="text" value="' +
                                            parseFloat(element.amount_paid) +
                                            '" readonly/>'))
                                    )
                                    if (key + 1 == sAkom.length) {
                                        $("#" + element.bill_id).append($(
                                                '<td id="btnTdAkom"' + key + '>')
                                            .append($(
                                                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">'
                                                )
                                                .append($(
                                                    '<button type="button" class="btn btn-primary" onclick="enableElementTA(' +
                                                    key + ')">').append(
                                                    '<i class="fa fa-edit"></i>'))
                                                .append($(
                                                    '<button id="delBtnAkomodasi' +
                                                    key +
                                                    '" type="button" class="btn btn-danger" onclick="deleteAkomodasi(\'' +
                                                    element.bill_id + '\',' + key +
                                                    ')">').append(
                                                    '<i class="fa fa-trash"></i>'))
                                            )
                                        )

                                    } else {
                                        $("#" + element.bill_id).append($("<td>"))
                                    }
                                    caraKeluar.forEach((elementKel, keyKel) => {
                                        $("#takeluar_id" + key).append(
                                            '<option value="' + elementKel
                                            .keluar_id + '">' + elementKel
                                            .cara_keluar + '</option>')
                                    })
                                    $("#takeluar_id" + key).val(element.keluar_id)
                                    $("#takeluar_id" + key).on('mousedown', function() {
                                        return false;
                                    })
                                    $("#taquantity" + key).keydown(function(e) {
                                        !0 == e.shiftKey && e.preventDefault(), e
                                            .keyCode >= 48 && e.keyCode <= 57 || e
                                            .keyCode >= 96 && e.keyCode <= 105 ||
                                            8 == e.keyCode || 9 == e.keyCode ||
                                            37 == e.keyCode || 39 == e.keyCode ||
                                            46 == e.keyCode || 190 == e.keyCode || e
                                            .preventDefault(), -1 !== $(this).val()
                                            .indexOf(".") && 190 == e.keyCode && e
                                            .preventDefault()
                                    });
                                });
                            } else {
                                nextFormRanap()
                            }
                            $("#saveAddAkomodasi").html(
                                    'Simpan <i class=" fas fa-check-circle"></i>')
                                .prop("disabled", false)
                        },
                        error: function() {
                            $("#saveAddAkomodasi").html(
                                    'Simpan <i class=" fas fa-check-circle"></i>')
                                .prop("disabled", false)
                        }
                    });
                    getRujukanInap()
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").slideUp();
                }
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }

    function nextFormRanap() {
        holdModal('addRanapModal')
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var hours = ('0' + currentDate.getHours()).slice(-2);
        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
        var seconds = ('0' + currentDate.getSeconds()).slice(-2);
        var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

        var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;

        $("#aritreat_date").val(isoDatetime);
        $("#historyRajalModal").modal('hide')
        $("#ariemployee_id").val(skunj.employee_id)
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getBangsalInfo',
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                tableKetersediaanTT.clear()
                if (data) {
                    console.log(data)
                    classRoomArray = data.classRoom
                    data.data.forEach((element, key) => {
                        tableKetersediaanTT.row.add(element).draw()
                    });
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").slideUp();
                }
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getBedInfo',
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                bedArray = data

                changeClinicInap($("#ariclinic_id").val())
                changeClassRoomTA($("#ariclass_room_id").val())
            },
            error: function() {
                $("#loadingHistoryrajal").html('<i class="fa fa-search"></i>')
            }
        });
    }

    function pilihBed(id) {
        jsonBed = JSON.parse($("#" + id).html())
        var clinicId = jsonBed.clinic_id
        $("#ariclinic_id").val(jsonBed.clinic_id)
        $("#ariclass_room_id").html("")
        $("#aribed_id").html("")
        $("#ariamount_paid").val(0)
        $("#aritarif_name").val("")
        $("#aritarif_id").val("")
        classRoomArray.forEach((element, key) => {
            if (element.class_room_id == jsonBed.class_room_id) {
                $("#ariclass_room_id").append('<option value="' + element.class_room_id + '">' + element
                    .classroomname + '</option>')
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
                $("#ariclass_id").val(element.class_id)
            }
        });
        bedArray.forEach((element, key) => {
            if (element.class_room_id == jsonBed.class_room_id) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })


        $("#ariclinic_idalert").slideUp()
        $("#ariclass_room_idalert").slideUp()
        $("#aribed_idalert").slideUp()
    }

    function changeClinicInap(id) {
        $("#ariclass_room_id").html("")
        $("#aribed_id").html("")
        $("#ariamount_paid").val(0)
        $("#aritarif_name").val("")
        $("#aritarif_id").val("")
        console.log(id)
        classRoomArray.forEach((element, key) => {
            if (element.clinic_id == id) {
                $("#ariclass_room_id").append('<option value="' + element.class_room_id + '">' + element
                    .classroomname + '</option>')
            }
        });
        bedArray.forEach((element, key) => {
            if (element.class_room_id == $("#ariclass_room_id").val()) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })
        classRoomArray.forEach((element, key) => {
            if (element.class_room_id == $("#ariclass_room_id").val()) {
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
            }
        });
    }

    function changeClassRoomTA(id) {
        $("#aribed_id").html("")
        console.log(id)

        bedArray.forEach((element, key) => {
            if (element.class_room_id == id) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })
        classRoomArray.forEach((element, key) => {
            if (element.class_room_id == id) {
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
            }
        });
    }

    function changeCaraKeluarTA(id) {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var hours = ('0' + currentDate.getHours()).slice(-2);
        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
        var seconds = ('0' + currentDate.getSeconds()).slice(-2);
        var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

        var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;

        $("#taexit_date" + id).val(isoDatetime);
        var start = new Date($("#tatreat_date" + id).val())
        var end = new Date($("#taexit_date" + id).val())
        var daydiff = datediff(start, end)
        if (daydiff == 0) {
            daydiff = 1
        }
        $("#taquantity" + id).val(daydiff)
        changeQuantityTA(id)

    }

    function changeExitDateTA(id) {
        var start = new Date($("#tatreat_date" + id).val())
        var end = new Date($("#taexit_date" + id).val())
        var now = new Date()
        var daydiff = datediff(start, end)
        if (daydiff < 0) {
            alert("Tanggal Keluar harus lebih besar dari tanggal masuk")
            $("#taexit_date" + id).val($("#tatreat_date" + id).val())
            daydiff = 1
            $("#taquantity" + id).val(daydiff)
            changeQuantityTA(id)
        } else {
            if (daydiff == 0) {
                daydiff = 1
            }
            $("#taquantity" + id).val(daydiff)
            changeQuantityTA(id)
        }
        var daydiffnow = datediff(end, now)
        if (daydiffnow < 0) {
            alert("Tanggal keluar harus lebih kecil dari hari, jam, dan menit sekarang")
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var hours = ('0' + currentDate.getHours()).slice(-2);
            var minutes = ('0' + currentDate.getMinutes()).slice(-2);
            var seconds = ('0' + currentDate.getSeconds()).slice(-2);
            var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

            var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $("#taexit_date" + id).val(isoDatetime)
            end = new Date($("#taexit_date" + id).val())
            daydiff = datediff(start, end)
            if (daydiff == 0) {
                daydiff = 1
            }
            $("#taquantity" + id).val(daydiff)
            changeQuantityTA(id)
        }
    }

    function changeTreatDateTA(id) {
        if (id > 1) {
            var idEnd = id - 1
            var start = new Date($("#tatreat_date" + id).val())
            var end = new Date($("#taexit_date" + idEnd).val())
            var daydiffBefore = datediff(start, end)
            if (daydiffBefore > 0) {
                alert('Tanggal masuk RI harus lebih besar dari tanggal keluar pada kamar sebelumnya')
                $("#tatreat_date" + id).val($("#taexit_date" + idEnd).val())
            } else {
                var visitDate = new Date(skunj.visit_date)
                var daydiffrajal = datediff(visitDate, start)
                if (daydiffrajal >= 0) {
                    var now = new Date()
                    var daydiffnow = datediff(start, now)
                    if (daydiffnow < 0) {
                        alert("Tanggal masuk harus lebih kecil dari hari, jam, dan menit sekarang")
                        var currentDate = new Date();
                        var year = currentDate.getFullYear();
                        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                        var day = ('0' + currentDate.getDate()).slice(-2);
                        var hours = ('0' + currentDate.getHours()).slice(-2);
                        var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                        var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                        var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

                        var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
                        $("#tatreat_date" + id).val(isoDatetime)
                        start = new Date($("#tatreat_date" + id).val())
                        daydiff = datediff(start, end)
                        if (daydiff == 0) {
                            daydiff = 1
                        }
                        $("#taquantity" + id).val(daydiff)
                        changeQuantityTA(id)
                    }
                    var end = new Date($("#taexit_date" + id).val())
                    var daydiff = datediff(start, end)
                    if (daydiff >= 0) {
                        if (daydiff == 0) {
                            daydiff = 1
                        }
                        $("#taquantity" + id).val(daydiff)
                    } else {
                        alert('Tanggal keluar rawat inap harus lebih besar dari tanggal masuk')
                        $("#taexit_date" + id).val($("#tatreat_date" + id).val())
                        $("#taquantity" + id).val(1)
                        changeQuantityTA(id)
                    }

                } else {
                    alert('Tanggal dan jam masuk harus lebih besar dari tanggal dan jam kunjungan rawat jalannya.')
                    var currentDate = new Date(visitDate);
                    var year = currentDate.getFullYear();
                    var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                    var day = ('0' + currentDate.getDate()).slice(-2);
                    var hours = ('0' + currentDate.getHours()).slice(-2);
                    var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                    var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                    var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

                    var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
                    $("#tatreat_date" + id).val(isoDatetime)
                }
            }
        }

        if (daydiff <= 0) {
            daydiff = 1
        }
        $("#taquantity" + id).val(daydiff)
        changeQuantityTA(id)
    }

    function changeQuantityTA(id) {
        var quantity = $("#taquantity" + id).val()
        var sell_price = $("#tasell_price" + id).val()

        var tagihan = quantity * sell_price
        $("#tatagihan" + id).val(tagihan)
        $("#taamount_paid" + id).val(tagihan)
    }

    function changeAriTreatDate() {
        var start = new Date($("#aritreat_date").val())
        var visitDate = new Date(skunj.visit_date)
        var daydiffrajal = datediff(visitDate, start)
        if (daydiffrajal < 0) {
            alert('Tanggal dan jam masuk harus lebih besar dari tanggal dan jam kunjungan rawat jalannya.')
            var currentDate = new Date(visitDate);
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var hours = ('0' + currentDate.getHours()).slice(-2);
            var minutes = ('0' + currentDate.getMinutes()).slice(-2);
            var seconds = ('0' + currentDate.getSeconds()).slice(-2);
            var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

            var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
            $("#aritreat_date").val(isoDatetime)
        }
        if (sAkom.length > 1) {
            var idLast = sAkom.length - 1
            var endLast = new Date($("#taexit_date" + idLast).val())
            var daydiff = datediff(endLast, start)
            if (daydiff < 0) {
                alert('Tanggal awal rawat inap tidak boleh lebih kecil dari tanggal rawat bangsal terakhir')
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                var day = ('0' + currentDate.getDate()).slice(-2);
                var hours = ('0' + currentDate.getHours()).slice(-2);
                var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                var milliseconds = ('00' + currentDate.getMilliseconds()).slice(-3);

                var isoDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
                $("#aritreat_date").val(isoDatetime)
            }
        }
    }


    //form tambah akomodasi yang ada list bangsalnya
    function saveAddAkomodasi() {
        $("#saveAddAkomodasi").html('<i class="spinner-border spinner-border-sm"></i>')
        $("#saveAddAkomodasi").prop("disabled", true)
        var ariclinic_id = $("#ariclinic_id").val()
        var ariclass_room_id = $("#ariclass_room_id").val()
        var aribed_id = $("#aribed_id").val()

        if (typeof ariclinic_id === 'undefined' || ariclinic_id == null) {
            $("#ariclinic_idalert").slideDown()
            $("#ariclass_room_idalert").slideUp()
            $("#aribed_idalert").slideUp()
        } else if (typeof ariclass_room_id === 'undefined' || ariclass_room_id == null) {
            $("#ariclinic_idalert").slideUp()
            $("#ariclass_room_idalert").slideDown()
            $("#aribed_idalert").slideUp()
        } else if (typeof aribed_id === 'undefined' || aribed_id == null) {
            $("#ariclinic_idalert").slideUp()
            $("#ariclass_room_idalert").slideUp()
            $("#aribed_idalert").slideDown()
        } else {
            $("#ariclinic_idalert").slideUp()
            $("#ariclass_room_idalert").slideUp()
            $("#aribed_idalert").slideUp()

            $.ajax({
                url: '<?php echo base_url(); ?>admin/rawatinap/postAddAkomodasi',
                type: "POST",
                data: JSON.stringify({
                    'class_room_id': $("#ariclass_room_id").val(),
                    'treat_date': $("#aritreat_date").val(),
                    'exit_date': $("#aritreat_date").val(),
                    'quantity': 1,
                    'measure_id': null,
                    'amount': $("#ariamount_paid").val(),
                    'amount_paid': $("#ariamount_paid").val(),
                    'payment_date': null,
                    'islunas': 0,
                    'modified_from': 'P000',
                    'iscetak': 0,
                    'print_date': null,
                    'employee_id': $("#ariemployee_id").val(),
                    'doctor': $("#ariemployee_id option:selected").text(),
                    'employee_id_from': skunj.employee_id,
                    'doctor_from': skunj.fullname,
                    'visit_id': skunj.visit_id,
                    'no_registration': skunj.no_registration,
                    'bill_id': null,
                    'subsidi': 0,
                    'org_unit_code': skunj.org_unit_code,
                    'clinic_id': $("#ariclinic_id").val(),
                    'treatment': $("#aritarif_name").val(),
                    'description': $("#ariclass_room_id option:selected").text(),
                    'tarif_id': $("#aritarif_id").val(),
                    'bed_id': $("#aribed_id").val(),
                    'keluar_id': 0,
                    'nota_no': null,
                    'clinic_id_from': skunj.clinic_id,
                    'sold_status': null,
                    'status_pasien_id': skunj.status_pasien_id,
                    'thename': skunj.diantar_oleh,
                    'theaddress': skunj.visitor_address,
                    'theid': skunj.pasien_id,
                    'class_id': $("#ariclass_id").val(),
                    'class_id_plafond': skunj.class_id_plafond,
                    'amount_plafond': 0,
                    'treatment_plafond': '',
                    'amount_paid_plafond': 0,
                    'pembulatan': 0,
                    'isrj': 0,
                    'payor_id': skunj.payor_id,
                    'ageyear': skunj.ageyear,
                    'agemonth': skunj.agemonth,
                    'ageday': skunj.ageday,
                    'gender': skunj.gender,
                    'kal_id': skunj.kal_id,
                    'discount': 0,
                    'karyawan': skunj.karyawan,
                    'account_id': skunj.account_id,
                    'sell_price': $("#ariamount_paid").val(),
                    'diskon': 0,
                    'invoice_id': null,
                    'tagihan': $("#ariamount_paid").val(),
                    'koreksi': 0,
                    'potongan': 0,
                    'bayar': 0,
                    'retur': 0,
                    'ppnvalue': 0,
                    'tarif_type': $("#aritarif_type").val(),
                    'subsidisat': 0,
                    'printq': 0,
                    'printed_by': null,
                    'clinic_type': $("#ariclinic_type").val(),
                    'package_id': null,
                    'module_id': null,
                    'theorder': null,
                    'cashier': '<?= user_id(); ?>',
                    'no_skpinap': skunj.no_skpinap,
                    'pasien_id': skunj.pasien_id,
                    'respon': null,
                    'mapping_sep': null,
                    'trans_id': skunj.trans_id,
                    'sppkasir': null,
                    'sppbill': null,
                    'spppoli': null,
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data)
                    $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                        .prop("disabled", false)
                    getAkomodasi(skunj.visit_id)
                    $("#addRanapModal").modal('hide')
                },
                error: function() {
                    $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                        .prop("disabled", false)
                }
            });
        }
    }

    function deleteAkomodasi(billId, key) {
        if ((sAkom[key].sppbill == '' || sAkom[key].sppbill == null) && (sAkom[key].sppbill == '' || sAkom[key].sppbill ==
                null)) {
            var daysadded = new Date($("#tatreat_date" + key).val())
            var daysadded = daysadded.setDate(daysadded.getDate() + 10)
            var resultDate = new Date(daysadded)
            var today = new Date()
            if (resultDate > today) {
                var lsSep = $("#tano_skpinap").val()
                if (lsSep != '' && lsSep != null && sAkom.length != 0) {
                    alert('No SEP telah diterbitkan. Hapus nomor SEP terlebih dahulu.')
                } else {
                    if (confirm('Apakah anda betul-betul akan menghapus data ini?')) {
                        if (confirm(
                                'Menghapus data ini berarti akan menghapus semua transaksi yang pernah dilakukan di bangsal ini, Apakah anda betul-betul akan menghapus Data ini?'
                            )) {
                            $("#delBtnAkomodasi" + key).html('<i class="spinner-border spinner-border-sm"></i>')
                            $.ajax({
                                url: '<?php echo base_url(); ?>admin/rawatinap/deleteAkomodasi',
                                type: "POST",
                                data: JSON.stringify({
                                    "bill": sAkom[key].bill_id,
                                    "pastBill": key == 0 ? '' : sAkom[key - 1].bill_id
                                }),
                                dataType: 'json',
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    console.log(data.metadata.code)
                                    if (data.metadata.code == 200) {
                                        $("#" + sAkom[key].bill_id).remove()
                                        sAkom.splice(key, 1)
                                        if (key == 0) {
                                            sAkom[key - 1].keluar_id = 0
                                            var keypast = key - 1
                                            $("#takeluar_id" + keypast).val(0)
                                            $("#btnTdAkom" + keypast).append($(
                                                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">'
                                                )
                                                .append($(
                                                    '<button type="button" class="btn btn-primary" onclick="enableElementTA(' +
                                                    keypast + ')">').append(
                                                    '<i class="fa fa-edit"></i>'))
                                                .append($('<button id="delBtnAkomodasi' + keypast +
                                                        '" type="button" class="btn btn-danger" onclick="deleteAkomodasi(\'' +
                                                        sAkom[keypast].bill_id + '\',' + keypast + ')">')
                                                    .append('<i class="fa fa-trash"></i>'))
                                            )
                                        }
                                    } else {
                                        errorSwal(data.metadata.message)
                                    }
                                    $("#delBtnAkomodasi" + key).html('<i class="fa fa-trash"></i>')
                                },
                                error: function() {
                                    $("#delBtnAkomodasi" + key).html('<i class="fa fa-trash"></i>')
                                }
                            });
                        }
                    }
                }
            } else {
                alert(
                    "Anda tidak berhak menghapus transaksi ini karena durasi waktu telah terlampaui. Silahkan hubungi pihak administrator!"
                )
            }
        } else {
            alert(
                'Kunjungan pasien ini telah dilakukan close billing. Silahkan menghubungi petugas kasir untuk membua transaksinya kembali.'
            )
        }
    }

    // function insertSepInap() {
    //     var nospri = $("#taspecimenno").val()
    //     if (nospri == '' || nospri == null) {
    //         alert('No SPRI masih kosong')
    //     } else {
    //         $.ajax({
    //             url: '<?php echo base_url(); ?>admin/rawatinap/insertSepInap',
    //             type: "POST",
    //             data: JSON.stringify({
    //                 "visit": skunj.visit_id
    //             }),
    //             dataType: 'json',
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             success: function(data) {
    //                 console.log(data.metaData.code)
    //                 if (data.metaData.code == 200) {
    //                     alert(data.metaData.message)
    //                     successSwal(data.metaData.message)
    //                     $("#tano_skpinap").val(data.response.sep.noSep)
    //                 } else {
    //                     alert(data.metaData.message)
    //                 }
    //             },
    //             error: function() {
    //                 $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
    //                     .prop("disabled", false)
    //             }
    //         });
    //     }
    // }
    function insertSepInap() {
        var clicked_submit_btn = $("#createSepBtn")

        var kdpoli = ''
        var clinicSelected = skunj.clinic_id
        klinikBpjs.forEach((value, key) => {
            if (value[1] == clinicSelected) {
                kdpoli = value[0]
                // $("#skdpkdpoli").append(new Option(value[2], value[0]))
                // console.log(value[2])
            }
        })

        if ($("#taspecimenno").val() == '' || $("#taspecimenno").val() == null) {
            alert("Nomor SPRI tidak boleh kosong")
        } else {
            $("#createSepInapBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rawatinap/insertSep',
                type: "POST",
                data: JSON.stringify({
                    'visit_id': skunj.visit_id,
                    'noKartu': skunj.pasien_id,
                    "tglSep": (String)(skunj.visit_date).slice(0, 10),
                    "ppkPelayanan": '<?= $orgunit['OTHER_CODE']; ?>',
                    "jnsPelayanan": '1',
                    "klsRawat": {
                        "klsRawatHak": skunj.class_id_plafond,
                        "klsRawatNaik": skunj.class_id,
                        "pembiayaan": "1",
                        "penanggungJawab": "Pribadi"
                    },
                    "noMR": skunj.no_registration,
                    "rujukan": {
                        "asalRujukan": $("#taasalrujukan").val(),
                        "tglRujukan": $("#tatanggal_rujukan").val(),
                        "noRujukan": $("#tanorujukan").val(),
                        "ppkRujukan": $("#tappkrujukan").val()
                    },
                    "catatan": skunj.description,
                    "diagAwal": $("#tadiag_awal").val(),
                    "poli": {
                        "tujuan": kdpoli,
                        "eksekutif": skunj.kdpoli_eks
                    },
                    "cob": {
                        "cob": skunj.cob
                    },
                    "katarak": {
                        "katarak": skunj.backcharge
                    },
                    "jaminan": {
                        "lakaLantas": (skunj.reason_id == 3 ? 1 : 0),
                        "noLP": skunj.temptrans,
                        "penjamin": {
                            "tglKejadian": skunj.valid_rm_date,
                            "keterangan": skunj.delete_sep,
                            "suplesi": {
                                "suplesi": skunj.ispertarif,
                                "noSepSuplesi": skunj.no_skp,
                                "lokasiLaka": {
                                    "kdPropinsi": "",
                                    "kdKabupaten": "",
                                    "kdKecamatan": ""
                                }
                            }
                        }
                    },
                    "tujuanKunj": $("#tatujuankunj").val(),
                    "flagProcedure": $("#taflagprocedure").val(),
                    "kdPenunjang": $("#takdpenunjang").val(),
                    "assesmentPel": $("#taassesmentpel").val(),
                    "skdp": {
                        "noSurat": $("#taspecimenno").val(),
                        "kodeDPJP": skunj.kddpjp
                    },
                    "dpjpLayan": '',
                    "noTelp": sbio.mobile,
                    "user": '<?= user()->username; ?>'
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#createSepInapBtn").html('<i class="spinner-border spinner-border-sm"></i>')
                },
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("insert SEP Berhasil")
                        var result = data.response.sep
                        $("#tano_skpinap").val(result.noSep)
                        // $("#responpost_vklaim").val(JSON.stringify(data))
                        // $("#formaddpvbtn").click()
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#createSepInapBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>')
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    $("#createSepInapBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>')
                },
                complete: function() {
                    $("#createSepInapBtn").html('<i class="fa fa-plus"></i> <span>Insert SEP</span>')
                }
            })
        }
    }

    function updateSepInap() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/updateSepInap',
            type: "PUT",
            data: JSON.stringify({
                "visit": skunj.visit_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data)
                if (data.metaData.code == 200) {
                    alert(data.metaData.message)
                    successSwal(data.metaData.message)
                    $("#tano_skpinap").val(data.response.sep.noSep)
                } else {
                    errorSwal(data.metaData.message)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }

    function deleteSepInap() {
        $("#deleteSepInapBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/deleteSepInap',
            type: "DELETE",
            data: JSON.stringify({
                "noSep": $("#tano_skpinap").val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data)
                if (data.metaData.code == 200) {
                    successSwal(data.metaData.message)
                    $("#tano_skpinap").val("")
                } else {
                    errorSwal(data.metaData.message)
                }
                $("#deleteSepInapBtn").html('<i class="fa fa-plus"></i>')
            },
            error: function() {
                $("#deleteSepInapBtn").html('<i class="fa fa-plus"></i>')
            }
        });
    }

    function updatePulangSep() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/updatePulangSep',
            type: "DELETE",
            data: JSON.stringify({
                "noSep": $("#tano_skpinap").val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data)
                if (data.metaData.code == 200) {
                    successSwal(data.metaData.message)
                    $("#tano_skpinap").val("")
                } else {
                    errorSwal(data.metaData.message)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }

    // function getSPRIRanap() {
    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/rawatinap/getSPRI',
    //         type: "POST",
    //         data: JSON.stringify({
    //             'kddpjp': skunj.kddpjp,
    //             'clinic_id': skunj.clinic_id,
    //             'no_registration': skunj.no_registration
    //         }),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(data) {
    //             alert(data)
    //             console.log(data)
    //             if (data.metadata.code == '200') {
    //                 $("#taspecimenno").val(data.response.nosuratkontrol)
    //             }
    //         },
    //         error: function() {
    //             $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
    //                 .prop("disabled", false)
    //         }
    //     });
    // }

    function getDiagRujukan() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getDiagRujukan',
            type: "POST",
            data: JSON.stringify({
                'visit': skunj.visit_id,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                alert(data.metadata.message)
                console.log(data)
                if (data.metadata.code == '200') {
                    $("#diagRujukan").val(data.response.diagnosa_id)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }

    function getRujukanInap() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getRujukanInap',
            type: "POST",
            data: JSON.stringify({
                'visit': skunj.visit_id,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    var rujukan = data.response.data
                    $("#tglRencanaRujukanInap").val((String)(rujukan.tglrujukan).substr(0, 10))
                    $("#ppkRujukanInap").val(rujukan.provrujukan_kdprovider)
                    $("#diagRujukanInap").val(rujukan.kddiag)
                    $("#nameDiagRujukanInap").val(rujukan.nmdiag)
                    $("#poliRujukanInap").val(rujukan.clinic_id)
                    $("#tipeRujukanInap").val(rujukan.tiperujukan)
                    $("#catatanRujukanInap").val(rujukan.catatan)
                    $("#noRujukanInap").val(rujukan.nokunjungan)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }

    function insertRujukanInap() {
        var rujvisit = skunj.visit_id
        var rujrujukanNosep = $("#tano_skpinap").val()
        var rujnoRujukan = $("#noRujukanInap").val()
        var rujtglRujukan = sAkom[sAkom.length - 1].exit_date
        var rujtglRencanaKunjungan = $("#tglRencanaRujukanInap").val()
        if (rujtglRencanaKunjungan == '' || rujtglRencanaKunjungan == null) {
            alert('Tanggal Rencana Rujukan harus diisi')
            return '';
        }
        var rujppkdirujuk = $("#ppkRujukanInap").val()
        if (rujppkdirujuk == '' || rujppkdirujuk == null) {
            alert('kolom "Dirujuk Ke" tidak boleh kosong')
            return '';
        }
        var rujppkname = $("#ppkRujukanInap").find(":selected").text()
        if (typeof rujppkname !== 'undefined') {
            var rujppkdirujukName = rujppkname
        }
        var rujjnsPelayanan = '2'
        var rujcatatan = $("#noRujukanInap").val()
        var rujdiagRujukan = $("#diagRujukanInap").val()
        if (rujdiagRujukan == '' || rujdiagRujukan == null) {
            alert('Harus sudah mengisi diagnosa utama')
            return '';
        }
        var rujdiagRujukanName = $("#nameDiagRujukanInap").val()

        var rujtipeRujukan = $("#tipeRujukanInap").val()
        var rujpoliRujukan = $("#poliRujukanInap").val()
        if (rujpoliRujukan == '' || rujpoliRujukan == null) {
            alert('Poli rujukan harus diisi')
            return '';
        }
        var rujsex = skunj.gender
        var rujnama = skunj.diantar_oleh
        var rujnokartu = skunj.pasien_id
        var rujnorm = skunj.no_registration
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/postRujukan',
            type: "POST",
            data: JSON.stringify({
                'nosep': rujrujukanNosep,
                'norujukan': rujnoRujukan,
                'tglRujukan': rujtglRujukan,
                'tglRencanaKunjungan': rujtglRencanaKunjungan,
                'ppkdirujuk': rujppkdirujuk,
                'jnsPelayanan': rujjnsPelayanan,
                'catatan': rujcatatan,
                'diagRujukan': rujdiagRujukan,
                'tipeRujukan': rujtipeRujukan,
                'poliRujukan': rujpoliRujukan,
                'visit': rujvisit,
                'ppkdirujukName': rujppkdirujukName,
                'diagRujukanName': rujdiagRujukanName,
                'sex': rujsex,
                'nama': rujnama,
                'nokartu': rujnokartu,
                'nomr': rujnorm
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                if (data.metaData.code == '200') {
                    var noRujukan = data.response.rujukan.noRujukan
                    $("#noRujukanInap").val(noRujukan)
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
            },
            complete: function() {}
        });
    }

    function deleteRujukanInap() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/deleteRujukan',
            type: "DELETE",
            data: JSON.stringify({
                "noRujukan": $("#noRujukanInap").val(),
                'visit': skunj.visit_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data)
                if (data.metaData.code == 200) {
                    successSwal(data.metaData.message)
                    $("#noRujukanInap").val("")
                } else {
                    errorSwal(data.metaData.message)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }


    function getRujukanRanap() {

        if (false) { // (skunj.clinic_id == 'P012') {
            $("#taasalrujukan").val(2)
            $("#tanorujukan").val(null)
            $("#takdpoli").val("IGD")
            $("#tatanggal_rujukan").val((String)(get_date()).slice(0, 10))
            $("#tappkrujukan").val('<?= $orgunit['OTHER_CODE']; ?>')
            $("#tadiag_awal").html("")
            // $("#pvdiag_awal").append(new Option(data.response.rujukan.diagnosa.nama, data.response.rujukan.diagnosa.kode))
            // $("#pvconclusion").val("data.response.rujukan.diagnosa.nama")
        } else {
            var norujukan = $("#tanorujukan").val()
            var nokartu = skunj.pasien_id
            var asalrujukan = $("#taasalrujukan").val()
            if (asalrujukan == '') {
                alert("Pilih Asal Rujukan")
            } else {

            }

            $("#getRujukanRanapBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/getRujukan',
                type: "POST",
                data: JSON.stringify({
                    'norujukan': norujukan,
                    'nokartu': nokartu,
                    'asalrujukan': asalrujukan
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Get Rujukan Berhasil")
                        $("#tanorujukan").val(data.response.rujukan.noKunjungan)
                        $("#takdpoli").val(data.response.rujukan.poliRujukan.kode)
                        $("#tatanggal_rujukan").val(data.response.rujukan.tglKunjungan)
                        $("#tappkrujukan").val(data.response.rujukan.provPerujuk.kode)
                        $("#tadiag_awal").html("")
                        $("#tadiag_awal").append(new Option(data.response.rujukan.diagnosa.nama, data.response
                            .rujukan.diagnosa.kode))
                        $("#taconclusion").val(data.response.rujukan.diagnosa.nama)
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#getRujukanRanapBtn").html('<i class="fa fa-plus"></i> <span>Get Rujukan</span>')
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    $("#getRujukanRanapBtn").html('<i class="fa fa-plus"></i> <span>Get Rujukan</span>')
                },
                complete: function() {
                    $("#getRujukanRanapBtn").html('<i class="fa fa-plus"></i> <span>Get Rujukan</span>')
                }
            })
            // alert("Get Rujukan Berhasil")
            // $("#pvnorujukan").val('0097R0090520B000006')
            // $("#pvkdpoli").val('INT')
            // $("#pvtanggal_rujukan").val('2020-05-19 00:00:00.000')
            // $("#pvppkrujukan").val('0097B011')
        }
    }

    function saveSpriRanap() {
        var spripasien_id = skunj.pasien_id
        var sprikddpjp = $("#tasprikddpjp").val()
        var sprikdpoli = $("#tasprikdpoli").val()
        var spritglkontrol = $("#taspritglkontrol").val()
        var sprinosurat = $("#tasprinosurat").val()

        if (spripasien_id == '') {
            alert('No Kartu BPJS harus diisi!')
        } else if (sprikddpjp == '' || sprikddpjp == null) {
            alert('Kolom Dokter tidak boleh kosong')
        } else if (sprikdpoli == '' | sprikdpoli == null) {
            alert('Kolom Poli tidak boleh kosong')
        } else if (spritglkontrol == '' || spritglkontrol == null) {
            alert('Kolom Tanggal Rencana Kontrol tidak boleh kosong')
        } else {
            $("#saveSpriRanapBtn").html('<i class="spinner-border spinner-border-sm"></i>')

            spritglkontrol == (String)(spritglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/savespri ',
                type: "POST",
                data: JSON.stringify({
                    "request": {
                        "noKartu": spripasien_id,
                        "kodeDokter": sprikddpjp,
                        "poliKontrol": sprikdpoli,
                        "tglRencanaKontrol": spritglkontrol,
                        "user": '<?= user()->username; ?> '
                    },
                    "visit_id": skunj.visit_id,
                    "noSuratKontrol": sprinosurat,
                    'no_registration': skunj.no_registration
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil posting spri!")
                        $("#tasprinosurat").val(data.response.noSPRI)
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#saveSpriRanapBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                },
                error: function() {
                    $("#saveSpriRanapBtn").html('<i class="fa fa-plus"></i> <span>Simpan</span>')
                }
            });
        }
    }

    function deleteSpriRanap() {
        var sprinosurat = $("#tasprinosurat").val()
        if (sprinosurat == '' || sprinosurat == null) {
            alert('Kolom Nomor spri tidak boleh kosong saat menghapus')
        } else {
            $("#deleteSpriRanapBtn").html('<i class="spinner-border spinner-border-sm"></i>')
            spritglkontrol == (String)(spritglkontrol).replace("T", " ")
            $.ajax({
                url: '<?php echo base_url(); ?>admin/pendaftaran/deletespri ',
                type: "DELETE",
                data: JSON.stringify({
                    "request": {
                        "t_suratkontrol": {
                            "noSuratKontrol": sprinosurat,
                            "user": '<?= user()->username; ?> '
                        }
                    }
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.metaData.code == '200') {
                        alert("Berhasil delete spri!")
                        $("#tasprinosurat").val("")
                    } else {
                        alert(data.metaData.message)
                    }
                    $("#deleteSpriRanapBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                },
                error: function() {
                    $("#deleteSpriRanapBtn").html('<i class="fa fa-trash"></i> <span>Delete</span>')
                }
            });
        }
    }

    function checkSpriRanap() {
        $("#checkSpriRanapBtn").html('<i class="spinner-border spinner-border-sm"></i>')
        var sprinosurat = $("#sprinosurat").val()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/checkSpri ',
            type: "POST",
            data: JSON.stringify({
                "visit": skunj.visit_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.metadata.code == '200') {
                    alert(data.metadata.message)
                    var spri = data.data
                    $("#tasprikddpjp").val(spri.kodedokter)
                    // $("#tasprikdpoli").html("")
                    // klinikBpjs.forEach((value, key) => {
                    //     $("#tasprikdpoli").append(new Option(value[2], value[0]))

                    //     // if (value[1] == skunj.clinic_id) {
                    //     //     $("#tasprikdpoli").append(new Option(value[2], value[0]))
                    //     // }
                    // })
                    $("#tasprikdpoli").val(spri.polikontrol_kdpoli)
                    $("#taspritglkontrol").val((String)(spri.tglrenckontrol).slice(0, 10))
                    $("#tasprinosurat").val(spri.nosuratkontrol)
                    // Object.keys(dpjp).forEach(key => {
                    // if (key == employeeSelected) {
                    // // console.log(key, dpjp[key]);
                    // $("#pvkddpjp").append(new Option(dpjp[key], dpjp[key]));
                    // $("#sprikddpjp").html("")
                    // $("#sprikddpjp").append(new Option($("#pvemployee_id option:selected").text(), $("#pvkddpjp").val()))
                    // }
                    // });
                } else {
                    alert(data.metadata.message)
                    // $("#tasprikddpjp").html("")
                    // $("#tasprikddpjp").append(new Option(skunj.fullname, skunj.kddpjp))
                    $("#taspri.kddpjp").val(skunj.kddpjp)
                    // $("#tasprikdpoli").html("")
                    // klinikBpjs.forEach((value, key) => {
                    //     $("#tasprikdpoli").append(new Option(value[2], value[0]))

                    //     // if (value[1] == skunj.clinic_id) {
                    //     //     $("#tasprikdpoli").append(new Option(value[2], value[0]))
                    //     // }
                    // })
                    $("#tasprikdpoli").val(skunj.kdpoli)
                    $("#taspritglkontrol").val(null)
                    $("#tasprinosurat").val("")
                }
                $("#checkSpriRanapBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            },
            error: function() {
                $("#checkSpriRanapBtn").html('<i class="fa fa-edit"></i> <span>Check</span>')
            }
        });
    }
</script>
<script>
    var coba;
    let handoverData = [];
    let handoverDetailData = [];
    let toHandoverData = [];
    let afterHandoverData = [];
    $("#btnHandOver").on("click", function() {
        openHandOver()
    })

    const enableHandover = () => {
        if ($("#handhandover_by").val() == '') {
            $("#handSignHandoverBtnId").slideDown()
            $("#handSignReceiveBtnId").slideUp()

            $("#btnTransferGRoup").slideDown()
            $("#groupToHandover").prop("class", "col-md-5")
            $("#groupAfterHandover").prop("class", "col-md-5")

            $("#handSaveBtnId").slideDown()
            $("#handEditBtnId").slideUp()
            $("#handOverDocument").find("input, select, textarea").prop("disabled", false)
        } else if ($("#handreceived_by").val() == '') {
            $("#handSignHandoverBtnId").slideUp()
            $("#handSignReceiveBtnId").slideDown()

            $("#btnTransferGRoup").slideUp()
            $("#groupToHandover").prop("class", "col-md-6")
            $("#groupAfterHandover").prop("class", "col-md-6")

            $("#handSaveBtnId").slideUp()
            $("#handEditBtnId").slideUp()
            $("#handOverDocument").find("input, select, textarea").prop("disabled", true)

        } else {
            $("#handSignHandoverBtnId").slideUp()
            $("#handSignReceiveBtnId").slideUp()

            $("#btnTransferGRoup").slideUp()
            $("#groupToHandover").prop("class", "col-md-6")
            $("#groupAfterHandover").prop("class", "col-md-6")

            $("#handSaveBtnId").slideUp()
            $("#handEditBtnId").slideUp()
            $("#handOverDocument").find("input, select, textarea").prop("disabled", true)
        }
    }

    const disableHandover = () => {
        if ($("#handhandover_by").val() == '') {
            $("#handSignHandoverBtnId").slideDown()
            $("#handSignReceiveBtnId").slideUp()

            $("#btnTransferGRoup").slideUp()
            $("#groupToHandover").prop("class", "col-md-6")
            $("#groupAfterHandover").prop("class", "col-md-6")

            $("#handSaveBtnId").slideUp()
            $("#handEditBtnId").slideDown()
            $("#handOverDocument").find("input, select, textarea").prop("disabled", true)
        } else if ($("#handreceived_by").val() == '') {
            $("#handSignHandoverBtnId").slideUp()
            $("#handSignReceiveBtnId").slideDown()

            $("#btnTransferGRoup").slideUp()
            $("#groupToHandover").prop("class", "col-md-6")
            $("#groupAfterHandover").prop("class", "col-md-6")

            $("#handSaveBtnId").slideUp()
            $("#handEditBtnId").slideUp()
            $("#handOverDocument").find("input, select, textarea").prop("disabled", true)
        } else {
            $("#handSignHandoverBtnId").slideUp()
            $("#handSignReceiveBtnId").slideUp()

            $("#btnTransferGRoup").slideUp()
            $("#groupToHandover").prop("class", "col-md-6")
            $("#groupAfterHandover").prop("class", "col-md-6")

            $("#handSaveBtnId").slideUp()
            $("#handEditBtnId").slideUp()
            $("#handOverDocument").find("input, select, textarea").prop("disabled", true)
        }
    }

    const openHandOver = async () => {
        await getHandOver()
        $("#handoverModal").modal("show")
        $("#handOverDocument").hide()
    }

    const getHandOver = async () => {
        postData({}, 'admin/patient/getHandOver', (res) => {
            let data = JSON.parse(res)
            handoverData = data.handover
            handoverDetailData = data.handoverDetail
            addRowHandoverHistory(handoverData)
        });
    }

    const addRowHandoverHistory = (data) => {
        if (data.length > 0) {
            $.each(data, function(key, value) {
                let clinic = <?= json_encode($clinic); ?>;
                let classRoom = <?= json_encode($classRoom); ?>;
                let filteredClinic = clinic.filter(item => item.clinic_id === value.clinic_id);
                let filteredClass = classRoom.filter(item => item.class_room_id === value.class_room_id);
                coba = filteredClinic
                $("#listHandover").html("")
                $("#listHandover").append(
                    `
                <tr>
                    <td>${value.handover_date}</td>
                    <td>${filteredClinic[0]?.name_of_clinic}</td>
                    <td>${value.class_room_id == '%'? 'Semua':filteredClass[0]?.name_of_class}</td>
                    <td>${value.handover_by}</td>
                    <td>${value.received_by}</td>
                    <td>
                        <button type="button" id="handEditBtnId" name="editrm" onclick="editHandover(${key})" data-loading-text="processing" class="btn btn-secondary pull-right handEditBtnId">
                            <i class="fa fa-edit"></i> 
                            <span>Edit</span>
                        </button>
                    </td>
                </tr>
                `
                )
            })
        }
    }

    const setHandOver = () => {
        $("#handbody_id").val(get_bodyid())
        $("#handclinic_id").val(null)
        $("#handclass_room_id").val(null)
        $("#handhandover_by").val(null)
        $("#handhandover_date").val(null)
        $("#handhandover_sign").val(null)
        $("#handreceived_by").val(null)
        $("#handreceived_date").val(null)
        $("#handreceived_sign").val(null)
        $("#handOverDocument").slideDown()
        enableHandover()
    }

    const editHandover = (key) => {
        let data = handoverData[key]

        $("#handorg_unit_code").val(data.org_unit_code)
        $("#handbody_id").val(data.body_id)
        $("#handclinic_id").val(data.clinic_id)
        setClassRoom(data.clinic_id)
        $("handclass_room_id").val(data.class_room_id)
        $("#handhandover_by").val(data.handover_by)
        $("#handhandover_date").val(data.handover_date)
        $("#handhandover_sign").val(data.handover_sign)
        $("#handreceived_by").val(data.received_by)
        $("#handreceived_date").val(data.received_date)
        $("#handreceived_sign").val(data.received_sign)

        let dataDetail = handoverDetailData.filter(item => item.body_id == data.body_id)
        afterHandoverData = []
        $.each(dataDetail, function(key, value) {
            afterHandoverData.push(value.visit_id)
        })

        console.log(afterHandoverData)
        getRanapToHandover(afterHandoverData)
        enableHandover()
        $("#handOverDocument").slideDown()
    }

    const setClassRoom = (value) => {
        let classRoom = <?= json_encode($classRoom); ?>;


        let filtered = classRoom.filter(item => item.clinic_id === value);


        $("#handclass_room_id").html(new Option("Semua", "%", true, true))
        $.each(filtered, function(key, value) {
            $("#handclass_room_id").append(new Option(value.name_of_class, value.class_room_id))
        })
    }

    const getRanapToHandover = (afterData = []) => {
        postData({
            clinic_id: $("#handclinic_id option:selected").text(),
            class_room_id: $("#handclass_room_id").val()
        }, 'admin/patient/getPasienRanapRoom', (res) => {
            let data = JSON.parse(res)
            toHandoverData = []
            toHandoverData = data
            afterHandoverData = afterData
            transferToAfterHandoverAll()
        });
    }

    const saveRanapToHandover = () => {
        let data = {
            body_id: $("#handbody_id").val(),
            handover_by: $("#handhandover_by").val(),
            handover_date: $("#handhandover_date").val(),
            handover_sign: $("#handhandover_sign").val(),
            received_by: $("#handreceived_by").val(),
            received_date: $("#handreceived_date").val(),
            received_sign: $("#handreceived_sign").val(),
            clinic_id: $("#handclinic_id").val(),
            class_room_id: $("#handclass_room_id").val(),
            data: afterHandoverData
        };
        postData(data, 'admin/patient/saveHandover', (res) => {
            successSwal("Berhasil simpan data")
            disableHandover()
            getHandOver()
        });
    }
</script>
<script>
    const addRowToHandover = (data) => {
        $("#listToHandover").html("")
        $.each(data, function(key, value) {
            $("#listToHandover").append(
                `
                <tr>
                    <td class="d-flex justify-content-center align-items-center">
                        <div class="form-check mb-3">
                            <input id="tohand${value.visit_id}" class="form-check-input" type="checkbox" name="${value.visit_id}" value="${value.visit_id}">
                        </div>
                    </td>
                    <td>${value.no_registration}</td>
                    <td>${value.name_of_pasien}</td>
                    <td>${value.contact_address}</td>
                    <td>${value.name_of_clinic}</td>
                </tr>
                `
            )
        })
    }

    const checkAllToHandover = (bool) => {
        if (bool) {
            $('#listToHandover input[type="checkbox"]').prop('checked', true)
        } else {
            $('#listToHandover input[type="checkbox"]').prop('checked', false)
        }
    }

    const transferToAfterHandoverAll = () => {
        $('#listToHandover input[type="checkbox"]:checked').each(function() {
            afterHandoverData.push(this.value)
        })
        const afterHandoverIds = new Set(afterHandoverData.map(item => item));
        let filteredTo = toHandoverData.filter(item => !afterHandoverIds.has(item.visit_id))
        let filteredAfter = toHandoverData.filter(item => afterHandoverIds.has(item.visit_id))

        addRowToHandover(filteredTo)
        addRowAfterHandover(filteredAfter)
        $("#toHandoverCheckAll").prop("checked", false)
    }
    $("#signuser_type").on("change", function() {
        $("#displayuser_id").hide()
        $("#displaypassword").hide()
        $("#displaysignname").hide()
        $("#displaysignno_registration").hide()
        $("#displaysigndatepasien").hide()
        $("#displaysignnik").hide()
        $("#displayttd").hide()
        if ($(this).val() == 1) {
            $("#displayuser_id").show()
            $("#displaypassword").show()
        } else if ($(this).val() == 2) {
            $("#displaysignno_registration").show()
            $("#displaysigndatepasien").show()
            $("#displayttd").show()

            let formData = new FormData(document.getElementById("digitalSignForm"))
            let formDataObject = {};
            formData.forEach(function(value, key) {
                formDataObject[key] = value
            });

            // let data = [];
            var data = {
                signData: formDataObject,
            };
            $.ajax({
                url: '<?php echo base_url(); ?>signature/getSignPict',
                type: "POST",
                // data: [docData, formData],
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    // clicked_submit_btn.button('loading');
                },
                success: function(data) {

                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctxttd.clearRect(0, 0, canvasttd.width, canvasttd.height);

                    if (data) {
                        img.src = "data:image/gif;base64," + data.sign_file;
                        imgttd.src = "data:image/gif;base64," + data.sign_file;

                        $("#signname").val(data.fullname)

                        $("#tandatangansign").val("data:image/gif;base64," + data.sign_file);
                    }


                },
                error: function(xhr) { // if error occured
                    // alert("Error occured.please try again");
                    // clicked_submit_btn.button('reset');
                    // errorSwal(xhr);
                },
                complete: function() {
                    // clicked_submit_btn.button('reset');
                }
            });

        } else if ($(this).val() == 3) {
            $("#displaysignname").show()
            $("#displaysignno_registration").show()
            $("#displaysigndatepasien").show()
            $("#displaysignnik").show()
            $("#displayttd").show()
        }
    })
    const signHandover = () => {
        enableHandover()
        $("#signuser_type").val(1)
        $("#signuser_type").trigger("change")

        $("#digitalSignForm").on("submit", function(e) {
            e.preventDefault()
            let data = new FormData(this)
            postDataForm(data, 'admin/rm/assessment/checkpass', (res) => {
                if (res) {
                    $("#handhandover_by").val($("#user_id").val())
                    $("#handhandover_date").val(get_date())
                    $("#handhandover_sign").val($("#user_id").val() + get_date())
                    $("#handSaveBtnId").trigger("click")
                    $("#digitalSignModal").modal("hide")
                } else {
                    errorSwal("Username atau password anda salah")
                }
            });
        })
        $("#digitalSignModal").modal("show")
    }

    $("#toHandoverCheckAll").on("change", function(e) {
        checkAllToHandover($(this).prop("checked"))
    })

    $("#formSearchHandover").on("submit", function(e) {
        e.preventDefault()
        getRanapToHandover()
    })
    $("#handSaveBtnId").on("click", function() {
        saveRanapToHandover();
    })

    $("#handSignHandoverBtnId").on("click", function() {
        signHandover()
    })
    $("#handEditBtnId").on("click", function() {
        enableHandover()
    })
</script>

<script>
    const addRowAfterHandover = (data) => {
        $("#listAfterHandover").html("")
        $.each(data, function(key, value) {
            $("#listAfterHandover").append(
                `
                <tr>
                    <td class="d-flex justify-content-center align-items-center">
                        <div class="form-check mb-3">
                            <input id="tohand${value.visit_id}" class="form-check-input" type="checkbox" name="${value.visit_id}" value="${value.visit_id}">
                        </div>
                    </td>
                    <td>${value.no_registration}</td>
                    <td>${value.name_of_pasien}</td>
                    <td>${value.contact_address}</td>
                    <td>${value.name_of_clinic}</td>
                </tr>
                `
            )
        })
    }

    const checkAllAfterHandover = (bool) => {
        if (bool) {
            $('#listAfterHandover input[type="checkbox"]').prop('checked', true)
        } else {
            $('#listAfterHandover input[type="checkbox"]').prop('checked', false)
        }
    }

    const transferAfterToHandoverAll = () => {
        $('#listAfterHandover input[type="checkbox"]:checked').each(function() {
            afterHandoverData = afterHandoverData.filter(item => item != this.value)
        })
        const afterHandoverIds = new Set(afterHandoverData.map(item => item));
        let filteredTo = toHandoverData.filter(item => !afterHandoverIds.has(item.visit_id))
        let filteredAfter = toHandoverData.filter(item => afterHandoverIds.has(item.visit_id))

        addRowToHandover(filteredTo)
        addRowAfterHandover(filteredAfter)
        $("#afterHandoverCheckAll").prop("checked", false)
    }

    const signReceive = () => {

        $("#signuser_type").val(1)
        $("#signuser_type").trigger("change")
        enableHandover()
        $("#digitalSignForm").on("submit", function(e) {
            e.preventDefault()
            let data = new FormData(this)
            postDataForm(data, 'admin/rm/assessment/checkpass', (res) => {
                if (res) {
                    $("#handreceived_by").val($("#user_id").val())
                    $("#handreceived_date").val(get_date())
                    $("#handreceived_sign").val($("#user_id").val() + get_date())
                    $("#handSaveBtnId").trigger("click")
                    $("#digitalSignModal").modal("hide")
                } else {
                    errorSwal("Username atau password anda salah")
                }
            });
        })
        $("#digitalSignModal").modal("show")
    }

    $("#afterHandoverCheckAll").on("change", function(e) {
        checkAllAfterHandover($(this).prop("checked"))
    })
</script>

<script>
    const listSesi = (trans_id, visit, norm, base64json) => {

        $('#raber_visit_id').val(visit)
        $('#btnRaberModal').attr('visit_id', visit);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'trans_id': trans_id,
                'nomor': norm,
                'isrj': 0,
                'norujukan': '',
                'top': 100,
                'episode': ''
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#historyCpptList").modal("show")
                $("#addSessionRanap").html(
                    `<a data-toggle="modal" onclick="redirectToProfileBySession('${visit}','${base64json}')" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>`
                )
                $("#spectatorSessionRanap").html(
                    `<a data-toggle="modal" onclick="redirectToProfileBySession('${visit}','${base64json}','${get_bodyid()}')" class="btn btn-secondary btn-lg" style="width: 300px"><i class=" fa fa-eye"></i> Masuk Tanpa Sesi</a>`
                )
                $("#historyHistoryCpptBody").html(loadingScreen())

                $("#cpptDivForm").hide()
                getLoadingscreen("contentCppt", "loadContentCppt")
                getLoadingscreen("contentAssessmentPerawat", "loadContentAssessmentPerawat")
                $("#historyCpptBody").html(loadingScreen())
                $("#vitalSignBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                $("#historyCpptBody").html("")
                let examForassessment = data.examInfo
                let examForassessmentDetail = data.examDetail

                if (examForassessment.length > 0) {
                    $.each(examForassessment, function(key, value) {
                        // if (value.account_id == 3) { //} || value.account_id == 4) {
                        // }
                        let pd = examForassessment[key]
                        let examselectdetail = [];
                        $.each(examForassessmentDetail, function(key, value) {
                            if (value.body_id == pd.body_id)
                                examselectdetail = value
                        })
                        addRowCPPT(value, key, base64json, examselectdetail)
                    })
                }

            },
            error: function() {
                $("#historyCpptBody").html(tempTablesNull())
                $("#vitalSignBody").html(tempTablesNull())
            }
        });
    }

    const redirectToProfileBySession = (visit, base64json, body_id = null) => {
        if (body_id == null) {
            body_id = get_bodyid()
            window.open('<?= base_url(); ?>admin/patient/redirectProfileRanap/' + visit + '/' + base64json + '/' +
                body_id + '/true', '_blank');
        } else {
            window.open('<?= base_url(); ?>admin/patient/profileranap/' + visit + '/' + base64json + '/' + body_id,
                '_blank');
        }

        $("#historyCpptList").modal("hide")
    }

    const addRowCPPT = (examselect, key, base64json, examselectdetail) => {
        if (examselect.account_id == "3") {
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td colspan='7'>").html('<b>CPPT</b>'))
                .append($("<td rowspan='7'>")
                    .append(examselect.modified_by == '<?= user()->username; ?>' || userRoles?.hasOwnProperty(
                            examselect.petugas_type) || userRoles?.hasOwnProperty(0) ? $(
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="redirectToProfileBySession(\'' + examselect
                            .visit_id + '\', \'' + base64json + '\', \'' + examselect.body_id +
                            '\')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-check">Edit Sesi</i></button>'
                        ) : ''
                    )
                )
                // .append($("<td class='d-none' rowspan='7'>"))
            )
            $("#historyCpptBody").append($("<tr>")
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='6'>").html(''))
            )
        } else if (examselect.account_id == "4") {
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='6'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td colspan='7'>").html('<b>CPPT</b>'))
                .append($("<td rowspan='6'>"))
                // .append($("<td rowspan='6'>"))
            )
            $("#historyCpptBody").append($("<tr>")
                .append($("<td>").html(examselect.petugas))
                .append($("<td class='d-none' colspan='6'>").html(''))
            )
        } else if (examselect.account_id == '1') {
            let titlerj = '';
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td colspan='7'>").html('<b>Asesmen Medis</b>'))
                .append($("<td rowspan='7'>")
                    .append(examselect.modified_by == '<?= user()->username; ?>' || userRoles?.hasOwnProperty(
                            examselect.petugas_type) || userRoles?.hasOwnProperty(0) ? $(
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="redirectToProfileBySession(\'' + examselect
                            .visit_id + '\', \'' + base64json + '\', \'' + examselect.body_id +
                            '\')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-check">Edit Sesi</i></button>'
                        ) : ''
                    )
                )
                // .append($("<td rowspan='7'>"))
            )
            $("#historyCpptBody").append($("<tr>")
                .append($("<td>").html(examselect.petugas))
                .append($("<td class='d-none' colspan='6'>").html('')))

        } else if (examselect.account_id == '7') {
            let titlerj = '';
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td colspan='7'>").html('<b>Resume Medis</b>'))
                .append($("<td rowspan='7'>")
                    .append(examselect.modified_by == '<?= user()->username; ?>' || userRoles?.hasOwnProperty(
                            examselect.petugas_type) || userRoles?.hasOwnProperty(0) ? $(
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="redirectToProfileBySession(\'' + examselect
                            .visit_id + '\', \'' + base64json + '\', \'' + examselect.body_id +
                            '\')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-check">Edit Sesi</i></button>'
                        ) : ''
                    )
                )
                .append($("<td rowspan='7'>"))
            )
            $("#historyCpptBody").append($("<tr>")
                .append($("<td>").html(examselect.petugas))
                .append($("<td class='d-none' colspan='6'>").html('')))

        } else if (examselect.account_id == '2') {
            var titlekeperawatan = '';
            if (examselect.vs_status_id == 1) {
                titlekeperawatan = 'Dewasa'
            }
            if (examselect.vs_status_id == 4) {
                titlekeperawatan = 'Neonatus'
            }
            if (examselect.vs_status_id == 5) {
                titlekeperawatan = 'Anak'
            }
            if (examselect.vs_status_id == 10) {
                titlekeperawatan = 'Obsetric'
            }
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td colspan='7'>").html('<b>Asesmen Keperawatan ' + titlekeperawatan + '</b>'))
                .append($("<td rowspan='7'>")
                    .append(examselect.modified_by == '<?= user()->username; ?>' || userRoles?.hasOwnProperty(
                            examselect.petugas_type) || userRoles?.hasOwnProperty(0) ? $(
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="redirectToProfileBySession(\'' + examselect
                            .visit_id + '\', \'' + base64json + '\', \'' + examselect.body_id +
                            '\')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-check">Edit Sesi</i></button>'
                        ) : ''
                    )
                )
                // .append($("<td class='d-none' rowspan='7'>"))
            )
            $("#historyCpptBody").append($("<tr>")
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='6'>").html('')))

        } else if (examselect.account_id == '6') {
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='6'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td colspan='7'>").html('<b>Asuhan Gizi</b>'))
                .append($("<td rowspan='6'>")
                    .append(examselect.modified_by == '<?= user()->username; ?>' ? $(
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="redirectToProfileBySession(\'' + examselect
                            .visit_id + '\', \'' + base64json + '\', \'' + examselect.body_id +
                            '\')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-check">Edit Sesi</i></button>'
                        ) : ''
                    )
                )
                // .append($("<td class='d-none' rowspan='6'>"))
            )
            $("#historyCpptBody").append($("<tr>")
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='6'>").html('')))
        } else {
            $("#historyCpptBody").append($("<tr>")
                .append($("<td rowspan='5'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td>").html(examselect.petugas))
                .append($("<td colspan='6'>").html(''))
                .append($("<td rowspan='5'>")
                    .append(examselect.modified_by == '<?= user()->username; ?>' ? $(
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="redirectToProfileBySession(\'' + examselect
                            .visit_id + '\', \'' + base64json + '\', \'' + examselect.body_id +
                            '\')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-check">Edit Sesi</i></button>'
                        ) : ''
                    )
                )
                .append($("<td class='d-none' rowspan='5'>").html('<button type="button" onclick="removeCppt(\'' +
                    examselect.body_id +
                    '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'
                ))
            )
        }







        if (examselect.account_id == "1" || examselect.account_id == "7" || examselect.account_id == "2" || examselect.account_id == "3") {
            // var examselectdetail;
            // $.each(examForassessmentDetail, function(key, value) {
            //     if (value.body_id == examselect.body_id)
            //         examselectdetail = value
            // })
            $("#historyCpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='5'>").html(examselect.kode_ppa))
                    .append($("<td>").html("<b>S</b>"))
                    .append($("<td colspan='5'>").html(examselect?.anamnase?.replace(/\r\n/g, '<br>')))
                )

                .append($("<tr>")
                    .append($("<td rowspan=\"2\">").html("<b>O</b>"))
                    .append($("<td>").html('<b>Tekanan Darah</b>'))
                    .append($("<td>").html('<b>Nadi</b>'))
                    .append($("<td>").html('<b>Nafas/RR</b>'))
                    .append($("<td>").html('<b>Temp</b>'))
                    .append($("<td>").html('<b>SpO2</b>'))
                )
                .append($("<tr>")
                    .append($("<td>").html(examselectdetail?.tension_upper + '/' + examselectdetail?.tension_below +
                        'mmHg'))
                    .append($("<td>").html(examselectdetail?.nadi + '/menit'))
                    .append($("<td>").html(examselectdetail?.nafas + '/menit'))
                    .append($("<td>").html(examselectdetail?.temperature + '/°C'))
                    .append($("<td>").html(examselectdetail?.saturasi + '/SpO2%'))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>A</b>"))
                    .append($("<td colspan='5'>").html(examselect?.teraphy_desc?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>P</b>"))
                    .append($("<td colspan='5'>").html(examselect?.instruction?.replace(/\r\n/g, '<br>')))
                )
        } else if (examselect.account_id == '4') {
            $("#historyCpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='4'>").html(examselect.kode_ppa))
                    .append($("<td>").html("<b>S</b>"))
                    .append($("<td colspan='5'>").html(examselect?.anamnase?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>B</b>"))
                    .append($("<td colspan='5'>").html(examselect?.alo_anamnase?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>A</b>"))
                    .append($("<td colspan='5'>").html(examselect?.teraphy_desc?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>R</b>"))
                    .append($("<td colspan='5'>").html(examselect?.instruction?.replace(/\r\n/g, '<br>')))
                )
            // .append($("<tr>")
            //     .append($("<td>").html("Instruksi"))
            //     .append($("<td colspan='5'>").html(examselect.instruction))
            // )
        } else if (examselect.account_id == '6') {
            $("#historyCpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='4'>").html(examselect?.kode_ppa))
                    .append($("<td>").html("<b>A</b>"))
                    .append($("<td colspan='5'>").html(examselect?.anamnase?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>D</b>"))
                    .append($("<td colspan='5'>").html(examselect?.alo_anamnase?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>I</b>"))
                    .append($("<td colspan='5'>").html(examselect?.teraphy_desc?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>ME</b>"))
                    .append($("<td colspan='5'>").html(examselect?.instruction?.replace(/\r\n/g, '<br>')))
                )
        } else {
            $("#historyCpptBody")
                .append($("<tr>")
                    .append($("<td rowspan='4'>").html(examselect?.kode_ppa))
                    .append($("<td>").html("<b>A</b>"))
                    .append($("<td colspan='5'>").html(examselect?.anamnase?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>D</b>"))
                    .append($("<td colspan='5'>").html(examselect?.alo_anamnase?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>I</b>"))
                    .append($("<td colspan='5'>").html(examselect?.teraphy_desc?.replace(/\r\n/g, '<br>')))
                )
                .append($("<tr>")
                    .append($("<td>").html("<b>ME</b>"))
                    .append($("<td colspan='5'>").html(examselect?.instruction?.replace(/\r\n/g, '<br>')))
                )
            // .append($("<tr>")
            //     .append($("<td>").html("Instruksi"))
            //     .append($("<td colspan='5'>").html(examselect.instruction))
            // )
        }
    }
</script>