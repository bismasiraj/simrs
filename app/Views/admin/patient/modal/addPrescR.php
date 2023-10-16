<div class="modal fade" id="addPrescR" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog pup100" role="document">
        <div class="modal-content modal-media-content">

            <div class="modal-header modal-media-header">
                <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="p-2 select2-full-width">
                            <select onchange="addRItemObat(this.value)" class="form-control patient_list_ajax" id="fillitemidR">
                            </select>
                        </div>
                    </div>
                </div><!--./row-->
            </div><!--./modal-header-->
            <form id="s" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

                <div class="pup-scroll-area">

                    <div class="modal-body pb0 ptt10">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input name="customer_name" id="patient_name" type="hidden" class="form-control">


                                <input name="action_type" id="action_type" value="insert" type="hidden" class="form-control">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table tableover table-striped mb0 table-bordered table-hover tablefull12 tblProducts" id="tableID">
                                                <thead>
                                                    <tr class="font13 white-space-nowrap">
                                                        <th style="width:2%">R/<small class="req" style="color:red;"> *</small></th>
                                                        <th>Nama Obat<small class="req" style="color:red;"> *</small></th>
                                                        <th class="text-center" style="width:15%;" colspan="5">Komposisi Resep<small class="req" style="color:red;"> *</th>
                                                        <th class="text-center" style="width:15%" colspan="2">Dosis Obat<small class="req" style="color:red;"> *</small></th>
                                                        <th class="text-center" style="width:15%" colspan="2">Jumlah Resep <small class="req" style="color:red;">*</small></th>
                                                        <th class="text-center" style="width:15%">Harga Jual <small class="req" style="color:red;">*</small></th>
                                                        <th class="text-right" style="width:2%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id=prescRItemBody>
                                                </tbody>
                                            </table>


                                        </div>
                                        <div class="divider"></div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">

                                                            <div class="col-sm-4">
                                                                <div class="form-group"><label>JML BUNGKUS</label><input type="text" name="jml_bks" id="aorjml_bks" placeholder="" value="" class="form-control" onchange="jmlBksChange(this)" onfocus="this.value=''"></div>
                                                            </div>
                                                            <div class="col-sm-8 col-xs-8">
                                                                <div class="form-group"><label>SIGNA 3</label><select onchange="generateDescriptionRacik()" name="module_id" id="module_id" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>DOSIS OBAT</label><select onchange="generateDescriptionRacik()" name="dosisLine1" id="dosisLine1" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>JML PER MINUM</label><select onchange="generateDescriptionRacik()" name="dosisLine2" id="dosisLine2" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>SIGNA 4</label><select onchange="generateDescriptionRacik()" name="signa2" id="signa2" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>WAKTU PEMBERIAN</label><select onchange="generateDescriptionRacik()" name="signa4" id="signa4" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>RUTE</label><select onchange="generateDescriptionRacik()" name="signa5" id="signa5" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-12 col-xs-12">
                                                                <div class="form-group"><label>ATURAN MINUM</label><input type="text" name="description2" id="description2" placeholder="" class="form-control"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--./col-sm-6-->

                                        </div><!--./row-->
                                    </div><!--./col-md-12-->


                                </div><!--./row-->
                            </div><!--./box-footer-->
                        </div>
                        <div id=""></div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="submit" id="addPrescRBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                            </div>
                        </div>
                    </div><!--./row-->
            </form>
        </div>

    </div><!--./modal-body-->
</div>
</div>


