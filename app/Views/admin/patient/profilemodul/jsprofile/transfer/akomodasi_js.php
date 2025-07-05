<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script>
    var tableKetersediaanTT = $("#ketersediaanTT").DataTable({
        dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
        "pageLength": 50
    })
    var classRoomArray = [];
    var bedArray = [];
    var jsonBed;
    var sAkom;
    var caraKeluar;
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
                        nextFormRanap(data.response.exit_date)
                        $("#addRanapModal").css("z-index", 2000)
                    }
                } else {
                    errorSwal(data.metadata.message)
                }
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
                $("#formAkomodasiViewBtn").slideUp()
                disableElementTA()
                updateAplicares(sAkom[sAkom?.length - 1].class_room_id)
            },
            error: function() {
                $("#formAkomodasiViewBtn").html('<i class="fa fa-save"></i> Simpan')
            }
        });

    }));

    function addRanap(id) {
        $("#historyRajalModal").modal("show")
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

    function getAkomodasi() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pendaftaran/getSinglePV',
            type: "POST",
            data: JSON.stringify({
                'visit': visit.visit_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data) {
                    skunj = data

                    //BIODATA
                    $("#taidentity").html(skunj.diantar_oleh + '(' + skunj.no_registration + ')')
                    $("#tabiodatatapasien_id").html(skunj.pasien_id)
                    $("#tabiodatatacoverages").html(skunj.coverage_id)
                    $("#tabiodatataaddress").html(skunj.visitor_address)
                    $("#tabiodatatagender").html(skunj.gender)
                    $("#tabiodatataclass_id_plafond").html(skunj.class_id_plafond)
                    $("#tabiodatataage").html(skunj.ageyear + "th " + skunj.agemonth + "bl " + skunj.ageday + "hr")
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

                                $("#iidentity").html(skunj.diantar_oleh + " (" + skunj.no_registration + ")")
                                $("#biodatatapasien_id").html(skunj.pasien_id)
                                // coverage.forEach((element, index) => {
                                //     if (index == skunj.coverage_id) {
                                //         $("#biodatatacoverages").html(element);
                                //     }
                                // });
                                $("#biodatataaddress").html(skunj.visitor_address)
                                $("#biodatatagender").html(skunj.gender)
                                // kelas.forEach(value => {
                                //     if (value[0] == skunj.class_id_plafond) {
                                //         $("#biodatataclass_id_plafond").html(value[1]);
                                //     }
                                // });
                                $("#biodatataage").val(skunj.ageyear + "th " + skunj.agemonth + "bl " + skunj.ageday + "hr")
                                // statusPasien.forEach(value => {
                                //     if (value[0] == skunj.status_pasien_id) {
                                //         $("#biodatatastatus").html(value[1]);
                                //     }
                                // });
                                // payor.forEach(payorvalue => {
                                //     if (payorvalue[1] == skunj.payor_id) {
                                //         $("#biodatatapayor").html(payorvalue[3]);
                                //     }
                                // });

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
                                console.log(data)
                                sAkom = data.data
                                $("#akomodasiViewTableBody").html("")
                                sAkom.forEach((element, key) => {
                                    $("#akomodasiViewTableBody").append($("<tr id='" + element.bill_id + "'>")
                                        .append('<input name="bill_id[]" type="hidden" value="' + element.bill_id + '">')
                                        .append('<input id="tatagihan' + key + '" name="tagihan[]" type="hidden" value="' + element.tagihan + '">')
                                        .append($("<td>").append(key + 1))
                                        .append($("<td>").append(element.name_of_class + "<br>" + element.fullname + "<br>" + element.bed_id))
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append('<input name="treat_date[]" class="form-control" type="datetime-local" value="' + (element.treat_date.substring(0, 16)) + '" id="tatreat_date' + key + '" onchange="changeTreatDateTA(' + key + ')" readonly>')
                                            )
                                        )
                                        .append($('<td>')
                                            .append($("<div>")
                                                .append('<input name="exit_date[]" class="form-control" type="datetime-local" value="' + (element?.exit_date?.substring(0, 16)) + '" id="taexit_date' + key + '" onchange="changeExitDateTA(' + key + ')" readonly>')
                                            )
                                        )
                                        .append($("<td>").append('<input id="taquantity' + key + '" name="quantity[]" class="form-control" type="text" value="' + parseFloat(element.quantity) + '" onchange="changeQuantityTA(' + key + ')" readonly/>'))
                                        .append($("<td>").append('<select name="keluar_id[]" id="takeluar_id' + key + '" class="form-control" onchange="changeCaraKeluarTA(' + key + ')"></select>'))
                                        .append($("<td>").append(element.tarif_name))
                                        .append($("<td>").append('<input id="tasell_price' + key + '" name="sell_price[]" class="form-control" type="text" value="' + parseFloat(element.sell_price) + '" readonly/>'))
                                        .append($("<td>").append('<input id="taamount_paid' + key + '" name="amount_paid[]" class="form-control" type="text" value="' + parseFloat(element.amount_paid) + '" readonly/>'))
                                    )
                                    if (key + 1 == sAkom.length) {
                                        $("#" + element.bill_id).append($('<td id="btnTdAkom"' + key + '>')
                                            .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                                .append($('<button type="button" class="btn btn-primary" onclick="enableElementTA(' + key + ')">').append('<i class="fa fa-edit"></i>'))
                                                .append($('<button id="delBtnAkomodasi' + key + '" type="button" class="btn btn-danger" onclick="deleteAkomodasi(\'' + element.bill_id + '\',' + key + ')">').append('<i class="fa fa-trash"></i>'))
                                            )
                                        )

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
                    // getRujukanInap()
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

    function nextFormRanap(dateinitialize = null) {
        $("#addRanapModal").modal("show")
        var currentDate = dateinitialize ? new Date(dateinitialize) : new Date();
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

                changeClinicInap('<?= @$visit['clinic_id']; ?>')
                changeClassRoomTA('<?= @$visit['class_room_id']; ?>')
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

        var keluarId = parseInt($("#tacarakeluar" + id).val());

        if (keluarId === 32) {
            // Pindah kamar → pembulatan ke bawah
            quantity = Math.floor(durationHours / 24);
        } else if ([1, 2, 3, 4, 5, 6, 7, 35].includes(keluarId)) {
            // Keluar RS → pembulatan ke atas dikurangi total sebelumnya
            let tglAwalRawat = $("#tatreat_date0").val(); // Rawat awal (bisa disesuaikan)
            let masuk = new Date(tglAwalRawat);
            let totalDurationHours = (end - masuk) / (1000 * 60 * 60);
            let totalDays = Math.ceil(totalDurationHours / 24);

            let totalSebelumnya = 0;
            for (let i = 0; i < id; i++) {
                let hariSebelumnya = parseInt($("#taquantity" + i).val());
                if (!isNaN(hariSebelumnya)) {
                    totalSebelumnya += hariSebelumnya;
                }
            }

            quantity = totalDays - totalSebelumnya;
            if (quantity <= 0) quantity = 1;
        } else {
            // Status lain seperti BOOKING, BATAL → default
            quantity = 0;
        }

        if (quantity == 0) {
            quantity = 1;
        }
        // var daydiff = datediff(start, end)
        // if (daydiff == 0) {
        //     daydiff = 1
        // }
        $("#taquantity" + id).val(quantity)
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
            return
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

        const keluarId = parseInt($("#takeluar_id" + id).val());
        console.log(keluarId)
        const durationHours = (end - start) / (1000 * 60 * 60);
        let quantity = 1;
        console.log(durationHours)

        if (keluarId === 32) {
            // PINDAH KAMAR: pembulatan ke bawah
            quantity = Math.floor(durationHours / 24);
        } else if ([1, 2, 3, 4, 5, 6, 7].includes(keluarId)) {
            // KELUAR RUMAH SAKIT: total dari rawat pertama sampai keluar, pembulatan ke atas
            const awalRawat = new Date($("#tatreat_date0").val()); // rawat pertama
            const totalDurationHours = (end - awalRawat) / (1000 * 60 * 60);
            const totalDays = Math.ceil(totalDurationHours / 24);
            console.log(awalRawat)
            console.log(totalDurationHours)
            console.log(totalDays)

            let totalSebelumnya = 0;
            for (let i = 0; i < id; i++) {
                const prev = parseInt($("#taquantity" + i).val());
                if (!isNaN(prev)) {
                    totalSebelumnya += prev;
                }
            }
            console.log(totalSebelumnya)

            quantity = totalDays - totalSebelumnya;
            console.log(quantity)
        }

        if (quantity <= 0) quantity = 1;

        $("#taquantity" + id).val(quantity);
        changeQuantityTA(id);
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
        if ((sAkom[key].sppbill == '' || sAkom[key].sppbill == null) && (sAkom[key].sppbill == '' || sAkom[key].sppbill == null)) {
            var daysadded = new Date($("#tatreat_date" + key).val())
            var daysadded = daysadded.setDate(daysadded.getDate() + 10)
            var resultDate = new Date(daysadded)
            var today = new Date()
            if (true) {
                // if (resultDate > today) {
                var lsSep = $("#tano_skpinap").val()
                if (false) {
                    // if (lsSep != '' && lsSep != null && sAkom.length != 0) {
                    alert('No SEP telah diterbitkan. Hapus nomor SEP terlebih dahulu.')
                } else {
                    if (confirm('Apakah anda betul-betul akan menghapus data ini?')) {
                        if (confirm('Menghapus data ini berarti akan menghapus semua transaksi yang pernah dilakukan di bangsal ini, Apakah anda betul-betul akan menghapus Data ini?')) {
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
                                            $("#btnTdAkom" + keypast).append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                                .append($('<button type="button" class="btn btn-primary" onclick="enableElementTA(' + keypast + ')">').append('<i class="fa fa-edit"></i>'))
                                                .append($('<button id="delBtnAkomodasi' + keypast + '" type="button" class="btn btn-danger" onclick="deleteAkomodasi(\'' + sAkom[keypast].bill_id + '\',' + keypast + ')">').append('<i class="fa fa-trash"></i>'))
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
                alert("Anda tidak berhak menghapus transaksi ini karena durasi waktu telah terlampaui. Silahkan hubungi pihak administrator!")
            }
        } else {
            alert('Kunjungan pasien ini telah dilakukan close billing. Silahkan menghubungi petugas kasir untuk membua transaksinya kembali.')
        }
    }

    function updateAplicares(class_room_id) {
        postData({
            class_room_id: class_room_id
        }, 'admin/rawatinap/updateAplicares', (res) => {
            console.log(res)
        })
    }

    function updateAplicaresAll() {
        postData({}, 'admin/rawatinap/updateAplicaresAll', (res) => {
            console.log(res)
        })
    }

    function getAplicaresAll() {
        postData({}, 'admin/rawatinap/getTT', (res) => {
            console.log(res)
        })
    }

    function removeAplicaresAll() {
        postData({}, 'admin/rawatinap/removeTT', (res) => {
            console.log(res)
        })
    }

    function insertAplicaresAll() {
        postData({}, 'admin/rawatinap/insertAplicaresAll', (res) => {
            console.log(res)
        })
    }
</script>