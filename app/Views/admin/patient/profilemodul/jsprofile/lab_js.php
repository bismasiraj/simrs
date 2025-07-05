<script type='text/javascript'>
$(document).ready(function(e) {

})
let dataTarifSelect

const convertLabDate = (dateString) => {
    const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
    const parsedDate = moment(dateString, formats, true);
    if (parsedDate.isValid()) {
        return parsedDate.format("YYYY-MM-DD");
    } else {
        return null;
    }
};

const convertLabDate2 = (dateString) => {
    const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
    const parsedDate = moment(dateString, formats, true);
    if (parsedDate.isValid()) {
        return parsedDate.format("DD/MM/YYYY");
    } else {
        return null;
    }
};

const dateLab = (props) => {
    const visit = props?.visit

    const StartToday = moment(visit?.visit_date).format("DD/MM/YYYY");
    const today = moment(new Date()).format("DD/MM/YYYY");

    $("#startDateLab").val(StartToday);
    $("#endDateLab").val(today);

    $("#startDateLISHasil").val(StartToday);
    $("#endDateLISHasil").val(today);

    $("#startDateLIS").val(today);
    $("#endDateLIS").val(today);


    $("#startDateLISHasil").on('change', function() {
        const startDate = $(this).val();
        const endDate = $("#endDateLISHasil").val();

        const formattedStartDate = convertLabDate(startDate);
        const formattedEndDate = convertLabDate(endDate);

        if (formattedEndDate && formattedStartDate && formattedEndDate < formattedStartDate) {
            $("#endDateLISHasil").val(moment(formattedStartDate).format("DD/MM/YYYY"));
        }

        $("#endDateLISHasil").attr('min', formattedStartDate);
    });

    $("#endDateLISHasil").on('change', function() {
        const startDate = $("#startDateLISHasil").val();
        const endDate = $(this).val();
        const formattedStartDate = convertLabDate(startDate);
        const formattedEndDate = convertLabDate(endDate);

        if (formattedEndDate && formattedStartDate && formattedEndDate < formattedStartDate) {
            errorSwal("End date cannot be earlier than start date!");
            $(this).val(moment(formattedStartDate).format("DD/MM/YYYY"));
        }
    });


    $("#startDateLab").on('change', function() {
        const startDate = $(this).val();
        const endDate = $("#endDateLab").val();

        const formattedStartDate = convertLabDate(startDate);
        const formattedEndDate = convertLabDate(endDate);

        if (formattedEndDate && moment(formattedEndDate).isBefore(moment(formattedStartDate))) {

            $("#endDateLab").val(moment(formattedStartDate).format("DD/MM/YYYY"));
        }

        $("#endDateLab").attr('min', formattedStartDate);
    });

    $("#endDateLab").on('change', function() {
        const startDate = $("#startDateLab").val();
        const endDate = $(this).val();

        const formattedStartDate = convertLabDate(startDate);
        const formattedEndDate = convertLabDate(endDate);

        if (formattedEndDate && formattedEndDate < formattedStartDate) {
            errorSwal("End date cannot be earlier than start date!");

            $(this).val(moment(formattedStartDate).format("DD/MM/YYYY"));
        }
    });


    $("#btn-search-lab").off().on("click", function() {
        const start = convertLabDate($("#startDateLab").val());
        const end = convertLabDate($("#endDateLab").val());

        if (start && end) {
            getBillPoli(nomor, ke, start, end, lunas, 'P013', rj, status, $("#notaNoLab").val(), trans);
        }

        // setTimeout(() => {
        // getDataTabels();
        // }, 1);

        // $("#notaNoLab").val("%");
    });

    $("#startDateLIS").on('change', function() {
        const startDate = $(this).val();
        const endDate = $("#endDateLIS").val();


        const formattedStartDate = convertLabDate(startDate);
        const formattedEndDate = convertLabDate(endDate);

        if (formattedEndDate && formattedStartDate && formattedEndDate < formattedStartDate) {
            $("#endDateLIS").val(moment(formattedStartDate).format("DD/MM/YYYY"));
        }

        $("#endDateLIS").attr('min', formattedStartDate);
    });

    $("#endDateLIS").on('change', function() {
        const startDate = $("#startDateLIS").val();
        const endDate = $(this).val();


        const formattedStartDate = convertLabDate(startDate);
        const formattedEndDate = convertLabDate(endDate);

        if (formattedEndDate && formattedStartDate && formattedEndDate < formattedStartDate) {
            errorSwal("End date cannot be earlier than start date!");
            $(this).val(moment(formattedStartDate).format("DD/MM/YYYY"));
        }
    });
};

// const btnCetakLabbb = () => {
$("#btn-cetak").off().on("click", function() {
    const nolist = $("#notaNoLab").val();
    const no_pasien = nomor;
    const visit = <?= json_encode($visit); ?>;

    let start_request = convertLabDate($("#startDateLab").val())
    let end_request = convertLabDate($("#endDateLab").val())

    visit.nolist = nolist;
    visit.no_pasien = no_pasien;
    visit.start_request = start_request
    visit.end_request = end_request

    const visitString = JSON.stringify(visit);
    const encodedVisit = btoa(visitString);
    const url = `<?= base_url() . '/admin/rm/lainnya/laboratorium_cetak/' ?>${encodedVisit}`;

    window.open(url, '_blank');
});
// }


$("#labTab").off().on("click", function() {
    $('#notaNoLab').html(`<option value="%">Semua</option>`)
    declareSearchTarifLab()
    initializeSearchTarif("searchTarifLabHasil", 'P013');
    // initializeSearchTarifDinamis()
    initialFlatpicLab()
    $('#startDateBloodRequest').val(moment().format("DD/MM/YYYY"));
    $('#endDateBloodRequest').val(moment().format("DD/MM/YYYY"));
    $("#formSaveBillLabBtn").hide()


    // getListRequestLab(nomor, visit)

    getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota, trans);
    // getDataTabels()

    dateLab({
        visit: visit
    })

    getDataBillLIS({
        noRegis: nomor,
        trans_id: trans
    })

    getDataLatterSend({
        visit_id: visit?.visit_id,
        visit: visit
    })

    getDataBlood({
        visit_id: visit.visit_id,
        start_date: convertLabDate2(mulai),
        end_date: convertLabDate2(akhir),
    });

    // setTimeout(() => {
    //     let notaDataDel = $("#notaNoLab option").map(function() {
    //         return $(this).val();
    //     }).get();
    //     // delDataPenunjang({
    //     //     data: notaDataDel,
    //     //     visit: visit
    //     // })
    // }, 2000);

    $('#coverkopSuratPengantarLab').hide();
    $("#searchTarifLab").show();
    $("#btnAddChargesLab").attr("onclick", 'addBillLab("searchTarifLab")');
    if ($('#searchTarifLabDinamis').data('select2')) {
        $("#searchTarifLabDinamis").select2('destroy').hide();
    }
    $("#select-show-lab-tarif").hide();

})

const declareSearchTarifLab = () => {
    initializeSearchTarif("searchTarifLab", 'P013');
    $("#searchTarifLab").on('select2:select', function(e) {
        addBillLab("searchTarifLab")
        $("#searchTarifLab").click()
        $('html,body').animate({
                scrollTop: $("#searchTarifLab").offset().top - 50
            },
            'slow', 'swing');
        $("#searchTarifLab").click()
        $("#searchTarifLab").select2('open')
    });
}



function initializeSearchTarifDinamis() {
    const orgUnitCode = $("#select-show-lab-tarif").val();

    $("#searchTarifLabDinamis").select2({
        placeholder: "Input Tarif",
        width: 'resolve',
        ajax: {
            url: '<?= base_url(); ?>admin/labRequest/getDatatariftreatData',
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                    org_unit_code: $("#select-show-lab-tarif").val()
                };
            },
            processResults: function(response) {
                if (response.success) {
                    return {
                        results: response.results
                    };
                }
                return {
                    results: []
                };
            },
            cache: true
        }
    });
}




// const delDataPenunjang = (props) => {
//     if (props?.data.length === 0 || (props?.data.length === 1 && props?.data[0] === "%")) {
//         console.log("Tidak Ada yang Di delete");
//     } else {
//         let dataBody = props?.data.filter(id => id !== "%");
//         let resultData = {
//             visit_id: props?.visit?.visit_id,
//             nota_no: dataBody
//         }
//         postData(resultData, 'admin/labRequest/deleteAllPenunjang', (res) => {})
//     }
// }

$('.operasi-tab a[data-bs-toggle="tab"]').on('click', function() {
    $('#coverkopSuratPengantarLab').hide();
});


$('#add-new-doc-coverkopLetterSendLab').on('click', function() {
    renderLatterSendCheck({
        visit: visit
    })
    $("#coverkopSuratPengantarLab").slideUp()
    $("#coverkopSuratPengantarLab").slideDown();
    $('#coverkopSuratPengantarLab').show();
});

$("#save-form-lab-cover-latter").off().on('click', function() {
    const diagnosaDesc = $("#diagnosa_desc-lab-val-lab-latter").val();
    const descriptionsLab = $("#descriptions-lab-val-lab-latter").val();

    if (!diagnosaDesc || diagnosaDesc.trim() === "") {
        errorSwal("diagnosa harus diisi.");
        $("#diagnosa_desc-lab-val-lab-latter").focus();
        return;
    }

    if (!descriptionsLab || descriptionsLab.trim() === "") {
        errorSwal("Deskripsi tambahan harus diisi.");
        $("#descriptions-lab-val-lab-latter").focus();
        return;
    }

    let formData = document.querySelector('#form-lab-cover-latter');
    let dataSend = new FormData(formData);
    let jsonObj = {};
    dataSend.forEach((value, key) => {
        jsonObj[key] = value;
    });
    postData(jsonObj, 'admin/labRequest/actionCoverLatter', (res) => {
        if (res.respon) {
            successSwal(res.message)
            getDataLatterSend({
                visit_id: visit?.visit_id,
                visit: visit
            })
            $("#coverkopSuratPengantarLab").slideUp()
            $('#coverkopSuratPengantarLab').show();

        } else {
            errorSwal(res.message)
            getDataLatterSend({
                visit_id: visit?.visit_id,
                visit: visit
            })

        }
    });
})



async function getBillPoli1(nomor, ke, mulai, akhir, lunas, kode, rj, status, nota, trans) {
    try {
        await getBillPoli(nomor, ke, mulai, akhir, lunas, kode, rj, status, nota, trans);

        // getDataTabels();
    } catch (error) {
        console.error('Error in getBillPoli:', error);
    }
}

