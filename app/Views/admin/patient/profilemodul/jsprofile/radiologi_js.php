<script type='text/javascript'>
    $(document).ready(function(e) {
        // getListRequestRad(nomor, visit)
        initializeSearchTarif("searchTarifRad", 'P016');
        initializeSearchDokterRad("template_nama_dokter");
        initializeSearchTemplateExpertise("template_expertise", "modalExpertise");
        $("#template_jenis_pemeriksaan").select2({
            theme: "bootstrap-5",
            tags: true
        });

        // $("#template_jenis_pemeriksaan").val('usg').trigger('change'); //default selected
        $('#template_expertise').on("select2:select", function(e) {
            const selectedData = e.params.data;

            $('#modalHasilBaca').val(selectedData.hasil_baca)
            $('#modalKesimpulan').val(selectedData.kesimpulan)
        });

        $('#isKritisExpertise').click(function(e) {
            const currentValue = $('#modalIsKritis').val();

            $('#modalIsKritis').val(currentValue == 0 ? 1 : 0);
        })
        $('#isValidExpertise').click(function(e) {
            const currentValue = $('#modalIsValid').val();

            $('#modalIsValid').val(currentValue == 0 ? 1 : 0);
        })

    })
    $("#radTab").on("click", function() {
        $('#notaNoRad').html(`<option value="%">Semua</option>`)

        getTreatResultList(nomor, visit)
        getListRequestRad(nomor, visit)
        getBillPoli(nomor, ke, mulai, akhir, lunas, 'P016', rj, status, nota, trans)
        // var seen = {};
        // $('#notaNoRad option').each(function() {
        //     if (seen[$(this).val()]) {
        //         $(this).remove();
        //     } else {
        //         seen[$(this).val()] = true;
        //     }
        // });
    })
    $("#formSaveBillRadBtn").on("click", function() {
        $("#radChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
    })
    $("#notaNoRad").on("change", function() {
        filterBillRad()
    })

    $("#btn_cari_template_rad").off().on("click", function(e) {
        e.preventDefault();
        getDataTemplate();

    });
</script>
<script type='text/javascript'>
    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    function getTreatResultList(nomor, visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getTreatResultList',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'visit': visit,
                'clinic_id': 'P016'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            beforeSend: function() {
                $("#radBody").html(loadingScreen())
            },
            processData: false,
            success: function(data) {
                $("#radBody").html("")
                mrJson = data
                console.log(mrJson);
                mrJson.forEach((element, key) => {

                    $("#radBody").append($("<tr>")
                        .append($("<td >").append($("<p>").html(mrJson[key].pickup_date)))
                        .append($("<td class='text-center'>")
                            .append($("<p>").html(mrJson[key].tarif_name))
                            .append($("<p class='badge " + (mrJson[key].isvalid == 1 ? "bg-primary" : "bg-danger") + " py-1 px-2'>").html(mrJson[key].isvalid == 1 ? 'TERVALIDASI' : 'BELUM VALIDASI'))
                            .append($("<p class='" + (mrJson[key].iskritis == 1 ? "badge py-1 px-2 mx-2 bg-danger" : "d-none") + "'>").html('KRITIS'))
                        )

                        // .append($("<td>").html('<?= $visit['name_of_clinic']; ?>'))
                        .append($("<td>").append('<div role="group" aria-label="Vertical button group">' +
                            '<button id="' + 'arad' + 'expertise' + '" ' + 'data-bill="' + mrJson[key].bill_id + '" ' + 'onclick="actionModalExpertise(\'' + encodeURIComponent(JSON.stringify(mrJson[key])) + '\',\'' + 'arad' + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalExpertise" ' + 'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            '>Hasil</button>'))
                    )

                });
            },
            error: function() {

            }
        });
    }

    function getListRequestRad(nomor, visit) {


        // $.ajax({
        //     url: '<?php echo base_url(); ?>admin/rekammedis/getListRequestRad',
        //     type: "POST",
        //     data: JSON.stringify({
        //         'nomor': nomor,
        //         'visit': visit
        //     }),
        //     dataType: 'json',
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(data) {


        //         hasilradJson = data

        //         $("#listRequestRad").html("")


        //         hasilradJson.forEach((element, key) => {
        //             console.log(element)
        //             $("#listRequestRad").append('<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa Radiologi </h3> <p> Tanggal ' + element.vactination_date + ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getRadOnlineRequest/' + btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id + '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
        //         });
        //     },
        //     error: function() {

        //     }
        // });
    }

    function requestRad() {
        url = '<?php echo base_url(); ?>admin/rekammedis/radOnlineRequest/' + btoa('<?= json_encode($visit); ?>')

        window.open(url, "_blank")
    }

    function addBillRad(container) {
        var nota_no = $("#notaNoRad").val();

        if (nota_no == '%') {
            nota_no = get_bodyid()
            $("#notaNoRad").append($("<option>").val(nota_no).text(nota_no))
            $("#notaNoRad").val(nota_no)
            $("#radChargesBody").html("")
        }

        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        var i = $('#radChargesBody tr').length + 1;
        var key = 'rad' + i
        $("#radChargesBody").append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(i) + "."))
            .append($("<td>").attr("id", "araddisplaytreatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= $visit['fullname']; ?>')))
            .append($("<td>").html('<select id="arademployee_id' + key + '" class="form-select" name="employee_id[]" onchange="changeFullnameDoctor(\'arad\',\'' + key + '\')">' +
                chargesDropdownDoctor() +
                `</select>` +
                '<input id="araddoctor' + key + '" class="form-control" style="display: none" type="text" readonly>'
            ))
            .append($("<td>").attr("id", "araddisplaytreat_date" + key).html(moment().format("DD/MM/YYYY HH:mm")).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "araddisplaysell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="aradquantity' + key + '" placeholder="" value="0" class="form-control" readonly>')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "araddisplayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "araddisplayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            // .append($("<td>").attr("id", "araddisplayamount_paid_plafond" + key).html(formatCurrency(0)))
            // .append($("<td>").attr("id", "araddisplaydiscount" + key).html(formatCurrency(0)))
            // .append($("<td>").attr("id", "araddisplaysubsidisat" + key).html(formatCurrency(0)))
            // .append($("<td>").attr("id", "araddisplaysubsidi" + key).html(formatCurrency(0)))
            // .append($("<td>").append('<button id="aradsimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'arad\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">Simpan</button><div id="aradeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-radel="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-radel="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'arad\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'arad\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
            .append($("<td>")
                .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                    '<button id="aradsimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'arad\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                    '<button id="aradeditDeleteCharge' + key + '" type="button" onclick="editBillCharge(\'arad\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off"  style="display: none">Edit</button>' +
                    '<button id="delBillBtn' + key + '" type="button" onclick="delBill(\'arad\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                    '</div>' +
                    '</div>')
            )
        )


        $("#radChargesBody")
            .append('<input type="hidden" name="quantity[]" id="aradquantity' + key + '" placeholder="" value="0" class="form-control" >')
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
            .append('<input name="isrj[]" id="aradisrj' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
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
            .append('<input name="nota_no[]" id="aradnota_no' + key + '" type="hidden" value="' + nota_no + '" class="form-control" />')
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
<script>
    function filterBillRad() {
        $("#radChargesBody").html("")
        var notaNoRad = $("#notaNoRad").val()
        billJson.forEach((element, key) => {
            if (billJson[key].clinic_id == 'P016' && (billJson[key].nota_no == notaNoRad || '%' == notaNoRad)) {
                var i = $('#radChargesBody tr').length + 1;
                var counter = 'rad' + i
                addRowBill("radChargesBody", "arad", key, i, counter)
            }
        })
    }
</script>

<!-- ================================== -->

<script>
    $("#searchEXP").off().on("click", function() {
        const start = moment($("#startDateEXP").val()).format("YYYY-MM-DD") + " 00:00:01";
        const end = moment($("#endDateEXP").val()).format("YYYY-MM-DD") + " 23:59:59";
        const visit_id = <?= json_encode($visit['visit_id']); ?>;
        getDataBillEXP({
            visit_id: visit_id,
            startDate: start,
            endDate: end
        })
    });



    const getDataBillEXP = (props) => {
        const visit_id = props?.visit_id;
        const startDate = props?.startDate;
        const endDate = props?.endDate;

        if (!visit_id) {
            console.error('Visit ID provided.');
            return;
        }

        const requestData = {
            visit_id: visit_id,
        };

        if (startDate && endDate) {
            requestData.startDate = startDate;
            requestData.endDate = endDate;
        }

        postData(requestData, 'admin/radRequest/getData', (res) => {
            if (res && res.value) {
                const {
                    inspection,
                    expertise
                } = res.value;


                inspectionEXP = inspection || [];
                detailsDataEXPEXP = expertise || [];

                populateExaminationTableEXP();
                populateDetailsTableEXP();
            } else {
                console.error('Response data is missing expected properties.');
            }
        }, (beforesend) => {
            // getLoadingGlobalServices('examinationTableEXP tbody')
            // getLoadingGlobalServices('detailsTableEXP tbody')
            // $("#bodydata").html(loadingScreen())
        });
    }



    const actionModalExpertise = (bill, identifier) => {
        let data = JSON.parse(decodeURIComponent(bill));

        jsonObj = {};

        jsonObj.bill_id = data?.bill_id
        jsonObj.visit_id = data?.visit_id
        $('#template_jenis_pemeriksaan').val([]).trigger('change');


        postData(jsonObj, 'admin/radRequest/getDataByID', (res) => {

            if (res.respon) {
                $('#modalJenisTindakan').text(data.tarif_name + ' (' + data.doctor + ')')
                $('#modalTanggalTindakan').text(moment(data.treat_date).format('LL'))
                $('#modalNilaiTindakan').text(data.tagihan)
                $('#modalBill').val(data.bill_id)
                $('#modalVisit').val(data.visit_id)
                $('#modalNoFilm').val(res.data.specimen_id)
                $('#modalHasilBaca').val(res.data.result_value)
                $('#modalKesimpulan').val(res.data.conclusion)
                $('#modalIsValid').val(res.data.isvalid)
                $('#printExpertise').attr('data-id', res?.data?.result_id)
                if ($('#modalIsValid').val() == '1') {
                    $('#isValidExpertise').html('Tervalidasi');
                    $('#isValidExpertise').removeClass('btn-outline-primary');
                    $('#isValidExpertise').addClass('btn-primary');
                    $('#batalExpertise').attr('disabled', true)
                } else {
                    $('#isValidExpertise').html('Validasi');
                    $('#isValidExpertise').removeClass('btn-primary');
                    $('#isValidExpertise').addClass('btn-outline-primary');
                    $('#batalExpertise').attr('disabled', false)
                }
                $('#modalIsKritis').val(res.data.iskritis)
                if ($('#modalIsKritis').val() == '1') {
                    $('#isKritisExpertise').html('Nilai Kritis &#10003;');
                    $('#isKritisExpertise').removeClass('btn-outline-primary');
                    $('#isKritisExpertise').addClass('btn-primary');
                } else {
                    $('#isKritisExpertise').html('Nilai Kritis');
                    $('#isKritisExpertise').removeClass('btn-primary');
                    $('#isKritisExpertise').addClass('btn-outline-primary');
                }
                if (res.data.treat_image != null) {
                    const fileName = res.data.treat_image.split(/[/\\]/).pop();
                    // $('#formFileExpertise').val(fileName)
                    let base_url = <?= json_encode(base_url()); ?>;

                    $('#imagePreviewExpertise').attr('src', base_url + res.data.treat_image).show();

                    $('#imagePreviewExpertise').off().on('click', function(e) {
                        e.preventDefault();
                        let url = '<?= base_url() . '/admin/Cetak/imagePreview'; ?>' + '/' + data?.bill_id
                        window.open(url, '_blank');

                    })
                } else {
                    $('#imagePreviewExpertise').attr('src', '').hide();
                }
            } else {
                $('#modalJenisTindakan').text(data.treatment + ' (' + data.doctor + ')')
                $('#modalTanggalTindakan').text(moment(data.treat_date).format('LL'))
                $('#modalNilaiTindakan').text(data.tagihan)
                $('#modalBill').val(data.bill_id)
                $('#modalVisit').val(data.visit_id)
                $('#imagePreviewExpertise').attr('src', '').hide();
                $('#isValidExpertise').html('Validasi');
                $('#isValidExpertise').removeClass('btn-primary');
                $('#isValidExpertise').addClass('btn-outline-primary');
                $('#isKritisExpertise').html('Nilai Kritis');
                $('#isKritisExpertise').removeClass('btn-primary');
                $('#isKritisExpertise').addClass('btn-outline-primary');
                $('#batalExpertise').attr('disabled', true)
                resetForm();
            }

        });


        function resetForm() {
            $('#modalNoFilm').val('');
            $('#modalHasilBaca').val('');
            $('#modalKesimpulan').val('');
            $('#formFileExpertise').val('')
            $('#modalIsValid').val(0)
            $('#modalIsKritis').val(0)
            $('#printExpertise').attr('data-id', '')
        }

        $('#printExpertise').off().on('click', function(e) {
            e.preventDefault();

            let visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'

            // Construct the URL
            let url = '<?= base_url() . '/admin/rm/LAINNYA/radiologi_cetak/'; ?>' + visitEncoded + '/' +
                $(this).data('id');

            // Redirect to the URL
            window.open(url, '_blank'); // Open in a new tab
        })

        // $('#formExpertise').off('submit').on('submit', e => {
        //     e.preventDefault();
        //     let formExpertise = document.querySelector('#formExpertise');
        //     let formData = new FormData(formExpertise)

        //     $.ajax({
        //         url: '<?php echo base_url(); ?>admin/radRequest/insertExpertise',
        //         type: "POST",
        //         data: formData,
        //         dataType: 'json',
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         success: function(data) {
        //             successSwal('Data berhasil disimpan');
        //             $("#modalExpertise").modal("hide")
        //             $(`[data-id="${identifier}quantity${data.bill_id}"]`).val(data.treat_bill.quantity)
        //             $(`[data-id="${identifier}displayamount_paid${data.bill_id}"]`).html(data.treat_bill.amount_paid)
        //             // $(`#${identifier}quantity${data.treat_bill.bill_id}`).val(data.treat_bill.quantity)
        //             // $(`#${identifier}displayamount_paid${data.treat_bill.bill_id}`).val(data.treat_bill.amount_paid)
        //         },
        //         error: function() {
        //             errorSwal('Data gagal disimpan');
        //             $("#modalExpertise").modal("hide")
        //         }
        //     });
        // });

        $('#saveExpertise').off().on('click', function(e) {
            e.preventDefault();
            let formExpertise = document.querySelector('#formExpertise');
            let formData = new FormData(formExpertise)

            $.ajax({
                url: '<?php echo base_url(); ?>admin/radRequest/insertExpertise',
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    successSwal('Data berhasil disimpan');
                    $("#modalExpertise").modal("hide")
                    $(`[data-id="${identifier}quantity${data.bill_id}"]`).val(data.treat_bill.quantity)
                    $(`[data-id="${identifier}displayamount_paid${data.bill_id}"]`).html(data.treat_bill.amount_paid)
                    // $(`#${identifier}quantity${data.treat_bill.bill_id}`).val(data.treat_bill.quantity)
                    // $(`#${identifier}displayamount_paid${data.treat_bill.bill_id}`).val(data.treat_bill.amount_paid)
                },
                error: function() {
                    errorSwal('Data gagal disimpan');
                    $("#modalExpertise").modal("hide")
                }
            });
        });

        $('#batalExpertise').off().on('click', function() {
            let formElement = document.getElementById('formExpertise');
            let dataSend = new FormData(formElement);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            postData(jsonObj, 'admin/radRequest/cancelExpertise', (res) => {
                let data = res.data;
                if (res.status) {
                    successSwal(res.message)
                    $("#modalExpertise").modal("hide")
                    $(`[data-id="${identifier}quantity${res.bill_id}"]`).val(data.quantity)
                    $(`[data-id="${identifier}displayamount_paid${res.bill_id}"]`).html(data.amount_paid)
                } else {
                    errorSwal('data gagal dikembalikan')
                    $("#modalExpertise").modal("hide")
                }
            });
        });
    };


    document.getElementById('formFileExpertise').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('imagePreviewExpertise');
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                errorSwal('mohon mengirimkan berkas dengan format gambar.');
                event.target.value = '';
            }
        }
    });

    const getDataTemplate = () => {
        let formElement = document.getElementById('form-template-rad');
        let dataSend = new FormData(formElement);
        let jsonObj = {};

        dataSend.forEach((value, key) => {
            jsonObj[key] = value;
        });

        postData(jsonObj, 'admin/radRequest/getDataTemplate', (res) => {
            if (res.respon) {

                let data = res.data;
                const table = $('#tableTemplate').DataTable({
                    dom: "tr<'row'<'col-sm-4'p><'col-sm-4 text-center'i><'col-sm-4 text-end'l>>",
                    stateSave: true,
                    "bDestroy": true
                });
                table.clear();
                let htmlContent = '';
                data?.forEach((element, key) => {
                    htmlContent = `
                        <tr>
                            <th class="text-center">${key + 1}</th>
                            <td class="text-center">${element?.treatment}</td>
                            <td class="text-center">
                                <button type="button" id="radTemplate-${element?.radiologi_bacaan_id}" 
                                        onclick="showDataTemplate('${btoa(encodeURIComponent(JSON.stringify({
                                            radiologi_bacaan_type: element?.radiologi_bacaan_type,
                                            treatment: element?.treatment,
                                            hasil_baca: element?.hasil_baca,
                                            kesan: element?.kesan
                                        })))}')" 
                                        class="btn btn-sm btn-primary" data-id="${element?.radiologi_bacaan_id}">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </td>
                        </tr>
                    `;




                    table.row.add($(htmlContent));
                });

                table.draw();

            }
        });
    }

    function showDataTemplate(data) {
        $("#modalTemplateExpertise").modal('show')
        const dataDecode = JSON.parse(decodeURIComponent(atob(data)));

        $('#modalTemplateType').val(dataDecode?.radiologi_bacaan_type)
        $('#modalTemplateTreatment').val(dataDecode?.treatment)
        $('#modalTemplateHasilBaca').html(dataDecode?.hasil_baca)
        $('#modalTemplateKesimpulan').html(dataDecode?.kesan)
    }

    function showDataTemplate(data) {
        $("#modalTemplateExpertise").modal('show')
        const dataDecode = JSON.parse(decodeURIComponent(atob(data)));

        $('#modalTemplateType').val(dataDecode?.radiologi_bacaan_type)
        $('#modalTemplateTreatment').val(dataDecode?.treatment)
        $('#modalTemplateHasilBaca').html(dataDecode?.hasil_baca)
        $('#modalTemplateKesimpulan').html(dataDecode?.kesan)
    }
    $('#imagePreviewExpertise').on('click', function() {

    })
</script>
<script>
    const quillEditor = document.querySelectorAll('.quill-textarea-radiologi');

    quillEditor.forEach(function(editor, index) {
        const quill = new Quill(editor, {
            theme: 'snow',
        });

        const hiddenInput = document.getElementById(`${editor.id}-hidden`);

        quill.on('text-change', () => {
            const quillContent = quill.root.innerHTML; // Get the current content of the Quill editor
            hiddenInput.value = quillContent; // Update the hidden input value
        });
    });
</script>