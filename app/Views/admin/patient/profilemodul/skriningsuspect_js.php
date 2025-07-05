<script>
    $(document).ready(function() {
        getDataServiceTbc()
        btnSaveAssTbc()
        btnShowPopup()
    });


    function handleCheckboxskrining(checkbox, oppositeId) {
        const $oppositeCheckbox = $('#' + oppositeId);

        if ($(checkbox).is(':checked')) {
            $oppositeCheckbox.prop('checked', false);
        }

        let suspected = false;

        $('input[type="checkbox"]').each(function() {
            if ($(this).is(':checked') && $(this).val() === "1") {
                suspected = true;
            }
        });

        $('#conclusion').text(suspected ? 'TERDUGA TBC' : 'BUKAN TERDUGA TBC');
        $("#conclusion-val").val(suspected ? '1' : '0');

    }


    const getDataServiceTbc = (props) => {
        let vDskrining = <?= json_encode($visit) ?>;
        let trans_id = vDskrining?.trans_id

        postData({
            trans_id: trans_id
        }, 'admin/AssTbc/getData', (res) => {
            koppSurat = res?.value?.kop
            if (res?.status === true) {
                renderAssTbcInBiodata({
                    data: res?.value.data
                })
            }

            if (res?.status === false) {
                $("#skriningsuspect").modal("show");
                renderAllDataAssTbc({
                    data: res?.value.data,
                    visit: vDskrining
                })
                $("#button-submit-assTbc").text("save")
            }
            if (props?.data === "get") {
                renderAllDataAssTbc({
                    data: res?.value?.data || [],
                    visit: vDskrining
                });
                $("#skriningsuspect").modal("show");
                $("#button-submit-assTbc").text("Update")
            }


            // $("#skriningsuspect").modal("show");
        })
    }

    const renderAllDataAssTbc = (props) => {
        let dataSkri = props?.data?.length ? props?.data[0] : null;
        let visitData = props?.visit;

        $('#org_unit_code-assTbc').val(dataSkri?.org_unit_code ?? visitData?.org_unit_code);
        $('#visit_id-assTbc').val(dataSkri?.visit_id ?? visitData?.visit_id);
        $('#trans_id-assTbc').val(dataSkri?.trans_id ?? visitData?.trans_id);
        $('#document_id-assTbc').val();
        $('#no_registration-assTbc').val(dataSkri?.no_registration ?? visitData?.no_registration);
        $('#body_id-assTbc').val(dataSkri?.body_id ?? get_bodyid());


        // if (dataSkri) {
        const checkboxes = [{
                name: 'cough',
                value: dataSkri?.cough ?? "0"
            },
            {
                name: 'hemoptisis',
                value: dataSkri?.hemoptisis ?? "0"
            },
            {
                name: 'weight_loss',
                value: dataSkri?.weight_loss ?? "0"
            },
            {
                name: 'hiperhidrosis',
                value: dataSkri?.hiperhidrosis ?? "0"
            },
            {
                name: 'dispnea',
                value: dataSkri?.dispnea ?? "0"
            },
            {
                name: 'close_contact',
                value: dataSkri?.close_contact ?? "0"
            },
            {
                name: 'pneumonia',
                value: dataSkri?.pneumonia ?? "0"
            },
            {
                name: 'diabetes',
                value: dataSkri?.diabetes ?? "0"
            },
            {
                name: 'hiv',
                value: dataSkri?.hiv ?? "0"
            },
            {
                name: 'suspect',
                value: dataSkri?.suspect ?? "0"
            }
        ];

        checkboxes.forEach(({
            name,
            value
        }) => {
            const yesCheckbox = $(`input[name="${name}"][value="1"]`);
            const noCheckbox = $(`input[name="${name}"][value="0"]`);

            if (value === "1") {
                yesCheckbox.prop('checked', true);
                noCheckbox.prop('checked', false);
            } else if (value === "0") {
                yesCheckbox.prop('checked', false);
                noCheckbox.prop('checked', true);
            }
        });

        $('#conclusion-val').val(dataSkri?.suspect ?? "0");
        $('#conclusion').text(dataSkri?.suspect === "1" ? "TERDUGA TBC" : "BUKAN TERDUGA TBC");
        // }
    }
    const renderAssTbcInBiodata = (props) => {
        let data = props?.data?.length ? props?.data[0] : null;
        let fields = [];

        if (data?.cough === "1") fields.push("Batuk");
        if (data?.hemoptisis === "1") fields.push("Batuk darah");
        if (data?.weight_loss === "1") fields.push("Penurunan BB/Nafsu makan");
        if (data?.hiperhidrosis === "1") fields.push("Keringat malam");
        if (data?.dispnea === "1") fields.push("Sesak nafas");
        if (data?.close_contact === "1") fields.push("Kontak erat dengan pasien TBC");
        if (data?.pneumonia === "1") fields.push("Ada hasil rontgen pneumonia/mendukung TBC");
        if (data?.diabetes === "1") fields.push("DM");
        if (data?.hiv === "1") fields.push("HIV");

        let result = ``;
        if (fields.length > 0) {
            $(".biodata .skriningsuspect-header .btn-show-tbc").remove()
            $(".biodata .btn-show-tbc .add").text("")

            result += `<tr>
                    <td colspan="2" class="skriningsuspect-header fw-bold btn btn-link pointer btn-show-tbc text-break">SKRINING SUSPECT TBC (UPDATE)</td>
                </tr>`;
        }

        result += `<tr>
                <td colspan="2">
                    <ul class="result-list">
                `;

        fields.forEach(field => {
            result += `
            <li class="bolds text-break capitalize">${field}</li>
        `;
        });

        result += `     </ul>
                </td>
             </tr>`;

        $(".data-render-assTbc").html(result);
        btnShowPopup()

        $('#cetak-skringtbc').off().click(function(e) {
            e.preventDefault();

            let printElement = document.getElementById('skrining-tbc-view').cloneNode(true);

            $(printElement).find('.modal-footer').remove();

            $(printElement).find('input[type="checkbox"]').each(function() {
                let isChecked = $(this).prop('checked') ? '✔' : '';
                $(this).replaceWith(`<span class="print-checkbox">${isChecked}</span>`);
            });


            let kopSurat = `
                            <div class="row">
                                <div class="col-auto" align="center">
                                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                                </div>
                                <div class="col mt-2">
                                    <h3 class="kop-name-lab text-center" id="kop-name-lab">${koppSurat?.name_of_org_unit || ''}
                                    </h3>
                                    <p class="kop-address-lab text-center" id="kop-address-lab">
                                        ${koppSurat?.contact_address + ',' + koppSurat?.phone + ', Fax:' + koppSurat?.fax + ',' + koppSurat?.kota +
                                            '<br>' + koppSurat?.sk}
                                    </p>
                                </div>
                                <div class="col-auto" align="center">
                                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">

                                </div>
                            </div>
                 `;

            let printWindow = window.open('', '_blank', 'width=800,height=600');

            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Preview</title>
                    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
                    <style>
                    @page { 
                        size: A4 portrait; 
                        margin: 1mm 10mm 10mm 10mm; 
                    }
                    body { font-family: Arial, sans-serif; background-color: white; margin: 0; padding: 0; }
                    .print-container {
                        width: 100%;
                        max-width: 190mm;
                        padding: 10mm;
                        margin: auto;
                        box-sizing: border-box;
                    }
                    .hb-container {
                        display: flex;
                        align-items: flex-start;
                        justify-content: space-between;
                        flex-wrap: nowrap;
                        gap: 15px;
                    }
                    .hb-container .col-md-6 {
                        width: 50%;
                        white-space: nowrap;
                        text-align: left;
                    }
                    .row {
                        display: flex !important;
                        flex-wrap: nowrap !important;
                    }
                    .col-md-6 {
                        width: 50% !important;
                        text-align: left !important;
                    }
                    .print-checkbox {
                        font-size: 14px;
                        font-weight: bold;
                    }
                    @media print {
                        .print-container {
                            page-break-before: auto;
                            width: 100%;
                            max-width: 190mm;
                            padding: 0;
                            margin-top: 0;
                        }
                        table { page-break-inside: avoid; }
                        .hb-container { display: flex; flex-wrap: nowrap; }
                        .hidden-show-ttd { display: block !important; }
                    }
                    </style>
                </head>
                <body>
                    <div class="print-container">
                        ${kopSurat}
                        ${printElement.outerHTML}
                    </div>
                </body>
                </html>
                `);

            printWindow.document.close();

            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                    $(".hidden-show-ttd").attr("hidden", true);
                }, 500);
            };
        });

    }


    const btnSaveAssTbc = (props) => {
        $('#button-submit-assTbc').click(function(e) {
            let formData = document.querySelector('#form-assTbc');
            let dataSend = new FormData(formData);
            let jsonObj = {};

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            postData(jsonObj, 'admin/AssTbc/insertOrUpdateData', (res) => {
                successSwal('Sukses');
                getDataServiceTbc()
                $("#skriningsuspect").modal("hide");

            })

        })


    }


    const btnShowPopup = () => {
        $(".biodata .btn-show-tbc").off().on("click", function(e) {
            getDataServiceTbc({
                data: "get"
            })
        })
    }
</script>