$("#formSaveBillLabBtn").on("click", function() {
    $("#labChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
})

$("#notaNoLab").on("change", function() {
    getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, $("#notaNoLab").val(), trans);
    // getDataTabels();

    // const selectedValue = $("#notaNoLab").val();
    // if (dataTarifSelect.includes(selectedValue)) {
    //     if ($('#searchTarifLab').data('select2')) {
    //         $("#searchTarifLab").select2('destroy').hide();
    //     }

    // initializeSearchTarifDinamis();
    // $("#select-show-lab-tarif, #searchTarifLabDinamis").show();
    // $("#btnAddChargesLab").attr("onclick", 'addBillLab("searchTarifLabDinamis")');
    // } else {
    //     initializeSearchTarif("searchTarifLab", 'P013');
    //     $("#searchTarifLab").show();
    //     $("#btnAddChargesLab").attr("onclick", 'addBillLab("searchTarifLab")');
    //     if ($('#searchTarifLabDinamis').data('select2')) {
    //         $("#searchTarifLabDinamis").select2('destroy').hide();
    //     }
    //     $("#select-show-lab-tarif").hide();
    // }

    if ($("#notaNoLab").val() === "%") {
        $("#formSaveBillLabBtn").hide()
        $("#btn-cetak").attr("disabled", true);
    } else {
        $("#btn-cetak").attr("disabled", false);
        $("#formSaveBillLabBtn").show()
    }
});
</script>
<script type='text/javascript'>
function addBillLab(container) {
    $("#formSaveBillLabBtn").show()

    let nota_no = $("#notaNoLab").val();
    let sesi = '<?= $visit['session_id']; ?>';

    // if (nota_no == '%') {
    //     $("#notaNoLab").find(`option[value='${sesi}']`).remove()
    //     nota_no = sesi
    //     $("#notaNoLab").append($("<option>").val(nota_no).text(nota_no))
    //     $("#notaNoLab").val(nota_no)
    //     $("#labChargesBody").html("")
    //     // getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota_no, trans)
    // }

    if (nota_no == '%') {
        nota_no = get_bodyid()
        $("#notaNoLab").append($("<option>").val(nota_no).text(nota_no))
        $("#notaNoLab").val(nota_no)
        $("#labChargesBody").html("")
    }


    setTimeout(() => {
        tarifDataJson = $(`#${container}`).val();
        tarifData = JSON.parse(tarifDataJson);

        $("#searchTarifLab").val(null).trigger('change');


        let tarifIds = [];
        $('#labChargesBody input[name="tarif_id[]"]').each(function() {
            tarifIds.push($(this).val());
        });

        let filtterData = billJson.filter(e => e?.clinic_id === "P013" && e?.nota_no === nota_no)
        let resultDilter = filtterData.map(e => ({
            tarif_id: e.tarif_id,
            nota_no: e.nota_no
        }));
        let tarifIdsInResult = resultDilter.map(e => e.tarif_id);

        if (!(tarifIds.includes(tarifData.tarif_id) || tarifIdsInResult.includes(tarifData.tarif_id))) {

            let codeData = get_bodyid();

            let indexNum = $("#labChargesBody tr.number").length + 1;

            var key = `lab${indexNum}`


            $("#labChargesBody").append($("<tr id=\"alab" + key + "\" class='number " + (billJson?.bill_id ??
                    codeData) + "'>")
                .append($("<td rowspan='2' class='align-middle'>").html(String(indexNum) + "."))
                .append($("<td>").attr("id", "alabdisplaytreatment" + key).html(tarifData.tarif_name))
                .append($("<td>").html('<select id="alabemployee_id' + key +
                    '" class="form-select" name="employee_id[]" onchange="changeFullnameDoctor(\'alab\',\'' +
                    key +
                    '\')">' +
                    chargesDropdownDoctor() +
                    `</select>` +
                    '<input id="alabdoctor' + key +
                    '" class="form-control" style="display: none" type="text" readonly>'
                ))
                .append($("<td>").attr("id", "alabdisplaytreat_date" + key).html(moment().format(
                        "DD/MM/YYYY HH:mm"))
                    .append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
                // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                .append($("<td>").attr("id", "alabdisplaysell_price" + key).html(formatCurrency(
                    parseFloat(
                        tarifData
                        .amount))).append($("<p>").html("")))
                .append($("<td>")
                    .append('<input type="text" name="quantity[]" id="alabquantity' + key +
                        '" placeholder="" value="0" class="form-control" readonly>')
                    .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                )
                .append($("<td rowspan='2'>").attr("id", "asubsidi" + key).html(formatCurrency(0)))
                .append($("<td rowspan='2' class='align-middle'>")
                    .append(
                        '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                        // '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                        '<button id="alabsimpanBillBtn' + key +
                        '" type="button" onclick="simpanBillCharge(\'' +
                        key +
                        '\', \'alab\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                        '<button id="alabeditDeleteCharge' + key +
                        '" type="button" onclick="editBillCharge(\'alab\', \'' +
                        key +
                        '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off" style="display: none">Edit</button>' +
                        '<button id="delBillBtnlabChargesBodyalab' + key +
                        '" type="button" onclick="delBill(\'alab\', \'' + key +
                        '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                        // '</div>' +
                        '</div>')
                )
            )

            $("#labChargesBody").append($("<tr>", {
                    style: "height: 80px;",
                    class: key + ' ' + (billJson?.bill_id ?? codeData)
                })
                .append($("<td>").attr("colspan", "2").html(`
                            <div class="form-group">
                            <label class="form-label fw-bold">Diagnosis Klinis</label>
                                <div class="input-group">
                                    <input id="alabdiagnosa_desclab${indexNum}" 
                                        class="form-control fit" 
                                        style="width: 70%;" 
                                        placeholder="Diagnosis Klinis" 
                                        name="diagnosa_desc[]" 
                                        value="${indexNum === 1 ? window.diagDescLab : $(`#alabdiagnosa_desclab${indexNum - 1}`).val()}">
                                </div>
                            </div>
                        `))
                .append($("<td>").attr("colspan", "4").html(`
                            <div class="form-group">
                                <label class="form-label fw-bold">Indikasi Medis</label>
                                <div class="input-group">
                                    <input id="alabindication_desclab${indexNum}" 
                                        class="form-control fit" 
                                        style="width: 70%;" 
                                        placeholder="Indikasi Medis" 
                                        name="indication_desc[]" 
                                        value="${indexNum === 1 ? "" : $(`#alabindication_desclab${indexNum - 1}`).val()}">
                                </div>
                            </div>
                        `))
                .append($("<td>", {
                    style: "display: none;"
                }).html(`
                    <input type="hidden" name="quantity[]" id="alabquantity${key}" value="0" class="form-control">
                    <input type="hidden" name="treatment[]" id="alabtreatment${key}" value="${tarifData.tarif_name}" class="form-control">
                    <input type="hidden" name="treat_date[]" id="alabtreat_date${key}" value="${get_date()}" class="form-control">
                    <input type="hidden" name="sell_price[]" id="alabsell_price${key}" value="${tarifData.amount}" class="form-control">
                    <input type="hidden" name="amount_paid[]" id="alabamount_paid${key}" value="${tarifData.amount}" class="form-control">
                    <input type="hidden" name="discount[]" id="alabdiscount${key}" value="0" class="form-control">
                    <input type="hidden" name="subsidisat[]" id="alabsubsidisat${key}" value="0" class="form-control">
                    <input type="hidden" name="subsidi[]" id="alabsubsidi${key}" value="0" class="form-control">
                    <input type="hidden" name="bill_id[]" id="alabbill_id${key}" value="${billJson?.bill_id ?? codeData}" class="form-control">
                    <input type="hidden" name="trans_id[]" id="alabtrans_id${key}" value="<?= $visit['trans_id']; ?>" class="form-control">
                    <input type="hidden" name="no_registration[]" id="alabno_registration${key}" value="<?= $visit['no_registration']; ?>" class="form-control">
                    <input type="hidden" name="theorder[]" id="alabtheorder${key}" value="${billJson?.length + 1}" class="form-control">
                    <input type="hidden" name="visit_id[]" id="alabvisit_id${key}" value="<?= $visit['visit_id']; ?>" class="form-control">
                    <input type="hidden" name="org_unit_code[]" id="alaborg_unit_code${key}" value="<?= $visit['org_unit_code']; ?>" class="form-control">
                    <input type="hidden" name="class_id[]" id="alabclass_id${key}" value="<?= $visit['class_id']; ?>" class="form-control">
                    <input type="hidden" name="class_id_plafond[]" id="alabclass_id_plafond${key}" value="<?= $visit['class_id_plafond']; ?>" class="form-control">
                    <input type="hidden" name="payor_id[]" id="alabpayor_id${key}" value="<?= $visit['payor_id']; ?>" class="form-control">
                    <input type="hidden" name="karyawan[]" id="alabkaryawan${key}" value="<?= $visit['karyawan']; ?>" class="form-control">
                    <input type="hidden" name="theid[]" id="alabtheid${key}" value="<?= $visit['pasien_id']; ?>" class="form-control">
                    <input type="hidden" name="thename[]" id="alabthename${key}" value="<?= $visit['diantar_oleh']; ?>" class="form-control">
                    <input type="hidden" name="theaddress[]" id="alabtheaddress${key}" value="<?= $visit['visitor_address']; ?>" class="form-control">
                    <input type="hidden" name="status_pasien_id[]" id="alabstatus_pasien_id${key}" value="<?= $visit['status_pasien_id']; ?>" class="form-control">
                    <input type="hidden" name="isrj[]" id="alabisrj${key}" value="<?= $visit['isrj']; ?>" class="form-control">
                    <input type="hidden" name="gender[]" id="alabgender${key}" value="<?= $visit['gender']; ?>" class="form-control">
                    <input type="hidden" name="ageyear[]" id="alabageyear${key}" value="<?= $visit['ageyear']; ?>" class="form-control">
                    <input type="hidden" name="agemonth[]" id="alabagemonth${key}" value="<?= $visit['agemonth']; ?>" class="form-control">
                    <input type="hidden" name="ageday[]" id="alabageday${key}" value="<?= $visit['ageday']; ?>" class="form-control">
                    <input type="hidden" name="kal_id[]" id="alabkal_id${key}" value="<?= $visit['kal_id']; ?>" class="form-control">
                    <input type="hidden" name="karyawan[]" id="alabkaryawan${key}" value="<?= $visit['karyawan']; ?>" class="form-control">
                    <input type="hidden" name="class_room_id[]" id="alabclass_room_id${key}" value="<?= $visit['class_room_id']; ?>" class="form-control">
                    <input type="hidden" name="bed_id[]" id="alabbed_id${key}" value="<?= $visit['bed_id']; ?>" class="form-control">
                    <input type="hidden" name="clinic_id[]" id="alabclinic_id${key}" value="P013" class="form-control">
                    <input type="hidden" name="clinic_id_from[]" id="alabclinic_id_from${key}" value="<?= $visit['clinic_id']; ?>" class="form-control">
                    <input type="hidden" name="exit_date[]" id="alabexit_date${key}" value="${get_date()}" class="form-control">
                    <input type="hidden" name="cashier[]" id="alabcashier${key}" value="<?= user_id(); ?>" class="form-control">
                    <input type="hidden" name="modified_from[]" id="alabmodified_from${key}" value="<?= user()->username ?>" class="form-control">
                    <input type="hidden" name="islunas[]" id="alabislunas${key}" value="0" class="form-control">
                    <input type="hidden" name="measure_id[]" id="alabmeasure_id${key}" value="" class="form-control">
                    <input type="hidden" name="tarif_id[]" id="alabtarif_id${key}" value="${tarifData.tarif_id}" class="form-control">
                    <input type="hidden" name="body_id[]" id="alabbody_id${key}" value="${tarifData.body_id ?? '<?= @$visit['session_id'] ?>'}" class="form-control">
                    <input type="hidden" name="doctor_from[]" id="alabdoctor_from${key}" class="form-control">
                    <input type="hidden" name="employee_id_from[]" id="alabemployee_id_from${key}"  class="form-control" />
                    `))
            );


            if ('<?= $visit['isrj']; ?>' == '0') {

                $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
                $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');
                <?php
                    if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {
                    ?>


                $("#" + key)
                    .append(
                        `<input name="employee_id_from[]" id="alabemployee_id_from${key}" type="hidden" 
                                        value='<?= user()->employee_id_from; ?>' class="form-control" />`
                    )
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= user()->getFullname(); ?>" class="form-control" />')
                <?php
                    } else {

                    ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= user()->employee_id_from; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= user()->getFullname(); ?>" class="form-control" />')

                <?php
                    }
                    ?>
            } else {

                <?php
                    if (!is_null($visit['employee_id_from']) && $visit['employee_id_from'] != '') {

                    ?>

                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= user()->employee_id_from; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= user()->getFullname(); ?>" class="form-control" />')

                <?php
                    } else {

                    ?>
                $("#" + key)
                    .append('<input name="employee_id_from[]" id="alabemployee_id_from' + key +
                        '" type="hidden" value="<?= user()->employee_id_from; ?>" class="form-control" />')
                    .append('<input name="doctor_from[]" id="alabdoctor_from' + key +
                        '" type="hidden" value="<?= user()->getFullname(); ?>" class="form-control" />')
                <?php
                    }
                    ?>
            }

            $("#alabemployee_id_from" + key).val('<?= user()->employee_id; ?>')
            $("#alabdoctor_from" + key).val('<?= user()->getFullname();; ?>')
            $("#alabemployee_id" + key).val('<?= user()->employee_id; ?>')
            $("#alabdoctor" + key).val('<?= user()->getFullname();; ?>')

            $("#" + key)
                .append('<input name="employee_id[]" id="alabemployee_id' + key +
                    '" type="hidden" value="<?= $visit['employee_id']; ?>" class="form-control" />')
                .append('<input name="amount[]" id="alabamount' + key + '" type="hidden" value="' +
                    tarifData
                    .amount +
                    '" class="form-control" />')
                .append('<input name="nota_no[]" id="alabnota_no' + key + '" type="hidden" value="' +
                    nota_no +
                    '" class="form-control" />')
                .append('<input name="profesi[]" id="alabprofesi' + key +
                    '" type="hidden" value="" class="form-control" />')
                .append('<input name="tagihan[]" id="alabtagihan' + key + '" type="hidden" value="' +
                    tarifData
                    .amount *
                    $(
                        "#alabquantity" + key).val() + '" class="form-control" />')
                .append('<input name="treatment_plafond[]" id="alabtreatment_plafond' + key +
                    '" type="hidden" value="' +
                    tarifData.amount + '" class="form-control" />')
                .append('<input name="tarif_type[]" id="alabtarif_type' + key + '" type="hidden" value="' +
                    tarifData
                    .tarif_type + '" class="form-control" />')

            if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {
                var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name,
                    tarifData
                    .isCito);
                if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 &&
                    '<?= $visit['class_id_plafond']; ?>' !=
                    99) {
                    $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key +
                        '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                    $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' +
                        key +
                        '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                    $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                        '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />'
                    )
                    $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key +
                        '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
                } else {
                    $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key +
                        '" type="hidden" value="0" class="form-control" />')
                    $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' +
                        key +
                        '" type="hidden" value="0" class="form-control" />')
                    $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                        '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />'
                    )
                    $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key +
                        '" type="hidden" value="" class="form-control" />')
                }
            } else {
                $("#" + key).append('<input name="amount_plafond[]" id="alabamount_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#" + key).append('<input name="amount_paid_plafond[]" id="alabamount_paid_plafond' +
                    key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#" + key).append('<input name="class_id_plafond[]" id="alabclass_id_plafond' + key +
                    '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />'
                )
                $("#" + key).append('<input name="tarif_id_plafond[]" id="alabtarif_id_plafond' + key +
                    '" type="hidden" value="" class="form-control" />')
            }

            $("#alabquantity" + key).keydown(function(e) {
                !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e
                    .keyCode >= 96 &&
                    e
                    .keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 ==
                    e
                    .keyCode ||
                    46 == e
                    .keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val()
                    .indexOf(
                        ".") &&
                    190 ==
                    e
                    .keyCode && e.preventDefault();
            });
            $('#alabquantity' + key).on("input", function() {
                var dInput = this.value;
                $("#alabamount_paid" + key).val($("#alabamount" + key).val() * dInput)
                $("#alabdisplayamount_paid" + key).html(formatCurrency($("#alabamount" + key)
                    .val() *
                    dInput))
                $("#alabtagihan" + key).val($("#alabamount" + key).val() * dInput)
                $("#alabamount_paid_plafond" + key).val($("#alabamount_plafond" + key).val() *
                    dInput)
                $("#alabdisplayamount_paid_plafond" + key).html(formatCurrency($(
                        "#alabamount_plafond" +
                        key)
                    .val() *
                    dInput))
            })
        } else {
            errorSwal("Tarif sudah Ada ")
            let indexLenghtLabTable = $("#labChargesBody tr.number").length;
            if (indexLenghtLabTable === 0) {
                getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota_no, trans)

            }
        }

    }, 500);
    // tarifData.amount

}


function isnullcheck(parameter) {
    return parameter == null ? 0 : (parameter)
}

function getHasilLab(nomor, visit) {


    $.ajax({
        url: '<?php echo base_url(); ?>admin/patient/getHasilLab',
        type: "POST",
        data: JSON.stringify({
            'nomor': nomor,
            'visit': visit
        }),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            hasilLabJson = data.result

            var headerKey = data.headerKey

            $("#labBody").html(headerKey)


            hasilLabJson.forEach((element, key) => {
                $("#viewlab" + hasilLabJson[key].periksa_tgl).append($("<tr>")
                    .append($("<td>").append($("<p>").html(hasilLabJson[key]
                        .parameter_name)))
                    .append($("<td>").html(hasilLabJson[key].hasil))
                    .append($("<td>").html(hasilLabJson[key].satuan))
                    .append($("<td>").html(hasilLabJson[key].nilai_rujukan))
                    .append($("<td>").html(hasilLabJson[key].description))
                )
            });
        },
        error: function() {

        }
    });
}
</script>
<script>
function filterBillLab() {

    $("#labChargesBody").html("")
    var notaNoLab = $("#notaNoLab").val()
    billJson?.forEach((element, key) => {

        if (billJson[key]?.clinic_id == 'P013' && (billJson[key]?.nota_no == notaNoLab || '%' == notaNoLab)) {
            var i = $('#labChargesBody tr').length + 1;
            var counter = 'lab' + i
            addRowBill("labChargesBody", "alab", key, i, counter)

            setTimeout(() => {
                $(`#alabdisplayamount_plafondlab${i}, #alabdisplayamount_paid_plafondlab${i},
                        #alabdisplaydiscountlab${i},
                        #alabsubsidisatlab${i}, #alabdisplayamount_plafondlab${i}`).hide();
            }, 100);
        }
    })
    // getDataTabels()
}
</script>

