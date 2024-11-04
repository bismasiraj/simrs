<script type='text/javascript'>
    $(document).ready(function(e) {
        initializeSearchTarif("searchTarifLab", 'P013');
        initializeSearchTarif("searchTarifLabHasil", 'P013');

        dateLab()


    })

    const convertDate = (dateString) => {
        const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
        const parsedDate = moment(dateString, formats, true);
        if (parsedDate.isValid()) {
            return parsedDate.format("YYYY-MM-DD");
        } else {
            return null;
        }
    };

    const dateLab = () => {
        const visit = <?= json_encode($visit); ?>;

        const StartToday = moment(visit?.visit_date).format("DD/MM/YYYY");
        const today = moment(new Date()).format("DD/MM/YYYY");

        $("#startDateLab").val(StartToday);
        $("#endDateLab").val(today);

        $("#startDateLIS").val(StartToday);
        $("#endDateLIS").val(today);


        $("#startDateLab").on('change', function() {
            const startDate = $(this).val();
            const endDate = $("#endDateLab").val();


            const formattedStartDate = convertDate(startDate);
            const formattedEndDate = convertDate(endDate);


            if (formattedEndDate && moment(formattedEndDate).isBefore(moment(formattedStartDate))) {

                $("#endDateLab").val(moment(formattedStartDate).format("DD/MM/YYYY"));
            }

            $("#endDateLab").attr('min', formattedStartDate);
        });



        $("#endDateLab").on('change', function() {
            const startDate = $("#startDateLab").val();
            const endDate = $(this).val();

            const formattedStartDate = convertDate(startDate);
            const formattedEndDate = convertDate(endDate);

            if (formattedEndDate && formattedEndDate < formattedStartDate) {
                errorSwal("End date cannot be earlier than start date!");

                $(this).val(moment(formattedStartDate).format("DD/MM/YYYY"));
            }
        });




        $("#btn-search-lab").off().on("click", function() {
            const start = convertDate($("#startDateLab").val());
            const end = convertDate($("#endDateLab").val());

            if (start && end) {
                getBillPoli(nomor, ke, start, end, lunas, 'P013', rj, status, $("#notaNoLab").val(), trans);
            }

            // setTimeout(() => {
            getDataTabels();
            // }, 1);

            // $("#notaNoLab").val("%");
        });




        $("#startDateLIS").on('change', function() {
            const startDate = $(this).val();
            const endDate = $("#endDateLIS").val();


            const formattedStartDate = convertDate(startDate);
            const formattedEndDate = convertDate(endDate);

            if (formattedEndDate && formattedStartDate && formattedEndDate < formattedStartDate) {
                $("#endDateLIS").val(moment(formattedStartDate).format("DD/MM/YYYY"));
            }

            $("#endDateLIS").attr('min', formattedStartDate);
        });

        $("#endDateLIS").on('change', function() {
            const startDate = $("#startDateLIS").val();
            const endDate = $(this).val();


            const formattedStartDate = convertDate(startDate);
            const formattedEndDate = convertDate(endDate);

            if (formattedEndDate && formattedStartDate && formattedEndDate < formattedStartDate) {
                errorSwal("End date cannot be earlier than start date!");
                $(this).val(moment(formattedStartDate).format("DD/MM/YYYY"));
            }
        });



    };

    // const btnCetakLabbb = () => {
    $("#btn-cetak").off().on("click", function() {
        const nolist = $("#notaNoLab").val();
        const no_pasien = nomor;
        const visit = <?= json_encode($visit); ?>;

        let start_request = convertDate($("#startDateLab").val())
        let end_request = convertDate($("#endDateLab").val())

        visit.nolist = nolist;
        visit.no_pasien = no_pasien;
        visit.start_request = start_request
        visit.end_request = end_request

        const visitString = JSON.stringify(visit);
        const encodedVisit = btoa(visitString);
        const url = `<?= base_url() . '/admin/rm/lainnya/laboratorium_cetak/' ?>${encodedVisit}`;

        window.open(url, '_blank');
    });
    // }


    $("#labTab").off().on("click", function() {
        $('#notaNoLab').html(`<option value="%">Semua</option>`)
        getListRequestLab(nomor, visit)
        getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota, trans)
        // setTimeout(() => {
        getDataTabels()
        // }, 1);

        getDataBillLIS({
            noRegis: nomor,
            trans_id: trans
        })

    })

    $("#formSaveBillLabBtn").on("click", function() {
        $("#labChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })

    $("#notaNoLab").on("change", function() {
        // filterBillLab()
        getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, $("#notaNoLab").val(), trans)
        // setTimeout(() => {
        getDataTabels()

        if ($("#notaNoLab").val() === "%") {
            $("#btn-cetak").attr("disabled", true)
        } else {
            $("#btn-cetak").attr("disabled", false)

        }

    })
</script>
<script type='text/javascript'>
    function addBillLab(container) {
        var nota_no = $("#notaNoLab").val();

        if (nota_no == '%') {
            nota_no = get_bodyid()
            $("#notaNoLab").append($("<option>").val(nota_no).text(nota_no))
            $("#notaNoLab").val(nota_no)
            $("#labChargesBody").html("")
        }

        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        tarifData.amount

        var i = $('#labChargesBody tr').length + 1;
        var key = 'lab' + i
        $("#labChargesBody").append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(i) + "."))
            .append($("<td>").attr("id", "alabdisplaytreatment" + key).html(tarifData.tarif_name))
            .append($("<td>").html('<select id="alabemployee_id' + key +
                '" class="form-select" name="employee_id[]" onchange="changeFullnameDoctor(\'alab\',\'' + key +
                '\')">' +
                chargesDropdownDoctor() +
                `</select>` +
                '<input id="alabdoctor' + key + '" class="form-control" style="display: none" type="text" readonly>'
            ))
            .append($("<td>").attr("id", "alabdisplaytreat_date" + key).html(moment().format("DD/MM/YYYY HH:mm"))
                .append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "alabdisplaysell_price" + key).html(formatCurrency(parseFloat(tarifData
                .amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="alabquantity' + key +
                    '" placeholder="" value="0" class="form-control" readonly>')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            // .append($("<td>").attr("id", "alabdisplayamount_paid" + key).html(formatCurrency(parseFloat(tarifData
            //     .amount))))
            // .append($("<td>").attr("id", "alabdisplayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            // .append($("<td>").attr("id", "alabdisplayamount_paid_plafond" + key).html(formatCurrency(0)))
            // .append($("<td>").attr("id", "alabdisplaydiscount" + key).html(formatCurrency(0)))
            // .append($("<td>").attr("id", "asubsidisat" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidi" + key).html(formatCurrency(0)))
            .append($("<td>")
                .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<button id="alabsimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key +
                    '\', \'alab\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                    '<button id="alabeditDeleteCharge' + key + '" type="button" onclick="editBillCharge(\'alab\', \'' +
                    key +
                    '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Edit</button>' +
                    '<button id="delBillBtn' + key + '" type="button" onclick="delBill(\'alab\', \'' + key +
                    '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                    '</div>' +
                    '</div>')
            )
        )

        $("#labChargesBody")
            .append('<input type="hidden" name="quantity[]" id="alabquantity' + key +
                '" placeholder="" value="0" class="form-control" >')
            .append('<input name="treatment[]" id="alabtreatment' + key + '" type="hidden" value="' + tarifData.tarif_name +
                '" class="form-control" />')
            .append('<input name="treat_date[]" id="alabtreat_date' + key + '" type="hidden" value="' + get_date() +
                '" class="form-control" />')
            .append('<input name="sell_price[]" id="alabsell_price' + key + '" type="hidden" value="' + tarifData.amount +
                '" class="form-control" />')
            .append('<input name="amount_paid[]" id="alabamount_paid' + key + '" type="hidden" value="' + tarifData.amount +
                '" class="form-control" />')
            .append('<input name="discount[]" id="alabdiscount' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')
            .append('<input name="subsidisat[]" id="alabsubsidisat' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')
            .append('<input name="subsidi[]" id="alabsubsidi' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')

            .append('<input name="bill_id[]" id="alabbill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="alabtrans_id' + key +
                '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="alabno_registration' + key +
                '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="alabtheorder' + key + '" type="hidden" value="' + (billJson?.length + 1) +
                '" class="form-control" />')
            .append('<input name="visit_id[]" id="alabvisit_id' + key +
                '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="alaborg_unit_code' + key +
                '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="alabclass_id' + key +
                '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="alabpayor_id' + key +
                '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="alabkaryawan' + key +
                '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="alabtheid' + key +
                '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="alabthename' + key +
                '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="alabtheaddress' + key +
                '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="alabstatus_pasien_id' + key +
                '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isrj[]" id="alabisrj' + key +
                '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="alabgender' + key +
                '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="alabageyear' + key +
                '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="alabagemonth' + key +
                '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="alabageday' + key +
                '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="alabkal_id' + key +
                '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="alabkaryawan' + key +
                '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="alabclass_room_id' + key +
                '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="alabbed_id' + key +
                '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="alabclinic_id' + key +
                '" type="hidden" value="P013" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="alabclinic_id_from' + key +
                '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="alabexit_date' + key + '" type="hidden" value="' + get_date() +
                '" class="form-control" />')
            .append('<input name="cashier[]" id="alabcashier' + key +
                '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="alabmodified_from' + key +
                '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="alabislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="alabmeasure_id' + key +
                '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="alabtarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id +
                '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            <?php
            }
            ?>
        }
        $("#" + key)
            .append('<input name="employee_id[]" id="alabemployee_id' + key +
                '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="alabdoctor' + key +
                '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="alabamount' + key + '" type="hidden" value="' + tarifData.amount +
                '" class="form-control" />')
            .append('<input name="nota_no[]" id="alabnota_no' + key + '" type="hidden" value="' + nota_no +
                '" class="form-control" />')
            .append('<input name="profesi[]" id="alabprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="alabtagihan' + key + '" type="hidden" value="' + tarifData.amount * $(
                "#alabquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="alabtreatment_plafond' + key + '" type="hidden" value="' +
                tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="alabtarif_type' + key + '" type="hidden" value="' + tarifData
                .tarif_type + '" class="form-control" />')

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key +
                    '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' + key +
                    '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                    '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key +
                    '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                    '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key +
                    '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key +
                '" type="hidden" value="0" class="form-control" />')
            $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' + key +
                '" type="hidden" value="0" class="form-control" />')
            $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key +
                '" type="hidden" value="" class="form-control" />')
        }

        $("#alabquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e
                .keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e
                .keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e
                .keyCode && e.preventDefault();
        });
        $('#alabquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#alabamount_paid" + key).val($("#alabamount" + key).val() * dInput)
            $("#alabdisplayamount_paid" + key).html(formatCurrency($("#alabamount" + key).val() * dInput))
            $("#alabtagihan" + key).val($("#alabamount" + key).val() * dInput)
            $("#alabamount_paid_plafond" + key).val($("#alabamount_plafond" + key).val() * dInput)
            $("#alabdisplayamount_paid_plafond" + key).html(formatCurrency($("#alabamount_plafond" + key).val() *
                dInput))
        })
    }

    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getHasilLab(nomor, visit) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getHasilLab',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                hasilLabJson = data.result

                var headerKey = data.headerKey

                $("#labBody").html(headerKey)


                hasilLabJson.forEach((element, key) => {
                    $("#viewlab" + hasilLabJson[key].periksa_tgl).append($("<tr>")
                        .append($("<td>").append($("<p>").html(hasilLabJson[key].parameter_name)))
                        .append($("<td>").html(hasilLabJson[key].hasil))
                        .append($("<td>").html(hasilLabJson[key].satuan))
                        .append($("<td>").html(hasilLabJson[key].nilai_rujukan))
                        .append($("<td>").html(hasilLabJson[key].description))
                    )
                });
            },
            error: function() {

            }
        });
    }

    function getListRequestLab(nomor, visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getListRequestLab',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                hasilLabJson = data

                $("#listRequestLab").html("")


                hasilLabJson.forEach((element, key) => {
                    $("#listRequestLab").append(
                        '<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa Lab </h3> <p> Tanggal ' +
                        element.vactination_date +
                        ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getLabOnlineRequest/' +
                        btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id +
                        '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
                });
            },
            error: function() {

            }
        });
    }
