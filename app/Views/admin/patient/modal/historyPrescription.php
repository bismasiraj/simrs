<div class="modal fade" id="historyEresepModal" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-media-content">

            <div class="modal-header modal-media-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <h4>History Obat Pasien</h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div><!--./row-->
                </div>
            </div><!--./modal-header-->
            <form id="s" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                <div class="pup-scroll-area">

                    <div class="modal-body pb0 ptt10">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="accordion">
                                    <div class="panel-group" id="historyEresep">
                                    </div>
                                </div>
                            </div><!--./box-footer-->
                        </div>
                        <div id=""></div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div><!--./row-->
            </form>
        </div>

    </div><!--./modal-body-->
</div>

<script type="text/javascript">
    function fillHistoryEresep(resep, keyvisit) {
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
            $("#body" + keyvisit).append($("<tr>").attr("class", billId).attr('class', 'non-racikan')
                .append($('<td>')
                    .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td>')
                    .append('<div class="p-2 select2-full-width"><select id="aordescription' + billId + '" class="form-control fillitemidR" name="description[]" onchange="itemObatChange(\'' + billId + '\',this.value)" readonly></select></div>')
                )
                .append($('<td>')
                    .append('<input type="text" name="dose_presc[]" id="aordose_presc' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'" readonly>')
                )
                .append($('<td>')
                    .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                )
                .append($('<td colspan="5">').append('<input type="text" name="description2[]" id="aordescription2' + billId + '" placeholder="" class="form-control" readonly>'))


            )
            // $("#body" + keyvisit).append($("<tr>").attr("class", billId).attr('class', 'non-racikan')
            //     .append($("<td>").append(dosisDiv))
            //     .append($("<td>").append(dosis2Div))
            //     .append($("<td>").append(signa2Div))
            //     .append($("<td>").append(signa4Div))
            //     .append($("<td>").append(signa5Div))
            // )
        } else if (racikan == 1 && theorder == 1) {
            $("#body" + keyvisit).append($("<tr>").attr("class", billId).attr('class', 'racikan')
                .append($('<td rowspan="2">').attr("id", "tdresep_keresep" + resepKe + '' + resepNo)
                    .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                )
                .append($('<td rowspan="2">').attr("id", "tddescriptionresep" + resepKe + '' + resepNo)
                    .append('<input type="text" name="description[]" id="aordescription' + billId + '" placeholder="" class="form-control" readonly>')

                )
                .append($('<td rowspan="2">').attr("id", "tdjml_bks" + resepKe + '' + resepNo)
                    .append('<input type="text" name="jml_bks[]" id="aorjml_bks' + billId + '" placeholder="" value="" class="form-control text-right"  onchange="decimalInput(this)"  onfocus="this.value=\'\'" readonly>')
                )
                .append($('<td rowspan="2">').attr("id", "tdmeasure_idnameresep" + resepKe + '' + resepNo)
                    .append('<input type="text" name="" id="aormeasure_idname' + billId + '" placeholder="" value="Bks" class="form-control medicine_name" readonly>')
                )
                .append($('<td colspan="5">').attr("id", "tddescription2resep" + resepKe + '' + resepNo)
                    .append('<input type="text" name="description2[]" id="aordescription2' + resepKe + '" placeholder="" class="form-control" readonly>')
                )

                // .append($('<td rowspan="2">').attr("id", "tdbtnracikresep" + resepKe + '' + resepNo))
                // .append($('<td rowspan="2">').attr("id", "tdbtnremoveracikresep" + resepKe + '' + resepNo))
            )
            $("#body" + keyvisit).append($("<tr>").attr("id", "traturanminumresep" + resepKe + '' + resepNo)
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

            $("#body" + keyvisit).append($("<tr>").attr("class", billId).attr('class', 'komponen')
                // .append($('<td>')
                //     // .append('<input type="text" name="resep_ke[]" id="aorresep_ke' + billId + '" placeholder="" value="" class="form-control text-right" readonly>')
                // )
                .append($('<td>')
                    .append('<input type="text" name="description[]" id="aordescription' + billId + '" placeholder="" class="form-control" readonly>')
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
                // .append($('<td>'))

            )
        }

        if (racikan == 1 && theorder != '1') {
            $("#body" + keyvisit).append('<input name="resep_ke[]" id="aorresep_ke' + billId + '" type="hidden" class="form-control" />')
            $("#body" + keyvisit).append('<input name="description2[]" id="aordescription2' + billId + '" type="hidden" class="form-control" />')
                .append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
        }
        if (racikan != 1) {
            $("#body" + keyvisit).append('<input name="jml_bks[]" id="aorjml_bks' + billId + '" type="hidden" class="form-control" />')
        } else {
            $("#body" + keyvisit).append('<input name="dose_presc[]" id="aordose_presc' + billId + '" type="hidden" class="form-control" />')
        }

        $("#body" + keyvisit).append('<input name="theorder[]" id="aortheorder' + billId + '" type="hidden" class="form-control" />')
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
            initializeResepSelect2('aordescription' + billId, resep.description);
        } else {
            $("#aordescription" + billId).val(description);
        }
    }
</script>