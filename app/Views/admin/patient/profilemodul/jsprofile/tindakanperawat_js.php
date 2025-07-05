<script>
    $(document).ready(function() {
        declareSearchTarifPerawat()
    })
    $("#tindakanPerawatTab").on("click", function() {
        getTindakanPerawat()
    })
    $("#formSaveTindPerawatBtn").on("click", function() {
        // $("#tindakanBodyPerawatKolaborasi").find("button.simpanbill:not([disabled])").trigger("click")
        $("#tindakanBodyPerawatKolaborasi").find("button.simpanbill:visible").trigger("click")
    })
</script>
<script>
    const declareSearchTarifPerawat = () => {
        initializeSearchTarifPerawat("searchTarifKolaboratif", '<?= $visit['clinic_id']; ?>')
        $("#searchTarifKolaboratif").on('select2:select', function(e) {
            $("#searchTarifKolaboratifBtn").click();
            $('html,body').animate({
                    scrollTop: $("#searchTarifKolaboratif").offset().top - 50
                },
                'slow', 'swing');
            $("#searchTarifKolaboratif").click()
            $("#searchTarifKolaboratif").select2('open')
        });
    }

    function addBillChargePerawat(container, type, flag = 1, index, tableId) {
        if (flag == 1) {
            tarifDataJson = $("#" + container).val();
            tarifData = JSON.parse(tarifDataJson);
            if (tarifData.amount === null) {
                tarifData.amount = 0;
            }

            var key = parseInt(billPerawatJson.length)
            billPerawatJson[key] = [];
        } else {
            var billPerawat = billPerawatJson[index]
            var key = index + billPerawat?.bill_id;
            console.log(billPerawat)
        }

        $("#searchTarifKolaboratif").val(null).trigger("change")
        if (flag == 1) {
            if (type == 1) {
                var nota_no = $("#" + tableId + "KolaborasiNota").val();

                if (nota_no == '%') {
                    nota_no = get_bodyid()
                    $("#" + tableId + "KolaborasiNota").append($("<option>").val(nota_no).text(nota_no))
                    $("#" + tableId + "KolaborasiNota").val(nota_no)
                    $("#" + tableId + "Kolaborasi").html("")
                }
            } else if (type == 2) {
                var nota_no = $("#" + tableId + "MandiriNota").val();

                if (nota_no == '%') {
                    nota_no = get_bodyid()
                    $("#" + tableId + "MandiriNota").append($("<option>").val(nota_no).text(nota_no))
                    $("#" + tableId + "MandiriNota").val(nota_no)
                    $("#" + tableId + "Mandiri").html("")
                }
            } else if (type == 3) {
                var nota_no = $("#" + tableId + "ImplementasiNota").val();

                if (nota_no == '%') {
                    nota_no = get_bodyid()
                    $("#" + tableId + "ImplementasiNota").append($("<option>").val(nota_no).text(nota_no))
                    $("#" + tableId + "ImplementasiNota").val(nota_no)
                    $("#" + tableId + "Implementasi").html("")
                }
            }
        } else {
            if (type == 1) {
                var nota_no = $("#" + tableId + "KolaborasiNota").val();

                if (nota_no == '%') {
                    $("#" + tableId + "KolaborasiNota").append(new Option(billPerawat.nota_no, billPerawat.nota_no))
                }
            } else if (type == 2) {
                var nota_no = $("#" + tableId + "MandiriNota").val();

                if (nota_no == '%') {
                    $("#" + tableId + "MandiriNota").append(new Option(billPerawat.nota_no, billPerawat.nota_no))
                }
            } else if (type == 3) {
                var nota_no = $("#" + tableId + "ImplementasiNota").val();

                if (nota_no == '%') {
                    $("#" + tableId + "ImplementasiNota").append(new Option(billPerawat.nota_no, billPerawat.nota_no))
                }
            }
        }




        key += tableId
        if (type == 1) {
            rowKolaborasi = $("#" + tableId + "Kolaborasi .aprwrow").length + 1;
            $("#" + tableId + "Kolaborasi").append($("<tr id=\"perawatTindakan" + key + "\" class=\"aprwrow\">"))
        } else if (type == 2) {
            rowKolaborasi = $("#" + tableId + "Mandiri .aprwrow").length + 1;
            $("#" + tableId + "Mandiri").append($("<tr id=\"perawatTindakan" + key + "\">"))
        } else if (type == 3) {
            rowKolaborasi = $("#" + tableId + "Implementasi .aprwrow").length + 1;
            $("#" + tableId + "Implementasi").append($("<tr id=\"perawatTindakan" + key + "\">"))
        }
        let treatment = '';
        let sell_price = 0.0;
        let amount_paid = 0.0;
        let tarif_id = '';
        if (flag == 1) {
            treatment = tarifData.tarif_name;
            sell_price = tarifData.amount;
            amount_paid = tarifData.amount;
            tarif_id = tarifData.tarif_id;
            if (tarifData.amount == 0) {
                if (type == 1) {
                    $("#perawatTindakan" + key)
                        .append($("<td>>").html(String(rowKolaborasi) + "."))
                } else if (type == 2) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowMandiri) + "."))
                } else if (type == 3) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowImplementasi) + "."))
                }
                $("#perawatTindakan" + key)
                    .append($("<td>").attr("id", "treatment" + key).html(tarifData.tarif_name).append($("<p>").html('<?= user()->getFullname(); ?>')))
                    .append($("<td>")
                        // .append(`<input id="flatatptreat_date${key}" type="text" class="form-control flatpickr-input active" value="${moment().format("DD/MM/YYYY HH:mm")}">`)
                        .append(`<input id="atptreat_date${key}" type="datetime-local" class="form-control flatpickr-input" value="${moment().format("YYYY-MM-DD HH:mm")}">`)
                        .append($("<p>").html('<?= $visit['name_of_clinic']; ?>'))
                    )
                    // .append($("<td>").append(`<input id="flatatptreat_date${key}" type="text" class="form-control flatpickr-input active" value="${moment().format("DD/MM/YYYY HH:mm")}">`)
                    //     .append(`<input id="atptreat_date${key}" type="hidden" class="form-control flatpickr-input d-none" value="${moment().format("YYYY-MM-DD HH:mm")}">`)
                    //     .append($("<p>").html('<?= $visit['name_of_clinic']; ?>'))
                    // )
                    .append($("<td colspan=\"3\">")
                        .append('<textarea name="description[]" id="atpdescription' + key + '" placeholder="" class="form-control" rows="4"></textarea>')
                        .append('<input type="hidden" name="quantity[]" id="atpquantity' + key + '" placeholder="" value="1" class="form-control" >')
                    )
                    // .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
                    // .append($("<td>")
                    //     .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                    // )
                    // .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
                    .append($("<td>").append('<button id="simpanBillPerawatBtn' + key + '" type="button" class="btn btn-info simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteBillPerawat' + key + '" class="btn-group-vertical spppoli-to-hide" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light spppoli-to-hide" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBillPerawat(\'' + key + '\', \'' + key + '\')" class="btn btn-danger spppoli-to-hide" data-row-id="1" autocomplete="off">Hapus</button></div>'))

                // datetimepickerbyidinitial(`flatatptreat_date${key}`)

            } else {
                if (type == 1) {
                    $("#perawatTindakan" + key)
                        .append($("<td rowspan=\"1\">").html(String(rowKolaborasi) + "."))
                } else if (type == 2) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowMandiri) + "."))
                } else if (type == 3) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowImplementasi) + "."))
                }
                $("#perawatTindakan" + key)
                    .append($("<td>").attr("id", "treatment" + key).html(tarifData.tarif_name).append($("<p>").html(tarifData.modified_by)))
                    .append($("<td>")
                        // .append(`<input id="flatatptreat_date${key}" type="text" class="form-control flatpickr-input active" value="${moment().format("DD/MM/YYYY HH:mm")}">`)
                        .append(`<input id="atptreat_date${key}" type="datetime-local" class="form-control flatpickr-input" value="${moment().format("YYYY-MM-DD HH:mm")}">`)
                        .append($("<p>").html('<?= $visit['name_of_clinic']; ?>'))
                    )
                    // .append($("<td>").append(`<input id="flatatptreat_date${key}" type="text" class="form-control flatpickr-input active" value="${moment().format("DD/MM/YYYY HH:mm")}">`)
                    //     .append(`<input id="atptreat_date${key}" type="hidden" class="form-control flatpickr-input d-none" value="${moment().format("YYYY-MM-DD HH:mm")}">`)
                    //     .append($("<p>").html('<?= $visit['name_of_clinic']; ?>'))
                    // )
                    .append($("<td class=\"text-center\">").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
                    .append($("<td>")
                        .append('<input type="text" name="quantity[]" id="atpquantity' + key + '" placeholder="" value="1" class="form-control text-center" >')
                        // .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                    )
                    .append($("<td class=\"text-center\">").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
                    .append($("<td rowspan=\"1\">").append('<button id="simpanBillPerawatBtn' + key + '" type="button" class="btn btn-info simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteBillPerawat' + key + '" class="btn-group-vertical spppoli-to-hide" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBillPerawat(\'' + key + '\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))

                // datetimepickerbyid(`flatatptreat_date${key}`)
                // datetimepickerbyidinitial(`flatatptreat_date${key}`)


                // $("#" + tableId + "Kolaborasi").append($("<tr id=\"perawatTindakan" + key + "desc\" class=\"perawatTindakan" + key + "\">")
                //     .append($("<td colspan=\"5\">")
                //         .append(`<div class="form-group m-2"><label>Keterangan</label>
                //                     <textarea name="description[]" id="atpdescription${key}" placeholder="" value="" class="form-control"></textarea>
                //                 </div>`)
                //         // .append('<textarea type="text" name="description[]" id="atpdescription' + key + '" placeholder="" class="form-control" >')
                //     )
                // )
            }


        } else {
            treatment = billPerawat.treatment;
            sell_price = billPerawat.sell_price;
            amount_paid = billPerawat.amount_paid;
            tarif_id = billPerawat.tarif_id;
            if (billPerawat.amount == 0) {
                if (type == 1) {
                    $("#perawatTindakan" + key)
                        .append($("<td>>").html(String(rowKolaborasi) + "."))
                } else if (type == 2) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowMandiri) + "."))
                } else if (type == 3) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowImplementasi) + "."))
                }
                $("#perawatTindakan" + key)
                    .append($("<td>").attr("id", "treatment" + key).html(billPerawat.treatment).append($("<p>").html(billPerawat.modified_by)))
                    .append($("<td>")
                        // .append(`<input id="flatatptreat_date${key}" type="text" class="form-control flatpickr-input active" value="${moment(billPerawat.treat_date).format("DD/MM/YYYY HH:mm")}">`)
                        .append(`<input id="atptreat_date${key}" type="datetime-local" class="form-control flatpickr-input" value="${moment(billPerawat.treat_date).format("YYYY-MM-DD HH:mm")}">`)
                        .append($("<p>").html('<?= $visit['name_of_clinic']; ?>'))
                    )
                    .append($("<td colspan=\"3\">")
                        .append('<textarea name="description[]" id="atpdescription' + key + '" placeholder="" class="form-control" rows="4"></textarea>')
                        .append('<input type="hidden" name="quantity[]" id="atpquantity' + key + '" placeholder="" value="1" class="form-control  text-center" >')
                    )
                    // .append($("<td>").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(tarifData.amount))).append($("<p>").html("")))
                    // .append($("<td>")
                    //     .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                    // )
                    // .append($("<td>").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(tarifData.amount))))
                    .append($("<td>").append('<button id="simpanBillPerawatBtn' + key + '" type="button" class="btn btn-info simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteBillPerawat' + key + '" class="btn-group-vertical spppoli-to-hide" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBillPerawat(\'' + key + '\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))

                // datetimepickerbyidinitial(`flatatptreat_date${key}`, moment(billPerawat.treat_date).format("DD/MM/YYYY HH:mm"))



            } else {
                if (type == 1) {
                    $("#perawatTindakan" + key)
                        .append($("<td rowspan=\"1\">").html(String(rowKolaborasi) + "."))
                } else if (type == 2) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowMandiri) + "."))
                } else if (type == 3) {
                    $("#perawatTindakan" + key)
                        .append($("<td>").html(String(rowImplementasi) + "."))
                }
                $("#perawatTindakan" + key)
                    .append($("<td>").attr("id", "treatment" + key).html(billPerawat.treatment).append($("<p>").html(billPerawat.modified_by)))
                    .append($("<td>")
                        // .append(`<input id="flatatptreat_date${key}" type="text" class="form-control flatpickr-input active">`)
                        .append(`<input id="atptreat_date${key}" type="datetime-local" class="form-control flatpickr-input" value="${moment().format("YYYY-MM-DD HH:mm")}">`)
                        .append($("<p>").html('<?= $visit['name_of_clinic']; ?>'))
                    )
                    .append($("<td class\"text-center\">").attr("id", "sell_price" + key).html(formatCurrency(parseFloat(billPerawat.amount))).append($("<p>").html("")))
                    .append($("<td>")
                        .append('<input type="text" name="quantity[]" id="atpquantity' + key + '" placeholder="" value="' + parseInt(billPerawat.quantity) + '" class="form-control text-center" >')
                        // .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                    )
                    .append($("<td class=\"text-center\">").attr("id", "displayamount_paid" + key).html(formatCurrency(parseFloat(billPerawat.amount_paid))))
                    .append($("<td>").append('<button id="simpanBillPerawatBtn' + key + '" type="button" class="btn btn-info simpanbill spppoli-to-hide" data-row-id="1" autocomplete="off">Simpan</button><div id="editDeleteBillPerawat' + key + '" class="btn-group-vertical spppoli-to-hide" role="group" aria-label="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'' + key + '\', ' + key + ')" class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBillPerawat(\'' + key + '\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))

                // datetimepickerbyidinitial(`flatatptreat_date${key}`, moment(billPerawat.treat_date).format("DD/MM/YYYY HH:mm"))
            }
        }


        // datetimepickerbyid(`flatatptreat_date${key}`)

        $("#perawatTindakan" + key)
            .append('<input name="treatment[]" id="atptreatment' + key + '" type="hidden" value="' + treatment + '" class="form-control" />')
            .append('<input name="treat_date[]" id="atptreat_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="sell_price[]" id="atpsell_price' + key + '" type="hidden" value="' + sell_price + '" class="form-control" />')
            .append('<input name="amount_paid[]" id="atpamount_paid' + key + '" type="hidden" value="' + amount_paid + '" class="form-control" />')
            .append('<input name="discount[]" id="atpdiscount' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidisat[]" id="atpsubsidisat' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')
            .append('<input name="subsidi[]" id="atpsubsidi' + key + '" type="hidden" value="' + 0 + '" class="form-control" />')

            .append('<input name="bill_id[]" id="atpbill_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="trans_id[]" id="atptrans_id' + key + '" type="hidden" value="<?= $visit['trans_id']; ?>" class="form-control" />')
            .append('<input name="no_registration[]" id="atpno_registration' + key + '" type="hidden" value="<?= $visit['no_registration']; ?>" class="form-control" />')
            .append('<input name="theorder[]" id="atptheorder' + key + '" type="hidden" value="' + (billJson.length + 1) + '" class="form-control" />')
            .append('<input name="visit_id[]" id="atpvisit_id' + key + '" type="hidden" value="<?= $visit['visit_id']; ?>" class="form-control" />')
            .append('<input name="org_unit_code[]" id="atporg_unit_code' + key + '" type="hidden" value="<?= $visit['org_unit_code']; ?>" class="form-control" />')
            .append('<input name="class_id[]" id="atpclass_id' + key + '" type="hidden" value="<?= $visit['class_id']; ?>" class="form-control" />')
            .append('<input name="class_id_plafond[]" id="atpclass_id_plafond' + key + '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
            .append('<input name="payor_id[]" id="atppayor_id' + key + '" type="hidden" value="<?= $visit['payor_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="atpkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="theid[]" id="atptheid' + key + '" type="hidden" value="<?= $visit['pasien_id']; ?>" class="form-control" />')
            .append('<input name="thename[]" id="atpthename' + key + '" type="hidden" value="<?= $visit['diantar_oleh']; ?>" class="form-control" />')
            .append('<input name="theaddress[]" id="atptheaddress' + key + '" type="hidden" value="<?= $visit['visitor_address']; ?>" class="form-control" />')
            .append('<input name="status_pasien_id[]" id="atpstatus_pasien_id' + key + '" type="hidden" value="<?= $visit['status_pasien_id']; ?>" class="form-control" />')
            .append('<input name="isRJ[]" id="atpisRJ' + key + '" type="hidden" value="<?= $visit['isrj']; ?>" class="form-control" />')
            .append('<input name="gender[]" id="atpgender' + key + '" type="hidden" value="<?= $visit['gender']; ?>" class="form-control" />')
            .append('<input name="ageyear[]" id="atpageyear' + key + '" type="hidden" value="<?= $visit['ageyear']; ?>" class="form-control" />')
            .append('<input name="agemonth[]" id="atpagemonth' + key + '" type="hidden" value="<?= $visit['agemonth']; ?>" class="form-control" />')
            .append('<input name="ageday[]" id="atpageday' + key + '" type="hidden" value="<?= $visit['ageday']; ?>" class="form-control" />')
            .append('<input name="kal_id[]" id="atpkal_id' + key + '" type="hidden" value="<?= $visit['kal_id']; ?>" class="form-control" />')
            .append('<input name="karyawan[]" id="atpkaryawan' + key + '" type="hidden" value="<?= $visit['karyawan']; ?>" class="form-control" />')
            .append('<input name="class_room_id[]" id="atpclass_room_id' + key + '" type="hidden" value="<?= $visit['class_room_id']; ?>" class="form-control" />')
            .append('<input name="bed_id[]" id="atpbed_id' + key + '" type="hidden" value="<?= $visit['bed_id']; ?>" class="form-control" />')
            .append('<input name="clinic_id[]" id="atpclinic_id' + key + '" type="hidden" value="P016" class="form-control" />')
            .append('<input name="clinic_id_from[]" id="atpclinic_id_from' + key + '" type="hidden" value="<?= $visit['clinic_id_from']; ?>" class="form-control" />')
            .append('<input name="exit_date[]" id="atpexit_date' + key + '" type="hidden" value="' + get_date() + '" class="form-control" />')
            .append('<input name="cashier[]" id="atpcashier' + key + '" type="hidden" value="<?= user_id(); ?>" class="form-control" />')
            .append('<input name="modified_from[]" id="atpmodified_from' + key + '" type="hidden" value="<?= $visit['clinic_id']; ?>" class="form-control" />')
            .append('<input name="islunas[]" id="atpislunas' + key + '" type="hidden" value="0" class="form-control" />')
            .append('<input name="measure_id[]" id="atpmeasure_id' + key + '" type="hidden" value="" class="form-control" />')
            .append('<input name="tarif_id[]" id="atptarif_id' + key + '" type="hidden" value="' + tarif_id + '" class="form-control" />')




        $("#simpanBillPerawatBtn" + key).on('click', (function(e) {
            // var inputvalue = Array();
            // $("#perawatTindakan" + key).find("input, textarea").each(function() {
            //     inputvalue[this.name] = this.value
            // })
            // var formElemet = document.getElementById("formchargesBodyPerawat");
            // var formData = new FormData(formElemet);
            var inputvalue = {};
            var count = {};

            // Loop through form data entries
            // formData.forEach(function(value1, key1) {
            //     // Check if key contains square brackets
            //     if (key1.indexOf('[]') !== -1) {
            //         var name = key1.substr(0, key1.length - 2);
            //         count[name] = (count[name] || 0) + 1; // Increment count for the key

            //         // If it's the second occurrence of the key, extract its value
            //         if (count[name] === key + 1) {
            //             inputvalue[name] = value1;
            //         }
            //     }
            // });
            inputvalue['org_unit_code'] = $("#atporg_unit_code" + key).val()
            inputvalue['bill_id'] = $("#atpbill_id" + key).val()
            inputvalue['no_registration'] = $("#atpno_registration" + key).val()
            inputvalue['visit_id'] = $("#atpvisit_id" + key).val()
            inputvalue['tarif_id'] = $("#atptarif_id" + key).val()
            inputvalue['class_id'] = $("#atpclass_id" + key).val()
            inputvalue['clinic_id'] = $("#atpclinic_id" + key).val()
            inputvalue['clinic_id_from'] = $("#atpclinic_id_from" + key).val()
            inputvalue['treatment'] = $("#atptreatment" + key).val()
            inputvalue['treat_date'] = $("#atptreat_date" + key).val()
            inputvalue['amount'] = $("#atpamount" + key).val()
            inputvalue['quantity'] = $("#atpquantity" + key).val()
            inputvalue['measure_id'] = $("#atpmeasure_id" + key).val()
            inputvalue['pokok_jual'] = $("#atppokok_jual" + key).val()
            inputvalue['ppn'] = $("#atpppn" + key).val()
            inputvalue['margin'] = $("#atpmargin" + key).val()
            inputvalue['subsidi'] = $("#atpsubsidi" + key).val()
            inputvalue['embalace'] = $("#atpembalace" + key).val()
            inputvalue['profesi'] = $("#atpprofesi" + key).val()
            inputvalue['discount'] = $("#atpdiscount" + key).val()
            inputvalue['pay_method_id'] = $("#atppay_method_id" + key).val()
            inputvalue['payment_date'] = $("#atppayment_date" + key).val()
            inputvalue['islunas'] = $("#atpislunas" + key).val()
            inputvalue['duedate_angsuran'] = $("#atpduedate_angsuran" + key).val()
            inputvalue['description'] = $("#atpdescription" + key).val()
            inputvalue['kuitansi_id'] = $("#atpkuitansi_id" + key).val()
            inputvalue['nota_no'] = $("#atpnota_no" + key).val()
            inputvalue['iscetak'] = $("#atpiscetak" + key).val()
            inputvalue['print_date'] = $("#atpprint_date" + key).val()
            inputvalue['resep_no'] = $("#atpresep_no" + key).val()
            inputvalue['resep_ke'] = $("#atpresep_ke" + key).val()
            inputvalue['dose'] = $("#atpdose" + key).val()
            inputvalue['orig_dose'] = $("#atporig_dose" + key).val()
            inputvalue['dose_presc'] = $("#atpdose_presc" + key).val()
            inputvalue['iter'] = $("#atpiter" + key).val()
            inputvalue['iter_ke'] = $("#atpiter_ke" + key).val()
            inputvalue['sold_status'] = $("#atpsold_status" + key).val()
            inputvalue['racikan'] = $("#atpracikan" + key).val()
            inputvalue['class_room_id'] = $("#atpclass_room_id" + key).val()
            inputvalue['keluar_id'] = $("#atpkeluar_id" + key).val()
            inputvalue['bed_id'] = $("#atpbed_id" + key).val()
            inputvalue['perda_id'] = $("#atpperda_id" + key).val()
            inputvalue['employee_id'] = $("#atpemployee_id" + key).val()
            inputvalue['description2'] = $("#atpdescription2" + key).val()
            inputvalue['modified_by'] = $("#atpmodified_by" + key).val()
            inputvalue['modified_date'] = $("#atpmodified_date" + key).val()
            inputvalue['modified_from'] = $("#atpmodified_from" + key).val()
            inputvalue['brand_id'] = $("#atpbrand_id" + key).val()
            inputvalue['doctor'] = $("#atpdoctor" + key).val()
            inputvalue['jml_bks'] = $("#atpjml_bks" + key).val()
            inputvalue['exit_date'] = $("#atpexit_date" + key).val()
            inputvalue['fa_v'] = $("#atpfa_v" + key).val()
            inputvalue['task_id'] = $("#atptask_id" + key).val()
            inputvalue['employee_id_from'] = $("#atpemployee_id_from" + key).val()
            inputvalue['doctor_from'] = $("#atpdoctor_from" + key).val()
            inputvalue['status_pasien_id'] = $("#atpstatus_pasien_id" + key).val()
            inputvalue['amount_paid'] = $("#atpamount_paid" + key).val()
            inputvalue['thename'] = $("#atpthename" + key).val()
            inputvalue['theaddress'] = $("#atptheaddress" + key).val()
            inputvalue['theid'] = $("#atptheid" + key).val()
            inputvalue['serial_nb'] = $("#atpserial_nb" + key).val()
            inputvalue['treatment_plafond'] = $("#atptreatment_plafond" + key).val()
            inputvalue['amount_plafond'] = $("#atpamount_plafond" + key).val()
            inputvalue['amount_paid_plafond'] = $("#atpamount_paid_plafond" + key).val()
            inputvalue['class_id_plafond'] = $("#atpclass_id_plafond" + key).val()
            inputvalue['payor_id'] = $("#atppayor_id" + key).val()
            inputvalue['pembulatan'] = $("#atppembulatan" + key).val()
            inputvalue['isrj'] = $("#atpisrj" + key).val()
            inputvalue['ageyear'] = $("#atpageyear" + key).val()
            inputvalue['agemonth'] = $("#atpagemonth" + key).val()
            inputvalue['ageday'] = $("#atpageday" + key).val()
            inputvalue['gender'] = $("#atpgender" + key).val()
            inputvalue['kal_id'] = $("#atpkal_id" + key).val()
            inputvalue['correction_id'] = $("#atpcorrection_id" + key).val()
            inputvalue['correction_by'] = $("#atpcorrection_by" + key).val()
            inputvalue['karyawan'] = $("#atpkaryawan" + key).val()
            inputvalue['account_id'] = $("#atpaccount_id" + key).val()
            inputvalue['sell_price'] = $("#atpsell_price" + key).val()
            inputvalue['diskon'] = $("#atpdiskon" + key).val()
            inputvalue['invoice_id'] = $("#atpinvoice_id" + key).val()
            inputvalue['numer'] = $("#atpnumer" + key).val()
            inputvalue['measure_id2'] = $("#atpmeasure_id2" + key).val()
            inputvalue['potongan'] = $("#atppotongan" + key).val()
            inputvalue['bayar'] = $("#atpbayar" + key).val()
            inputvalue['retur'] = $("#atpretur" + key).val()
            inputvalue['tarif_type'] = $("#atptarif_type" + key).val()
            inputvalue['ppnvalue'] = $("#atpppnvalue" + key).val()
            inputvalue['tagihan'] = $("#atptagihan" + key).val()
            inputvalue['koreksi'] = $("#atpkoreksi" + key).val()
            inputvalue['status_obat'] = $("#atpstatus_obat" + key).val()
            inputvalue['subsidisat'] = $("#atpsubsidisat" + key).val()
            inputvalue['printq'] = $("#atpprintq" + key).val()
            inputvalue['printed_by'] = $("#atpprinted_by" + key).val()
            inputvalue['stock_available'] = $("#atpstock_available" + key).val()
            inputvalue['status_tarif'] = $("#atpstatus_tarif" + key).val()
            inputvalue['clinic_type'] = $("#atpclinic_type" + key).val()
            inputvalue['package_id'] = $("#atppackage_id" + key).val()
            inputvalue['module_id'] = $("#atpmodule_id" + key).val()
            inputvalue['profession'] = $("#atpprofession" + key).val()
            inputvalue['theorder'] = $("#atptheorder" + key).val()
            inputvalue['cashier'] = $("#atpcashier" + key).val()
            inputvalue['trans_id'] = $("#atptrans_id" + key).val()
            inputvalue['nosep'] = $("#atpnosep" + key).val()
            inputvalue['pasien_id'] = $("#atppasien_id" + key).val()
            inputvalue['total_tagihan'] = $("#atptotal_tagihan" + key).val()
            inputvalue['tarif_id_plafond'] = $("#atptarif_id_plafond" + key).val()
            inputvalue['treatment_type'] = $("#atptreatment_type" + key).val()


            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/addBillCharge',
                type: "POST",
                data: JSON.stringify(inputvalue),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    $("#simpanBillPerawatBtn" + key).slideUp()
                    $("#editDeleteBillPerawat" + key).slideDown()

                    $("#perawatTindakan" + key).find("input, textarea").prop("disabled", true)
                    $("#atpbill_id" + key).val(data.billId)

                },
                error: function() {

                }
            });
        }))

        $("#editBillBtn" + key).on("click", function(e) {
            $("#perawatTindakan" + key).find("input, textarea").prop("disabled", false)
            $("#simpanBillPerawatBtn" + key).slideDown()
            $("#editDeleteBillPerawat" + key).slideUp()
        })

        $("#perawatTindakan" + key)
            .append('<input id="atporg_unit_code' + key + '" type="hidden" name="org_unit_code[]">')
            .append('<input id="atpbill_id' + key + '" type="hidden" name="bill_id[]">')
            .append('<input id="atpno_registration' + key + '" type="hidden" name="no_registration[]">')
            .append('<input id="atpvisit_id' + key + '" type="hidden" name="visit_id[]">')
            .append('<input id="atptarif_id' + key + '" type="hidden" name="tarif_id[]">')
            .append('<input id="atpclass_id' + key + '" type="hidden" name="class_id[]">')
            .append('<input id="atpclinic_id' + key + '" type="hidden" name="clinic_id[]">')
            .append('<input id="atpclinic_id_from' + key + '" type="hidden" name="clinic_id_from[]">')
            .append('<input id="atptreatment' + key + '" type="hidden" name="treatment[]">')
            .append('<input id="atptreat_date' + key + '" type="hidden" name="treat_date[]">')
            .append('<input id="atpamount' + key + '" type="hidden" name="amount[]">')
            .append('<input id="atpmeasure_id' + key + '" type="hidden" name="measure_id[]">')
            .append('<input id="atppokok_jual' + key + '" type="hidden" name="pokok_jual[]">')
            .append('<input id="atpppn' + key + '" type="hidden" name="ppn[]">')
            .append('<input id="atpmargin' + key + '" type="hidden" name="margin[]">')
            .append('<input id="atpsubsidi' + key + '" type="hidden" name="subsidi[]">')
            .append('<input id="atpprofesi' + key + '" type="hidden" name="profesi[]">')
            .append('<input id="atpdiscount' + key + '" type="hidden" name="discount[]">')
            .append('<input id="atppay_method_id' + key + '" type="hidden" name="pay_method_id[]">')
            .append('<input id="atppayment_date' + key + '" type="hidden" name="payment_date[]">')
            .append('<input id="atpislunas' + key + '" type="hidden" name="islunas[]">')
            .append('<input id="atpduedate_angsuran' + key + '" type="hidden" name="duedate_angsuran[]">')
            .append('<input id="atpkuitansi_id' + key + '" type="hidden" name="kuitansi_id[]">')
            .append('<input id="atpnota_no' + key + '" type="hidden" name="nota_no[]">')
            .append('<input id="atpiscetak' + key + '" type="hidden" name="iscetak[]">')
            .append('<input id="atpclass_room_id' + key + '" type="hidden" name="class_room_id[]">')
            .append('<input id="atpkeluar_id' + key + '" type="hidden" name="keluar_id[]">')
            .append('<input id="atpbed_id' + key + '" type="hidden" name="bed_id[]">')
            .append('<input id="atpperda_id' + key + '" type="hidden" name="perda_id[]">')
            .append('<input id="atpemployee_id' + key + '" type="hidden" name="employee_id[]">')
            .append('<input id="atpdescription2' + key + '" type="hidden" name="description2[]">')
            .append('<input id="atpmodified_by' + key + '" type="hidden" name="modified_by[]">')
            .append('<input id="atpmodified_date' + key + '" type="hidden" name="modified_date[]">')
            .append('<input id="atpmodified_from' + key + '" type="hidden" name="modified_from[]">')
            .append('<input id="atpdoctor' + key + '" type="hidden" name="doctor[]">')
            .append('<input id="atpexit_date' + key + '" type="hidden" name="exit_date[]">')
            .append('<input id="atpfa_v' + key + '" type="hidden" name="fa_v[]">')
            .append('<input id="atptask_id' + key + '" type="hidden" name="task_id[]">')
            .append('<input id="atpemployee_id_from' + key + '" type="hidden" name="employee_id_from[]">')
            .append('<input id="atpdoctor_from' + key + '" type="hidden" name="doctor_from[]">')
            .append('<input id="atpstatus_pasien_id' + key + '" type="hidden" name="status_pasien_id[]">')
            .append('<input id="atpamount_paid' + key + '" type="hidden" name="amount_paid[]">')
            .append('<input id="atpthename' + key + '" type="hidden" name="thename[]">')
            .append('<input id="atptheaddress' + key + '" type="hidden" name="theaddress[]">')
            .append('<input id="atptheid' + key + '" type="hidden" name="theid[]">')
            .append('<input id="atptreatment_plafond' + key + '" type="hidden" name="treatment_plafond[]">')
            .append('<input id="atpamount_plafond' + key + '" type="hidden" name="amount_plafond[]">')
            .append('<input id="atpamount_paid_plafond' + key + '" type="hidden" name="amount_paid_plafond[]">')
            .append('<input id="atpclass_id_plafond' + key + '" type="hidden" name="class_id_plafond[]">')
            .append('<input id="atppayor_id' + key + '" type="hidden" name="payor_id[]">')
            .append('<input id="atppembulatan' + key + '" type="hidden" name="pembulatan[]">')
            .append('<input id="atpisrj' + key + '" type="hidden" name="isrj[]">')
            .append('<input id="atpageyear' + key + '" type="hidden" name="ageyear[]">')
            .append('<input id="atpagemonth' + key + '" type="hidden" name="agemonth[]">')
            .append('<input id="atpageday' + key + '" type="hidden" name="ageday[]">')
            .append('<input id="atpgender' + key + '" type="hidden" name="gender[]">')
            .append('<input id="atpkal_id' + key + '" type="hidden" name="kal_id[]">')
            .append('<input id="atpkaryawan' + key + '" type="hidden" name="karyawan[]">')
            .append('<input id="atpaccount_id' + key + '" type="hidden" name="account_id[]">')
            .append('<input id="atpsell_price' + key + '" type="hidden" name="sell_price[]">')
            .append('<input id="atpdiskon' + key + '" type="hidden" name="diskon[]">')
            .append('<input id="atpinvoice_id' + key + '" type="hidden" name="invoice_id[]">')
            .append('<input id="atppotongan' + key + '" type="hidden" name="potongan[]">')
            .append('<input id="atpbayar' + key + '" type="hidden" name="bayar[]">')
            .append('<input id="atpretur' + key + '" type="hidden" name="retur[]">')
            .append('<input id="atptarif_type' + key + '" type="hidden" name="tarif_type[]">')
            .append('<input id="atpppnvalue' + key + '" type="hidden" name="ppnvalue[]">')
            .append('<input id="atptagihan' + key + '" type="hidden" name="tagihan[]">')
            .append('<input id="atpkoreksi' + key + '" type="hidden" name="koreksi[]">')
            .append('<input id="atpsubsidisat' + key + '" type="hidden" name="subsidisat[]">')
            .append('<input id="atpstatus_tarif' + key + '" type="hidden" name="status_tarif[]">')
            .append('<input id="atpclinic_type' + key + '" type="hidden" name="clinic_type[]">')
            .append('<input id="atpmodule_id' + key + '" type="hidden" name="module_id[]">')
            .append('<input id="atpprofession' + key + '" type="hidden" name="profession[]">')
            .append('<input id="atptheorder' + key + '" type="hidden" name="theorder[]">')
            .append('<input id="atpcashier' + key + '" type="hidden" name="cashier[]">')
            .append('<input id="atptrans_id' + key + '" type="hidden" name="trans_id[]">')
            .append('<input id="atpnosep' + key + '" type="hidden" name="nosep[]">')
            .append('<input id="atppasien_id' + key + '" type="hidden" name="pasien_id[]">')
            .append('<input id="atptotal_tagihan' + key + '" type="hidden" name="total_tagihan[]">')
            .append('<input id="atptarif_id_plafond' + key + '" type="hidden" name="tarif_id_plafond[]">')
            .append('<input id="atptreatment_type' + key + '" type="hidden" name="treatment_type[]">')


        if (flag == 1) {
            $("#atptreatment" + key).val(tarifData.tarif_name)
            $("#atptreat_date" + key).val(get_date())
            $("#atpsell_price" + key).val(tarifData.amount)
            $("#atpamount_paid" + key).val(tarifData.amount)
            $("#atpdiscount" + key).val(0)
            $("#atpsubsidisat" + key).val(0)
            $("#atpsubsidi" + key).val(0)
            $("#atpexit_date" + key).val(get_date())
            $("#atpcashier" + key).val('<?= user_id(); ?>')
            $("#atptarif_id" + key).val(tarifData.tarif_id)
            $("#atptrans_id" + key).val('<?= $visit['trans_id']; ?>')
            $("#atpno_registration" + key).val('<?= $visit['no_registration']; ?>')
            $("#atpvisit_id" + key).val('<?= $visit['visit_id']; ?>')
            $("#atporg_unit_code" + key).val('<?= $visit['org_unit_code']; ?>')
            $("#atpclass_id" + key).val('<?= $visit['class_id']; ?>')
            $("#atpclass_id_plafond" + key).val('<?= $visit['class_id_plafond']; ?>')
            $("#atppayor_id" + key).val('<?= $visit['payor_id']; ?>')
            $("#atpkaryawan" + key).val('<?= $visit['karyawan']; ?>')
            $("#atppasien_id" + key).val('<?= $visit['pasien_id']; ?>')
            $("#atpdiantar_oleh" + key).val('<?= $visit['diantar_oleh']; ?>')
            $("#atpvisitor_address" + key).val('<?= $visit['visitor_address']; ?>')
            $("#atpstatus_pasien_id" + key).val('<?= $visit['status_pasien_id']; ?>')
            $("#atpisrj" + key).val('<?= $visit['isrj']; ?>')
            $("#atpgender" + key).val('<?= $visit['gender']; ?>')
            $("#atpageyear" + key).val('<?= $visit['ageyear']; ?>')
            $("#atpagemonth" + key).val('<?= $visit['agemonth']; ?>')
            $("#atpageday" + key).val('<?= $visit['ageday']; ?>')
            $("#atpkal_id" + key).val('<?= $visit['kal_id']; ?>')
            $("#atpkaryawan" + key).val('<?= $visit['karyawan']; ?>')
            $("#atpclass_room_id" + key).val('<?= $visit['class_room_id']; ?>')
            $("#atpbed_id" + key).val('<?= $visit['bed_id']; ?>')
            $("#atpclinic_id" + key).val('<?= $visit['clinic_id']; ?>')
            $("#atpclinic_id_from" + key).val('<?= $visit['clinic_id_from']; ?>')
            $("#atpclinic_id" + key).val('<?= $visit['clinic_id']; ?>')
            $("#atptreatment_type" + key).val(type)
            if ('<?= $visit['isrj']; ?>' == '0') {
                $("#atpclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
                $("#atpbed_id" + key).val('<?= $visit['bed_id']; ?>');
                <?php
                if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                ?>
                    $("#atpemployee_id_from" + key).val('<?= $visit['employee_id_from']; ?>')
                    $("#atpdoctor_from" + key).val('<?= $visit['fullname_from']; ?>')
                <?php
                } else {
                ?>
                    $("#atpemployee_id_from" + key).val('<?= $visit['employee_inap']; ?>')
                    $("#atpdoctor_from" + key).val('<?= $visit['fullname_inap']; ?>')
                <?php
                }
                ?>
            } else {
                <?php
                if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                ?>
                    $("#atpemployee_id_from" + key).val('<?= $visit['employee_id_from']; ?>')
                    $("#atpdoctor_from" + key).val('<?= $visit['fullname_from']; ?>')
                <?php
                } else {
                ?>
                    $("#atpemployee_id_from" + key).val('<?= $visit['employee_id']; ?>')
                    $("#atpdoctor_from" + key).val('<?= @$visit['fullname']; ?>')
                <?php
                }
                ?>
            }
            $("#atpemployee_id" + key).val('<?= user()->employee_id; ?>')
            $("#atpdoctor" + key).val('<?= user()->getFullname(); ?>')
            $("#atpamount" + key).val(tarifData.amount)
            $("#atpnota_no" + key).val(nota_no)
            $("#atpprofesi" + key).val(null)
            $("#atptagihan" + key).val(tarifData.amount * $("#atpquantity" + key).val())
            $("#atptreatment_plafond" + key).val(tarifData.amount)
            $("#atptarif_type" + key).val(tarifData.tarif_type)
            if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
                var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name, tarifData.iscito);
                if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 && '<?= $visit['class_id_plafond']; ?>' != 99) {

                    $("#atpamount_plafond").val(tarifKelas)
                    $("#atpamount_paid_plafond").val(tarifKelas)
                    $("#atpclass_id_plafond").val('<?= $visit['class_id_plafond']; ?>')
                    $("#atptarif_id_plafond").val(tarifData.tarif_id)
                } else {
                    $("#atpamount_plafond" + key).val(0)
                    $("#atpamount_paid_plafond" + key).val(0)
                    $("#atpclass_id_plafond" + key).val('<?= $visit['class_id_plafond']; ?>')
                    $("#atptarif_id_plafond" + key).val()
                }
            } else {
                $("#atpamount_plafond" + key).val(0)
                $("#atpamount_paid_plafond" + key).val(0)
                $("#atpclass_id_plafond" + key).val('<?= $visit['class_id_plafond']; ?>')
                $("#atptarif_id_plafond" + key).val()
            }

            $("#atpquantity" + key).keydown(function(e) {
                !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
            });
            $('#atpquantity' + key).on("input", function() {
                var dInput = this.value;
                $("#atpamount_paid" + key).val($("#atpamount" + key).val() * dInput)
                $("#displayamount_paid" + key).html(formatCurrency($("#atpamount" + key).val() * dInput))
                $("#atagihan" + key).val($("#atpamount" + key).val() * dInput)
                $("#atpamount_paid_plafond" + key).val($("#atpamount_plafond" + key).val() * dInput)
                $("#displayamount_paid_plafond" + key).html(formatCurrency($("#atpamount_plafond" + key).val() * dInput))
            })
            $("#atpmodified_by" + key).val('<?= user()->username; ?>')
        } else {
            $("#atporg_unit_code" + key).val(billPerawat.org_unit_code)
            $("#atpbill_id" + key).val(billPerawat.bill_id)
            $("#atpno_registration" + key).val(billPerawat.no_registration)
            $("#atpvisit_id" + key).val(billPerawat.visit_id)
            $("#atptarif_id" + key).val(billPerawat.tarif_id)
            $("#atpclass_id" + key).val(billPerawat.class_id)
            $("#atpclinic_id" + key).val(billPerawat.clinic_id)
            $("#atpclinic_id_from" + key).val(billPerawat.clinic_id_from)
            $("#atptreatment" + key).val(billPerawat.treatment)
            $("#atptreat_date" + key).val(billPerawat.treat_date)
            $("#atpamount" + key).val(billPerawat.amount)
            $("#atpquantity" + key).val(billPerawat.quantity)
            $("#atpmeasure_id" + key).val(billPerawat.measure_id)
            $("#atppokok_jual" + key).val(billPerawat.pokok_jual)
            $("#atpppn" + key).val(billPerawat.ppn)
            $("#atpmargin" + key).val(billPerawat.margin)
            $("#atpsubsidi" + key).val(billPerawat.subsidi)
            $("#atpembalace" + key).val(billPerawat.embalace)
            $("#atpprofesi" + key).val(billPerawat.profesi)
            $("#atpdiscount" + key).val(billPerawat.discount)
            $("#atppay_method_id" + key).val(billPerawat.pay_method_id)
            $("#atppayment_date" + key).val(billPerawat.payment_date)
            $("#atpislunas" + key).val(billPerawat.islunas)
            $("#atpduedate_angsuran" + key).val(billPerawat.duedate_angsuran)
            $("#atpdescription" + key).val(billPerawat.description)
            // console.log(billPerawat.description)
            $("#atpkuitansi_id" + key).val(billPerawat.kuitansi_id)
            $("#atpnota_no" + key).val(billPerawat.nota_no)
            $("#atpiscetak" + key).val(billPerawat.iscetak)
            $("#atpprint_date" + key).val(billPerawat.print_date)
            $("#atpresep_no" + key).val(billPerawat.resep_no)
            $("#atpresep_ke" + key).val(billPerawat.resep_ke)
            $("#atpdose" + key).val(billPerawat.dose)
            $("#atporig_dose" + key).val(billPerawat.orig_dose)
            $("#atpdose_presc" + key).val(billPerawat.dose_presc)
            $("#atpiter" + key).val(billPerawat.iter)
            $("#atpiter_ke" + key).val(billPerawat.iter_ke)
            $("#atpsold_status" + key).val(billPerawat.sold_status)
            $("#atpracikan" + key).val(billPerawat.racikan)
            $("#atpclass_room_id" + key).val(billPerawat.class_room_id)
            $("#atpkeluar_id" + key).val(billPerawat.keluar_id)
            $("#atpbed_id" + key).val(billPerawat.bed_id)
            $("#atpperda_id" + key).val(billPerawat.perda_id)
            $("#atpemployee_id" + key).val(billPerawat.employee_id)
            $("#atpdescription2" + key).val(billPerawat.description2)
            $("#atpmodified_by" + key).val(billPerawat.modified_by)
            $("#atpmodified_date" + key).val(billPerawat.modified_date)
            $("#atpmodified_from" + key).val(billPerawat.modified_from)
            $("#atpbrand_id" + key).val(billPerawat.brand_id)
            $("#atpdoctor" + key).val(billPerawat.doctor)
            $("#atpjml_bks" + key).val(billPerawat.jml_bks)
            $("#atpexit_date" + key).val(billPerawat.exit_date)
            $("#atpfa_v" + key).val(billPerawat.fa_v)
            $("#atptask_id" + key).val(billPerawat.task_id)
            $("#atpemployee_id_from" + key).val(billPerawat.employee_id_from)
            $("#atpdoctor_from" + key).val(billPerawat.doctor_from)
            $("#atpstatus_pasien_id" + key).val(billPerawat.status_pasien_id)
            $("#atpamount_paid" + key).val(billPerawat.amount_paid)
            $("#atpthename" + key).val(billPerawat.thename)
            $("#atptheaddress" + key).val(billPerawat.theaddress)
            $("#atptheid" + key).val(billPerawat.theid)
            $("#atpserial_nb" + key).val(billPerawat.serial_nb)
            $("#atptreatment_plafond" + key).val(billPerawat.treatment_plafond)
            $("#atpamount_plafond" + key).val(billPerawat.amount_plafond)
            $("#atpamount_paid_plafond" + key).val(billPerawat.amount_paid_plafond)
            $("#atpclass_id_plafond" + key).val(billPerawat.class_id_plafond)
            $("#atppayor_id" + key).val(billPerawat.payor_id)
            $("#atppembulatan" + key).val(billPerawat.pembulatan)
            $("#atpisrj" + key).val(billPerawat.isrj)
            $("#atpageyear" + key).val(billPerawat.ageyear)
            $("#atpagemonth" + key).val(billPerawat.agemonth)
            $("#atpageday" + key).val(billPerawat.ageday)
            $("#atpgender" + key).val(billPerawat.gender)
            $("#atpkal_id" + key).val(billPerawat.kal_id)
            $("#atpcorrection_id" + key).val(billPerawat.correction_id)
            $("#atpcorrection_by" + key).val(billPerawat.correction_by)
            $("#atpkaryawan" + key).val(billPerawat.karyawan)
            $("#atpaccount_id" + key).val(billPerawat.account_id)
            $("#atpsell_price" + key).val(billPerawat.sell_price)
            $("#atpdiskon" + key).val(billPerawat.diskon)
            $("#atpinvoice_id" + key).val(billPerawat.invoice_id)
            $("#atpnumer" + key).val(billPerawat.numer)
            $("#atpmeasure_id2" + key).val(billPerawat.measure_id2)
            $("#atppotongan" + key).val(billPerawat.potongan)
            $("#atpbayar" + key).val(billPerawat.bayar)
            $("#atpretur" + key).val(billPerawat.retur)
            $("#atptarif_type" + key).val(billPerawat.tarif_type)
            $("#atpppnvalue" + key).val(billPerawat.ppnvalue)
            $("#atptagihan" + key).val(billPerawat.tagihan)
            $("#atpkoreksi" + key).val(billPerawat.koreksi)
            $("#atpstatus_obat" + key).val(billPerawat.status_obat)
            $("#atpsubsidisat" + key).val(billPerawat.subsidisat)
            $("#atpprintq" + key).val(billPerawat.printq)
            $("#atpprinted_by" + key).val(billPerawat.printed_by)
            $("#atpstock_available" + key).val(billPerawat.stock_available)
            $("#atpstatus_tarif" + key).val(billPerawat.status_tarif)
            $("#atpclinic_type" + key).val(billPerawat.clinic_type)
            $("#atppackage_id" + key).val(billPerawat.package_id)
            $("#atpmodule_id" + key).val(billPerawat.module_id)
            $("#atpprofession" + key).val(billPerawat.profession)
            $("#atptheorder" + key).val(billPerawat.theorder)
            $("#atpcashier" + key).val(billPerawat.cashier)
            $("#atptrans_id" + key).val(billPerawat.trans_id)
            $("#atpnosep" + key).val(billPerawat.nosep)
            $("#atppasien_id" + key).val(billPerawat.pasien_id)
            $("#atptotal_tagihan" + key).val(billPerawat.total_tagihan)
            $("#atptarif_id_plafond" + key).val(billPerawat.tarif_id_plafond)
            $("#atptreatment_type" + key).val(billPerawat.treatment_type)

            $("#perawatTindakan" + key).find("input, textarea").prop("disabled", true)
            $("#simpanBillPerawatBtn" + key).slideUp()
            $("#editDeleteBillPerawat" + key).slideDown()
            $("#atpquantity" + key).keydown(function(e) {
                !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e.keyCode || 46 == e.keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(".") && 190 == e.keyCode && e.preventDefault();
            });
            $('#atpquantity' + key).on("input", function() {
                var dInput = this.value;
                $("#atpamount_paid" + key).val($("#atpamount" + key).val() * dInput)
                $("#displayamount_paid" + key).html(formatCurrency($("#atpamount" + key).val() * dInput))
                $("#atagihan" + key).val($("#atpamount" + key).val() * dInput)
                $("#atpamount_paid_plafond" + key).val($("#atpamount_plafond" + key).val() * dInput)
                $("#displayamount_paid_plafond" + key).html(formatCurrency($("#atpamount_plafond" + key).val() * dInput))
            })
        }
        if (type == 1) {
            var seen = {};
            $("#" + tableId + "KolaborasiNota option").each(function() {
                if (seen[$(this).val()]) {
                    $(this).remove();
                } else {
                    seen[$(this).val()] = true;
                }
            });
        } else if (type == 2) {
            var seen = {};
            $("#" + tableId + "MandiriNota option").each(function() {
                if (seen[$(this).val()]) {
                    $(this).remove();
                } else {
                    seen[$(this).val()] = true;
                }
            });
        } else if (type == 3) {
            var seen = {};
            $("#" + tableId + "ImplementasiNota option").each(function() {
                if (seen[$(this).val()]) {
                    $(this).remove();
                } else {
                    seen[$(this).val()] = true;
                }
            });
        }
    }

    function delBillPerawat(identifier, counter) {
        var billId = counter
        // var billId = $("#atpbill_id" + counter).val()
        var btn;
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/delBillPerawat/' + $("#atpbill_id" + counter).val(),
            type: "DELETE",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                btn = $("#delBillBtn" + billId).html()
                $("#delBillBtn" + billId).html("Loading...")
            },
            success: function(data) {
                $("#delBillBtn" + billId).html(btn)
                $("#perawatTindakan" + billId).remove()
            },
            error: function() {
                $("#delBillBtn" + billId).html(btn)
            }
        });
    }
</script>