</script>
<script>
    function filterBillLab() {
        $("#labChargesBody").html("")
        var notaNoLab = $("#notaNoLab").val()
        billJson?.forEach((element, key) => {

            if (billJson[key]?.clinic_id == 'P013' && (billJson[key]?.nota_no == notaNoLab || '%' == notaNoLab)) {
                var i = $('#labChargesBody tr').length + 1;
                var counter = 'lab' + i
                addRowBill("labChargesBody", "alab", key, i, counter)

                setTimeout(() => {
                    $(`#alabdisplayamount_plafondlab${i}, #alabdisplayamount_paid_plafondlab${i},
                    #alabdisplaydiscountlab${i},
                    #alabsubsidisatlab${i}, #alabdisplayamount_plafondlab${i}`).hide();
                }, 100);
            }
        })
        getDataTabels()
    }
</script>

<!-- ===================================================================================================================================== -->
<script>
    $("#searchLIS").off().on("click", function() {
        const startDate = $("#startDateLIS").val();
        const endDate = $("#endDateLIS").val();

        const formattedStartDate = convertDate(startDate);
        const formattedEndDate = convertDate(endDate);

        const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
        const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

        getDataBillLIS({
            noRegis: nomor,
            trans_id: trans,
            startDate: start,
            endDate: end
        });
    });

    $("#searchLISHasil").off().on("click", function() {
        let startDate = $("#startDateLISHasil").val();
        let endDate = $("#endDateLISHasil").val();
        let hasil = $("#searchTarifLabHasil").val();
        let parsedHasil = JSON.parse(hasil);

        let formattedStartDate = convertDate(startDate);
        let formattedEndDate = convertDate(endDate);
        let tarifId = parsedHasil?.tarif_id;
        let noPasien = nomor


        if (!tarifId) {
            errorSwal("Tarif ID tidak ditemukan. Silakan pilih tarif yang valid.")
            $("#hasilFilterLIS").html(`<tr style="height: 200px;">
                                    <td colspan="100" class="align-middle text-center">
                                        <h3 class="text-center">Data Kosong</h3>
                                    </td>
                                </tr>`)

            return;
        }

        postData({
            no_pasien: nomor,
            start_date: formattedStartDate,
            end_date: formattedEndDate,
            tarif_id: tarifId
        }, 'admin/labRequest/getDataByFilter', (res) => {
            if (res.respon === true) {
                getDataHasilFilter({
                    data: res.dataTables
                })
            } else {
                $("#hasilFilterLIS").html(`<tr style="height: 200px;">
                                    <td colspan="100" class="align-middle text-center">
                                        <h3 class="text-center">Data Kosong</h3>
                                    </td>
                                </tr>`)
            }
        }, (beforesend) => {
            $("#hasilFilterLIS").html(loadingScreen())
        })


    });

    const getDataHasilFilter = (data) => {
        let result = '';
        let groupedData = {};

        data?.data.forEach(e => {
            if (!groupedData[e.tgl_hasil]) {
                groupedData[e.tgl_hasil] = {};
            }

            if (!groupedData[e.tgl_hasil][e.tarif_name]) {
                groupedData[e.tgl_hasil][e.tarif_name] = [];
            }

            groupedData[e.tgl_hasil][e.tarif_name].push(e);
        });

        for (let kelPemeriksaan in groupedData) {
            if (groupedData.hasOwnProperty(kelPemeriksaan)) {
                result += `<tr>
                            <td colspan="6"><strong>${moment(kelPemeriksaan).format("DD-MM-YYYY") }</strong></td>
                       </tr>`;
                for (let tarifName in groupedData[kelPemeriksaan]) {
                    if (groupedData[kelPemeriksaan].hasOwnProperty(tarifName)) {
                        result += `<tr>
                                    <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                               </tr>`;

                        groupedData[kelPemeriksaan][tarifName].forEach(e => {
                            result += `<tr>
                                       <td style="padding-left: 40px;">${e.parameter_name}</td>
                                       <td>${(e.flag_hl?.trim() || '') === 'L' ? `<b style="color:blue;">${e.hasil}</b>` : 
                                               (e.flag_hl?.trim() || '') === 'H' ? `<b style="color:red;">${e.hasil}</b>` :
                                               (e.flag_hl?.trim() || '') === '(*)' ? `<b style="color:red;">${e.hasil}</b>` :
                                               e.hasil}
                                       </td>
                                       <td>${e.satuan || '-'}</td>
                                       <td>${e.nilai_rujukan || '-'}</td>
                                       <td>${e.metode_periksa || '-'}</td>
                                       <td>${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                               (e.flag_hl?.trim() || '') === 'L' ? `<b style="color:blue;">${e.flag_hl.trim()}</b>` : 
                                               (e.flag_hl?.trim() || '') === 'H' ? `<b style="color:red;">${e.flag_hl.trim()}</b>` :
                                               (e.flag_hl?.trim() || '') === '(*)' ? `<b style="color:red;">${e.flag_hl.trim()}</b>` : 
                                               e.flag_hl.trim()}
                                       </td>
                                   </tr>`;
                        });
                    }
                }
            }
        }

        $("#hasilFilterLIS").html(result);
    };

    const getDataBillLIS = (props) => {
        const noRegis = props?.noRegis;
        const startDate = props?.startDate;
        const endDate = props?.endDate;
        const trans_id = props?.trans_id

        if (!noRegis) {
            console.error('No registration number provided.');
            return;
        }

        const requestData = {
            noRegis: noRegis,
            trans_id: trans_id
        };

        if (startDate && endDate) {
            requestData.startDate = startDate;
            requestData.endDate = endDate;
        }

        postData(requestData, 'admin/labRequest/getData', (res) => {

            if (res && res.value) {
                const {
                    inspection,
                    bridging,
                    hasillis
                } = res.value;

                inspectionLIS = inspection || [];
                detailsData = bridging || [];
                hasilLIS = hasillis || [];

                populateExaminationTable();
                populateDetailsTable();
                populateLabHasilTable();

            } else {
                console.error('Response data is missing expected properties.');
            }
        }, (beforesend) => {
            getLoadingGlobalServices('examinationTable tbody')
            getLoadingGlobalServices('detailsTable tbody')
            getLoadingGlobalServices('labHasilLIS tbody');
            // $("#bodydata").html(loadingScreen())
        });
    }


    let inspectionLIS = [];
    let detailsData = [];
    let hasilLIS = [];

    const examinationTableBody = document.querySelector('#examinationTable tbody');
    const detailsTableBody = document.querySelector('#detailsTable tbody');
    const selectAllExaminations = document.querySelector('#selectAllExaminations');
    const selectAllDetails = document.querySelector('#selectAllDetails');
    const moveRightBtn = document.querySelector('#moveRight');
    const moveLeftBtn = document.querySelector('#moveLeft');

    const populateExaminationTable = () => {
        examinationTableBody.innerHTML = '';

        inspectionLIS.forEach((item, index) => {
            const row = document.createElement('tr');
            row.dataset.index = index;

            row.innerHTML = `
          <td class="checkbox-col"><input type="checkbox" class="rowCheckboxExamination" data-index="${index}"></td>
          <td>${index + 1}</td>
          <td>${item?.no_registration}</td>
          <td>${item?.name_of_pasien}</td>
          <td>${item?.treatment}</td>
        `;

            examinationTableBody.appendChild(row);
        });

        attachRowCheckboxListeners('examination');
    }

    const getDataTabels = (props) => {
        postData({
            no_registration: nomor,
            trans_id: trans
        }, 'admin/labRequest/getValidate', (res) => {
            if (res.value.length > 0) {
                const validBills = res.value.map(item => item?.bill_id);
                setTimeout(() => {
                    const tableBody = $("#labChargesBody");

                    if ($.inArray(props?.data, validBills) !== -1) {
                        $("#saveBridge").hide()
                    } else {
                        $("#saveBridge").show()
                    }

                    tableBody.find("tr").each(function() {
                        const classes = $(this).attr("class")?.split(" ");
                        const billClassIndex = classes.indexOf('bill');
                        const classBeforeBill = billClassIndex > 0 ? classes[billClassIndex -
                            1] : null;
                        const rowIndex = $(this).index();

                        const rowId = classBeforeBill;

                        if (validBills.includes(rowId)) {
                            $(`#alabeditDeleteChargelab${rowIndex+1}`).remove();
                            // $(`#alabbridgelab${rowIndex +1}`).remove();
                            $(`#delBillBtnlabChargesBodyalab${rowIndex}`).remove();
                        }

                    });
                }, 200);
            }
        });
    };



    const populateLabHasilTable = () => {
        let result = ""

        hasilLIS.map((item, index) => {
            result += `<tr>
                        <td class="text-center align-middle">${index + 1}</td>
                        <td class="text-center align-middle">${item?.kode_kunjungan}</td>
                        <td class="text-center align-middle">
                            <button type="button" data-id="${item?.kode_kunjungan}" data-date="${item?.reg_date}" 
                                    id="btn-cetak-Hasillist" class="btn btn-secondary hasil-list-btn" name="cari">
                                <i class="far fa-file"></i> Preview
                           </button>
                        </td>
                    </tr>`


        });
        $("#labHasilLIS").html(result)
        if (hasilLIS.length === 0) {
            $("#labHasilLIS").html(`<tr style="height: 200px;">
                                    <td colspan="100" class="align-middle text-center">
                                        <h3 class="text-center">Data Kosong</h3>
                                    </td>
                                </tr>`);
        }

        $(".hasil-list-btn").off().on("click", function() {
            const kodeKunjungan = $(this).data("id");
            const regDate = $(this).data("date");

            const nolist = kodeKunjungan;
            const no_pasien = nomor;
            const visit = <?= json_encode($visit); ?>;

            let start_request = moment(regDate).format("YYYY-MM-DD")
            let end_request = moment(regDate).format("YYYY-MM-DD")

            visit.nolist = nolist;
            visit.no_pasien = no_pasien;
            visit.start_request = start_request
            visit.end_request = end_request

            const visitString = JSON.stringify(visit);
            const encodedVisit = btoa(visitString);
            const url = `<?= base_url() . '/admin/rm/lainnya/laboratorium_cetak/' ?>${encodedVisit}`;

            window.open(url, '_blank');
        });
    }



    const populateDetailsTable = () => {
        detailsTableBody.innerHTML = '';

        const currentUsername = '<?= user()->username ?>';

        detailsData.forEach((item, index) => {
            const row = document.createElement('tr');
            row.dataset.index = index;

            const isChecked = item.checked;
            const isValidationByMatch = item?.validation_by === currentUsername;
            const isValidationByNull = item?.validation_by === null;

            const canClickCheckbox = isValidationByMatch || isValidationByNull;

            row.innerHTML = `
          <td class="checkbox-col">
            <input type="checkbox" class="rowCheckboxDetails" data-index="${index}" 
                   ${isChecked || !canClickCheckbox ? 'disabled' : ''}>
          </td>
          <td>${index + 1}</td>
          <td>${item.no_registration}</td>
          <td>${item.name_of_pasien}</td>
          <td>${item.treatment}</td>
        `;
            detailsTableBody.appendChild(row);
        });

        attachRowCheckboxListeners('details');
    };


    moveRightBtn?.addEventListener('click', () => {
        moveSelectedRows('examination', 'details');
    });

    moveLeftBtn?.addEventListener('click', () => {
        moveSelectedRows('details', 'examination');
    });


    const moveSelectedRows = (fromTable, toTable) => {
        const selectedCheckboxes = document.querySelectorAll(`.rowCheckbox${capitalize(fromTable)}:checked`);
        const indicesToRemove = [];

        selectedCheckboxes.forEach(checkbox => {
            const index = checkbox.dataset.index;
            indicesToRemove.push(Number(index));
        });

        indicesToRemove.sort((a, b) => b - a);

        indicesToRemove.forEach(index => {
            if (fromTable === 'examination') {
                const movedData = inspectionLIS.splice(index, 1)[0];
                detailsData.push(movedData);
            } else {
                const movedData = detailsData.splice(index, 1)[0];
                inspectionLIS.push(movedData);
            }
        });


        populateExaminationTable();
        populateDetailsTable();


        selectAllExaminations.checked = false;
        selectAllDetails.checked = false;
    }

    selectAllExaminations?.addEventListener('change', (e) => {
        toggleSelectAll(e.target, 'examination');
    });


    selectAllDetails?.addEventListener('change', (e) => {
        toggleSelectAll(e.target, 'details');
    });


    const toggleSelectAll = (selectAllCheckbox, tableType) => {
        const isChecked = selectAllCheckbox.checked;

        const checkboxes = document.querySelectorAll(`.rowCheckbox${capitalize(tableType)}`);

        checkboxes?.forEach(cb => {
            if (!cb.disabled) {
                cb.checked = isChecked;
            }
        });
    }



    const attachRowCheckboxListeners = (tableType) => {
        const rowCheckboxes = document.querySelectorAll(`.rowCheckbox${capitalize(tableType)}`);
        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => checkSelectAllStatus(tableType));
        });
    }


    const checkSelectAllStatus = (tableType) => {
        const rowCheckboxes = document.querySelectorAll(`.rowCheckbox${capitalize(tableType)}`);
        const selectAllCheckbox = document.querySelector(`#selectAll${capitalize(tableType)}`);
        const allChecked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
        selectAllCheckbox.checked = allChecked;
    }


    const capitalize = (str) => {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    $("#saveLabLIS").off().on("click", () => {
        const citoCheckbox = $("#citoCheckbox").is(":checked");

        const startDate = $("#startDateLIS").val();
        const endDate = $("#endDateLIS").val();

        const formattedStartDate = convertDate(startDate);
        const formattedEndDate = convertDate(endDate);
        const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
        const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

        const selectedDetails = detailsData.map(item => ({
            no_registration: item.no_registration,
            name_of_pasien: item?.name_of_pasien,
            treatment: item.treatment,
            bill_id: item.bill_id,
            name_of_clinic: item.name_of_clinic,
            treat_date: item.treat_date,
            doctor_from: item.doctor_from,
            tagihan: item.tagihan,
            amount: item?.amount,
            sell_price: item?.sell_price,
            visit_id: item.visit_id,
            isrj: item.isrj,
            tarif_id: item.tarif_id,
            nota_no: item.nota_no,
            citoCheckbox
        }));

        const noRegistrationsList = nomor;

        postData({
            startDate: start,
            endDate: end,
            details: selectedDetails,
            noRegistrationsList: noRegistrationsList
        }, 'admin/labRequest/saveLabLIS', (res) => {
            if (res.status === true) {
                successSwal('Data has been processed successfully.');
                getDataBillLIS({
                    noRegis: nomor,
                    trans_id: trans,
                    startDate: start,
                    endDate: end
                });
                getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota, trans)
            } else {
                errorSwal('Failed to process data.');
            }
        });
    });


    populateExaminationTable();
    populateDetailsTable();

    const actionModalBridge = (bill) => {
        let data = JSON.parse(decodeURIComponent(bill));
        postData({
            nota_no: data?.nota_no,
            visit_id: data?.visit_id
        }, 'admin/labRequest/getDataPenunjang', (res) => {

            const imagePreview = $('#imagePreviewBridge');
            const pdfPreview = $('#pdfPreviewBridge');

            if (res.status === 'success') {
                const fileImageBase64 = res.data?.file_image_base64;

                if (fileImageBase64) {
                    const fileType = fileImageBase64.split(';')[0].split(':')[1];

                    if (fileType === 'application/pdf') {
                        pdfPreview.attr('src', fileImageBase64).show();
                        imagePreview.hide();
                    } else if (fileType.startsWith('image/')) {
                        imagePreview.attr('src', fileImageBase64).show();
                        pdfPreview.hide();
                    } else {

                        imagePreview.hide();
                        pdfPreview.hide();
                    }
                } else {
                    imagePreview.hide();
                    pdfPreview.hide();
                }
            } else {

                imagePreview.hide();
                pdfPreview.hide();
            }
        });

        // Populate modal with data
        $('#modalJenisTindakanLab').text(data.treatment + ' (' + data.doctor + ')');
        $('#modalTanggalTindakanLab').text(moment(data.treat_date).format('DD/MM/YYYY'));
        $('#modalNilaiTindakanLab').text(formatCurrency(parseFloat(data.tagihan)));
        $('#modalBill').val(data.bill_id);

        $('#formFileBridge').off('change');

        // File input change event handler
        $('#formFileBridge').on('change', (e) => {
            const file = e.target.files[0];
            const fileNameElement = $('#fileName');
            const imagePreview = $('#imagePreviewBridge');
            const pdfPreview = $('#pdfPreviewBridge');

            if (file) {
                fileNameElement.text(file.name).show();

                const reader = new FileReader();
                reader.onload = (event) => {
                    const fileType = file.type;
                    if (fileType.startsWith('image/')) {
                        imagePreview.attr('src', event.target.result).show();
                        pdfPreview.hide();
                    } else if (fileType === 'application/pdf') {
                        pdfPreview.attr('src', event.target.result + '#toolbar=0').show();
                        imagePreview.hide();
                    }
                };
                reader.readAsDataURL(file);
            } else {
                fileNameElement.hide();
                imagePreview.hide();
                pdfPreview.hide();
            }
        });

        getDataTabels({
            data: data.bill_id
        });

        // Save button click event handler
        $('#saveBridge').off('click').on('click', async (e) => {
            e.preventDefault();

            let formBridge = document.getElementById('formBridge');
            let formData = new FormData(formBridge);
            let jsonObj = {};

            let filePromises = [];
            formData.forEach((value, key) => {
                if (value instanceof File) {
                    filePromises.push(
                        new Promise((resolve, reject) => {
                            let reader = new FileReader();
                            reader.onload = () => {
                                const [mimeType, base64Content] = reader.result?.split(
                                    ',');
                                const extension = value.name.split('.').pop();
                                resolve({
                                    key: key,
                                    base64: base64Content,
                                    size: value.size,
                                    extension: extension
                                });
                            };
                            reader.onerror = reject;
                            reader.readAsDataURL(value);
                        })
                    );
                } else {
                    jsonObj[key] = value;
                }
            });

            try {
                let files = await Promise.all(filePromises);
                files.forEach(file => {
                    jsonObj[file.key] = {
                        "name": file.key,
                        "type": file.base64.split(':')[0],
                        "size": file.size,
                        "extension": file.extension,
                        "content": file.base64
                    };
                });
                jsonObj['nota_no'] = data.nota_no
                jsonObj['visit_id'] = data.visit_id;
                jsonObj['bill_id'] = data.bill_id;

                postData(jsonObj, 'admin/labRequest/saveImgToPenunjang', (res) => {
                    if (res.status === 'success') {
                        successSwal('Data terkirim');
                        formBridge.reset();

                        $('#formFileBridge').val('');
                        $('#fileName').hide();
                        $('#imagePreviewBridge').hide().attr('src',
                            '');
                        $('#pdfPreviewBridge').hide().attr('src', '');

                        $('#modalBridge').modal('hide');
                    } else {
                        console.warn('Data response not successful.');
                        errorSwal('Data belum tersedia');
                    }
                });

            } catch (error) {
                console.error('Error converting files to base64:', error);
            }
        });
    };


    $('#formFileBridge').on('change', function(event) {
        const file = event.target.files[0];
        const fileNameElement = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreviewBridge');
        const pdfPreview = document.getElementById('pdfPreviewBridge');

        if (file) {
            const fileName = file.name;
            const fileType = file.type;

            fileNameElement.textContent = `Selected file: ${fileName}`;
            fileNameElement.style.display = 'block';

            if (fileType.startsWith('image/')) {
                // Image preview logic
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    pdfPreview.style.display = 'none'; // Hide PDF preview
                };
                reader.readAsDataURL(file);
            } else if (fileType === 'application/pdf') {
                // PDF preview logic
                const reader = new FileReader();
                reader.onload = function(e) {
                    pdfPreview.src = e.target.result;
                    pdfPreview.style.display = 'block';
                    imagePreview.style.display = 'none'; // Hide image preview
                };
                reader.readAsDataURL(file);
            } else {
                // Unsupported file type
                fileNameElement.textContent = 'Unsupported file type';
                imagePreview.style.display = 'none';
                pdfPreview.style.display = 'none';
            }
        } else {
            // No file selected
            fileNameElement.style.display = 'none';
            imagePreview.style.display = 'none';
            pdfPreview.style.display = 'none';
        }
    });
</script>