<!-- ===================================================================================================================================== -->
<script>
$("#searchLIS").off().on("click", function() {
    const startDate = $("#startDateLIS").val();
    const endDate = $("#endDateLIS").val();

    const formattedStartDate = convertLabDate(startDate);
    const formattedEndDate = convertLabDate(endDate);

    const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
    const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

    getDataBillLIS({
        noRegis: nomor,
        trans_id: trans,
        startDate: start,
        endDate: end
    });
});

$("#searchLISHasil").off().on("click", function() {
    let startDate = $("#startDateLISHasil").val();
    let endDate = $("#endDateLISHasil").val();
    let hasil = $("#searchTarifLabHasil").val();
    let parsedHasil = JSON.parse(hasil);

    let formattedStartDate = convertLabDate(startDate);
    let formattedEndDate = convertLabDate(endDate);
    let tarifId = parsedHasil?.tarif_id;
    let noPasien = nomor


    if (!tarifId) {
        errorSwal("Tarif ID tidak ditemukan. Silakan pilih tarif yang valid.")
        $("#hasilFilterLIS").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`)

        return;
    }

    postData({
        no_pasien: nomor,
        start_date: formattedStartDate,
        end_date: formattedEndDate,
        tarif_id: tarifId
    }, 'admin/labRequest/getDataByFilter', (res) => {
        if (res.respon === true) {
            getDataHasilFilter({
                data: res.dataTables
            })
        } else {
            $("#hasilFilterLIS").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`)
        }
    }, (beforesend) => {
        $("#hasilFilterLIS").html(loadingScreen())
    })


});

const getDataHasilFilter = (data) => {
    let result = '';
    let groupedData = {};

    data?.data.forEach(e => {
        if (!groupedData[e.tgl_hasil]) {
            groupedData[e.tgl_hasil] = {};
        }

        if (!groupedData[e.tgl_hasil][e.tarif_name]) {
            groupedData[e.tgl_hasil][e.tarif_name] = [];
        }

        groupedData[e.tgl_hasil][e.tarif_name].push(e);
    });

    for (let kelPemeriksaan in groupedData) {
        if (groupedData.hasOwnProperty(kelPemeriksaan)) {
            result += `<tr>
                                <td colspan="6"><strong>${moment(kelPemeriksaan).format("DD-MM-YYYY") }</strong></td>
                        </tr>`;
            for (let tarifName in groupedData[kelPemeriksaan]) {
                if (groupedData[kelPemeriksaan].hasOwnProperty(tarifName)) {
                    result += `<tr>
                                        <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                </tr>`;

                    groupedData[kelPemeriksaan][tarifName].forEach(e => {
                        result += `<tr>
                                        <td style="padding-left: 40px;">${e.parameter_name}</td>
                                        <td>
                                            ${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                                ['L', 'H', 'K', '(*)'].includes(e.flag_hl.trim()) ? `<b class="fw-bold">${e.hasil}</b>` : 
                                                (e.flag_hl.trim().includes('K') ? `<b style="color:red;">${e.hasil}</b>` : 
                                                e.hasil)}
                                        </td>

                                        <td>${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                                (e.flag_hl?.trim().includes('K') ? `<b style="color:red;">${e.flag_hl.trim()}</b>` :
                                                ['L', 'H', 'K' , '(*)'].includes(e.flag_hl?.trim()) ? `<b class="fw-bold">${e.flag_hl.trim()}</b>` : 
                                                e.flag_hl.trim())}
                                        </td>
                                        <td>${!e.satuan? "-":e.satuan}</td>
                                        <td>${!e.nilai_rujukan? "-":e.nilai_rujukan}</td>
                                        <td>${!e.catatan? "-": e.catatan === "-" ? !e.rekomendasi ? "-" : e.rekomendasi : e.catatan }</td>
                                    </tr>`;
                    });
                }
            }
        }
    }

    $("#hasilFilterLIS").html(result);
};

