<script type="text/javascript">
$(document).ready(function() {
    getDataTableOdd()
});



const getDataOdd = (props) => {
    postData({
        visit_id: props.visit_id
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

const getDataTableOdd = (props) => {
    $("#oddTab").off().on("click", function(e) {
        e.preventDefault();

        getLoadingscreen("contentToHideOdd", "load-content-odd")

        let visit_id = '<?php echo $visit['visit_id']; ?>';
        getDataOdd({
            visit_id: visit_id
        });
    });
};
const defaultTest = (data) => {
    let resultData = '';
    data.data.forEach(e => {
        let statusObatValue = e?.status_obat ? e?.status_obat : "V";

        resultData += `
            <tr data-vactination-id="${e.vactination_id}">
                <td>${e.description}</td>
                <td><input class="form-check-input checkboxOdd" type="checkbox" value="" id="flexCheckDefault"></td>
                <td><input class="form-control datetime-input" type="datetime-local" name="datetime" disabled></td>
                <td><div class="qty">${!e.quantity || parseFloat(e.quantity) === 0 ? 0 : parseInt(e.quantity)}</div></td>
                <td><input class="form-control quantity-input" type="number" name="quantity" min="0" value="${!e.quantity || parseFloat(e.quantity_detail) === 0 ? 0 : parseInt(e.quantity_detail, 10)}" max="${!e.quantity || parseFloat(e.quantity) === 0 ? 0 : parseInt(e.quantity, 10)}" disabled></td>
                <td>${e.description2}</td>
                <td style="display: none;">${e.bill_id}</td>
                <td>
                    <select class="form-select status-obat" name="status_obat">
                        <option value="V" ${statusObatValue === "V" ? "selected" : ""}>Obat telah diberikan</option>
                        <option value="T" ${statusObatValue === "T" ? "selected" : ""}>Pasien menolak</option>
                        <option value="A" ${statusObatValue === "A" ? "selected" : ""}>Alergi</option>
                        <option value="K" ${statusObatValue === "K" ? "selected" : ""}>Kondisi pasien menyebabkan ditundanya pemberian obat</option>
                        <option value="ESO" ${statusObatValue === "ESO" ? "selected" : ""}>Reaksi efek samping obat</option>
                        <option value="OTT" ${statusObatValue === "OTT" ? "selected" : ""}>Obat tidak tersedia</option>
                    </select>
                </td>
             
            </tr>`;
    });

    $("#bodydataOdd").html(resultData);

    check(data);
    saveAction();
};




const saveAction = () => {
    $("#save-tabelsOdd").on("click", e => {
        let table = document.getElementById('tablesOdd');
        let rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        let dataToSave = [];

        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            let checkbox = row.querySelector('.checkboxOdd');

            if (checkbox.checked) {
                let description = row.cells[0].textContent;
                let datetime = row.querySelector('.datetime-input').value;
                let qtySend = row.querySelector('.quantity-input').value;
                let qtyResep = row.cells[3].textContent;
                let description2 = row.cells[5].textContent;
                let bill_id = row.cells[6].textContent;
                let status_obat_element = row.querySelector('.status-obat');
                let status_obat = status_obat_element ? status_obat_element.value : null;


                // let valid_date = row.querySelector('.valid_date').value;
                // let valid_user = row.querySelector('.valid_user').value;


                dataToSave.push({
                    description: description,
                    datetime: moment(datetime).format("YYYY-MM-DD HH:mm"),
                    qtySend: qtySend,
                    qtyResep: qtyResep,
                    description2: description2,
                    bill_id: bill_id,
                    status_obat: status_obat
                    // valid_date: valid_date,
                    // valid_user: valid_user
                });
                // checkbox.checked = false;
            }
        }
        if (dataToSave.length > 0) {


            postData(dataToSave, 'admin/odd/updateData', (res) => {
                successSwal('Data Telah di Perbarui.');
                let visit_id = '<?php echo $visit['visit_id']; ?>';
                getDataOdd({
                    visit_id: visit_id
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
        let datetimeInput = tr.find('.datetime-input');
        let quantityInput = tr.find('.quantity-input');

        if (0 < item.quantity_detail) {
            checkbox.prop('checked', true);
            datetimeInput.prop('disabled', false);
            quantityInput.prop('disabled', false);


            let defaultDate = moment(item.received_date).format("YYYY-MM-DDTHH:mm");
            datetimeInput.val(defaultDate);
            quantityInput.val(parseInt(item?.quantity));
            if (item.valid_user) {
                datetimeInput.prop('disabled', true);
                quantityInput.prop('disabled', true)
                checkbox.prop('disabled', true);
                $("#save-tabelsOdd").attr("disabled", "disabled");

                let defaultDate = moment(item.received_date).format("YYYY-MM-DDTHH:mm");
                datetimeInput.val(defaultDate);
                quantityInput.val(parseInt(item?.quantity_detail));
            }

        } else {
            checkbox.prop('checked', false);
            datetimeInput.prop('disabled', true);
            quantityInput.prop('disabled', true);
            datetimeInput.val("");
            quantityInput.val(0);
        }
    });


    $('.checkboxOdd').on('click', function() {
        let tr = $(this).closest('tr');
        let datetimeInput = tr.find('.datetime-input');
        let quantityInput = tr.find('.quantity-input');

        if ($(this).is(':checked')) {
            datetimeInput.prop('disabled', false);
            quantityInput.prop('disabled', false);

            let defaultDate = moment().format("YYYY-MM-DDTHH:mm");
            datetimeInput.val(defaultDate);
            quantityInput.val(0);
            quantityInput.focus();
            $("#save-tabelsOdd").removeAttr("disabled");
        } else {
            $("#save-tabelsOdd").attr("disabled", "disabled");
            datetimeInput.prop('disabled', true);
            quantityInput.prop('disabled', true);
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




let dataDummy = [{
        "org_unit_code": "3372238",
        "vactination_id": "FC316C24-37B6-4ADC-BBE1-9C2F5E112076",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020003",
        "bill_id": "20240716141809608",
        "treat_date": "2024-07-18 15:00:00.000",
        "allocated_date": null,
        "brand_id": "4087",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Sanmol",
        "dose_presc": "12.00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "3 x sehari 2 Kapsul    ",
        "numer": "9",
        "iter": 1,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "500.00",
        "resep_ke": 1,
        "iter_ke": 1,
        "aturanminum2": null,
        "modified_date": "2024-07-16 14:18:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null,
        "status_obat": "K"
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "78F936A1-0DF1-4BD0-9F9F-8E1CF2267678",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020003",
        "bill_id": "20240716141809608",
        "treat_date": "2024-07-18 15:00:00.000",
        "allocated_date": null,
        "brand_id": "4087",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Sanmol",
        "dose_presc": "12.00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "3 x sehari 2 Kapsul    ",
        "numer": "9",
        "iter": 1,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "500.00",
        "resep_ke": 1,
        "iter_ke": 2,
        "aturanminum2": null,
        "modified_date": "2024-07-16 14:18:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null,
        "status_obat": "A"
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "B7D9FCEB-4BBD-4E51-822E-2D4A4ACF553D",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020003",
        "bill_id": "20240716141809608",
        "treat_date": "2024-07-18 15:00:00.000",
        "allocated_date": null,
        "brand_id": "4087",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Sanmol",
        "dose_presc": "12.00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "3 x sehari 2 Kapsul    ",
        "numer": "9",
        "iter": 1,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "500.00",
        "resep_ke": 1,
        "iter_ke": 3,
        "aturanminum2": null,
        "modified_date": "2024-07-16 14:18:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null,
        "status_obat": "OTT"
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "91C38EC0-D7CB-45D5-873A-A480D698A111",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020003",
        "bill_id": "20240716141809608",
        "treat_date": "2024-07-19 15:00:00.000",
        "allocated_date": null,
        "brand_id": "4087",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Sanmol",
        "dose_presc": "12.00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "3 x sehari 2 Kapsul    ",
        "numer": "9",
        "iter": 2,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "500.00",
        "resep_ke": 1,
        "iter_ke": 1,
        "aturanminum2": null,
        "modified_date": "2024-07-16 14:18:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "133BBF93-EFDF-435B-AFDC-07934108E975",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020003",
        "bill_id": "20240716141809608",
        "treat_date": "2024-07-19 15:00:00.000",
        "allocated_date": null,
        "brand_id": "4087",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Sanmol",
        "dose_presc": "12.00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "3 x sehari 2 Kapsul    ",
        "numer": "9",
        "iter": 2,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "500.00",
        "resep_ke": 1,
        "iter_ke": 2,
        "aturanminum2": null,
        "modified_date": "2024-07-16 14:18:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "31A428CD-3E43-4A63-B408-130BFCD68472",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020003",
        "bill_id": "20240716141809608",
        "treat_date": "2024-07-19 15:00:00.000",
        "allocated_date": null,
        "brand_id": "4087",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Sanmol",
        "dose_presc": "12.00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "3 x sehari 2 Kapsul    ",
        "numer": "9",
        "iter": 2,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "500.00",
        "resep_ke": 1,
        "iter_ke": 3,
        "aturanminum2": null,
        "modified_date": "2024-07-16 14:18:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "099FA664-A07A-46F3-849C-D818EC85D41A",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-19 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 1,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 1,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "B7E34E25-07E3-42EE-87FA-115A853AFC5E",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-19 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 1,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 2,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "52A66447-B814-4E0D-9F3E-3AAB0C46DD19",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-19 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 1,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 3,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "BF493765-0CB9-45ED-9B90-28D5C3E3A0FC",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-20 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 2,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 1,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "AA1E0121-431E-4454-9AB5-C7111FA46BAD",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-20 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 2,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 2,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "366CDCE2-AF80-4D2A-BEAD-56F23F7481BC",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-20 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 2,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 3,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "33D1CCD1-A50D-480A-8C23-A3319A311784",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-21 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 3,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 1,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "FFD2274F-988A-45D2-B774-FBB5C5CDBE18",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-21 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 3,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 2,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    },
    {
        "org_unit_code": "3372238",
        "vactination_id": "534C69F0-C064-4690-B288-35F492101B49",
        "no_registration": "021732",
        "visit_id": "202406231817490203553",
        "trans_id": "021732202406231817490200",
        "resep_no": "RIE240716B020004",
        "bill_id": "20240716162117745",
        "treat_date": "2024-07-21 11:00:00.000",
        "allocated_date": null,
        "brand_id": "3888",
        "employee_id": "41",
        "doctor": "",
        "quantity": "1.00",
        "quantity_detail": ".00",
        "measure_id": 3,
        "description": "Ambroxol Tablet",
        "dose_presc": ".00",
        "sold_status": 7,
        "racikan": 0,
        "description2": "",
        "numer": "9",
        "iter": 3,
        "package_id": null,
        "module_id": "",
        "dose": "1.00",
        "jml_bks": 0,
        "orig_dose": "30.00",
        "resep_ke": 2,
        "iter_ke": 3,
        "aturanminum2": null,
        "modified_date": "2024-07-16 16:21:00.000",
        "modified_by": null,
        "modified_from": "B020",
        "valid_date": null,
        "valid_user": null,
        "valid_user_2": null,
        "received_date": null,
        "signa_1": null,
        "signa_2": null,
        "signa_3": null,
        "signa_4": null,
        "signa_5": null,
        "clinic_id_from": null,
        "tagihan": null,
        "thename": null,
        "theaddress": null,
        "serial_nb": null,
        "isrj": null,
        "theid": null,
        "status_pasien_id": null,
        "status_pasien_id1": null,
        "class_room_id": null,
        "bed_id": null
    }
]
</script>