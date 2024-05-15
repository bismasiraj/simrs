<script type='text/javascript'>
    var inacbg = 0.0;
    var billJson;
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

                    $("#chargesBody").append($("<tr id=\"" + key + "\">")
                        .append($("<td>").html(String(key + 1) + "."))
                        .append($("<td>").attr("id", "treatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
                        .append($("<td>").attr("id", "treat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
                        // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                        .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
                        .append($("<td>")
                            .append('<input type="text" name="quantity[]" id="aquantity' + key + '" placeholder="" value="' + billJson[key].quantity + '" class="form-control" readonly>')
                            .append($("<p>").html(billJson[key].name_of_status_pasien))
                        )
                        .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
                        .append($("<td>").attr("id", "displayamount_plafond" + key).html((billJson[key].amount_plafond)))
                        .append($("<td>").attr("id", "displayamount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
                        .append($("<td>").attr("id", "displaydiscount" + key).html(formatCurrency(billJson[key].discount)))
                        .append($("<td>").attr("id", "subsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
                        .append($("<td>").attr("id", "subsidi" + key).html(formatCurrency(billJson[key].subsidi)))
                        .append($("<td>").append('<button id="simpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(' + key + ')" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Simpan</button><div id="editDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
                        // .append($("<td>").append('<button type="button" onclick="" class="editbtn" data-row-id="1" autocomplete="off"></button>'))
                        // .append($("<td>").append('<button type="button" onclick="" class="closebtn" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))
                        .append('<input name="treatment[]" id="atreatment' + key + '" type="hidden" value="' + billJson[key].treatment + '" class="form-control" />')
                        .append('<input name="treat_date[]" id="atreat_date' + key + '" type="hidden" value="' + billJson[key].treat_date + '" class="form-control" />')
                        .append('<input name="sell_price[]" id="asell_price' + key + '" type="hidden" value="' + billJson[key].sell_price + '" class="form-control" />')
                        .append('<input name="amount_paid[]" id="aamount_paid' + key + '" type="hidden" value="' + billJson[key].amount_paid + '" class="form-control" />')
                        .append('<input name="amount_plafond[]" id="aamount_plafond' + key + '" type="hidden" value="' + billJson[key].amount_plafond + '" class="form-control" />')
                        .append('<input name="discount[]" id="adiscount' + key + '" type="hidden" value="' + billJson[key].discount + '" class="form-control" />')
                        .append('<input name="subsidisat[]" id="asubsidisat' + key + '" type="hidden" value="' + billJson[key].subsidisat + '" class="form-control" />')
                        .append('<input name="subsidi[]" id="asubsidi' + key + '" type="hidden" value="' + billJson[key].subsidi + '" class="form-control" />')
                        .append('<input name="bill_id[]" id="abill_id' + key + '" type="hidden" value="' + billJson[key].bill_id + '" class="form-control" />')
                        .append('<input name="trans_id[]" id="atrans_id' + key + '" type="hidden" value="' + billJson[key].trans_id + '" class="form-control" />')
                        .append('<input name="no_registration[]" id="ano_registration' + key + '" type="hidden" value="' + billJson[key].no_registration + '" class="form-control" />')
                        .append('<input name="theorder[]" id="atheorder' + key + '" type="hidden" value="' + billJson[key].theorder + '" class="form-control" />')
                        .append('<input name="visit_id[]" id="akunjungan' + key + '" type="hidden" value="' + billJson[key].visit_id + '" class="form-control" />')
                        .append('<input name="org_unit_code[]" id="aorg_unit_code' + key + '" type="hidden" value="' + billJson[key].org_unit_code + '" class="form-control" />')
                        .append('<input name="class_id[]" id="aclass_id' + key + '" type="hidden" value="' + billJson[key].class_id + '" class="form-control" />')
                        .append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key + '" type="hidden" value="' + billJson[key].class_id_plafond + '" class="form-control" />')
                        .append('<input name="payor_id[]" id="apayor_id' + key + '" type="hidden" value="' + billJson[key].payor_id + '" class="form-control" />')
                        .append('<input name="karyawan[]" id="akaryawan' + key + '" type="hidden" value="' + billJson[key].karyawan + '" class="form-control" />')
                        .append('<input name="theid[]" id="atheid' + key + '" type="hidden" value="' + billJson[key].theid + '" class="form-control" />')
                        .append('<input name="thename[]" id="athename' + key + '" type="hidden" value="' + billJson[key].thename + '" class="form-control" />')
                        .append('<input name="theaddress[]" id="atheaddress' + key + '" type="hidden" value="' + billJson[key].theaddress + '" class="form-control" />')
                        .append('<input name="status_pasien_id[]" id="astatus_pasien_id' + key + '" type="hidden" value="' + billJson[key].status_pasien_id + '" class="form-control" />')
                        .append('<input name="isRJ[]" id="aisRJ' + key + '" type="hidden" value="' + billJson[key].isRJ + '" class="form-control" />')
                        .append('<input name="gender[]" id="agender' + key + '" type="hidden" value="' + billJson[key].gender + '" class="form-control" />')
                        .append('<input name="ageyear[]" id="aageyear' + key + '" type="hidden" value="' + billJson[key].ageyear + '" class="form-control" />')
                        .append('<input name="agemonth[]" id="aagemonth' + key + '" type="hidden" value="' + billJson[key].agemonth + '" class="form-control" />')
                        .append('<input name="ageday[]" id="aageday' + key + '" type="hidden" value="' + billJson[key].ageday + '" class="form-control" />')
                        .append('<input name="kal_id[]" id="akal_id' + key + '" type="hidden" value="' + billJson[key].kal_id + '" class="form-control" />')
                        .append('<input name="karyawan[]" id="akaryawan' + key + '" type="hidden" value="' + billJson[key].karyawan + '" class="form-control" />')
                        .append('<input name="class_room_ID[]" id="aclass_room_ID' + key + '" type="hidden" value="' + billJson[key].class_room_ID + '" class="form-control" />')
                        .append('<input name="bed_id[]" id="abed_id' + key + '" type="hidden" value="' + billJson[key].bed_id + '" class="form-control" />')
                        .append('<input name="employee_id_from[]" id="aemployee_id_from' + key + '" type="hidden" value="' + billJson[key].employee_id_from + '" class="form-control" />')
                        .append('<input name="doctor_from[]" id="adoctor_from' + key + '" type="hidden" value="' + billJson[key].doctor_from + '" class="form-control" />')
                        .append('<input name="clinic_id_from[]" id="aclinic_id_from' + key + '" type="hidden" value="' + billJson[key].clinic_id_from + '" class="form-control" />')
                        .append('<input name="exit_date[]" id="aexit_date' + key + '" type="hidden" value="' + billJson[key].exit_date + '" class="form-control" />')
                        .append('<input name="cashier[]" id="acashier' + key + '" type="hidden" value="' + billJson[key].cashier + '" class="form-control" />')
                        .append('<input name="modified_from[]" id="aoleh' + key + '" type="hidden" value="' + billJson[key].modified_from + '" class="form-control" />')
                        .append('<input name="islunas[]" id="aislunas' + key + '" type="hidden" value="' + billJson[key].islunas + '" class="form-control" />')
                        .append('<input name="measure_id[]" id="ameasure_id' + key + '" type="hidden" value="' + billJson[key].measure_id + '" class="form-control" />')
                        .append('<input name="tarif_id[]" id="atarif_id' + key + '" type="hidden" value="' + billJson[key].tarif_id + '" class="form-control" />')
                        .append('<input name="amount[]" id="aamount' + key + '" type="hidden" value="' + billJson[key].amount + '" class="form-control" />')
                        .append('<input name="nota_no[]" id="anota_no' + key + '" type="hidden" value="' + billJson[key].nota_no + '" class="form-control" />')
                        .append('<input name="profesi[]" id="aprofesi' + key + '" type="hidden" value="' + billJson[key].profesi + '" class="form-control" />')
                        .append('<input name="tagihan[]" id="atagihan' + key + '" type="hidden" value="' + billJson[key].tagihan + '" class="form-control" />')
                        .append('<input name="treatment_plafond[]" id="atreatment_plafond' + key + '" type="hidden" value="' + billJson[key].treatment_plafond + '" class="form-control" />')
                        .append('<input name="tarif_type[]" id="atarif_type' + key + '" type="hidden" value="' + billJson[key].tarif_type + '" class="form-control" />')

                    )
                    $("#aquantity" + key).keydown(function(e) {
                        !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
                    });
                    $('#aquantity' + key).on("input", function() {
                        var dInput = this.value;
                        console.log(dInput);
                        $("#aamount_paid" + key).val($("#aamount" + key).val() * dInput)
                        $("#displayamount_paid" + key).val($("#aamount" + key).val() * dInput)
                        $("#atagihan" + key).val($("#aamount" + key).val() * dInput)
                        $("aamount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)
                        $("displayamount_paid_plafond" + key).val($("#aamount_plafond" + key).val() * dInput)

                    })

                    if (billJson[key].clinic_id == 'P016') {
                        $("#radChargesBody").append($("<tr>")
                            .append($("<td>").html(String(key + 1) + "."))
                            .append($("<td>").attr("id", "labtreatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
                            .append($("<td>").attr("id", "labtreat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
                            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                            .append($("<td>").attr("id", "labsell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
                            .append($("<td>").attr("id", "labquantity" + key).html(formatCurrency(billJson[key].quantity)).append($("<p>").html(billJson[key].name_of_status_pasien)))
                            .append($("<td>").attr("id", "labamount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
                            .append($("<td>").attr("id", "labamount_plafond" + key).html((billJson[key].amount_plafond)))
                            .append($("<td>").attr("id", "labamount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
                            .append($("<td>").attr("id", "labdiscount" + key).html(formatCurrency(billJson[key].discount)))
                            .append($("<td>").attr("id", "labsubsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
                            .append($("<td>").attr("id", "labsubsidisat" + key).html(formatCurrency(billJson[key].subsidi)))
                            // .append($("<td>").append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button type="button" onclick="addNR()" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button type="button" onclick="addR()" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
                        )
                    }
                    if (billJson[key].clinic_id == 'P013') {
                        $("#labChargesBody").append($("<tr>")
                            .append($("<td>").html(String(key + 1) + "."))
                            .append($("<td>").attr("id", "labtreatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
                            .append($("<td>").attr("id", "labtreat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
                            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                            .append($("<td>").attr("id", "labsell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
                            .append($("<td>").attr("id", "labquantity" + key).html(formatCurrency(billJson[key].quantity)).append($("<p>").html(billJson[key].name_of_status_pasien)))
                            .append($("<td>").attr("id", "labamount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
                            .append($("<td>").attr("id", "labamount_plafond" + key).html((billJson[key].amount_plafond)))
                            .append($("<td>").attr("id", "labamount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
                            .append($("<td>").attr("id", "labdiscount" + key).html(formatCurrency(billJson[key].discount)))
                            .append($("<td>").attr("id", "labsubsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
                            .append($("<td>").attr("id", "labsubsidisat" + key).html(formatCurrency(billJson[key].subsidi)))
                            // .append($("<td>").append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button type="button" onclick="addNR()" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button type="button" onclick="addR()" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
                        )
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
        alert(tarifDataJson);
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
            .append($("<td>").append('<button id="simpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(' + key + ')" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'' + key + '\', ' + key + ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
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

    function simpanBillCharge(key) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addBillCharge',
            type: "POST",
            data: JSON.stringify({
                'quantity': $("#aquantity" + key).val(),
                'treatment': $("#atreatment" + key).val(),
                'treat_date': $("#atreat_date" + key).val(),
                'sell_price': $("#asell_price" + key).val(),
                'amount_paid': $("#aamount_paid" + key).val(),
                'discount': $("#adiscount" + key).val(),
                'subsidisat': $("#asubsidisat" + key).val(),
                'subsidi': $("#asubsidi" + key).val(),
                'bill_id': $("#abill_id" + key).val(),
                'trans_id': $("#atrans_id" + key).val(),
                'no_registration': $("#ano_registration" + key).val(),
                'theorder': $("#atheorder" + key).val(),
                'visit_id': $("#avisit_id" + key).val(),
                'org_unit_code': $("#aorg_unit_code" + key).val(),
                'class_id_plafond': $("#aclass_id_plafond" + key).val(),
                'payor_id': $("#apayor_id" + key).val(),
                'karyawan': $("#akaryawan" + key).val(),
                'theid': $("#atheid" + key).val(),
                'thename': $("#athename" + key).val(),
                'theaddress': $("#atheaddress" + key).val(),
                'status_pasien_id': $("#astatus_pasien_id" + key).val(),
                'isRJ': $("#aisRJ" + key).val(),
                'gender': $("#agender" + key).val(),
                'ageyear': $("#aageyear" + key).val(),
                'agemonth': $("#aagemonth" + key).val(),
                'ageday': $("#aageday" + key).val(),
                'kal_id': $("#akal_id" + key).val(),
                'karyawan': $("#akaryawan" + key).val(),
                'class_room_ID': $("#aclass_room_ID" + key).val(),
                'bed_id': $("#abed_id" + key).val(),
                'clinic_id': $("#aclinic_id" + key).val(),
                'clinic_id_from': $("#aclinic_id_from" + key).val(),
                'exit_date': $("#aexit_date" + key).val(),
                'cashier': $("#acashier" + key).val(),
                'modified_from': $("#amodified_from" + key).val(),
                'islunas': $("#aislunas" + key).val(),
                'measure_id': $("#ameasure_id" + key).val(),
                'tarif_id': $("#atarif_id" + key).val(),
                'employee_id_from': $("#aemployee_id_from" + key).val(),
                'doctor_from': $("#adoctor_from" + key).val(),
                'employee_id': $("#aemployee_id" + key).val(),
                'doctor': $("#adoctor" + key).val(),
                'amount_plafond': $("#aamount_plafond" + key).val(),
                'amount_paid_plafond': $("#aamount_paid_plafond" + key).val(),
                'class_id': $("#aclass_id" + key).val(),
                'class_id_plafond': $("#aclass_id_plafond" + key).val(),
                'tarif_id_plafond': $("#atarif_id_plafond" + key).val(),
                'amount': $("#aamount" + key).val(),
                'nota_no': $("#anota_no" + key).val(),
                'profesi': $("#aprofesi" + key).val(),
                'tagihan': $("#atagihan" + key).val(),
                'treatment_plafond': $("#atreatment_plafond" + key).val(),
                'tarif_type': $("#atarif_type" + key).val(),
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                $("#aquantity" + key).prop("readonly", true)
                $("#simpanBillBtn" + key).hide()
                $("#editDeleteCharge" + key).show()

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