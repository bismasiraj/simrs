<script type='text/javascript'>
    $(document).ready(function(e) {
        initializeSearchTarif("searchTarifLab", 'P013');
    })
    $("#labTab").on("click", function() {
        $('#notaNoLab').html(`<option value="%">Semua</option>`)
        getListRequestLab(nomor, visit)
        getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota, trans)
    })
    $("#formSaveBillLabBtn").on("click", function() {
        $("#labChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
    $("#notaNoLab").on("change", function() {
        filterBillLab()
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
            .append($("<td>").attr("id", "alabdisplaytreatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= $visit['fullname']; ?>')))
            .append($("<td>").attr("id", "alabdisplaytreat_date" + key).html(get_date().substr(0, 16)).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "alabdisplaysell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="alabquantity' + key + '" placeholder="" value="0" class="form-control" >')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "alabdisplayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "alabdisplayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "alabdisplayamount_paid_plafond" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "alabdisplaydiscount" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidisat" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidi" + key).html(formatCurrency(0)))
            .append($("<td>")
                .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<button id="alabsimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'alab\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                    '<button id="alabeditDeleteCharge' + key + '" type="button" onclick="editBillCharge(\'alab\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Edit</button>' +
                    '<button id="delBillBtn' + key + '" type="button" onclick="delBill(\'alab\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                    '</div>' +
                    '</div>')
            )
        )

        $("#labChargesBody")
            .append('<input type="hidden" name="quantity[]" id="alabquantity' + key + '" placeholder="" value="0" class="form-control" >')
            .append('<input name="treatment[]" id="alabtreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="alabtreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="alabsell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="alabamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="alabdiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="alabsubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="alabsubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="alabbill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="alabtrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="alabno_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="alabtheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="alabvisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="alaborg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="alabclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="alabpayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="alabkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="alabtheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="alabthename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="alabtheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="alabstatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isrj[]" id="alabisrj' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="alabgender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="alabageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="alabagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="alabageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="alabkal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="alabkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="alabclass_room_id' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="alabbed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="alabclinic_id' + key + '" type="hidden" value="P013" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="alabclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="alabexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="alabcashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="alabmodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="alabislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="alabmeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="alabtarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            <?php
            }
            ?>
        }
        $("#" + key)
            .append('<input name="employee_id[]" id="alabemployee_id' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="alabdoctor' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="alabamount' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="alabnota_no' + key + '" type="hidden" value="' + nota_no + '" class="form-control" />')
            .append('<input name="profesi[]" id="alabprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="alabtagihan' + key + '" type="hidden" value="' + tarifData.amount * $("#alabquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="alabtreatment_plafond' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="alabtarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type + '" class="form-control" />')

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
        }

        $("#alabquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#alabquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#alabamount_paid" + key).val($("#alabamount" + key).val() * dInput)
            $("#alabdisplayamount_paid" + key).html(formatCurrency($("#alabamount" + key).val() * dInput))
            $("#alabtagihan" + key).val($("#alabamount" + key).val() * dInput)
            $("#alabamount_paid_plafond" + key).val($("#alabamount_plafond" + key).val() * dInput)
            $("#alabdisplayamount_paid_plafond" + key).html(formatCurrency($("#alabamount_plafond" + key).val() * dInput))
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
                    console.log(element)
                    $("#listRequestLab").append('<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa Lab </h3> <p> Tanggal ' + element.vactination_date + ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getLabOnlineRequest/' + btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id + '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
                });
            },
            error: function() {

            }
        });
    }

    function requestLab() {
        <?php json_decode($visit['responpost_vklaim']);
        if (json_last_error() === JSON_ERROR_NONE) {
        } else {
        ?>
        <?php
            unset($visit['responpost_vklaim']);
        } ?>
        url = '<?php echo base_url(); ?>admin/rekammedis/labOnlineRequest/' + btoa('<?= json_encode($visit); ?>')
        window.open(url, "_blank")
    }
</script>
<script>
    function filterBillLab() {
        $("#labChargesBody").html("")
        var notaNoLab = $("#notaNoLab").val()
        billJson.forEach((element, key) => {
            if (billJson[key].clinic_id == 'P013' && (billJson[key].nota_no == notaNoLab || '%' == notaNoLab)) {
                var i = $('#labChargesBody tr').length + 1;
                var counter = 'lab' + i
                addRowBill("labChargesBody", "alab", key, i, counter)
            }
        })
    }
</script>