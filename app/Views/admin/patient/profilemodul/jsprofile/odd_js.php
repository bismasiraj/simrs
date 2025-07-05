<script type="text/javascript">
const getDataOdd = (props) => {
    postData({
        visit_id: props.visit_id,
        start: props?.start ? moment(props?.start, "DD/MM/YYYY").format("YYYY-MM-DD 00:01") : moment(
            new Date()).format("YYYY-MM-DD 00:01"),
        end: props?.end ? moment(props?.end, "DD/MM/YYYY").format("YYYY-MM-DD 23:59") : moment(
            new Date()).format("YYYY-MM-DD 23:59"),
    }, 'admin/odd/getData', (res) => {
        if (res.length >= 1) {
            $("#save-tabelsOdd").removeAttr("disabled");
            defaultTest({
                data: res
            })
        } else {
            $("#save-tabelsOdd").attr("disabled", "disabled");
            $("#bodydataOdd").html(tempTablesNull())
        }
    }, (beforesend) => {
        console.log("Loading...");
        getLoadingGlobalServices('bodydataOdd')
        // $("#bodydataOdd").html(loadingScreen())
    })
}

$("#oddTab").off().on("click", function(e) {
    e.preventDefault();

    getLoadingscreen("contentToHideOdd", "load-content-odd")

    let defaultDateOdd = moment(new Date()).format("DD/MM/YYYY")

    $("#startDateOdd").val(defaultDateOdd)
    $("#endDateOdd").val(defaultDateOdd)

    getDataOdd({
        visit_id: visit?.visit_id,
        start: defaultDateOdd,
        end: defaultDateOdd
    });

    flatpickr(".datetimeflatpickr-Odd-show", {
        enableTime: true,
        dateFormat: "d/m/Y",
        time_24hr: true,
    });

    $(".datetimeflatpickr-Odd-show").prop("readonly", false)
});


$("#btn-search-odd").off().on("click", function(e) {
    e.preventDefault();
    getDataOdd({
        visit_id: visit?.visit_id,
        start: $("#startDateOdd").val(),
        end: $("#endDateOdd").val()
    });
});



const defaultTest = (data) => {

    let resultData = '';
    const uniqueStatusObat = Array.from(new Set(data.data.map(e => e?.status_obat || "Obat telah diberikan")));

    data.data.forEach(e => {
        let statusObatValue = e?.status_obat ||
            "Obat telah diberikan";

        let options = `
            <option value="Obat telah diberikan" ${statusObatValue === "Obat telah diberikan" ? "selected" : ""}>Obat telah diberikan</option>
            <option value="Pasien menolak" ${statusObatValue === "Pasien menolak" ? "selected" : ""}>Pasien menolak</option>
            <option value="Alergi" ${statusObatValue === "Alergi" ? "selected" : ""}>Alergi</option>
            <option value="Kondisi pasien menyebabkan ditundanya pemberian obat" ${statusObatValue === "Kondisi pasien menyebabkan ditundanya pemberian obat" ? "selected" : ""}>Kondisi pasien menyebabkan ditundanya pemberian obat</option>
            <option value="Reaksi efek samping obat" ${statusObatValue === "Reaksi efek samping obat" ? "selected" : ""}>Reaksi efek samping obat</option>
            <option value="Obat tidak tersedia" ${statusObatValue === "Obat tidak tersedia" ? "selected" : ""}>Obat tidak tersedia</option>
        `;
        options += uniqueStatusObat.map(status => {
            return `<option value="${status}" ${statusObatValue === status ? "selected" : ""}>${status}</option>`;
        }).join('');

        resultData += `
            <tr data-vactination-id="${e.vactination_id}">
                <td>${e.description}</td>
                <td><input class="form-check-input checkboxOdd" type="checkbox" value="" id="flexCheckDefault"></td>
                <td><input class="form-control flatpickdatetime-odd " type="text" disabled name="datetime" value="${e?.received_date ? moment(e?.received_date).format("DD/MM/YYYY HH:mm"): ""}" ></td>
                <td><div class="qty">${!e.quantity || parseFloat(e.quantity) === 0 ? 0 : parseInt(e.quantity)}</div></td>
                <td><input class="form-control quantity-input" type="number" name="quantity" min="0" value="${!e.quantity || parseFloat(e.quantity_detail) === 0 ? 0 : parseInt(e.quantity_detail, 10)}" max="${!e.quantity || parseFloat(e.quantity) === 0 ? 0 : parseInt(e.quantity, 10)}" disabled></td>
                <td>${e.description2}</td>
                <td style="display: none;">${e.bill_id}</td>
                <td style="display: none;">${e.vactination_id}</td>
                <td>${e.signa_4}</td>
                <td>
                    <select class="form-select status-obat select-odd-obat w-100" name="status_obat" disabled>
                        ${options} 
                    </select>
                </td>
            </tr>`;
    });

    $("#bodydataOdd").html(resultData);

    $('.select-odd-obat').select2({
        tags: true,
        placeholder: "Pilih status obat",
        allowClear: false,
        width: "100%"
    });

    flatpickr(".flatpickdatetime-odd", {
        enableTime: true,
        dateFormat: "d/m/Y H:i",
        time_24hr: true,
    });

    $(".flatpickdatetime-odd").prop("readonly", false);

    check(data);
    saveAction();
};



