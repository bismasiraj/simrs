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

    var billpolitagihan = 0.0;
    var billpolisubsidi = 0.0;
    var billpolipotongan = 0.0;
    var billpolipembulatan = 0.0;
    var billpolipembayaran = 0.0;
    var billpoliretur = 0.0;
    var billpolitotal = 0.0;

    var labtagihan = 0.0;
    var labsubsidi = 0.0;
    var labpotongan = 0.0;
    var labpembulatan = 0.0;
    var labpembayaran = 0.0;
    var labretur = 0.0;
    var labtotal = 0.0;

    var radtagihan = 0.0;
    var radsubsidi = 0.0;
    var radpotongan = 0.0;
    var radpembulatan = 0.0;
    var radpembayaran = 0.0;
    var radretur = 0.0;
    var radtotal = 0.0;


    var lastOrder = 0;

    // $(document).ready(function(e) {

    //     // getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans)
    // })
    $("#chargesTab").on("click", function() {
        // $("#flatstartDateCharge")
        getBillPoli(nomor, ke, mulai, akhir, lunas, klinik, rj, status, nota, trans)
        getInacbg(visit.visit_id)
    })
</script>
<script>
    const reorderBillJson = (billJson) => {
        billJson.sort((a, b) => {
            // Compare by casemix_id first
            if (a.casemix_id !== b.casemix_id) {
                return a.casemix_id - b.casemix_id;
            }

            // If casemix_id is the same, compare by treat_date
            const dateA = new Date(a.treat_date);
            const dateB = new Date(b.treat_date);
            return dateA - dateB;
        });

        return billJson
    }

    function filterBillCharge() {
        total = 0;
        tagihan = 0;
        subsidi = 0;
        potongan = 0;
        pembulatan = 0;
        pembayaran = 0;
        retur = 0;
        $("#chargesBody").html("")
        var notaNoCharge = $("#notaNoCharge").val()
        var casemixId = $("#casemixId").val()
        billJson.forEach((element, key) => {
            if ((billJson[key].nota_no == notaNoCharge || '%' == notaNoCharge) && (billJson[key].casemix_id ==
                    casemixId || '%' == casemixId)) {
                if ($("#casemix" + billJson[key].casemix_id).length == 0) {
                    $("#chargesBody").append(
                        `<tr id="casemix${billJson[key].casemix_id}" class="table-light">
                            <td colspan="4"><h3>${casemixArray[parseInt(billJson[key].casemix_id) - 1]}</h3></td>
                            <td colspan="4"><h4 id="displaytotal_casemix${billJson[key].casemix_id}">0.0</h4></td>
                            <input type="hidden" id="total_casemix${billJson[key].casemix_id}" value="0.0">
                        </tr>`
                    )
                }
                var i = $('#chargesBody .bill').length + 1;
                var counter = 'charge' + i
                addRowBill("chargesBody", "a", key, i, counter)
                tagihan += parseFloat(billJson[key].tagihan)
                countCasemix(billJson[key].casemix_id, parseFloat(billJson[key].tagihan))

                //  sum(if(isnull(subsidi),0,subsidi) for all)
                subsidi += (isNaN(billJson[key].subsidi) ? 0 : billJson[key].subsidi)

                //  sum(if(isnull(potongan),0,potongan) for all)
                potongan += billJson[key].potongan

                // sum(pembulatannya for all)
                pembulatan += billJson[key].pembulatan

                // sum(if(isnull(bayar),0,bayar) for all)
                pembayaran += billJson[key].bayar

                // sum(if(isnull(retur),0,retur) for all)
                retur += billJson[key].retur
            }
        })
        total += (isNaN(tagihan) ? 0 : tagihan) -
            (isNaN(subsidi) ? 0 : subsidi) -
            (isNaN(potongan) ? 0 : potongan) +
            (isNaN(pembulatan) ? 0 : pembulatan) -
            (isNaN(pembayaran) ? 0 : pembayaran) +
            (isNaN(retur) ? 0 : retur);
        labtotal += labtagihan - (labsubsidi + labpotongan) + labpembulatan - labpembayaran + labretur;
        radtotal += radtagihan - (radsubsidi + radpotongan) + radpembulatan - radpembayaran + radretur;
        billpolitotal += billpolitagihan - (billpolisubsidi + billpolipotongan) + billpolipembulatan - billpolipembayaran +
            billpoliretur;

        $("#tagihan_total").val(formatCurrency(tagihan));
        $("#subsidi_total").val(formatCurrency(subsidi));
        $("#potongan_total").val(formatCurrency(potongan));
        $("#pembulatan_total").val(formatCurrency(pembulatan));
        $("#pelunasan_total").val(formatCurrency(pembayaran));
        $("#retur_total").val(formatCurrency(retur));
        $("#totalnya").val(formatCurrency(total));

    }

    const countCasemix = (casemix_id, price) => {
        let jml_sementara = parseFloat($("#total_casemix" + casemix_id).val())
        let jml_akhir = jml_sementara + price
        $("#total_casemix" + casemix_id).val(jml_akhir)
        $("#displaytotal_casemix" + casemix_id).html("Subtotal: Rp. " + formatCurrency(jml_akhir))
    }

    const chargesDropdownDoctor0 = (props) => {
        console.log(props);

        let options = '';
        let employees = <?= json_encode($employee); ?>;
        let visitDpjp = <?= json_encode($visit['kddpjp'] ?? null); ?>;

        if (props === "arad") {
            employees = employees?.filter(e =>
                e.fullname.toLowerCase().includes('tinton') || e.fullname.toLowerCase().includes('muchtar') || e
                .specialist_type_id == 1.06
            );
        }

        employees.forEach(employee => {
            const selected = employee.dpjp === visitDpjp ? 'selected' : '';
            options += `<option value="${employee.employee_id}" ${selected}>${employee.fullname}</option>`;
        });

        return options;
    }


    const chargesDropdownDoctor = (props) => {
        let options = '';
        let employees = <?= json_encode($employee); ?>;
        let visitDpjp = <?= json_encode($visit['kddpjp'] ?? null); ?>;


        if (props === "arad") {
            employees = Object.values(employees).filter(e =>
                e.fullname.toLowerCase().includes('tinton') || e.fullname.toLowerCase().includes('muchtar') || e
                .specialist_type_id == 1.06
            );
        }

        Object.values(employees).forEach(employee => {
            const selected = employee.dpjp === visitDpjp ? 'selected' : '';
            options += `<option value="${employee.employee_id}" ${selected}>${employee.fullname}</option>`;
        });


        return options;
    } // new Update 08/02/2025
