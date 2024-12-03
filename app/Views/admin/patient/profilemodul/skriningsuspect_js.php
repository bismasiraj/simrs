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

        console.log(checkboxes);



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