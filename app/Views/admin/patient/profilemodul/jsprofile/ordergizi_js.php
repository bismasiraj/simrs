<script type='text/javascript'>
    $(document).ready(function(e) {
        // getListRequestRad(nomor, visit)
        initializeSearchTarif("searchTarifRad", 'P016');
    })
    $("#radTab").on("click", function() {
        getTreatResultList(nomor, visit)
        getListRequestRad(nomor, visit)
    })
    $("#formSaveBillRadBtn").on("click", function() {
        $("#radChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
</script>
<script type='text/javascript'>
    function formatCurrency(total) {
        //Seperates the components of the number
        var components = total.toFixed(2).toString().split(".");
        //Comma-fies the first part
        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        //Combines the two sections
        return components.join(",");
    }


    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getTreatResultList(nomor, visit) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getTreatResultList',
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
                mrJson = data

                mrJson.forEach((element, key) => {

                    $("#radBody").append($("<tr>")
                        .append($("<td>").append($("<p>").html(mrJson[key].pickup_date)))
                        .append($("<td>").append($("<p>").html(mrJson[key].tarif_name)).append($("<p>").html(mrJson[key].pemeriksaan)).append($("<p>").html(mrJson[key].pemeriksaan_02)).append($("<p>").html(mrJson[key].pemeriksaan_03)).append($("<p>").html(mrJson[key].diagnosa_id + '-' + mrJson[key].diagnosa_desc)))
                        // .append($("<td>").html('<?= $visit['name_of_clinic']; ?>'))
                        .append($("<td>").append($("<p>").html(mrJson[key].teraphy_desc)).append($("<p>").html(mrJson[key].instruction)))
                        .append($("<td>").html(mrJson[key].result_value))
                    )
                });
            },
            error: function() {

            }
        });
    }

    function getListRequestRad(nomor, visit) {


        $.ajax({
            url: '<?php echo base_url(); ?>admin/rekammedis/getListRequestRad',
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


                hasilradJson = data

                $("#listRequestRad").html("")


                hasilradJson.forEach((element, key) => {
                    console.log(element)
                    $("#listRequestRad").append('<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa Radiologi </h3> <p> Tanggal ' + element.vactination_date + ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getRadOnlineRequest/' + btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id + '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
                });
            },
            error: function() {

            }
        });
    }

    function requestRad() {
        url = '<?php echo base_url(); ?>admin/rekammedis/radOnlineRequest/' + btoa('<?= json_encode($visit); ?>')

        window.open(url, "_blank")
    }

    function addBillRad(container) {
        // setTarif('P016', "searchTarifrad")
        // $("#addBill").modal("show")

        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        var i = $('#radChargesBody tr').length + 1;
        var key = 'rad' + i
        $("#radChargesBody").append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(i) + "."))
            .append($("<td>").attr("id", "araddisplaytreatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= $visit['fullname']; ?>')))
            .append($("<td>").attr("id", "araddisplaytreat_date" + key).html(get_date().substr(0, 16)).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "araddisplaysell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="aradquantity' + key + '" placeholder="" value="1" class="form-control" >')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "araddisplayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "araddisplayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "araddisplayamount_paid_plafond" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "araddisplaydiscount" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "araddisplaysubsidisat" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "araddisplaysubsidi" + key).html(formatCurrency(0)))
            .append($("<td>").append('<button id="aradsimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'arad\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">Simpan</button><div id="aradeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-radel="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-radel="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'arad\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'arad\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
        )


        $("#radChargesBody")
            .append('<input name="treatment[]" id="aradtreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="aradtreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="aradsell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="aradamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="araddiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="aradsubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="aradsubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="aradbill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="aradtrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="aradno_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="aradtheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="aradvisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="aradorg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="aradclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="aradclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="aradpayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="aradkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="aradtheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="aradthename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="aradtheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="aradstatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isRJ[]" id="aradisRJ' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="aradgender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="aradageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="aradagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="aradageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="aradkal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="aradkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="aradclass_room_id' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="aradbed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="aradclinic_id' + key + '" type="hidden" value="P016" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="aradclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="aradexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="aradcashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="aradmodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="aradislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="aradmeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="aradtarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#radChargesBody")
                    .append('<input name="employee_id_from[]" id="arademployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="araddoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#radChargesBody")
                    .append('<input name="employee_id_from[]" id="arademployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="araddoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#radChargesBody")
                    .append('<input name="employee_id_from[]" id="arademployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="araddoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#radChargesBody")
                    .append('<input name="employee_id_from[]" id="arademployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="araddoctor_from' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')

            <?php
            }
            ?>
        }
        $("#radChargesBody")
            .append('<input name="employee_id[]" id="arademployee_id' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="araddoctor' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="aradamount' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="aradnota_no' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="profesi[]" id="aradprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="aradtagihan' + key + '" type="hidden" value="' + tarifData.amount * $("#aradquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="aradtreatment_plafond' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="aradtarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type + '" class="form-control" />')

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#radChargesBody").append('<input name="amount_plafond[]" id="aradamount_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#radChargesBody").append('<input name="amount_paid_plafond[]" id="aradamount_paid_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#radChargesBody").append('<input name="class_id_plafond[]" id="aradclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#radChargesBody").append('<input name="tarif_id_plafond[]" id="aradtarif_id_plafond' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#radChargesBody").append('<input name="amount_plafond[]" id="aradamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#radChargesBody").append('<input name="amount_paid_plafond[]" id="aradamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#radChargesBody").append('<input name="class_id_plafond[]" id="aradclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#radChargesBody").append('<input name="tarif_id_plafond[]" id="aradtarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#radChargesBody").append('<input name="amount_plafond[]" id="aradamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#radChargesBody").append('<input name="amount_paid_plafond[]" id="aradamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#radChargesBody").append('<input name="class_id_plafond[]" id="aradclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#radChargesBody").append('<input name="tarif_id_plafond[]" id="aradtarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
        }

        $("#aradquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#aradquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#aradamount_paid" + key).val($("#aradamount" + key).val() * dInput)
            $("#araddisplayamount_paid" + key).html(formatCurrency($("#aradamount" + key).val() * dInput))
            $("#aradtagihan" + key).val($("#aradamount" + key).val() * dInput)
            $("#aradamount_paid_plafond" + key).val($("#aradamount_plafond" + key).val() * dInput)
            $("#araddisplayamount_paid_plafond" + key).html(formatCurrency($("#aradamount_plafond" + key).val() * dInput))
        })
    }
</script>