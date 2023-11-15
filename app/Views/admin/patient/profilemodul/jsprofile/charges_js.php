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
    $(document).ready(function(e) {
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

        getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans)
        getResep(visit, nomor)
        getInacbg(visit)
        getHasilLab(nomor, visit)
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

                    $("#chargesBody").append($("<tr>")
                        .append($("<td>").html(String(key + 1) + "."))
                        .append($("<td>").attr("id", "treatment" + key).html(billJson[key].treatment).append($("<p>").html(billJson[key].doctor)))
                        .append($("<td>").attr("id", "treat_date" + key).html(billJson[key].treat_date.substr(0, 16)).append($("<p>").html(billJson[key].name_of_clinic)))
                        // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                        .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(billJson[key].sell_price)).append($("<p>").html(lunas)))
                        .append($("<td>").attr("id", "quantity" + key).html(formatCurrency(billJson[key].quantity)).append($("<p>").html(billJson[key].name_of_status_pasien)))
                        .append($("<td>").attr("id", "amount_paid" + key).html(formatCurrency(billJson[key].tagihan)))
                        .append($("<td>").attr("id", "amount_plafond" + key).html((billJson[key].amount_plafond)))
                        .append($("<td>").attr("id", "amount_paid_plafond" + key).html(formatCurrency(billJson[key].amount_paid_plafond)))
                        .append($("<td>").attr("id", "discount" + key).html(formatCurrency(billJson[key].discount)))
                        .append($("<td>").attr("id", "subsidisat" + key).html(formatCurrency(billJson[key].subsidisat)))
                        .append($("<td>").attr("id", "subsidisat" + key).html(formatCurrency(billJson[key].subsidi)))
                        .append($("<td>").append('<button type="button" onclick="" class="editbtn" data-row-id="1" autocomplete="off"><i class="fa fa-edit"></i></button>'))
                        .append($("<td>").append('<button type="button" onclick="" class="closebtn" data-row-id="1" autocomplete="off"><i class="fa fa-remove"></i></button>'))


                    )

                    if (billJson[key].clinic_id == 'P016') {
                        $("#radBody").append($("<tr>")
                            .append($("<td>").html(billJson[key].tarif_id))
                            .append($("<td>").html(billJson[key].treatment))
                            .append($("<td>").html(billJson[key].treat_date))
                            .append($("<td>").html(billJson[key].doctor))
                            .append($("<td>").html(billJson[key].nota_no))
                            .append($("<td>").append('<button type="button" onclick="getTreatResult(\'' + billJson[key].no_registration + '\',\'' + billJson[key].visit_id + '\',\'' + billJson[key].tarif_id + '\')" class="editbtn" data-row-id="1" autocomplete="off"><i class="fa fa-edit"></i></button>'))


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
                billJson = data


                billJson.forEach((element, key) => {

                    inacbg = parseFloat(billJson[key].cbg_tarif)
                    $("#inacbg").val(formatCurrency(inacbg));

                });
            },
            error: function() {

            }
        });
    }
</script>