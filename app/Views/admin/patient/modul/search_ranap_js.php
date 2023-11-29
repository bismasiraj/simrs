<script type="text/javascript">
    var tableRanap = $("#tableSearchRanap").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    var tableKetersediaanTT = $("#ketersediaanTT").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>'
    })
    var classRoomArray = [];
    var bedArray = [];
    var jsonBed;
    var sAkom;
    var caraKeluar;

    $("#form2").on('submit', (function(e) {

        e.preventDefault();
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
                    // stringcolumn += '<tr class="table tablecustom-light">';
                    // element.forEach((element1, key1) => {
                    //     stringcolumn += "<td>" + element1 + "</td>";
                    // });
                    // stringcolumn += '</tr>'

                    tableRanap.row.add(element).draw()
                });
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
                    successMsg(data.metadata.message)
                    if (data.response.lastkeluar == 32) {
                        nextFormRanap()
                        $("#addRanapModal").css("z-index", 2000)
                    }
                } else {
                    errorMsg(data.metadata.message)
                }
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
                $("#formAkomodasiViewBtn").hide()
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
        $("#formAkomodasiViewBtn").show()
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

                                $("#iidentity").html(skunj.diantar_oleh + " (" + skunj.no_registration + ")")
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
                                $("#biodatataage").val(skunj.ageyear + "th " + skunj.agemonth + "bl " + skunj.ageday + "hr")
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


                                $("#akomodasiView").modal('show')
                                console.log(data)
                                sAkom = data.data
                                $("#akomodasiViewTableBody").html("")
                                sAkom.forEach((element, key) => {
                                    $("#akomodasiViewTableBody").append($("<tr id='" + element.bill_id + "'>")
                                        .append('<input name="bill_id[]" type="hidden" value="' + element.bill_id + '">')
                                        .append($("<td>").append(key + 1))
                                        .append($("<td>").append(element.name_of_class + "<br>" + element.fullname + "<br>" + element.bed_id))
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append('<input name="treat_date[]" class="form-control" type="datetime-local" value="' + element.treat_date + '" id="tatreat_date' + key + '" onchange="changeTreatDate(' + key + ')" readonly>')
                                            )
                                        )
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append('<input name="exit_date[]" class="form-control" type="datetime-local" value="' + element.exit_date + '" id="taexit_date' + key + '" onchange="changeExitDate(' + key + ')" readonly>')
                                            )
                                        )
                                        .append($("<td>").append('<input id="taquantity' + key + '" name="quantity[]" class="form-control" type="text" value="' + parseFloat(element.quantity) + '" readonly/>'))
                                        .append($("<td>").append('<select name="keluar_id[]" id="takeluar_id' + key + '" class="form-control" onchange="changeCaraKeluar(' + key + ')"></select>'))
                                        .append($("<td>").append(element.tarif_name))
                                        .append($("<td>").append(parseFloat(element.sell_price)))
                                        .append($("<td>").append(parseFloat(element.amount_paid)))
                                    )
                                    if (key + 1 == sAkom.length) {
                                        $("#" + element.bill_id).append($("<td>").append($('<button type="button" class="btn btn-primary" onclick="enableElementTA(' + key + ')">').append('<i class="fa fa-edit"></i>')))
                                    } else {
                                        $("#" + element.bill_id).append($("<td>"))
                                    }
                                    caraKeluar.forEach((elementKel, keyKel) => {
                                        $("#takeluar_id" + key).append('<option value="' + elementKel.keluar_id + '">' + elementKel.cara_keluar + '</option>')
                                    })
                                    $("#takeluar_id" + key).val(element.keluar_id)
                                    $("#takeluar_id" + key).on('mousedown', function() {
                                        return false;
                                    })
                                    $("#taquantity" + key).keydown(function(e) {
                                        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault()
                                    });
                                });
                            } else {
                                nextFormRanap()
                            }
                            $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                                .prop("disabled", false)
                        },
                        error: function() {
                            $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                                .prop("disabled", false)
                        }
                    });
                } else {
                    $("#ajax_load").html("");
                    $("#patientDetails").hide();
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
                    $("#patientDetails").hide();
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
                changeClassRoom($("#ariclass_room_id").val())
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
                $("#ariclass_room_id").append('<option value="' + element.class_room_id + '">' + element.classroomname + '</option>')
                $("#ariamount_paid").val(element.amount_paid)
                $("#aritarif_name").val(element.tarif_name)
                $("#aritarif_id").val(element.tarif_id)
            }
        });
        bedArray.forEach((element, key) => {
            if (element.class_room_id == jsonBed.class_room_id) {
                $("#aribed_id").append('<option value="' + element.bed_id + '">' + element.bed_id + '</option>')
            }
        })

        $("#ariclinic_idalert").hide()
        $("#ariclass_room_idalert").hide()
        $("#aribed_idalert").hide()
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
                $("#ariclass_room_id").append('<option value="' + element.class_room_id + '">' + element.classroomname + '</option>')
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

    function changeClassRoom(id) {
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

    function changeCaraKeluar(id) {
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
    }

    function changeExitDate(id) {
        var start = new Date($("#tatreat_date" + id).val())
        var end = new Date($("#taexit_date" + id).val())
        var daydiff = datediff(start, end)
        if (daydiff < 0) {
            alert("Tanggal Keluar harus lebih besar dari tanggal masuk")
            $("#taexit_date" + id).val($("#tatreat_date" + id).val())
            daydiff = 1
        } else {
            if (daydiff = 0) {
                daydiff = 1
            }
        }
        $("#taquantity" + id).val(daydiff)

    }

    function changeTreatDate(id) {
        if (id > 1) {
            var idEnd = id - 1
            var start = new Date($("#tatreat_date" + id).val())
            var end = new Date($("#taexit_date" + idEnd).val())
            var daydiffBefore = datediff(start, end)
            if (daydiffBefore > 0) {
                alert('Tanggal masuk RI harus lebih besar dari tanggal keluar pada kamar sebelumnya')
                $("#treat_date" + id).val(end)
            } else {
                var visitDate = new Date(skunj.visit_date)
                var daydiffrajal = datediff(visitDate, start)
                if (daydiffrajal >= 0) {
                    var end = new Date($("#taexit_date" + id).val())
                    var daydiff = datediff(start, end)
                    if (daydiff >= 0) {
                        if (daydiff == 0) {
                            daydiff = 1;
                        }
                        $("#taquantity" + id).val(daydiff)
                    } else {
                        alert('Tanggal keluar rawat inap harus lebih besar dari tanggal masuk')
                        $("#taexit_date" + id).val($("#tatreat_date" + id).val())
                        $("#taquantity" + id).val(1)
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
    }


    //form tambah akomodasi yang ada list bangsalnya
    function saveAddAkomodasi() {
        $("#saveAddAkomodasi").html('<i class="spinner-border spinner-border-sm"></i>')
        $("#saveAddAkomodasi").prop("disabled", true)
        var ariclinic_id = $("#ariclinic_id").val()
        var ariclass_room_id = $("#ariclass_room_id").val()
        var aribed_id = $("#aribed_id").val()

        if (typeof ariclinic_id === 'undefined' || ariclinic_id == null) {
            $("#ariclinic_idalert").show()
            $("#ariclass_room_idalert").hide()
            $("#aribed_idalert").hide()
        } else if (typeof ariclass_room_id === 'undefined' || ariclass_room_id == null) {
            $("#ariclinic_idalert").hide()
            $("#ariclass_room_idalert").show()
            $("#aribed_idalert").hide()
        } else if (typeof aribed_id === 'undefined' || aribed_id == null) {
            $("#ariclinic_idalert").hide()
            $("#ariclass_room_idalert").hide()
            $("#aribed_idalert").show()
        } else {
            $("#ariclinic_idalert").hide()
            $("#ariclass_room_idalert").hide()
            $("#aribed_idalert").hide()

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

    function insertSepInap() {
        var nospri = $("#taspecimenno").val()
        if (nospri == '' || nospri == null) {
            alert('No SPRI masih kosong')
        } else {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/rawatinap/insertSepInap',
                type: "POST",
                data: JSON.stringify({
                    "visit": skunj.visit_id
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.metaData.code)
                    if (data.metaData.code == 200) {
                        alert(data.metaData.message)
                        successMsg(data.metaData.message)
                        $("#tano_skpinap").val(data.response.sep.noSep)
                    } else {
                        errorMsg(data.metaData.message)
                    }
                },
                error: function() {
                    $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                        .prop("disabled", false)
                }
            });
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
                    successMsg(data.metaData.message)
                    $("#tano_skpinap").val(data.response.sep.noSep)
                } else {
                    errorMsg(data.metaData.message)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }

    function deleteSepInap() {
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
                    successMsg(data.metaData.message)
                    $("#tano_skpinap").val("")
                } else {
                    errorMsg(data.metaData.message)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
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
                    successMsg(data.metaData.message)
                    $("#tano_skpinap").val("")
                } else {
                    errorMsg(data.metaData.message)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }

    function getSPRI() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rawatinap/getSPRI',
            type: "POST",
            data: JSON.stringify({
                'kddpjp': skunj.kddpjp,
                'clinic_id': skunj.clinic_id,
                'no_registration': skunj.no_registration
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                alert(data)
                console.log(data)
                if (data.metadata.code == '200') {
                    $("#taspecimenno").val(data.response.nosuratkontrol)
                }
            },
            error: function() {
                $("#saveAddAkomodasi").html('Simpan <i class=" fas fa-check-circle"></i>')
                    .prop("disabled", false)
            }
        });
    }
</script>