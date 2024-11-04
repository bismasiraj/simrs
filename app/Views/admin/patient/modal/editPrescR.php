<div class="modal fade" id="editPrescR" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog pup100" role="document">
        <div class="modal-content modal-media-content">

            <div class="modal-header modal-media-header">
                <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="p-2 select2-full-width">
                            <h4>Edit Racikan</h4>
                        </div>
                    </div>
                </div><!--./row-->
            </div><!--./modal-header-->
            <form id="formeditprescr" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">

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
                                                <tbody id="editprescItemBodyRacik">
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
                                                                <div class="form-group"><label>JML BUNGKUS</label><input type="text" name="jml_bks" id="eorjml_bks" placeholder="" value="" class="form-control" onchange="editJmlBksChange(this)" onfocus="this.value=''"></div>
                                                            </div>
                                                            <div class="col-sm-8 col-xs-8">
                                                                <div class="form-group"><label>SIGNA 3</label><select onchange="editGenerateDescriptionRacik()" name="module_id" id="eormodule_id" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>DOSIS OBAT</label><select onchange="editGenerateDescriptionRacik()" name="dosisLine1" id="eordosisLine1" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>JML PER MINUM</label><select onchange="editGenerateDescriptionRacik()" name="dosisLine2" id="eordosisLine2" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>SIGNA 4</label><select onchange="editGenerateDescriptionRacik()" name="signa2" id="eorsigna2" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>WAKTU PEMBERIAN</label><select onchange="editGenerateDescriptionRacik()" name="signa4" id="eorsigna4" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <div class="form-group"><label>RUTE</label><select onchange="editGenerateDescriptionRacik()" name="signa5" id="eorsigna5" class="form-control">

                                                                    </select></div>
                                                            </div>
                                                            <div class="col-sm-12 col-xs-12">
                                                                <div class="form-group"><label>ATURAN MINUM</label><input type="text" name="description2" id="eordescription2" placeholder="" class="form-control"></div>
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
                        <div></div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="submit" id="editPrescRBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                                <button type="button" id="removePrescRBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info" onclick="removeRacikan()">Hapus Racikan</button>
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

    var selectedResepKe;
    var selectedResepNo;

    function editItemObatRacik(value, lsresepKe, lsresepNo) {
        holdModal('editPrescR')

        $("#resepno").val(lsresepNo);
        $("#editprescItemBodyRacik").html("")

        selectedResepKe = lsresepKe
        selectedResepNo = lsresepNo


        var resepToEdit = [];

        resepDetail.forEach((element, key) => {
            if (resepDetail[key].resep_no == lsresepNo && resepDetail[key].resep_ke == lsresepKe)
                resepToEdit.push(resepDetail[key])
        });

        resepToEdit.forEach((element, key) => {
            var toItem = resepToEdit[key];


            var jmlBks = toItem.jml_bks
            var dose = toItem.dose
            var origDose = toItem.orig_dose
            var resepKe = toItem.resep_ke
            var description = toItem.description
            var brandId = toItem.brand_id
            var measureId = toItem.measure_id
            var measudeId2 = toItem.measure_id2
            var racikan = toItem.racikan
            var doctor = toItem.doctor
            var employeeId = toItem.employee_id
            var employeeIdFrom = toItem.employee_id_from
            var doctorFrom = toItem.doctor_from
            var statusObat = toItem.status_obat
            var tarifId = toItem.tarif_id
            var treatment = toItem.treatment
            var tarifType = toItem.tarif_type
            var amount = toItem.amount
            var sellPrice = (Math.round((toItem.sell_price) * 100) / 100).toFixed(2)
            var tagihan = toItem.tagihan
            var subsidi = toItem.subsidi
            var subsidiSat = toItem.subsidisat
            var margin = toItem.margin
            var ppn = toItem.ppn
            var ppnValue = toItem.ppn_value
            var discount = toItem.discount
            var diskon = toItem.diskon
            var profession = toItem.profession
            var profesi = toItem.profesi
            var amountPlafond = toItem.amount_plafond
            var amountPaidPlafond = toItem.amount_paid_plafond
            var description2 = toItem.description2
            var dosePresc = toItem.dose_presc
            var qty = toItem.quantity
            var numer = toItem.numer
            var resepNo = toItem.resep_no
            var notaNo = toItem.nota_no
            var treatDate = toItem.treat_date
            var dose1 = toItem.dose1
            var dose2 = toItem.dose2
            var billId = toItem.bill_id
            var classRoomId = toItem.class_room_id
            var clinicId = toItem.clinic_id
            var clinicIdFrom = toItem.clinic_id_from
            var islunas = toItem.islunas
            var moduleId = toItem.module_id
            var theOrder = toItem.theorder



            measureParam.forEach((melement, mkey) => {
                if (measureParam[mkey].measure_id == measureId) {
                    measureId = measureParam[mkey].measurement;
                }
                if (measureParam[mkey].measure_id == measudeId2) {
                    measudeId2 = measureParam[mkey].measurement;
                }
            });



            $("#editprescItemBodyRacik").append($("<tr>").attr("id", toItem.brand_id)
                    .append($('<td>')
                        .append('<input type="text" name="theorder[]" id="eortheorder' + toItem.brand_id + '" placeholder="" value="' + toItem.name + '" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="description[]" id="eordescription' + toItem.brand_id + '" placeholder="" value="' + toItem.name + '" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="dose1[]" id="eordose1' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="editRacikItemChange(this,\'' + toItem.brand_id + '\')" onblur="editRacikItemChange(this,\'' + toItem.brand_id + '\')" onfocus="this.value=\'\'">')
                    )
                    .append($("<td>").html("/"))
                    .append($("<td>")
                        .append('<input type="text" name="dose2[]" id="eordose2' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="editRacikItemChange(this,\'' + toItem.brand_id + '\')" onblur="editRacikItemChange(this,\'' + toItem.brand_id + '\')" onfocus="this.value=\'\'">')
                    )
                    .append($("<td>").html("="))
                    .append($("<td>")
                        .append('<input type="text" name="dose[]" id="eordose' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="orig_dose[]" id="eororig_dose' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="editRacikItemChange(this,\'' + toItem.brand_id + '\')" onblur="editRacikItemChange(this,\'' + toItem.brand_id + '\')" onfocus="this.value=\'\'">')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="" id="eormeasure_id2name' + toItem.brand_id + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="dose_presc[]" id="eordose_presc' + toItem.brand_id + '" placeholder="" value="" class="form-control text-right qty" onchange="decimalInput(this)" readonly>')
                    )
                    .append($("<td>")
                        .append('<input type="text" name="" id="eormeasure_idname' + toItem.brand_id + '" placeholder="" value="" class="form-control medicine_name" readonly>')
                    )
                    .append($("<td>")
                        .append('<div class="input-group"><span class="input-group-addon ">Rp </span><input type="text" name="sell_price[]" id="eorsell_price' + toItem.brand_id + '" placeholder="" value="" class="form-control medicine_name" readonly></div>')
                    )
                    .append($("<td>")
                        .append('<button type="button" onclick="removeRacik(\'' + toItem.brand_id + '\')" class="closebtn delete_row" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>')
                    )

                )
                .append('<hr class="hr-panel-heading hr-10">')
                .append('<input name="brand_id[]" id="eorbrand_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="racikan[]" id="eorracikan' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="doctor[]" id="eordoctor' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="employee_id[]" id="eoremployee_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="employee_id_from[]" id="eoremployee_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="doctor_from[]" id="eordoctor_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="status_obat[]" id="eorstatus_obat' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="tarif_id[]" id="eortarif_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="treatment[]" id="eortreatment' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="tarif_type[]" id="eortarif_type' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="amount[]" id="eoramount' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="tagihan[]" id="eortagihan' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="subsidi[]" id="eorsubsidi' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="subsidisat[]" id="eorsubsidisat' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="margin[]" id="eormargin' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="ppn[]" id="eorppn' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="ppnvalue[]" id="eorppnvalue' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="discount[]" id="eordiscount' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="diskon[]" id="eordiskon' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="profession[]" id="eorprofession' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="profesi[]" id="eorprofesi' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="amount_paid[]" id="eoramount_paid' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="quantity[]" id="eorquantity' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="numer[]" id="eornumer' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="resep_no[]" id="eorresep_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="nota_no[]" id="eornota_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="treat_date[]" id="eortreat_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="bill_id[]" id="eorbill_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="class_room_id[]" id="eorclass_room_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="clinic_id[]" id="eorclinic_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="clinic_id_from[]" id="eorclinic_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="visit_id[]" id="eorvisit_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="no_registration[]" id="eorno_registration' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="trans_id[]" id="eortrans_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="modified_from[]" id="eormodified_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="modified_date[]" id="eormodified_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="isrj[]" id="eorisrj' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="thename[]" id="eorthename' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="theaddress[]" id="eortheaddress' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="theid[]" id="eortheid' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="org_unit_code[]" id="eororg_unit_code' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="resep_ke[]" id="eorresep_ke' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id[]" id="eormeasure_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="measure_id2[]" id="eormeasure_id2' + toItem.brand_id + '" type="hidden" class="form-control" />')
                .append('<input name="islunas[]" id="eorislunas' + toItem.brand_id + '" type="hidden" class="form-control" />')

            $("#eorjml_bks").val(jmlBks);
            $("#eormodule_id").val(moduleId);
            $("#eordescription2").val(description2);
            $("#eordose_presc" + toItem.brand_id).val(dosePresc);
            $("#eordescription" + toItem.brand_id).val(description);
            $("#eordose1" + toItem.brand_id).val(dose1);
            $("#eordose2" + toItem.brand_id).val(dose2);
            $("#eordose" + toItem.brand_id).val(dose);
            $("#eororig_dose" + toItem.brand_id).val(origDose);
            $("#eorresep_ke" + toItem.brand_id).val(resepKe);
            $("#eorbrand_id" + toItem.brand_id).val(brandId);
            $("#eormeasure_id" + toItem.brand_id).val(toItem.measure_id);
            $("#eormeasure_idname" + toItem.brand_id).val(measureId);
            $("#eormeasure_id2" + toItem.brand_id).val(toItem.measure_id2);
            $("#eormeasure_id2name" + toItem.brand_id).val(measudeId2);
            $("#eorracikan" + toItem.brand_id).val(racikan);
            $("#eordoctor" + toItem.brand_id).val(doctor);
            $("#eoremployee_id" + toItem.brand_id).val(employeeId);
            $("#eoremployee_id_from" + toItem.brand_id).val(employeeIdFrom);
            $("#eordoctor_from" + toItem.brand_id).val(doctorFrom);
            $("#eorstatus_obat" + toItem.brand_id).val(statusObat);
            $("#eortarif_id" + toItem.brand_id).val(tarifId);
            $("#eortreatment" + toItem.brand_id).val(treatment);
            $("#eortarif_type" + toItem.brand_id).val(tarifType);
            $("#eoramount" + toItem.brand_id).val(amount);
            $("#eorsell_price" + toItem.brand_id).val(sellPrice);
            $("#eortagihan" + toItem.brand_id).val(tagihan);
            $("#eorsubsidi" + toItem.brand_id).val(subsidi);
            $("#eorsubsidisat" + toItem.brand_id).val(subsidiSat);
            $("#eormargin" + toItem.brand_id).val(margin);
            $("#eorppn" + toItem.brand_id).val(ppn);
            $("#eorppnvalue" + toItem.brand_id).val(ppnValue);
            $("#eordiscount" + toItem.brand_id).val(discount);
            $("#eordiskon" + toItem.brand_id).val(diskon);
            $("#eorprofession" + toItem.brand_id).val(profession);
            $("#eorprofesi" + toItem.brand_id).val(profesi);
            $("#eoramount_paid" + toItem.brand_id).val(amountPlafond);
            $("#eorquantity" + toItem.brand_id).val(qty);
            $("#eornumer" + toItem.brand_id).val(numer);
            $("#eorresep_no" + toItem.brand_id).val(resep_no);
            $("#eornota_no" + toItem.brand_id).val(notaNo);
            $("#eortreat_date" + toItem.brand_id).val(treatDate);
            $("#eorbill_id" + toItem.brand_id).val(billId);
            $("#eorclass_room_id" + toItem.brand_id).val(classRoomId);
            $("#eorclinic_id" + toItem.brand_id).val(clinicId);
            $("#eorclinic_id_from" + toItem.brand_id).val(clinicIdFrom);
            $("#eortheorder" + toItem.brand_id).val(theOrder);
            $("#eorvisit_id" + toItem.brand_id).val('<?= $visit['visit_id']; ?>');
            $("#eorno_registration" + toItem.brand_id).val('<?= $visit['no_registration']; ?>');
            $("#eortrans_id" + toItem.brand_id).val('<?= $visit['trans_id']; ?>');
            $("#eormodified_from" + toItem.brand_id).val('<?= $visit['clinic_id']; ?>');
            $("#eormodified_date" + toItem.brand_id).val(get_date());
            $("#eorisrj" + toItem.brand_id).val('<?= $visit['isrj']; ?>');
            $("#eorthename" + toItem.brand_id).val('<?= $visit['diantar_oleh']; ?>');
            $("#eortheaddress" + toItem.brand_id).val('<?= $visit['visitor_address']; ?>');
            $("#eortheid" + toItem.brand_id).val('<?= $visit['pasien_id']; ?>');
            $("#eororg_unit_code" + toItem.brand_id).val('<?= $visit['org_unit_code']; ?>')
            $("#islunas" + toItem.brand_id).val(islunas);
        });
    }

    function editGenerateDescriptionRacik() {
        var desc2 = $("#eordosisLine1").val() + ' ' + $("#eordosisLine2").val() + ' ' + $("#eorsigna2").val() + ' ' + $("#eorsigna4").val() + '; ' + $("#eorsigna5").val();
        $("#eordescription2").val(desc2);
    }


    $("#sformeditprescr").on('submit', (function(e) {
        alert('masuk')
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editPrescR',
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
                    successSwal(data.message);

                    $("#editprescItemBodyRacik").html("")

                    data.data.forEach((element, key) => {
                        datachild = data.data[key]
                        resepDetail.forEach((element1, key1) => {
                            console.log(datachild.bill_id)
                            console.log(resepDetail[key1].bill_id)
                            console.log(resepDetail[key1].bill_id == datachild.bill_id)
                            if (resepDetail[key1].bill_id == datachild.bill_id) {
                                resepDetail.splice(key1)
                                console.log(resepDetail)
                                resepDetail[key1] = datachild
                                resep_no = datachild.resep_no
                                $("#resepno").val(resep_no)
                                filteredResep(resep_no)

                            }
                        });
                    });


                    $("#editPrescR").modal('hide');
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

    function editRacikItemChange(prop, brand_id) {
        decimalInput(prop)

        var jmlBks = $("#eorjml_bks").val()
        var origDose = $("#eororig_dose" + brand_id).val()

        var dose1 = $("#eordose1" + brand_id).val()
        var dose2 = $("#eordose2" + brand_id).val()
        var theDose = (Math.round((dose1 / dose2) * 100) / 100).toFixed(2)
        $("#eordose" + brand_id).val(theDose)

        var ldcDosis = ukuranResep(jmlBks, origDose, theDose, "eordose_presc" + brand_id)

        $("#eordose_presc" + brand_id).val(ldcDosis)
    }



    function editJmlBksChange(prop) {
        decimalInput(prop)

        var jmlBks = $(prop).val()
        $("input[id*='brand_id']").each(function(i, el) {
            var brd = $("#" + this.id).val()
            var origDose = $("#eororig_dose" + brd).val()

            var dose1 = $("#eordose1" + brd).val()
            var dose2 = $("#eordose2" + brd).val()
            var theDose = (Math.round((dose1 / dose2) * 100) / 100).toFixed(2)
            $("#eordose" + brd).val(theDose)

            var ldcDosis = ukuranResep(jmlBks, origDose, theDose, "eordose_presc" + brd)

            $("#eordose_presc" + brd).val(ldcDosis)
        });
    }

    function removeRacik(brand) {
        if (confirm('Apakah anda yakin akan menghapus item ini?') == true) {
            $("#" + brand).remove()
        }
    }

    function removeRacikan() {
        if (confirm('Apakah anda yakin akan menghapus racikan ini?') == true) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deleteRacikan',
                type: "POST",
                data: JSON.stringify({
                    "resepKe": selectedResepKe,
                    "resepNo": selectedResepNo
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
                            if (resepDetail[key].resep_ke == data.resepKe && resepDetail[key].resep_no == data.resepNo)
                                resepDetail.splice(key, 1)
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
    }
</script>