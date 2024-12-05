<div class="modal fade" id="addPrescNR" role="dialog" aria-labelledby="myModalLabel">
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
                <form id="formaddpresc" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                    <div id="prescItemBody"></div>
                    <div class="modal-footer">
                        <div class="pull-right">
                            <button type="submit" id="addPrescBtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
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

    function addItemObat(value) {

        resep_no = $("#resepno").val();

        if (resep_no == '%') {
            generateResep('<?= $visit['no_registration']; ?>', '<?= $visit['clinic_id']; ?>', '<?= $visit['isrj']; ?>')
        }


        toItem = JSON.parse(value)

        var dosisDiv = '<div class="col-sm-6 col-md-4"><div class="form-group"><label>Dosis Obat</label><select onchange="generateDescription2NR(\'' + toItem.brand_id + '\')" name="dosisLine1' + toItem.brand_id + '" id="dosisLine1' + toItem.brand_id + '" class="form-control">';
        dosisDiv = dosisDiv + "<option value=''></option>"
        option.forEach((element, key) => {
            dosisDiv = dosisDiv + "<option value='" + option[key] + "'>" + option[key] + "</option>"
        });
        dosisDiv = dosisDiv + '</select></div></div>';

        var dosis2Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label></label><select onchange="generateDescription2NR(\'' + toItem.brand_id + '\')" name="dosisLine2' + toItem.brand_id + '" id="dosisLine2' + toItem.brand_id + '" class="form-control">';
        dosis2Div = dosis2Div + "<option value=''></option>"
        optionJml.forEach((element, key) => {
            dosis2Div = dosis2Div + "<option value='" + optionJml[key] + "'>" + optionJml[key] + "</option>"
        });
        dosis2Div = dosis2Div + '</select></div></div>';

        var signa2Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label></label><select onchange="generateDescription2NR(\'' + toItem.brand_id + '\')" name="signa2' + toItem.brand_id + '" id="signa2' + toItem.brand_id + '" class="form-control">';
        signa2Div = signa2Div + "<option value=''></option>"
        signa2Param.forEach((element, key) => {
            signa2Div = signa2Div + "<option value='" + signa2Param[key].meaning + "'>" + signa2Param[key].signa + ' - ' + signa2Param[key].meaning + "</option>"
        });
        signa2Div = signa2Div + '</select></div></div>';

        var signa4Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label>Waktu Pemberian</label><select onchange="generateDescription2NR(\'' + toItem.brand_id + '\')" name="signa4' + toItem.brand_id + '" id="signa4' + toItem.brand_id + '" class="form-control">';
        signa4Div = signa4Div + "<option value=''></option>"
        signa4Div = signa4Div + "<option value='Sebelum Makan'>Sebelum Makan</option>"
        signa4Div = signa4Div + "<option value='Setelah Makan'>Setelah Makan</option>"
        signa4Div = signa4Div + "<option value='Pada Saat Makan Makan'>Pada Saat Makan Makan</option>"
        signa4Param.forEach((element, key) => {
            signa4Div = signa4Div + "<option value='" + signa4Param[key].meaning + "'>" + signa4Param[key].signa + ' - ' + signa4Param[key].meaning + "</option>"
        });
        signa4Div = signa4Div + '</select></div></div>';


        var signa5Div = '<div class="col-sm-6 col-md-4"><div class="form-group"><label>Rute</label><select onchange="generateDescription2NR(\'' + toItem.brand_id + '\')" name="signa5' + toItem.brand_id + '" id="signa5' + toItem.brand_id + '" class="form-control">';
        signa5Div = signa5Div + "<option value=''></option>"
        signa5Param.forEach((element, key) => {
            signa5Div = signa5Div + "<option value='" + signa5Param[key].meaning + "'>" + signa5Param[key].signa + ' - ' + signa5Param[key].meaning + "</option>"
        });
        signa5Div = signa5Div + '</select></div></div>';




        var jmlBks = 1
        var dose = 1
        var origDose = toItem.size_goods
        resepOrder++
        var resepKe = resepOrder
        var description = toItem.name
        var brandId = toItem.brand_id
        var measureId = toItem.measure_id
        var measudeId2 = toItem.measure_id2
        var racikan = '0'
        var doctor = doctor
        var employeeId = '<?= $visit['employee_id']; ?>'
        var employeeIdFrom = '<?= $visit['employee_id']; ?>'
        var doctorFrom = '<?= $visit['fullname']; ?>'
        var statusObat = toItem.status_pasien_id
        var tarifId = "1201008"
        var treatment = "PEMBELIAN OBAT NON RACIKAN"
        var tarifType = "803"
        var amount = 0.0
        var sellPrice = toItem.sell_price
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
        var notaNo = notaNo
        var treatDate = get_date()
        var dose1 = 0.0
        var dose2 = 0.0
        var theOrder = 2
        var billId = (get_datesecond() + String(Math.floor(Math.random() * 1000))).replaceAll(' ', '').replaceAll('-', '').replaceAll(':', '');
        var classRoomId = ""
        var clinicId = '<?= $visit['clinic_id']; ?>'
        var clinicIdFrom = '<?= $visit['clinic_id']; ?>'
        var islunas = 0;







        $("#prescItemBody").append($("<div>").attr("class", "row")
                .append($("<div>").attr("class", "col-sm-8 col-xs-8")
                    .append($("<div>").attr("class", "form-group")
                        .append($("<label>").html("Nama Barang"))
                        .append('<input type="text" name="description[]" id="aodescription' + toItem.brand_id + '" placeholder="" value="' + toItem.name + '" class="form-control" readonly>')
                    )
                )
                .append('<div class="col-sm-4"><div class="form-group"><label>Jml</label><input type="text" name="dose_presc[]" id="aodose_presc' + toItem.brand_id + '" placeholder="" value="" class="form-control" onchange="decimalInput(this)" onfocus="this.value=\'\'"></div></div>')

                .append(dosisDiv)
                .append(dosis2Div)
                .append(signa2Div)
                .append(signa4Div)
                .append(signa5Div)
                .append($("<div>").attr("class", "col-sm-12 col-xs-12")
                    .append($("<div>").attr("class", "form-group")
                        .append($("<label>").html("Aturan Minum"))
                        .append('<input type="text" name="description2[]" id="aodescription2' + toItem.brand_id + '" placeholder="" class="form-control">')
                    )
                )
            )
            .append('<hr class="hr-panel-heading hr-10">')
            .append('<input name="jml_bks[]" id="aojml_bks' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="dose[]" id="aodose' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="orig_dose[]" id="aoorig_dose' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="resep_ke[]" id="aoresep_ke' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="brand_id[]" id="aobrand_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="measure_id[]" id="aomeasure_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="measure_id2[]" id="aomeasure_id2' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="racikan[]" id="aoracikan' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="doctor[]" id="aodoctor' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id[]" id="aoemployee_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="employee_id_from[]" id="aoemployee_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="doctor_from[]" id="aodoctor_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="status_obat[]" id="aostatus_obat' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="tarif_id[]" id="aotarif_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="treatment[]" id="aotreatment' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="tarif_type[]" id="aotarif_type' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="amount[]" id="aoamount' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="sell_price[]" id="aosell_price' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="tagihan[]" id="aotagihan' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="subsidi[]" id="aosubsidi' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="subsidisat[]" id="aosubsidisat' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="margin[]" id="aomargin' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="ppn[]" id="aoppn' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="ppnvalue[]" id="aoppnvalue' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="discount[]" id="aodiscount' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="diskon[]" id="aodiskon' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="profession[]" id="aoprofession' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="profesi[]" id="aoprofesi' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="amount_paid[]" id="aoamount_paid' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="quantity[]" id="aoquantity' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="numer[]" id="aonumer' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="resep_no[]" id="aoresep_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="nota_no[]" id="aonota_no' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="treat_date[]" id="aotreat_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="bill_id[]" id="aobill_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="class_room_id[]" id="aoclass_room_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="clinic_id[]" id="aoclinic_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="aoclinic_id_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="visit_id[]" id="aovisit_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="no_registration[]" id="aono_registration' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="trans_id[]" id="aotrans_id' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="modified_from[]" id="aomodified_from' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="modified_date[]" id="aomodified_date' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="isrj[]" id="aoisrj' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="thename[]" id="aothename' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="theaddress[]" id="aotheaddress' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="theid[]" id="aotheid' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="org_unit_code[]" id="aoorg_unit_code' + toItem.brand_id + '" type="hidden" class="form-control" />')
            .append('<input name="islunas[]" id="aorislunas' + toItem.brand_id + '" type="hidden" class="form-control" />')

        $("#aojml_bks" + toItem.brand_id).val(jmlBks);
        $("#aodose" + toItem.brand_id).val(dose);
        $("#aoorig_dose" + toItem.brand_id).val(origDose);
        $("#aoresep_ke" + toItem.brand_id).val(resepKe);
        $("#aobrand_id" + toItem.brand_id).val(brandId);
        $("#aomeasure_id" + toItem.brand_id).val(measureId);
        $("#aomeasure_id2" + toItem.brand_id).val(measudeId2);
        $("#aoracikan" + toItem.brand_id).val(racikan);
        $("#aodoctor" + toItem.brand_id).val(doctor);
        $("#aoemployee_id" + toItem.brand_id).val(employeeId);
        $("#aoemployee_id_from" + toItem.brand_id).val(employeeIdFrom);
        $("#aodoctor_from" + toItem.brand_id).val(doctorFrom);
        $("#aostatus_obat" + toItem.brand_id).val(statusObat);
        $("#aotarif_id" + toItem.brand_id).val(tarifId);
        $("#aotreatment" + toItem.brand_id).val(treatment);
        $("#aotarif_type" + toItem.brand_id).val(tarifType);
        $("#aoamount" + toItem.brand_id).val(amount);
        $("#aosell_price" + toItem.brand_id).val(sellPrice);
        $("#aotagihan" + toItem.brand_id).val(tagihan);
        $("#aosubsidi" + toItem.brand_id).val(subsidi);
        $("#aosubsidisat" + toItem.brand_id).val(subsidiSat);
        $("#aomargin" + toItem.brand_id).val(margin);
        $("#aoppn" + toItem.brand_id).val(ppn);
        $("#aoppnvalue" + toItem.brand_id).val(ppnValue);
        $("#aodiscount" + toItem.brand_id).val(discount);
        $("#aodiskon" + toItem.brand_id).val(diskon);
        $("#aoprofession" + toItem.brand_id).val(profession);
        $("#aoprofesi" + toItem.brand_id).val(profesi);
        $("#aoamount_paid" + toItem.brand_id).val(amountPlafond);
        $("#aoquantity" + toItem.brand_id).val(qty);
        $("#aonumer" + toItem.brand_id).val(numer);
        $("#aoresep_no" + toItem.brand_id).val(resep_no);
        $("#aonota_no" + toItem.brand_id).val(notaNo);
        $("#aotreat_date" + toItem.brand_id).val(treatDate);
        $("#aobill_id" + toItem.brand_id).val(billId);
        $("#aoclass_room_id" + toItem.brand_id).val(classRoomId);
        $("#aoclinic_id" + toItem.brand_id).val(clinicId);
        $("#aoclinic_id_from" + toItem.brand_id).val(clinicIdFrom);
        $("#aovisit_id" + toItem.brand_id).val('<?= $visit['visit_id']; ?>');
        $("#aono_registration" + toItem.brand_id).val('<?= $visit['no_registration']; ?>');
        $("#aotrans_id" + toItem.brand_id).val('<?= $visit['trans_id']; ?>');
        $("#aomodified_from" + toItem.brand_id).val('<?= $visit['clinic_id']; ?>');
        $("#aomodified_date" + toItem.brand_id).val(get_date());
        $("#aoisrj" + toItem.brand_id).val('<?= $visit['isrj']; ?>');
        $("#aothename" + toItem.brand_id).val('<?= $visit['diantar_oleh']; ?>');
        $("#aotheaddress" + toItem.brand_id).val('<?= $visit['visitor_address']; ?>');
        $("#aotheid" + toItem.brand_id).val('<?= $visit['pasien_id']; ?>');
        $("#aoorg_unit_code" + toItem.brand_id).val('<?= $visit['org_unit_code']; ?>')
        $("#islunas" + toItem.brand_id).val(islunas);
    }

    function generateDescription2NR(id) {
        var desc2 = $("#dosisLine1" + id).val() + ' ' + $("#dosisLine2" + id).val() + ' ' + $("#signa2" + id).val() + ' ' + $("#signa4" + id).val() + '; ' + $("#signa5" + id).val();
        $("#aodescription2" + id).val(desc2);
        console.log(id)
        console.log(desc2)
    }


    $("#formaddpresc").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addPresc',
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

                    $("#prescItemBody").html("")

                    data.data.forEach((element, key) => {
                        resepDetail.push(data.data[key])
                    });

                    filteredResep(resep_no)

                    $("#addPrescNR").modal('hide');
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