<script type='text/javascript'>
    $(document).ready(function(e) {
        // getListRequestRad(nomor, visit)
        initializeSearchTarif("searchTarifbillpoli", '<?= $visit['clinic_id']; ?>');
    })
    $("#tindakanTab").on("click", function() {
        $('#notaNoLab').html(`<option value="%">Semua</option>`)
        getBillPoli(nomor, ke, mulai, akhir, lunas, '<?= $visit['clinic_id']; ?>', rj, status, nota, trans)
    })
    $("#formSaveBillPoliBtn").on("click", function() {
        $("#billPoliChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
    $("#notaNoPoli").on("change", function() {
        filterBillPoli()
    })
</script>
<script type='text/javascript'>
    // function formatCurrency(total) {
    //     //Seperates the components of the number
    //     var components = total.toFixed(2).toString().split(".");
    //     //Comma-fies the first part
    //     components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    //     //Combines the two sections
    //     return components.join(",");
    // }


    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function addBillBillPoli(container) {
        let nota_no = $("#notaNoPoli").val();
        let sesi = '<?= $visit['session_id']; ?>';

        if (nota_no == '%') {
            $("#notaNoPoli").find(`option[value='${sesi}']`).remove()
            nota_no = sesi
            $("#notaNoPoli").append($("<option>").val(nota_no).text(nota_no))
            $("#notaNoPoli").val(nota_no)
            $("#billPoliChargesBody").html("")
        }


        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        $("#searchTarifbillpoli").val(null).trigger("change")

        var i = $('#billPoliChargesBody tr').length + 1;
        var key = 'billpoli' + i
        $("#billPoliChargesBody").append(`
            <tr id="${key}">
                <td>${String(i)}.</td>
                <td id="abillpolidisplaytreatment${key}"><b><i>${tarifData.tarif_name}</i></b><p><?= $visit['name_of_clinic']; ?></p></td>
                <td>
                    <select id="abillpoliemployee_id${key}" class="form-select" name="employee_id[]" style="display: none" onchange="changeFullnameDoctor('abillpoli','${key}')" readonly>
                        ${chargesDropdownDoctor()}
                    </select>
                    <input id="abillpolidoctor${key}" class="form-control" type="text" value="<?= $visit['fullname']; ?>" readonly>
                </td>
                <td id="abillpolidisplaytreat_date${key}">${moment().format("DD/MM/YYYY HH:mm")}</td>
                <td id="abillpolidisplaysell_price${key}">${formatCurrency(parseFloat(tarifData.amount))}<p></p></td>
                <td>
                    <input type="text" name="quantity[]" id="abillpoliquantity${key}" placeholder="" value="1" class="form-control">
                    <p><?= $visit['name_of_status_pasien']; ?></p>
                </td>
                <td id="abillpolidisplayamount_paid${key}">${formatCurrency(parseFloat(tarifData.amount))}</td>
                <td>
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                            <button id="abillpolisimpanBillBtn${key}" type="button" onclick="simpanBillCharge('${key}', 'abillpoli')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>
                            <button id="abillpolieditDeleteCharge${key}" type="button" onclick="editBillCharge('abillpoli', '${key}')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Edit</button>
                            <button id="delBillBtn${key}" type="button" onclick="delBill('abillpoli', '${key}')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>
                        </div>
                    </div>
                </td>
            </tr>
        `);




        $("#billPoliChargesBody")
            .append('<input name="treatment[]" id="abillpolitreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="abillpolitreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="abillpolisell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="abillpoliamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="abillpolidiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="abillpolisubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="abillpolisubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="abillpolibill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="abillpolitrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="abillpolino_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="abillpolitheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="abillpolivisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="abillpoliorg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="abillpoliclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="abillpoliclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="abillpolipayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="abillpolikaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="abillpolitheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="abillpolithename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="abillpolitheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="abillpolistatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isrj[]" id="abillpoliisrj' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="abillpoligender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="abillpoliageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="abillpoliagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="abillpoliageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="abillpolikal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="abillpolikaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="abillpoliclass_room_id' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="abillpolibed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="abillpoliclinic_id' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="abillpoliclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="abillpoliexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="abillpolicashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="abillpolimodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="abillpoliislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="abillpolimeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="abillpolitarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#billPoliChargesBody")
                    .append('<input name="employee_id_from[]" id="abillpoliemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="abillpolidoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#billPoliChargesBody")
                    .append('<input name="employee_id_from[]" id="abillpoliemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="abillpolidoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#billPoliChargesBody")
                    .append('<input name="employee_id_from[]" id="abillpoliemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="abillpolidoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#billPoliChargesBody")
                    .append('<input name="employee_id_from[]" id="abillpoliemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="abillpolidoctor_from' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')

            <?php
            }
            ?>
        }
        $("#billPoliChargesBody")
            .append(
                '<input name="employee_id[]" id="abillpoliemployee_id' + key + '" type="hidden" value="" class="form-control" />' +
                // '<input name="doctor[]" id="abillpolidoctor' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />' +
                '<input name="amount[]" id="abillpoliamount' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />' +
                '<input name="nota_no[]" id="abillpolinota_no' + key + '" type="hidden" value="' + nota_no + '" class="form-control" />' +
                '<input name="profesi[]" id="abillpoliprofesi' + key + '" type="hidden" value="" class="form-control" />' +
                '<input name="tagihan[]" id="abillpolitagihan' + key + '" type="hidden" value="' + tarifData.amount * $("#abillpoliquantity" + key).val() + '" class="form-control" />' +
                '<input name="treatment_plafond[]" id="abillpolitreatment_plafond' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />' +
                '<input name="tarif_type[]" id="abillpolitarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type + '" class="form-control" />'
            );

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#billPoliChargesBody").append('<input name="amount_plafond[]" id="abillpoliamount_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#billPoliChargesBody").append('<input name="amount_paid_plafond[]" id="abillpoliamount_paid_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#billPoliChargesBody").append('<input name="class_id_plafond[]" id="abillpoliclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#billPoliChargesBody").append('<input name="tarif_id_plafond[]" id="abillpolitarif_id_plafond' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#billPoliChargesBody").append('<input name="amount_plafond[]" id="abillpoliamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#billPoliChargesBody").append('<input name="amount_paid_plafond[]" id="abillpoliamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#billPoliChargesBody").append('<input name="class_id_plafond[]" id="abillpoliclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#billPoliChargesBody").append('<input name="tarif_id_plafond[]" id="abillpolitarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#billPoliChargesBody").append('<input name="amount_plafond[]" id="abillpoliamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#billPoliChargesBody").append('<input name="amount_paid_plafond[]" id="abillpoliamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#billPoliChargesBody").append('<input name="class_id_plafond[]" id="abillpoliclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#billPoliChargesBody").append('<input name="tarif_id_plafond[]" id="abillpolitarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
        }

        $("#abillpoliquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#abillpoliquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#abillpoliamount_paid" + key).val($("#abillpoliamount" + key).val() * dInput)
            $("#abillpolidisplayamount_paid" + key).html(formatCurrency($("#abillpoliamount" + key).val() * dInput))
            $("#abillpolitagihan" + key).val($("#abillpoliamount" + key).val() * dInput)
            $("#abillpoliamount_paid_plafond" + key).val($("#abillpoliamount_plafond" + key).val() * dInput)
            $("#abillpolidisplayamount_paid_plafond" + key).html(formatCurrency($("#abillpoliamount_plafond" + key).val() * dInput))
        })
    }
</script>
<script>
    function filterBillPoli() {
        $("#billPoliChargesBody").html("")
        let notaNoPoli = $("#notaNoPoli").val()

        billJson.forEach((element, key) => {
            var clinicIsTrue = billJson[key].clinic_id == 'P013' || billJson[key].clinic_id == 'P016' || billJson[key].clinic_id == 'P015' || billJson[key].clinic_id == 'P023'
            if (!clinicIsTrue && (billJson[key].nota_no == notaNoPoli || '%' == notaNoPoli)) {
                var i = $('#billPoliChargesBody tr').length + 1;
                var counter = 'billpoli' + i
                addRowBill("billPoliChargesBody", "abillpoli", key, i, counter)
            }
        })
    }
</script>