</script>
<script type='text/javascript'>
    $("#btn-search-charge").off().on("click", function() {
        let start = $("#startDateCharge").val();
        start = start.replace('T', ' ')
        let end = $("#endDateCharge").val();
        end = end.replace('T', ' ')
        // const start = moment($("#startDateCharge").val()).format("YYYY-MM-DD") + " 00:00:01";
        // const end = moment($("#endDateCharge").val()).format("YYYY-MM-DD") + " 23:59:59";
        getBillPoli(nomor, ke, start, end, lunas, '%', rj, status, nota, trans, start, end);
        $("#notaNoCharge").val("%")
    });
    $("#notaNoCharge").on("change", function() {
        $("#casemixId").val('%')
        filterBillCharge()
    })
    $("#casemixId").on("change", function() {
        $("#notaNoCharge").val('%')
        filterBillCharge()
    })

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
            beforeSend: function() {
                $("#labChargesBody").html(loadingScreen())
                $("#radChargesBody").html(loadingScreen())
                $("#penunjangChargesBody").html(loadingScreen()) //new 07/10/2024
                $("#fisioChargesBody").html(loadingScreen())
                $("#billPoliChargesBody").html(loadingScreen())
                $("#patologiChargesBody").html(loadingScreen()) //new 10/10/2024
                $("#chargesBody").html(loadingScreen())
            },
            success: function(data) {

                $("#labChargesBody").html("")
                $("#radChargesBody").html("")
                $("#fisioChargesBody").html("")
                $("#penunjangChargesBody").html("") //new 07/10/2024
                $("#patologiChargesBody").html("") //new 10/10/2024
                $("#billPoliChargesBody").html("")
                $("#chargesBody").html("")
                if (klinik === 'P013') {
                    console.log("bisa");
                    postData({
                        no_registration: nomor,
                        trans_id: trans
                    }, 'admin/labRequest/getCitoPenunjang', (res) => {
                        console.log(res);

                        if (res.success && Array.isArray(res.data) && res.data.length > 0) {
                            const lookup = res.data.reduce((acc, cur) => {
                                acc[cur.nota_no] = cur;
                                return acc;
                            }, {});

                            billJson = data.map(item => {
                                if (lookup[item.nota_no]) {
                                    return {
                                        ...item,
                                        ...lookup[item.nota_no]
                                    };
                                }
                                return item;
                            });
                        } else {
                            billJson = data;
                        }

                        rendergetBillPoliRequest()
                    });
                } else {
                    console.log("Tidak bisa");
                    billJson = data;
                    rendergetBillPoliRequest()
                }


                // total = 0;
                // tagihan = 0;
                // subsidi = 0;
                // potongan = 0;
                // pembulatan = 0;
                // pembayaran = 0;
                // retur = 0;

                // billpolitotal = 0;
                // billpolitagihan = 0;
                // billpolisubsidi = 0;
                // billpolipotongan = 0;
                // billpolipembulatan = 0;
                // billpolipembayaran = 0;
                // billpoliretur = 0;

                // labtotal = 0;
                // labtagihan = 0;
                // labsubsidi = 0;
                // labpotongan = 0;
                // labpembulatan = 0;
                // labpembayaran = 0;
                // labretur = 0;

                // radtotal = 0;
                // radtagihan = 0;
                // radsubsidi = 0;
                // radpotongan = 0;
                // radpembulatan = 0;
                // radpembayaran = 0;
                // radretur = 0;

                // penunjangmedistotal = 0; //new 07/10/2024
                // penunjangmedistagihan = 0; //new 07/10/2024
                // penunjangmedissubsidi = 0; //new 07/10/2024
                // penunjangmedispotongan = 0; //new 07/10/2024
                // penunjangmedispembulatan = 0; //new 07/10/2024
                // penunjangmedispembayaran = 0; //new 07/10/2024
                // penunjangmedisretur = 0; //new 07/10/2024

                // patologitotal = 0; //new 10/10/2024
                // patologitagihan = 0; //new 10/10/2024
                // patologisubsidi = 0; //new 10/10/2024
                // patologipotongan = 0; //new 10/10/2024
                // patologipembulatan = 0; //new 10/10/2024
                // patologipembayaran = 0; //new 10/10/2024
                // patologiretur = 0; //new 10/10/2024
                // $("#chargesBody").html("")
                // $("#labChargesBody").html("")
                // $("#radChargesBody").html("")
                // $("#fisioChargesBody").html("")
                // $("#billPoliChargesBody").html("")
                // $("#penunjangChargesBody").html("") //new 07/10/2024
                // $("#patologiChargesBody").html("") //new 10/10/2024

                // billJson = reorderBillJson(billJson);
                // billJson.forEach((element, key) => {
                //     if ($("#casemix" + billJson[key].casemix_id).length == 0) {
                //         $("#chargesBody").append(
                //             `<tr id="casemix${billJson[key].casemix_id}" class="table-light">
                //                     <td colspan="4"><h3>${casemixArray[parseInt(billJson[key].casemix_id) - 1]}</h3></td>
                //                     <td colspan="4"><h4 id="displaytotal_casemix${billJson[key].casemix_id}">0.0</h4></td>
                //                     <input type="hidden" id="total_casemix${billJson[key].casemix_id}" value="0.0">
                //                 </tr>`
                //         )
                //     }

                //     billJson[key].sell_price = parseFloat(billJson[key].sell_price)
                //     // if (!isnullcheck(billJson[key].quantity))
                //     //     billJson[key].quantity = parseFloat((billJson[key].quantity))
                //     // else
                //     //     billJson[key].quantity = 0
                //     billJson[key].quantity = isnullcheck(billJson[key].quantity)
                //     billJson[key].amount_paid = isnullcheck(billJson[key].amount_paid)

                //     billJson[key].amount_plafond = parseFloat(billJson[key].amount_plafond)
                //     billJson[key].amount_paid_plafond = parseFloat(billJson[key].amount_paid_plafond)
                //     billJson[key].discount = parseFloat(billJson[key].discount)
                //     billJson[key].subsidisat = parseFloat(billJson[key].subsidisat)
                //     billJson[key].subsidi = parseFloat(billJson[key].subsidi)
                //     billJson[key].potongan = parseFloat(isnullcheck(billJson[key].potongan))
                //     billJson[key].pembulatan = parseFloat(isnullcheck(billJson[key].pembulatan))
                //     billJson[key].bayar = parseFloat(isnullcheck(billJson[key].bayar))
                //     billJson[key].retur = parseFloat(isnullcheck(billJson[key].retur))
                //     billJson[key].tagihan = parseFloat(isnullcheck(billJson[key].tagihan))
                //     billJson[key].quantity = parseFloat(isnullcheck(billJson[key].quantity))
                //     billJson[key].amount_paid = parseFloat((billJson[key].amount_paid))

                //     tagihan += parseFloat(billJson[key].tagihan)

                //     countCasemix(billJson[key].casemix_id, parseFloat(billJson[key].tagihan))

                //     //  sum(if(isnull(subsidi),0,subsidi) for all)
                //     subsidi += (isNaN(billJson[key].subsidi) ? 0 : billJson[key].subsidi)

                //     //  sum(if(isnull(potongan),0,potongan) for all)
                //     potongan += (isNaN(billJson[key].potongan) ? 0 : billJson[key].potongan)

                //     // sum(pembulatannya for all)
                //     pembulatan += (isNaN(billJson[key].pembulatan) ? 0 : billJson[key].pembulatan)

                //     // sum(if(isnull(bayar),0,bayar) for all)
                //     pembayaran += (isNaN(billJson[key].pembayaran) ? 0 : billJson[key].pembayaran)

                //     // sum(if(isnull(retur),0,retur) for all)
                //     retur += (isNaN(billJson[key].retur) ? 0 : billJson[key].retur)

                //     // total_tagihan  - (total_subsidi + total_potongan) + bulat - total_lunas +total_retur_bayar 

                //     var keterangan = '';

                //     // if(isnull(keterangan),'',if((tarif = '0005002' or tarif='0004002'), invoice_id +' ' +module_id+'~r~n '+ 'No. : ' + account_id,keterangan)) +  if(isnull(nama_dokter),'',nama_dokter) 
                //     if (billJson[key].keterangan == null) {
                //         keternagan = ''
                //     } else {
                //         if (billJson[key].tarif_id == '0005002' || billJson[key].tarif_id ==
                //             '0004002') {
                //             keterangan = billJson[key].invoice_id + ' ' + billJson[key].module_id +
                //                 '~r~n ' + 'No. : ' + billJson[key].account_id;
                //         } else {
                //             keterangan = billJson[key].keterangan;
                //         }
                //     }
                //     if (billJson[key].doctor != null) {
                //         keterangan += billJson[key].doctor;
                //     }

                //     // if(lunas='1','VALID-LOCK!',if(lunas ='2','CLOSE!',if(lunas = '5','Close Billing!','OPEN!')))
                //     var lunas = '';
                //     if (billJson[key].islunas == '1') {
                //         lunas = 'VALID-LOCK!';
                //     } else if (billJson[key].islunas == '2') {
                //         lunas = 'CLOSE!';
                //     } else if (billJson[key].islunas == '5') {
                //         lunas = 'Close Billing!';
                //     } else {
                //         lunas = 'OPEN!';
                //     }

                //     // var i = $('#chargesBody tr').length + 1;
                //     // var counter = 'charge' + i
                //     // addRowBill("chargesBody", "a", key, i, counter)

                //     if (billJson[key].clinic_id == 'P016') {
                //         var i = $('#radChargesBody tr.number').length + 1;
                //         var counter = 'rad' + i
                //         $("#notaNoRad").append(new Option(billJson[key].nota_no, billJson[key].nota_no))
                //         addRowBill("radChargesBody", "arad", key, i, counter)
                //     } else if (billJson[key].clinic_id == 'P015') {
                //         var i = $('#fisioChargesBody tr').length + 1;
                //         var counter = 'fisio' + i
                //         $("#notaNofisio").append(new Option(billJson[key].nota_no, billJson[key]
                //             .nota_no))
                //         addRowBill("fisioChargesBody", "afisio", key, i, counter)
                //     } else if (billJson[key].clinic_id == 'P013') { // update far 14/12 14:6
                //         var i = $('#labChargesBody tr.number').length + 1;
                //         var counter = 'lab' + i
                //         $("#notaNoLab").append(new Option(billJson[key].nota_no, billJson[key].nota_no))
                //         addRowBill("labChargesBody", "alab", key, i, counter)
                //     } else if (billJson[key].clinic_id == 'P023') {
                //         var i = $('#patologiChargesBody tr').length + 1;
                //         var counter = 'patologimedis' + i
                //         $("#notaNoPatologi").append(new Option(billJson[key].nota_no, billJson[key]
                //             .nota_no))
                //         addRowBill("patologiChargesBody", "apatologi", key, i, counter)
                //     } else if ((String)(billJson[key].treatment).toLowerCase().includes("ekg") ||
                //         (String)(billJson[key].treatment).toLowerCase().includes("ecg") ||
                //         (String)(billJson[key].treatment).toLowerCase().includes("ctg") ||
                //         (String)(billJson[key].treatment).toLowerCase().includes("usg")) {
                //         const exists = $('#notaNoPenunjangMedis option').filter(function() {
                //             return $(this).val() === billJson[key].nota_no;
                //         }).length > 0;
                //         if (!exists) {
                //             $("#notaNoPenunjangMedis").append(new Option(billJson[key].nota_no,
                //                 billJson[key].nota_no));
                //         }
                //         var i = $('#penunjangChargesBody tr').length + 1;
                //         var counter = 'penunjangmedis' + i;
                //         addRowBill("penunjangChargesBody", "apenunjangmedis", key, i, counter);
                //     } else {
                //         var i = $('#billPoliChargesBody tr').length + 1;
                //         var counter = 'billpoli' + i
                //         $("#notaNoPoli").append(new Option(billJson[key].nota_no, billJson[key]
                //             .nota_no))
                //         addRowBill("billPoliChargesBody", "abillpoli", key, i, counter)
                //     }
                //     var i = $('#chargesBody .bill').length + 1;
                //     var counter = 'charge' + i
                //     $("#notaNoCharge").append(new Option(billJson[key].nota_no, billJson[key].nota_no))
                //     addRowBill("chargesBody", "a", key, i, counter)
                // });


                // total += (isNaN(tagihan) ? 0 : tagihan) -
                //     (isNaN(subsidi) ? 0 : subsidi) -
                //     (isNaN(potongan) ? 0 : potongan) +
                //     (isNaN(pembulatan) ? 0 : pembulatan) -
                //     (isNaN(pembayaran) ? 0 : pembayaran) +
                //     (isNaN(retur) ? 0 : retur);
                // labtotal += labtagihan - (labsubsidi + labpotongan) + labpembulatan - labpembayaran + labretur;
                // radtotal += radtagihan - (radsubsidi + radpotongan) + radpembulatan - radpembayaran + radretur;
                // billpolitotal += billpolitagihan - (billpolisubsidi + billpolipotongan) + billpolipembulatan -
                //     billpolipembayaran + billpoliretur;
                // $("#tagihan_total").val(formatCurrency(tagihan));
                // $("#subsidi_total").val(formatCurrency(subsidi));
                // $("#potongan_total").val(formatCurrency(potongan));
                // $("#pembulatan_total").val(formatCurrency(pembulatan));
                // $("#pelunasan_total").val(formatCurrency(pembayaran));
                // $("#retur_total").val(formatCurrency(retur));
                // $("#totalnya").val(formatCurrency(total));

                // $("#labtagihan_total").val(formatCurrency(labtagihan));
                // $("#labsubsidi_total").val(formatCurrency(labsubsidi));
                // $("#labpotongan_total").val(formatCurrency(labpotongan));
                // $("#labpembulatan_total").val(formatCurrency(labpembulatan));
                // $("#labpelunasan_total").val(formatCurrency(labpembayaran));
                // $("#labretur_total").val(formatCurrency(labretur));
                // $("#labtotalnya").val(formatCurrency(labtotal));

                // $("#radtagihan_total").val(formatCurrency(radtagihan));
                // $("#radsubsidi_total").val(formatCurrency(radsubsidi));
                // $("#radpotongan_total").val(formatCurrency(radpotongan));
                // $("#radpembulatan_total").val(formatCurrency(radpembulatan));
                // $("#radpelunasan_total").val(formatCurrency(radpembayaran));
                // $("#radretur_total").val(formatCurrency(radretur));
                // $("#radtotalnya").val(formatCurrency(radtotal));

                // $("#billpolitagihan_total").val(formatCurrency(billpolitagihan));
                // $("#billpolisubsidi_total").val(formatCurrency(billpolisubsidi));
                // $("#billpolipotongan_total").val(formatCurrency(billpolipotongan));
                // $("#billpolipembulatan_total").val(formatCurrency(billpolipembulatan));
                // $("#billpolipelunasan_total").val(formatCurrency(billpolipembayaran));
                // $("#billpoliretur_total").val(formatCurrency(billpoliretur));
                // $("#billpolitotalnya").val(formatCurrency(billpolitotal));


                // $("#penunjangmedistagihan_total").val(formatCurrency(penunjangmedistagihan)); //new 07/10/2024
                // $("#penunjangmedissubsidi_total").val(formatCurrency(penunjangmedissubsidi)); //new 07/10/2024
                // $("#penunjangmedispotongan_total").val(formatCurrency(penunjangmedispotongan)); //new 07/10/2024
                // $("#penunjangmedispembulatan_total").val(formatCurrency(
                //     penunjangmedispembulatan)); //new 07/10/2024
                // $("#penunjangmedispelunasan_total").val(formatCurrency(
                //     penunjangmedispembayaran)); //new 07/10/2024
                // $("#penunjangmedisretur_total").val(formatCurrency(penunjangmedisretur)); //new 07/10/2024
                // $("#penunjangmedistotalnya").val(formatCurrency(penunjangmedistotal)); //new 


                // $("#patologitagihan_total").val(formatCurrency(patologitagihan)); //new 10/10/2024
                // $("#patologisubsidi_total").val(formatCurrency(patologisubsidi)); //new 10/10/2024
                // $("#patologipotongan_total").val(formatCurrency(patologipotongan)); //new 10/10/2024
                // $("#patologipembulatan_total").val(formatCurrency(patologipembulatan)); //new 10/10/2024
                // $("#patologipelunasan_total").val(formatCurrency(patologipembayaran)); //new 10/10/2024
                // $("#patologiretur_total").val(formatCurrency(patologiretur)); //new 10/10/2024
                // $("#patologitotalnya").val(formatCurrency(patologitotal)); //new 10/10/202407/10/2024

                // if (klinik == 'P013') {
                //     var seen = {};
                //     $('#notaNoLab option').each(function() {
                //         if (seen[$(this).val()]) {
                //             $(this).remove();
                //         } else {
                //             seen[$(this).val()] = true;
                //         }
                //     });
                // } else if (klinik == 'P016') {
                //     var seen = {};
                //     $('#notaNoRad option').each(function() {
                //         if (seen[$(this).val()]) {
                //             $(this).remove();
                //         } else {
                //             seen[$(this).val()] = true;
                //         }
                //     });
                // } else if (klinik == '<?= $visit['clinic_id']; ?>') {
                //     var seen = {};
                //     $('#notaNoRad option').each(function() {
                //         if (seen[$(this).val()]) {
                //             $(this).remove();
                //         } else {
                //             seen[$(this).val()] = true;
                //         }
                //     });
                // }
                // var seen = {};
                // $('#notaNoCharge option').each(function() {
                //     if (seen[$(this).val()]) {
                //         $(this).remove();
                //     } else {
                //         seen[$(this).val()] = true;
                //     }
                // });
                // if (!(visit?.locked === '0' || visit?.locked === null))
                //     $(".spppoli-to-hide").remove()
            },
            error: function() {

            }
        });
    }


    const rendergetBillPoliRequest = () => {

        total = 0;
        tagihan = 0;
        subsidi = 0;
        potongan = 0;
        pembulatan = 0;
        pembayaran = 0;
        retur = 0;

        billpolitotal = 0;
        billpolitagihan = 0;
        billpolisubsidi = 0;
        billpolipotongan = 0;
        billpolipembulatan = 0;
        billpolipembayaran = 0;
        billpoliretur = 0;

        labtotal = 0;
        labtagihan = 0;
        labsubsidi = 0;
        labpotongan = 0;
        labpembulatan = 0;
        labpembayaran = 0;
        labretur = 0;

        radtotal = 0;
        radtagihan = 0;
        radsubsidi = 0;
        radpotongan = 0;
        radpembulatan = 0;
        radpembayaran = 0;
        radretur = 0;

        penunjangmedistotal = 0; //new 07/10/2024
        penunjangmedistagihan = 0; //new 07/10/2024
        penunjangmedissubsidi = 0; //new 07/10/2024
        penunjangmedispotongan = 0; //new 07/10/2024
        penunjangmedispembulatan = 0; //new 07/10/2024
        penunjangmedispembayaran = 0; //new 07/10/2024
        penunjangmedisretur = 0; //new 07/10/2024

        patologitotal = 0; //new 10/10/2024
        patologitagihan = 0; //new 10/10/2024
        patologisubsidi = 0; //new 10/10/2024
        patologipotongan = 0; //new 10/10/2024
        patologipembulatan = 0; //new 10/10/2024
        patologipembayaran = 0; //new 10/10/2024
        patologiretur = 0; //new 10/10/2024
        $("#chargesBody").html("")
        $("#labChargesBody").html("")
        $("#radChargesBody").html("")
        $("#fisioChargesBody").html("")
        $("#billPoliChargesBody").html("")
        $("#penunjangChargesBody").html("") //new 07/10/2024
        $("#patologiChargesBody").html("") //new 10/10/2024

        billJson = reorderBillJson(billJson);
        billJson.forEach((element, key) => {
            if ($("#casemix" + billJson[key].casemix_id).length == 0) {
                $("#chargesBody").append(
                    `<tr id="casemix${billJson[key].casemix_id}" class="table-light">
                                <td colspan="4"><h3>${casemixArray[parseInt(billJson[key].casemix_id) - 1]}</h3></td>
                                <td colspan="4"><h4 id="displaytotal_casemix${billJson[key].casemix_id}">0.0</h4></td>
                                <input type="hidden" id="total_casemix${billJson[key].casemix_id}" value="0.0">
                            </tr>`
                )
            }

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

            countCasemix(billJson[key].casemix_id, parseFloat(billJson[key].tagihan))

            //  sum(if(isnull(subsidi),0,subsidi) for all)
            subsidi += (isNaN(billJson[key].subsidi) ? 0 : billJson[key].subsidi)

            //  sum(if(isnull(potongan),0,potongan) for all)
            potongan += (isNaN(billJson[key].potongan) ? 0 : billJson[key].potongan)

            // sum(pembulatannya for all)
            pembulatan += (isNaN(billJson[key].pembulatan) ? 0 : billJson[key].pembulatan)

            // sum(if(isnull(bayar),0,bayar) for all)
            pembayaran += (isNaN(billJson[key].pembayaran) ? 0 : billJson[key].pembayaran)

            // sum(if(isnull(retur),0,retur) for all)
            retur += (isNaN(billJson[key].retur) ? 0 : billJson[key].retur)

            // total_tagihan  - (total_subsidi + total_potongan) + bulat - total_lunas +total_retur_bayar 

            var keterangan = '';

            // if(isnull(keterangan),'',if((tarif = '0005002' or tarif='0004002'), invoice_id +' ' +module_id+'~r~n '+ 'No. : ' + account_id,keterangan)) +  if(isnull(nama_dokter),'',nama_dokter) 
            if (billJson[key].keterangan == null) {
                keternagan = ''
            } else {
                if (billJson[key].tarif_id == '0005002' || billJson[key].tarif_id ==
                    '0004002') {
                    keterangan = billJson[key].invoice_id + ' ' + billJson[key].module_id +
                        '~r~n ' + 'No. : ' + billJson[key].account_id;
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

            // var i = $('#chargesBody tr').length + 1;
            // var counter = 'charge' + i
            // addRowBill("chargesBody", "a", key, i, counter)

            if (billJson[key].clinic_id == 'P016') {
                var i = $('#radChargesBody tr.number').length + 1;
                var counter = 'rad' + i
                $("#notaNoRad").append(new Option(billJson[key].nota_no, billJson[key].nota_no))
                addRowBill("radChargesBody", "arad", key, i, counter)
            } else if (billJson[key].clinic_id == 'P015') {
                var i = $('#fisioChargesBody tr').length + 1;
                var counter = 'fisio' + i
                $("#notaNofisio").append(new Option(billJson[key].nota_no, billJson[key]
                    .nota_no))
                addRowBill("fisioChargesBody", "afisio", key, i, counter)
            } else if (billJson[key].clinic_id == 'P013') { // update far 14/12 14:6
                var i = $('#labChargesBody tr.number').length + 1;
                var counter = 'lab' + i
                $("#notaNoLab").append(new Option(billJson[key].nota_no, billJson[key].nota_no))
                addRowBill("labChargesBody", "alab", key, i, counter)
            } else if (billJson[key].clinic_id == 'P023') {
                var i = $('#patologiChargesBody tr').length + 1;
                var counter = 'patologimedis' + i
                $("#notaNoPatologi").append(new Option(billJson[key].nota_no, billJson[key]
                    .nota_no))
                addRowBill("patologiChargesBody", "apatologi", key, i, counter)
            } else if ((String)(billJson[key].treatment).toLowerCase().includes("ekg") ||
                (String)(billJson[key].treatment).toLowerCase().includes("ecg") ||
                (String)(billJson[key].treatment).toLowerCase().includes("ctg") ||
                (String)(billJson[key].treatment).toLowerCase().includes("usg")) {
                const exists = $('#notaNoPenunjangMedis option').filter(function() {
                    return $(this).val() === billJson[key].nota_no;
                }).length > 0;
                if (!exists) {
                    $("#notaNoPenunjangMedis").append(new Option(billJson[key].nota_no,
                        billJson[key].nota_no));
                }
                var i = $('#penunjangChargesBody tr').length + 1;
                var counter = 'penunjangmedis' + i;
                addRowBill("penunjangChargesBody", "apenunjangmedis", key, i, counter);
            } else {
                if (billJson[key].brand_id == '' || billJson[key].brand_id == null) {
                    var i = $('#billPoliChargesBody tr').length + 1;
                    var counter = 'billpoli' + i
                    $("#notaNoPoli").append(new Option(billJson[key].nota_no, billJson[key]
                        .nota_no))
                    addRowBill("billPoliChargesBody", "abillpoli", key, i, counter)
                }
            }
            var i = $('#chargesBody .bill').length + 1;
            var counter = 'charge' + i
            $("#notaNoCharge").append(new Option(billJson[key].nota_no, billJson[key].nota_no))
            addRowBill("chargesBody", "a", key, i, counter)
        });


        total += (isNaN(tagihan) ? 0 : tagihan) -
            (isNaN(subsidi) ? 0 : subsidi) -
            (isNaN(potongan) ? 0 : potongan) +
            (isNaN(pembulatan) ? 0 : pembulatan) -
            (isNaN(pembayaran) ? 0 : pembayaran) +
            (isNaN(retur) ? 0 : retur);
        labtotal += labtagihan - (labsubsidi + labpotongan) + labpembulatan - labpembayaran + labretur;
        radtotal += radtagihan - (radsubsidi + radpotongan) + radpembulatan - radpembayaran + radretur;
        billpolitotal += billpolitagihan - (billpolisubsidi + billpolipotongan) + billpolipembulatan -
            billpolipembayaran + billpoliretur;
        $("#tagihan_total").val(formatCurrency(tagihan));
        $("#subsidi_total").val(formatCurrency(subsidi));
        $("#potongan_total").val(formatCurrency(potongan));
        $("#pembulatan_total").val(formatCurrency(pembulatan));
        $("#pelunasan_total").val(formatCurrency(pembayaran));
        $("#retur_total").val(formatCurrency(retur));
        $("#totalnya").val(formatCurrency(total));

        $("#labtagihan_total").val(formatCurrency(labtagihan));
        $("#labsubsidi_total").val(formatCurrency(labsubsidi));
        $("#labpotongan_total").val(formatCurrency(labpotongan));
        $("#labpembulatan_total").val(formatCurrency(labpembulatan));
        $("#labpelunasan_total").val(formatCurrency(labpembayaran));
        $("#labretur_total").val(formatCurrency(labretur));
        $("#labtotalnya").val(formatCurrency(labtotal));

        $("#radtagihan_total").val(formatCurrency(radtagihan));
        $("#radsubsidi_total").val(formatCurrency(radsubsidi));
        $("#radpotongan_total").val(formatCurrency(radpotongan));
        $("#radpembulatan_total").val(formatCurrency(radpembulatan));
        $("#radpelunasan_total").val(formatCurrency(radpembayaran));
        $("#radretur_total").val(formatCurrency(radretur));
        $("#radtotalnya").val(formatCurrency(radtotal));

        $("#billpolitagihan_total").val(formatCurrency(billpolitagihan));
        $("#billpolisubsidi_total").val(formatCurrency(billpolisubsidi));
        $("#billpolipotongan_total").val(formatCurrency(billpolipotongan));
        $("#billpolipembulatan_total").val(formatCurrency(billpolipembulatan));
        $("#billpolipelunasan_total").val(formatCurrency(billpolipembayaran));
        $("#billpoliretur_total").val(formatCurrency(billpoliretur));
        $("#billpolitotalnya").val(formatCurrency(billpolitotal));


        $("#penunjangmedistagihan_total").val(formatCurrency(penunjangmedistagihan)); //new 07/10/2024
        $("#penunjangmedissubsidi_total").val(formatCurrency(penunjangmedissubsidi)); //new 07/10/2024
        $("#penunjangmedispotongan_total").val(formatCurrency(penunjangmedispotongan)); //new 07/10/2024
        $("#penunjangmedispembulatan_total").val(formatCurrency(
            penunjangmedispembulatan)); //new 07/10/2024
        $("#penunjangmedispelunasan_total").val(formatCurrency(
            penunjangmedispembayaran)); //new 07/10/2024
        $("#penunjangmedisretur_total").val(formatCurrency(penunjangmedisretur)); //new 07/10/2024
        $("#penunjangmedistotalnya").val(formatCurrency(penunjangmedistotal)); //new 


        $("#patologitagihan_total").val(formatCurrency(patologitagihan)); //new 10/10/2024
        $("#patologisubsidi_total").val(formatCurrency(patologisubsidi)); //new 10/10/2024
        $("#patologipotongan_total").val(formatCurrency(patologipotongan)); //new 10/10/2024
        $("#patologipembulatan_total").val(formatCurrency(patologipembulatan)); //new 10/10/2024
        $("#patologipelunasan_total").val(formatCurrency(patologipembayaran)); //new 10/10/2024
        $("#patologiretur_total").val(formatCurrency(patologiretur)); //new 10/10/2024
        $("#patologitotalnya").val(formatCurrency(patologitotal)); //new 10/10/202407/10/2024

        if (klinik == 'P013') {
            var seen = {};
            $('#notaNoLab option').each(function() {
                if (seen[$(this).val()]) {
                    $(this).remove();
                } else {
                    seen[$(this).val()] = true;
                }
            });
        } else if (klinik == 'P016') {
            var seen = {};
            $('#notaNoRad option').each(function() {
                if (seen[$(this).val()]) {
                    $(this).remove();
                } else {
                    seen[$(this).val()] = true;
                }
            });
        } else if (klinik == '<?= $visit['clinic_id']; ?>') {
            var seen = {};
            $('#notaNoRad option').each(function() {
                if (seen[$(this).val()]) {
                    $(this).remove();
                } else {
                    seen[$(this).val()] = true;
                }
            });
        }
        var seen = {};
        $('#notaNoCharge option').each(function() {
            if (seen[$(this).val()]) {
                $(this).remove();
            } else {
                seen[$(this).val()] = true;
            }
        });
        if (!(visit?.locked === '0' || visit?.locked === null))
            $(".spppoli-to-hide").remove()
    }

    function addBillCharge(container) {
        // return false
        tarifDataJson = $("#" + container).val();

        tarifData = JSON.parse(tarifDataJson);

        var i = $('#chargesBody tr').length + 1;
        var key = 'charge' + i
        $("#chargesBody")
            .append($("<td>").html(String(key) + "."))
            .append($("<td>").attr("id", "treatment" + key).html((tarifData.tarif_type == 803 ? tarifData.description :
                tarifData.tarif_name)).append($("<p>").html(
                '<?= @$visit['fullname']; ?>')))
            .append($("<td>").attr("id", "treat_date" + key).html(get_date()).append($("<p>").html(
                '<?= $visit['name_of_clinic']; ?>')))
            // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
            .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($(
                "<p>").html("")))
            .append($("<td>")
                .append('<input type="text" name="quantity[]" id="aquantity' + key +
                    '" placeholder="" value="1" class="form-control" >')
                .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
            )
            .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "displayamount_plafond" + key).html((parseFloat(tarifData.amount))))
            .append($("<td>").attr("id", "displayamount_paid_plafond" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "displaydiscount" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidisat" + key).html(formatCurrency(0)))
            .append($("<td>").attr("id", "asubsidi" + key).html(formatCurrency(0)))
            .append($("<td>").append('<button id="asimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' +
                key +
                '\', \'a\')" class="btn btn-info waves-effect waves-light" data-row-id="1" autocomplete="off">Simpan</button><div id="aeditDeleteCharge' +
                key +
                '" class="btn-group-vertical" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' +
                key + '" type="button" onclick="editBillCharge(\'a\', \'' + key +
                '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' +
                key + '" type="button" onclick="delBill(\'a\', \'' + key +
                '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))


        $("#chargesBody")
            .append('<input name="treatment[]" id="atreatment' + key + '" type="hidden" value="' + tarifData.tarif_name +
                '" class="form-control" />')
            .append('<input name="treat_date[]" id="atreat_date' + key + '" type="hidden" value="' + get_date() +
                '" class="form-control" />')
            .append('<input name="sell_price[]" id="asell_price' + key + '" type="hidden" value="' + tarifData.amount +
                '" class="form-control" />')
            .append('<input name="amount_paid[]" id="aamount_paid' + key + '" type="hidden" value="' + tarifData.amount +
                '" class="form-control" />')
            .append('<input name="discount[]" id="adiscount' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')
            .append('<input name="subsidisat[]" id="asubsidisat' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')
            .append('<input name="subsidi[]" id="asubsidi' + key + '" type="hidden" value="' + 0 +
                '" class="form-control" />')

            .append('<input name="bill_id[]" id="abill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="atrans_id' + key +
                '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="ano_registration' + key +
                '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="atheorder' + key + '" type="hidden" value="' + (billJson.length + 1) +
                '" class="form-control" />')
            .append('<input name="visit_id[]" id="avisit_id' + key +
                '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="aorg_unit_code' + key +
                '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="aclass_id' + key +
                '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key +
                '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="apayor_id' + key +
                '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="akaryawan' + key +
                '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="atheid' + key +
                '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="athename' + key +
                '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="atheaddress' + key +
                '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="astatus_pasien_id' + key +
                '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isrj[]" id="aisrj' + key +
                '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="agender' + key +
                '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="aageyear' + key +
                '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="aagemonth' + key +
                '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="aageday' + key +
                '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="akal_id' + key +
                '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="akaryawan' + key +
                '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="aclass_room_id' + key +
                '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="abed_id' + key +
                '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="aclinic_id' + key +
                '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="aclinic_id_from' + key +
                '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="aexit_date' + key + '" type="hidden" value="' + get_date() +
                '" class="form-control" />')
            .append('<input name="cashier[]" id="acashier' + key +
                '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="amodified_from' + key +
                '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="aislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="ameasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="atarif_id' + key + '" type="hidden" value="' + tarifData.tarif_id +
                '" class="form-control" />')

        if ('<?= $visit['isrj']; ?>' == '0') {
            $("#aclass_room_ID" + key).val('<?= $visit['class_room_id']; ?>');
            $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#chargesBody")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#chargesBody")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_inap']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_inap']; ?>" class="form-control" />')

            <?php
            }
            ?>
        } else {
            <?php
            if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
            ?>
                $("#chargesBody")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id_from']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key +
                        '" type="hidden" value="<?= $visit['fullname_from']; ?>" class="form-control" />')

            <?php
            } else {
            ?>
                $("#chargesBody")
                    .append('<input name="employee_id_from[]" id="aemployee_id_from' + key +
                        '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="adoctor_from' + key +
                        '" type="hidden" value="<?= @$visit['fullname']; ?>" class="form-control" />')

            <?php
            }
            ?>
        }
        $("#chargesBody")
            .append('<input name="employee_id[]" id="aemployee_id' + key +
                '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
            .append('<input name="doctor[]" id="adoctor' + key +
                '" type="hidden" value="<?= @$visit['fullname']; ?>" class="form-control" />')
            .append('<input name="amount[]" id="aamount' + key + '" type="hidden" value="' + tarifData.amount +
                '" class="form-control" />')
            .append('<input name="nota_no[]" id="anota_no' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="profesi[]" id="aprofesi' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tagihan[]" id="atagihan' + key + '" type="hidden" value="' + tarifData.amount * $(
                "#aquantity" + key).val() + '" class="form-control" />')
            .append('<input name="treatment_plafond[]" id="atreatment_plafond' + key + '" type="hidden" value="' + tarifData
                .amount + '" class="form-control" />')
            .append('<input name="tarif_type[]" id="atarif_type' + key + '" type="hidden" value="' + tarifData.tarif_type +
                '" class="form-control" />')

        if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
            var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.isCito);
            if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {
                $("#chargesBody").append('<input name="amount_plafond[]" id="aamount_plafond' + key +
                    '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#chargesBody").append('<input name="amount_paid_plafond[]" id="aamount_paid_plafond' + key +
                    '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                $("#chargesBody").append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key +
                    '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#chargesBody").append('<input name="tarif_id_plafond[]" id="atarif_id_plafond' + key +
                    '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
            } else {
                $("#chargesBody").append('<input name="amount_plafond[]" id="aamount_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#chargesBody").append('<input name="amount_paid_plafond[]" id="aamount_paid_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#chargesBody").append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key +
                    '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#chargesBody").append('<input name="tarif_id_plafond[]" id="atarif_id_plafond' + key +
                    '" type="hidden" value="" class="form-control" />')
            }
        } else {
            $("#chargesBody").append('<input name="amount_plafond[]" id="aamount_plafond' + key +
                '" type="hidden" value="0" class="form-control" />')
            $("#chargesBody").append('<input name="amount_paid_plafond[]" id="aamount_paid_plafond' + key +
                '" type="hidden" value="0" class="form-control" />')
            $("#chargesBody").append('<input name="class_id_plafond[]" id="aclass_id_plafond' + key +
                '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            $("#chargesBody").append('<input name="tarif_id_plafond[]" id="atarif_id_plafond' + key +
                '" type="hidden" value="" class="form-control" />')
        }

        $("#aquantity" + key).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e
                .keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e
                .keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e
                .keyCode && e.preventDefault();
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
                'amount_paid': ($("#" + identifier + "quantity" + key).val() * $("#" + identifier +
                    "sell_price" + key).val()),
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
                'isrj': $("#" + identifier + "isrj" + key).val(),
                'gender': $("#" + identifier + "gender" + key).val(),
                'ageyear': $("#" + identifier + "ageyear" + key).val(),
                'agemonth': $("#" + identifier + "agemonth" + key).val(),
                'ageday': $("#" + identifier + "ageday" + key).val(),
                'kal_id': $("#" + identifier + "kal_id" + key).val(),
                'karyawan': $("#" + identifier + "karyawan" + key).val(),
                'class_room_id': $("#" + identifier + "class_room_id" + key).val(),
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
                'tagihan': ($("#" + identifier + "quantity" + key).val() * $("#" + identifier +
                    "sell_price" + key).val()),
                'treatment_plafond': $("#" + identifier + "treatment_plafond" + key).val(),
                'tarif_type': $("#" + identifier + "tarif_type" + key).val(),
                'body_id': $("#" + identifier + "body_id" + key).val(),
                'diagnosa_desc': $("#" + identifier + "diagnosa_desc" + key).val(), // baru far 14/12 9:53
                'indication_desc': $("#" + identifier + "indication_desc" + key)
                    .val(), // baru far 14/12 9:53
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                successSwal('Data berhasil disimpan')
                $("#" + identifier + "quantity" + key).prop("readonly", true)
                $("#" + identifier + "simpanBillBtn" + key).slideUp()
                $("#" + identifier + "editDeleteCharge" + key).slideDown()
                $("#" + identifier + "employee_id" + key).hide()
                $("#" + identifier + "doctor" + key).show()
                $("#" + identifier + "diagnosa_desc" + key).prop("readonly", true)
                $("#" + identifier + "indication_desc" + key).prop("readonly", true)

                var billInaJson = data

                let resultData = data?.data
                let updatedData = [...billJson, resultData];

                billJson = updatedData


                // billInaJson.forEach((element, key) => {

                //     inacbg = parseFloat(billInaJson[key].cbg_tarif)
                //     $("#inacbg").val(formatCurrency(inacbg));

                // });
            },
            error: function(e) {
                errorSwal(e)
            }
        });
    }


    function editBillCharge(identifier, key) {
        $("#" + identifier + "quantity" + key).prop("readonly", false)
        $("#" + identifier + "simpanBillBtn" + key).slideDown()
        $("#" + identifier + "editDeleteCharge" + key).slideUp()
        $("#" + identifier + "employee_id" + key).show()
        $("#" + identifier + "doctor" + key).hide()
        $("#" + identifier + "diagnosa_desc" + key).prop("readonly", false)
        $("#" + identifier + "indication_desc" + key).prop("readonly", false)
    }

    function changeFullnameDoctor(identifier, key) {
        let fullanme = $("#" + identifier + "employee_id" + key + " option:selected").text()
        $("#" + identifier + "doctor" + key).val(fullanme)
    }

    function addRowBill(container, identifier, key, i, counter) {
        if (identifier === 'arad' || identifier === 'alab') {
            $("#" + container).append(
                $("<tr>", {
                    id: container + identifier + key,
                    class: billJson[key].bill_id + " bill number"
                }).append(
                    $('<input>', {
                        name: 'treatment[]',
                        id: identifier + 'treatment' + counter,
                        type: 'hidden',
                        value: billJson[key].treatment,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'treat_date[]',
                        id: identifier + 'treat_date' + counter,
                        type: 'hidden',
                        value: billJson[key].treat_date,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'sell_price[]',
                        id: identifier + 'sell_price' + counter,
                        type: 'hidden',
                        value: billJson[key].sell_price,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'amount_paid[]',
                        id: identifier + 'amount_paid' + counter,
                        type: 'hidden',
                        value: billJson[key].amount_paid,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'amount_plafond[]',
                        id: identifier + 'amount_plafond' + counter,
                        type: 'hidden',
                        value: billJson[key].amount_plafond,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'amount_paid_plafond[]',
                        id: identifier + 'amount_paid_plafond' + counter,
                        type: 'hidden',
                        value: billJson[key].amount_paid_plafond,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'discount[]',
                        id: identifier + 'discount' + counter,
                        type: 'hidden',
                        value: billJson[key].discount,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'subsidisat[]',
                        id: identifier + 'subsidisat' + counter,
                        type: 'hidden',
                        value: billJson[key].subsidisat,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'subsidi[]',
                        id: identifier + 'subsidi' + counter,
                        type: 'hidden',
                        value: billJson[key].subsidi,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'bill_id[]',
                        id: identifier + 'bill_id' + counter,
                        type: 'hidden',
                        value: billJson[key].bill_id,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'trans_id[]',
                        id: identifier + 'trans_id' + counter,
                        type: 'hidden',
                        value: billJson[key].trans_id,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'no_registration[]',
                        id: identifier + 'no_registration' + counter,
                        type: 'hidden',
                        value: billJson[key].no_registration,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'theorder[]',
                        id: identifier + 'theorder' + counter,
                        type: 'hidden',
                        value: billJson[key].theorder,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'visit_id[]',
                        id: identifier + 'visit_id' + counter,
                        type: 'hidden',
                        value: billJson[key].visit_id,
                        class: 'form-control'
                    })
                ).append(
                    $('<input>', {
                        name: 'org_unit_code[]',
                        id: identifier + 'org_unit_code' + counter,
                        type: 'hidden',
                        value: billJson[key].org_unit_code,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'class_id[]',
                        id: identifier + 'class_id' + counter,
                        type: 'hidden',
                        value: billJson[key].class_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'class_id_plafond[]',
                        id: identifier + 'class_id_plafond' + counter,
                        type: 'hidden',
                        value: billJson[key].class_id_plafond,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'payor_id[]',
                        id: identifier + 'payor_id' + counter,
                        type: 'hidden',
                        value: billJson[key].payor_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'karyawan[]',
                        id: identifier + 'karyawan' + counter,
                        type: 'hidden',
                        value: billJson[key].karyawan,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'theid[]',
                        id: identifier + 'theid' + counter,
                        type: 'hidden',
                        value: billJson[key].theid,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'thename[]',
                        id: identifier + 'thename' + counter,
                        type: 'hidden',
                        value: billJson[key].thename,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'theaddress[]',
                        id: identifier + 'theaddress' + counter,
                        type: 'hidden',
                        value: billJson[key].theaddress,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'status_pasien_id[]',
                        id: identifier + 'status_pasien_id' + counter,
                        type: 'hidden',
                        value: billJson[key].status_pasien_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'isrj[]',
                        id: identifier + 'isrj' + counter,
                        type: 'hidden',
                        value: billJson[key].isrj,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'gender[]',
                        id: identifier + 'gender' + counter,
                        type: 'hidden',
                        value: billJson[key].gender,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'ageyear[]',
                        id: identifier + 'ageyear' + counter,
                        type: 'hidden',
                        value: billJson[key].ageyear,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'agemonth[]',
                        id: identifier + 'agemonth' + counter,
                        type: 'hidden',
                        value: billJson[key].agemonth,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'ageday[]',
                        id: identifier + 'ageday' + counter,
                        type: 'hidden',
                        value: billJson[key].ageday,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'kal_id[]',
                        id: identifier + 'kal_id' + counter,
                        type: 'hidden',
                        value: billJson[key].kal_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'class_room_id[]',
                        id: identifier + 'class_room_id' + counter,
                        type: 'hidden',
                        value: billJson[key].class_room_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'bed_id[]',
                        id: identifier + 'bed_id' + counter,
                        type: 'hidden',
                        value: billJson[key].bed_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'employee_id_from[]',
                        id: identifier + 'employee_id_from' + counter,
                        type: 'hidden',
                        value: billJson[key].employee_id_from,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'doctor_from[]',
                        id: identifier + 'doctor_from' + counter,
                        type: 'hidden',
                        value: billJson[key].doctor_from,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'clinic_id[]',
                        id: identifier + 'clinic_id' + counter,
                        type: 'hidden',
                        value: billJson[key].clinic_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'clinic_id_from[]',
                        id: identifier + 'clinic_id_from' + counter,
                        type: 'hidden',
                        value: billJson[key].clinic_id_from,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'exit_date[]',
                        id: identifier + 'exit_date' + counter,
                        type: 'hidden',
                        value: billJson[key].exit_date,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'cashier[]',
                        id: identifier + 'cashier' + counter,
                        type: 'hidden',
                        value: billJson[key].cashier,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'modified_from[]',
                        id: identifier + 'modified_from' + counter,
                        type: 'hidden',
                        value: billJson[key].modified_from,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'islunas[]',
                        id: identifier + 'islunas' + counter,
                        type: 'hidden',
                        value: billJson[key].islunas,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'measure_id[]',
                        id: identifier + 'measure_id' + counter,
                        type: 'hidden',
                        value: billJson[key].measure_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'tarif_id[]',
                        id: identifier + 'tarif_id' + counter,
                        type: 'hidden',
                        value: billJson[key].tarif_id,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'amount[]',
                        id: identifier + 'amount' + counter,
                        type: 'hidden',
                        value: billJson[key].amount,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'nota_no[]',
                        id: identifier + 'nota_no' + counter,
                        type: 'hidden',
                        value: billJson[key].nota_no,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'profesi[]',
                        id: identifier + 'profesi' + counter,
                        type: 'hidden',
                        value: billJson[key].profesi,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'tagihan[]',
                        id: identifier + 'tagihan' + counter,
                        type: 'hidden',
                        value: billJson[key].tagihan,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'treatment_plafond[]',
                        id: identifier + 'treatment_plafond' + counter,
                        type: 'hidden',
                        value: billJson[key].treatment_plafond,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'tarif_type[]',
                        id: identifier + 'tarif_type' + counter,
                        type: 'hidden',
                        value: billJson[key].tarif_type,
                        class: 'form-control'
                    })
                )
                .append(
                    $('<input>', {
                        name: 'body_id[]',
                        id: identifier + 'body_id' + counter,
                        type: 'hidden',
                        value: billJson[key].tarif_type,
                        class: 'form-control'
                    })
                ).append($(`<td rowspan="2" class="align-middle">`).html(String(i) + "."))
                .append($("<td>").attr("id", identifier + "displaytreatment" + counter).html("<b><i>" + billJson[key]
                        .treatment + "</i></b>")
                    .append($("<p>").html(
                        billJson[key].name_of_clinic + ((identifier === 'alab' && (billJson[key].iscito == 1 ||
                                billJson[key].iscito == "1")) ?
                            ' <br><span class="badge bg-danger">Cito</span>' :
                            '')

                    )))

                .append($("<td>").html('<select id="' + identifier + 'employee_id' + counter +
                    '" class="form-select" name="employee_id[]" style="display: none" onchange="changeFullnameDoctor(\'' +
                    identifier + '\',\'' + counter + '\')" readonly>' +
                    chargesDropdownDoctor(identifier) +
                    `</select>` +
                    '<input id="' + identifier + 'doctor' + counter + '" class="form-control" type="text" value="' +
                    billJson[key].doctor + '" readonly>'
                ))
                .append($("<td>").attr("id", identifier + "displaytreat_date" + counter).html(formatedDatetimeFlat(
                    billJson[
                        key].treat_date)).append(`<input type="hidden" id="${identifier}treat_date${counter}">`))
                .append($("<td>").attr("id", identifier + "displaysell_price" + counter).html(formatCurrency(billJson[
                            key]
                        ?.sell_price == null || isNaN(billJson[key]?.sell_price) ? 0.0 : billJson[key]?.sell_price))
                    .append(
                        $("<p>").html(lunas)))
                .append($("<td>")
                    .append('<input type="text" name="quantity[]" id="' + identifier + 'quantity' + counter +
                        '" placeholder="" value="' + billJson[key]?.quantity +
                        '" class="form-control" readonly data-id="' +
                        identifier + 'quantity' + billJson[key].bill_id + '">')
                    .append($("<p>").html(billJson[key].name_of_status_pasien))
                )
                .append($("<td>").attr("id", identifier + "displayamount_paid" + counter).attr("data-id", identifier +
                    'displayamount_paid' + billJson[key].bill_id).html(formatCurrency(billJson[key].tagihan)))
            )
            $("#" + container).append($(`<tr style='height: 80px;' class='${billJson[key].bill_id}'>`)
                .append(
                    $("<td>").attr("colspan", "2").html(
                        $("<div>").addClass("form-group")
                        .append($("<label>").addClass("form-label fw-bold").text("Diagnosis Klinis"))
                        .append(
                            $("<div>").addClass("input-group")
                            .append(
                                $("<input>", {
                                    id: `${identifier + 'diagnosa_desc' + counter}`,
                                    // id: `alabdiagnosa_desclab${i}`,
                                    class: "form-control fit",
                                    style: "width: 70%;",
                                    placeholder: "Diagnosis Klinis",
                                    name: "diagnosa_desc[]",
                                    value: billJson[key].diagnosa_desc,
                                    readonly: true
                                })
                            )
                        )
                    )
                )
                .append(
                    $("<td>").attr("colspan", "4").html(
                        $("<div>").addClass("form-group")
                        .append($("<label>").addClass("form-label fw-bold").text("Indikasi Medis"))
                        .append(
                            $("<div>").addClass("input-group")
                            .append(
                                $("<input>", {
                                    id: `${identifier + 'indication_desc' + counter}`,
                                    // id: `alabindication_desclab${i}`,
                                    class: "form-control fit",
                                    style: "width: 70%;",
                                    placeholder: "Indikasi Medis",
                                    name: "indication_desc[]",
                                    value: billJson[key].indication_desc,
                                    readonly: true
                                })
                            )
                        )
                    )
                )
            );

        } else {
            $("#" + container).append($("<tr id=\"" + container + identifier + key + "\" class=\"" + billJson[key].bill_id +
                    " bill\">")
                .append('<input name="treatment[]" id="' + identifier + 'treatment' + counter +
                    '" type="hidden" value="' +
                    (billJson[key].treatment) + '" class="form-control" />')
                .append('<input name="treat_date[]" id="' + identifier + 'treat_date' + counter +
                    '" type="hidden" value="' + billJson[key].treat_date + '" class="form-control" />')
                .append('<input name="sell_price[]" id="' + identifier + 'sell_price' + counter +
                    '" type="hidden" value="' + billJson[key].sell_price + '" class="form-control" />')
                .append('<input name="amount_paid[]" id="' + identifier + 'amount_paid' + counter +
                    '" type="hidden" value="' + billJson[key].amount_paid + '" class="form-control" />')
                .append('<input name="amount_plafond[]" id="' + identifier + 'amount_plafond' + counter +
                    '" type="hidden" value="' + billJson[key].amount_plafond + '" class="form-control" />')
                .append('<input name="amount_paid_plafond[]" id="' + identifier + 'amount_paid_plafond' + counter +
                    '" type="hidden" value="' + billJson[key].amount_paid_plafond + '" class="form-control" />')
                .append('<input name="discount[]" id="' + identifier + 'discount' + counter +
                    '" type="hidden" value="' +
                    billJson[key].discount + '" class="form-control" />')
                .append('<input name="subsidisat[]" id="' + identifier + 'subsidisat' + counter +
                    '" type="hidden" value="' + billJson[key].subsidisat + '" class="form-control" />')
                .append('<input name="subsidi[]" id="' + identifier + 'subsidi' + counter + '" type="hidden" value="' +
                    billJson[key].subsidi + '" class="form-control" />')
                .append('<input name="bill_id[]" id="' + identifier + 'bill_id' + counter + '" type="hidden" value="' +
                    billJson[key].bill_id + '" class="form-control" />')
                .append('<input name="trans_id[]" id="' + identifier + 'trans_id' + counter +
                    '" type="hidden" value="' +
                    billJson[key].trans_id + '" class="form-control" />')
                .append('<input name="no_registration[]" id="' + identifier + 'no_registration' + counter +
                    '" type="hidden" value="' + billJson[key].no_registration + '" class="form-control" />')
                .append('<input name="theorder[]" id="' + identifier + 'theorder' + counter +
                    '" type="hidden" value="' +
                    billJson[key].theorder + '" class="form-control" />')
                .append('<input name="visit_id[]" id="' + identifier + 'visit_id' + counter +
                    '" type="hidden" value="' +
                    billJson[key].visit_id + '" class="form-control" />')
                .append('<input name="org_unit_code[]" id="' + identifier + 'org_unit_code' + counter +
                    '" type="hidden" value="' + billJson[key].org_unit_code + '" class="form-control" />')
                .append('<input name="class_id[]" id="' + identifier + 'class_id' + counter +
                    '" type="hidden" value="' +
                    billJson[key].class_id + '" class="form-control" />')
                .append('<input name="class_id_plafond[]" id="' + identifier + 'class_id_plafond' + counter +
                    '" type="hidden" value="' + billJson[key].class_id_plafond + '" class="form-control" />')
                .append('<input name="payor_id[]" id="' + identifier + 'payor_id' + counter +
                    '" type="hidden" value="' +
                    billJson[key].payor_id + '" class="form-control" />')
                .append('<input name="karyawan[]" id="' + identifier + 'karyawan' + counter +
                    '" type="hidden" value="' +
                    billJson[key].karyawan + '" class="form-control" />')
                .append('<input name="theid[]" id="' + identifier + 'theid' + counter + '" type="hidden" value="' +
                    billJson[key].theid + '" class="form-control" />')
                .append('<input name="thename[]" id="' + identifier + 'thename' + counter + '" type="hidden" value="' +
                    billJson[key].thename + '" class="form-control" />')
                .append('<input name="theaddress[]" id="' + identifier + 'theaddress' + counter +
                    '" type="hidden" value="' + billJson[key].theaddress + '" class="form-control" />')
                .append('<input name="status_pasien_id[]" id="' + identifier + 'status_pasien_id' + counter +
                    '" type="hidden" value="' + billJson[key].status_pasien_id + '" class="form-control" />')
                .append('<input name="isrj[]" id="' + identifier + 'isrj' + counter + '" type="hidden" value="' +
                    billJson[
                        key].isrj + '" class="form-control" />')
                .append('<input name="gender[]" id="' + identifier + 'gender' + counter + '" type="hidden" value="' +
                    billJson[key].gender + '" class="form-control" />')
                .append('<input name="ageyear[]" id="' + identifier + 'ageyear' + counter + '" type="hidden" value="' +
                    billJson[key].ageyear + '" class="form-control" />')
                .append('<input name="agemonth[]" id="' + identifier + 'agemonth' + counter +
                    '" type="hidden" value="' +
                    billJson[key].agemonth + '" class="form-control" />')
                .append('<input name="ageday[]" id="' + identifier + 'ageday' + counter + '" type="hidden" value="' +
                    billJson[key].ageday + '" class="form-control" />')
                .append('<input name="kal_id[]" id="' + identifier + 'kal_id' + counter + '" type="hidden" value="' +
                    billJson[key].kal_id + '" class="form-control" />')
                .append('<input name="karyawan[]" id="' + identifier + 'karyawan' + counter +
                    '" type="hidden" value="' +
                    billJson[key].karyawan + '" class="form-control" />')
                .append('<input name="class_room_id[]" id="' + identifier + 'class_room_id' + counter +
                    '" type="hidden" value="' + billJson[key].class_room_id + '" class="form-control" />')
                .append('<input name="bed_id[]" id="' + identifier + 'bed_id' + counter + '" type="hidden" value="' +
                    billJson[key].bed_id + '" class="form-control" />')
                .append('<input name="employee_id_from[]" id="' + identifier + 'employee_id_from' + counter +
                    '" type="hidden" value="' + billJson[key].employee_id_from + '" class="form-control" />')
                // .append('<input name="employee_id[]" id="' + identifier + 'employee_id' + counter + '" type="hidden" value="' + billJson[key].employee_id + '" class="form-control" />')
                .append('<input name="doctor_from[]" id="' + identifier + 'doctor_from' + counter +
                    '" type="hidden" value="' + billJson[key].doctor_from + '" class="form-control" />')
                .append('<input name="clinic_id[]" id="' + identifier + 'clinic_id' + counter +
                    '" type="hidden" value="' +
                    billJson[key].clinic_id + '" class="form-control" />')
                .append('<input name="clinic_id_from[]" id="' + identifier + 'clinic_id_from' + counter +
                    '" type="hidden" value="' + billJson[key].clinic_id_from + '" class="form-control" />')
                .append('<input name="exit_date[]" id="' + identifier + 'exit_date' + counter +
                    '" type="hidden" value="' +
                    billJson[key].exit_date + '" class="form-control" />')
                .append('<input name="cashier[]" id="' + identifier + 'cashier' + counter + '" type="hidden" value="' +
                    billJson[key].cashier + '" class="form-control" />')
                .append('<input name="modified_from[]" id="' + identifier + 'modified_from' + counter +
                    '" type="hidden" value="' + billJson[key].modified_from + '" class="form-control" />')
                .append('<input name="islunas[]" id="' + identifier + 'islunas' + counter + '" type="hidden" value="' +
                    billJson[key].islunas + '" class="form-control" />')
                .append('<input name="measure_id[]" id="' + identifier + 'measure_id' + counter +
                    '" type="hidden" value="' + billJson[key].measure_id + '" class="form-control" />')
                .append('<input name="tarif_id[]" id="' + identifier + 'tarif_id' + counter +
                    '" type="hidden" value="' +
                    billJson[key].tarif_id + '" class="form-control" />')
                .append('<input name="amount[]" id="' + identifier + 'amount' + counter + '" type="hidden" value="' +
                    billJson[key].amount + '" class="form-control" />')
                .append('<input name="nota_no[]" id="' + identifier + 'nota_no' + counter + '" type="hidden" value="' +
                    billJson[key].nota_no + '" class="form-control" />')
                .append('<input name="profesi[]" id="' + identifier + 'profesi' + counter + '" type="hidden" value="' +
                    billJson[key].profesi + '" class="form-control" />')
                .append('<input name="tagihan[]" id="' + identifier + 'tagihan' + counter + '" type="hidden" value="' +
                    billJson[key].tagihan + '" class="form-control" />')
                .append('<input name="treatment_plafond[]" id="' + identifier + 'treatment_plafond' + counter +
                    '" type="hidden" value="' + billJson[key].treatment_plafond + '" class="form-control" />')
                .append('<input name="tarif_type[]" id="' + identifier + 'tarif_type' + counter +
                    '" type="hidden" value="' + billJson[key].tarif_type + '" class="form-control" />')
                .append('<input name="body_id[]" id="' + identifier + 'body_id' + counter + '" type="hidden" value="' +
                    billJson[key].tarif_type + '" class="form-control" />')


                .append($("<td>").html(String(i) + "."))
                .append($("<td>").attr("id", identifier + "displaytreatment" + counter).html(
                        `<b><i>${(billJson[key].tarif_type == '803' ? billJson[key].description : billJson[key].treatment)}</i></b>`
                    )
                    .append($("<p>").html(billJson[key].name_of_clinic)))
                .append($("<td>").html('<select id="' + identifier + 'employee_id' + counter +
                    '" class="form-select" name="employee_id[]" style="display: none" onchange="changeFullnameDoctor(\'' +
                    identifier + '\',\'' + counter + '\')" readonly>' +
                    chargesDropdownDoctor(identifier) +
                    `</select>` +
                    '<input id="' + identifier + 'doctor' + counter + '" class="form-control" type="text" value="' +
                    billJson[key].doctor + '" readonly>'
                ))
                .append($("<td>").attr("id", identifier + "displaytreat_date" + counter).html(formatedDatetimeFlat(
                    billJson[
                        key].treat_date)).append(`<input type="hidden" id="${identifier}treat_date${counter}">`))
                .append($("<td>").attr("id", identifier + "displaysell_price" + counter).html(formatCurrency(billJson[
                            key]
                        ?.sell_price == null || isNaN(billJson[key]?.sell_price) ? 0.0 : billJson[key]?.sell_price))
                    .append(
                        $("<p>").html(lunas)))
                .append($("<td>")
                    .append('<input type="text" name="quantity[]" id="' + identifier + 'quantity' + counter +
                        '" placeholder="" value="' + billJson[key]?.quantity +
                        '" class="form-control" readonly data-id="' +
                        identifier + 'quantity' + billJson[key].bill_id + '">')
                    .append($("<p>").html(billJson[key].name_of_status_pasien))
                )
                .append($("<td>").attr("id", identifier + "displayamount_paid" + counter).attr("data-id", identifier +
                    'displayamount_paid' + billJson[key].bill_id).html(formatCurrency(billJson[key].tagihan)))
            )
        }


        // .append($("<td>").attr("id", identifier + "displayamount_plafond" + counter).html((billJson[key].amount_plafond)))
        // .append($("<td>").attr("id", identifier + "displayamount_paid_plafond" + counter).html(formatCurrency(billJson[key].amount_paid_plafond)))
        // .append($("<td>").attr("id", identifier + "displaydiscount" + counter).html(formatCurrency(billJson[key].discount)))
        // .append($("<td>").attr("id", identifier + "subsidisat" + counter).html(formatCurrency(billJson[key].subsidisat)))
        // .append($("<td>").attr("id", identifier + "subsidi" + counter).html(formatCurrency(billJson[key].subsidi)))
        // .append($("<td>").append('<button id="' + identifier + 'simpanBillBtn' + counter + '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier + '\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off" style="display: none">Simpan</button><div id="' + identifier + 'editDeleteCharge' + counter + '" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + counter + '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + counter + '" type="button" onclick="delBill(\'' + identifier + '\', \'' + counter + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))

        if (billJson[key].islunas == 0 || billJson[key].islunas == null) {
            // if (true)
            if (identifier == 'arad') {
                $("#" + container + identifier + key)
                    .append($("<td rowspan='2' class='align-middle'>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group spppoli-to-hide">' +
                            <?php if (user()->checkPermission("rad", "c")) {
                            ?> '<button id="' + identifier + 'simpanBillBtn' + counter +
                                '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                                '\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            <?php
                            } ?> <?php if (user()->checkPermission("rad", "u")) {
                                    ?> '<button id="' + identifier + 'editDeleteCharge' + counter +
                                '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                                '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button>' +
                            <?php
                                    } ?> '<button id="' + identifier + 'expertise' + counter + '" ' + 'data-bill="' +
                            billJson[key].bill_id + '" ' + 'onclick="actionModalExpertise(\'' + encodeURIComponent(JSON
                                .stringify(billJson[key])) + '\',\'' + identifier + '\', \'' + counter + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalExpertise" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'arad' ? 'style="display: block"' : 'style="display: none"') +
                            '><?php if (user()->checkRoles(["dokterrad"])) {
                                ?>Ekspertise<?php
                                        } else {
                                            ?>Hasil<?php
                                                } ?></button>' + //havin
                            <?php if (user()->checkPermission("rad", "d")) {
                            ?> '<button id="delBillBtn' + counter + '" type="button" onclick="delBill(\'' +
                                identifier + '\', \'' + counter +
                                '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button>' +
                            <?php
                            } ?> '</div>' +
                            '</div>')
                    )
            } else if (identifier == 'alab') { // update far 14/12 13:44


                $("#" + container + identifier + key)
                    .append($("<td rowspan='2' class='align-middle'>")
                        .append('<div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">' +
                            '<button id="' + identifier + 'cito' + counter + '" ' +
                            'data-bill="' + billJson[key].bill_id + '" ' +
                            'onclick="actionCitoPenunjang(\'' + encodeURIComponent(JSON.stringify({
                                visit_id: billJson[key].visit_id,
                                nota_no: billJson[key].nota_no,
                                trans_id: billJson[key].trans_id,
                                no_registration: billJson[key].no_registration,
                                cito: parseInt(billJson[key].iscito) === 1 ? "0" : "1"
                            })) +
                            '\')" ' +
                            'type="button" ' +
                            'class="btn ' + (billJson[key].iscito == 1 || billJson[key].iscito == "1" ?
                                'btn-outline-danger' :
                                'btn-outline-success') + ' waves-effect waves-light w-100 spppoli-to-hide" ' +
                            '>' +
                            (billJson[key].iscito == 1 || billJson[key].iscito == "1" ? 'CITO' : 'Non-CITO') +
                            '</button>' +
                            <?php if (user()->checkPermission("lab", "c")) {
                            ?> '<button id="' + identifier + 'simpanBillBtn' + counter +
                                '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                                '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide w-100" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            <?php
                            } ?> <?php if (user()->checkPermission("lab", "u")) {
                                    ?> '<button id="' + identifier + 'editDeleteCharge' + counter +
                                '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                                '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide w-100" data-row-id="1" autocomplete="off">Edit</button>' +
                            <?php
                                    } ?> '<button id="' + identifier + 'bridge' + counter + '" ' + 'data-bill="' +
                            billJson[key].bill_id +
                            '" ' + 'onclick="actionModalBridge(\'' + encodeURIComponent(JSON.stringify(billJson[key])) +
                            '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalBridge" ' +
                            'class="btn btn-outline-primary waves-effect waves-light w-100" data-row-id="1" autocomplete="off" ' +
                            '>File</button>' +
                            <?php if (user()->checkPermission("lab", "d")) {
                            ?> '<button id="delBillBtn' + container + identifier + key +
                                '" type="button" onclick="delBill(\'' + identifier + '\', \'' + counter +
                                '\')" class="btn btn-danger spppoli-to-hide w-100" data-row-id="1" autocomplete="off">Hapus</button>' +
                            <?php
                            } ?> '</div>' +
                            '</div>')
                    )
            } else if (identifier == 'afisio') {

                $("#" + container + identifier + key)
                    .append($("<td>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            <?php if (user()->checkPermission("fisio", "c")) {
                            ?> '<button id="' + identifier + 'simpanBillBtn' + counter +
                                '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                                '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            <?php
                            } ?> <?php if (user()->checkPermission("fisio", "u")) {
                                    ?> '<button id="' + identifier + 'editDeleteCharge' + counter +
                                '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                                '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button>' +
                            <?php
                                    } ?> <?php if (user()->checkPermission("fisio", "d")) {
                                            ?> '<button id="delBillBtn' + counter +
                                '" type="button" onclick="delBill(\'' + identifier + '\', \'' + counter +
                                '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button>' +
                            <?php
                                            } ?> '</div>' +
                            '</div>')
                    )
            } else if (identifier == 'abillpoli') {
                $("#" + container + identifier + key)
                    .append($("<td>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            <?php if (user()->checkPermission("tindakanmedis", "c")) {
                            ?> '<button id="' + identifier + 'simpanBillBtn' + counter +
                                '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                                '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            <?php
                            } ?> <?php if (user()->checkPermission("tindakanmedis", "u")) {
                                    ?> '<button id="' + identifier + 'editDeleteCharge' + counter +
                                '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                                '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button>' +
                            <?php
                                    } ?> <?php if (user()->checkPermission("tindakanmedis", "d")) {
                                            ?> '<button id="delBillBtn' + counter +
                                '" type="button" onclick="delBill(\'' + identifier + '\', \'' + counter +
                                '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button>' +
                            <?php
                                            } ?> '</div>' +
                            '</div>')
                    )
            } else if (identifier == 'apenunjangmedis') { //new 07/10/2024
                $("#" + container + identifier + key)
                    .append($("<td>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            <?php if (user()->checkPermission("rad", "c")) {
                            ?> '<button id="' + identifier + 'simpanBillBtn' + counter +
                                '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                                '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            <?php
                            } ?> '<button id="' + identifier + 'editDeleteCharge' + counter +
                            '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                            '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button>' +
                            '<button id="' + identifier + 'expertise' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id + '" ' + 'onclick="actionModalPenunjangMedis(\'' + encodeURIComponent(JSON
                                .stringify(
                                    billJson[key])) + '\',\'' + 'apenunjangMedis' + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalPenunjangMedis" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'apenunjangmedis' ? 'style="display: block"' : 'style="display: none"') +
                            '>Hasil</button>' + //havin
                            <?php if (user()->checkPermission("rad", "d")) {
                            ?> '<button id="delBillBtn' + counter + '" type="button" onclick="delBill(\'' +
                                identifier + '\', \'' + counter +
                                '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button>' +
                            <?php
                            } ?> '</div>' +
                            '</div>')
                    )
            } else if (identifier == 'apatologi') { //new 10/10/2024

                $("#" + container + identifier + key)
                    .append($("<td>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            <?php if (user()->checkPermission("rad", "c")) {
                            ?> '<button id="' + identifier + 'simpanBillBtn' + counter +
                                '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                                '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            <?php
                            } ?> '<button id="' + identifier + 'editDeleteCharge' + counter +
                            '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                            '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button>' +
                            '<button id="' + identifier + 'expertise' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id + '" ' + 'onclick="actionModalPatologi(\'' + encodeURIComponent(JSON.stringify(
                                billJson[key])) + '\',\'' + 'apatologi' + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalPatologi" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'apatologi' ? 'style="display: block"' : 'style="display: none"') +
                            '>Hasil</button>' + //havin
                            <?php if (user()->checkPermission("rad", "d")) {
                            ?> '<button id="delBillBtn' + counter + '" type="button" onclick="delBill(\'' +
                                identifier + '\', \'' + counter +
                                '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button>' +
                            <?php
                            } ?> '</div>' +
                            '</div>')
                    )
            } else {
                $("#" + container + identifier + key)
                    .append($("<td>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<button id="' + identifier + 'simpanBillBtn' + counter +
                            '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                            '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            '<button id="' + identifier + 'editDeleteCharge' + counter +
                            '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                            '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button>' +
                            '<button id="' + identifier + 'expertise' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id + '" ' + 'onclick="actionModalExpertise(\'' + encodeURIComponent(JSON.stringify(
                                billJson[key])) + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalExpertise" ' +
                            'class="btn btn-outline-primary waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'arad' ? 'style="display: block"' : 'style="display: none"') +
                            '><?php if (user()->checkRoles(["dokterrad"])) {
                                ?>Ekspertise<?php
                                        } else {
                                            ?>Hasil<?php
                                                } ?></button>' + //havin
                            '<button id="' + identifier + 'bridge' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id +
                            '" ' + 'onclick="actionModalBridge(\'' + encodeURIComponent(JSON.stringify(billJson[key])) +
                            '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalBridge" ' +
                            'class="btn btn-outline-primary waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'alab' ? 'style="display: block"' : 'style="display: none"') +
                            '>Bridge</button>' +
                            '<button id="' + identifier + 'delBillBtn' + counter +
                            '" type="button" onclick="delBill(\'' +
                            identifier + '\', \'' + counter +
                            '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                            '</div>' +
                            '</div>')
                    )
            }
        } else {
            if (identifier == 'arad') {
                $("#" + container + identifier + key)
                    .append($("<td rowspan='2' class='align-middle'>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<button id="' + identifier + 'expertise' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id + '" ' + 'onclick="actionModalExpertise(\'' + encodeURIComponent(JSON.stringify(
                                billJson[key])) + '\',\'' + identifier + '\', \'' + counter + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalExpertise" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off">Hasil</button>' +
                            '</div>' +
                            '</div>')
                    )
            } else if (identifier == 'alab') { // update far 17-02

                $("#" + container + identifier + key)
                    .append(
                        $("<td rowspan='2' class='align-middle w-100'>").append(
                            '<div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">' +
                            '<button id="' + identifier + 'bridge' + counter + '" ' +
                            'data-bill="' + billJson[key].bill_id + '" ' +
                            'onclick="actionModalBridge(\'' + encodeURIComponent(JSON.stringify(billJson[key])) + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalBridge" ' +
                            'class="btn btn-outline-primary waves-effect waves-light w-100" data-row-id="1" autocomplete="off">' +
                            'File' +
                            '</button>' +

                            '<button id="' + identifier + 'hasil' + counter + '" ' +
                            'data-bill="' + billJson[key].bill_id + '" ' +
                            'onclick="actionModalHasil(\'' + encodeURIComponent(JSON.stringify(billJson[key])) + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalTfHasil" ' +
                            'class="btn btn-outline-warning waves-effect waves-light w-100" data-row-id="1" autocomplete="off">' +
                            'Hasil' +
                            '</button>' +

                            '<button id="' + identifier + 'cito' + counter + '" ' +
                            'data-bill="' + billJson[key].bill_id + '" ' +
                            'onclick="actionCitoPenunjang(\'' + encodeURIComponent(JSON.stringify({
                                visit_id: billJson[key].visit_id,
                                nota_no: billJson[key].nota_no,
                                trans_id: billJson[key].trans_id,
                                no_registration: billJson[key].no_registration,
                                cito: parseInt(billJson[key].iscito) === 1 ? "0" : "1"
                            })) +
                            '\')" ' +
                            'type="button" ' +
                            'class="btn ' + (billJson[key].iscito == 1 || billJson[key].iscito == "1" ?
                                'btn-outline-danger' :
                                'btn-outline-success') + ' waves-effect waves-light w-100 spppoli-to-hide" ' +
                            '>' +
                            (billJson[key].iscito == 1 || billJson[key].iscito == "1" ? 'CITO' : 'Non-CITO') +
                            '</button>' +
                            '</div>' +
                            '</div>'
                        )
                    );

            } else {
                $("#" + container + identifier + key)
                    .append($("<td>")
                        .append('<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                            '<button id="' + identifier + 'simpanBillBtn' + counter +
                            '" type="button" onclick="simpanBillCharge(\'' + counter + '\', \'' + identifier +
                            '\')" class="btn btn-info waves-effect waves-light simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off" style="display: none">simpan</button>' +
                            '<button id="' + identifier + 'editDeleteCharge' + counter +
                            '" type="button" onclick="editBillCharge(\'' + identifier + '\', \'' + counter +
                            '\')"class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button>' +
                            '<button id="' + identifier + 'expertise' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id + '" ' + 'onclick="actionModalExpertise(\'' + encodeURIComponent(JSON.stringify(
                                billJson[key])) + '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalExpertise" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'arad' ? 'style="display: block"' : 'style="display: none"') +
                            '><?php if (user()->checkRoles(["dokterrad"])) {
                                ?>Ekspertise<?php
                                        } else {
                                            ?>Hasil<?php
                                                } ?></button>' + //havin
                            '<button id="' + identifier + 'bridge' + counter + '" ' + 'data-bill="' + billJson[key]
                            .bill_id +
                            '" ' + 'onclick="actionModalBridge(\'' + encodeURIComponent(JSON.stringify(billJson[key])) +
                            '\')" ' +
                            'type="button" data-bs-toggle="modal" data-bs-target="#modalBridge" ' +
                            'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                            (identifier === 'alab' ? 'style="display: block"' : 'style="display: none"') +
                            '>Bridge</button>' +
                            '<button id="' + identifier + 'delBillBtn' + counter +
                            '" type="button" onclick="delBill(\'' +
                            identifier + '\', \'' + counter +
                            '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button>' +
                            '</div>' +
                            '</div>')
                    )
            }
        }

        $('#' + identifier + 'employee_id' + counter).val(billJson[key].employee_id)


        $("#" + identifier + "quantity" + counter).keydown(function(e) {
            !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e
                .keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode ||
                46 == e
                .keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 ==
                e
                .keyCode && e.preventDefault();
        });
        $('#' + identifier + 'quantity' + counter).on("input", function() {
            var dInput = this.value;
            // console.log(dInput);
            // console.log("#" + identifier + "displayamount_paid" + counter)
            // console.log("#" + identifier + "amount" + counter)
            $("#" + identifier + "amount_paid" + counter).val(parseFloat($("#" + identifier + "amount" +
                    counter)
                .val()) * dInput)
            $("#" + identifier + "displayamount_paid" + counter).html(parseFloat($("#" + identifier + "amount" +
                counter).val()) * dInput)
            $("#" + identifier + "tagihan" + counter).val(parseFloat($("#" + identifier + "amount" + counter)
                .val()) * dInput)
            $("#" + identifier + "amount_paid_plafond" + counter).val(parseFloat($("#" + identifier +
                "amount_plafond" + counter).val()) * dInput)
            $("#" + identifier + "displayamount_paid_plafond" + counter).html(parseFloat($("#" + identifier +
                "amount_plafond" + counter).val()) * dInput)


            // $("#alabamount_paid" + key).val($("#alabamount" + key).val() * dInput)
            // $("#alabdisplayamount_paid" + key).html(formatCurrency($("#alabamount" + key).val() * dInput))
            // $("#alabtagihan" + key).val($("#alabamount" + key).val() * dInput)
            // $("#alabamount_paid_plafond" + key).val($("#alabamount_plafond" + key).val() * dInput)
            // $("#alabdisplayamount_paid_plafond" + key).html(formatCurrency($("#alabamount_plafond" + key).val() * dInput))
        })
        if (container == 'chargesBody') {
            $('#' + identifier + 'simpanBillBtn' + counter + '').slideUp()
            $('#' + identifier + 'editDeleteCharge' + counter + '').slideUp()
            $('#' + identifier + 'delBillBtn' + counter + '').slideUp()
        }
        if (billJson[key].clinic_id == 'P013') {
            labtagihan += parseFloat(billJson[key].tagihan)
            labsubsidi += billJson[key].subsidi
            labpotongan += billJson[key].potongan
            labpembulatan += billJson[key].pembulatan
            labpembayaran += billJson[key].bayar
            labretur += billJson[key].retur
        }
        if (billJson[key].clinic_id == 'P016') {
            radtagihan += parseFloat(billJson[key].tagihan)
            radsubsidi += billJson[key].subsidi
            radpotongan += billJson[key].potongan
            radpembulatan += billJson[key].pembulatan
            radpembayaran += billJson[key].bayar
            radretur += billJson[key].retur
        }
        if (billJson[key].clinic_id == '<?= $visit['clinic_id']; ?>') {
            billpolitagihan += parseFloat(billJson[key].tagihan)
            billpolisubsidi += billJson[key].subsidi
            billpolipotongan += billJson[key].potongan
            billpolipembulatan += billJson[key].pembulatan
            billpolipembayaran += billJson[key].bayar
            billpoliretur += billJson[key].retur
        }
    }

    function delBill(identifier, counter) {
        const billId = $("#" + identifier + "bill_id" + counter).val();
        const notaId = $("#" + identifier + "nota_no" + counter).val();
        const treatmentName = $("#" + identifier + "treatment" + counter).val();
        console.log(treatmentName)
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ms-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Apa anda yakin?",
            html: `<b>${treatmentName}</b> — Data tagihan ini akan dihapus dan tidak dapat dikembalikan! Harap pastikan data yang Anda hapus sudah benar.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let btn;
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/patient/delBill/' + billId,
                    type: "DELETE",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        btn = $("#delBillBtn" + billId).html();
                        $("#delBillBtn" + billId).html("Loading...");
                    },
                    success: function(data) {
                        $("#delBillBtn" + billId).html(btn);
                        $("#" + identifier + counter).remove();
                        $("." + billId).remove();

                        for (let i = 0; i < billJson.length; i++) {
                            if (billJson[i].bill_id === billId && billJson[i].nota_no === notaId) {
                                billJson.splice(i, 1);
                                break;
                            }
                        }
                        successSwal('Data berhasil Dihapus.');
                        // swalWithBootstrapButtons.fire(
                        //     'Terhapus!',
                        //     'Tagihan berhasil dihapus.',
                        //     'success'
                        // );
                    },
                    error: function() {
                        $("#delBillBtn" + billId).html(btn);
                        swalWithBootstrapButtons.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus.',
                            'error'
                        );
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    'Data tagihan tidak jadi dihapus.',
                    'error'
                );
            }
        });
    }

    function getInacbg(visit_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getInacbg',
            type: "POST",
            data: JSON.stringify({
                'visit': visit_id
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

    const actionCitoPenunjang = (params) => {
        const decoded = decodeURIComponent(params);
        const jsonData = JSON.parse(decoded);

        postData(jsonData, 'admin/labRequest/updateCito', (res) => {
            if (res?.success === true) {
                successSwal("Data Berhasil Di rubah")
                getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota, trans);
            }
        })
    }
</script>