const getDataBillLIS = (props) => {
    const noRegis = props?.noRegis;
    const startDate = props?.startDate;
    const endDate = props?.endDate;
    const trans_id = props?.trans_id

    if (!noRegis) {
        console.error('No registration number provided.');
        return;
    }

    const requestData = {
        noRegis: noRegis,
        trans_id: trans_id,
        visit_id: visit?.visit_id,
        isrj: visit?.isrj
    };

    if (startDate && endDate) {
        requestData.startDate = startDate;
        requestData.endDate = endDate;
    }

    postData(requestData, 'admin/labRequest/getData', (res) => {
        if (res && res.value) {
            const {
                inspection,
                bridging,
                hasillis
            } = res.value;

            window.diagDescLab = res?.value?.diag?.diagnosadesc ?? ""
            renderKopLab({
                kop: res?.value?.kop || {}
            })
            dataRenderTarifSelectOption({
                data: res?.value?.select
            })
            inspectionLIS = inspection || [];
            detailsData = bridging || [];
            hasilLIS = hasillis || [];

            populateExaminationTable();
            populateDetailsTable();
            populateLabHasilTable();

        } else {
            console.error('Response data is missing expected properties.');
        }
    }, (beforesend) => {
        getLoadingGlobalServices('examinationTable tbody')
        getLoadingGlobalServices('detailsTable tbody')
        getLoadingGlobalServices('labHasilLIS');

        // $("#bodydata").html(loadingScreen())
    });
}



const dataRenderTarifSelectOption = (props) => {
    let result = ''
    props?.data?.map(e => {
        result += `<option value="${e.org_unit_code}">${e.perda_no}</option>`
    })

    $("#select-show-lab-tarif").html(`<option value="%" seleted>Pilih Tempat</option>` + result)
}

let inspectionLIS = [];
let detailsData = [];
let hasilLIS = [];

const examinationTableBody = document.querySelector('#examinationTable tbody');
const detailsTableBody = document.querySelector('#detailsTable tbody');
const selectAllExaminations = document.querySelector('#selectAllExaminations');
const selectAllDetails = document.querySelector('#selectAllDetails');
const moveRightBtn = document.querySelector('#moveRight');
const moveLeftBtn = document.querySelector('#moveLeft');

const populateExaminationTable = () => {
    examinationTableBody.innerHTML = '';

    inspectionLIS.forEach((item, index) => {
        const row = document.createElement('tr');
        row.dataset.index = index;

        row.innerHTML = `
            <td class="checkbox-col"><input type="checkbox" class="rowCheckboxExamination" data-index="${index}"></td>
            <td>${index + 1}</td>
            <td>${item?.no_registration}</td>
            <td>${item?.name_of_pasien}</td>
            <td>${item?.treatment}</td>
            `;
        examinationTableBody.appendChild(row);


    });


    attachRowCheckboxListeners('examination');
}

const renderKopLab = (props) => {
    let {
        kop
    } = props
    $('.kop-name-lab').text(kop?.name_of_org_unit || '');
    $('.kop-address-lab').html(kop?.contact_address + ',' + kop?.phone + ', Fax:' + kop?.fax + ',' + kop?.kota +
        '<br>' + kop?.sk
    );
}

