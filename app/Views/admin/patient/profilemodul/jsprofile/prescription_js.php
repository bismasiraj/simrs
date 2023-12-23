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
        if (!is_null($visit['class_room_id'])) {
            if ($employee[$key]['employee_id'] == $visit['employee_inap']) {
            ?>
                var specialist = "<?= $employee[$key]['specialist_type_id']; ?>";

    <?php
            }
        }
    } ?>

    var clinicPres = <?= json_encode($clinic); ?>;
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



    var obat;

    function getResep(visit, nomor) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getResep',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                signaParam = data.signa;

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

                if (typeof data.resepNo !== 'undefined') {
                    resepNo = data.resepNo;

                    resepNo.forEach((element, key) => {
                        $("#resepno").append($('<option>').val(resepNo[key]).text(resepNo[key]));
                    });
                    resepDetail = data.obat;
                }

                visitHistory = data.visitHistory;

                console.log(visitHistory)

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
                    addBlankLine('racikan')
                    $("#eresepAdd").hide()
                    $("#eresepRAdd").hide()
                    $("#eresepTable").show()
                } else {
                    addBlankLine('nonracik')
                    $("#eresepAdd").hide()
                    $("#eresepRAdd").hide()
                    $("#eresepTable").show()
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
            $("#eresepAdd").hide()
            $("#eresepRAdd").hide()
            $("#eresepTable").show()

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
            addBlankLine('racikan')
        }

    }

    function addKomponen(noresep) {
        $("#resepno").val(noresep);
        addBlankLine('komponen')
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
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
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
            var resepKe = resepOrder
            var description = toItem.name
            var brandId = toItem.brand_id
            var measureId = toItem.measure_id
            var measureIdName = '';
            var measudeId2 = toItem.measure_id2
            var measureId2Name = '';
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

            measureParam.forEach((melement, mkey) => {
                if (measureParam[mkey].measure_id == measureId) {
                    measureIdName = measureParam[mkey].measurement;
                }
                if (measureParam[mkey].measure_id == measudeId2) {
                    measudeId2Name = measureParam[mkey].measurement;
                }
            });

            $("#aordose1" + billId).val(1);
            $("#aordose2" + billId).val(1);
            $("#aordose" + billId).val(dose);
            $("#aororig_dose" + billId).val(origDose);
            $("#aorresep_ke" + billId).val(resepKe);
            $("#aorbrand_id" + billId).val(brandId);
            $("#aormeasure_id" + billId).val(measureId);
            $("#aormeasure_idname" + billId).val(measureIdName);
            $("#aormeasure_id2" + billId).val(measudeId2);
            $("#aormeasure_id2name" + billId).val(measudeId2);
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
            $("#aortheorder" + billId).val(theOrder);
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
                        errorMsg(message);
                    } else {
                        successMsg(data.message);

                        $("#prescRItemBody").html("")
                        resepDetail = [];

                        data.data.forEach((element, key) => {
                            datachild = data.data[key]
                            console.log(datachild.bill_id)
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
</script>

<script type="text/javascript">
    function addBlankLine(obatType) {
        var racikan = 0;
        resep_no = $("#resepno").val()


        if (obatType != 'komponen') {
            resepOrder++;
            if (obatType != 'racikan') {
                theOrder = resepOrder;
                racikan = 0;
            } else {
                theOrder = 1;
                racikan = 1;
            }
        } else {
            theOrder++;
            racikan = 1;
        }

        console.log(racikan)
        console.log(theOrder)
        var resepKe = resepOrder;
        var billId = (get_datesecond() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', '');

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

        var jmlBks = 0;
        var dose = 0;
        var origDose = '';
        var description = '';
        var brandId = '';
        var measureId = '';
        var measudeId2 = '';
        var doctor = doctor
        var employeeId = '<?= $visit['employee_id']; ?>'
        var employeeIdFrom = '<?= $visit['employee_id']; ?>'
        var doctorFrom = '<?= $visit['fullname']; ?>'
        var statusObat = '';
        var tarifId = '';
        var treatment = "PEMBELIAN OBAT RACIKAN"
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
        if (racikan == 1)
            var measureIdName = 'Bks';
        else
            var measureIdName = ''



        if (racikan == 0) {
            $("#eresepBody").append($("<tr id='" + billId + "'>").attr("class", billId).attr('class', 'non-racikan')
                .append($('<td rowspan="2">')
                    .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td rowspan="2">')
                    .append('<select id="aordescription1' + billId + '" class="form-control select2-full-width fillitemidR" name="description1[]" onchange="itemObatChange(\'' + billId + '\',this.value)" style="width: 100%" ></select>')
                )
                .append($('<td rowspan="2">')
                    .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                )
                .append($('<td rowspan="2">')
                    .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                )
                .append($('<td colspan="5">').append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control">'))
                .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe)
                    .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="addNR()" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">NonRacikan</i></button>')
                        .append('<button type="button" onclick="addR()" class="btn btn-warning" data-row-id="1" autocomplete="off">Racikan</i></button>')
                    )
                )
                .append($('<td rowspan="2">')
                    .append('<button type="button" onclick="removeRacik(\'' + billId + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                )

            )
            $("#eresepBody").append($("<tr>").attr("class", billId).attr('class', 'non-racikan')
                .append($("<td>").append(dosisDiv))
                .append($("<td>").append(dosis2Div))
                .append($("<td>").append(signa2Div))
                .append($("<td>").append(signa4Div))
                .append($("<td>").append(signa5Div))
            )
        } else if (racikan == 1 && theOrder == '1') {
            $("#eresepBody").append($("<tr>").attr("class", billId).attr('class', 'racikan')
                .append($('<td rowspan="2">').attr("id", "tdresep_keresep" + resepKe)
                    .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td rowspan="2">').attr("id", "tddescriptionresep" + resepKe)
                    .append('<input type="text" name="description[]" id="aordescription' + billId + '" placeholder="" class="form-control">')

                )
                .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe)
                    .append('<input type="text" name="jml_bks[]" id="aorjml_bks' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                )
                .append($('<td rowspan="2">').attr("id", "tdmeasure_idnameresep" + resepKe)
                    .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="Bks" class="form-control medicine_name" readonly>')
                )
                .append($('<td colspan="5">').attr("id", "tddescription2resep" + resepKe)
                    .append('<input type="text" name="description2[]" id="aordescription2' + resepKe + '" placeholder="" class="form-control">')
                )

                .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe)
                    .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                        .append('<button type="button" onclick="addNR()" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">NonRacikan</i></button>')
                        .append('<button type="button" onclick="addR()" class="btn btn-warning" data-row-id="1" autocomplete="off">Racikan</i></button>')
                        .append('<button type="button" onclick="addKomponen(\'' + resepNo + '\')" class="btn btn-info" data-row-id="1" autocomplete="off">Komponen</i></button>')
                    )
                )
                .append($('<td rowspan="2">').attr("id", "tdbtnremoveracikresep" + resepKe)
                    .append('<button type="button" onclick="removeRacik(\'' + billId + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                )
            )
            $("#eresepBody").append($("<tr>").attr("id", "traturanminumresep" + resepKe)
                .attr("class", billId).attr('class', 'racikan')
                .append($("<td>").attr("id", "tddosisDiv" + resepKe)
                    .append(dosisDiv))
                .append($("<td>").attr("id", "tddosis2Div" + resepKe)
                    .append(dosis2Div))
                .append($("<td>").attr("id", "tdsigna2Div" + resepKe)
                    .append(signa2Div))
                .append($("<td>").attr("id", "tdsigna4Div" + resepKe)
                    .append(signa4Div))
                .append($("<td>").attr("id", "tdsigna5Div" + resepKe)
                    .append(signa5Div))
            )
        } else {
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

            $("#eresepBody").append($("<tr id='" + billId + "'>").attr("class", billId).attr('class', 'komponen')
                // .append($('<td>')
                //     // .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                // )
                .append($('<td>')
                    .append('<input type="text" name="description[]" id="aordescription' + billId + '" placeholder="" class="form-control">')
                )
                .append($('<td>')
                    // .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                )
                .append($('<td>')
                    // .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                )
                .append($("<td>").attr("id", "tddosisDiv" + resepKe)
                    .append(dosisDiv))
                .append($("<td>").attr("id", "tddosis2Div" + resepKe)
                    .append(dosis2Div))
                .append($("<td>").attr("id", "tdsigna2Div" + resepKe)
                    .append(signa2Div))
                .append($("<td>").attr("id", "tdsigna4Div" + resepKe)
                    .append(signa4Div))
                .append($("<td>").attr("id", "tdsigna5Div" + resepKe)
                    .append(signa5Div))
                // .append($('<td colspan="5">'))

                // .append($('<td>')
                //     // .append('<button type="button" onclick="addBlankLine()" class="addbtn nonracikbtn" data-row-id="1" autocomplete="off"><i class="fa fa-plus">NR</i></button>')
                //     // .append('<button type="button" onclick="addBlankLine()" class="addbtn racikbtn" data-row-id="1" autocomplete="off"><i class="fa fa-plus">R</i></button>')
                //     // .append('<button type="button" onclick="addBlankLineKomponen()" class="addbtn komponenbtn" data-row-id="1" autocomplete="off"><i class="fa fa-plus">K</i></button>')
                // )
                .append($('<td>')
                    .append('<button type="button" onclick="removeRacik(\'' + billId + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                )

            )
        }

        if (racikan == 1 && theOrder != '1') {
            $("#eresepBody").append('<input name="resep_ke[]" id="aorresep_ke' + billId + '" type="hidden" class="form-control" />')
            $("#eresepBody").append('<input name="description2[]" id="aordescription2' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
        }
        if (racikan != 1) {
            $("#eresepBody").append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
        } else {
            $("#eresepBody").append('<input name="dose_presc[]" id="aordose_presc' + billId + '" type="hidden" class="form-control" />')
        }


        // .append('<hr class="hr-panel-heading hr-10">')
        $("#eresepBody").append('<input name="theorder[]" id="aortheorder' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="brand_id[]" id="aorbrand_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="racikan[]" id="aorracikan' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="doctor[]" id="aordoctor' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id[]" id="aoremployee_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id_from[]" id="aoremployee_id_from' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="doctor_from[]" id="aordoctor_from' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="status_obat[]" id="aorstatus_obat' + billId + '" type="hidden" class="form-control" />')
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
            .append('<input name="profession[]" id="aorprofession' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="profesi[]" id="aorprofesi' + billId + '" type="hidden" class="form-control" />')
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
            .append('<input name="measure_id[]" id="aormeasure_id' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="measure_id2[]" id="aormeasure_id2' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="islunas[]" id="aorislunas' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="cif[]" id="aorcif' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="aturanminum2[]" id="aoraturanminum2' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="dose[]" id="aordose' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="orig_dose[]" id="aororig_dose' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="dose1[]" id="aordose1' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="dose2[]" id="aordose2' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="sell_price[]" id="aorsell_price' + billId + '" type="hidden" class="form-control" />')
            .append('<input name="module_id[]" id="aormodule_id' + billId + '" type="hidden" class="form-control" />')

        if (racikan == 0) {
            $("#eresepBody").append('<input name="description[]" id="aordescription' + billId + '" type="hidden" class="form-control" />')
        }

        $("#aordose1" + billId).val(1);
        $("#aordose2" + billId).val(1);
        $("#aordose" + billId).val(dose);
        $("#aororig_dose" + billId).val(origDose);
        $("#aorresep_ke" + billId).val(resepKe);
        $("#aorbrand_id" + billId).val(brandId);
        $("#aormeasure_id" + billId).val(measureId);
        $("#aormeasure_idname" + billId).val(measureIdName);
        $("#aormeasure_id2" + billId).val(measudeId2);
        $("#aormeasure_id2name" + billId).val(measudeId2);
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
        $("#aorresep_no" + billId).val(resep_no);
        $("#aornota_no" + billId).val(notaNo);
        $("#aortreat_date" + billId).val(treatDate);
        $("#aorbill_id" + billId).val(billId);
        $("#aorclass_room_id" + billId).val(classRoomId);
        $("#aorclinic_id" + billId).val(clinicId);
        $("#aorclinic_id_from" + billId).val(clinicIdFrom);
        $("#aortheorder" + billId).val(theOrder);
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
        $("#aordose" + billId).val(dose)
        $("#aordescription2" + billId).val(description2)
        $("#aoraturanminum2" + billId).val(description2)
        $("#aorcif" + billId).val(description)
        $("#aorjml_bks" + billId).val(jmlBks)
        $("#aordose" + billId).val(dose)
        $("#aormodule_id" + billId).val(moduleId);

        if (racikan != 1) {
            initializeResepSelect2('aordescription1' + billId);
            $("#aordescription" + billId).val(description)
        }
    }
</script>
<script type="text/javascript">
    function filteredResep(resepSelected) {
        $("#eresepBody").html("")
        resepOrder = 0;


        resepDetail.forEach((element, key) => {

            $(".komponenbtn").remove();


            resep = resepDetail[key];


            if (resepSelected == '%' || resep.resep_no == resepSelected) {
                resepOrder++;

                var billId = resep.bill_id


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
                var jmlBks = resep.jml_bks
                var dose = resep.dose
                var origDose = resep.orig_dose
                var resepKe = resep.resep_ke;
                var description = resep.description;
                var brandId = resep.brand_id;
                var measureId = resep.measure_id;
                var measureIdName = '';
                var measudeId2 = resep.measure_id2;
                var measureId2Name = '';
                var racikan = resep.racikan;
                var doctor = resep.doctor
                var employeeId = resep.employee_id
                var employeeIdFrom = resep.employee_id_from
                var doctorFrom = resep.doctor_from
                var statusObat = resep.status_obat;
                var tarifId = resep.tarif_id;
                var treatment = resep.treatment
                var tarifType = resep.tarif_type
                var amount = resep.amount
                var sellPrice = resep.sell_price
                var tagihan = resep.tagihan
                var subsidi = resep.subsidi
                var subsidiSat = resep.subsidiSat
                var margin = resep.margin
                var ppn = resep.ppn
                var ppnValue = resep.ppnvalue
                var discount = resep.discount
                var diskon = resep.diskon
                var profession = resep.profession
                var profesi = resep.profesi
                var amountPlafond = resep.amount_plafond
                var amountPaidPlafond = resep.amount_paid_plafond
                var description2 = resep.description2
                var dosePresc = resep.dose_presc
                var qty = resep.quantity
                var numer = resep.numer
                var resepNo = resep.resep_no
                var notaNo = resep.nota_no
                var treatDate = resep.treat_date
                var dose1 = resep.dose1
                var dose2 = resep.dose2
                var theorder = resep.theorder
                var classRoomId = resep.class_room_id
                var clinicId = resep.clinic_id
                var clinicIdFrom = resep.clinic_id_from
                var islunas = resep.islunas

                var visitId = resep.visit_id
                var noRegistration = resep.no_registration
                var transId = resep.trans_id
                var isrj = resep.isrj
                var thename = resep.thename
                var theaddress = resep.theaddress
                var modifiedDate = resep.modified_date
                var modifiedFrom = resep.modified_from
                var theid = resep.theid
                var orgUnitCode = resep.org_unit_code
                var cif = resep.cif
                var aturanminum2 = resep.aturanminum2
                var moduleId = resep.module_id

                if (racikan == 1) {
                    measureIdName = 'Bks';
                } else {
                    measureParam.forEach((melement, mkey) => {
                        if (measureParam[mkey].measure_id == measureId) {
                            measureIdName = measureParam[mkey].measurement;
                        }
                        if (measureParam[mkey].measure_id == measudeId2) {
                            measudeId2Name = measureParam[mkey].measurement;
                        }
                    });
                }


                if (racikan == 0) {
                    $("#eresepBody").append($("<tr id='" + billId + "'>").attr("class", billId).attr('class', 'non-racikan')
                        .append($('<td rowspan="2">')
                            .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                        )
                        .append($('<td rowspan="2">')
                            .append('<div class="p-2 select2-full-width"><select id="aordescription1' + billId + '" class="form-control fillitemidR" name="description1[]" onchange="itemObatChange(\'' + billId + '\',this.value)" ></select></div>')
                        )
                        .append($('<td rowspan="2">')
                            .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                        )
                        .append($('<td rowspan="2">')
                            .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                        )
                        .append($('<td colspan="5">').append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control">'))

                        .append($('<td rowspan="2">')
                            .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                .append('<button type="button" onclick="addNR()" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">NonRacikan</i></button>')
                                .append('<button type="button" onclick="addR()" class="btn btn-warning" data-row-id="1" autocomplete="off">Racikan</i></button>'))
                        )
                        .append($('<td rowspan="2">')
                            .append('<button type="button" onclick="removeRacik(\'' + billId + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                        )

                    )
                    $("#eresepBody").append($("<tr>").attr("class", billId).attr('class', 'non-racikan')
                        .append($("<td>").append(dosisDiv))
                        .append($("<td>").append(dosis2Div))
                        .append($("<td>").append(signa2Div))
                        .append($("<td>").append(signa4Div))
                        .append($("<td>").append(signa5Div))
                    )
                } else if (racikan == 1 && theorder == 1) {
                    $("#eresepBody").append($("<tr id='" + billId + "'>").attr("class", billId).attr('class', 'racikan')
                        .append($('<td rowspan="2">').attr("id", "tdresep_keresep" + resepKe + '' + resepNo)
                            .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                        )
                        .append($('<td rowspan="2">').attr("id", "tddescriptionresep" + resepKe + '' + resepNo)
                            .append('<input type="text" name="description[]" id="aordescription' + billId + '" placeholder="" class="form-control">')
                        )
                        .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe + '' + resepNo)
                            .append('<input type="text" name="jml_bks[]" id="aorjml_bks' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                        )
                        .append($('<td rowspan="2">').attr("id", "tdmeasure_idnameresep" + resepKe + '' + resepNo)
                            .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="Bks" class="form-control medicine_name" readonly>')
                        )
                        .append($('<td colspan="5">').attr("id", "tddescription2resep" + resepKe + '' + resepNo)
                            .append('<input type="text" name="description2[]" id="aordescription2' + resepKe + '" placeholder="" class="form-control">')
                        )

                        .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe + '' + resepNo)
                            .append($('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">')
                                .append('<button type="button" onclick="addNR()" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">NonRacikan</i></button>')
                                .append('<button type="button" onclick="addR()" class="btn btn-warning" data-row-id="1" autocomplete="off">Racikan</i></button>')
                                .append('<button type="button" onclick="addKomponen(\'' + resepNo + '\')" class="btn btn-info" data-row-id="1" autocomplete="off">Komponen</i></button>')
                            )
                        )
                        .append($('<td rowspan="2">').attr("id", "tdbtnremoveracikresep" + resepKe + '' + resepNo)
                            .append('<button type="button" onclick="removeRacik(\'' + billId + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                        )
                    )
                    $("#eresepBody").append($("<tr>").attr("id", "traturanminumresep" + resepKe + '' + resepNo)
                        .attr("class", billId).attr('class', 'racikan')
                        .append($("<td>").attr("id", "tddosisDiv" + resepKe + '' + resepNo)
                            .append(dosisDiv))
                        .append($("<td>").attr("id", "tddosis2Div" + resepKe + '' + resepNo)
                            .append(dosis2Div))
                        .append($("<td>").attr("id", "tdsigna2Div" + resepKe + '' + resepNo)
                            .append(signa2Div))
                        .append($("<td>").attr("id", "tdsigna4Div" + resepKe + '' + resepNo)
                            .append(signa4Div))
                        .append($("<td>").attr("id", "tdsigna5Div" + resepKe + '' + resepNo)
                            .append(signa5Div))
                    )
                } else {
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

                    $("#eresepBody").append($("<tr>").attr("class", billId).attr('class', 'komponen')
                        // .append($('<td>')
                        //     // .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                        // )
                        .append($('<td>')
                            .append('<input type="text" name="description[]" id="aordescription' + billId + '" placeholder="" class="form-control">')
                        )
                        .append($('<td>')
                            // .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'">')
                        )
                        .append($('<td>')
                            // .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                        )
                        .append($("<td>").attr("id", "tddosisDiv" + resepKe + '' + resepNo)
                            .append(dosisDiv))
                        .append($("<td>").attr("id", "tddosis2Div" + resepKe + '' + resepNo)
                            .append(dosis2Div))
                        .append($("<td>").attr("id", "tdsigna2Div" + resepKe + '' + resepNo)
                            .append(signa2Div))
                        .append($("<td>").attr("id", "tdsigna4Div" + resepKe + '' + resepNo)
                            .append(signa4Div))
                        .append($("<td>").attr("id", "tdsigna5Div" + resepKe + '' + resepNo)
                            .append(signa5Div))
                        // .append($('<td colspan="5">'))

                        // .append($('<td>')
                        //     // .append('<button type="button" onclick="addBlankLine()" class="addbtn nonracikbtn" data-row-id="1" autocomplete="off"><i class="fa fa-plus">NR</i></button>')
                        //     // .append('<button type="button" onclick="addBlankLine()" class="addbtn racikbtn" data-row-id="1" autocomplete="off"><i class="fa fa-plus">R</i></button>')
                        //     // .append('<button type="button" onclick="addBlankLineKomponen()" class="addbtn komponenbtn" data-row-id="1" autocomplete="off"><i class="fa fa-plus">K</i></button>')
                        // )
                        .append($('<td>')
                            .append('<button type="button" onclick="removeRacik(\'' + billId + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>')
                        )

                    )
                }

                if (racikan == 1 && theorder != '1') {
                    $("#eresepBody").append('<input name="resep_ke[]" id="aorresep_ke' + billId + '" type="hidden" class="form-control" />')
                    $("#eresepBody").append('<input name="description2[]" id="aordescription2' + billId + '" type="hidden" class="form-control" />')
                        .append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
                }
                if (racikan != 1) {
                    $("#eresepBody").append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
                } else {
                    $("#eresepBody").append('<input name="dose_presc[]" id="aordose_presc' + billId + '" type="hidden" class="form-control" />')
                }

                $("#eresepBody").append('<input name="theorder[]" id="aortheorder' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="brand_id[]" id="aorbrand_id' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="racikan[]" id="aorracikan' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="doctor[]" id="aordoctor' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="employee_id[]" id="aoremployee_id' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="employee_id_from[]" id="aoremployee_id_from' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="doctor_from[]" id="aordoctor_from' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="status_obat[]" id="aorstatus_obat' + billId + '" type="hidden" class="form-control" />')
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
                    .append('<input name="profession[]" id="aorprofession' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="profesi[]" id="aorprofesi' + billId + '" type="hidden" class="form-control" />')
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
                    .append('<input name="measure_id[]" id="aormeasure_id' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="measure_id2[]" id="aormeasure_id2' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="islunas[]" id="aorislunas' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="cif[]" id="aorcif' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="aturanminum2[]" id="aoraturanminum2' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="dose[]" id="aordose' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="orig_dose[]" id="aororig_dose' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="dose1[]" id="aordose1' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="dose2[]" id="aordose2' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="sell_price[]" id="aorsell_price' + billId + '" type="hidden" class="form-control" />')
                    .append('<input name="module_id[]" id="aormodule_id' + billId + '" type="hidden" class="form-control" />')
                if (racikan == 0) {
                    $("#eresepBody").append('<input name="module_id[]" id="aormodule_id' + billId + '" type="hidden" class="form-control" />')
                }

                $("#aordose1" + billId).val(dose1);
                $("#aordose2" + billId).val(dose2);
                $("#aordose" + billId).val(dose);
                $("#aororig_dose" + billId).val(origDose);
                $("#aorresep_ke" + billId).val(resepKe);
                $("#aorbrand_id" + billId).val(brandId);
                $("#aormeasure_id" + billId).val(measureId);
                $("#aormeasure_idname" + billId).val(measureIdName);
                $("#aormeasure_id2" + billId).val(measudeId2);
                $("#aormeasure_id2name" + billId).val(measudeId2);
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
                $("#aortheorder" + billId).val(theorder);
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
                $("#aordose_presc" + billId).val(dosePresc)
                decimalInput("#aordose_presc" + billId)

                $("#aordescription2" + billId).val(description2)
                $("#aoraturanminum2" + billId).val(description2)
                $("#aorcif" + billId).val(description)
                $("#aorjml_bks" + billId).val(jmlBks)
                $("#aordose" + billId).val(dose)
                $("#aormodule_id" + billId).val(moduleId);
                if (racikan != 1) {
                    initializeResepSelect2('aordescription1' + billId, resep.description);
                    $("#aordescription" + billId).val(description);
                } else {
                    $("#aordescription" + billId).val(description);
                }


                $("#eresepAdd").hide()
                $("#eresepRAdd").hide()
                $("#eresepTable").show()
            }
        });
    }

    function removeRacik(brand) {
        if (confirm('Apakah anda yakin akan menghapus item ini?') == true) {
            $("#" + brand).remove()
        }
    }
</script>