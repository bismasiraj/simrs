<script type='text/javascript'>
    $(document).ready(function(e) {
        declareSearchTarifPenunjangMedis()
    })
    const declareSearchTarifPenunjangMedis = () => {
        initializeSearchTarif("searchTarifPenunjangMedis", 'PENUNJANG');
        $("#searchTarifPenunjangMedis").on('select2:select', function(e) {
            $("#searchTarifPenunjangMedisBtn").click();
            $('html,body').animate({
                    scrollTop: $("#searchTarifPenunjangMedis").offset().top - 50
                },
                'slow', 'swing');
            $("#searchTarifPenunjangMedis").click()
            $("#searchTarifPenunjangMedis").select2('open')
        });
    }
    // 1 = checkbox
    // 2 = text
    // 3 = textarea
    const FilterBound = [{
            name: "CHECK UP",
            value: 1
        },
        {
            name: "HIPERTENSI",
            value: 1
        },
        {
            name: "ARRHYTMIA",
            value: 1
        },
        {
            name: "CHEST PAIN",
            value: 1
        },
        {
            name: "PULMONARY DISEASE",
            value: 1
        },
        {
            name: "OBESITAS",
            value: 1
        },
        {
            name: "Keluhan/ gejala lain",
            value: 3
        },
        {
            name: "Sinus Rhytme",
            value: 1
        },
        {
            name: "Sinus Tachycardia",
            value: 1
        },
        {
            name: "Sinus Bpenunjangmedisycardia",
            value: 1
        },
        {
            name: "Sinus Arrhytmia",
            value: 1
        },
        {
            name: "Low Voltage",
            value: 1
        },
        {
            name: "AF / AFF",
            value: 1
        },
        {
            name: "SVT (PAT)",
            value: 1
        },
        {
            name: "VT / VF",
            value: 1
        },
        {
            name: "RBBB complete / incomplete",
            value: 1
        },
        {
            name: "LBBB complete / incomplete",
            value: 1
        },
        {
            name: "\"LVH",
            value: 1
        },
        {
            name: "\"RVH",
            value: 1
        },
        {
            name: "\"LAH",
            value: 1
        },
        {
            name: "RAH",
            value: 1
        },
        {
            name: "First / second/ third degree",
            value: 1
        },
        {
            name: "QRS Rate",
            value: 2
        },
        {
            name: "P-P Rate",
            value: 2
        },
        {
            name: "QRS Axis",
            value: 2
        },
        {
            name: "P-R Interval",
            value: 2
        },
        {
            name: "Q-T Interval",
            value: 2
        },
        {
            name: "SVES / VES",
            value: 2
        },
        {
            name: "Delta wave / U wave di lead",
            value: 2
        },
        {
            name: "Q Wave di lead",
            value: 2
        },
        {
            name: "r Premordial di lead",
            value: 2
        },
        {
            name: "ST depresed di lead",
            value: 2
        },
        {
            name: "ST Elevation di lead",
            value: 2
        },
        {
            name: "T Flat / T inverted di lead",
            value: 2
        },
        {
            name: "Kesan",
            value: 3
        },
        {
            name: "Anjuran",
            value: 3
        },
        {
            name: "Hasil",
            value: 3
        }
    ];

    $("#penunjangMedisTab").on("click", function() {
        $('#notaNoPenunjangMedis').html(`<option value="%">Semua</option>`)
        getTreatResultListPenunjang(nomor, trans, visit.visit_id)
        getBillPoli(nomor, ke, mulai, akhir, lunas, '%', rj, status, nota, trans)
    })
    $("#formSaveBillPenunjangBtn").on("click", function() {
        $("#penunjangChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
    $("#notaNoPenunjangMedis").on("change", function() {
        filterBillPenunjangMedis()
    })
    $('#isKritisPenunjang').click(function(e) {
        const currentValue = $('#modalIsKritis_penunjang').val();

        $('#modalIsKritis_penunjang').val(currentValue == 0 ? 1 : 0);

        if ($('#modalIsKritis_penunjang').val() == 1) {
            $('#isKritisPenunjang').html('Nilai Kritis &#10003;')
            $('#isKritisPenunjang').removeClass('btn-outline-primary');
            $('#isKritisPenunjang').addClass('btn-primary');
        } else {
            $('#isKritisPenunjang').html('Nilai Kritis')
            $('#isKritisPenunjang').removeClass('btn-primary');
            $('#isKritisPenunjang').addClass('btn-outline-primary');
        }
    })
    $('#isValidPenunjang').click(function(e) {
        const currentValue = $('#modalIsValid_penunjang').val();

        $('#modalIsValid_penunjang').val(currentValue == 0 ? 1 : 0);


        if ($('#modalIsValid_penunjang').val() == 1) {
            $('#isValidPenunjang').html('Tervalidasi')
            $('#isValidPenunjang').removeClass('btn-outline-primary');
            $('#isValidPenunjang').addClass('btn-primary');
        } else {
            $('#isValidPenunjang').html('Validasi')
            $('#isValidPenunjang').removeClass('btn-primary');
            $('#isValidPenunjang').addClass('btn-outline-primary');
        }
    })



    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getTreatResultListPenunjang(nomor, trans, visit_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/PenunjangMedis/getDataResult',
            type: "POST",
            data: JSON.stringify({
                'no_registration': nomor,
                'trans_id': trans,
                'visit_id': visit_id
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#penunjangMedisBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                $("#penunjangMedisBody").html("")
                mrJson = data.result.filter(item => {
                    const treatment = item.treatment ? item.treatment.toLowerCase() : '';
                    return treatment.includes('usg') || treatment.includes('ekg') || treatment.includes(
                        'ecg');
                });
                mrJson.forEach((element, key) => {

                    $("#penunjangMedisBody").append($("<tr>")
                        .append($("<td class='text-center align-middle'>").append($("<p>").html(
                            moment(mrJson[key].treat_date)
                            .format('DD-MM-YYYY HH:MM'))))
                        .append($("<td class='text-center align-middle'>").append($("<p>").html(
                            mrJson[key].nota_no)))
                        .append($("<td class='text-center align-middle'>").append($("<p>").html(
                                mrJson[key]
                                .treatment))
                            .append($("<p class='badge " + (mrJson[key].isvalid == 1 ?
                                "bg-primary" : "bg-danger") + " py-1 px-2'>").html(mrJson[key]
                                .isvalid == 1 ? 'TERVALIDASI' : 'BELUM VALIDASI'))
                            .append($("<p class='" + (mrJson[key].iskritis == 1 ?
                                "badge py-1 px-2 mx-2 bg-danger" : "d-none") + "'>").html(
                                'KRITIS'))
                        )
                        .append($("<td class='text-center align-middle'>").append(
                            '<div role="group" aria-label="Vertical button group">' +
                            '<button id="' + 'apenunjangMedis' + '" ' + 'data-bill="' + mrJson[
                                key].bill_id + '" ' + 'onclick="actionModalPenunjangMedis(\'' +
                            encodeURIComponent(JSON.stringify(mrJson[key])) + '\',\'' +
                            'apenunjangMedis' + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalPenunjangMedis" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            '>Hasil</button>'))
                    )
                });
            },
            error: function() {

            }
        });
    }


    const addNotaPenunjangMedis = () => {
        nota_no = get_bodyid()
        $("#notaNoPenunjangMedis").append($("<option>").val(nota_no).text(nota_no))
        $("#notaNoPenunjangMedis").val(nota_no)
        $("#penunjangChargesBody").html("")
        return nota_no
    }

    function addBillPenunjangMedis(container) {
        var nota_no = $("#notaNoPenunjangMedis").val();
        let sesi = '<?= $visit['session_id']; ?>';

        // if (nota_no == '%') {
        //     $("#notaNoPenunjangMedis").find(`option[value='${sesi}']`).remove()
        //     nota_no = sesi
        //     $("#notaNoPenunjangMedis").append($("<option>").val(nota_no).text(nota_no))
        //     $("#notaNoPenunjangMedis").val(nota_no)
        //     $("#penunjangChargesBody").html("")
        //     // getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota_no, trans)
        // }
        if (nota_no == '%') {
            nota_no = addNotaPenunjangMedis()
        }
        let codeData = get_bodyid();
        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        var i = $('#penunjangChargesBody tr').length + 1;
        var key = 'penunjangmedis' + i
        $("#penunjangChargesBody").append($("<tr id=\"apenunjangmedis" + key + "\">")
            .append($("<td>").html(String(i) + "."))
            .append($("<td>").attr("id", "apenunjangmedisdisplaytreatment" + key).html(tarifData.tarif_name).append($(
                "<p>").html('<?= @$visit['fullname']; ?>')))
            .append($("<td>").html('<select id="apenunjangmedisemployee_id' + key +
                '" class="form-select" name="employee_id[]" onchange="changeFullnameDoctor(\'apenunjangmedis\',\'' +
                key + '\')">' +
                chargesDropdownDoctor() +
                `</select>` +
                '<input id="apenunjangmedisdoctor' + key +
                '" class="form-control" style="display: none" type="text" readonly>'
            ))
            .append($("<td>").attr("id", "apenunjangmedisdisplaytreat_date" + key).html(moment().format(
                "DD/MM/YYYY HH:mm")).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "apenunjangmedisdisplaysell_price" + key).html(formatCurrency(parseFloat(
                tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="apenunjangmedisquantity' + key +
                    '" placeholder="" value="0" class="form-control" readonly>')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "apenunjangmedisdisplayamount_paid" + key).html(formatCurrency(parseFloat(
                tarifData.amount))))
            // .append($("<td>").attr("id", "apenunjangmedisdisplayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            .append($("<td>")
                .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<button id="apenunjangmedissimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' +
                    key +
                    '\', \'apenunjangmedis\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                    '<button id="apenunjangmediseditDeleteCharge' + key +
                    '" type="button" onclick="editBillCharge(\'apenunjangmedis\', \'' + key +
                    '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off"  style="display: none">Edit</button>' +
                    '<button id="delBillBtn' + key + '" type="button" onclick="delBill(\'apenunjangmedis\', \'' + key +
                    '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                    '</div>' +
                    '</div>')
            )
        )


        $("#penunjangChargesBody")
            .append('<input type="hidden" name="quantity[]" id="apenunjangmedisquantity' + key +
                '" placeholder="" value="0" class="form-control" >')
            .append('<input name="treatment[]" id="apenunjangmedistreatment' + key + '" type="hidden" value="' + tarifData
                .tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="apenunjangmedistreat_date' + key + '" type="hidden" value="' +
                get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="apenunjangmedissell_price' + key + '" type="hidden" value="' + tarifData
                .amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="apenunjangmedisamount_paid' + key + '" type="hidden" value="' +
                tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="apenunjangmedisdiscount' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')
            .append('<input name="subsidisat[]" id="apenunjangmedissubsidisat' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')
            .append('<input name="subsidi[]" id="apenunjangmedissubsidi' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')

            .append(
                `<input name="bill_id[]" id="apenunjangmedisbill_id${key}" type="hidden" value="${billJson?.bill_id ?? codeData}" class="form-control" />`
            )
            .append('<input name="trans_id[]" id="apenunjangmedistrans_id' + key +
                '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="apenunjangmedisno_registration' + key +
                '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="apenunjangmedistheorder' + key + '" type="hidden" value="' + (billJson
                .length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="apenunjangmedisvisit_id' + key +
                '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="apenunjangmedisorg_unit_code' + key +
                '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="apenunjangmedisclass_id' + key +
                '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="apenunjangmedisclass_id_plafond' + key +
                '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="apenunjangmedispayor_id' + key +
                '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="apenunjangmediskaryawan' + key +
                '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="apenunjangmedistheid' + key +
                '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="apenunjangmedisthename' + key +
                '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="apenunjangmedistheaddress' + key +
                '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="apenunjangmedisstatus_pasien_id' + key +
                '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isrj[]" id="apenunjangmedisisrj' + key +
                '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="apenunjangmedisgender' + key +
                '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="apenunjangmedisageyear' + key +
                '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="apenunjangmedisagemonth' + key +
                '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="apenunjangmedisageday' + key +
                '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="apenunjangmediskal_id' + key +
                '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="apenunjangmediskaryawan' + key +
                '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="apenunjangmedisclass_room_id' + key +
                '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="apenunjangmedisbed_id' + key +
                '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="apenunjangmedisclinic_id' + key +
                '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="apenunjangmedisclinic_id_from' + key +
                '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="apenunjangmedisexit_date' + key + '" type="hidden" value="' +
                get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="apenunjangmediscashier' + key +
                '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="apenunjangmedismodified_from' + key +
                '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="apenunjangmedisislunas' + key +
                '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="apenunjangmedismeasure_id' + key +
                '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="apenunjangmedistarif_id' + key + '" type="hidden" value="' + tarifData
                .tarif_id + '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#penunjangChargesBody")
                    .append('<input name="employee_id_from[]" id="apenunjangmedisemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apenunjangmedisdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#penunjangChargesBody")
                    .append('<input name="employee_id_from[]" id="apenunjangmedisemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apenunjangmedisdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#penunjangChargesBody")
                    .append('<input name="employee_id_from[]" id="apenunjangmedisemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apenunjangmedisdoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#penunjangChargesBody")
                    .append('<input name="employee_id_from[]" id="apenunjangmedisemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apenunjangmedisdoctor_from' + key +
                        '" type="hidden" value="<?= @$visit['fullname']; ?>" class="form-control" />')

            <?php
            }
            ?>
        }
        $("#apenunjangmedisemployee_id_from" + key).val('<?= user()->employee_id; ?>')
        $("#apenunjangmedisdoctor_from" + key).val('<?= user()->getFullname(); ?>')
        $("#apenunjangmedisemployee_id" + key).val('<?= user()->employee_id; ?>')
        $("#apenunjangmedisdoctor" + key).val('<?= user()->getFullname(); ?>')
        $("#penunjangChargesBody")
            .append('<input name="employee_id[]" id="apenunjangmedisemployee_id' + key +
                '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="apenunjangmedisdoctor' + key +
                '" type="hidden" value="<?= @$visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="apenunjangmedisamount' + key + '" type="hidden" value="' + tarifData
                .amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="apenunjangmedisnota_no' + key + '" type="hidden" value="' + nota_no +
                '" class="form-control" />')
            .append('<input name="profesi[]" id="apenunjangmedisprofesi' + key +
                '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="apenunjangmedistagihan' + key + '" type="hidden" value="' + tarifData
                .amount * $("#apenunjangmedisquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="apenunjangmedistreatment_plafond' + key +
                '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="apenunjangmedistarif_type' + key + '" type="hidden" value="' + tarifData
                .tarif_type + '" class="form-control" />')

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {

            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {

                $("#penunjangChargesBody").append('<input name="amount_plafond[]" id="apenunjangmedisamount_plafond' + key +
                    '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#penunjangChargesBody").append(
                    '<input name="amount_paid_plafond[]" id="apenunjangmedisamount_paid_plafond' + key +
                    '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#penunjangChargesBody").append('<input name="class_id_plafond[]" id="apenunjangmedisclass_id_plafond' +
                    key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#penunjangChargesBody").append('<input name="tarif_id_plafond[]" id="apenunjangmedistarif_id_plafond' +
                    key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {

                $("#penunjangChargesBody").append('<input name="amount_plafond[]" id="apenunjangmedisamount_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#penunjangChargesBody").append(
                    '<input name="amount_paid_plafond[]" id="apenunjangmedisamount_paid_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#penunjangChargesBody").append('<input name="class_id_plafond[]" id="apenunjangmedisclass_id_plafond' +
                    key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#penunjangChargesBody").append('<input name="tarif_id_plafond[]" id="apenunjangmedistarif_id_plafond' +
                    key + '" type="hidden" value="" class="form-control" />')
            }
        } else {

            $("#penunjangChargesBody").append('<input name="amount_plafond[]" id="apenunjangmedisamount_plafond' + key +
                '" type="hidden" value="0" class="form-control" />')
            $("#penunjangChargesBody").append('<input name="amount_paid_plafond[]" id="apenunjangmedisamount_paid_plafond' +
                key + '" type="hidden" value="0" class="form-control" />')
            $("#penunjangChargesBody").append('<input name="class_id_plafond[]" id="apenunjangmedisclass_id_plafond' + key +
                '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#penunjangChargesBody").append('<input name="tarif_id_plafond[]" id="apenunjangmedistarif_id_plafond' + key +
                '" type="hidden" value="" class="form-control" />')
        }

        $("#apenunjangmedisquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e
                .keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e
                .keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e
                .keyCode && e.preventDefault();
        });
        $('#apenunjangmedisquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#apenunjangmedisamount_paid" + key).val($("#apenunjangmedisamount" + key).val() * dInput)
            $("#apenunjangmedisdisplayamount_paid" + key).html(formatCurrency($("#apenunjangmedisamount" + key)
                .val() * dInput))
            $("#apenunjangmedistagihan" + key).val($("#apenunjangmedisamount" + key).val() * dInput)
            $("#apenunjangmedisamount_paid_plafond" + key).val($("#apenunjangmedisamount_plafond" + key).val() *
                dInput)
            $("#apenunjangmedisdisplayamount_paid_plafond" + key).html(formatCurrency($(
                "#apenunjangmedisamount_plafond" + key).val() * dInput))
        })
    }

    function filterBillPenunjangMedis() {
        $("#penunjangChargesBody").html("")
        var notaNoPenunjangMedis = $("#notaNoPenunjangMedis").val()
        billJson.forEach((element, key) => {

            if ((billJson[key].clinic_id == 'P001' || billJson[key].clinic_id == 'B019') && (billJson[key]
                    .nota_no == notaNoPenunjangMedis || '%' ==
                    notaNoPenunjangMedis)) {
                var i = $('#penunjangChargesBody tr').length + 1;
                var counter = 'penunjangmedis' + i
                addRowBill("penunjangChargesBody", "apenunjangmedis", key, i, counter)
            }
        })
    }


    const actionModalPenunjangMedis = (bill, identifier) => {
        let data = JSON.parse(decodeURIComponent(bill));


        // $('#template_jenis_pemeriksaan').val([]).trigger('change');
        postData({
            visit_id: data?.visit_id,
            bill_id: data?.bill_id,
            tarif_id: data?.tarif_id,
        }, 'admin/PenunjangMedis/getData', (res) => {
            const imagePreview = $('#imagePreviewPenunjangMedis');
            const pdfPreview = $('#pdfPreviewPenunjangMedis');

            if (res.bound.length > 0) {
                $('#savePenunjangMedis').removeAttr('disabled')

                const exists = res.bound.map(item => {
                    const match = FilterBound.find(f => f.name.trim() === item.description.trim());
                    return match ? {
                        description: item.description.trim(),
                        value: match.value,
                        reagent_id: item.reagent_id
                    } : null;
                }).filter(item => item !== null);

                createInputs({
                    item: exists,
                    data: res?.data
                });
                $('#penunjang_medis_tarif_id').val(data?.tarif_id)
                $('#penunjang_medis_bill_id').val(data?.bill_id)
                $('#penunjang_medis_visit_id').val(data?.visit_id)



                if (res.data.length > 0) {

                    $('#doctor_penunjang').text(res?.data[0]?.doctor)
                    $('#printPenunjangMedis').removeAttr('disabled')
                    $('#modalIsValid_penunjang').val(res?.data[0]?.isvalid ?? 0)
                    $('#modalIsKritis_penunjang').val(res?.data[0]?.iskritis ?? 0)


                    if ($('#modalIsValid_penunjang').val() == 1) {
                        $('#isValidPenunjang').html('Tervalidasi')
                        $('#isValidPenunjang').removeClass('btn-outline-primary');
                        $('#isValidPenunjang').addClass('btn-primary');
                        $('#batalExpertise_penunjang').attr('disabled', true)
                    } else {
                        $('#isValidPenunjang').html('Validasi')
                        $('#isValidPenunjang').removeClass('btn-primary');
                        $('#isValidPenunjang').addClass('btn-outline-primary');
                        $('#batalExpertise_penunjang').removeAttr('disabled')
                    }

                    if ($('#modalIsKritis_penunjang').val() == 1) {
                        $('#isKritisPenunjang').html('Nilai Kritis &#10003;')
                        $('#isKritisPenunjang').removeClass('btn-outline-primary');
                        $('#isKritisPenunjang').addClass('btn-primary');
                    } else {
                        $('#isKritisPenunjang').html('Nilai Kritis')
                        $('#isKritisPenunjang').removeClass('btn-primary');
                        $('#isKritisPenunjang').addClass('btn-outline-primary');
                    }
                } else {

                    $('#doctor_penunjang').text(data?.doctor)
                    $('#printPenunjangMedis').attr('disabled', true)
                    $('#isValidPenunjang').html('Validasi');
                    $('#isValidPenunjang').removeClass('btn-primary');
                    $('#isValidPenunjang').addClass('btn-outline-primary');
                    $('#isKritisPenunjang').html('Nilai Kritis');
                    $('#isKritisPenunjang').removeClass('btn-primary');
                    $('#isKritisPenunjang').addClass('btn-outline-primary');

                    $('#batalExpertise_penunjang').attr('disabled', true)
                }

                renderKop({
                    kop: res?.kop || {}
                })


                $('#printPenunjangMedis').off().on('click', function(e) {
                    let visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'

                    // Construct the URL
                    let url = '<?= base_url() . '/admin/cetak/penunjang_medis/'; ?>' + visitEncoded +
                        '/' +
                        data?.bill_id + '/' + data?.tarif_id;

                    // Redirect to the URL
                    window.open(url, '_blank'); // Open in a new tab
                })


                let fileImageBase64 = res.data[0]?.treat_image_base64;
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


                saveData({
                    bill: bill,
                    identifier: identifier.toLowerCase()
                });

            } else {
                $('#penunjang_medis_tarif_id').val(data?.tarif_id)
                $('#penunjang_medis_bill_id').val(data?.bill_id)
                $('#penunjang_medis_visit_id').val(data?.visit_id)

                const container = document.getElementById('ContainerbodyBound');
                container.innerHTML = ''; // Clear any existing content
                $('#printPenunjangMedis').attr('disabled', true)
                $('#savePenunjangMedis').attr('disabled', true)
                imagePreview.hide();
                pdfPreview.hide();

                $('#isValidPenunjang').html('Validasi');
                $('#isValidPenunjang').removeClass('btn-primary');
                $('#isValidPenunjang').addClass('btn-outline-primary');
                $('#isKritisPenunjang').html('Nilai Kritis');
                $('#isKritisPenunjang').removeClass('btn-primary');
                $('#isKritisPenunjang').addClass('btn-outline-primary');

            }

        });

        $('#batalExpertise_penunjang').off().on('click', function() {
            let formElement = document.getElementById('formModalPenunjang');
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            postData(jsonObj, 'admin/PenunjangMedis/cancelTreatResult', (res) => {
                let data = res.data;
                if (res.status) {
                    successSwal(res.message)
                    $("#modalPenunjangMedis").modal("hide")
                    $(`[data-id="${identifier.toLowerCase()}quantity${res.bill_id}"]`).val(data
                        .quantity)
                    $(`[data-id="${identifier.toLowerCase()}displayamount_paid${res.bill_id}"]`).html(
                        data.amount_paid)

                    getTreatResultListPenunjang(nomor, trans, visit.visit_id)

                } else {
                    errorSwal('data gagal dikembalikan')
                    $("#modalPenunjangMedis").modal("hide")
                }
            });
        });

    };

    const renderKop = (props) => {
        $('.kop-name-penunjangMedis').text(props?.kop.name_of_org_unit || '');
        $('.kop-address-penunjangMedis').html(kop?.contact_address + ',' + kop?.phone + ', Fax:' + kop?.fax + ',' + kop
            ?.kota +
            '<br>' + kop?.sk
        );
    }
    const saveData = (props) => {
        let result = decodeURIComponent(props?.bill)
        $('#savePenunjangMedis').off().on('click', function(e) {
            e.preventDefault();

            let formElement = document.getElementById('formModalPenunjang');
            const data = [];
            $('input[name="bound[]"]:checked').each(function() {
                data.push({
                    id: $(this).data('id'), // Get data-id from the checkbox
                    value: $(this).val() // Value of the checkbox (if applicable)
                });
            });
            $('input[name="bound[]"][type="text"], input[name="bound[]"][type="hidden"]').each(function() {
                const value = $(this).val();
                if (value.trim() !== '') { // Check if the value is not empty
                    data.push({
                        id: $(this).data('id'), // Get data-id (if applicable)
                        value: value
                    });
                }
            });

            let dataSend = new FormData(formElement);
            let jsonObj = {};
            // let bound = dataSend.getAll('bound[]');
            dataSend.delete('bound[]');
            dataSend.append('bound', JSON.stringify(data));

            $.ajax({
                url: '<?php echo base_url(); ?>admin/PenunjangMedis/insertData',
                type: "POST",
                data: dataSend,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    successSwal('Data berhasil disimpan');
                    $("#modalPenunjangMedis").modal("hide")
                    $(`[data-id="${props?.identifier}quantity${data?.bill_id}"]`).val(data
                        ?.treat_bill.quantity)
                    $(`[data-id="${props?.identifier}displayamount_paid${data?.bill_id}"]`).html(
                        data?.treat_bill.amount_paid)

                    getTreatResultListPenunjang(nomor, trans, visit.visit_id)

                },
                error: function() {
                    errorSwal('Data gagal disimpan');
                    $("#modalPenunjangMedis").modal("hide")
                }
            });
        })
    }

    const createInputs = (props) => {
        const container = document.getElementById('ContainerbodyBound');
        container.innerHTML = ''; // Clear any existing content
        let items = props?.item
        let data = props?.data

        if (data[0].clinic_id == 'P016') {
            items.forEach(item => {
                let inputElement;
                if (item.value === 3) {
                    // Create textarea
                    inputElement = `
                    <div class="mb-4 pb-5">
                        <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                        <input type="hidden" name="${item.description !== 'Kesan' ? 'bound[]' : 'conclusion'}" class="quill-hidden-input" id="${item.reagent_id}-hidden" data-id="${item.reagent_id}" value="${item.description !== 'Kesan' ? (data[0].result_value) : (data[0]?.conclusion || '')}">
                        <div class="quill-textarea-penunjang" data-id="${item.reagent_id}" id="${item.reagent_id}">${item.description !== 'Kesan' ? (data[0].result_value) : (data[0]?.conclusion || '')}</div>
                    </div>
                    `;
                }
                container.innerHTML += inputElement;

            });
        } else {
            items.forEach(item => {
                let inputElement;
                let isChecked = data.some(d => d.reagent_id === item.reagent_id);
                let foundData = data.find(d => d.reagent_id === item.reagent_id)

                if (item.value === 1) {
                    // Create checkbox
                    inputElement = `
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="${item.reagent_id}" data-id="${item.reagent_id}" name="bound[]" value="${item.description.replace(/"/g, '')}" ${isChecked ? 'checked' : ''}>
                        <label class="form-check-label" for="${item.reagent_id}">
                            ${item.description}
                        </label>
                    </div>
                </div>
            `;
                } else if (item.value === 2) {

                    // Create text input
                    inputElement = `
                <div class="mb-3 col-6">
                    <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                    <input type="text" class="form-control" name="bound[]" id="${item.reagent_id}" data-id="${item.reagent_id}" placeholder="${item.description}" value="${foundData ? foundData.result_value : ''}">
                </div>
            `;
                } else if (item.value === 3) {
                    // Create textarea
                    inputElement = `
                <div class="mb-4 pb-5">
                    <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                    <input type="hidden" name="${item.description !== 'Kesan' ? 'bound[]' : 'conclusion'}" class="quill-hidden-input" id="${item.reagent_id}-hidden" data-id="${item.reagent_id}" value="${item.description !== 'Kesan' ? (foundData ? foundData.result_value : '') : (data[0]?.conclusion || '')}">
                    <div class="quill-textarea-penunjang" data-id="${item.reagent_id}" id="${item.reagent_id}">${item.description !== 'Kesan' ? (foundData ? foundData.result_value : '') : (data[0]?.conclusion || '')}</div>
                </div>
            `;
                }
                container.innerHTML += inputElement;

            });
        }


        const quillEditor = document.querySelectorAll('.quill-textarea-penunjang');

        quillEditor.forEach(function(editor, index) {
            const quill = new Quill(editor, {
                theme: 'snow',
            });

            const hiddenInput = document.getElementById(`${editor.id}-hidden`);

            quill.on('text-change', () => {
                const quillContent = quill.root
                    .innerHTML; // Get the current content of the Quill editor
                hiddenInput.value = quillContent; // Update the hidden input value
            });
        });

    }

    $('#formFile').on('change', function(event) {
        const file = event.target.files[0];
        const fileNameElement = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreviewPenunjangMedis');
        const pdfPreview = document.getElementById('pdfPreviewPenunjangMedis');
        let isReading = false; // Flag to prevent concurrent reads
        if (file && !isReading) {
            const fileName = file.name;
            const fileType = file.type;

            fileNameElement.textContent = `Selected file: ${fileName}`;
            fileNameElement.style.display = 'block';
            isReading = true; // Set the flag

            const reader = new FileReader();
            reader.onload = function(e) {
                if (fileType.startsWith('image/')) {
                    // Image preview logic
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    pdfPreview.style.display = 'none';
                } else if (fileType === 'application/pdf') {
                    // PDF preview logic
                    pdfPreview.src = e.target.result;
                    pdfPreview.style.display = 'block';
                    imagePreview.style.display = 'none';
                } else {
                    // Unsupported file type
                    fileNameElement.textContent = 'Unsupported file type';
                    imagePreview.style.display = 'none';
                    pdfPreview.style.display = 'none';
                }
            };

            // Read file based on type
            if (fileType.startsWith('image/') || fileType === 'application/pdf') {
                reader.readAsDataURL(file);
            } else if (fileType === 'application/msword' ||
                fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                reader.readAsArrayBuffer(file);
            }

            reader.onloadend = function() {
                isReading = false; // Reset the flag
            };
        } else if (!file) {
            // No file selected
            fileNameElement.style.display = 'none';
            imagePreview.style.display = 'none';
            pdfPreview.style.display = 'none';
        }
    });


    $('#data-allpenunjangmedis').off().on('click', function(e) {
        $("#modalDataAllPenunjangMedis").modal("show");
        postData({
            no_registration: visit?.no_registration,
            trans_id: visit?.trans_id,
            visit_id: visit?.visit_id
        }, 'admin/PenunjangMedis/getDataResultAll', (res) => {
            if (res?.respon === true) {
                renderDataHasilPenunjangMedis({
                    data: res?.result
                })
            } else {
                $("#resultmodalDataAllPenunjangMedis").html(tempTablesNull());
            }
        }, () => {
            getLoadingGlobalServices('resultmodalDataAllPenunjangMedis');
        });

    })


    const renderDataHasilPenunjangMedis = (props) => {
        let result = ""

        props?.data?.map((item, index) => {
            result += `<tr>
                            <td class="text-center align-middle">${index + 1}</td>
                            <td class="text-center align-middle">${item?.treat_date ? moment(item?.treat_date).format("DD/MM/YYYY HH:mm") : item?.treat_date ?? "-"}
                            </td>
                            <td class="text-center align-middle">${item?.nota_no}</td>
                            <td class="text-center align-middle">
                                <p>
                                    ${item?.treatment ? item.treatment.replace(/&nbsp;/g, ' ') : ''}
                                </p>
                                <p class="badge ${item?.isvalid == 1 ? 'bg-primary' : 'bg-danger'} py-1 px-2">
                                    ${item?.isvalid == 1 ? 'TERVALIDASI' : 'BELUM VALIDASI'}
                                </p>
                                <p class="${item?.iskritis == 1 ? 'badge py-1 px-2 mx-2 bg-danger' : 'd-none'}">
                                    KRITIS
                                </p>
                            </td>

                            <td class="text-center align-middle">
                                <div role="group" aria-label="Vertical button group">
                                     <button 
                                            id="apenunjangMedis" 
                                            data-bill="${item?.bill_id}" 
                                            onclick="actionModalPenunjangMedis('${encodeURIComponent(JSON.stringify(item))}', 'apenunjangMedis')" 
                                            type="button" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalPenunjangMedis" 
                                            class="btn btn-outline-primary waves-effect waves-light" 
                                            data-row-id="1" 
                                            autocomplete="off"
                                        >
                                        Hasil
                                    </button>
                                </div>
                            </td>

                            
                        </tr>`
        });

        $("#resultmodalDataAllPenunjangMedis").html(result);


        if (props?.data.length === 0) {
            $("#resultmodalDataAllPenunjangMedis").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`);
        }
    }
</script>