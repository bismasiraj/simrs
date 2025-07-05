<script type='text/javascript'>
$(document).ready(function(e) {
    // getListRequestRad(nomor, visit)
    declareSearchTarifRad()
    initializeSearchDokterRad("template_nama_dokter");
    initializeSearchTemplateExpertise("template_expertise", "modalExpertise");
    $("#template_jenis_pemeriksaan").select2({
        theme: "bootstrap-5",
        tags: true
    });

    // $("#template_jenis_pemeriksaan").val('usg').trigger('change'); //default selected
    $('#template_expertise').on("select2:select", function(e) {
        const selectedData = e.params.data;

        $('#modalHasilBaca').val(selectedData.hasil_baca)
        $('#modalKesimpulan').val(selectedData.kesimpulan)
    });

    $('#isKritisExpertise').click(function(e) {
        const currentValue = $('#modalIsKritis').val();

        $('#modalIsKritis').val(currentValue == 0 ? 1 : 0);
    })
    $('#isValidExpertise').click(function(e) {
        const currentValue = $('#modalIsValid').val();

        $('#modalIsValid').val(currentValue == 0 ? 1 : 0);
        if ($(this).hasClass('btn-outline-primary')) {
            $(this).html('Tervalidasi')
                .removeClass('btn-outline-primary')
                .addClass('btn-primary');
        } else {
            $(this).html('Validasi')
                .removeClass('btn-primary')
                .addClass('btn-outline-primary');
        }
    })

})
const declareSearchTarifRad = () => {
    initializeSearchTarif("searchTarifRad", 'P016');
    $("#searchTarifRad").on('select2:select', function(e) {
        $("#btnAddChargesRad").click();
        $("#searchTarifRad").click();
        $('html,body').animate({
                scrollTop: $("#searchTarifRad").offset().top - 50
            },
            'slow', 'swing');
        $("#searchTarifRad").click()
        $("#searchTarifRad").select2('open')
    });
}
$("#radTab").on("click", function() {
    $('#notaNoRad').html(`<option value="%">Semua</option>`)

    getTreatResultList(nomor, visit.visit_id)
    getListRequestRad(nomor, visit.visit_id)
    getBillPoli(nomor, ke, mulai, akhir, lunas, 'P016', rj, status, nota, trans)
    // var seen = {};
    // $('#notaNoRad option').each(function() {
    //     if (seen[$(this).val()]) {
    //         $(this).remove();
    //     } else {
    //         seen[$(this).val()] = true;
    //     }
    // });
    getDataAllRadiologiApi({
        visit: visit
    })

    getDataLatterSendRad({
        visit_id: visit?.visit_id,
        visit: visit
    })

    $('#coverkopSuratPengantarRad').hide();
    $("#searchTarifRad").show();
    $("#btnAddChargesRad").attr("onclick", 'addBillRad("searchTarifRad")');
    if ($('#searchTarifRadDinamis').data('select2')) {
        $("#searchTarifRadDinamis").select2('destroy').hide();
    }
    $("#select-show-rad-tarif").hide();

})
$("#formSaveBillRadBtn").on("click", function() {
    $("#radChargesBody").find("button.simpanbill:not([disabled])").trigger("click")
})
$("#notaNoRad").on("change", function() {
    filterBillRad()

    const selectedValue = $("#notaNoRad").val();
    if (dataTarifSelect.includes(selectedValue)) {
        if ($('#searchTarifRad').data('select2')) {
            $("#searchTarifRad").select2('destroy').hide();
        }

        initializeSearchTarifDinamisRad();
        $("#select-show-rad-tarif, #searchTarifRadDinamis").show();
        $("#btnAddChargesRad").attr("onclick", 'addBillRad("searchTarifRadDinamis")');
    } else {
        initializeSearchTarif("searchTarifRad", 'P016');
        $("#searchTarifRad").show();
        $("#btnAddChargesRad").attr("onclick", 'addBillRad("searchTarifRad")');
        if ($('#searchTarifRadDinamis').data('select2')) {
            $("#searchTarifRadDinamis").select2('destroy').hide();
        }
        $("#select-show-rad-tarif").hide();
    }


})

$("#btn_cari_template_rad").off().on("click", function(e) {
    e.preventDefault();
    getDataTemplate();

});


const getDataAllRadiologiApi = (props) => {
    postData({
        noreq: props?.visit?.no_registration
    }, 'admin/radrequest/getDataAll', (res) => {
        window.diagDescRad = res?.value?.diag?.diagnosadesc ?? ""
        if (res && res.value) {
            renderKopRad({
                kop: res?.value?.kop || {}
            })
            dataRenderTarifSelectOptionRad({
                data: res?.value?.select
            })

        }
    })
}

const getDataLatterSendRad = (props) => {
    postData({
        visit_id: props?.visit_id
    }, 'admin/radRequest/getDataCoverLatter', (res) => {
        if (res?.respon === true) {

            dataTarifSelect = res?.dataTables?.map(e => e.nota_no)
            renderDataTablesLetterSendRad({
                data: res,
                visit: visit
            })
        } else {
            $("#hasilbodylistLatterRad").html(`<tr style="height: 200px;">
                                    <td colspan="100" class="align-middle text-center">
                                        <h3 class="text-center">Data Kosong</h3>
                                    </td>
                                </tr>`);
        }
    })

    // renderLatterSendCheckRad()
}

const renderDataTablesLetterSendRad = (props) => {
    let result = '';
    props?.data?.dataTables.map((e, index) => {
        if (!$("#notaNoRad option").filter(function() {
                return $(this).val() === e?.nota_no;
            }).length) {
            $("#notaNoRad").append($("<option>").val(e?.nota_no).text(e?.nota_no));
        }
        result += `<tr>
                    <td>${index + 1}</td>            
                    <td class="text-center">${e?.nota_no}</td>            
                    <td>
                        <button type="button" class="btn btn-warning btn-show-render-latter-rad" autocomplete="off" data-index="${index}">
                            <i class="fa fa-edit">Check</i>
                        </button><button type="button" data-index="${index}" class="btn btn-secondary btn-print-render-latter-rad" name="cari">
                                <i class="far fa-file"></i> Cetak
                        </button>`;

        if (e.terlayani === 0) {
            if (e.modified_by === "<?= user()->username; ?>") {
                result += `
                            <button type="button" class="btn btn-danger btn-delete-latter-rad" data-nota_no="${e.nota_no}" autocomplete="off">
                                <i class="fa fa-trash"></i>
                            </button>`;
            }
        }
        result += `</td></tr>`;
    });

    $("#hasilbodylistLatterRad").html(result);
    renderShowtemplateLetterRad({
        data: props?.data?.dataTables,
        visit: props?.visit
    });
    deleteDataTableLatterSendRad({
        visit: visit
    });
};


const renderShowtemplateLetterRad = (props) => {
    $('.btn-show-render-latter-rad').on('click', function(e) {

        let index = $(this).data('index');
        // let item = getDataLatterLabAll[index];
        let item = props?.data[index]

        $("#coverkopSuratPengantarRad").slideUp()
        $("#coverkopSuratPengantarRad").slideDown()
        renderLatterSendCheckRad({
            data: item,
            visit: visit
        })

        $('a[href="#coverSendFisioterapi"]').addClass('active');
        $('.datetime-now').html(moment(new Date()).format('DD-MM-YYYY HH:mm'))

        // $('#JfisioDocument').show();

    })
    $('.btn-print-render-latter-rad').off().on('click', function(e) {
        let index = $(this).data('index');
        // let item = getDataLatterLabAll[index];
        let item = props?.data[index]

        let notaNo = item?.nota_no

        openPopUpTab(
            '<?= base_url() . 'admin/rm/medis/surat_pengantar_cetak/' . base64_encode(json_encode($visit)); ?>' +
            '/' + notaNo + '/' + 'P016')

    })
}

