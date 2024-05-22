<script type='text/javascript'>
    var inacbg = 0.0;
    var billJson = [];
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;

    var nomor = '<?= $visit['no_registration']; ?>';
    var ke = '%'
    var mulai = '2023-08-01' //tidak terpakai
    var akhir = '2023-08-31' //tidak terpakai
    var lunas = '%'
    // var klinik = '<?= $visit['clinic_id']; ?>'
    var klinik = '%'
    var rj = '%'
    var status = '%'
    var nota = '%'
    var trans = '<?= $visit['trans_id']; ?>'
    var visit = '<?= $visit['visit_id']; ?>'
    // $(document).ready(function(e) {

    //     // getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans)
    // })
    $("#chargesTab").on("click", function() {
        getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans)
        getInacbg(visit)
    })
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

    function getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getBillPoli',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
                'ke': ke,
                'mulai': mulai,
                'akhir': akhir,
                'lunas': lunas,
                'klinik': klinik,
                'rj': rj,
                'status': status,
                'nota': nota,
                'trans': trans
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                billJson = data

                $("#chargesBody").html("")
                $("#labChargesBody").html("")
                $("#radChargesBody").html("")
                billJson.forEach((element, key) => {

                    billJson[key].sell_price = parseFloat(billJson[key].sell_price)
                    // if (!isnullcheck(billJson[key].quantity))
                    //     billJson[key].quantity = parseFloat((billJson[key].quantity))
                    // else
                    //     billJson[key].quantity = 0
                    billJson[key].quantity = isnullcheck(billJson[key].quantity)
                    billJson[key].amount_paid = isnullcheck(billJson[key].amount_paid)

                    billJson[key].amount_plafond = parseFloat(billJson[key].amount_plafond)
                    billJson[key].amount_paid_plafond = parseFloat(billJson[key].amount_paid_plafond)
                    billJson[key].discount = parseFloat(billJson[key].discount)
                    billJson[key].subsidisat = parseFloat(billJson[key].subsidisat)
                    billJson[key].subsidi = parseFloat(billJson[key].subsidi)
                    billJson[key].potongan = parseFloat(isnullcheck(billJson[key].potongan))
                    billJson[key].pembulatan = parseFloat(isnullcheck(billJson[key].pembulatan))
                    billJson[key].bayar = parseFloat(isnullcheck(billJson[key].bayar))
                    billJson[key].retur = parseFloat(isnullcheck(billJson[key].retur))
                    billJson[key].tagihan = parseFloat(isnullcheck(billJson[key].tagihan))
                    billJson[key].quantity = parseFloat(isnullcheck(billJson[key].quantity))
                    billJson[key].amount_paid = parseFloat((billJson[key].amount_paid))

                    tagihan += parseFloat(billJson[key].tagihan)

                    //  sum(if(isnull(subsidi),0,subsidi) for all)
                    subsidi += billJson[key].subsidi

                    //  sum(if(isnull(potongan),0,potongan) for all)
                    potongan += billJson[key].potongan

                    // sum(pembulatannya for all)
                    pembulatan += billJson[key].pembulatan

                    // sum(if(isnull(bayar),0,bayar) for all)
                    pembayaran += billJson[key].bayar

                    // sum(if(isnull(retur),0,retur) for all)
                    retur += billJson[key].retur

                    // total_tagihan  - (total_subsidi + total_potongan) + bulat - total_lunas +total_retur_bayar 

                    var keterangan = '';

                    // if(isnull(keterangan),'',if((tarif = '0005002' or tarif='0004002'), invoice_id +' ' +module_id+'~r~n '+ 'No. : ' + account_id,keterangan)) +  if(isnull(nama_dokter),'',nama_dokter) 
                    if (billJson[key].keterangan == null) {
                        keternagan = ''
                    } else {
                        if (billJson[key].tarif_id == '0005002' || billJson[key].tarif_id == '0004002') {
                            keterangan = billJson[key].invoice_id + ' ' + billJson[key].module_id + '~r~n ' + 'No. : ' + billJson[key].account_id;
                        } else {
                            keterangan = billJson[key].keterangan;
                        }
                    }
                    if (billJson[key].doctor != null) {
                        keterangan += billJson[key].doctor;
                    }

                    // if(lunas='1','VALID-LOCK!',if(lunas ='2','CLOSE!',if(lunas = '5','Close Billing!','OPEN!')))
                    var lunas = '';
                    if (billJson[key].islunas == '1') {
                        lunas = 'VALID-LOCK!';
                    } else if (billJson[key].islunas == '2') {
                        lunas = 'CLOSE!';
                    } else if (billJson[key].islunas == '5') {
                        lunas = 'Close Billing!';
                    } else {
                        lunas = 'OPEN!';
                    }

                    // $("#chargesBody").append($("<tr id=\"" + key + "\">")
                    //     .append($("<td>").html(String(key + 1) + "."))
                    //     .append($("<td>").attr("id", "treatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
                    //     .append($("<td>").attr("id", "treat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
                    //     // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                    //     .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
                    //     .append($("<td>")
                    //         .append('<input type="text" name="quantity[]" id="aquantity' + key + '" placeholder="" value="' + billJson[key].quantity + '" class="form-control" readonly>')
                    //         .append($("<p>").html(billJson[key].name_of_status_pasien))
                    //     )
                    //     .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
                    //     .append($("<td>").attr("id", "displayamount_plafond" + key).html((billJson[key].amount_plafond)))
                    //     .append($("<td>").attr("id", "displayamount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
                    //     .append($("<td>").attr("id", "displaydiscount" + key).html(formatCurrency(billJson[key].discount)))
                    //     .append($("<td>").attr("id", "subsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
                    //     .append($("<td>").attr("id", "subsidi" + key).html(formatCurrency(billJson[key].subsidi)))
                    //     .append($("<td>").append('<button id="simpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(' + key + ', \'a\')" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Simpan</button><div id="editDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'alab\', ' + key + ')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
                    //     // .append($("<td>").append('<button type="button" onclick="" class="editbtn" data-row-id="1" autocomplete="off"></button>'))
                    //     // .append($("<td>").append('<button type="button" onclick="" class="closebtn" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
                    //     .append('<input name="treatment[]" id="atreatment' + key + '" type="hidden" value="' + billJson[key].treatment + '" class="form-control" />')
                    //     .append('<input name="treat_date[]" id="atreat_date' + key + '" type="hidden" value="' + billJson[key].treat_date + '" class="form-control" />')
                    //     .append('<input name="sell_price[]" id="asell_price' + key + '" type="hidden" value="' + billJson[key].sell_price + '" class="form-control" />')
                    //     .append('<input name="amount_paid[]" id="aamount_paid' + key + '" type="hidden" value="' + billJson[key].amount_paid + '" class="form-control" />')
                    //     .append('<input name="amount_plafond[]" id="aamount_plafond' + key + '" type="hidden" value="' + billJson[key].amount_plafond + '" class="form-control" />')
                    //     .append('<input name="discount[]" id="adiscount' + key + '" type="hidden" value="' + billJson[key].discount + '" class="form-control" />')
                    //     .append('<input name="subsidisat[]" id="asubsidisat' + key + '" type="hidden" value="' + billJson[key].subsidisat + '" class="form-control" />')
                    //     .append('<input name="subsidi[]" id="asubsidi' + key + '" type="hidden" value="' + billJson[key].subsidi + '" class="form-control" />')
                    //     .append('<input name="bill_id[]" id="abill_id' + key + '" type="hidden" value="' + billJson[key].bill_id + '" class="form-control" />')
                    //     .append('<input name="trans_id[]" id="atrans_id' + key + '" type="hidden" value="' + billJson[key].trans_id + '" class="form-control" />')
                    //     .append('<input name="no_registration[]" id="ano_registration' + key + '" type="hidden" value="' + billJson[key].no_registration + '" class="form-control" />')
                    //     .append('<input name="theorder[]" id="atheorder' + key + '" type="hidden" value="' + billJson[key].theorder + '" class="form-control" />')
                    //     .append('<input name="visit_id[]" id="avisit_id' + key + '" type="hidden" value="' + billJson[key].visit_id + '" class="form-control" />')
                    //     .append('<input name="org_unit_code[]" id="aorg_unit_code' + key + '" type="hidden" value="' + billJson[key].org_unit_code + '" class="form-control" />')
                    //     .append('<input name="class_id[]" id="aclass_id' + key + '" type="hidden" value="' + billJson[key].class_id + '" class="form-control" />')
                    //     .append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key + '" type="hidden" value="' + billJson[key].class_id_plafond + '" class="form-control" />')
                    //     .append('<input name="payor_id[]" id="apayor_id' + key + '" type="hidden" value="' + billJson[key].payor_id + '" class="form-control" />')
                    //     .append('<input name="karyawan[]" id="akaryawan' + key + '" type="hidden" value="' + billJson[key].karyawan + '" class="form-control" />')
                    //     .append('<input name="theid[]" id="atheid' + key + '" type="hidden" value="' + billJson[key].theid + '" class="form-control" />')
                    //     .append('<input name="thename[]" id="athename' + key + '" type="hidden" value="' + billJson[key].thename + '" class="form-control" />')
                    //     .append('<input name="theaddress[]" id="atheaddress' + key + '" type="hidden" value="' + billJson[key].theaddress + '" class="form-control" />')
                    //     .append('<input name="status_pasien_id[]" id="astatus_pasien_id' + key + '" type="hidden" value="' + billJson[key].status_pasien_id + '" class="form-control" />')
                    //     .append('<input name="isRJ[]" id="aisRJ' + key + '" type="hidden" value="' + billJson[key].isRJ + '" class="form-control" />')
                    //     .append('<input name="gender[]" id="agender' + key + '" type="hidden" value="' + billJson[key].gender + '" class="form-control" />')
                    //     .append('<input name="ageyear[]" id="aageyear' + key + '" type="hidden" value="' + billJson[key].ageyear + '" class="form-control" />')
                    //     .append('<input name="agemonth[]" id="aagemonth' + key + '" type="hidden" value="' + billJson[key].agemonth + '" class="form-control" />')
                    //     .append('<input name="ageday[]" id="aageday' + key + '" type="hidden" value="' + billJson[key].ageday + '" class="form-control" />')
                    //     .append('<input name="kal_id[]" id="akal_id' + key + '" type="hidden" value="' + billJson[key].kal_id + '" class="form-control" />')
                    //     .append('<input name="karyawan[]" id="akaryawan' + key + '" type="hidden" value="' + billJson[key].karyawan + '" class="form-control" />')
                    //     .append('<input name="class_room_ID[]" id="aclass_room_ID' + key + '" type="hidden" value="' + billJson[key].class_room_ID + '" class="form-control" />')
                    //     .append('<input name="bed_id[]" id="abed_id' + key + '" type="hidden" value="' + billJson[key].bed_id + '" class="form-control" />')
                    //     .append('<input name="employee_id_from[]" id="aemployee_id_from' + key + '" type="hidden" value="' + billJson[key].employee_id_from + '" class="form-control" />')
                    //     .append('<input name="doctor_from[]" id="adoctor_from' + key + '" type="hidden" value="' + billJson[key].doctor_from + '" class="form-control" />')
                    //     .append('<input name="clinic_id_from[]" id="aclinic_id_from' + key + '" type="hidden" value="' + billJson[key].clinic_id_from + '" class="form-control" />')
                    //     .append('<input name="exit_date[]" id="aexit_date' + key + '" type="hidden" value="' + billJson[key].exit_date + '" class="form-control" />')
                    //     .append('<input name="cashier[]" id="acashier' + key + '" type="hidden" value="' + billJson[key].cashier + '" class="form-control" />')
                    //     .append('<input name="modified_from[]" id="aoleh' + key + '" type="hidden" value="' + billJson[key].modified_from + '" class="form-control" />')
                    //     .append('<input name="islunas[]" id="aislunas' + key + '" type="hidden" value="' + billJson[key].islunas + '" class="form-control" />')
                    //     .append('<input name="measure_id[]" id="ameasure_id' + key + '" type="hidden" value="' + billJson[key].measure_id + '" class="form-control" />')
                    //     .append('<input name="tarif_id[]" id="atarif_id' + key + '" type="hidden" value="' + billJson[key].tarif_id + '" class="form-control" />')
                    //     .append('<input name="amount[]" id="aamount' + key + '" type="hidden" value="' + billJson[key].amount + '" class="form-control" />')
                    //     .append('<input name="nota_no[]" id="anota_no' + key + '" type="hidden" value="' + billJson[key].nota_no + '" class="form-control" />')
                    //     .append('<input name="profesi[]" id="aprofesi' + key + '" type="hidden" value="' + billJson[key].profesi + '" class="form-control" />')
                    //     .append('<input name="tagihan[]" id="atagihan' + key + '" type="hidden" value="' + billJson[key].tagihan + '" class="form-control" />')
                    //     .append('<input name="treatment_plafond[]" id="atreatment_plafond' + key + '" type="hidden" value="' + billJson[key].treatment_plafond + '" class="form-control" />')
                    //     .append('<input name="tarif_type[]" id="atarif_type' + key + '" type="hidden" value="' + billJson[key].tarif_type + '" class="form-control" />')

                    // )
                    // $("#aquantity" + key).keydown(function(e) {
                    //     !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
                    // });
                    // $('#aquantity' + key).on("input", function() {
                    //     var dInput = this.value;
                    //     console.log(dInput);
                    //     $("#aamount_paid" + key).val($("#aamount" + key).val() * dInput)
                    //     $("#displayamount_paid" + key).val($("#aamount" + key).val() * dInput)
                    //     $("#atagihan" + key).val($("#aamount" + key).val() * dInput)
                    //     $("aamount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)
                    //     $("displayamount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)

                    // })

                    addRowBill("chargesBody", "a", key)

                    if (billJson[key].clinic_id == 'P016') {
                        addRowBill("radChargesBody", "arad", key)
                    }
                    if (billJson[key].clinic_id == 'P013') {
                        addRowBill("labChargesBody", "alab", key)
                    }




                });
                total += tagihan - (subsidi + potongan) + pembulatan - pembayaran + retur;
                $("#tagihan_total").val(formatCurrency(tagihan));
                $("#subsidi_total").val(formatCurrency(subsidi));
                $("#potongan_total").val(formatCurrency(potongan));
                $("#pembulatan_total").val(formatCurrency(pembulatan));
                $("#pelunasan_total").val(formatCurrency(pembayaran));
                $("#retur_total").val(formatCurrency(retur));
                $("#totalnya").val(formatCurrency(total));
            },
            error: function() {

            }
        });
    }



    function addBillCharge(container) {
        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        var key = parseInt(billJson.length)
        $("#chargesBody").append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(key + 1) + "."))
            .append($("<td>").attr("id", "treatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= $visit['fullname']; ?>')))
            .append($("<td>").attr("id", "treat_date" + key).html(get_date().substr(0, 16)).append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="aquantity' + key + '" placeholder="" value="1" class="form-control" >')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "displayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "displayamount_paid_plafond" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "displaydiscount" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidisat" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidi" + key).html(formatCurrency(0)))
            .append($("<td>").append('<button id="asimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(' + key + ', \'a\')" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off">Simpan</button><div id="aeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'alab\', ' + key + ')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
        )

        $("#chargesBody")
            .append('<input name="treatment[]" id="atreatment' + key + '" type="hidden" value="' + tarifData.tarif_name + '" class="form-control" />')
            .append('<input name="treat_date[]" id="atreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="asell_price' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="aamount_paid' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="discount[]" id="adiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="asubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="asubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="abill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="atrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="ano_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="atheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="avisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="aorg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="aclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="apayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="akaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="atheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="athename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="atheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="astatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isRJ[]" id="aisRJ' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="agender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="aageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="aagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="aageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="akal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="akaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_ID[]" id="aclass_room_ID' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="abed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="aclinic_id' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="aclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="aexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="acashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="amodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="aislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="ameasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="atarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_ID" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#chargesBody").append($("<tr id=\"" + key + "\">")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')
                )
            <?php
            } else {
            ?>
                $("#chargesBody").append($("<tr id=\"" + key + "\">")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')
                )
            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#chargesBody").append($("<tr id=\"" + key + "\">")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key + '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')
                )
            <?php
            } else {
            ?>
                $("#chargesBody").append($("<tr id=\"" + key + "\">")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
                )
            <?php
            }
            ?>
        }
        $("#chargesBody").append($("<tr id=\"" + key + "\">")
            .append('<input name="employee_id[]" id="aemployee_id' + key + '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="adoctor' + key + '" type="hidden" value="<?= $visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="aamount' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="anota_no' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="profesi[]" id="aprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="atagihan' + key + '" type="hidden" value="' + tarifData.amount * $("#aquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="atreatment_plafond' + key + '" type="hidden" value="' + tarifData.amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="atarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type + '" class="form-control" />')
        )
        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#chargesBody").append('<input name="amount_plafond[]" id="aamount_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#chargesBody").append('<input name="amount_paid_plafond[]" id="aamount_paid_plafond' + key + '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#chargesBody").append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#chargesBody").append('<input name="tarif_id_plafond[]" id="atarif_id_plafond' + key + '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#chargesBody").append('<input name="amount_plafond[]" id="aamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#chargesBody").append('<input name="amount_paid_plafond[]" id="aamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
                $("#chargesBody").append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#chargesBody").append('<input name="tarif_id_plafond[]" id="atarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#chargesBody").append('<input name="amount_plafond[]" id="aamount_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#chargesBody").append('<input name="amount_paid_plafond[]" id="aamount_paid_plafond' + key + '" type="hidden" value="0" class="form-control" />')
            $("#chargesBody").append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#chargesBody").append('<input name="tarif_id_plafond[]" id="atarif_id_plafond' + key + '" type="hidden" value="" class="form-control" />')
        }

        $("#aquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#aquantity' + key).on("input", function() {
            var dInput = this.value;
            $("#aamount_paid" + key).val($("#aamount" + key).val() * dInput)
            $("#displayamount_paid" + key).html(formatCurrency($("#aamount" + key).val() * dInput))
            $("#atagihan" + key).val($("#aamount" + key).val() * dInput)
            $("aamount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)
            $("displayamount_paid_plafond" + key).html(formatCurrency($("#aamount_plafond" + key).val() * dInput))
        })
    }

    function simpanBillCharge(key, identifier) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addBillCharge',
            type: "POST",
            data: JSON.stringify({
                'quantity': $("#" + identifier + "quantity" + key).val(),
                'treatment': $("#" + identifier + "treatment" + key).val(),
                'treat_date': $("#" + identifier + "treat_date" + key).val(),
                'sell_price': $("#" + identifier + "sell_price" + key).val(),
                'amount_paid': $("#" + identifier + "amount_paid" + key).val(),
                'discount': $("#" + identifier + "discount" + key).val(),
                'subsidisat': $("#" + identifier + "subsidisat" + key).val(),
                'subsidi': $("#" + identifier + "subsidi" + key).val(),
                'bill_id': $("#" + identifier + "bill_id" + key).val(),
                'trans_id': $("#" + identifier + "trans_id" + key).val(),
                'no_registration': $("#" + identifier + "no_registration" + key).val(),
                'theorder': $("#" + identifier + "theorder" + key).val(),
                'visit_id': $("#" + identifier + "visit_id" + key).val(),
                'org_unit_code': $("#" + identifier + "org_unit_code" + key).val(),
                'class_id_plafond': $("#" + identifier + "class_id_plafond" + key).val(),
                'payor_id': $("#" + identifier + "payor_id" + key).val(),
                'karyawan': $("#" + identifier + "karyawan" + key).val(),
                'theid': $("#" + identifier + "theid" + key).val(),
                'thename': $("#" + identifier + "thename" + key).val(),
                'theaddress': $("#" + identifier + "theaddress" + key).val(),
                'status_pasien_id': $("#" + identifier + "status_pasien_id" + key).val(),
                'isRJ': $("#" + identifier + "isRJ" + key).val(),
                'gender': $("#" + identifier + "gender" + key).val(),
                'ageyear': $("#" + identifier + "ageyear" + key).val(),
                'agemonth': $("#" + identifier + "agemonth" + key).val(),
                'ageday': $("#" + identifier + "ageday" + key).val(),
                'kal_id': $("#" + identifier + "kal_id" + key).val(),
                'karyawan': $("#" + identifier + "karyawan" + key).val(),
                'class_room_ID': $("#" + identifier + "class_room_ID" + key).val(),
                'bed_id': $("#" + identifier + "bed_id" + key).val(),
                'clinic_id': $("#" + identifier + "clinic_id" + key).val(),
                'clinic_id_from': $("#" + identifier + "clinic_id_from" + key).val(),
                'exit_date': $("#" + identifier + "exit_date" + key).val(),
                'cashier': $("#" + identifier + "cashier" + key).val(),
                'modified_from': $("#" + identifier + "modified_from" + key).val(),
                'islunas': $("#" + identifier + "islunas" + key).val(),
                'measure_id': $("#" + identifier + "measure_id" + key).val(),
                'tarif_id': $("#" + identifier + "tarif_id" + key).val(),
                'employee_id_from': $("#" + identifier + "employee_id_from" + key).val(),
                'doctor_from': $("#" + identifier + "doctor_from" + key).val(),
                'employee_id': $("#" + identifier + "employee_id" + key).val(),
                'doctor': $("#" + identifier + "doctor" + key).val(),
                'amount_plafond': $("#" + identifier + "amount_plafond" + key).val(),
                'amount_paid_plafond': $("#" + identifier + "amount_paid_plafond" + key).val(),
                'class_id': $("#" + identifier + "class_id" + key).val(),
                'class_id_plafond': $("#" + identifier + "class_id_plafond" + key).val(),
                'tarif_id_plafond': $("#" + identifier + "tarif_id_plafond" + key).val(),
                'amount': $("#" + identifier + "amount" + key).val(),
                'nota_no': $("#" + identifier + "nota_no" + key).val(),
                'profesi': $("#" + identifier + "profesi" + key).val(),
                'tagihan': $("#" + identifier + "tagihan" + key).val(),
                'treatment_plafond': $("#" + identifier + "treatment_plafond" + key).val(),
                'tarif_type': $("#" + identifier + "tarif_type" + key).val(),
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                $("#" + identifier + "quantity" + key).prop("readonly", true)
                $("#" + identifier + "simpanBillBtn" + key).hide()
                $("#" + identifier + "editDeleteCharge" + key).show()

                var billInaJson = data


                // billInaJson.forEach((element, key) => {

                //     inacbg = parseFloat(billInaJson[key].cbg_tarif)
                //     $("#inacbg").val(formatCurrency(inacbg));

                // });
            },
            error: function() {

            }
        });
    }

    function editBillCharge(identifier, key) {
        $("#" + identifier + "quantity" + key).prop("readonly", false)
        $("#" + identifier + "simpanBillBtn" + key).show()
        $("#" + identifier + "editDeleteCharge" + key).hide()
    }

    function addRowBill(container, identifier, key) {
        $("#" + container).append($("<tr id=\"" + key + "\">")
            .append($("<td>").html(String(key + 1) + "."))
            .append($("<td>").attr("id", identifier + "treatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
            .append($("<td>").attr("id", identifier + "treat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", identifier + "sell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="' + identifier + 'quantity' + key + '" placeholder="" value="' + billJson[key].quantity + '" class="form-control" readonly>')
                .append($("<p>").html(billJson[key].name_of_status_pasien))
            )
            .append($("<td>").attr("id", identifier + "displayamount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
            .append($("<td>").attr("id", identifier + "displayamount_plafond" + key).html((billJson[key].amount_plafond)))
            .append($("<td>").attr("id", identifier + "displayamount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
            .append($("<td>").attr("id", identifier + "displaydiscount" + key).html(formatCurrency(billJson[key].discount)))
            .append($("<td>").attr("id", identifier + "subsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
            .append($("<td>").attr("id", identifier + "subsidi" + key).html(formatCurrency(billJson[key].subsidi)))
            .append($("<td>").append('<button id="' + identifier + 'simpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(' + key + ', \'' + identifier + '\')" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Simpan</button><div id="' + identifier + 'editDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'a\', ' + key + ')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
            // .append($("<td>").append('<button type="button" onclick="" class="editbtn" data-row-id="1" autocomplete="off"></button>'))
            // .append($("<td>").append('<button type="button" onclick="" class="closebtn" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
            .append('<input name="treatment[]" id="' + identifier + 'treatment' + key + '" type="hidden" value="' + billJson[key].treatment + '" class="form-control" />')
            .append('<input name="treat_date[]" id="' + identifier + 'treat_date' + key + '" type="hidden" value="' + billJson[key].treat_date + '" class="form-control" />')
            .append('<input name="sell_price[]" id="' + identifier + 'sell_price' + key + '" type="hidden" value="' + billJson[key].sell_price + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="' + identifier + 'amount_paid' + key + '" type="hidden" value="' + billJson[key].amount_paid + '" class="form-control" />')
            .append('<input name="amount_plafond[]" id="' + identifier + 'amount_plafond' + key + '" type="hidden" value="' + billJson[key].amount_plafond + '" class="form-control" />')
            .append('<input name="discount[]" id="' + identifier + 'discount' + key + '" type="hidden" value="' + billJson[key].discount + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="' + identifier + 'subsidisat' + key + '" type="hidden" value="' + billJson[key].subsidisat + '" class="form-control" />')
            .append('<input name="subsidi[]" id="' + identifier + 'subsidi' + key + '" type="hidden" value="' + billJson[key].subsidi + '" class="form-control" />')
            .append('<input name="bill_id[]" id="' + identifier + 'bill_id' + key + '" type="hidden" value="' + billJson[key].bill_id + '" class="form-control" />')
            .append('<input name="trans_id[]" id="' + identifier + 'trans_id' + key + '" type="hidden" value="' + billJson[key].trans_id + '" class="form-control" />')
            .append('<input name="no_registration[]" id="' + identifier + 'no_registration' + key + '" type="hidden" value="' + billJson[key].no_registration + '" class="form-control" />')
            .append('<input name="theorder[]" id="' + identifier + 'theorder' + key + '" type="hidden" value="' + billJson[key].theorder + '" class="form-control" />')
            .append('<input name="visit_id[]" id="' + identifier + 'visit_id' + key + '" type="hidden" value="' + billJson[key].visit_id + '" class="form-control" />')
            .append('<input name="org_unit_code[]" id="' + identifier + 'org_unit_code' + key + '" type="hidden" value="' + billJson[key].org_unit_code + '" class="form-control" />')
            .append('<input name="class_id[]" id="' + identifier + 'class_id' + key + '" type="hidden" value="' + billJson[key].class_id + '" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="' + identifier + 'class_id_plafond' + key + '" type="hidden" value="' + billJson[key].class_id_plafond + '" class="form-control" />')
            .append('<input name="payor_id[]" id="' + identifier + 'payor_id' + key + '" type="hidden" value="' + billJson[key].payor_id + '" class="form-control" />')
            .append('<input name="karyawan[]" id="' + identifier + 'karyawan' + key + '" type="hidden" value="' + billJson[key].karyawan + '" class="form-control" />')
            .append('<input name="theid[]" id="' + identifier + 'theid' + key + '" type="hidden" value="' + billJson[key].theid + '" class="form-control" />')
            .append('<input name="thename[]" id="' + identifier + 'thename' + key + '" type="hidden" value="' + billJson[key].thename + '" class="form-control" />')
            .append('<input name="theaddress[]" id="' + identifier + 'theaddress' + key + '" type="hidden" value="' + billJson[key].theaddress + '" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="' + identifier + 'status_pasien_id' + key + '" type="hidden" value="' + billJson[key].status_pasien_id + '" class="form-control" />')
            .append('<input name="isRJ[]" id="' + identifier + 'isRJ' + key + '" type="hidden" value="' + billJson[key].isRJ + '" class="form-control" />')
            .append('<input name="gender[]" id="' + identifier + 'gender' + key + '" type="hidden" value="' + billJson[key].gender + '" class="form-control" />')
            .append('<input name="ageyear[]" id="' + identifier + 'ageyear' + key + '" type="hidden" value="' + billJson[key].ageyear + '" class="form-control" />')
            .append('<input name="agemonth[]" id="' + identifier + 'agemonth' + key + '" type="hidden" value="' + billJson[key].agemonth + '" class="form-control" />')
            .append('<input name="ageday[]" id="' + identifier + 'ageday' + key + '" type="hidden" value="' + billJson[key].ageday + '" class="form-control" />')
            .append('<input name="kal_id[]" id="' + identifier + 'kal_id' + key + '" type="hidden" value="' + billJson[key].kal_id + '" class="form-control" />')
            .append('<input name="karyawan[]" id="' + identifier + 'karyawan' + key + '" type="hidden" value="' + billJson[key].karyawan + '" class="form-control" />')
            .append('<input name="class_room_ID[]" id="' + identifier + 'class_room_ID' + key + '" type="hidden" value="' + billJson[key].class_room_ID + '" class="form-control" />')
            .append('<input name="bed_id[]" id="' + identifier + 'bed_id' + key + '" type="hidden" value="' + billJson[key].bed_id + '" class="form-control" />')
            .append('<input name="employee_id_from[]" id="' + identifier + 'employee_id_from' + key + '" type="hidden" value="' + billJson[key].employee_id_from + '" class="form-control" />')
            .append('<input name="employee_id[]" id="' + identifier + 'employee_id' + key + '" type="hidden" value="' + billJson[key].employee_id + '" class="form-control" />')
            .append('<input name="doctor_from[]" id="' + identifier + 'doctor_from' + key + '" type="hidden" value="' + billJson[key].doctor_from + '" class="form-control" />')
            .append('<input name="clinic_id[]" id="' + identifier + 'clinic_id' + key + '" type="hidden" value="' + billJson[key].clinic_id + '" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="' + identifier + 'clinic_id_from' + key + '" type="hidden" value="' + billJson[key].clinic_id_from + '" class="form-control" />')
            .append('<input name="exit_date[]" id="' + identifier + 'exit_date' + key + '" type="hidden" value="' + billJson[key].exit_date + '" class="form-control" />')
            .append('<input name="cashier[]" id="' + identifier + 'cashier' + key + '" type="hidden" value="' + billJson[key].cashier + '" class="form-control" />')
            .append('<input name="modified_from[]" id="' + identifier + 'modified_from' + key + '" type="hidden" value="' + billJson[key].modified_from + '" class="form-control" />')
            .append('<input name="islunas[]" id="' + identifier + 'islunas' + key + '" type="hidden" value="' + billJson[key].islunas + '" class="form-control" />')
            .append('<input name="measure_id[]" id="' + identifier + 'measure_id' + key + '" type="hidden" value="' + billJson[key].measure_id + '" class="form-control" />')
            .append('<input name="tarif_id[]" id="' + identifier + 'tarif_id' + key + '" type="hidden" value="' + billJson[key].tarif_id + '" class="form-control" />')
            .append('<input name="amount[]" id="' + identifier + 'amount' + key + '" type="hidden" value="' + billJson[key].amount + '" class="form-control" />')
            .append('<input name="nota_no[]" id="' + identifier + 'nota_no' + key + '" type="hidden" value="' + billJson[key].nota_no + '" class="form-control" />')
            .append('<input name="profesi[]" id="' + identifier + 'profesi' + key + '" type="hidden" value="' + billJson[key].profesi + '" class="form-control" />')
            .append('<input name="tagihan[]" id="' + identifier + 'tagihan' + key + '" type="hidden" value="' + billJson[key].tagihan + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="' + identifier + 'treatment_plafond' + key + '" type="hidden" value="' + billJson[key].treatment_plafond + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="' + identifier + 'tarif_type' + key + '" type="hidden" value="' + billJson[key].tarif_type + '" class="form-control" />')

        )
        $("#" + identifier + "quantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
        });
        $('#' + identifier + 'quantity' + key).on("input", function() {
            var dInput = this.value;
            console.log(dInput);
            $("#" + identifier + "amount_paid" + key).val($("#aamount" + key).val() * dInput)
            $("#" + identifier + "displayamount_paid" + key).val($("#aamount" + key).val() * dInput)
            $("#" + identifier + "atagihan" + key).val($("#aamount" + key).val() * dInput)
            $("#" + identifier + "amount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)
            $("#" + identifier + "displayamount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)

        })
    }

    function getInacbg(visit) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getInacbg',
            type: "POST",
            data: JSON.stringify({
                'visit': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var billInaJson = data


                billInaJson.forEach((element, key) => {

                    inacbg = parseFloat(billInaJson[key].cbg_tarif)
                    $("#inacbg").val(formatCurrency(inacbg));

                });
            },
            error: function() {

            }
        });
    }
</script>