<script type='text/javascript'>
    // GLOBAL PARAMETER


    var resep;
    var measureParam = [];
    var regulateParam = [];
    var signaParam = [];
    var signa2Param = [];
    var signa3Param = [];
    var signa4Param = [];
    var signa5Param = [];
    var resepDetail = [];
    var resepNo = [];
    var resepOrder = 0;
    var resep_no = '';
    var theOrder = 0;
    <?php foreach ($employee as $key => $value) {
        if (is_null($visit['class_room_id'])) {
            if ($employee[$key]['employee_id'] == $visit['employee_id']) {
    ?>
                var specialist = "<?= $employee[$key]['specialist_type_id']; ?>";

            <?php
            }
        }
        if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) {
            if ($employee[$key]['employee_id'] == $visit['employee_inap']) {
            ?>
                var specialist = "<?= $employee[$key]['specialist_type_id']; ?>";

    <?php
            }
        }
    } ?>

    <?php
    $option = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $optionJml = [0, 1, 2, 3, 4, 5, '1/2', '1/4', '1/3', '3/4'];
    foreach ($option as $key => $value) {
        $option[$key] = $option[$key] . "x Sehari";
    }
    ?>
    var option = <?= json_encode($option); ?>;
    var optionJml = <?= json_encode($optionJml); ?>;
    var visitHistory;

    // $(document).ready(function() {
    //     $("#jenisresep").val('')
    // })

    $("#eresepTab").on("click", function() {
        <?php if ($visit['isrj'] == 1) {
        ?>
            $("#jenisresep").val(1)
        <?php
        } else {
        ?>
            $("#jenisresep").val(7)
        <?php
        } ?>
        getResep(visit, nomor)
        $("#eresepTitle").html("E-Resep")
        $("#eresepBtnGroup").slideDown()
        $("#medItemBtnGroup").slideUp()

    })
    $("#medicalitemTab").on("click", function() {
        $("#jenisresep").val(8)
        getResep(visit, nomor)
        $("#eresepTitle").html("Medical Item")
        $("#eresepBtnGroup").slideUp()
        $("#medItemBtnGroup").slideDown()
    })
    $("#formEditPrescrBtn").on("click", function() {
        if ($("#resepno").val() == '%') {
            alert("harap pilih nomor resep terlebih dahulu")
        } else {
            $("#formAddPrescrBtn").slideDown()
            $("#formEditPrescrBtn").slideUp()
            $("#formprescription").find("input, textarea, select, .btn-btnnr, .btn-btnr, .btn-danger").prop("disabled", false)
        }
    })
    $("#jenisresep").on("change", function() {
        getResep(visit, nomor)
    })
</script>