const deleteDataTableLatterSendRad = (props) => {
    $('.btn-delete-latter-rad').off().on('click', function(e) {
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
                deleteRequestRadLatter({
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

const deleteRequestRadLatter = (props) => {
    postData({
        nota_no: props?.nota_no
    }, 'admin/radRequest/deleteCoverLatter', (res) => {
        successSwal('Sukses');
        $("#notaNoRad option").filter(function() {
            return $(this).val() === props?.nota_no;
        }).remove();
        getDataLatterSendRad({
            visit_id: visit?.visit_id,
            visit: visit
        })
        $("#coverkopSuratPengantarRad").slideUp()
        // $("#JfisioDocument").slideUp()

    })
}


const renderLatterSendCheckRad = (props) => {
    if (props?.data) {
        if (props?.data?.modified_by === '<?= user()->username; ?>') {
            $("#save-form-rad-cover-latter").show();
        } else {
            $("#save-form-rad-cover-latter").hide();
        }
    } else {
        $("#save-form-rad-cover-latter").show();


    }

    let result = props?.data
    let resultTemplate = props?.visit
    let nameValueVisit2 = [
        'diantar_oleh', 'age', 'no_registration',
        'visitor_address', 'gendername'
    ];

    nameValueVisit2?.forEach(name => {
        let id = `${name}-val2-rad-latter`;
        let value = resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).text(value);
        }
    });


    $("#date_of_birth-val2-rad-latter").text(moment(resultTemplate?.date_of_birth).format("DD/MM/YYYY"))

    let nameValueHidden = [
        'visit_id', 'trans_id', "no_registration", "employee_id",
        "patient_category_id", "isrj", "ageyear", "agemonth", "ageday", "status_pasien_id", "gender",
        "class_room_id", "bed_id", "keluar_id",
    ];

    nameValueHidden?.forEach(name => {
        let id = `${name}-rad-val-rad-latter`;
        let value = result?. [name] ?? resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).val(value);
        }
    });


    let nota_noGenerate = get_bodyid()
    $("#org_unit_code-rad-val-rad-latter").val("-")
    $("#clinic_id-rad-val-rad-latter").val("P016")
    $("#clinic_id_from-rad-val-rad-latter").val(result?.clinic_id_from ?? visit.clinic_id)
    $("#employee_id_from-rad-val-rad-latter").val(result?.employee_id_from ?? '<?= user()->employee_id; ?>')
    $("#nota_no-rad-val-rad-latter").val(result?.nota_no ?? nota_noGenerate)
    $("#document_id-rad-val-rad-latter").val(result?.document_id ?? resultTemplate?.session_id)
    $("#validation-rad-val-rad-latter").val(result?.validation ?? 0)
    $("#terlayani-rad-val-rad-latter").val(result?.terlayani ?? 0)
    $("#iscito-rad-val-rad-latter").val(result?.iscito ?? 0)
    $("#thename-rad-val-rad-latter").val(result?.thename ?? resultTemplate?.diantar_oleh)
    $("#theaddress-rad-val-rad-latter").val(result?.theaddress ?? resultTemplate?.contact_address)
    $("#theid-rad-val-rad-latter").val(result?.theid ?? resultTemplate?.pasien_id)
    $("#doctor-rad-val-rad-latter").val(result?.doctor ?? resultTemplate?.fullname)
    $("#perujuk-rad-val-rad-latter").val(result?.perujuk ?? resultTemplate?.employee_id_from)
    $("#diagnosa_desc-rad-val-rad-latter").val(result?.diagnosa_desc ?? null)
    $("#descriptions-rad-val-rad-latter").val(result?.descriptions ?? null)
    $("#treat_date-rad-val-rad-latter").val(result?.treat_date ? moment(result?.treat_date).format(
        "DD/MM/YYYY HH:mm") : moment(new Date()).format("DD/MM/YYYY HH:mm"))


    flatpickr('#treat_date-rad-val-rad-latter', {
        dateFormat: 'd/m/Y H:i',
        enableTime: true,
        time_24hr: true,
        onChange: function(selectedDates, dateStr, instance) {
            // console.log(selectedDates);
        }
    });

    $("#treat_date-rad-val-rad-latter").prop("readonly", false)

}

const renderKopRad = (props) => {
    let {
        kop
    } = props
    $('.kop-name-rad').text(kop?.name_of_org_unit || '');
    $('.kop-address-rad').html(kop?.contact_address + ',' + kop?.phone + ', Fax:' + kop?.fax + ',' + kop?.kota +
        '<br>' + kop?.sk
    );
}

$('#add-new-doc-coverkopLetterSendRad').on('click', function() {
    renderLatterSendCheckRad({
        visit: visit
    })
    $("#coverkopSuratPengantarRad").slideUp()
    $("#coverkopSuratPengantarRad").slideDown();
    $('#coverkopSuratPengantarRad').show();
});

$("#save-form-rad-cover-latter").off().on('click', function() {
    saveFormRadCoverLatter((res) => {
        if (res.respon) {
            successSwal(res.message)
            getDataLatterSendRad({
                visit_id: visit?.visit_id,
                visit: visit
            })
            $("#coverkopSuratPengantarRad").slideUp()
            $('#coverkopSuratPengantarRad').show();

        } else {
            errorSwal(res.message)
            getDataLatterSendRad({
                visit_id: visit?.visit_id,
                visit: visit
            })

        }
    })
})
const saveFormRadCoverLatter = (res) => {
    const diagnosaDesc = $("#diagnosa_desc-rad-val-rad-latter").val();
    const descriptionsRad = $("#descriptions-rad-val-rad-latter").val();

    if (!diagnosaDesc || diagnosaDesc.trim() === "") {
        errorSwal("diagnosa harus diisi.");
        $("#diagnosa_desc-rad-val-rad-latter").focus();
        return;
    }

    if (!descriptionsRad || descriptionsRad.trim() === "") {
        errorSwal("Deskripsi tambahan harus diisi.");
        $("#descriptions-Rad-val-Rad-latter").focus();
        return;
    }

    let formData = document.querySelector('#form-rad-cover-latter');
    let dataSend = new FormData(formData);
    let jsonObj = {};
    dataSend.forEach((value, key) => {
        if (key === "treat_date") {
            let formattedDate = moment(value, "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm")
            jsonObj[key] = formattedDate;
        } else {
            jsonObj[key] = value;
        }
    });


    postData(jsonObj, 'admin/radRequest/actionCoverLatter', res);
}

$("#sign-form-rad-cover-latter").off().on('click', function() {
    signLatterRad()
    // $("#save-form-rad-cover-latter").trigger("click")
})
const signLatterRad = () => {
    saveFormRadCoverLatter((res) => {
        if (res.respon) {
            addSignUser("form-rad-cover-latter", "", "nota_no-rad-val-rad-latter",
                "save-form-rad-cover-latter", 14, 1, 1, "Permohonan Radiologi", "valid_user")
        } else {
            errorSwal(res.message)
            getDataLatterSendRad({
                visit_id: visit?.visit_id,
                visit: visit
            })
        }
    })
}

$('.radiologi-tab a[data-bs-toggle="tab"]').on('click', function() {
    $('#coverkopSuratPengantarRad').hide();
});


function initializeSearchTarifDinamisRad() {
    const orgUnitCode = $("#select-show-rad-tarif").val();

    $("#searchTarifRadDinamis").select2({
        placeholder: "Input Tarif",
        width: 'resolve',
        ajax: {
            url: '<?= base_url(); ?>admin/radRequest/getDatatariftreatData',
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                    org_unit_code: $("#select-show-rad-tarif").val()
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

const dataRenderTarifSelectOptionRad = (props) => {
    let result = ''
    props?.data?.map(e => {
        result += `<option value="${e.org_unit_code}">${e.perda_no}</option>`
    })

    $("#select-show-rad-tarif").html(`<option value="%" seleted>Pilih Tempat</option>` + result)
}
</script>
<script type='text/javascript'>
function isnullcheck(parameter) {
    return parameter == null ? 0 : (parameter)
}

function getTreatResultList(nomor, visit_id) {
    $.ajax({
        url: '<?php echo base_url(); ?>admin/radrequest/getTreatResultList',
        type: "POST",
        data: JSON.stringify({
            'nomor': nomor,
            'visit': visit.visit_id,
            'clinic_id': 'P016',
            'trans_id': visit?.trans_id
        }),
        dataType: 'json',
        contentType: false,
        cache: false,
        beforeSend: function() {
            $("#radBody").html(loadingScreen())
        },
        processData: false,
        success: function(data) {

            $("#radBody").html("")
            mrJson = data
            mrJson.forEach((element, key) => {


                $("#radBody").append($("<tr>")
                    .append($("<td class='text-center align-middle'>").append($("<p>").html(
                        mrJson[key]
                        .pickup_date)))
                    .append($("<td class='text-center align-middle'>")
                        .append($("<p>").html(mrJson[key].tarif_name))
                        .append($("<p class='badge " + (mrJson[key].isvalid == 1 ?
                            "bg-primary" : "bg-danger") + " py-1 px-2'>").html(mrJson[key]
                            .isvalid == 1 ? 'TERVALIDASI' : 'BELUM VALIDASI'))
                        .append($("<p class='" + (mrJson[key].iskritis == 1 ?
                            "badge py-1 px-2 mx-2 bg-danger" : "d-none") + "'>").html(
                            'KRITIS'))
                    )

                    // .append($("<td>").html('<?= $visit['name_of_clinic']; ?>'))
                    .append($("<td class='text-center align-middle'>").append(
                        '<div role="group" aria-label="Vertical button group">' +
                        '<button id="' + 'arad' + 'expertise' + '" ' + 'data-bill="' +
                        mrJson[key].bill_id + '" ' + 'onclick="actionModalExpertise(\'' +
                        encodeURIComponent(JSON.stringify(mrJson[key])) + '\',\'' + 'arad' +
                        '\')" ' +
                        'type="button" data-bs-toggle="modal" data-bs-target="#modalExpertise" ' +
                        'class="btn btn-outline-primary waves-effect waves-light" data-row-id="1" autocomplete="off" ' +
                        '>Hasil</button>'))
                )

            });
        },
        error: function() {

        }
    });
}

function getListRequestRad(nomor, visit) {


    // $.ajax({
    //     url: '<?php echo base_url(); ?>admin/rekammedis/getListRequestRad',
    //     type: "POST",
    //     data: JSON.stringify({
    //         'nomor': nomor,
    //         'visit': visit
    //     }),
    //     dataType: 'json',
    //     contentType: false,
    //     cache: false,
    //     processData: false,
    //     success: function(data) {


    //         hasilradJson = data

    //         $("#listRequestRad").html("")


    //         hasilradJson.forEach((element, key) => {
    //             console.log(element)
    //             $("#listRequestRad").append('<div class="col-md-3"> <div class = "card bg-light border border-1 rounded-4 m-4" ><div class = "card-body" ><h3> Periksa Radiologi </h3> <p> Tanggal ' + element.vactination_date + ' </p> <div class = "text-end" ><a class = "btn btn-secondary" href="<?= base_url(); ?>/admin/rekammedis/getRadOnlineRequest/' + btoa('<?= json_encode($visit); ?>') + '/' + element.vactination_id + '" target="_blank"> Lihat </a> </div> </div> </div> </div>')
    //         });
    //     },
    //     error: function() {

    //     }
    // });
}

function requestRad() {
    url = '<?php echo base_url(); ?>admin/rekammedis/radOnlineRequest/' + btoa('<?= json_encode($visit); ?>')

    window.open(url, "_blank")
}
const addNotaRad = () => {
    nota_no = get_bodyid()
    $("#notaNoRad").append($("<option>").val(nota_no).text(nota_no))
    $("#notaNoRad").val(nota_no)
    $("#radChargesBody").html("")

    return nota_no;
}

function addBillRad(container) {
    var nota_no = $("#notaNoRad").val();
    let sesi = '<?= $visit['session_id']; ?>';

    // if (nota_no == '%') {
    //     $("#notaNoRad").find(`option[value='${sesi}']`).remove()
    //     nota_no = sesi
    //     $("#notaNoRad").append($("<option>").val(nota_no).text(nota_no))
    //     $("#notaNoRad").val(nota_no)
    //     $("#radChargesBody").html("")
    //     // getBillPoli(nomor, ke, mulai, akhir, lunas, 'P013', rj, status, nota_no, trans)
    // }

    if (nota_no == '%') {
        nota_no = addNotaRad()
    }

    setTimeout(() => {
        tarifDataJson = $("#" + container).val();
        tarifData = JSON.parse(tarifDataJson);

        $("#searchTarifRad").val(null).trigger('change');

        let tarifIds = [];
        $('#radChargesBody input[name="tarif_id[]"]').each(function() {
            tarifIds.push($(this).val());
        });

        let filtterData = billJson.filter(e => e?.clinic_id === "P016" && e?.nota_no === nota_no)

        let resultDilter = filtterData.map(e => ({
            tarif_id: e.tarif_id,
            nota_no: e.nota_no
        }));
        let tarifIdsInResult = resultDilter.map(e => e.tarif_id);


        if (!(tarifIds.includes(tarifData.tarif_id) || tarifIdsInResult.includes(tarifData.tarif_id))) {
            let codeData = get_bodyid();
            var i = $('#radChargesBody tr.number').length + 1;

            var key = 'rad' + i
            $("#radChargesBody").append($("<tr id=\"arad" + key + "\" class='number " + (billJson?.bill_id ??
                    codeData) + "'>")
                .append($("<td>").html(String(i) + "."))
                .append($("<td>").attr("id", "araddisplaytreatment" + key).html(tarifData.tarif_name)
                    .append($(
                        "<p>").html(
                        '<?= $visit['fullname']; ?>')))
                .append($("<td>").html('<select id="arademployee_id' + key +
                    '" class="form-select" name="employee_id[]" onchange="changeFullnameDoctor(\'arad\',\'' +
                    key +
                    '\')">' +
                    chargesDropdownDoctor("arad") +
                    `</select>` +
                    '<input id="araddoctor' + key +
                    '" class="form-control" style="display: none" type="text" readonly>'
                ))
                .append($("<td class=\"d-none\">").html('<select id="arademployee_id_from' + key +
                    '" class="form-select" name="employee_id_from[]" onchange="changeFullnameDoctor(\'arad\',\'' +
                    '_from' + key +
                    '\')">' +
                    chargesDropdownDoctor("arad") +
                    `</select>` +
                    '<input id="araddoctor' + key +
                    '" class="form-control" style="display: none" type="text" readonly>'
                ))
                .append($("<td>").attr("id", "araddisplaytreat_date" + key).html(moment().format(
                        "DD/MM/YYYY HH:mm"))
                    .append($("<p>").html('<?= $visit['name_of_clinic']; ?>')))
                // .append($("<td>").attr("id", "iscetak" + key).html(billJson[key].iscetak))
                .append($("<td>").attr("id", "araddisplaysell_price" + key).html(formatCurrency(parseFloat(
                    tarifData
                    .amount))).append($("<p>").html("")))
                .append($("<td>")
                    .append('<input type="text" name="quantity[]" id="aradquantity' + key +
                        '" placeholder="" value="0" class="form-control" readonly>')
                    .append($("<p>").html('<?= $visit['name_of_status_pasien']; ?>'))
                )
                .append($("<td>").attr("id", "araddisplayamount_paid" + key).html(formatCurrency(parseFloat(
                    tarifData
                    .amount))))
                // .append($("<td>").attr("id", "araddisplayamount_paid_plafond" + key).html(formatCurrency(0)))
                // .append($("<td>").attr("id", "araddisplaydiscount" + key).html(formatCurrency(0)))
                // .append($("<td>").attr("id", "araddisplaysubsidisat" + key).html(formatCurrency(0)))
                // .append($("<td>").attr("id", "araddisplaysubsidi" + key).html(formatCurrency(0)))
                // .append($("<td>").append('<button id="aradsimpanBillBtn' + key + '" type="button" onclick="simpanBillCharge(\'' + key + '\', \'arad\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">Simpan</button><div id="aradeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-radel="Vertical button group" style="display: none"><div class="btn-group-vertical" role="group" aria-radel="Vertical button group"><button id="editBillBtn' + key + '" type="button" onclick="editBillCharge(\'arad\', \'' + key + '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="delBillBtn' + key + '" type="button" onclick="delBill(\'arad\', \'' + key + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>'))
                .append($("<td rowspan='2' class='align-middle'>")
                    .append(
                        '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                        '<div class="btn-group-vertical" role="group" aria-label="Vertical button group">' +
                        '<button id="aradsimpanBillBtn' + key +
                        '" type="button" onclick="simpanBillCharge(\'' +
                        key +
                        '\', \'arad\')" class="btn btn-info waves-effect waves-light simpanbill" data-row-id="1" autocomplete="off">simpan</button>' +
                        '<button id="aradeditDeleteCharge' + key +
                        '" type="button" onclick="editBillCharge(\'arad\', \'' +
                        key +
                        '\')"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off"  style="display: none">Edit</button>' +
                        '<button id="delBillBtn' + key + '" type="button" onclick="delBill(\'arad\', \'' +
                        key +
                        '\')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button>' +
                        '</div>' +
                        '</div>')
                )
            )

            $("#radChargesBody").append($("<tr>", {
                    style: "height: 80px;",
                    class: key + ' ' + (billJson?.bill_id ?? codeData)
                })
                .append($("<td>"))
                .append($("<td>").attr("colspan", "2").html(`
                        <div class="form-group">
                        <label class="form-label fw-bold">Diagnosis Klinis</label>
                            <div class="input-group">
                                <input id="araddiagnosa_descrad${i}" 
                                    class="form-control fit" 
                                    style="width: 70%;" 
                                    placeholder="Diagnosis Klinis" 
                                    name="diagnosa_desc[]" 
                                    value="${i === 1 ? window.diagDescRad : $(`#araddiagnosa_descrad${i - 1}`).val()}">
                            </div>
                        </div>
                    `))
                .append($("<td>").attr("colspan", "4").html(`
                        <div class="form-group">
                            <label class="form-label fw-bold">Indikasi Medis</label>
                            <div class="input-group">
                                <input id="aradindication_descrad${i}" 
                                    class="form-control fit" 
                                    style="width: 70%;" 
                                    placeholder="Indikasi Medis" 
                                    name="indication_desc[]" 
                                    value="${i === 1 ? "" : $(`#aradindication_descrad${i - 1}`).val()}">
                            </div>
                        </div>
                    `)).append($("<td>", {
                    style: "display: none;"
                }).html(`
           <input type="hidden" name="quantity[]" id="aradquantity${key}" value="0" class="form-control">
            <input type="hidden" name="treatment[]" id="aradtreatment${key}" value="${tarifData.tarif_name}" class="form-control">
            <input type="hidden" name="treat_date[]" id="aradtreat_date${key}" value="${get_date()}" class="form-control">
                <input type="hidden" name="sell_price[]" id="aradsell_price${key}" value="${tarifData.amount}" class="form-control">
                <input type="hidden" name="amount_paid[]" id="aradamount_paid${key}" value="${tarifData.amount}" class="form-control">
                <input type="hidden" name="discount[]" id="araddiscount${key}" value="0" class="form-control">
                <input type="hidden" name="subsidisat[]" id="aradsubsidisat${key}" value="0" class="form-control">
                <input type="hidden" name="subsidi[]" id="aradsubsidi${key}" value="0" class="form-control">
                <input type="hidden" name="bill_id[]" id="aradbill_id${key}" value="${billJson?.bill_id ?? codeData}" class="form-control">
                <input type="hidden" name="trans_id[]" id="aradtrans_id${key}" value="<?= $visit['trans_id']; ?>" class="form-control">
                <input type="hidden" name="no_registration[]" id="aradno_registration${key}" value="<?= $visit['no_registration']; ?>" class="form-control">
                <input type="hidden" name="theorder[]" id="aradtheorder${key}" value="${billJson?.length + 1}" class="form-control">
                <input type="hidden" name="visit_id[]" id="aradvisit_id${key}" value="<?= $visit['visit_id']; ?>" class="form-control">
                <input type="hidden" name="org_unit_code[]" id="aradorg_unit_code${key}" value="<?= $visit['org_unit_code']; ?>" class="form-control">
                <input type="hidden" name="class_id[]" id="aradclass_id${key}" value="<?= $visit['class_id']; ?>" class="form-control">
                <input type="hidden" name="class_id_plafond[]" id="aradclass_id_plafond${key}" value="<?= $visit['class_id_plafond']; ?>" class="form-control">
                <input type="hidden" name="payor_id[]" id="aradpayor_id${key}" value="<?= $visit['payor_id']; ?>" class="form-control">
                <input type="hidden" name="karyawan[]" id="aradkaryawan${key}" value="<?= $visit['karyawan']; ?>" class="form-control">
                <input type="hidden" name="theid[]" id="aradtheid${key}" value="<?= $visit['pasien_id']; ?>" class="form-control">
                <input type="hidden" name="thename[]" id="aradthename${key}" value="<?= $visit['diantar_oleh']; ?>" class="form-control">
                <input type="hidden" name="theaddress[]" id="aradtheaddress${key}" value="<?= $visit['visitor_address']; ?>" class="form-control">
                <input type="hidden" name="status_pasien_id[]" id="aradstatus_pasien_id${key}" value="<?= $visit['status_pasien_id']; ?>" class="form-control">
                <input type="hidden" name="isrj[]" id="aradisrj${key}" value="<?= $visit['isrj']; ?>" class="form-control">
                <input type="hidden" name="gender[]" id="aradgender${key}" value="<?= $visit['gender']; ?>" class="form-control">
                <input type="hidden" name="ageyear[]" id="aradageyear${key}" value="<?= $visit['ageyear']; ?>" class="form-control">
                <input type="hidden" name="agemonth[]" id="aradagemonth${key}" value="<?= $visit['agemonth']; ?>" class="form-control">
                <input type="hidden" name="ageday[]" id="aradageday${key}" value="<?= $visit['ageday']; ?>" class="form-control">
                <input type="hidden" name="kal_id[]" id="aradkal_id${key}" value="<?= $visit['kal_id']; ?>" class="form-control">
                <input type="hidden" name="karyawan[]" id="aradkaryawan${key}" value="<?= $visit['karyawan']; ?>" class="form-control">
                <input type="hidden" name="class_room_id[]" id="aradclass_room_id${key}" value="<?= $visit['class_room_id']; ?>" class="form-control">
                <input type="hidden" name="bed_id[]" id="aradbed_id${key}" value="<?= $visit['bed_id']; ?>" class="form-control">
                <input type="hidden" name="clinic_id[]" id="aradclinic_id${key}" value="P016" class="form-control">
                <input type="hidden" name="clinic_id_from[]" id="aradclinic_id_from${key}" value="<?= $visit['clinic_id']; ?>" class="form-control">
                <input type="hidden" name="exit_date[]" id="aradexit_date${key}" value="${get_date()}" class="form-control">
                <input type="hidden" name="cashier[]" id="aradcashier${key}" value="<?= user_id(); ?>" class="form-control">
                <input type="hidden" name="modified_from[]" id="aradmodified_from${key}" value="<?= user()->username ?>" class="form-control">
                <input type="hidden" name="islunas[]" id="aradislunas${key}" value="0" class="form-control">
                <input type="hidden" name="measure_id[]" id="aradmeasure_id${key}" value="" class="form-control">
                <input type="hidden" name="tarif_id[]" id="aradtarif_id${key}" value="${tarifData.tarif_id}" class="form-control">
                <input type="hidden" name="body_id[]" id="aradbody_id${key}" value="${tarifData.body_id ?? '<?= @$visit['session_id'] ?>'}" class="form-control">
                <input type="hidden" name="doctor_from[]" id="araddoctor_from${key}" class="form-control">
                 `))
            );



            if ('<?= $visit['isrj']; ?>' == '0') {
                $("#aclass_room_id" + key).val('<?= $visit['class_room_id']; ?>');
                $("#abed_id" + key).val('<?= $visit['bed_id']; ?>');

                if (visit?.employee_id_from == null && visit?.employee_id_from != '') {
                    $("#arademployee_id_from" + key).val(visit.employee_id_from)
                    $("#araddoctor_from" + key).val(visit.fullname_from)
                } else {
                    $("#arademployee_id_from" + key).val(visit.employee_inap)
                    $("#araddoctor_from" + key).val(visit.fullname_inap)
                }

            } else {
                if (visit?.employee_id_from == null && visit?.employee_id_from != '') {
                    $("#arademployee_id_from" + key).val(visit.employee_id_from)
                    $("#araddoctor_from" + key).val(visit.fullname_from)
                } else {
                    $("#arademployee_id_from" + key).val(visit.employee_inap)
                    $("#araddoctor_from" + key).val(visit.fullname_inap)
                }
            }
            $("#arademployee_id_from" + key).val('<?= user()->employee_id; ?>')
            $("#araddoctor_from" + key).val('<?= user()->getFullname(); ?>')
            $("#arademployee_id" + key).val('<?= user()->employee_id; ?>')
            $("#araddoctor" + key).val('<?= user()->getFullname(); ?>')

            $("#radChargesBody")
                // .append('<input name="doctor[]" id="araddoctor' + key +
                //     '" type="hidden" value="' + visit.fullame + '" class="form-control" />')
                .append('<input name="amount[]" id="aradamount' + key + '" type="hidden" value="' + tarifData
                    .amount +
                    '" class="form-control" />')
                .append('<input name="nota_no[]" id="aradnota_no' + key + '" type="hidden" value="' + nota_no +
                    '" class="form-control" />')
                .append('<input name="profesi[]" id="aradprofesi' + key +
                    '" type="hidden" value="" class="form-control" />')
                .append('<input name="tagihan[]" id="aradtagihan' + key + '" type="hidden" value="' + tarifData
                    .amount * $(
                        "#aradquantity" + key).val() + '" class="form-control" />')
                .append('<input name="treatment_plafond[]" id="aradtreatment_plafond' + key +
                    '" type="hidden" value="' +
                    tarifData.amount + '" class="form-control" />')
                .append('<input name="tarif_type[]" id="aradtarif_type' + key + '" type="hidden" value="' +
                    tarifData
                    .tarif_type + '" class="form-control" />')

            if ('<?= $visit['class_id']; ?>' != '<?= $visit['class_id_plafond']; ?>') {

                var tarifKelas = getPlafond('<?= $visit['class_id_plafond']; ?>', tarifData.tarif_name,
                    tarifData
                    .isCito);
                if (tarifKelas > 0 && '<?= $visit['payor_id']; ?>' != 0 &&
                    '<?= $visit['class_id_plafond']; ?>' !=
                    99) {

                    $("#radChargesBody").append('<input name="amount_plafond[]" id="aradamount_plafond' + key +
                        '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                    $("#radChargesBody").append(
                        '<input name="amount_paid_plafond[]" id="aradamount_paid_plafond' +
                        key +
                        '" type="hidden" value="' + tarifKelas + '" class="form-control" />')
                    $("#radChargesBody").append('<input name="class_id_plafond[]" id="aradclass_id_plafond' +
                        key +
                        '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />'
                    )
                    $("#radChargesBody").append('<input name="tarif_id_plafond[]" id="aradtarif_id_plafond' +
                        key +
                        '" type="hidden" value="' + tarifData.tarif_id + '" class="form-control" />')
                } else {

                    $("#radChargesBody").append('<input name="amount_plafond[]" id="aradamount_plafond' + key +
                        '" type="hidden" value="0" class="form-control" />')
                    $("#radChargesBody").append(
                        '<input name="amount_paid_plafond[]" id="aradamount_paid_plafond' +
                        key +
                        '" type="hidden" value="0" class="form-control" />')
                    $("#radChargesBody").append('<input name="class_id_plafond[]" id="aradclass_id_plafond' +
                        key +
                        '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />'
                    )
                    $("#radChargesBody").append('<input name="tarif_id_plafond[]" id="aradtarif_id_plafond' +
                        key +
                        '" type="hidden" value="" class="form-control" />')
                }
            } else {

                $("#radChargesBody").append('<input name="amount_plafond[]" id="aradamount_plafond' + key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#radChargesBody").append('<input name="amount_paid_plafond[]" id="aradamount_paid_plafond' +
                    key +
                    '" type="hidden" value="0" class="form-control" />')
                $("#radChargesBody").append('<input name="class_id_plafond[]" id="aradclass_id_plafond' + key +
                    '" type="hidden" value="<?= $visit['class_id_plafond']; ?>" class="form-control" />')
                $("#radChargesBody").append('<input name="tarif_id_plafond[]" id="aradtarif_id_plafond' + key +
                    '" type="hidden" value="" class="form-control" />')
            }

            $("#aradquantity" + key).keydown(function(e) {
                !0 == e.shiftKey && e.preventDefault(), e.keyCode >= 48 && e.keyCode <= 57 || e
                    .keyCode >=
                    96 && e
                    .keyCode <= 105 || 8 == e.keyCode || 9 == e.keyCode || 37 == e.keyCode || 39 == e
                    .keyCode || 46 == e
                    .keyCode || 190 == e.keyCode || e.preventDefault(), -1 !== $(this).val().indexOf(
                        ".") &&
                    190 == e
                    .keyCode && e.preventDefault();
            });
            $('#aradquantity' + key).on("input", function() {
                var dInput = this.value;
                $("#aradamount_paid" + key).val($("#aradamount" + key).val() * dInput)
                $("#araddisplayamount_paid" + key).html(formatCurrency($("#aradamount" + key).val() *
                    dInput))
                $("#aradtagihan" + key).val($("#aradamount" + key).val() * dInput)
                $("#aradamount_paid_plafond" + key).val($("#aradamount_plafond" + key).val() * dInput)
                $("#araddisplayamount_paid_plafond" + key).html(formatCurrency($("#aradamount_plafond" +
                        key).val() *
                    dInput))
            })
        } else {
            errorSwal("Tarif sudah Ada ")
            let indexLenghtLabTable = $("#radChargesBody tr.number").length;
            if (indexLenghtLabTable === 0) {
                getBillPoli(nomor, ke, mulai, akhir, lunas, 'P016', rj, status, nota_no, trans)

            }
        }

    }, 500);

}
</script>
<script>
function filterBillRad() {
    $("#radChargesBody").html("")
    var notaNoRad = $("#notaNoRad").val()
    billJson.forEach((element, key) => {
        if (billJson[key].clinic_id == 'P016' && (billJson[key].nota_no == notaNoRad || '%' == notaNoRad)) {
            var i = $('#radChargesBody tr').length + 1;
            var counter = 'rad' + i
            addRowBill("radChargesBody", "arad", key, i, counter)
        }
    })
}
</script>

<!-- ================================== -->

<script>
$("#searchEXP").off().on("click", function() {
    const start = moment($("#startDateEXP").val()).format("YYYY-MM-DD") + " 00:00:01";
    const end = moment($("#endDateEXP").val()).format("YYYY-MM-DD") + " 23:59:59";
    const visit_id = <?= json_encode($visit['visit_id']); ?>;
    getDataBillEXP({
        visit_id: visit_id,
        startDate: start,
        endDate: end
    })
});



const getDataBillEXP = (props) => {
    const visit_id = props?.visit_id;
    const startDate = props?.startDate;
    const endDate = props?.endDate;

    if (!visit_id) {
        console.error('Visit ID provided.');
        return;
    }

    const requestData = {
        visit_id: visit_id,
    };

    if (startDate && endDate) {
        requestData.startDate = startDate;
        requestData.endDate = endDate;
    }

    postData(requestData, 'admin/radRequest/getData', (res) => {
        if (res && res.value) {
            const {
                inspection,
                expertise
            } = res.value;


            inspectionEXP = inspection || [];
            detailsDataEXPEXP = expertise || [];

            populateExaminationTableEXP();
            populateDetailsTableEXP();
        } else {
            console.error('Response data is missing expected properties.');
        }
    }, (beforesend) => {
        // getLoadingGlobalServices('examinationTableEXP tbody')
        // getLoadingGlobalServices('detailsTableEXP tbody')
        // $("#bodydata").html(loadingScreen())
    });
}



const actionModalExpertise = (bill, identifier) => {

    let data = JSON.parse(decodeURIComponent(bill));
    jsonObj = {};
    initializeSearchTemplateExpertise1({
        theid: "template_expertise",
        employee_id: data?.employee_id
    });
    jsonObj.bill_id = data?.bill_id
    jsonObj.visit_id = data?.visit_id
    $('#template_jenis_pemeriksaan').val([]).trigger('change');
    postData(jsonObj, 'admin/radRequest/getDataByID', (res) => {

        imagesRad = []
        $('#formFileExpertise').css('border', '');
        $('#formFileExpertise1').css('border', '');
        $('#formFileExpertise2').css('border', '');
        $('#formFileExpertise3').css('border', '');
        $('#formFileExpertise4').css('border', '');

        if (res.respon) {
            $('#modalJenisTindakan').text(res?.data.tarif_name + ' (' + res?.data.doctor +
                ')') // perubahan bagian ini dari data.doctor ke res.doctor
            $('#modalTanggalTindakan').text(moment(data.treat_date).format('DD-MM-YYYY'))
            $('#modalNilaiTindakan').text(data.tagihan)
            $('#modalBill').val(data.bill_id)
            $('#modalVisit').val(data.visit_id)

            let diagnosa_desc = res?.data?.diagnosa_desc;
            let indication_desc = res?.data?.indication_desc;

            if (diagnosa_desc == null || diagnosa_desc === '') {
                diagnosa_desc = data?.diagnosa_desc ?? res?.data?.diagnosa_desc;
            }
            if (indication_desc == null || indication_desc === '') {
                indication_desc = data?.indication_desc ?? res?.data?.indication_desc;
            }

            $('#diagnosisExpertise').val(diagnosa_desc);
            $('#indikasiExpertise').val(indication_desc);

            $('#modalNoFilm').val(res?.data.specimen_id)
            $('#modalHasilBaca').val(res?.data.result_value)
            $('#modalKesimpulan').val(res?.data.conclusion)
            $('#modalIsValid').val(res?.data.isvalid)
            $('#printExpertise').attr('data-id', res?.data?.result_id)
            if ($('#modalIsValid').val() == '1') {
                $('#isValidExpertise').html('Tervalidasi');
                $('#isValidExpertise').removeClass('btn-outline-primary');
                $('#isValidExpertise').addClass('btn-primary');
                $('#batalExpertise').attr('disabled', false)
            } else {
                $('#isValidExpertise').html('Validasi');
                $('#isValidExpertise').removeClass('btn-primary');
                $('#isValidExpertise').addClass('btn-outline-primary');
                $('#batalExpertise').attr('disabled', false)
            }
            $('#modalIsKritis').val(res.data.iskritis)
            if ($('#modalIsKritis').val() == '1') {
                $('#isKritisExpertise').html('Nilai Kritis &#10003;');
                $('#isKritisExpertise').removeClass('btn-outline-primary');
                $('#isKritisExpertise').addClass('btn-primary');
            } else {
                $('#isKritisExpertise').html('Nilai Kritis');
                $('#isKritisExpertise').removeClass('btn-primary');
                $('#isKritisExpertise').addClass('btn-outline-primary');
            }


            function pushFile(base64Data, indexLabel) {
                const type = detectFileType(base64Data);
                if (!type || type === 'unknown') return;

                const labelPrefix = type === 'pdf' ? 'PDF' : 'Gambar';
                imagesRad.push({
                    data: base64Data,
                    page: `${labelPrefix} ${indexLabel}`,
                    type: type
                });
            }

            pushFile(res.data?.treat_image, 1);
            pushFile(res.data?.file_a, 2);
            pushFile(res.data?.file_b, 3);
            pushFile(res.data?.file_c, 4);
            pushFile(res.data?.file_d, 5);


            if (res.data?.treat_image) {
                $('#formFileExpertise').css('border', '2px solid red');
            } else {
                $('#formFileExpertise').css('border', '');
            };

            if (res.data?.file_a) {
                $('#formFileExpertise1').css('border', '2px solid red');

            } else {
                $('#formFileExpertise1').css('border', '');
            };

            if (res.data?.file_b) {
                $('#formFileExpertise2').css('border', '2px solid red');

            } else {
                $('#formFileExpertise2').css('border', '');
            };

            if (res.data?.file_c) {
                $('#formFileExpertise3').css('border', '2px solid red');

            } else {
                $('#formFileExpertise3').css('border', '');
            };

            if (res.data?.file_d) {
                $('#formFileExpertise4').css('border', '2px solid red');

            } else {
                $('#formFileExpertise4').css('border', '');
            };;





            // $("#formFileExpertise3").val(base_url + res.data.treat_image)
            // }

            printExpertise({
                result_id: res?.data?.result_id
            });


        } else {
            $('#modalJenisTindakan').text(data?.treatment + ' (' + data?.doctor + ')')
            $('#modalTanggalTindakan').text(moment(data.treat_date).format('DD-MM-YYYY'))
            $('#modalNilaiTindakan').text(data.tagihan)
            $('#modalBill').val(data.bill_id)
            $('#modalVisit').val(data.visit_id)
            $('#imagePreviewExpertise').attr('src', '').hide();
            $('#isValidExpertise').html('Validasi');
            $('#isValidExpertise').removeClass('btn-primary');
            $('#isValidExpertise').addClass('btn-outline-primary');
            $('#isKritisExpertise').html('Nilai Kritis');
            $('#isKritisExpertise').removeClass('btn-primary');
            $('#isKritisExpertise').addClass('btn-outline-primary');
            $('#batalExpertise').attr('disabled', true)
            resetForm();
        }

        renderCarousel()


    });

    function detectFileType(base64) {
        if (!base64) return null;
        if (base64.startsWith('data:application/pdf')) return 'pdf';
        if (base64.startsWith('data:image')) return 'image';
        return 'unknown';
    }
    const renderCarousel = () => {
        let dataResult = "";



        imagesRad.forEach((e, index) => {
            let content = "";

            if (e.type === "image") {
                content =
                    `<img src="${e.data}" class="d-block w-100" alt="Slide ${index + 1}" style="max-width: 70%; max-height: 300px; object-fit: contain; margin: auto;">`;
            } else if (e.type === "pdf") {
                content =
                    `<iframe src="${e.data}" type="application/pdf" width="100%" height="400px" style="border: none;"></iframe>`;
            }

            dataResult += `
            <div class="carousel-item ${index === imagesRad.length - 1 ? 'active' : ''}">
                <h5 class="text-center">${e.page}</h5>
                ${content}
            </div>
        `;
        });

        $("#data-render-all-Expertise").html(dataResult);
        $("#carouselExample").carousel(imagesRad.length - 1);
    };


    $(".formFileExpertise").off().on("change", function(event) {
        const files = event.target.files;
        let indexFileGam = $(this).data('index');

        if (files.length > 0) {
            Array.from(files).forEach((file) => {
                const reader = new FileReader();
                if (file.type.startsWith("image/")) {
                    reader.onload = function(e) {
                        imagesRad.push({
                            type: "image",
                            data: e.target.result,
                            page: `Gambar ${indexFileGam}`
                        });
                        renderCarousel();
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === "application/pdf") {


                    reader.onload = function(e) {
                        imagesRad.push({
                            type: "pdf",
                            data: e.target.result,
                            page: `PDF ${indexFileGam}`
                        });
                        renderCarousel();
                    };
                    reader.readAsDataURL(file);
                } else {
                    errorSwal("Mohon mengirimkan berkas dengan format gambar atau PDF.");
                    event.target.value = "";
                }
            });
        }
    });



    function handleFileChange(inputId, labelId, hiddenInputId) {
        $(inputId).on("change", function() {
            let fileLabel = $(labelId);
            let hiddenInput = $(hiddenInputId);

            if (this.files.length > 0) {
                fileLabel.text(this.files[0].name);
                hiddenInput.val("");
            } else {
                fileLabel.text(hiddenInput.val() ? hiddenInput.val().split('/').pop() : "Pilih file");
            }
        });
    }

    $('.isValidExpertise').off().on('click', function() {
        const currentValue = $("#modalIsValid").val();

        $("#modalIsValid").val(currentValue == 0 ? 1 : 0)
        if ($(this).hasClass('btn-outline-primary')) {
            $(this).html('Tervalidasi')
                .removeClass('btn-outline-primary')
                .addClass('btn-primary');
        } else {
            $(this).html('Validasi')
                .removeClass('btn-primary')
                .addClass('btn-outline-primary');
        }
    });


    function resetForm() {
        $('#modalNoFilm').val('');
        $('#modalHasilBaca').val('');
        $('#modalKesimpulan').val('');
        $('#formFileExpertise').val('')
        $('#modalIsValid').val(0)
        $('#modalIsKritis').val(0)
        $('#diagnosisExpertise').val('');
        $('#indikasiExpertise').val('');
        $('#printExpertise').attr('data-id', '')
    }
    //new 19-12-2024
    const printExpertise = (props) => {
        $('#printExpertise').off().on('click', function(e) {
            e.preventDefault();

            let visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'

            // Construct the URL
            let url = '<?= base_url() . '/admin/rm/LAINNYA/radiologi_cetak/'; ?>' + visit.visit_id +
                '/' +
                props?.result_id;

            // Redirect to the URL
            window.open(url, '_blank'); // Open in a new tab
        })
    }


    $('#saveExpertise').off().on('click', function(e) {
        e.preventDefault();
        let formExpertise = document.querySelector('#formExpertise');
        let formData = new FormData(formExpertise)

        $.ajax({
            url: '<?php echo base_url(); ?>admin/radRequest/insertExpertise',
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                successSwal('Data berhasil disimpan');
                $("#modalExpertise").modal("hide")
                $(`[data-id="${identifier}quantity${data.bill_id}"]`).val(data.treat_bill
                    .quantity)
                $(`[data-id="${identifier}displayamount_paid${data.bill_id}"]`).html(data
                    .treat_bill.amount_paid)
                $('#formExpertise')[0].reset(); // reset semua input
                $('#formExpertise input[type="file"]').val('');
                getTreatResultList(nomor, visit.visit_id)
                // $(`#${identifier}quantity${data.treat_bill.bill_id}`).val(data.treat_bill.quantity)
                // $(`#${identifier}displayamount_paid${data.treat_bill.bill_id}`).val(data.treat_bill.amount_paid)
            },
            error: function() {
                errorSwal('Data gagal disimpan');
                $("#modalExpertise").modal("hide")
            }
        });
    });

    $('#batalExpertise').off().on('click', function() {
        let formElement = document.getElementById('formExpertise');
        let dataSend = new FormData(formElement);
        let jsonObj = {};

        dataSend.forEach((value, key) => {
            jsonObj[key] = value;
        });
        postData(jsonObj, 'admin/radRequest/cancelExpertise', (res) => {
            let data = res.data;
            if (res.status) {
                successSwal(res.message)
                $("#modalExpertise").modal("hide")
                $(`[data-id="${identifier}quantity${res.bill_id}"]`).val(data.quantity)
                $(`[data-id="${identifier}displayamount_paid${res.bill_id}"]`).html(data
                    .amount_paid)
            } else {
                errorSwal('data gagal dikembalikan')
                $("#modalExpertise").modal("hide")
            }
        });
    });
};

// document.getElementById('formFileExpertise').addEventListener('change', function(event) {
//     const file = event.target.files[0];
//     if (file) {
//         if (file.type.startsWith('image/')) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 const img = document.getElementById('imagePreviewExpertise');
//                 img.src = e.target.result;
//                 img.style.display = 'block';
//             };
//             reader.readAsDataURL(file);
//         } else {
//             errorSwal('mohon mengirimkan berkas dengan format gambar.');
//             event.target.value = '';
//         }
//     }
// });
$("#formFileExpertise").on("change", function(event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById('imagePreviewExpertise');
    const pdfPreview = document.getElementById('pdfPreviewExpertise');

    if (file) {
        const reader = new FileReader();

        if (file.type.startsWith('image/')) {
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                if (pdfPreview) pdfPreview.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else if (file.type === 'application/pdf') {
            reader.onload = function(e) {
                if (pdfPreview) {
                    pdfPreview.src = e.target.result;
                    pdfPreview.style.display = 'block';
                }
                imagePreview.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            errorSwal('Mohon mengirimkan berkas dengan format gambar atau PDF.');
            event.target.value = '';
            imagePreview.style.display = 'none';
            if (pdfPreview) pdfPreview.style.display = 'none';
        }
    }
});


const getDataTemplate = () => {
    let formElement = document.getElementById('form-template-rad');
    let dataSend = new FormData(formElement);
    let jsonObj = {};

    dataSend.forEach((value, key) => {
        jsonObj[key] = value;
    });

    postData(jsonObj, 'admin/radRequest/getDataTemplate', (res) => {
        if (res.respon) {

            let data = res.data;
            const table = $('#tableTemplate').DataTable({
                dom: "tr<'row'<'col-sm-4'p><'col-sm-4 text-center'i><'col-sm-4 text-end'l>>",
                stateSave: true,
                "bDestroy": true
            });
            table.clear();
            let htmlContent = '';
            data?.forEach((element, key) => {
                htmlContent = `
                        <tr>
                            <th class="text-center">${key + 1}</th>
                            <td class="text-center">${element?.treatment}</td>
                            <td class="text-center">
                                <button type="button" id="radTemplate-${element?.radiologi_bacaan_id}" 
                                        onclick="showDataTemplate('${btoa(encodeURIComponent(JSON.stringify({
                                            radiologi_bacaan_type: element?.radiologi_bacaan_type,
                                            treatment: element?.treatment,
                                            hasil_baca: element?.hasil_baca,
                                            kesan: element?.kesan
                                        })))}')" 
                                        class="btn btn-sm btn-primary" data-id="${element?.radiologi_bacaan_id}">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </td>
                        </tr>
                    `;




                table.row.add($(htmlContent));
            });

            table.draw();

        }
    });
}

function showDataTemplate(data) {
    $("#modalTemplateExpertise").modal('show')
    const dataDecode = JSON.parse(decodeURIComponent(atob(data)));

    $('#modalTemplateType').val(dataDecode?.radiologi_bacaan_type)
    $('#modalTemplateTreatment').val(dataDecode?.treatment)
    $('#modalTemplateHasilBaca').html(dataDecode?.hasil_baca)
    $('#modalTemplateKesimpulan').html(dataDecode?.kesan)
}

function showDataTemplate(data) {
    $("#modalTemplateExpertise").modal('show')
    const dataDecode = JSON.parse(decodeURIComponent(atob(data)));

    $('#modalTemplateType').val(dataDecode?.radiologi_bacaan_type)
    $('#modalTemplateTreatment').val(dataDecode?.treatment)
    $('#modalTemplateHasilBaca').html(dataDecode?.hasil_baca)
    $('#modalTemplateKesimpulan').html(dataDecode?.kesan)
}
$('#imagePreviewExpertise').on('click', function() {

})

function initializeSearchTemplateExpertise1(props) {

    $("#" + props?.theid).select2({
        theme: "bootstrap-5",
        dropdownParent: "#modalExpertise",
        placeholder: "Masukkan Template",
        ajax: {
            url: '<?= base_url(); ?>admin/radRequest/getTemplateExpertise',
            type: "post",
            dataType: 'json',
            delay: 50,
            data: function(params) {
                return {
                    searchTerm: params.term,
                    employee_id: props?.employee_id
                };
            },
            processResults: function(response) {
                $("#" + props?.theid).val(null).trigger('change');
                return {
                    results: response
                };
            },
            cache: true
        }
    });
}

const printExpertise = (props) => {
    $('#printExpertise').off().on('click', function(e) {
        e.preventDefault();

        let visitEncoded = '<?= base64_encode(json_encode($visit)); ?>'

        // Construct the URL
        let url = '<?= base_url() . '/admin/rm/LAINNYA/radiologi_cetak/'; ?>' + visitEncoded + '/' +
            props?.result_id;

        // Redirect to the URL
        window.open(url, '_blank'); // Open in a new tab
    })
}

$('#data-allradiologi').off().on('click', function(e) {
    $("#modalDataAllRadiologi").modal("show");
    postData({
        nomor: nomor,
        visit: visit.visit_id,
        clinic_id: 'P016',
        trans_id: visit?.trans_id
    }, 'admin/radrequest/getTreatResultListAll', (res) => {
        if (res) {
            renderDataHasilRadiologi({
                data: res
            })
        } else {
            $("#resultmodalDataAllRadiologi").html(tempTablesNull());
        }
    }, () => {
        getLoadingGlobalServices('resultmodalDataAllRadiologi');
    });

})


const renderDataHasilRadiologi = (props) => {
    let result = ""

    props?.data?.map((item, index) => {
        result += `<tr>
                            <td class="text-center align-middle">${index + 1}</td>
                            <td class="text-center align-middle">${item?.pickup_date ? moment(item?.pickup_date).format("DD/MM/YYYY HH:mm") : item?.pickup_date ?? "-"}
                            </td>
                            <td class="text-center align-middle">
                                <p>
                                    ${item?.tarif_name ? item.tarif_name.replace(/&nbsp;/g, ' ') : ''}
                                </p>
                                <p class="badge ${item?.isvalid == 1 ? 'bg-primary' : 'bg-danger'} py-1 px-2">
                                    ${item?.isvalid == 1 ? 'TERVALIDASI' : 'BELUM VALIDASI'}
                                </p>
                                <p class="${item?.iskritis == 1 ? 'badge py-1 px-2 mx-2 bg-danger' : 'd-none'}">
                                    KRITIS
                                </p>
                            </td>

                            <td class="text-center align-middle">
                                <div role="group" aria-label="Vertical button group">
                                    <button 
                                        id="aradexpertise" 
                                        data-bill="${item?.bill_id}" 
                                        onclick="actionModalExpertise('${encodeURIComponent(JSON.stringify(item))}', 'arad')" 
                                        type="button" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalExpertise" 
                                        class="btn btn-outline-primary waves-effect waves-light" 
                                        data-row-id="1" 
                                        autocomplete="off"
                                    >
                                        Hasil
                                    </button>
                                </div>
                            </td>

                            
                        </tr>`
    });

    $("#resultmodalDataAllRadiologi").html(result);


    if (props?.data.length === 0) {
        $("#resultmodalDataAllRadiologi").html(`<tr style="height: 200px;">
                                        <td colspan="100" class="align-middle text-center">
                                            <h3 class="text-center">Data Kosong</h3>
                                        </td>
                                    </tr>`);
    }
}
</script>
<script>
const quillEditor = document.querySelectorAll('.quill-textarea-radiologi');

quillEditor.forEach(function(editor, index) {
    const quill = new Quill(editor, {
        theme: 'snow',
    });

    const hiddenInput = document.getElementById(`${editor.id}-hidden`);

    quill.on('text-change', () => {
        const quillContent = quill.root.innerHTML; // Get the current content of the Quill editor
        hiddenInput.value = quillContent; // Update the hidden input value
    });
});
</script>