<script type="text/javascript">
    <?php
    $option = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $optionJml = [0, 1, 2, 3, 4, 5, '1/2', '1/4', '1/3', '3/4'];
    foreach ($option as $key => $value) {
        $option[$key] = $option[$key] . "x Sehari";
    }
    ?>
    var option = <?= json_encode($option); ?>;
    var optionJml = <?= json_encode($optionJml); ?>;

    var toItem;

    function addRItemObat(value) {

        resep_no = $("#resepno").val();

        if (resep_no == '%') {
            generateResep('<?= $visit['no_registration']; ?>', '<?= $visit['clinic_id']; ?>', '<?= $visit['isrj']; ?>')
        }


        toItem = JSON.parse(value)


        var isexist = false;
        $("input[id*=" + toItem.brand_id + "]").each(function(i, el) {
            isexist = true;
        });


        if (isexist == false) {
            var jmlBks = 1
            var dose = 1
            var origDose = toItem.size_goods
            var resepKe = resepOrder
            var description = toItem.name
            var brandId = toItem.brand_id
            var measureId = toItem.measure_id
            var measudeId2 = toItem.measure_id2
            var racikan = '1'
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
            theOrder++
            var billId = (get_datesecond() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', '');
            var classRoomId = ""
            var clinicId = '<?= $visit['clinic_id']; ?>'
            var clinicIdFrom = '<?= $visit['clinic_id']; ?>'
            var islunas = 0


            measureParam.forEach((melement, mkey) => {
                if (measureParam[mkey].measure_id == measureId) {
                    measureId = measureParam[mkey].measurement;
                }
                if (measureParam[mkey].measure_id == measudeId2) {
                    measudeId2 = measureParam[mkey].measurement;
                }
            });




            $("#prescRItemBody").append($("<tr>").attr("id", toItem.brand_id)
                    .append($('<td>')
                        .append('<input type="text" name="theorder[]" id="aortheorder' + toItem.brand_id + '" placeholder="" value="' + toItem.name + '" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="description[]" id="aordescription' + toItem.brand_id + '" placeholder="" value="' + toItem.name + '" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="dose1[]" id="aordose1' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="racikItemChange(this,\'' + toItem.brand_id + '\')" onblur="racikItemChange(this,\'' + toItem.brand_id + '\')" onfocus="this.value=\'\'">')
                    )
                    .append($("<td>").html("/"))
                    .append($("<td>")
                        .append('<input type="text" name="dose2[]" id="aordose2' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="racikItemChange(this,\'' + toItem.brand_id + '\')" onblur="racikItemChange(this,\'' + toItem.brand_id + '\')" onfocus="this.value=\'\'">')
                    )
                    .append($("<td>").html("="))
                    .append($("<td>")
                        .append('<input type="text" name="dose[]" id="aordose' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="orig_dose[]" id="aororig_dose' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="racikItemChange(this,\'' + toItem.brand_id + '\')" onblur="racikItemChange(this,\'' + toItem.brand_id + '\')" onfocus="this.value=\'\'">')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="" id="aormeasure_id2name' + toItem.brand_id + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="dose_presc[]" id="aordose_presc' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="decimalInput(this)" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="" id="aormeasure_idname' + toItem.brand_id + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<div class="input-group"><span class="input-group-addon ">Rp </span><input type="text" name="sell_price[]" id="aorsell_price' + toItem.brand_id + '" placeholder="" value="" class="form-control medicine_name" readonly></div>')
                    )
                    .append($("<td>")
                        .append('<button type="button" onclick="removeRacik(\'' + toItem.brand_id + '\')" class="closebtn delete_row" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>')
                    )

                )
                .append('<hr class="hr-panel-heading hr-10">')
                .append('<input name="brand_id[]" id="aorbrand_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="racikan[]" id="aorracikan' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="doctor[]" id="aordoctor' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="employee_id[]" id="aoremployee_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="employee_id_from[]" id="aoremployee_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="doctor_from[]" id="aordoctor_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="status_obat[]" id="aorstatus_obat' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="tarif_id[]" id="aortarif_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="treatment[]" id="aortreatment' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="tarif_type[]" id="aortarif_type' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="amount[]" id="aoramount' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="tagihan[]" id="aortagihan' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="subsidi[]" id="aorsubsidi' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="subsidisat[]" id="aorsubsidisat' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="margin[]" id="aormargin' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="ppn[]" id="aorppn' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="ppnvalue[]" id="aorppnvalue' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="discount[]" id="aordiscount' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="diskon[]" id="aordiskon' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="profession[]" id="aorprofession' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="profesi[]" id="aorprofesi' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="amount_paid[]" id="aoramount_paid' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="quantity[]" id="aorquantity' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="numer[]" id="aornumer' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="resep_no[]" id="aorresep_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="nota_no[]" id="aornota_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="treat_date[]" id="aortreat_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="bill_id[]" id="aorbill_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="class_room_id[]" id="aorclass_room_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="clinic_id[]" id="aorclinic_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="clinic_id_from[]" id="aorclinic_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="visit_id[]" id="aorvisit_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="no_registration[]" id="aorno_registration' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="trans_id[]" id="aortrans_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="modified_from[]" id="aormodified_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="modified_date[]" id="aormodified_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="isrj[]" id="aorisrj' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="thename[]" id="aorthename' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="theaddress[]" id="aortheaddress' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="theid[]" id="aortheid' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="org_unit_code[]" id="aororg_unit_code' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="resep_ke[]" id="aorresep_ke' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id[]" id="aormeasure_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id2[]" id="aormeasure_id2' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="islunas[]" id="aorislunas' + toItem.brand_id + '" type="hidden" class="form-control" />')

            $("#aordose1" + toItem.brand_id).val(1);
            $("#aordose2" + toItem.brand_id).val(1);
            $("#aordose" + toItem.brand_id).val(dose);
            $("#aororig_dose" + toItem.brand_id).val(origDose);
            $("#aorresep_ke" + toItem.brand_id).val(resepKe);
            $("#aorbrand_id" + toItem.brand_id).val(brandId);
            $("#aormeasure_id" + toItem.brand_id).val(toItem.measure_id);
            $("#aormeasure_idname" + toItem.brand_id).val(measureId);
            $("#aormeasure_id2" + toItem.brand_id).val(toItem.measure_id2);
            $("#aormeasure_id2name" + toItem.brand_id).val(measudeId2);
            $("#aorracikan" + toItem.brand_id).val(racikan);
            $("#aordoctor" + toItem.brand_id).val(doctor);
            $("#aoremployee_id" + toItem.brand_id).val(employeeId);
            $("#aoremployee_id_from" + toItem.brand_id).val(employeeIdFrom);
            $("#aordoctor_from" + toItem.brand_id).val(doctorFrom);
            $("#aorstatus_obat" + toItem.brand_id).val(statusObat);
            $("#aortarif_id" + toItem.brand_id).val(tarifId);
            $("#aortreatment" + toItem.brand_id).val(treatment);
            $("#aortarif_type" + toItem.brand_id).val(tarifType);
            $("#aoramount" + toItem.brand_id).val(amount);
            $("#aorsell_price" + toItem.brand_id).val(sellPrice);
            $("#aortagihan" + toItem.brand_id).val(tagihan);
            $("#aorsubsidi" + toItem.brand_id).val(subsidi);
            $("#aorsubsidisat" + toItem.brand_id).val(subsidiSat);
            $("#aormargin" + toItem.brand_id).val(margin);
            $("#aorppn" + toItem.brand_id).val(ppn);
            $("#aorppnvalue" + toItem.brand_id).val(ppnValue);
            $("#aordiscount" + toItem.brand_id).val(discount);
            $("#aordiskon" + toItem.brand_id).val(diskon);
            $("#aorprofession" + toItem.brand_id).val(profession);
            $("#aorprofesi" + toItem.brand_id).val(profesi);
            $("#aoramount_paid" + toItem.brand_id).val(amountPlafond);
            $("#aorquantity" + toItem.brand_id).val(qty);
            $("#aornumer" + toItem.brand_id).val(numer);
            $("#aorresep_no" + toItem.brand_id).val(resep_no);
            $("#aornota_no" + toItem.brand_id).val(notaNo);
            $("#aortreat_date" + toItem.brand_id).val(treatDate);
            $("#aorbill_id" + toItem.brand_id).val(billId);
            $("#aorclass_room_id" + toItem.brand_id).val(classRoomId);
            $("#aorclinic_id" + toItem.brand_id).val(clinicId);
            $("#aorclinic_id_from" + toItem.brand_id).val(clinicIdFrom);
            $("#aortheorder" + toItem.brand_id).val(theOrder);
            $("#aorvisit_id" + toItem.brand_id).val('<?= $visit['visit_id']; ?>');
            $("#aorno_registration" + toItem.brand_id).val('<?= $visit['no_registration']; ?>');
            $("#aortrans_id" + toItem.brand_id).val('<?= $visit['trans_id']; ?>');
            $("#aormodified_from" + toItem.brand_id).val('<?= $visit['clinic_id']; ?>');
            $("#aormodified_date" + toItem.brand_id).val(get_date());
            $("#aorisrj" + toItem.brand_id).val('<?= $visit['isrj']; ?>');
            $("#aorthename" + toItem.brand_id).val('<?= $visit['diantar_oleh']; ?>');
            $("#aortheaddress" + toItem.brand_id).val('<?= $visit['visitor_address']; ?>');
            $("#aortheid" + toItem.brand_id).val('<?= $visit['pasien_id']; ?>');
            $("#aororg_unit_code" + toItem.brand_id).val('<?= $visit['org_unit_code']; ?>')
            $("#islunas" + toItem.brand_id).val(islunas);
        } else {
            alert("obat " + toItem.name + " sudah ada")
        }
    }

    function generateDescriptionRacik() {
        var desc2 = $("#dosisLine1").val() + ' ' + $("#dosisLine2").val() + ' ' + $("#signa2").val() + ' ' + $("#signa4").val() + '; ' + $("#signa5").val();
        $("#description2").val(desc2);
    }


    $("#s").on('submit', (function(e) {
        alert('masuk')
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
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

                    data.data.forEach((element, key) => {
                        resepDetail.push(data.data[key])
                    });


                    filteredResep(resep_no)

                    $("#addPrescR").modal('hide');
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

    function racikItemChange(prop, brand_id) {
        decimalInput(prop)

        var jmlBks = $("#aorjml_bks").val()
        var origDose = $("#aororig_dose" + brand_id).val()

        var dose1 = $("#aordose1" + brand_id).val()
        var dose2 = $("#aordose2" + brand_id).val()
        var theDose = (Math.round((dose1 / dose2) * 100) / 100).toFixed(2)
        $("#aordose" + brand_id).val(theDose)

        var ldcDosis = ukuranResep(jmlBks, origDose, theDose, "aordose_presc" + brand_id)

        $("#aordose_presc" + brand_id).val(ldcDosis)

    }

    function ukuranResep(jmlBks, origDose, theDose, prop) {

        console.log(jmlBks)
        console.log(origDose)
        console.log(theDose)

        var ldcDosis;

        if (origDose == 0)
            origDose = 1;
        if (theDose > 1)
            ldcDosis = jmlBks * (theDose / origDose)
        else if (theDose <= 1)
            ldcDosis = jmlBks * theDose
        else
            ldcDosis = 1

        console.log(ldcDosis)

        return ldcDosis;



    }

    function jmlBksChange(prop) {
        decimalInput(prop)

        var jmlBks = $(prop).val()
        $("input[id*='brand_id']").each(function(i, el) {
            var brd = $("#" + this.id).val()
            var origDose = $("#aororig_dose" + brd).val()

            var dose1 = $("#aordose1" + brd).val()
            var dose2 = $("#aordose2" + brd).val()
            var theDose = (Math.round((dose1 / dose2) * 100) / 100).toFixed(2)
            $("#aordose" + brd).val(theDose)

            var ldcDosis = ukuranResep(jmlBks, origDose, theDose, "aordose_presc" + brd)

            $("#aordose_presc" + brd).val(ldcDosis)
        });
    }

    function removeRacik(brand) {
        if (confirm('Apakah anda yakin akan menghapus item ini?') == true) {
            $("#" + brand).remove()
        }
    }
</script>