<script type='text/javascript'>
    function isnullcheck(parameter) {
        return parameter == null ? 0 : (parameter)
    }

    var obat;

    function getResep(visit, nomor) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getResep',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'sold_status': $("#jenisresep").val()
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#ereseploadingspace").html(loadingScreen())
            },
            success: function(data) {
                signaParam = data.signa;
                $("#ereseploadingspace").html("")
                $("#resepno").html("")

                $("#resepno").append($('<option>').val('%').text('Semua'));



                signaParam.forEach((selemet, skey) => {
                    if (signaParam[skey].signa_type == 2 && signaParam[skey].isactive == "1") {
                        signa2Param.push(signaParam[skey])
                    }
                    if (signaParam[skey].signa_type == 3) {
                        signa3Param.push(signaParam[skey])
                    }
                    if (signaParam[skey].signa_type == 4 && signaParam[skey].isactive == "1") {
                        signa4Param.push(signaParam[skey])
                    }
                    if ((signaParam[skey].specialist_type == specialist || signaParam[skey].specialist_type == '0.00' || signaParam[skey].specialist_type == null) && signaParam[skey].signa_type == 5 && signaParam[skey].isactive == "1") {
                        signa5Param.push(signaParam[skey])
                    }
                });

                measureParam = data.measurement;
                regulateParam = data.regulation;
                resepDetail = []
                if (typeof data.resepNo !== 'undefined') {
                    resepNo = data.resepNo;

                    resepNo.forEach((element, key) => {
                        $("#resepno").append($('<option>').val(resepNo[key]).text(resepNo[key]));
                    });
                    resepDetail = data.obat;
                }

                visitHistory = data.visitHistory;

                $("#historyEresep").html(visitHistory)

                obat = data.historyObat

                obat.forEach((element, key) => {
                    fillHistoryEresep(obat[key], obat[key].visit_id)
                });



                filteredResep('%')
                $("#resepno").val('%');
                // holdModal('historyEresepModal')

            },
            error: function() {

            }
        });
    }

    function copyResep(formid) {

        const billIds = Array.from(document.querySelectorAll('#' + formid + ' input[name="bill_id[]"]'));
        const billIdValues = billIds.map(input => input.value);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/generateResep',
            type: "POST",
            data: JSON.stringify({
                'norm': '<?= $visit['no_registration']; ?>',
                'tgl': get_date(),
                'clinicId': '<?= $visit['clinic_id']; ?>',
                'isrj': '<?= $visit['isrj']; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var noresep = data
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/copyResep',
                    type: "POST",
                    data: JSON.stringify({
                        'billId': billIdValues,
                        'noresep': noresep,
                        'visit_id': '<?= $visit['visit_id']; ?>',
                        'trans_id': '<?= $visit['trans_id']; ?>'
                    }),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        var noresep = data

                        $("#historyEresepModal").modal("hide")
                        $("#eresepTab").trigger("click")
                    },
                    error: function() {

                    }
                });
            },
            error: function() {

            }
        });



    }

    function generateResep(norm, clinicId, isrj, isracik) {

        if (isracik == 1) {
            var clicked_submit_btn = $("#addRBtn")
        } else {
            var clicked_submit_btn = $("#addNrBtn")
        }

        clicked_submit_btn.button('loading');


        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/generateResep',
            type: "POST",
            data: JSON.stringify({
                'norm': norm,
                'tgl': get_date(),
                'clinicId': clinicId,
                'isrj': isrj
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var noresep = data
                var noresawal = noresep.substring(0, 2)

                var noresakhir = noresep.substring(2, noresep.length)

                var noresepbaru = noresawal + 'E' + noresakhir



                $("#resepno").append($("<option>").val(noresepbaru).text(noresepbaru))
                $("#resepno").val(noresepbaru)

                filteredResep(noresepbaru)

                if (isracik == 1) {
                    addBlankLine('racikan', 1)
                    // $("#eresepAdd").slideUp()
                    // $("#eresepRAdd").slideUp()
                    $("#eresepTable").slideDown()
                } else {
                    addBlankLine('nonracik', 1)
                    // $("#eresepAdd").slideUp()
                    // $("#eresepRAdd").slideUp()
                    $("#eresepTable").slideDown()
                }

                clicked_submit_btn.button('reset');
            },
            error: function() {

            }
        });
    }



    function decimalInput(prop) {
        var value = $(prop).val()
        value = (Number(value.replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2))
        $(prop).val(value)
    }

    function addNR() {
        var resep_no = $("#resepno").val();

        $(".komponenbtn").remove();

        if (resep_no == '%') {
            generateResep('<?= $visit['no_registration']; ?>', '<?= $visit['clinic_id']; ?>', '<?= $visit['isrj']; ?>', 0)
        } else {
            $("#eresepBtnGroup").slideUp()
            $("#medItemBtnGroup").slideUp()
            // $("#eresepAdd").slideUp()
            // $("#eresepRAdd").slideUp()
            $("#eresepTable").slideDown()

            addBlankLine('nonracik')
        }
    }

    function addR() {
        theOrder = 0;
        var resep_no = $("#resepno").val();

        $(".komponenbtn").remove();

        if (resep_no == '%') {
            generateResep('<?= $visit['no_registration']; ?>', '<?= $visit['clinic_id']; ?>', '<?= $visit['isrj']; ?>', 1)
        } else {
            $("#eresepBtnGroup").slideUp()
            $("#medItemBtnGroup").slideUp()
            addBlankLine('racikan')
        }

    }

    function addKomponen(noresep, resepKe) {
        $("#resepno").val(noresep);
        addBlankLine('komponen', resepKe)
    }



    function removeObat(bill) {
        if (confirm('Apakah anda yakin akan menghapus item ini?') == true) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deletePresc',
                type: "POST",
                data: JSON.stringify({
                    "bill": bill
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                // beforeSend: function() {
                //     clicked_submit_btn.button('loading');
                // },
                success: function(data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        errorSwal(message);
                    } else {
                        successSwal(data.message);
                        resepDetail.forEach((element, key) => {
                            if (resepDetail[key].bill_id == bill)
                                resepDetail.splice(key, 1)
                        });
                        $("." + bill).remove()

                        var resep_no = $("#resepno").val();
                        filteredResep(resep_no)

                    }
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                },
                complete: function() {}
            });
        }
    }

    function generateDescription2NR(id) {
        var desc2 = ($("#dosisLine1" + id).val() ?? '') + ' ' + ($("#dosisLine2" + id).val() ?? '') + ' ' + ($("#signa2" + id).val() ?? '') + ' ' + ($("#signa4" + id).val() ?? '') + ($("#signa5" + id).val() ? '; ' + $("#signa5" + id).val() : '');
        $("#aordescription2" + id).val(desc2);
        console.log("aordescription2" + id)
        console.log(desc2)
    }

    function itemObatChange(billId, toItem) {
        // alert(toItem.substring(0, 1))
        if (toItem.substring(0, 1) == '{') {
            toItem = JSON.parse(toItem)
        }
        if (typeof toItem.brand_id !== 'undefined') {
            // alert(toItem.brand_id)
            var jmlBks = 1
            var dose = 1
            var origDose = toItem.size_goods
            // var resepKe = resepOrder
            var description = toItem.name
            var brandId = toItem.brand_id
            var measureId = parseInt(toItem.measure_id)
            var measureIdName = '';
            var measureId2 = parseInt(toItem.measure_dosis)
            var measureId2Name = '';
            var measureDosis = toItem.measure_dosis
            var measureDosisName = '';
            // var racikan = '0'
            var doctor = doctor
            var employeeId = '<?= $visit['employee_id']; ?>'
            var employeeIdFrom = '<?= $visit['employee_id']; ?>'
            var doctorFrom = '<?= $visit['fullname']; ?>'
            var statusObat = toItem.status_pasien_id
            var tarifId = "1201008"
            var treatment = "PEMBELIAN OBAT RACIKAN"
            var tarifType = "803"
            var amount = 0.0
            var sellPrice = (Math.round((toItem.sell_price) * 100) / 100).toFixed(2)
            var tagihan = 0.0
            var subsidi = 0.0
            var subsidiSat = 0.0
            var margin = toItem.margininternal
            var ppn = toItem.ppn
            var ppnValue = 0.0
            var discount = 0.0
            var diskon = 0.0
            var profession = 0.0
            var profesi = 0.0
            var amountPlafond = 0.0
            var amountPaidPlafond = 0.0
            var description2 = ""
            var dosePresc = 0.0
            var qty = 0.0
            var numer = "9"
            var resepNo = resepNo
            var notaNo = resepNo
            var treatDate = get_date()
            var dose1 = 0.0
            var dose2 = 0.0
            var classRoomId = ""
            var clinicId = '<?= $visit['clinic_id']; ?>'
            var clinicIdFrom = '<?= $visit['clinic_id']; ?>'
            var islunas = 0

            console.log(measureDosis)
            measureParam.forEach((melement, mkey) => {
                if (measureParam[mkey].measure_id == measureId) {
                    measureIdName = measureParam[mkey].measurement;
                }
                if (measureParam[mkey].measure_id == measureDosis) {
                    measureDosisName = measureParam[mkey].measurement;
                }
            });

            $("#aordose1" + billId).val(1);
            $("#aordose2" + billId).val(1);
            $("#aordose" + billId).val(dose);
            $("#aororig_dose" + billId).val(origDose);
            // $("#aorresep_ke" + billId).val(resepKe);
            $("#aorbrand_id" + billId).val(brandId);
            $("#aormeasure_id" + billId).html(new Option(measureIdName, parseInt(measureId)));
            $("#aormeasure_id" + billId).val(parseInt(measureId));
            // $("#aormeasure_id2" + billId).html(new Option(measureDosisName, measureId2));
            // $("#aormeasure_id2" + billId).val(measureId2);
            $("#aormeasure_dosis" + billId).html(new Option(measureDosisName, parseInt(measureDosis)));
            $("#aormeasure_dosis" + billId).val(parseInt(measureDosis));
            // $("#aormeasure_id2name" + billId).val(measureId2);
            // $("#aorracikan" + billId).val(racikan);
            $("#aordoctor" + billId).val(doctor);
            $("#aoremployee_id" + billId).val(employeeId);
            $("#aoremployee_id_from" + billId).val(employeeIdFrom);
            $("#aordoctor_from" + billId).val(doctorFrom);
            $("#aorstatus_obat" + billId).val(statusObat);
            $("#aortarif_id" + billId).val(tarifId);
            $("#aortreatment" + billId).val(treatment);
            $("#aortarif_type" + billId).val(tarifType);
            $("#aoramount" + billId).val(amount);
            $("#aorsell_price" + billId).val(sellPrice);
            $("#aortagihan" + billId).val(tagihan);
            $("#aorsubsidi" + billId).val(subsidi);
            $("#aorsubsidisat" + billId).val(subsidiSat);
            $("#aormargin" + billId).val(margin);
            $("#aorppn" + billId).val(ppn);
            $("#aorppnvalue" + billId).val(ppnValue);
            $("#aordiscount" + billId).val(discount);
            $("#aordiskon" + billId).val(diskon);
            $("#aorprofession" + billId).val(profession);
            $("#aorprofesi" + billId).val(profesi);
            $("#aoramount_paid" + billId).val(amountPlafond);
            $("#aorquantity" + billId).val(qty);
            $("#aornumer" + billId).val(numer);
            $("#aorresep_no" + billId).val(resep_no);
            $("#aornota_no" + billId).val(notaNo);
            $("#aortreat_date" + billId).val(treatDate);
            $("#aorclass_room_id" + billId).val(classRoomId);
            $("#aorclinic_id" + billId).val(clinicId);
            $("#aorclinic_id_from" + billId).val(clinicIdFrom);
            // $("#aortheorder" + billId).val(theOrder);
            $("#aorvisit_id" + billId).val('<?= $visit['visit_id']; ?>');
            $("#aorno_registration" + billId).val('<?= $visit['no_registration']; ?>');
            $("#aortrans_id" + billId).val('<?= $visit['trans_id']; ?>');
            $("#aormodified_from" + billId).val('<?= $visit['clinic_id']; ?>');
            $("#aormodified_date" + billId).val(get_date());
            $("#aorisrj" + billId).val('<?= $visit['isrj']; ?>');
            $("#aorthename" + billId).val('<?= $visit['diantar_oleh']; ?>');
            $("#aortheaddress" + billId).val('<?= $visit['visitor_address']; ?>');
            $("#aortheid" + billId).val('<?= $visit['pasien_id']; ?>');
            $("#aororg_unit_code" + billId).val('<?= $visit['org_unit_code']; ?>')
            $("#islunas" + billId).val(islunas);
            $("#aordose_presc" + billId).val(dosePresc)
            // alert("#aordose_presc" + billId)
            // alert(dosePresc)
            // decimalInput("#aordose_presc" + billId)

            $("#aordescription2" + billId).val(description2)
            $("#aordescription" + billId).val(description)
            $("#aoraturanminum2" + billId).val(description2)
            $("#aorcif" + billId).val(description)
        }

        $("#formprescription").on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/addPrescR',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clicked_submit_btn.button('loading');
                },
                success: function(data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        errorSwal(message);
                    } else {
                        $("#formAddPrescrBtn").slideUp()
                        $("#formEditPrescrBtn").slideDown()
                        $("#formprescription").find("input, textarea, select, .btn-btnnr, .btn-btnr, .btn-danger").prop("disabled", true)
                        successSwal(data.message);

                        $("#prescRItemBody").html("")
                        resepDetail = [];

                        data.data.forEach((element, key) => {
                            datachild = data.data[key]
                            resepDetail.push(data.data[key])
                        });

                        $("#resepno")

                        filteredResep($("#resepno").val())

                        // $("#addPrescR").modal('hide');
                    }
                    clicked_submit_btn.button('reset');
                },
                error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    clicked_submit_btn.button('reset');
                },
                complete: function() {
                    clicked_submit_btn.button('reset');
                }
            });
        }));


    }

    function updateJmlBks(resep_no, resep_ke, value) {
        value = (Number(value.replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2))
        $(`#${resep_no}${resep_ke} [name="jml_bks[]"]`).val(value)
    }