const getDataLatterSend = (props) => {
    postData({
        visit_id: props?.visit_id
    }, 'admin/labRequest/getDataCoverLatter', (res) => {
        if (res?.respon === true) {

            dataTarifSelect = res?.dataTables?.map(e => e.nota_no)
            renderDataTablesLetterSend({
                data: res,
                visit: visit
            })
        } else {
            $("#hasilbodylistLatter").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`);
        }
    })

    // renderLatterSendCheck()
}

const renderDataTablesLetterSend = (props) => {
    let result = '';
    props?.data?.dataTables.map((e, index) => {

        if (!$("#notaNoLab option").filter(function() {
                return $(this).val() === e?.nota_no;
            }).length) {
            $("#notaNoLab").append($("<option>").val(e?.nota_no).text(e?.nota_no));
        }

        result += `<tr>
                        <td>${index + 1}</td>            
                        <td class="text-center">${e?.nota_no}</td>            
                        <td class="text-center">${e?.descriptions}</td>            
                        <td>
                            <button type="button" class="btn btn-warning btn-show-render-latter" autocomplete="off" data-index="${index}">
                                <i class="fa fa-edit">Check</i>
                            </button>
                            <button type="button" data-index="${index}" id="btn-cetak-Hasillist" class="btn btn-secondary btn-print-render-latter" name="cari">
                                    <i class="far fa-file"></i> Cetak
                            </button>`;

        if (e.terlayani === 0) {
            if (e.modified_by === "<?= user()->username; ?>") {
                result += `
                                <button type="button" class="btn btn-danger btn-delete-latter-lab" data-nota_no="${e.nota_no}" autocomplete="off">
                                    <i class="fa fa-trash"></i>
                                </button>`;
            }
        }
        result += `</td></tr>`;
    });

    $("#hasilbodylistLatter").html(result);
    renderShowtemplateLetterLab({
        data: props?.data?.dataTables,
        visit: props?.visit
    });
    deleteDataTableLatterSendlab({
        visit: visit
    });
};




const renderShowtemplateLetterLab = (props) => {
    $('.btn-show-render-latter').off().on('click', function(e) {
        let index = $(this).data('index');
        // let item = getDataLatterLabAll[index];
        let item = props?.data[index]

        $("#coverkopSuratPengantarLab").slideUp()
        $("#coverkopSuratPengantarLab").slideDown()
        renderLatterSendCheck({
            data: item,
            visit: visit
        })

        $('a[href="#coverSendFisioterapi"]').addClass('active');
        $('.datetime-now').html(moment(new Date()).format('DD-MM-YYYY HH:mm'))

        // $('#JfisioDocument').show();

    })
    $('.btn-print-render-latter').off().on('click', function(e) {
        let index = $(this).data('index');
        // let item = getDataLatterLabAll[index];
        let item = props?.data[index]

        let notaNo = item?.nota_no

        openPopUpTab(
            '<?= base_url() . 'admin/rm/medis/surat_pengantar_cetak/' . base64_encode(json_encode($visit)); ?>' +
            '/' + notaNo)

    })
}

const deleteDataTableLatterSendlab = (props) => {
    $('.btn-delete-latter-lab').off().on('click', function(e) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ms-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Apa anda yakin?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deleteRequestLabLatter({
                    nota_no: $(this).data('nota_no'),
                    visit: visit
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan",
                    text: "File Anda aman :)",
                    icon: "error"
                });
            }
        });
    });
};

const deleteRequestLabLatter = (props) => {
    postData({
        nota_no: props?.nota_no
    }, 'admin/labRequest/deleteCoverLatter', (res) => {
        successSwal('Sukses');
        $("#notaNoLab option").filter(function() {
            return $(this).val() === props?.nota_no;
        }).remove();
        getDataLatterSend({
            visit_id: visit?.visit_id,
            visit: visit
        })
        $("#coverkopSuratPengantarLab").slideUp()
        // $("#JfisioDocument").slideUp()

    })
}
const signLatterLab = () => {
    addSignUser("form-lab-cover-latter", "", "nota_no-lab-val-lab-latter", "save-form-lab-cover-latter", 14, 1, 1,
        "Surat Pengantar Pemeriksaan Lab", "valid_user")
}




$("#sign-form-lab-cover-latter").off().on('click', function() {
    signLatterLab()

})

function cropSignatureFromImageIDOneLab(base64, callback) {
    const img = new Image();
    img.onload = () => {
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);

        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];

            if (!(r === 0 && g === 0 && b === 0)) {
                data[i + 3] = 0;
            }
        }

        ctx.putImageData(imageData, 0, 0);

        callback(canvas.toDataURL('image/png'));
    };
    img.src = base64;
}

const cropTransparentPNGLab = (base64, callback) => {
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0);

        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        let top = null,
            bottom = null,
            left = null,
            right = null;

        for (let y = 0; y < canvas.height; y++) {
            for (let x = 0; x < canvas.width; x++) {
                const index = (y * canvas.width + x) * 4;
                const alpha = data[index + 3];
                if (alpha > 0) {
                    if (top === null || y < top) top = y;
                    if (bottom === null || y > bottom) bottom = y;
                    if (left === null || x < left) left = x;
                    if (right === null || x > right) right = x;
                }
            }
        }

        if (top === null) return callback(null); // tidak ada gambar

        const width = right - left + 1;
        const height = bottom - top + 1;

        const croppedCanvas = document.createElement('canvas');
        croppedCanvas.width = width;
        croppedCanvas.height = height;

        const croppedCtx = croppedCanvas.getContext('2d');
        croppedCtx.drawImage(canvas, left, top, width, height, 0, 0, width, height);

        const croppedBase64 = croppedCanvas.toDataURL('image/png');
        callback(croppedBase64);
    };
    img.src = base64;
};



const renderLatterSendCheck = (props) => {
    if (props?.data) {
        if (props?.data?.valid_user) {
            $("#save-form-lab-cover-latter").hide();
            $("#sign-form-lab-cover-latter").hide();
            $("#lab-ttd-result").attr("hidden", false);
            // read Only

            $("#descriptions-lab-val-lab-latter").attr("readonly", true);
            $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", true);
            $("#qrcode-lab-conver-dokter").empty();


            if (props?.data?.sign?.user_type == 1 && props?.data?.sign?.isvalid == 1) {
                const resultBase64Lab = `data:image/png;base64,${props?.data?.sign?.sign_file}`;

                cropSignatureFromImageIDOneLab(resultBase64Lab, (cropped) => {
                    if (cropped) {
                        cropTransparentPNGLab(cropped, (croppedNew) => {
                            if (croppedNew) {
                                $('#qrcode-lab-conver-dokter').html(
                                    `<img src="${croppedNew}" alt="Signature" style="width:100%;max-width: 100px;max-height: 100px;">`
                                );
                            }
                        });

                        // $('#qrcode-lab-conver-dokter').html(
                        //     `<img src="${cropped}" alt="Signature" style="width:150px;">`
                        // );
                    } else {
                        $('#qrcode-lab-conver-dokter').empty();
                    }
                });


                $("#validator-ttd-lab-conver-dokter").html(
                    `(${props?.data?.sign?.fullname??props?.data?.sign?.user_id})`)
                // $("#qrcode-lab-conver-dokter").html('<img class="mt-3" src="data:image/png;base64,' + props?.data
                //     ?.sign?.sign_file +
                //     '" width="400px">')

            }
            // var qrcode = new QRCode(document.getElementById("qrcode-lab-conver-dokter"), {
            //     text: `${props?.data?.valid_user || ""}`, // Your text here
            //     width: 70,
            //     height: 70,
            //     colorDark: "#000000",
            //     colorLight: "#ffffff",
            //     correctLevel: QRCode.CorrectLevel.H // High error correction
            // });

            // $("#validator-ttd-lab-conver-dokter").text(props?.data?.valid_user)

        } else if (props?.data?.modified_by === '<?= user()->username; ?>') {
            $("#save-form-lab-cover-latter").show();
            $("#sign-form-lab-cover-latter").show();
            $("#descriptions-lab-val-lab-latter").attr("readonly", false);
            $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", false);
            $("#lab-ttd-result").attr("hidden", true);
        } else {
            $("#lab-ttd-result").attr("hidden", true);
            $("#sign-form-lab-cover-latter").hide();
            $("#save-form-lab-cover-latter").hide();
            $("#descriptions-lab-val-lab-latter").attr("readonly", true);
            $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", true);
        }
    } else {
        $("#save-form-lab-cover-latter").show();
        $("#lab-ttd-result").attr("hidden", true);
        $("#descriptions-lab-val-lab-latter").attr("readonly", false);
        $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", false);
    }






    let result = props?.data
    let resultTemplate = props?.visit
    let nameValueVisit2 = [
        'diantar_oleh', 'age', 'no_registration',
        'visitor_address',
    ];

    nameValueVisit2?.forEach(name => {
        let id = `${name}-val2-lab-latter`;
        let value = resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).text(value);
        }
    });

    let nameValueHidden = [
        'visit_id', 'trans_id', "no_registration", "employee_id",
        "patient_category_id", "isrj", "ageyear", "agemonth", "ageday", "status_pasien_id", "gender",
        "class_room_id", "bed_id", "keluar_id",
    ];

    nameValueHidden?.forEach(name => {
        let id = `${name}-lab-val-lab-latter`;
        let value = result?. [name] ?? resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).val(value);
        }
    });


    let nota_nogenerate = get_bodyid()
    $("#org_unit_code-lab-val-lab-latter").val("-")
    $("#clinic_id-lab-val-lab-latter").val("P013")
    $("#nota_no-lab-val-lab-latter").val(result?.nota_no ?? nota_nogenerate)
    $("#document_id-lab-val-lab-latter").val(result?.document_id ?? resultTemplate?.session_id)
    $("#validation-lab-val-lab-latter").val(result?.validation ?? 0)
    $("#terlayani-lab-val-lab-latter").val(result?.terlayani ?? 0)
    $("#iscito-lab-val-lab-latter").val(result?.iscito ?? 0)
    $("#treat_date-lab-val-lab-latter").val(result?.treat_date ? moment(result?.treat_date).format(
        "YYYY-MM-DD HH:mm") : moment(new Date()).format("YYYY-MM-DD HH:mm"))
    $("#thename-lab-val-lab-latter").val(result?.thename ?? resultTemplate?.diantar_oleh)
    $("#theaddress-lab-val-lab-latter").val(result?.theaddress ?? resultTemplate?.contact_address)
    $("#theid-lab-val-lab-latter").val(result?.theid ?? resultTemplate?.pasien_id)
    $("#doctor-lab-val-lab-latter").val(result?.doctor ?? resultTemplate?.fullname)
    $("#perujuk-lab-val-lab-latter").val(result?.perujuk ?? resultTemplate?.employee_id_from)
    $("#diagnosa_desc-lab-val-lab-latter").val(result?.diagnosa_desc ?? null)
    $("#descriptions-lab-val-lab-latter").val(result?.descriptions ?? null)

}

const addNotaLab = () => {
    nota_no = get_bodyid()
    $("#notaNoLab").append($("<option>").val(nota_no).text(nota_no))
    $("#notaNoLab").val(nota_no)
    $("#labChargesBody").html("")

    return nota_no
}

const getDataTabels = (props) => {
    postData({
        no_registration: nomor,
        trans_id: trans
    }, 'admin/labRequest/getValidate', (res) => {

        window.diagDescLab = res?.diag?.diagnosadesc ?? ""
        // if (res.value.length > 0) {
        //     const validBills = res.value.map(item => item?.bill_id);

        //     setTimeout(() => {
        //         const tableBody = $("#labChargesBody");
        //         if ($.inArray(props?.data, validBills) !== -1) {
        //             $("#saveBridge").hide()
        //         } else {
        //             $("#saveBridge").show()
        //         }

        //         tableBody.find("tr.number").each(function(index) {
        //             const classes = $(this).attr("class")?.split(" ") || [];
        //             const billClassIndex = classes.indexOf('bill');
        //             const classBeforeBill = billClassIndex > 0 ? classes[billClassIndex -
        //                 1] : null;
        //             const rowIndex = index;
        //             const rowId = classBeforeBill;

        //             if (validBills.includes(rowId)) {

        //                 $(`#alabeditDeleteChargelab${rowIndex+1}`).remove();
        //                 // $(`#alabbridgelab${rowIndex +1}`).remove();
        //                 $(`#delBillBtnlabChargesBodyalab${rowIndex}`).remove();
        //             }

        //         });
        //     }, 200);
        // }
    });
};



const populateLabHasilTable = () => {
    let result = ""

    hasilLIS.map((item, index) => {

        result += `<tr>
                            <td class="text-center align-middle">${index + 1}</td>
                            <td class="text-center align-middle">${item?.reg_date ? moment(item?.reg_date).format("DD/MM/YYYY HH:mm") : item?.reg_date ?? "-"}
                            <input name="kodekunjungan" id="addKj${item?.kode_kunjungan}" value="${item?.kode_kunjungan}" type="hidden"> 
                            </td>
                            <td class="text-center align-middle">${item?.tarif_names ? item?.tarif_names.replace(/&nbsp;/g, ' ') : ''}</td>
                            <td class="text-center align-middle">
                                <button type="button" data-id="${item?.kode_kunjungan}" data-date="${item?.reg_date}"  data-source="${item?.source}" data-name="${item?.tarif_names ? item?.tarif_names.replace(/&nbsp;/g, ' ') : ''}"
                                        id="btn-cetak-Hasillist" class="btn btn-secondary hasil-list-btn" name="cari">
                                    <i class="far fa-file"></i> Preview
                            </button>
                                <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>

                            <button type="button" data-id="${item?.kode_kunjungan}" ${item?.valid_user ? "disabled": ""} data-date="${item?.reg_date}"  data-lis="${item?.nolab_lis}"
                                        id="btn-cetak-Hasillist" class="btn btn-outline-warning" name="signLabValid">
                                    <i class="fa fa-signature"></i> Validator
                            </button>

                                <button hidden type="button" data-id="${item?.kode_kunjungan}" data-date="${item?.reg_date}"  data-lis="${item?.nolab_lis}"
                                        id="btn-sign-Hasillist${item?.kode_kunjungan}" class="btn btn-outline-danger" name="signLabValidAction">
                                    Validator
                            </button>

                                <?php } ?>


                            </td>
                            
                        </tr>`
    });


    let hrefLink = '<?= base_url(); ?>admin/reklaim/CetakReklaim/cetakAllGrouping/' +
        btoa(JSON.stringify({
            org_unit_code: visit?.org_unit_code,
            no_registration: visit?.no_registration,
            visit_id: visit?.visit_id,
            status_pasien_id: visit?.status_pasien_id,
            booked_date: visit?.booked_date,
            visit_date: visit?.visit_date,
            clinic_id: visit?.clinic_id,
            class_room_id: visit?.class_room_id,
            bed_id: visit?.bed_id,
            keluar_id: visit?.keluar_id,
            in_date: visit?.in_date,
            exit_date: visit?.exit_date,
            diantar_oleh: visit?.diantar_oleh,
            gender: visit?.gender,
            visitor_address: visit?.visitor_address,
            employee_id: visit?.employee_id,
            employee_id_from: visit?.employee_id_from,
            payor_id: visit?.payor_id,
            class_id: visit?.class_id,
            ageyear: visit?.ageyear,
            agemonth: visit?.agemonth,
            ageday: visit?.ageday,
            conclusion: visit?.conclusion,
            specimenno: visit?.specimenno,
            no_skpinap: visit?.no_skpinap,
            tanggal_rujukan: visit?.tanggal_rujukan,
            isrj: visit?.isrj,
            trans_id: visit?.trans_id,
            asalrujukan: visit?.asalrujukan,
            tgl_lahir: visit?.tgl_lahir,
            tujuankunj: visit?.tujuankunj,
            flagprocedure: visit?.flagprocedure,
            kdpenunjang: visit?.kdpenunjang,
            assesmentpel: visit?.assesmentpel,
            ssencounter_id: visit?.ssencounter_id,
            name_of_pasien: visit?.name_of_pasien,
            date_of_birth: visit?.date_of_birth,
            contact_address: visit?.contact_address,
            mobile: visit?.mobile,
            kalurahan: visit?.kalurahan,
            name_of_clinic: visit?.name_of_clinic,
            fullname: visit?.fullname,
            treat_date: visit?.treat_date,
            class_room: visit?.class_room,
            npk: visit?.npk,
            name_of_status_pasien: visit?.name_of_status_pasien,
            name_of_gender: visit?.name_of_gender,
            nama_agama: visit?.nama_agama,
            cara_keluar: visit?.cara_keluar,
            name_of_class: visit?.name_of_class,
            name_of_class_plafond: visit?.name_of_class_plafond,
            payor: visit?.payor,
            specialist_type_id: visit?.specialist_type_id,
            age: visit?.age,
            session_id: visit?.session_id,
            description: visit?.description,
            pasien_id: visit?.pasien_id,
            kal_id: visit?.kal_id,
            account_id: visit?.account_id
        })) +
        '/' +
        '?result=Lab';

    let cetakAllHasil = `<tr>
                                <td class="text-center align-middle" colspan="4">
                                    <button type="button" 
                                        id="btn-cetak-Hasillist" 
                                        class="btn btn-secondary " 
                                        name="cari"
                                        onclick="window.open('${hrefLink}', '_blank')">
                                        <i class="far fa-file"></i> CetakAll
                                    </button>
                                </td>
                            </tr>`;

    $("#labHasilLIS").html(result + cetakAllHasil);


    if (hasilLIS.length === 0) {
        $("#labHasilLIS").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`);
    }

    $(".hasil-list-btn").off().on("click", function() {
        const kodeKunjungan = $(this).data("id");
        const regDate = $(this).data("date");
        const source = $(this).data("source");
        let name = $(this).data('name');

        name = name.replace(/&nbsp;/g, ' ');

        const nolist = kodeKunjungan;
        const no_pasien = nomor;
        // const visit = <?= json_encode($visit); ?>;

        let start_request = moment(regDate).format("YYYY-MM-DD");
        let end_request = moment(regDate).format("YYYY-MM-DD");
        let data = {
            visit_id: visit.visit_id,
            no_registration: visit.no_registration,
            trans_id: visit.trans_id,
            specialist_type_id: visit.specialist_type_id,
            session_id: visit?.session_id,
            nolist: nolist,
            no_pasien: no_pasien,
            start_request: start_request,
            end_request: end_request,
            name_files: name
        }


        const visitString = JSON.stringify(data);
        const encodedVisit = btoa(unescape(encodeURIComponent(visitString)));

        const endpoint = (source === "PENUNJANG" || source === "KIRIMLIS") ?
            "laboratorium_cetak_review" :
            "laboratorium_cetak";

        const url =
            `<?= base_url() . '/admin/rm/lainnya/' ?>${endpoint}/${encodedVisit}?source=${source}`;

        window.open(url, '_blank');
    });




    $("button[name='signLabValid']").off().on("click", function() {

        const kodeKunjungan = $(this).data("id");
        const nolis = $(this).data('lis');

        let data = {
            nolis: nolis,
            kodeKunjungan: kodeKunjungan
        }


        let btnSend = `btn-sign-Hasillist${kodeKunjungan}`
        let btnPk = `addKj${kodeKunjungan}`


        addSignUser("valid-user-hasillis-Lab", "", btnPk, btnSend, 0, 1, 1,
            "Valid Laboratorium", "")
    });


    $("button[name='signLabValidAction']").off().on("click", function() {

        const kodeKunjungan = $(this).data("id");
        const nolis = $(this).data('lis');

        let data = {
            nolis: nolis,
            kodeKunjungan: kodeKunjungan,
            valid: $("#user_id").val(),
        }
        actionModalValidaton(data)
    });

}



const actionModalValidaton = (props) => {
    postData(props, 'admin/labRequest/updateValidation', (res) => {
        if (res?.respon === true) {
            successSwal("Berhasil")
            $("#labTab").trigger("click")
        } else {
            errorSwal("Gagal")
        }

    })



}


const populateDetailsTable = () => {
    detailsTableBody.innerHTML = '';

    const currentUsername = '<?= user()->username ?>';

    detailsData.forEach((item, index) => {
        const row = document.createElement('tr');
        row.dataset.index = index;

        const isChecked = item.checked;
        const isValidationByMatch = item?.validation_by === currentUsername;
        const isValidationByNull = item?.validation_by === null;

        const canClickCheckbox = isValidationByMatch || isValidationByNull;

        row.innerHTML = `
            <td class="checkbox-col">
                <input type="checkbox" class="rowCheckboxDetails" data-index="${index}" 
                    ${isChecked || !canClickCheckbox ? 'disabled' : ''}>
            </td>
            <td>${index + 1}</td>
            <td>${item.no_registration}</td>
            <td>${item.name_of_pasien}</td>
            <td>${item.treatment}</td>
            `;
        detailsTableBody.appendChild(row);
    });

    attachRowCheckboxListeners('details');
};


moveRightBtn?.addEventListener('click', () => {
    moveSelectedRows('examination', 'details');
});

moveLeftBtn?.addEventListener('click', () => {
    moveSelectedRows('details', 'examination');
});


const moveSelectedRows = (fromTable, toTable) => {
    const selectedCheckboxes = document.querySelectorAll(`.rowCheckbox${capitalize(fromTable)}:checked`);
    const indicesToRemove = [];

    selectedCheckboxes.forEach(checkbox => {
        const index = checkbox.dataset.index;
        indicesToRemove.push(Number(index));
    });

    indicesToRemove.sort((a, b) => b - a);

    indicesToRemove.forEach(index => {
        if (fromTable === 'examination') {
            const movedData = inspectionLIS.splice(index, 1)[0];
            detailsData.push(movedData);
        } else {
            const movedData = detailsData.splice(index, 1)[0];
            inspectionLIS.push(movedData);
        }
    });


    populateExaminationTable();
    populateDetailsTable();


    selectAllExaminations.checked = false;
    selectAllDetails.checked = false;
}

selectAllExaminations?.addEventListener('change', (e) => {
    toggleSelectAll(e.target, 'examination');
});


selectAllDetails?.addEventListener('change', (e) => {
    toggleSelectAll(e.target, 'details');
});


const toggleSelectAll = (selectAllCheckbox, tableType) => {
    const isChecked = selectAllCheckbox.checked;

    const checkboxes = document.querySelectorAll(`.rowCheckbox${capitalize(tableType)}`);

    checkboxes?.forEach(cb => {
        if (!cb.disabled) {
            cb.checked = isChecked;
        }
    });
}



const attachRowCheckboxListeners = (tableType) => {
    const rowCheckboxes = document.querySelectorAll(`.rowCheckbox${capitalize(tableType)}`);
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => checkSelectAllStatus(tableType));
    });
}


const checkSelectAllStatus = (tableType) => {
    const rowCheckboxes = document.querySelectorAll(`.rowCheckbox${capitalize(tableType)}`);
    const selectAllCheckbox = document.querySelector(`#selectAll${capitalize(tableType)}`);
    const allChecked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
    selectAllCheckbox.checked = allChecked;
}


const capitalize = (str) => {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

$("#saveLabLIS").off().on("click", () => {
    const citoCheckbox = $("#citoCheckbox").is(":checked");

    const startDate = $("#startDateLIS").val();
    const endDate = $("#endDateLIS").val();

    const formattedStartDate = convertLabDate(startDate);
    const formattedEndDate = convertLabDate(endDate);
    const start = formattedStartDate ? `${formattedStartDate} 00:00:01` : null;
    const end = formattedEndDate ? `${formattedEndDate} 23:59:59` : null;

    const selectedDetails = detailsData.map(item => ({
        nolis: item?.nolab_lis,
        no_registration: item.no_registration,
        name_of_pasien: item?.name_of_pasien,
        treatment: item.treatment,
        bill_id: item.bill_id,
        name_of_clinic: item.name_of_clinic,
        treat_date: item.treat_date,
        doctor_from: item.doctor_from,
        tagihan: item.tagihan,
        amount: item?.amount,
        sell_price: item?.sell_price,
        visit_id: item.visit_id,
        isrj: item.isrj,
        tarif_id: item.tarif_id,
        nota_no: item.nota_no,
        citoCheckbox
    }));


    const selectinspection = inspectionLIS.map(item => ({
        nolis: item?.nolab_lis,
        no_registration: item.no_registration,
        name_of_pasien: item?.name_of_pasien,
        treatment: item.treatment,
        bill_id: item.bill_id,
        name_of_clinic: item.name_of_clinic,
        treat_date: item.treat_date,
        doctor_from: item.doctor_from,
        tagihan: item.tagihan,
        amount: item?.amount,
        sell_price: item?.sell_price,
        visit_id: item.visit_id,
        isrj: item.isrj,
        tarif_id: item.tarif_id,
        nota_no: item.nota_no,
        citoCheckbox
    }));

    const noRegistrationsList = nomor;

    postData({
        startDate: start,
        endDate: end,
        details: selectedDetails,
        inspection: selectinspection,
        noRegistrationsList: noRegistrationsList
    }, 'admin/labRequest/saveLabLIS', (res) => {
        if (res.status === true) {
            successSwal('Data has been processed successfully.');
            getDataBillLIS({
                noRegis: nomor,
                trans_id: trans,
                startDate: start,
                endDate: end
            });
            getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota, trans)
            // getDataTabels();

        } else {
            errorSwal('Failed to process data.');
        }
    });
});


populateExaminationTable();
populateDetailsTable();

const actionModalBridge = (bill) => {
    let data = JSON.parse(decodeURIComponent(bill));
    postData({
        nota_no: data?.nota_no,
        visit_id: data?.visit_id
    }, 'admin/labRequest/getDataPenunjang', (res) => {

        const imagePreview = $('#imagePreviewBridge');
        const pdfPreview = $('#pdfPreviewBridge');

        if (res.status === 'success') {
            const fileImageBase64 = res.data?.file_image_base64;

            if (fileImageBase64) {
                const fileType = fileImageBase64.split(';')[0].split(':')[1];

                if (fileType === 'application/pdf') {
                    pdfPreview.attr('src', fileImageBase64).show();
                    imagePreview.hide();
                } else if (fileType.startsWith('image/')) {
                    imagePreview.attr('src', fileImageBase64).show();
                    pdfPreview.hide();
                } else {

                    imagePreview.hide();
                    pdfPreview.hide();
                }
            } else {
                imagePreview.hide();
                pdfPreview.hide();
            }
        } else {

            imagePreview.hide();
            pdfPreview.hide();
        }
    });

    // Populate modal with data
    $('#modalJenisTindakanLab').text(data.treatment + ' (' + data.doctor + ')');
    $('#modalTanggalTindakanLab').text(moment(data.treat_date).format('DD/MM/YYYY'));
    $('#modalNilaiTindakanLab').text(formatCurrency(parseFloat(data.tagihan)));
    $('#modalBill').val(data.bill_id);

    $('#formFileBridge').off('change');

    // File input change event handler
    $('#formFileBridge').on('change', (e) => {
        const file = e.target.files[0];
        const fileNameElement = $('#fileName');
        const imagePreview = $('#imagePreviewBridge');
        const pdfPreview = $('#pdfPreviewBridge');

        if (file) {
            fileNameElement.text(file.name).show();

            const reader = new FileReader();
            reader.onload = (event) => {
                const fileType = file.type;
                if (fileType.startsWith('image/')) {
                    imagePreview.attr('src', event.target.result).show();
                    pdfPreview.hide();
                } else if (fileType === 'application/pdf') {
                    pdfPreview.attr('src', event.target.result + '#toolbar=0').show();
                    imagePreview.hide();
                }
            };
            reader.readAsDataURL(file);
        } else {
            fileNameElement.hide();
            imagePreview.hide();
            pdfPreview.hide();
        }
    });

    getDataTabels({
        data: data.bill_id
    });

    // Save button click event handler
    $('#saveBridge').off('click').on('click', async (e) => {
        e.preventDefault();

        let formBridge = document.getElementById('formBridge');
        let formData = new FormData(formBridge);
        let jsonObj = {};

        let filePromises = [];
        formData.forEach((value, key) => {
            if (value instanceof File) {
                filePromises.push(
                    new Promise((resolve, reject) => {
                        let reader = new FileReader();
                        reader.onload = () => {
                            const [mimeType, base64Content] = reader.result
                                ?.split(
                                    ',');
                            const extension = value.name.split('.').pop();
                            resolve({
                                key: key,
                                base64: base64Content,
                                size: value.size,
                                extension: extension
                            });
                        };
                        reader.onerror = reject;
                        reader.readAsDataURL(value);
                    })
                );
            } else {
                jsonObj[key] = value;
            }
        });

        try {
            let files = await Promise.all(filePromises);
            files.forEach(file => {
                jsonObj[file.key] = {
                    "name": file.key,
                    "type": file.base64.split(':')[0],
                    "size": file.size,
                    "extension": file.extension,
                    "content": file.base64
                };
            });
            jsonObj['nota_no'] = data.nota_no
            jsonObj['visit_id'] = data.visit_id;
            jsonObj['bill_id'] = data.bill_id;

            postData(jsonObj, 'admin/labRequest/saveImgToPenunjang', (res) => {
                if (res.status === 'success') {
                    successSwal('Data terkirim');
                    formBridge.reset();

                    $('#formFileBridge').val('');
                    $('#fileName').hide();
                    $('#imagePreviewBridge').hide().attr('src',
                        '');
                    $('#pdfPreviewBridge').hide().attr('src', '');

                    $('#modalBridge').modal('hide');
                } else {
                    console.warn('Data response not successful.');
                    errorSwal('Data belum tersedia');
                }
            });

        } catch (error) {
            console.error('Error converting files to base64:', error);
        }
    });
};


const actionModalHasil = (bill) => {
    let data = JSON.parse(decodeURIComponent(bill));
    postData({
        nota_no: data?.nota_no,
        no_registration: data?.no_registration,
        kode_tarif: data?.tarif_id
    }, 'admin/labRequest/getDataHasilDuplo', (res) => {
        if (res.success === true) {
            if (res?.data.lis_id.toLowerCase().trim() === 'non lis') {
                renderNoHasil(res?.data)
            } else {
                render(res?.data)
            }
        } else {
            renderNoHasil(res?.data)
        }
    });


    const render = (props) => {
        $("#hidden-datatfHasil").empty()

        $('#name_pemeriksaan_valtfHas').replaceWith(
            '<div class="col-md-12" id="name_pemeriksaan_valtfHas"></div>');
        $('#param_name_valtfHas').replaceWith(
            '<div class="col-md-12 text-end" id="param_name_valtfHas"></div>');
        $('#resultHasil_valtfHas').replaceWith('<div class="col-md-12" id="resultHasil_valtfHas"></div>');
        $('#satuan_valtfHas').replaceWith('<div class="col-md-12 text-end" id="satuan_valtfHas"></div>');
        $('#nilairujukan_valtfHas').replaceWith('<div class="col-md-12" id="nilairujukan_valtfHas"></div>');
        $('#fl_valtfHas').replaceWith('<div class="col-md-12 text-end" id="fl_valtfHas"></div>');


        $("#name_pemeriksaan_valtfHas").text(props?.tarif_name ?? data?.treatment)
        $("#param_name_valtfHas").text(props?.parameter_name ?? "-")
        $("#resultHasil_valtfHas").text(props?.hasil ?? "-")
        $("#satuan_valtfHas").text(props?.satuan ?? "-")
        $("#nilairujukan_valtfHas").text(props?.nilai_rujukan ?? "-")
        $("#fl_valtfHas").text(props?.flag_hl ?? "-")
        $("#dupolo_valtfHas").val(props?.duplo_result ?? "")
        $("#catatan_valtfHas").val(props?.catatan ?? "")

        $("#hidden-datatfHasil").html(`
                <input type="hidden" name="norm" id="alabnormdatatfHasil" value="${props?.norm}" class="form-control" >
                <input type="hidden" name="nolab_lis" id="alabnolab_lisdatatfHasil" value="${props?.nolab_lis}" class="form-control">
                <input type="hidden" name="tarif_id" id="alabtarif_iddatatfHasil" value="${props?.tarif_id}" class="form-control">
                <input type="hidden" name="kode_kunjungan" id="alabkode_kunjungandatatfHasil" value="${props?.kode_kunjungan}" class="form-control">
            `)
    }


    const renderNoHasil = (props) => {
        $("#hidden-datatfHasil").empty()

        $('#name_pemeriksaan_valtfHas').replaceWith(function() {
            return $('<input>', {
                type: 'text',
                class: 'form-control col-md-12',
                id: 'name_pemeriksaan_valtfHas',
                name: 'tarif_name',
                value: props?.tarif_name ?? ""
            });
        });
        $('#param_name_valtfHas').replaceWith(function() {
            return $('<input>', {
                type: 'text',
                class: 'form-control col-md-12',
                id: 'param_name_valtfHas',
                name: 'parameter_name',
                value: props?.parameter_name ?? "-"
            });
        });
        $('#resultHasil_valtfHas').replaceWith(function() {
            return $('<input>', {
                type: 'number',
                class: 'form-control col-md-12',
                id: 'resultHasil_valtfHas',
                name: 'hasil',
                value: props?.hasil ?? "-"
            });
        });
        $('#satuan_valtfHas').replaceWith(function() {
            return $('<input>', {
                type: 'text',
                class: 'form-control col-md-12',
                id: 'satuan_valtfHas',
                name: 'satuan',
                value: props?.satuan ?? "-"
            });
        });
        $('#nilairujukan_valtfHas').replaceWith(function() {
            return $('<input>', {
                type: 'text',
                class: 'form-control col-md-12',
                id: 'nilairujukan_valtfHas',
                name: 'nilai_rujukan',
                value: props?.nilai_rujukan ?? "-"
            });
        });
        $('#fl_valtfHas').replaceWith(function() {
            return $('<input>', {
                type: 'text',
                class: 'form-control col-md-12',
                id: 'fl_valtfHas',
                name: 'flag_hl',
                value: props?.flag_hl ?? "-",
                maxlength: 3
            });
        });


        $("#dupolo_valtfHas").val(props?.duplo_result ?? "")
        $("#catatan_valtfHas").val(props?.catatan ?? "")



        $("#hidden-datatfHasil").html(`
                <input type="hidden" name="norm" id="alabnormdatatfHasil" value="${props?.norm ?? props?.no_pasien}" class="form-control" >
                <input type="hidden" name="nolab_lis" id="alabnolab_lisdatatfHasil" value="${props?.nolab_lis}" class="form-control">
                <input type="hidden" name="kode_tarif" id="alabkode_tarifdatatfHasil" value="${props?.kode_tarif ?? data?.tarif_id}" class="form-control">
                <input type="hidden" name="tarif_id" id="alabtarif_iddatatfHasil" value="${props?.tarif_id ?? data?.tarif_id}" class="form-control">
                <input type="hidden" name="kode_kunjungan" id="alabkode_kunjungandatatfHasil" value="${props?.kode_kunjungan}" class="form-control">
                <input type="hidden" name="tgl_hasil_selesai" id="alabtgl_hasil_selesaidatatfHasil" value="${moment(new Date()).format("YYYY-MM-DD HH:mm")}" class="form-control">
                <input type="hidden" name="tgl_specimen" id="alabtgl_specimendatatfHasil" value="${moment(new Date()).format("YYYY-MM-DD HH:mm")}" class="form-control">
                <input type="hidden" name="kel_pemeriksaan" id="alabkel_pemeriksaandatatfHasil" value="${props?.kel_pemeriksaan ?? props?.tarif_name }" class="form-control">
                <input type="hidden" name="lis_id" id="alablis_iddatatfHasil" value="${props?.lis_id  ?? "Non LIS"}" class="form-control">
                <input type="hidden" name="parameter_id" id="alabparameter_iddatatfHasil" value="${props?.parameter_id  ?? (data?.tarif_id + '-01')}" class="form-control">
                <input type="hidden" name="urut_bound" id="alaburut_bounddatatfHasil" value="${props?.urut_bound ??"1"}" class="form-control">
                <input type="hidden" name="id_hasil" id="alabid_hasildatatfHasil" value="${props?.id_hasil ??get_bodyid()}" class="form-control">
                <input type="hidden" name="reg_date" id="alabreg_datedatatfHasil" value="${moment(new Date()).format("YYYY-MM-DD HH:mm")}" class="form-control">
            `)
    }


    $('#saveTfHasil').off('click').on('click', async (e) => {
        e.preventDefault();

        let formHasilLab = document.getElementById('formTfHasilLab');
        let formData = new FormData(formHasilLab);
        let jsonObj = {};


        formData.forEach((value, key) => {
            jsonObj[key] = value;
        });

        postData(jsonObj, 'admin/labRequest/saveToHasillist', (res) => {
            if (res.success === true) {
                successSwal('Data berhasil Di simpan');
                formHasilLab.reset();

                $('#formHasilLab').val('');

                $('#modalTfHasil').modal('hide');
            } else {
                //         console.warn('Data response not successful.');
                errorSwal('Data belum tersedia');
            }
        });


    });
};


$('#formFileBridge').on('change', function(event) {
    const file = event.target.files[0];
    const fileNameElement = document.getElementById('fileName');
    const imagePreview = document.getElementById('imagePreviewBridge');
    const pdfPreview = document.getElementById('pdfPreviewBridge');

    if (file) {
        const fileName = file.name;
        const fileType = file.type;

        fileNameElement.textContent = `Selected file: ${fileName}`;
        fileNameElement.style.display = 'block';

        if (fileType.startsWith('image/')) {
            // Image preview logic
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                pdfPreview.style.display = 'none'; // Hide PDF preview
            };
            reader.readAsDataURL(file);
        } else if (fileType === 'application/pdf') {
            // PDF preview logic
            const reader = new FileReader();
            reader.onload = function(e) {
                pdfPreview.src = e.target.result;
                pdfPreview.style.display = 'block';
                imagePreview.style.display = 'none'; // Hide image preview
            };
            reader.readAsDataURL(file);
        } else {
            // Unsupported file type
            fileNameElement.textContent = 'Unsupported file type';
            imagePreview.style.display = 'none';
            pdfPreview.style.display = 'none';
        }
    } else {
        // No file selected
        fileNameElement.style.display = 'none';
        imagePreview.style.display = 'none';
        pdfPreview.style.display = 'none';
    }
});


// ==============================================================
// const today = moment(new Date()).format("DD/MM/YYYY");
$('#searchBloodRequest').off().on('click', function(e) {
    let sendData = $('#labBloodRequestForm')[0];
    let formData = new FormData(sendData);
    let jsonObj = {};

    formData.forEach((value, key) => {

        if (key === 'start_date' || key === 'end_date') {
            jsonObj[key] = convertLabDate2(value);
        } else {
            jsonObj[key] = value;
        }
    });

    getDataBlood(jsonObj);

})


const initialFlatpicLab = () => {
    flatpickr(".dateflatpickr-lab", {
        enableTime: false,
        dateFormat: "d/m/Y",

        onChange: function(selectedDates, dateStr, instance) {}
    });

    // $(".dateflatpickr-lab").on("change", function() {
    //     let theid = $(this).attr("id")
    //     theid = theid.replace("flat", "")
    //     let thevalue = $(this).val()
    //     let formattedDate = moment(thevalue, 'DD/MM/YYYY HH:mm').format('YYYY-MM-DD HH:mm');
    //     $("#" + theid).val(formattedDate)
    // });
    $(".dateflatpickr-lab").prop("readonly", false)
    // $(".dateflatpickr-lab").val(nowdate).trigger("change")
}

$('#data-allLis').off().on('click', function(e) {
    $("#modalDataAll").modal("show");
    postData({
        noRegis: visit?.no_registration
    }, 'admin/labRequest/getDataAllHasilLIS', (res) => {
        if (res && res.value?.hasillis) {
            renderDataHasillis({
                data: res.value?.hasillis
            })
        } else {
            $("#resultmodalDataAll").html(tempTablesNull());
        }
    }, () => {
        getLoadingGlobalServices('resultmodalDataAll');
    });

})


const renderDataHasillis = (props) => {
    let result = ""

    props?.data?.map((item, index) => {
        result += `<tr>
                            <td class="text-center align-middle">${index + 1}</td>
                            <td class="text-center align-middle">${item?.reg_date ? moment(item?.reg_date).format("DD/MM/YYYY HH:mm") : item?.reg_date ?? "-"}
                            <input name="kodekunjungan" id="addKj${item?.kode_kunjungan}" value="${item?.kode_kunjungan}" type="hidden"> 
                            </td>
                            <td class="text-center align-middle">${item?.tarif_names ? item?.tarif_names.replace(/&nbsp;/g, ' ') : ''}</td>
                            <td class="text-center align-middle">
                                <button type="button" data-id="${item?.kode_kunjungan}" data-date="${item?.reg_date}"  data-source="${item?.source}" data-name="${item?.tarif_names ? item?.tarif_names.replace(/&nbsp;/g, ' ') : ''}"
                                        id="btn-cetak-Hasillist" class="btn btn-secondary hasil-list-btn" name="cari">
                                    <i class="far fa-file"></i> Preview
                                 </button>
                                <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                
                                <button type="button" data-id="${item?.kode_kunjungan}" ${item?.valid_user ? "disabled": ""} data-date="${item?.reg_date}"  data-lis="${item?.nolab_lis}"
                                            id="btn-cetak-Hasillist" class="btn btn-outline-warning" name="signLabValid">
                                        <i class="fa fa-signature"></i> Validator
                                </button>

                                <button hidden type="button" data-id="${item?.kode_kunjungan}" data-date="${item?.reg_date}"  data-lis="${item?.nolab_lis}"
                                        id="btn-sign-Hasillist${item?.kode_kunjungan}" class="btn btn-outline-danger" name="signLabValidAction">
                                    Validator
                                </button>

                                <?php } ?>
                            </td>
                            
                        </tr>`
    });

    $("#resultmodalDataAll").html(result);


    if (props?.data.length === 0) {
        $("#resultmodalDataAll").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`);
    }

    $(".hasil-list-btn").off().on("click", function() {
        const kodeKunjungan = $(this).data("id");
        const regDate = $(this).data("date");
        const source = $(this).data("source");
        let name = $(this).data('name');

        name = name.replace(/&nbsp;/g, ' ');

        const nolist = kodeKunjungan;
        const no_pasien = nomor;
        const visit = <?= json_encode($visit); ?>;

        let start_request = moment(regDate).format("YYYY-MM-DD");
        let end_request = moment(regDate).format("YYYY-MM-DD");

        visit.nolist = nolist;
        visit.no_pasien = no_pasien;
        visit.start_request = start_request;
        visit.end_request = end_request;
        visit.name_files = name;

        const visitString = JSON.stringify(visit);
        const encodedVisit = btoa(unescape(encodeURIComponent(visitString)));

        const endpoint = (source === "PENUNJANG" || source === "KIRIMLIS") ?
            "laboratorium_cetak_review" :
            "laboratorium_cetak";

        const url =
            `<?= base_url() . '/admin/rm/lainnya/' ?>${endpoint}/${encodedVisit}?source=${source}`;

        window.open(url, '_blank');
    });




    $("button[name='signLabValid']").off().on("click", function() {

        const kodeKunjungan = $(this).data("id");
        const nolis = $(this).data('lis');

        let data = {
            nolis: nolis,
            kodeKunjungan: kodeKunjungan
        }


        let btnSend = `btn-sign-Hasillist${kodeKunjungan}`
        let btnPk = `addKj${kodeKunjungan}`


        addSignUser("valid-user-hasillis-Lab", "", btnPk, btnSend, 0, 1, 1,
            "Valid Laboratorium", "")
    });


    $("button[name='signLabValidAction']").off().on("click", function() {

        const kodeKunjungan = $(this).data("id");
        const nolis = $(this).data('lis');

        let data = {
            nolis: nolis,
            kodeKunjungan: kodeKunjungan,
            valid: $("#user_id").val(),
        }
        actionModalValidaton(data)
    });

}

const getDataBlood = (props) => {

    postData(props, 'admin/BloodRequest/getDataFromLab', (res) => {
        if (res.respon) {
            let table = $('#tableFormBloodRequest-Lab').DataTable({
                dom: 'rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
                stateSave: true,
                "bDestroy": true
            });
            table.clear();
            // let container = $('#tbodyLabBloodRequest');
            // container.empty();
            let htmlContent = '';

            <?php

                $bloodUsage = array_filter($aValue, function ($value) {
                    return $value['p_type'] === 'BLOD001';
                });
                $bloodOptions = array_map(fn($value) => ['value' => $value['value_score'], 'desc' => $value['value_desc']], $bloodUsage);
                ?>

            let bloodOptions = [];
            bloodOptions = <?php echo json_encode($bloodOptions); ?>;

            if (typeof bloodOptions === 'object' && !Array.isArray(bloodOptions)) {
                bloodOptions = Object.keys(bloodOptions).map(key => bloodOptions[key]);
            }


            res?.data.forEach(val => {
                const bloodOptionsHtml = bloodOptions
                    .filter(option => option.value == val.blood_usage_type)
                    .map(option =>
                        `<span class="blood-option">${option.desc}</span>`
                    )
                    .join('');
                htmlContent = `
                        
                        <tr>
                            <input type="hidden" name="org_unit_code[]" value="<?= $visit['org_unit_code']; ?>">
                            <input type="hidden" name="visit_id[]" value="<?= $visit['visit_id']; ?>">
                            <input type="hidden" name="trans_id[]" value="<?= $visit['trans_id']; ?>">
                            <input type="hidden" name="no_registration[]" value="<?= $visit['no_registration']; ?>">
                            <input type="hidden" name="clinic_id[]" value="<?= $visit['clinic_id']; ?>">
                            <input type="hidden" name="blood_request[]" value="${val?.blood_request}">
                            <td>
                                <input type="checkbox" data-id="${val?.blood_request}" id="${val?.blood_request}" name="blood_checkbox[]" class="form-check-input" value="0">
                            </td>
                            <td>
                                <label for="${val?.blood_request}" class="fw-bold">${val?.diantar_oleh}</label>
                            </td>
                            <td>
                                <small>
                                    ${bloodOptionsHtml}
                                </small>
                            </td>
                            <td>
                                <small>${val?.blood_quantity}</small>
                            </td>
                            <td>
                                <span class="measure-option">
                                    ${val?.measure_id == 1 ? 'cc' : (val?.measure_id == 56 ? 'kantong' : '')}
                                </span>
                            </td>
                            <td>
                                <span class="blood-type">
                                    ${val?.blood_type_id == 0 ? '-' : 
                                    val?.blood_type_id == 1 ? 'A' :
                                    val?.blood_type_id == 2 ? 'B' :
                                    val?.blood_type_id == 3 ? 'AB' :
                                    val?.blood_type_id == 4 ? 'O' :
                                    val?.blood_type_id == 5 ? '-' :
                                    val?.blood_type_id == 6 ? 'A+' :
                                    val?.blood_type_id == 7 ? 'B+' :
                                    val?.blood_type_id == 8 ? 'AB+' :
                                    val?.blood_type_id == 9 ? 'O+' : 'N/A'}
                                </span>
                            </td>
                            <td>
                                <small>${val?.descriptions}</small>
                            </td>
                            <td>
                                <small>${moment(val?.request_date).isValid() ? moment(val?.request_date).format('DD/MM/YYYY HH:mm') : '-'}</small>
                            </td>
                            <td>
                                <small>${moment(val?.using_time).isValid() ? moment(val?.using_time).format('DD/MM/YYYY HH:mm') : '-'}</small>
                            </td>
                            <td>
                                <input type="text" name="calf_number[]" class="form-control" value="${val?.calf_number ?? ''}">
                            </td>
                            <td>
                                <input type="text" name="delivery_time[]" class="form-control bg-white datepicker-blood-request"
                                value="${moment(val?.delivery_time).isValid() ? moment(val?.delivery_time).format('YYYY-MM-DD HH:mm') : moment().format('YYYY-MM-DD HH:mm')}">

                            </td>
                        </tr>
                        `;

                table.row.add($(htmlContent));
            })
            // container.html(htmlContent);
            table.draw();
            flatpickr('.datepicker-blood-request', {
                dateFormat: 'Y-m-d H:i',
                enableTime: true,
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    // console.log(selectedDates);
                }
            });

            $('#bloodrequest_checkbox').change(function() {
                $('#tbodyLabBloodRequest input[type="checkbox"]').prop('checked', this
                    .checked);
            });

            $('#saveLabBloodRequest').off().on('click', function(e) {
                let arrCheck = [];

                $("input[name='blood_checkbox[]']").each(function(index) {
                    arrCheck.push($(this).prop('checked') ? '1' : '0');
                });

                let sendData = $('#formBloodRequest-Lab')[0];
                let formData = new FormData(sendData);
                let jsonObj = {
                    blood: []
                };

                let blood_request = formData.getAll('blood_request[]');
                let blood_checkbox = formData.getAll('blood_checkbox[]');

                let calf_number = formData.getAll('calf_number[]');
                let delivery_time = formData.getAll('delivery_time[]');
                let clinic_id = formData.getAll('clinic_id[]');
                let no_registration = formData.getAll('no_registration[]');
                let org_unit_code = formData.getAll('org_unit_code[]');
                let trans_id = formData.getAll('trans_id[]');
                let visit_id = formData.getAll('visit_id[]');

                for (let i = 0; i < blood_request.length; i++) {
                    if (arrCheck[i] == '1') {
                        let entry = {
                            blood_request: blood_request[i],
                            blood_checkbox: arrCheck[i],
                            calf_number: calf_number[i],
                            delivery_time: delivery_time[i],
                            clinic_id: clinic_id[i],
                            no_registration: no_registration[i],
                            org_unit_code: org_unit_code[i],
                            trans_id: trans_id[i],
                            visit_id: visit_id[i]
                        };

                        jsonObj.blood.push(entry);
                    }
                }

                if (jsonObj.blood.length > 0) {
                    postData(jsonObj, 'admin/BloodRequest/updateFromLab', (res) => {
                        if (res.respon) {

                            successSwal('Data berhasil Diduplikat.');
                            getDataBlood({
                                visit_id: visit.visit_id,
                                start_date: convertLabDate2($(
                                        "#startDateBloodRequest")
                                    .val()),
                                end_date: convertLabDate2($(
                                        '#endDateBloodRequest')
                                    .val()),
                            });
                        } else {
                            errorSwal(res?.message)
                            getDataBlood({
                                visit_id: visit.visit_id,
                                start_date: convertLabDate2($(
                                        "#startDateBloodRequest")
                                    .val()),
                                end_date: convertLabDate2($(
                                        '#endDateBloodRequest')
                                    .val()),
                            });
                        }
                    });
                } else {
                    errorSwal('Pastikan data dicheck terlebih dahulu')
                }
            })

        }
    });
}
</script>