const saveAction = () => {
    $("#save-tabelsOdd").off().on("click", e => {

        let table = document.getElementById('tablesOdd');
        let rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        let dataToSave = [];

        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            let checkbox = row.querySelector('.checkboxOdd');


            if (checkbox.checked) {
                let description = row.cells[0].textContent;
                let datetime = row.querySelector('.flatpickdatetime-odd').value;
                let qtySend = row.querySelector('.quantity-input').value;
                let qtyResep = row.cells[3].textContent;
                let description2 = row.cells[5].textContent;
                let bill_id = row.cells[6].textContent;
                let vactination_id = row.cells[7].textContent;
                let status_obat_element = row.querySelector('.status-obat');
                let status_obat = status_obat_element ? status_obat_element.value : null;

                dataToSave.push({
                    description: description,
                    datetime: moment(datetime, "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm"),
                    qtySend: qtySend,
                    qtyResep: qtyResep,
                    description2: description2,
                    bill_id: bill_id,
                    status_obat: status_obat,
                    vactination_id: vactination_id
                    // valid_date: valid_date,
                    // valid_user: valid_user
                });
                // checkbox.checked = false;
            }
        }
        if (dataToSave.length > 0) {
            postData(dataToSave, 'admin/odd/updateData', (res) => {
                successSwal('Data Telah di Perbarui.');
                getDataOdd({
                    visit_id: visit?.visit_id,
                    start: $("#startDateOdd").val(),
                    end: $("#endDateOdd").val()
                });
            })
        } else {
            console.log('Tidak ada baris yang dipilih untuk disimpan.');
        }
    })
}

const check = (props) => {
    props.data.forEach(item => {
        let tr = $(`tr[data-vactination-id="${item.vactination_id}"]`);
        let checkbox = tr.find('.checkboxOdd');
        let datetimeInput = tr.find('.flatpickdatetime-odd');
        let quantityInput = tr.find('.quantity-input');
        let selectOddInput = tr.find('.select-odd-obat');

        if (0 < item.quantity_detail) {
            checkbox.prop('checked', true);
            datetimeInput.prop('disabled', false);
            quantityInput.prop('disabled', false);
            selectOddInput.prop('disabled', false);

            let defaultDate = moment(item.received_date).format("DD/MM/YYYY HH:mm");
            datetimeInput.val(defaultDate);
            quantityInput.val(parseInt(item?.quantity));
            if (item.valid_user) {
                datetimeInput.prop('disabled', true);
                quantityInput.prop('disabled', true)
                checkbox.prop('disabled', true);
                selectOddInput.prop('disabled', true);

                $("#save-tabelsOdd").attr("disabled", "disabled");

                let defaultDate = moment(item.received_date).format("DD/MM/YYYY HH:mm");
                datetimeInput.val(defaultDate);
                quantityInput.val(parseInt(item?.quantity_detail));
            }

        } else {
            checkbox.prop('checked', false);
            datetimeInput.prop('disabled', true);
            quantityInput.prop('disabled', true);
            selectOddInput.prop('disabled', true);
            datetimeInput.val("");
            quantityInput.val(0);
        }
    });


    $('.checkboxOdd').on('click', function() {
        let tr = $(this).closest('tr');
        let datetimeInput = tr.find('.flatpickdatetime-odd');
        let quantityInput = tr.find('.quantity-input');
        let selectOddInput = tr.find('.select-odd-obat');
        let qtyStock = tr.find('div.qty');

        let qtyValue = parseFloat(qtyStock.text()) || 0;

        if ($(this).is(':checked')) {
            datetimeInput.prop('disabled', false);
            quantityInput.prop('disabled', false);
            selectOddInput.prop('disabled', false);

            let defaultDate = moment().format("DD/MM/YYYY HH:mm");
            datetimeInput.val(defaultDate);
            quantityInput.val(qtyValue);
            quantityInput.focus();
            $("#save-tabelsOdd").removeAttr("disabled");
        } else {
            $("#save-tabelsOdd").attr("disabled", "disabled");
            datetimeInput.prop('disabled', true);
            quantityInput.prop('disabled', true);
            selectOddInput.prop('disabled', true);

            datetimeInput.val("");
            quantityInput.val(0);
        }
    });


    $('.quantity-input').on('input', function() {
        let max = parseInt($(this).attr('max'));
        if ($(this).val() > max) {
            $(this).val(max);
        }
    });
};
</script>