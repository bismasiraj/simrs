<script type='text/javascript'>
    // (function() {
    $(document).ready(function(e) {
        declareSearchTarifPatologi()
        initializeSearchTemplateExpertise("template_patologi", "modalPatologi");
        $('#template_patologi').on("select2:select", function(e) {
            const selectedData = e.params.data;

            $('#patologi_mikroskopik').val(selectedData.hasil_baca)
            $('#patologi_conclusion').val(selectedData.kesimpulan)
        });

        const quillEditor = document.querySelectorAll('.quill-patologi');

        quillEditor.forEach(function(editor, index) {
            const quill = new Quill(editor, {
                theme: 'snow',
            });
        });
    })
    const declareSearchTarifPatologi = () => {
        initializeSearchTarif("searchTarifPatologi", 'PATOLOGI');
        $("#searchTarifPatologi").on('select2:select', function(e) {
            $("#searchTarifPatologiBtn").click();
            $("#searchTarifPatologi").focus()
            $('html,body').animate({
                    scrollTop: $("#searchTarifPatologi").offset().top - 50
                },
                'slow', 'swing');
            $("#searchTarifPatologi").click()
            $("#searchTarifPatologi").select2('open')
        });
    }
    $("#patologiTab").on("click", function() {
        $('#notaNoPatologi').html(`<option value="%">Semua</option>`)

        getTreatResultListPatologi(nomor, trans, visit.visit_id)
        let data_bill = getBillPoli(nomor, ke, mulai, akhir, lunas, 'P023', rj, status, nota, trans)
    })
    $("#formSaveBillPatologiBtn").on("click", function() {
        $("#patologiBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
    $("#notaNoPatologi").off().on("click", function() {
        filterBillPatologi()
    })


    $('#isKritisPatologi').click(function(e) {
        const currentValue = $('#modalIsKritis_patologi').val();

        $('#modalIsKritis_patologi').val(currentValue == 0 ? 1 : 0);

        if ($('#modalIsKritis_patologi').val() == 1) {
            $('#isKritisPatologi').html('Nilai Kritis &#10003;')
            $('#isKritisPatologi').removeClass('btn-outline-primary');
            $('#isKritisPatologi').addClass('btn-primary');
        } else {
            $('#isKritisPatologi').html('Nilai Kritis')
            $('#isKritisPatologi').removeClass('btn-primary');
            $('#isKritisPatologi').addClass('btn-outline-primary');
        }
    })
    $('#isValidPatologi').click(function(e) {
        const currentValue = $('#modalIsValid_patologi').val();

        $('#modalIsValid_patologi').val(currentValue == 0 ? 1 : 0);


        if ($('#modalIsValid_patologi').val() == 1) {
            $('#isValidPatologi').html('Tervalidasi')
            $('#isValidPatologi').removeClass('btn-outline-primary');
            $('#isValidPatologi').addClass('btn-primary');
        } else {
            $('#isValidPatologi').html('Validasi')
            $('#isValidPatologi').removeClass('btn-primary');
            $('#isValidPatologi').addClass('btn-outline-primary');
        }
    })

    function getTreatResultListPatologi(nomor, trans, visit_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/Patologi/getDataResult',
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
                $("#patologiBody").html(loadingScreen())
            },
            processData: false,
            success: function(res) {
                $("#patologiBody").html("")
                let dataPatologi = res?.result
                dataPatologi.forEach((element, key) => {
                    $("#patologiBody").append($("<tr>")
                        .append($("<td >").append($("<p>").html(dataPatologi[key].nota_no)))
                        .append($("<td >").append($("<p>").html(moment(dataPatologi[key].treat_date).format('DD-MM-YYYY HH:MM'))))
                        .append($("<td class='text-center'>").append($("<p>").html(dataPatologi[key].treatment))
                            .append($("<p class='badge " + (dataPatologi[key].isvalid == 1 ? "bg-primary" : "bg-danger") + " py-1 px-2'>").html(dataPatologi[key].isvalid == 1 ? 'TERVALIDASI' : 'BELUM VALIDASI'))
                            .append($("<p class='" + (dataPatologi[key].iskritis == 1 ? "badge py-1 px-2 mx-2 bg-danger" : "d-none") + "'>").html('KRITIS'))
                        )
                        .append($("<td>").append('<div role="group" aria-label="Vertical button group">' +
                            '<button id="' + 'apatologi' + '" ' + 'data-bill="' + dataPatologi[key].bill_id + '" ' + 'onclick="actionModalPatologi(\'' + encodeURIComponent(JSON.stringify(dataPatologi[key])) + '\',\'' + 'apatologi' + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalPatologi" ' + 'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            '>Hasil</button>'))
                    )
                });
            },
            error: function() {

            }
        });
    }


    function addBillPatologi(container) {
        let sesi = '<?= @$visit['session_id']; ?>';

        // if (nota_no == '%') {
        //     $("#notaNoPatologi").find(`option[value='${sesi}']`).remove()
        //     nota_no = sesi
        //     $("#notaNoPatologi").append($("<option>").val(nota_no).text(nota_no))
        //     $("#notaNoPatologi").val(nota_no)
        //     $("#patologiChargesBody").html("")
        // }

        var nota_no = $("#notaNoPatologi").val();

        if (nota_no == '%') {
            nota_no = get_bodyid()
            $("#notaNoPatologi").append($("<option>").val(nota_no).text(nota_no))
            $("#notaNoPatologi").val(nota_no)
            $("#patologiChargesBody").html("")
        }

        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        var i = $('#patologiChargesBody tr').length + 1;
        var key = 'patologi' + i
        $("#patologiChargesBody").append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(i) + "."))
            .append($("<td>").attr("id", "apatologidisplaytreatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= @@$visit['fullname']; ?>')))
            .append($("<td>").html('<select id="apatologiemployee_id' + key + '" class="form-select" name="employee_id[]" onchange="changeFullnameDoctor(\'apatologi\',\'' + key + '\')">' +
                chargesDropdownDoctor() +
                `</select>` +
                '<input id="apatologidoctor' + key + '" class="form-control" style="display: none" type="text" readonly>'
            ))
            .append($("<td>").attr("id", "apatologidisplaytreat_date" + key).html(moment().format("DD/MM/YYYY HH:mm")).append($("<p>").html('<?= @$visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "apatologidisplaysell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="apatologiquantity' + key + '" placeholder="" value="0" class="form-control" readonly>')
                .append($("<p>").html('<?= @$visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "apatologidisplayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>")
                .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<button id="apatologisimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'apatologi\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                    '<button id="apatologieditDeleteCharge' + key + '" type="button" onclick="editBillCharge(\'apatologi\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off"  style="display: none">Edit</button>' +
                    '<button id="delBillBtn' + key + '" type="button" onclick="delBill(\'apatologi\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                    '</div>' +
                    '</div>')
            )
        )


        $("#patologiChargesBody")
            .append('<input type="hidden" name="quantity[]" id="apatologiquantity' + key + '" placeholder="" value="0" class="form-control" >')
            .append('<input name="treatment[]" id="apatologitreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="apatologitreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="apatologisell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="apatologiamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="apatologidiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="apatologisubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="apatologisubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="apatologibill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="apatologitrans_id' + key + '" type="hidden" value="<?= @$visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="apatologino_registration' + key + '" type="hidden" value="<?= @$visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="apatologitheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="apatologivisit_id' + key + '" type="hidden" value="<?= @$visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="apatologiorg_unit_code' + key + '" type="hidden" value="<?= @$visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="apatologiclass_id' + key + '" type="hidden" value="<?= @$visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="apatologiclass_id_plafond' + key + '" type="hidden" value="<?= @$visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="apatologipayor_id' + key + '" type="hidden" value="<?= @$visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="apatologikaryawan' + key + '" type="hidden" value="<?= @$visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="apatologitheid' + key + '" type="hidden" value="<?= @$visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="apatologithename' + key + '" type="hidden" value="<?= @$visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="apatologitheaddress' + key + '" type="hidden" value="<?= @$visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="apatologistatus_pasien_id' + key + '" type="hidden" value="<?= @$visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isrj[]" id="apatologiisrj' + key + '" type="hidden" value="<?= @$visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="apatologigender' + key + '" type="hidden" value="<?= @$visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="apatologiageyear' + key + '" type="hidden" value="<?= @$visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="apatologiagemonth' + key + '" type="hidden" value="<?= @$visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="apatologiageday' + key + '" type="hidden" value="<?= @$visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="apatologikal_id' + key + '" type="hidden" value="<?= @$visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="apatologikaryawan' + key + '" type="hidden" value="<?= @$visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="apatologiclass_room_id' + key + '" type="hidden" value="<?= @$visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="apatologibed_id' + key + '" type="hidden" value="<?= @$visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="apatologiclinic_id' + key + '" type="hidden" value="P023" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="apatologiclinic_id_from' + key + '" type="hidden" value="<?= @$visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="apatologiexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="apatologicashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="apatologimodified_from' + key + '" type="hidden" value="<?= @$visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="apatologiislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="apatologimeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="apatologitarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            .append('<input name="body_id[]" id="apatologibody_id' + key + '" type="hidden" value="' + sesi + '" class="form-control" />')

        if ('<?= @$visit['isrj']; ?>' == '0') {
            $("#aclass_room_id" + key).val('<?= @$visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= @$visit['bed_id']; ?>');
            <?php
            if (!is_null(@$visit['employee_id_from']) && @$visit['employee_id_from'] != '') {

            ?>
                $("#patologiChargesBody")
                    .append('<input name="employee_id_from[]" id="apatologiemployee_id_from' + key + '" type="hidden" value="<?= @$visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apatologidoctor_from' + key + '" type="hidden" value="<?= @$visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {

            ?>
                $("#patologiChargesBody")
                    .append('<input name="employee_id_from[]" id="apatologiemployee_id_from' + key + '" type="hidden" value="<?= @$visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apatologidoctor_from' + key + '" type="hidden" value="<?= @$visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }

            ?>
        } else {
            <?php
            if (!is_null(@$visit['employee_id_from']) && @$visit['employee_id_from'] != '') {

            ?>
                $("#patologiChargesBody")
                    .append('<input name="employee_id_from[]" id="apatologiemployee_id_from' + key + '" type="hidden" value="<?= @$visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apatologidoctor_from' + key + '" type="hidden" value="<?= @$visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {

            ?>
                $("#patologiChargesBody")
                    .append('<input name="employee_id_from[]" id="apatologiemployee_id_from' + key + '" type="hidden" value="<?= @$visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="apatologidoctor_from' + key + '" type="hidden" value="<?= @@$visit['fullname']; ?>" class="form-control" />')

            <?php
            }

            ?>
        }
        $("#arademployee_id_from" + key).val('<?= user()->employee_id; ?>')
        $("#araddoctor_from" + key).val('<?= user()->getFullname(); ?>')
        $("#arademployee_id" + key).val('<?= user()->employee_id; ?>')
        $("#araddoctor" + key).val('<?= user()->getFullname(); ?>')
        $("#patologiChargesBody")
            .append('<input name="employee_id[]" id="apatologiemployee_id' + key + '" type="hidden" value="<?= @$visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="apatologidoctor' + key + '" type="hidden" value="<?= @@$visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="apatologiamount' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="apatologinota_no' + key + '" type="hidden" value="' + nota_no + '" class="form-control" />')
            .append('<input name="profesi[]" id="apatologiprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="apatologitagihan' + key + '" type="hidden" value="' + tarifData.amount * $("#apatologiquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="apatologitreatment_plafond' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="apatologitarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type + '" class="form-control" />')

        if ('<?= @$visit['class_id']; ?>' != '<?= @$visit['class_id_plafond']; ?>') {

            var tarifKelas = getPlafond('<?= @$visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= @$visit['payor_id']; ?>' != 0 && '<?= @$visit['class_id_plafond']; ?>' != 99) {

                $("#patologiChargesBody").append('<input name="amount_plafond[]" id="apatologiamount_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#patologiChargesBody").append('<input name="amount_paid_plafond[]" id="apatologiamount_paid_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#patologiChargesBody").append('<input name="class_id_plafond[]" id="apatologiclass_id_plafond' + key + '" type="hidden" value="<?= @$visit['class_id_plafond']; ?>" class="form-control" />')
                $("#patologiChargesBody").append('<input name="tarif_id_plafond[]" id="apatologitarif_id_plafond' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {

                $("#patologiChargesBody").append('<input name="amount_plafond[]" id="apatologiamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#patologiChargesBody").append('<input name="amount_paid_plafond[]" id="apatologiamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#patologiChargesBody").append('<input name="class_id_plafond[]" id="apatologiclass_id_plafond' + key + '" type="hidden" value="<?= @$visit['class_id_plafond']; ?>" class="form-control" />')
                $("#patologiChargesBody").append('<input name="tarif_id_plafond[]" id="apatologitarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
            }
        } else {

            $("#patologiChargesBody").append('<input name="amount_plafond[]" id="apatologiamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#patologiChargesBody").append('<input name="amount_paid_plafond[]" id="apatologiamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#patologiChargesBody").append('<input name="class_id_plafond[]" id="apatologiclass_id_plafond' + key + '" type="hidden" value="<?= @$visit['class_id_plafond']; ?>" class="form-control" />')
            $("#patologiChargesBody").append('<input name="tarif_id_plafond[]" id="apatologitarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
        }

        $("#apatologiquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#apatologiquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#apatologiamount_paid" + key).val($("#apatologiamount" + key).val() * dInput)
            $("#apatologidisplayamount_paid" + key).html(formatCurrency($("#apatologiamount" + key).val() * dInput))
            $("#apatologitagihan" + key).val($("#apatologiamount" + key).val() * dInput)
            $("#apatologiamount_paid_plafond" + key).val($("#apatologiamount_plafond" + key).val() * dInput)
            $("#apatologidisplayamount_paid_plafond" + key).html(formatCurrency($("#apatologiamount_plafond" + key).val() * dInput))
        })
    }

    const filterBillPatologi = () => {
        $("#patologiChargesBody").html("")
        var notaNoPatologi = $("#notaNoPatologi").val()
        console.log(billJson);
        billJson.forEach((element, key) => {
            if (billJson[key].clinic_id == 'P023' && (billJson[key].nota_no == notaNoPatologi || '%' == notaNoPatologi)) {
                var i = $('#patologiChargesBody tr').length + 1;
                var counter = 'patologi' + i
                addRowBill("patologiChargesBody", "apatologi", key, i, counter)
            }
        })
    }


    const actionModalPatologi = (bill, identifier) => {
        let data = JSON.parse(decodeURIComponent(bill));
        $('#template_jenis_pemeriksaan').val([]).trigger('change');
        postData({
            visit_id: data?.visit_id,
            bill_id: data?.bill_id,
            tarif_id: data?.tarif_id,
        }, 'admin/Patologi/getData', (res) => {
            const imagePreview = $('#imagePreviewPatologi');
            const pdfPreview = $('#pdfPreviewPatologi');

            $('#patologi_tarif_name').val(data?.treatment)
            $('#patologi_tarif_id').val(data?.tarif_id)
            $('#patologi_bill_id').val(data?.bill_id)
            $('#patologi_visit_id').val(data?.visit_id)

            const select = document.getElementById('template_patologi');
            select.remove(select.selectedIndex);

            if (Object.keys(res?.data).length > 0 && !Object.values(res?.data).every(value => value === null || value === "")) {
                $('#patologi_no_sampel').val(res?.data?.specimen_id)
                $('#patologi_diagnosa_klinis').val(res?.data.description)
                $('#patologi_asal_jaringan').val(res?.data?.desc_english)
                $('#patologi_makroskopik').val(res?.data?.result_english)
                $('#patologi_mikroskopik').val(res?.data?.result_value)
                $('#patologi_conclusion').val(res?.data?.conclusion)


                let fileImageBase64 = res.data?.treat_image_base64;
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

                $('#printPatologi').removeAttr('disabled')
                console.log(res?.data);
                $('#doctor_patologi').text(res?.data?.doctor)
                $('#modalIsValid_patologi').val(res?.data?.isvalid ?? 0)
                $('#modalIsKritis_patologi').val(res?.data?.iskritis ?? 0)


                if ($('#modalIsValid_patologi').val() == 1) {
                    $('#isValidPatologi').html('Tervalidasi')
                    $('#isValidPatologi').removeClass('btn-outline-primary');
                    $('#isValidPatologi').addClass('btn-primary');
                } else {
                    $('#isValidPatologi').html('Validasi')
                    $('#isValidPatologi').removeClass('btn-primary');
                    $('#isValidPatologi').addClass('btn-outline-primary');
                }

                if ($('#modalIsKritis_patologi').val() == 1) {
                    $('#isKritisPatologi').html('Nilai Kritis &#10003;')
                    $('#isKritisPatologi').removeClass('btn-outline-primary');
                    $('#isKritisPatologi').addClass('btn-primary');
                } else {
                    $('#isKritisPatologi').html('Nilai Kritis')
                    $('#isKritisPatologi').removeClass('btn-primary');
                    $('#isKritisPatologi').addClass('btn-outline-primary');
                }

                printPatologi({
                    bill_id: data?.bill_id,
                    tarif_id: data?.tarif_id
                })
            } else {
                $('#formModalPatologi')[0].reset();
                $('#printPatologi').attr('disabled', true)
                $('#patologi_tarif_id').val(data?.tarif_id)
                $('#patologi_bill_id').val(data?.bill_id)
                $('#patologi_visit_id').val(data?.visit_id)
                console.log(data?.doctor);
                $('#doctor_patologi').text(data?.doctor)
                $('#isValidPatologi').html('Validasi');
                $('#isValidPatologi').removeClass('btn-primary');
                $('#isValidPatologi').addClass('btn-outline-primary');
                $('#isKritisPatologi').html('Nilai Kritis');
                $('#isKritisPatologi').removeClass('btn-primary');
                $('#isKritisPatologi').addClass('btn-outline-primary');

                imagePreview.hide();
                pdfPreview.hide();
            }


            renderKopPatologi({
                kop: res?.kop || {}
            })


            savePatologi();
            changeFilePatologi()


        });



    };

    const renderKopPatologi = (props) => {
        $('.kop-name-patologi').text(props?.kop.name_of_org_unit || '');
        $('.kop-address-patologi').text(props?.kop.contact_address || '');
    }


    const savePatologi = () => {
        $('#savePatologi').off().on('click', function(e) {
            e.preventDefault();

            let formElement = document.getElementById('formModalPatologi');


            let dataSend = new FormData(formElement);

            $.ajax({
                url: '<?php echo base_url(); ?>admin/Patologi/insertData',
                type: "POST",
                data: dataSend,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    successSwal('Data berhasil disimpan');
                    // $("#modalPatologi").modal("hide")

                },
                error: function() {
                    errorSwal('Data gagal disimpan');
                    // $("#modalPatologi").modal("hide")
                }
            });
        })
    }

    const changeFilePatologi = () => {
        $('#formFilePatologi').on('change', function(event) {
            const file = event.target.files[0];
            const fileNameElement = document.getElementById('fileNamePatologi');
            const imagePreview = document.getElementById('imagePreviewPatologi');
            const pdfPreview = document.getElementById('pdfPreviewPatologi');

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
    }

    const printPatologi = (props) => {
        $('#printPatologi').off().on('click', function(e) {
            let visitEncoded = '<?= base64_encode(json_encode(@$visit)); ?>'

            // Construct the URL
            let url = '<?= base_url() . '/admin/cetak/patologi/'; ?>' + visitEncoded + '/' +
                props?.bill_id + '/' + props?.tarif_id;
            openPopUpTab(url)
            // Redirect to the URL
        })
    }

    // })()
</script>