</script>

<script type="text/javascript">
    function addBlankLine(obatType, resepKe = null) {
        $("#formAddPrescrBtn").slideDown()
        $("#formEditPrescrBtn").slideUp()
        $("#formprescription").find("input, textarea, select").prop("disabled", false)

        addRowObat(obatType, resepKe, null)
    }
</script>
<script type="text/javascript">
    function filteredResep(resepSelected) {
        $("#eresepBody").html("")

        var iseresep = $("#iseresep").val()
        var soldstatusarray = ['1', '7'];
        var soldstatus = $("#jenisresep").val()

        resepOrder = 0;

        if (resepDetail.length > 0) {
            $("#eresepBody").html("")
            $("#formprescription").find("input, textarea, select").prop("disabled", false)
            $("#formAddPrescrBtn").slideUp()
            $("#formEditPrescrBtn").slideDown()
        } else {
            $("#eresepBody").html("")
            $("#formprescription").find("input, textarea, select").prop("disabled", false)
            $("#formAddPrescrBtn").slideDown()
            $("#formEditPrescrBtn").slideUp()
        }

        resepDetail.forEach((element, key) => {

            $(".komponenbtn").remove();


            resep = resepDetail[key];


            if (resepSelected == '%' || resep.resep_no == resepSelected) {
                addRowObat(null, resep.resek_ke, resep)
            }
        });
        if (resepDetail.length > 0) {
            $("#formprescription").find("input, textarea, select, .btn-btnnr, .btn-btnr, .btn-danger").prop("disabled", true)
        }
        // if (resepSelected == '%') {
        //     $("#formAddPrescrBtn").hide()
        //     $("#formEditPrescrBtn").show()
        // }


        var jnsrsp = $("#jenisresep").val()
        if ($("#eresepBody table").length == 0) {
            console.log(soldstatusarray.includes($("#jenisresep").val()))
            console.log('asdf')
            if (soldstatusarray.includes($("#jenisresep").val())) {
                $("#eresepBtnGroup").slideDown()
                $("#medItemBtnGroup").slideUp()
            } else {
                $("#eresepBtnGroup").slideUp()
                $("#medItemBtnGroup").slideDown()
            }
        } else {
            console.log(soldstatusarray.includes($("#jenisresep").val()))
            if (soldstatusarray.includes($("#jenisresep").val())) {
                $("#eresepBtnGroup").slideDown()
                $("#medItemBtnGroup").slideUp()
            } else {
                $("#eresepBtnGroup").slideUp()
                $("#medItemBtnGroup").slideDown()
            }
        }
    }

    function removeRacik(brand) {
        console.log(brand)
        if (confirm('Apakah anda yakin akan menghapus item ini?') == true) {
            $("#" + brand).remove()
            if ($("#eresepBody table").length == 0) {
                $("#eresepBtnGroup").slideDown()
                $("#medItemBtnGroup").slideDown()
            } else {
                $("#eresepBtnGroup").slideUp()
                $("#medItemBtnGroup").slideUp()
            }
        }
    }

    function removeKomponen(brand, resepKe, resepNo) {
        if (confirm('Apakah anda yakin akan menghapus item ini?') == true) {
            $("#" + brand).remove()
            $("#tdresep_keresep" + resepKe + '' + resepNo).attr('rowspan', theorder)
            $("#tddescriptionresep" + resepKe + '' + resepNo).attr('rowspan', 1)
            $("#tdjml_bks" + resepKe + '' + resepNo).attr('rowspan', 1)
            $("#tdmeasure_idnameresep" + resepKe + '' + resepNo).attr('rowspan', 1)
            $("#tddescription2resep" + resepKe + '' + resepNo).attr('rowspan', theorder - 1)
            $("#tdbtnracikresep" + resepKe + '' + resepNo).attr('rowspan', theorder)
            $("#tdbtnremoveracikresep" + resepKe + '' + resepNo).attr('rowspan', 1)
            $("#traturanminumresep" + resepKe + '' + resepNo).remove()
            $("#tddosisDiv" + resepKe + '' + resepNo).remove()
            $("#tddosis2Div" + resepKe + '' + resepNo).remove()
            $("#tdsigna2Div" + resepKe + '' + resepNo).remove()
            $("#tdsigna4Div" + resepKe + '' + resepNo).remove()
            $("#tdsigna5Div" + resepKe + '' + resepNo).remove()
        }
    }

    const stopOdd = (resep_no, resep_ke) => {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/stopOdd',
            type: "POST",
            data: JSON.stringify({
                "resep_no": resep_no,
                "resep_ke": resep_ke
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
            //     clicked_submit_btn.button('loading');
            // },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorSwal(message);
                } else {
                    successSwal(data.message);
                    resepDetail.forEach((element, key) => {
                        console.log(resepDetail[key].resep_no + ' => ' + data.data.resep_no)
                        if (resepDetail[key].resep_no == data.data.resep_no && resepDetail[key].resep_ke == data.data.resep_ke)
                            resepDetail[key].status_tarif = 0
                    });

                    var resep_no = $("#resepno").val();
                    filteredResep(resep_no)
                    $("#formEditPrescrBtn").trigger("click")
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
            },
            complete: function() {}
        });
    }

    const stopOddAll = () => {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/stopOddAll',
            type: "POST",
            data: JSON.stringify({
                "resep_no": $("#resepno").val(),
                "visit_id": '<?= $visit['visit_id']; ?>'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
            //     clicked_submit_btn.button('loading');
            // },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorSwal(message);
                } else {
                    successSwal(data.message);
                    resepDetail.forEach((element, key) => {
                        if (resepDetail[key].resep_no == data.data.resep_no || data.data.resep_no == '%')
                            resepDetail[key].status_tarif = 0
                    });

                    var resep_no = $("#resepno").val();
                    filteredResep(resep_no)
                }
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
            },
            complete: function() {}
        });
    }
    const addRowObat = (obatType, resepKe = null, resep = null, keyvisit = null) => {
        let bodytable = '';

        if (keyvisit == null) {
            bodytable = '#eresepBody';
        } else {
            bodytable = "#body" + keyvisit;
        }

        resep_no = $("#resepno").val()

        var soldstatus = $("#jenisresep").val()
        if (resep == null) {
            var racikan = 0;


            var iseresep = $("#iseresep").val()


            if (obatType != 'komponen') { // non racikan atau racikan
                resepOrder++;
                if (obatType != 'racikan') { // non racikan
                    theOrder = resepOrder;
                    racikan = 0;
                } else { // racikan
                    theOrder = 1;
                    racikan = 1;
                }
                if (resepKe == null) {
                    resepKe = resepOrder;
                } else {
                    resepOrder = resepKe
                }
            } else { //komponen
                theOrder = $("#" + resep_no + resepKe + " tr").length + 1;
                racikan = 1;
            }
            var billId = (get_datesecond() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', '');

            var jmlBks = 0;
            var dose = 0;
            var origDose = '';
            var description = '';
            var brandId = '00000';
            var measureId = '';
            var measureIdName = '';
            var measureId2 = '';
            var measureId2Name = '';
            var measureDosis = '';
            var measureDosisName = '';
            var doctor = '<?= $visit['fullname']; ?>'
            var employeeId = '<?= $visit['employee_id']; ?>'
            var employeeIdFrom = '<?= $visit['employee_id']; ?>'
            var doctorFrom = '<?= $visit['fullname']; ?>'
            var statusObat = '';
            var tarifId = '';
            if (racikan == 1) {
                var treatment = "PEMBELIAN OBAT RACIKAN"
            } else {
                var treatment = "PEMBELIAN OBAT NON RACIKAN"
            }
            var tarifType = "803"
            var amount = 0.0
            var sellPrice = 0.0
            var tagihan = 0.0
            var subsidi = 0.0
            var subsidiSat = 0.0
            var margin = 0.0
            var ppn = 0.0
            var ppnValue = 0.0
            var discount = 0.0
            var diskon = 0.0
            var profession = 0.0
            var profesi = 0.0
            var amountPlafond = 0.0
            var amountPaidPlafond = 0.0
            var description2 = ""
            var dosePresc = 0.0
            var qty = 0.0
            var numer = "9"
            var resepNo = resep_no
            var notaNo = resep_no
            var treatDate = get_date()
            var dose1 = 0.0
            var dose2 = 0.0
            var classRoomId = ""
            var clinicId = '<?= $visit['clinic_id']; ?>'
            var clinicIdFrom = '<?= $visit['clinic_id']; ?>'
            var islunas = 0
            var moduleId = '';
            var status_tarif = <?= $visit['isrj'] == 1 ? 0 : 1; ?>;
            var iscetak = 1;
            var bodyId = '<?= $visit['session_id']; ?>'
            if (racikan == 1)
                var measureIdName = 'Bks';
            else
                var measureIdName = ''
        } else {
            var billId = resep?.bill_id
            var jmlBks = resep?.jml_bks;
            var dose = resep?.dose;
            var origDose = resep?.orig_dose;
            var resepKe = resep?.resep_ke;
            var description = resep?.description;
            var brandId = resep?.brand_id;
            var measureId = resep?.measure_id;
            var measureIdName = '';
            var measureId2 = resep?.measure_id2;
            var measureId2Name = '';
            var measureDosis = resep?.measure_dosis;
            var measureDosisName = '';
            var racikan = resep?.racikan;
            var doctor = resep?.doctor;
            var employeeId = resep?.employee_id;
            var employeeIdFrom = resep?.employee_id_from;
            var doctorFrom = resep?.doctor_from;
            var statusObat = resep?.status_obat;
            var tarifId = resep?.tarif_id;
            var treatment = resep?.treatment;
            var tarifType = resep?.tarif_type;
            var amount = resep?.amount;
            var sellPrice = resep?.sell_price;
            var tagihan = resep?.tagihan;
            var subsidi = resep?.subsidi;
            var subsidiSat = resep?.subsidiSat;
            var margin = resep?.margin;
            var ppn = resep?.ppn;
            var ppnValue = resep?.ppnvalue;
            var discount = resep?.discount;
            var diskon = resep?.diskon;
            var profession = resep?.profession;
            var profesi = resep?.profesi;
            var amountPlafond = resep?.amount_plafond;
            var amountPaidPlafond = resep?.amount_paid_plafond;
            var description2 = resep?.description2;
            var dosePresc = resep?.dose_presc;
            var qty = resep?.quantity;
            var numer = resep?.numer;
            var resepNo = resep?.resep_no;
            var notaNo = resep?.nota_no;
            var treatDate = resep?.treat_date;
            var dose1 = resep?.dose1;
            var dose2 = resep?.dose2;
            // var theorder = resep?.theorder;
            var theOrder = resep?.theorder;
            var classRoomId = resep?.class_room_id;
            var clinicId = resep?.clinic_id;
            var clinicIdFrom = resep?.clinic_id_from;
            var islunas = resep?.islunas;
            var status_tarif = resep?.status_tarif;

            var visitId = resep?.visit_id
            var noRegistration = resep?.no_registration
            var transId = resep?.trans_id
            var isrj = resep?.isrj
            var thename = resep?.thename
            var theaddress = resep?.theaddress
            var modifiedDate = resep?.modified_date
            var modifiedFrom = resep?.modified_from
            var theid = resep?.theid
            var orgUnitCode = resep?.org_unit_code
            var cif = resep?.cif
            var aturanminum2 = resep?.aturanminum2
            var moduleId = resep?.module_id
            var iscetak = resep?.iscetak
            var bodyId = resep?.body_id;
            if (racikan == 1) {
                measureIdName = 'Bks';
            } else {
                measureParam.forEach((melement, mkey) => {
                    if (measureParam[mkey].measure_id == measureId) {
                        measureIdName = measureParam[mkey].measurement;
                    }
                    if (measureParam[mkey].measure_id == measureId2) {
                        measureId2Name = measureParam[mkey].measurement;
                    }
                });
            }
        }




        if (racikan == 1) {
            var dosisDiv = '<select placeholder="1x Sehari" onchange="generateDescription2NR(\'' + resepKe + '\')" name="dosisLine1' + resepKe + '" id="dosisLine1' + resepKe + '" class="form-control">';
            dosisDiv = dosisDiv + "<option value='' disabled selected hidden>1x Sehari</option>"
            option.forEach((element, key) => {
                dosisDiv = dosisDiv + "<option value='" + option[key] + "'>" + option[key] + "</option>"
            });
            dosisDiv = dosisDiv + '</select>';

            var dosis2Div = '<select placeholder="1" onchange="generateDescription2NR(\'' + resepKe + '\')" name="dosisLine2' + resepKe + '" id="dosisLine2' + resepKe + '" class="form-control">';
            dosis2Div = dosis2Div + "<option value='' disabled selected hidden>1</option>"
            optionJml.forEach((element, key) => {
                dosis2Div = dosis2Div + "<option value='" + optionJml[key] + "'>" + optionJml[key] + "</option>"
            });
            dosis2Div = dosis2Div + '</select>';

            var signa2Div = '<select placeholder="Tablet" onchange="generateDescription2NR(\'' + resepKe + '\')" name="signa2' + resepKe + '" id="signa2' + resepKe + '" class="form-control">';
            signa2Div = signa2Div + "<option value='' disabled selected hidden>Tablet</option>"
            signa2Param.forEach((element, key) => {
                signa2Div = signa2Div + "<option value='" + signa2Param[key].meaning + "'>" + signa2Param[key].signa + ' - ' + signa2Param[key].meaning + "</option>"
            });
            signa2Div = signa2Div + '</select>';

            var signa4Div = '<select onchange="generateDescription2NR(\'' + resepKe + '\')" name="signa4' + resepKe + '" id="signa4' + resepKe + '" class="form-control">';
            signa4Div = signa4Div + "<option value='' disabled selected hidden>Sebelum Makan</option>"
            signa4Div = signa4Div + "<option value='Sebelum Makan'>Sebelum Makan</option>"
            signa4Div = signa4Div + "<option value='Setelah Makan'>Setelah Makan</option>"
            signa4Div = signa4Div + "<option value='Pada Saat Makan Makan'>Pada Saat Makan Makan</option>"
            signa4Param.forEach((element, key) => {
                signa4Div = signa4Div + "<option value='" + signa4Param[key].meaning + "'>" + signa4Param[key].signa + ' - ' + signa4Param[key].meaning + "</option>"
            });
            signa4Div = signa4Div + '</select>';


            var signa5Div = '<select onchange="generateDescription2NR(\'' + resepKe + '\')" name="signa5' + resepKe + '" id="signa5' + resepKe + '" class="form-control">';
            signa5Div = signa5Div + "<option value='' disabled selected hidden>Melalui Mulut</option>"
            signa5Param.forEach((element, key) => {
                signa5Div = signa5Div + "<option value='" + signa5Param[key].meaning + "'>" + signa5Param[key].signa + ' - ' + signa5Param[key].meaning + "</option>"
            });
            signa5Div = signa5Div + '</select>';
        } else {
            var dosisDiv = '<select placeholder="1x Sehari" onchange="generateDescription2NR(\'' + billId + '\')" name="dosisLine1' + billId + '" id="dosisLine1' + billId + '" class="form-control">';
            dosisDiv = dosisDiv + "<option value='' disabled selected hidden>1x Sehari</option>"
            option.forEach((element, key) => {
                dosisDiv = dosisDiv + "<option value='" + option[key] + "'>" + option[key] + "</option>"
            });
            dosisDiv = dosisDiv + '</select>';

            var dosis2Div = '<select placeholder="1" onchange="generateDescription2NR(\'' + billId + '\')" name="dosisLine2' + billId + '" id="dosisLine2' + billId + '" class="form-control">';
            dosis2Div = dosis2Div + "<option value='' disabled selected hidden>1</option>"
            optionJml.forEach((element, key) => {
                dosis2Div = dosis2Div + "<option value='" + optionJml[key] + "'>" + optionJml[key] + "</option>"
            });
            dosis2Div = dosis2Div + '</select>';

            var signa2Div = '<select placeholder="Tablet" onchange="generateDescription2NR(\'' + billId + '\')" name="signa2' + billId + '" id="signa2' + billId + '" class="form-control">';
            signa2Div = signa2Div + "<option value='' disabled selected hidden>Tablet</option>"
            signa2Param.forEach((element, key) => {
                signa2Div = signa2Div + "<option value='" + signa2Param[key].meaning + "'>" + signa2Param[key].signa + ' - ' + signa2Param[key].meaning + "</option>"
            });
            signa2Div = signa2Div + '</select>';

            var signa4Div = '<select onchange="generateDescription2NR(\'' + billId + '\')" name="signa4' + billId + '" id="signa4' + billId + '" class="form-control">';
            signa4Div = signa4Div + "<option value='' disabled selected hidden>Sebelum Makan</option>"
            signa4Div = signa4Div + "<option value='Sebelum Makan'>Sebelum Makan</option>"
            signa4Div = signa4Div + "<option value='Setelah Makan'>Setelah Makan</option>"
            signa4Div = signa4Div + "<option value='Pada Saat Makan Makan'>Pada Saat Makan Makan</option>"
            signa4Param.forEach((element, key) => {
                signa4Div = signa4Div + "<option value='" + signa4Param[key].meaning + "'>" + signa4Param[key].signa + ' - ' + signa4Param[key].meaning + "</option>"
            });
            signa4Div = signa4Div + '</select>';


            var signa5Div = '<select onchange="generateDescription2NR(\'' + billId + '\')" name="signa5' + billId + '" id="signa5' + billId + '" class="form-control">';
            signa5Div = signa5Div + "<option value='' disabled selected hidden>Melalui Mulut</option>"
            signa5Param.forEach((element, key) => {
                signa5Div = signa5Div + "<option value='" + signa5Param[key].meaning + "'>" + signa5Param[key].signa + ' - ' + signa5Param[key].meaning + "</option>"
            });
            signa5Div = signa5Div + '</select>';
        }


        if (racikan == 0 || racikan == 3 || racikan == 4 || racikan == 15) { //non racikan
            tarifId = '1201008';
            treatment = "PEMBELIAN OBAT NON RACIKAN"
            $(bodytable).append(`<table id="${resepNo}${resepKe}table" class="table table-hover table-prescription" style="display: block;">
                        <thead class="table-primary" style="text-align: center;">
                            <tr>
                                <th id="${resepNo}${resepKe}oddstatus" colspan="11"> ${doctorFrom} | ${resepNo} | ${treatDate}</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 5%;"></th class="text-center">
                                <th  class="text-center" style="width: 30%;"></th class="text-center">
                                <th class="text-center" colspan="2" style="width: 20%;"></th class="text-center">
                                <th class="text-center" colspan="5" style="width: 30%;"></th class="text-center">
                                ` + (keyvisit == null ? `<th class="text-center" style="width: auto;"></th class="text-center">
                                <th class="text-center" style="width: auto;"></th class="text-center">` : ``) + `
                            </tr>
                        </thead>
                        <tbody id="${resepNo}${resepKe}">
                        </tbody>
                    </table>`)



            if (status_tarif == 0)
                $(`#${resepNo}${resepKe}oddstatus`).html(`${doctorFrom} | ${resepNo} | ${treatDate} | <span class="text-center text-danger">ODD Telah Selesai</span>`)
            // $(`#${resepNo}${resepKe}oddstatus`).attr("class", "")

            $(`#${resepNo}${resepKe}`).append($(`<tr id="${billId}">`).attr("class", billId).attr('class', 'non-racikan')
                .append($('<td>')
                    // .append($('<td rowspan="2">')
                    .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">')
                    .append('<select id="aordescription1' + billId + '" class="form-control select2-full-width fillitemidR" name="description1[]" onchange="itemObatChange(\'' + billId + '\',this.value)" style="width: 100%" ></select>')
                    // .append('<input type="hidden" name="description[]" id="aordescription' + billId + '" placeholder="" value="" class="form-control text-right">')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">')
                    .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">')
                    .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                )
            )
            if (soldstatus == '1' || soldstatus == '7') {
                $(`#${billId}`)
                    .append($('<td colspan="5">').append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control">'))

                if (keyvisit == null) {
                    $(`#${billId}`).append($('<td>').attr("id", "tdbtnracikresep" + resepKe).attr("class", "tdbtnresep")
                            // .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe)
                            .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                .append('<button type="button" onclick="addNR()" class="btn btn-success btn-btnnr waves-effect waves-light" data-row-id="1" autocomplete="off">NonRacikan</i></button>')
                                .append('<button type="button" onclick="addR()" class="btn btn-warning btn-btnr" data-row-id="1" autocomplete="off">Racikan</i></button>')
                                .append((status_tarif != 0 && isrj == 0 ? `<button type="button" onclick="stopOdd('${resepNo}', ${resepKe})" class="btn btn-danger btn-btnr" data-row-id="1" autocomplete="off">Stop ODD</i></button>` : ''))
                            )
                        )
                        .append($('<td>')
                            // .append($('<td rowspan="2">')
                            .append('<button type="button" onclick="removeRacik(\'' + resepNo + resepKe + 'table\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                        )
                }
            } else {
                $(`#${billId}`)
                    .append($('<td colspan="5">').append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control">'))


                if (keyvisit == null) {
                    $(`#${billId}`).append($('<td>').attr("id", "tdbtnracikresep" + resepKe).attr("class", "tdbtnresep")
                            // .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe)
                            .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                .append('<button type="button" onclick="addNR()" class="btn btn-success btn-btnnr waves-effect waves-light" data-row-id="1" autocomplete="off">Tambah</i></button>')
                            )
                        )
                        .append($('<td>')
                            // .append($('<td rowspan="2">')
                            .append('<button type="button" onclick="removeRacik(\'' + resepNo + resepKe + 'table\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                        )
                }
            }
            // $(bodytable).append($("<tr>").attr("class", billId).attr('class', 'non-racikan')
            //     .append($('<td colspan="5">').append(dosisDiv))
            // )
            // $(bodytable).append($("<tr>").attr("class", billId).attr('class', 'non-racikan')
            //     .append($("<td>").append(dosisDiv))
            //     .append($("<td>").append(dosis2Div))
            //     .append($("<td>").append(signa2Div))
            //     .append($("<td>").append(signa4Div))
            //     .append($("<td>").append(signa5Div))
            // )
        } else if (racikan == 1 && theOrder == '1') { //racikan
            $(bodytable).append(`<table id="${resepNo}${resepKe}table" class="table table-hover table-prescription" style="display: block;">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th id="${resepNo}${resepKe}oddstatus" colspan="11"> ${doctorFrom} | ${resepNo} | ${nowtime}</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 5%;"></th class="text-center">
                            <th class="text-start" style="width: 30%;"><h5>Komponen: </h5></th class="text-center">
                            <th class="text-center" style="width: 10%;"><input type="text" name="jml_bks[]" id="aorjml_bks${billId}" placeholder="" value="" class="form-control text-right"  onchange="updateJmlBks('${resepNo}',${resepKe},this.value)"  onfocus="this.value=''"></th class="text-center">
                            <th class="text-center" style="width: 10%;"><select name="measure_id2[]" id="aormeasure_id2${billId}" placeholder="" value="" class="form-select text-right" readonly></th class="text-center">
                            <th class="text-center" colspan="6" style="width: 40%;"><input type="text" name="description2[]" id="aordescription2${billId}" placeholder="" class="form-control"></th class="text-center">
                                                            ` + (keyvisit == null ? `<th class="text-center" style="width: auto;"></th class="text-center">
                            ` : ``) + `
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 5%;"></th class="text-center">
                            <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
                            <th class="text-center" style="width: 10%;">DTD</th class="text-center">
                            <th class="text-center" style="width: 10%;">Dosis</th class="text-center">
                            <th class="text-center" style="width: 10%;">Satuan</th class="text-center">
                            <th class="text-center" style="width: 10%;">Qty</th class="text-center">
                            <th class="text-center" style="width: 10%;">Satuan</th class="text-center">
                            <th class="text-center" colspan="2"></th class="text-center">
                                                            ` + (keyvisit == null ? `<th class="text-center" style="width: auto;"></th class="text-center">
                            <th class="text-center" style="width: auto;"></th class="text-center">` : ``) + `
                        </tr>
                    </thead>
                    <tbody id="${resepNo}${resepKe}">
                    </tbody>
                </table>`)


            $(`#aormeasure_id2${billId}`).on("change", function() {
                $(`#${resepNo}${resepKe}table input[name="measure_id2[]"]`).val($(`#aormeasure_id2${billId}`).val())
            })
            $(`#aorjml_bks${billId}`).on("change", function() {
                $(`#${resepNo}${resepKe}table input[name="jml_bks[]"]`).val($(`#aorjml_bks${billId}`).val())
                $(`#${resepNo}${resepKe}table`).find(`input[name="dose[]"]`).each(function() {
                    $(this).trigger('change')
                })
            })


            if (status_tarif == 0)
                $(`#${resepNo}${resepKe}oddstatus`).html(`${doctorFrom} | ${resepNo} | ${nowtime} | <span class="text-center text-danger">ODD Telah Selesai</span>`)




            tarifId = '1201007';
            treatment = "PEMBELIAN OBAT RACIKAN"
            $(`#${resepNo}${resepKe}`).append($(`<tr id="${billId}">`).attr("class", billId).attr('class', 'racikan' + racikan)
                .append($('<td>').attr("id", "tdresep_keresep" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdresep_keresep" + resepKe)
                    .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>').attr("id", "tddescriptionresep" + resepKe)
                    .append('<select id="aordescription1' + billId + '" class="form-control select2-full-width fillitemidR" name="description1[]" onchange="itemObatChange(\'' + billId + '\',this.value)" style="width: 100%" ></select>')
                    // .append('<input type="hidden" name="description[]" id="aordescription' + billId + '" placeholder="" value="" class="form-control text-right">')
                )
                .append($('<td>').attr("id", "dose" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="dose[]" id="aordose' + billId + '" placeholder="" value="" class="form-control text-right" onfocus="this.value=\'\'">')
                )
                .append($('<td>').attr("id", "orig_dose" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="orig_dose[]" id="aororig_dose' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    // .append('<input type="text" name="measure_id2[]" id="aormeasure_id2' + billId + '" placeholder="" value="" class="form-control text-right" onfocus="this.value=\'\'">')
                    .append('<select name="measure_dosis[]" id="aormeasure_dosis' + billId + '" placeholder="" value="" class="form-select" readonly>')
                )
                .append($('<td>').attr("id", "dose_presc" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    // .append('<input type="text" name="measure_id[]" id="aormeasure_id' + billId + '" placeholder="" value="" class="form-control text-right" onfocus="this.value=\'\'">')
                    .append('<select name="measure_id[]" id="aormeasure_id' + billId + '" placeholder="" value="" class="form-select text-right" readonly>')
                )
                // .append($('<td colspan="2">').attr("id", "tddescription2resep" + resepKe)
                //     // .append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control">')
                // )
            )

            if (keyvisit == null) {
                $(`#${billId}`).append($('<td>').attr("id", "tdbtnracikresep" + resepKe).attr("class", "tdbtnresep")
                        // .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe)
                        .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                            .append('<button type="button" onclick="addNR()" class="btn btn-success btn-btnnr waves-effect waves-light" data-row-id="1" autocomplete="off">NonRacikan</i></button>')
                            .append('<button type="button" onclick="addR()" class="btn btn-warning btn-btnr" data-row-id="1" autocomplete="off">Racikan</i></button>')
                            .append(`<button type="button" onclick="addKomponen('${resepNo}', ${resepKe})" class="btn btn-info" data-row-id="1" autocomplete="off">Komponen</i></button>`)
                            .append((status_tarif != 0 && isrj == 0 ? `<button type="button" onclick="stopOdd('${resepNo}', ${resepKe})" class="btn btn-danger btn-btnr" data-row-id="1" autocomplete="off">Stop ODD</i></button>` : ''))
                        )
                    )
                    .append($('<td>').attr("id", "tdbtnremoveracikresep" + resepKe)
                        // .append($('<td rowspan="2">').attr("id", "tdbtnremoveracikresep" + resepKe)
                        .append('<button type="button" onclick="removeRacik(\'' + resepNo + resepKe + 'table\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                    )
            }
            // $(bodytable).append($("<tr>").attr("id", "traturanminumresep" + resepKe)
            //     .attr("class", billId).attr('class', 'racikan')
            //     .append($('<td colspan="5">'))
            // )
            // $(bodytable).append($("<tr>").attr("id", "traturanminumresep" + resepKe)
            //     .attr("class", billId).attr('class', 'racikan')
            //     .append($("<td>").attr("id", "tddosisDiv" + resepKe)
            //         .append(dosisDiv))
            //     .append($("<td>").attr("id", "tddosis2Div" + resepKe)
            //         .append(dosis2Div))
            //     .append($("<td>").attr("id", "tdsigna2Div" + resepKe)
            //         .append(signa2Div))
            //     .append($("<td>").attr("id", "tdsigna4Div" + resepKe)
            //         .append(signa4Div))
            //     .append($("<td>").attr("id", "tdsigna5Div" + resepKe)
            //         .append(signa5Div))
            // )
        } else { //komponen
            tarifId = '1201007';
            theOrder = $(`#${resepNo}${resepKe} tr`).length + 1
            $("#tdresep_keresep" + resepKe).attr('rowspan', theOrder)
            $("#tddescriptionresep" + resepKe).attr('rowspan', 1)
            $("#tdjml_bks" + resepKe).attr('rowspan', 1)
            $("#tdmeasure_idnameresep" + resepKe).attr('rowspan', 1)
            $("#tddescription2resep" + resepKe).attr('rowspan', theOrder - 1)
            $("#tdbtnracikresep" + resepKe).attr('rowspan', theOrder)
            $("#tdbtnremoveracikresep" + resepKe).attr('rowspan', 1)
            $("#traturanminumresep" + resepKe).remove()
            $("#tddosisDiv" + resepKe).remove()
            $("#tddosis2Div" + resepKe).remove()
            $("#tdsigna2Div" + resepKe).remove()
            $("#tdsigna4Div" + resepKe).remove()
            $("#tdsigna5Div" + resepKe).remove()
            console.log(`#${resepNo}${resepKe}`)
            $(`#${resepNo}${resepKe}`).append($(`<tr id="${billId}">`).attr("class", billId).attr('class', 'racikan' + racikan)
                // .append($('<td>')
                //     // .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                // )
                .append($('<td>').attr("id", "tddescriptionresep" + resepKe)
                    .append('<select id="aordescription1' + billId + '" class="form-control select2-full-width fillitemidR" name="description1[]" onchange="itemObatChange(\'' + billId + '\',this.value)" style="width: 100%" ></select>')
                    // .append('<input type="hidden" name="description[]" id="aordescription' + billId + '" placeholder="" value="" class="form-control text-right">')
                )
                .append($('<td>').attr("id", "dose" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="dose[]" id="aordose' + billId + '" placeholder="" value="" class="form-control text-right" onfocus="this.value=\'\'">')
                )
                .append($('<td>').attr("id", "orig_dose" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="orig_dose[]" id="aororig_dose' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    // .append('<input type="text" name="measure_id2[]" id="aormeasure_id2' + billId + '" placeholder="" value="" class="form-control text-right" onfocus="this.value=\'\'">')
                    .append('<select name="measure_dosis[]" id="aormeasure_dosis' + billId + '" placeholder="" value="" class="form-select" readonly>')
                )
                .append($('<td>').attr("id", "dose_presc" + resepKe)
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>')
                    // .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    // .append('<input type="text" name="measure_id[]" id="aormeasure_id' + billId + '" placeholder="" value="" class="form-control text-right" onfocus="this.value=\'\'">')
                    .append('<select name="measure_id[]" id="aormeasure_id' + billId + '" placeholder="" value="" class="form-select text-right" readonly>')
                )
                // .append($('<td colspan="2">').attr("id", "tddescription2resep" + resepKe)
                //     // .append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control">')
                // )
            )

            // if (keyvisit == null) {
            //     $(`#${resepNo}${resepKe}`)
            //         .append($('<td colspan="7">'))
            // } else {
            //     $(`#${resepNo}${resepKe}`)
            //         .append($('<td colspan="5">'))
            // }
        }

        if (racikan == 1 && theOrder != '1') {
            $(`#${billId}`).append('<input name="resep_ke[]" id="aorresep_ke' + billId + '" type="hidden" class="form-control" />')
            $(`#${billId}`).append('<input name="description2[]" id="aordescription2' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id2[]" id="aormeasure_id2' + billId + '" type="hidden" class="form-control" />')
        }
        if (racikan != 1) {
            $(`#${billId}`)
                .append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="dose[]" id="aordose' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="orig_dose[]" id="aororig_dose' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id[]" id="aormeasure_id' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id2[]" id="aormeasure_id2' + billId + '" type="hidden" class="form-control" />')
        } else {
            $(`#aordose${billId}`).on("change", function() {
                let dose = $(`#aordose${billId}`).val()
                let origDose = $(`#aororig_dose${billId}`).val()
                let jmlBks = $(`#aorjml_bks${billId}`).val()
                let dosePresc = jmlBks * dose / origDose;
                console.log(dose)
                console.log(origDose)
                console.log(jmlBks)
                console.log(dosePresc)
                $(`#aordose_presc${billId}`).val(dosePresc)
            })
        }



        $(`#${billId}`).append('<input name="theorder[]" id="aortheorder' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="brand_id[]" id="aorbrand_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="racikan[]" id="aorracikan' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="doctor[]" id="aordoctor' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id[]" id="aoremployee_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id_from[]" id="aoremployee_id_from' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="doctor_from[]" id="aordoctor_from' + billId + '" type="hidden" class="form-control" />')
            // .append('<input name="status_obat[]" id="aorstatus_obat' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="tarif_id[]" id="aortarif_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="treatment[]" id="aortreatment' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="tarif_type[]" id="aortarif_type' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="amount[]" id="aoramount' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="tagihan[]" id="aortagihan' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="subsidi[]" id="aorsubsidi' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="subsidisat[]" id="aorsubsidisat' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="margin[]" id="aormargin' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="ppn[]" id="aorppn' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="ppnvalue[]" id="aorppnvalue' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="discount[]" id="aordiscount' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="diskon[]" id="aordiskon' + billId + '" type="hidden" class="form-control" />')
            // .append('<input name="profession[]" id="aorprofession' + billId + '" type="hidden" class="form-control" />')
            // .append('<input name="profesi[]" id="aorprofesi' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="amount_paid[]" id="aoramount_paid' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="quantity[]" id="aorquantity' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="numer[]" id="aornumer' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="resep_no[]" id="aorresep_no' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="nota_no[]" id="aornota_no' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="treat_date[]" id="aortreat_date' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="bill_id[]" id="aorbill_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="class_room_id[]" id="aorclass_room_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="clinic_id[]" id="aorclinic_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="aorclinic_id_from' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="visit_id[]" id="aorvisit_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="no_registration[]" id="aorno_registration' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="trans_id[]" id="aortrans_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="modified_from[]" id="aormodified_from' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="modified_date[]" id="aormodified_date' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="isrj[]" id="aorisrj' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="thename[]" id="aorthename' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="theaddress[]" id="aortheaddress' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="theid[]" id="aortheid' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="org_unit_code[]" id="aororg_unit_code' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="islunas[]" id="aorislunas' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="cif[]" id="aorcif' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="aturanminum2[]" id="aoraturanminum2' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="dose1[]" id="aordose1' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="dose2[]" id="aordose2' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="sell_price[]" id="aorsell_price' + billId + '" type="hidden" class="form-control" />')
            // .append('<input name="module_id[]" id="aormodule_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="sold_status[]" id="aorsold_status' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="iscetak[]" id="aoriscetak' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="body_id[]" id="aorbody_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="status_tarif[]" id="aorstatus_tarif' + billId + '" type="hidden" class="form-control" />')



        $(`#${billId}`).append('<input name="description[]" id="aordescription' + billId + '" type="hidden" class="form-control" />')
        if (racikan == 0) {
            $(`#${billId}`).append('<input name="module_id[]" id="aormodule_id' + billId + '" type="hidden" class="form-control" />')
        }

        let measureArrayBks = ['5', '10', '17'];
        measureParam.forEach((melement, mkey) => {
            if (measureParam[mkey].measure_id == measureId) {
                measureIdName = measureParam[mkey].measurement;
            }
            if (measureParam[mkey].measure_id == measureId2) {
                console.log(measureParam[mkey].measurement)
                measureId2Name = measureParam[mkey].measurement;
            }
            if (measureParam[mkey].measure_id == measureDosis) {
                measureDosisName = measureParam[mkey].measurement;
            }
            if (measureParam[mkey].measure_id == '5' || measureParam[mkey].measure_id == '10' || measureParam[mkey].measure_id == '17') {
                $("#aormeasure_id2" + billId + "").append(new Option(measureParam[mkey].measurement, parseInt(measureParam[mkey].measure_id)));
            }
        });

        $("#aordose1" + billId).val(dose1);
        $("#aordose2" + billId).val(dose2);
        $("#aordose" + billId).val(dose);
        $("#aororig_dose" + billId).val(origDose);
        $("#aorresep_ke" + billId).val(resepKe);
        $("#aorbrand_id" + billId).val(brandId);
        // $("#aormeasure_id" + billId).val(measureId);
        $("#aormeasure_id" + billId).append(new Option(measureIdName, measureId));

        $("#aormeasure_idname" + billId).val(measureIdName);
        $("#aormeasure_id2" + billId).val(measureId2);
        // $("#aormeasure_id2" + billId).append(new Option(measureId2Name, measureId2));
        $("#aormeasure_id2name" + billId).val(measureId2);
        $("#aormeasure_dosis" + billId).append(new Option(measureDosisName, measureDosis));
        $("#aormeasure_dosisname" + billId).val(measureDosis);
        $("#aorracikan" + billId).val(racikan);
        $("#aordoctor" + billId).val(doctor);
        $("#aoremployee_id" + billId).val(employeeId);
        $("#aoremployee_id_from" + billId).val(employeeIdFrom);
        $("#aordoctor_from" + billId).val(doctorFrom);
        $("#aorstatus_obat" + billId).val(statusObat);
        $("#aortarif_id" + billId).val(tarifId);
        $("#aortreatment" + billId).val(treatment);
        $("#aortarif_type" + billId).val(tarifType);
        $("#aoramount" + billId).val(amount);
        $("#aorsell_price" + billId).val(sellPrice);
        $("#aortagihan" + billId).val(tagihan);
        $("#aorsubsidi" + billId).val(subsidi);
        $("#aorsubsidisat" + billId).val(subsidiSat);
        $("#aormargin" + billId).val(margin);
        $("#aorppn" + billId).val(ppn);
        $("#aorppnvalue" + billId).val(ppnValue);
        $("#aordiscount" + billId).val(discount);
        $("#aordiskon" + billId).val(diskon);
        $("#aorprofession" + billId).val(profession);
        $("#aorprofesi" + billId).val(profesi);
        $("#aoramount_paid" + billId).val(amountPlafond);
        $("#aorquantity" + billId).val(qty);
        $("#aornumer" + billId).val(numer);
        $("#aorresep_no" + billId).val(resepNo);
        $("#aornota_no" + billId).val(notaNo);
        $("#aortreat_date" + billId).val(treatDate);
        $("#aorbill_id" + billId).val(billId);
        $("#aorclass_room_id" + billId).val(classRoomId);
        $("#aorclinic_id" + billId).val(clinicId);
        $("#aorclinic_id_from" + billId).val(clinicIdFrom);
        $("#aortheorder" + billId).val(theOrder);
        $("#aorvisit_id" + billId).val(visitId);
        $("#aorno_registration" + billId).val(noRegistration);
        $("#aortrans_id" + billId).val(transId);
        $("#aormodified_from" + billId).val(modifiedFrom);
        $("#aormodified_date" + billId).val(modifiedDate);
        $("#aorisrj" + billId).val(isrj);
        $("#aorthename" + billId).val(thename);
        $("#aortheaddress" + billId).val(theaddress);
        $("#aortheid" + billId).val(theid);
        $("#aororg_unit_code" + billId).val(orgUnitCode)
        $("#islunas" + billId).val(islunas);

        // console.log(parseFloat(dosePresc).toFixed(2))
        $("#aordose_presc" + billId).val(parseFloat(dosePresc).toFixed(2))
        // decimalInput("#aordose_presc" + billId)

        $("#aordescription2" + billId).val(description2)
        $("#aoraturanminum2" + billId).val(description2)
        $("#aorcif" + billId).val(description)
        $("#aorjml_bks" + billId).val(jmlBks)
        $("#aordose" + billId).val(dose)
        // $("#aormodule_id" + billId).val(moduleId);
        $("#aormodule_id" + billId).val(moduleId);
        $("#aorsold_status" + billId).val(soldstatus);
        $("#aoriscetak" + billId).val(iscetak);
        $("#aorbody_id" + billId).val(bodyId);
        $("#aorstatus_tarif" + billId).val(status_tarif);

        if (resep == null) {
            if (soldstatus == '1' || soldstatus == '7') {
                if (racikan == 1) {
                    initializeResepRacikSelect2('aordescription1' + billId)
                } else {
                    initializeResepSelect2('aordescription1' + billId)
                }
                $("#aordescription" + billId).val(description)
            } else if (soldstatus == '8') {
                initializeResepAllSelect2('aordescription1' + billId)
                $("#aordescription" + billId).val(description)
            } else {
                initializeResepAlkesSelect2('aordescription1' + billId)
                $("#aordescription" + billId).val(description)
            }
        } else {
            if (soldstatus == '1' || soldstatus == '7') {
                if (racikan == 1) {
                    initializeResepRacikSelect2('aordescription1' + billId, resep.description)
                } else {
                    initializeResepSelect2('aordescription1' + billId, resep.description)
                }
                $("#aordescription" + billId).val(resep.description)
            } else if (soldstatus == '8') {
                initializeResepAllSelect2('aordescription1' + billId, resep.description)
                $("#aordescription" + billId).val(resep.description)
            } else {
                initializeResepAlkesSelect2('aordescription1' + billId, resep.description)
                $("#aordescription" + billId).val(resep.description)
            }
        }


        // if (racikan != 1) {} else {
        //     $("#aordescription" + billId).val(description);
        // }


        // $("#eresepAdd").slideUp()
        // $("#eresepRAdd").slideUp()
        $("#eresepTable").slideDown()
    }
</script>