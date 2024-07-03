<script type='text/javascript'>
    $(document).ready(function(e) {
        // getListRequestfisio(nomor, visit)
        initializeSearchTarif("searchTariffisio", 'P015');
    })
    $("#fisioTab").on("click", function() {
        $('#notaNofisio').html(`<option value="%">Semua</option>`)

        // getTreatResultList(nomor, visit)
        // getListRequestfisio(nomor, visit)
        getBillPoli(nomor, ke, mulai, akhir, lunas, 'P015', rj, status, nota, trans)
        // var seen = {};
        // $('#notaNofisio option').each(function() {
        //     if (seen[$(this).val()]) {
        //         $(this).remove();
        //     } else {
        //         seen[$(this).val()] = true;
        //     }
        // });
    })
    $("#formSaveBillfisioBtn").on("click", function() {
        $("#fisioChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
    $("#notaNofisio").on("change", function() {
        filterBillfisio()
    })
</script>
<script type='text/javascript'>
    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    // function getTreatResultList(nomor, visit) {


    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/patient/getTreatResultList',
    //         type: "POST",
    //         data: JSON.stringify({
    //             'nomor': nomor,
    //             'visit': visit
    //         }),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(data) {
    //             mrJson = data

    //             mrJson.forEach((element, key) => {

    //                 $("#fisioBody").append($("<tr>")
    //                     .append($("<td>").append($("<p>").html(mrJson[key].pickup_date)))
    //                     .append($("<td>").append($("<p>").html(mrJson[key].tarif_name)).append($("<p>").html(mrJson[key].pemeriksaan)).append($("<p>").html(mrJson[key].pemeriksaan_02)).append($("<p>").html(mrJson[key].pemeriksaan_03)).append($("<p>").html(mrJson[key].diagnosa_id + '-' + mrJson[key].diagnosa_desc)))
    //                     // .append($("<td>").html('<?= $visit['name_of_clinic']; ?>'))
    //                     .append($("<td>").append($("<p>").html(mrJson[key].teraphy_desc)).append($("<p>").html(mrJson[key].instruction)))
    //                     .append($("<td>").html(mrJson[key].result_value))
    //                 )
    //             });
    //         },
    //         error: function() {

    //         }
    //     });
    // }

    // function getListRequestfisio(nomor, visit) {


    //     $.ajax({
    //         url: '<?php echo base_url(); ?>admin/rekammedis/getListRequestfisio',
    //         type: "POST",
    //         data: JSON.stringify({
    //             'nomor': nomor,
    //             'visit': visit
    //         }),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(data) {


    //             hasilfisioJson = data

    //             $("#listRequestfisio").html("")


    //             hasilfisioJson.forEach((element, key) => {
    //                 console.log(element)
    //                 $("#listRequestfisio").append('<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa fisioiologi </h3> <p> Tanggal ' + element.vactination_date + ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getfisioOnlineRequest/' + btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id + '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
    //             });
    //         },
    //         error: function() {

    //         }
    //     });
    // }

    // function requestfisio() {
    //     url = '<?php echo base_url(); ?>admin/rekammedis/fisioOnlineRequest/' + btoa('<?= json_encode($visit); ?>')

    //     window.open(url, "_blank")
    // }

    function addBillfisio(container) {
        var nota_no = $("#notaNofisio").val();

        if (nota_no == '%') {
            nota_no = get_bodyid()
            $("#notaNofisio").append($("<option>").val(nota_no).text(nota_no))
            $("#notaNofisio").val(nota_no)
            $("#fisioChargesBody").html("")
        }

        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        var i = $('#fisioChargesBody tr').length + 1;
        var key = 'fisio' + i
        $("#fisioChargesBody").append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(i) + "."))
            .append($("<td>").attr("id", "afisiodisplaytreatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= $visit['fullname']; ?>')))
            .append($("<td>").attr("id", "afisiodisplaytreat_date" + key).html(get_date().substr(0, 16)).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "afisiodisplaysell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="afisioquantity' + key + '" placeholder="" value="0" class="form-control" >')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "afisiodisplayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "afisiodisplayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "afisiodisplayamount_paid_plafond" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "afisiodisplaydiscount" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "afisiodisplaysubsidisat" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "afisiodisplaysubsidi" + key).html(formatCurrency(0)))
            .append($("<td>").append('<button id="afisiosimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'afisio\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">Simpan</button><div id="afisioeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-fisioel="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-fisioel="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'afisio\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'afisio\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
        )


        $("#fisioChargesBody")
            .append('<input type="hidden" name="quantity[]" id="afisioquantity' + key + '" placeholder="" value="0" class="form-control" >')
            .append('<input name="treatment[]" id="afisiotreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="afisiotreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="afisiosell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="afisioamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="afisiodiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="afisiosubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="afisiosubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="afisiobill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="afisiotrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="afisiono_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="afisiotheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="afisiovisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="afisioorg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="afisioclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="afisioclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="afisiopayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="afisiokaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="afisiotheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="afisiothename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="afisiotheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="afisiostatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isRJ[]" id="afisioisRJ' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="afisiogender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="afisioageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="afisioagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="afisioageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="afisiokal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="afisiokaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="afisioclass_room_id' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="afisiobed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="afisioclinic_id' + key + '" type="hidden" value="P015" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="afisioclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="afisioexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="afisiocashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="afisiomodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="afisioislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="afisiomeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="afisiotarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#fisioChargesBody")
                    .append('<input name="employee_id_from[]" id="afisioemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="afisiodoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#fisioChargesBody")
                    .append('<input name="employee_id_from[]" id="afisioemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="afisiodoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#fisioChargesBody")
                    .append('<input name="employee_id_from[]" id="afisioemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="afisiodoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#fisioChargesBody")
                    .append('<input name="employee_id_from[]" id="afisioemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="afisiodoctor_from' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')

            <?php
            }
            ?>
        }
        $("#fisioChargesBody")
            .append('<input name="employee_id[]" id="afisioemployee_id' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="afisiodoctor' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="afisioamount' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="afisionota_no' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="profesi[]" id="afisioprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="afisiotagihan' + key + '" type="hidden" value="' + tarifData.amount * $("#afisioquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="afisiotreatment_plafond' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="afisiotarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type + '" class="form-control" />')

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#fisioChargesBody").append('<input name="amount_plafond[]" id="afisioamount_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#fisioChargesBody").append('<input name="amount_paid_plafond[]" id="afisioamount_paid_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#fisioChargesBody").append('<input name="class_id_plafond[]" id="afisioclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#fisioChargesBody").append('<input name="tarif_id_plafond[]" id="afisiotarif_id_plafond' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#fisioChargesBody").append('<input name="amount_plafond[]" id="afisioamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#fisioChargesBody").append('<input name="amount_paid_plafond[]" id="afisioamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#fisioChargesBody").append('<input name="class_id_plafond[]" id="afisioclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#fisioChargesBody").append('<input name="tarif_id_plafond[]" id="afisiotarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#fisioChargesBody").append('<input name="amount_plafond[]" id="afisioamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#fisioChargesBody").append('<input name="amount_paid_plafond[]" id="afisioamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#fisioChargesBody").append('<input name="class_id_plafond[]" id="afisioclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#fisioChargesBody").append('<input name="tarif_id_plafond[]" id="afisiotarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
        }

        $("#afisioquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#afisioquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#afisioamount_paid" + key).val($("#afisioamount" + key).val() * dInput)
            $("#afisiodisplayamount_paid" + key).html(formatCurrency($("#afisioamount" + key).val() * dInput))
            $("#afisiotagihan" + key).val($("#afisioamount" + key).val() * dInput)
            $("#afisioamount_paid_plafond" + key).val($("#afisioamount_plafond" + key).val() * dInput)
            $("#afisiodisplayamount_paid_plafond" + key).html(formatCurrency($("#afisioamount_plafond" + key).val() * dInput))
        })
    }
</script>
<script>
    function filterBillfisio() {
        $("#fisioChargesBody").html("")
        var notaNofisio = $("#notaNofisio").val()
        billJson.forEach((element, key) => {
            if (billJson[key].clinic_id == 'P015' && (billJson[key].nota_no == notaNofisio || '%' == notaNofisio)) {
                var i = $('#fisioChargesBody tr').length + 1;
                var counter = 'fisio' + i
                addRowBill("fisioChargesBody", "afisio", key, i, counter)
            }
        })
    }
</script>