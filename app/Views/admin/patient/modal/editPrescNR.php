<div class="modal fade" id="editPrescNR" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Non Racik</h4>

            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div class="col-sm-12 col-md-12">
                    <div class="form-group"><label for="diag_awal">Nama Barang</label>
                        <div class="p-2 select2-full-width">
                            <select onchange="addItemObat(this.value)" class="form-control patient_list_ajax" id="fillitemid">
                            </select>
                        </div>
                    </div>
                    <hr class="hr-panel-heading hr-10">
                </div>
                <form id="formeditpresc" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                    <div id="editprescItemBody"></div>
                    <div class="modal-footer">
                        <div class="pull-right">
                            <button type="submit" id="editPrescBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
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

    function editItemObatNonRacik(value) {

        holdModal('editPrescNR')

        resepDetail.forEach((element, key) => {
            if (resepDetail[key].bill_id == value)
                toItem = resepDetail[key]
        });


        console.log(toItem)

        var dosisDiv = '<div class="col-sm-6 col-md-4"><div class="form-group"><label>Dosis Obat</label><select onchange="generateDescription2ENR(\'' + toItem.brand_id + '\')" name="dosisLine1' + toItem.brand_id + '" id="dosisLine1' + toItem.brand_id + '" class="form-control">';
        dosisDiv = dosisDiv + "<option value=''></option>"
        option.forEach((element, key) => {
            dosisDiv = dosisDiv + "<option value='" + option[key] + "'>" + option[key] + "</option>"
        });
        dosisDiv = dosisDiv + '</select></div></div>';

        var dosis2Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label></label><select onchange="generateDescription2ENR(\'' + toItem.brand_id + '\')" name="dosisLine2' + toItem.brand_id + '" id="dosisLine2' + toItem.brand_id + '" class="form-control">';
        dosis2Div = dosis2Div + "<option value=''></option>"
        optionJml.forEach((element, key) => {
            dosis2Div = dosis2Div + "<option value='" + optionJml[key] + "'>" + optionJml[key] + "</option>"
        });
        dosisDiv = dosisDiv + '</select></div></div>';

        var signa2Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label></label><select onchange="generateDescription2ENR(\'' + toItem.brand_id + '\')" name="signa2' + toItem.brand_id + '" id="signa2' + toItem.brand_id + '" class="form-control">';
        signa2Div = signa2Div + "<option value=''></option>"
        signa2Param.forEach((element, key) => {
            signa2Div = signa2Div + "<option value='" + signa2Param[key].meaning + "'>" + signa2Param[key].signa + ' - ' + signa2Param[key].meaning + "</option>"
        });
        signa2Div = signa2Div + '</select></div></div>';

        var signa4Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label>Waktu Pemberian</label><select onchange="generateDescription2ENR(\'' + toItem.brand_id + '\')" name="signa4' + toItem.brand_id + '" id="signa4' + toItem.brand_id + '" class="form-control">';
        signa4Div = signa4Div + "<option value=''></option>"
        signa4Div = signa4Div + "<option value='Sebelum Makan'>Sebelum Makan</option>"
        signa4Div = signa4Div + "<option value='Setelah Makan'>Setelah Makan</option>"
        signa4Div = signa4Div + "<option value='Pada Saat Makan Makan'>Pada Saat Makan Makan</option>"
        signa4Param.forEach((element, key) => {
            signa4Div = signa4Div + "<option value='" + signa4Param[key].meaning + "'>" + signa4Param[key].signa + ' - ' + signa4Param[key].meaning + "</option>"
        });
        signa4Div = signa4Div + '</select></div></div>';


        var signa5Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label>Rute</label><select onchange="generateDescription2ENR(\'' + toItem.brand_id + '\')" name="signa5' + toItem.brand_id + '" id="signa5' + toItem.brand_id + '" class="form-control">';
        signa5Div = signa5Div + "<option value=''></option>"
        signa5Param.forEach((element, key) => {
            signa5Div = signa5Div + "<option value='" + signa5Param[key].meaning + "'>" + signa5Param[key].signa + ' - ' + signa5Param[key].meaning + "</option>"
        });
        signa5Div = signa5Div + '</select></div></div>';




        var jmlBks = 1
        var dose = 1
        var origDose = toItem.size_goods
        var resepKe = toItem.resep_ke
        var description = toItem.description
        var brandId = toItem.brand_id
        var measureId = toItem.measure_id
        var measudeId2 = toItem.measure_id2
        var racikan = '0'
        var doctor = toItem.doctor
        var employeeId = toItem.employee_id
        var employeeIdFrom = toItem.employee_id_from
        var doctorFrom = toItem.doctor_from
        var statusObat = toItem.status_pasien_id
        var tarifId = toItem.tarif_id
        var treatment = toItem.treatment
        var tarifType = toItem.tarif_type
        var amount = toItem.amount
        var sellPrice = toItem.sell_price
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
        var theOrder = toItem.theorder
        var billId = toItem.bill_id
        var classRoomId = toItem.class_room_id
        var clinicId = toItem.clinic_id
        var clinicIdFrom = toItem.clinic_id_from
        var islunas = toItem.islunas;





        $("#editprescItemBody").html("")

        $("#editprescItemBody").append($("<div>").attr("class", "row")
                .append($("<div>").attr("class", "col-sm-8 col-xs-8")
                    .append($("<div>").attr("class", "form-group")
                        .append($("<label>").html("Nama Barang"))
                        .append('<input type="text" name="description[]" id="eodescription' + toItem.brand_id + '" placeholder="" value="' + toItem.name + '" class="form-control" readonly>')
                    )
                )
                .append('<div class="col-sm-4"><div class="form-group"><label>Jml</label><input type="text" name="dose_presc[]" id="eodose_presc' + toItem.brand_id + '" placeholder="" value="" class="form-control" onchange="decimalInput(this)" onfocus="this.value=\'\'"></div></div>')

                .append(dosisDiv)
                .append(dosis2Div)
                .append(signa2Div)
                .append(signa4Div)
                .append(signa5Div)
                .append($("<div>").attr("class", "col-sm-12 col-xs-12")
                    .append($("<div>").attr("class", "form-group")
                        .append($("<label>").html("Aturan Minum"))
                        .append('<input type="text" name="description2[]" id="eodescription2' + toItem.brand_id + '" placeholder="" class="form-control">')
                    )
                )
            )
            .append('<hr class="hr-panel-heading hr-10">')
            .append('<input name="jml_bks[]" id="eojml_bks' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="dose[]" id="eodose' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="orig_dose[]" id="eoorig_dose' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="resep_ke[]" id="eoresep_ke' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="brand_id[]" id="eobrand_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="measure_id[]" id="eomeasure_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="measure_id2[]" id="eomeasure_id2' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="racikan[]" id="eoracikan' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="doctor[]" id="eodoctor' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id[]" id="eoemployee_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id_from[]" id="eoemployee_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="doctor_from[]" id="eodoctor_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="status_obat[]" id="eostatus_obat' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="tarif_id[]" id="eotarif_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="treatment[]" id="eotreatment' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="tarif_type[]" id="eotarif_type' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="amount[]" id="eoamount' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="sell_price[]" id="eosell_price' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="tagihan[]" id="eotagihan' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="subsidi[]" id="eosubsidi' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="subsidisat[]" id="eosubsidisat' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="margin[]" id="eomargin' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="ppn[]" id="eoppn' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="ppnvalue[]" id="eoppnvalue' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="discount[]" id="eodiscount' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="diskon[]" id="eodiskon' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="profession[]" id="eoprofession' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="profesi[]" id="eoprofesi' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="amount_paid[]" id="eoamount_paid' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="quantity[]" id="eoquantity' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="numer[]" id="eonumer' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="resep_no[]" id="eoresep_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="nota_no[]" id="eonota_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="treat_date[]" id="eotreat_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="bill_id[]" id="eobill_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="class_room_id[]" id="eoclass_room_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="clinic_id[]" id="eoclinic_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="eoclinic_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="visit_id[]" id="eovisit_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="no_registration[]" id="eono_registration' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="trans_id[]" id="eotrans_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="modified_from[]" id="eomodified_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="modified_date[]" id="eomodified_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="isrj[]" id="eoisrj' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="thename[]" id="eothename' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="theaddress[]" id="eotheaddress' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="theid[]" id="eotheid' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="org_unit_code[]" id="eoorg_unit_code' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="islunas[]" id="eoislunas' + toItem.brand_id + '" type="hidden" class="form-control" />')

        $("#eojml_bks" + toItem.brand_id).val(jmlBks);
        $("#eodose" + toItem.brand_id).val(dose);
        $("#eoorig_dose" + toItem.brand_id).val(origDose);
        $("#eoresep_ke" + toItem.brand_id).val(resepKe);
        $("#eobrand_id" + toItem.brand_id).val(brandId);
        $("#eomeasure_id" + toItem.brand_id).val(measureId);
        $("#eomeasure_id2" + toItem.brand_id).val(measudeId2);
        $("#eoracikan" + toItem.brand_id).val(racikan);
        $("#eodoctor" + toItem.brand_id).val(doctor);
        $("#eoemployee_id" + toItem.brand_id).val(employeeId);
        $("#eoemployee_id_from" + toItem.brand_id).val(employeeIdFrom);
        $("#eodoctor_from" + toItem.brand_id).val(doctorFrom);
        $("#eostatus_obat" + toItem.brand_id).val(statusObat);
        $("#eotarif_id" + toItem.brand_id).val(tarifId);
        $("#eotreatment" + toItem.brand_id).val(treatment);
        $("#eotarif_type" + toItem.brand_id).val(tarifType);
        $("#eoamount" + toItem.brand_id).val(amount);
        $("#eosell_price" + toItem.brand_id).val(sellPrice);
        $("#eotagihan" + toItem.brand_id).val(tagihan);
        $("#eosubsidi" + toItem.brand_id).val(subsidi);
        $("#eosubsidisat" + toItem.brand_id).val(subsidiSat);
        $("#eomargin" + toItem.brand_id).val(margin);
        $("#eoppn" + toItem.brand_id).val(ppn);
        $("#eoppnvalue" + toItem.brand_id).val(ppnValue);
        $("#eodiscount" + toItem.brand_id).val(discount);
        $("#eodiskon" + toItem.brand_id).val(diskon);
        $("#eoprofession" + toItem.brand_id).val(profession);
        $("#eoprofesi" + toItem.brand_id).val(profesi);
        $("#eoamount_paid" + toItem.brand_id).val(amountPlafond);
        $("#eoquantity" + toItem.brand_id).val(qty);
        $("#eonumer" + toItem.brand_id).val(numer);
        $("#eoresep_no" + toItem.brand_id).val(resep_no);
        $("#eonota_no" + toItem.brand_id).val(notaNo);
        $("#eotreat_date" + toItem.brand_id).val(treatDate);
        $("#eobill_id" + toItem.brand_id).val(billId);
        $("#eoclass_room_id" + toItem.brand_id).val(classRoomId);
        $("#eoclinic_id" + toItem.brand_id).val(clinicId);
        $("#eoclinic_id_from" + toItem.brand_id).val(clinicIdFrom);
        $("#eovisit_id" + toItem.brand_id).val(toItem.visit_id);
        $("#eono_registration" + toItem.brand_id).val(toItem.no_registration);
        $("#eotrans_id" + toItem.brand_id).val(toItem.trans_id);
        $("#eomodified_from" + toItem.brand_id).val(toItem.modified_from);
        $("#eomodified_date" + toItem.brand_id).val(toItem.modified_date);
        $("#eoisrj" + toItem.brand_id).val(toItem.isrj);
        $("#eothename" + toItem.brand_id).val(toItem.thename);
        $("#eotheaddress" + toItem.brand_id).val(toItem.theaddress);
        $("#eotheid" + toItem.brand_id).val(toItem.theid);
        $("#eoorg_unit_code" + toItem.brand_id).val(toItem.org_unit_code)
        $("#eoislunas" + toItem.brand_id).val(toItem.islunas);
        $("#eodescription" + toItem.brand_id).val(toItem.description);
        $("#eodose_presc" + toItem.brand_id).val(Number((toItem.dose_presc).toString().replace(/[^\d+(\.\d{1,2})$]/g, '')).toFixed(2));
        $("#eodescription2" + toItem.brand_id).val(toItem.description2);
    }

    function generateDescription2ENR(id) {
        var desc2 = $("#dosisLine1" + id).val() + ' ' + $("#dosisLine2" + id).val() + ' ' + $("#signa2" + id).val() + ' ' + $("#signa4" + id).val() + '; ' + $("#signa5" + id).val();
        $("#eodescription2" + id).val(desc2);
    }

    $("#formeditpresc").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editPresc',
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

                    $("#editprescItemBody").html("")

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


                    $("#editPrescNR").modal('hide');
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
</script>