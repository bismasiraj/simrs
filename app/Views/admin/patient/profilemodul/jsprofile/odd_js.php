<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        getDataTableOdd()
    });

    let datadummy = [{
            "org_unit_code": "ABC123",
            "vactination_id": 1,
            "no_registration": "REG2024001",
            "visit_id": "VISIT001",
            "trans_id": "TRANS123",
            "resep_no": "RX456",
            "bill_id": "BILL789",
            "treat_date": "2024-06-30",
            "allocated_date": "2024-06-29",
            "brand_id": 101,
            "employee_id": 1001,
            "doctor": "Dr. Smith",
            "quantity": 5,
            "quantity_detail": "5 tablets",
            "measure_id": 1,
            "description": "Medication A",
            "dose_presc": "1 tablet per day",
            "sold_status": true,
            "racikan": false,
            "description2": "Additional notes",
            "numer": 123,
            "iter": 1,
            "package_id": "PKG001",
            "module_id": "MOD002",
            "dose": 1,
            "jml_bks": 2,
            "orig_dose": 1,
            "resep_ke": 1,
            "iter_ke": 1,
            "aturanminum2": "Morning and evening",
            "modified_date": "2024-06-30T08:00:00Z",
            "modified_by": "admin",
            "modified_from": "192.168.1.100",
            "valid_date": "2024-06-30",
            "valid_user": "user1",
            "valid_user_2": "user2",
            "received_date": "2024-06-29T15:30:00Z"
        },
        {
            "org_unit_code": "XYZ789",
            "vactination_id": 2,
            "no_registration": "REG2024002",
            "visit_id": "VISIT002",
            "trans_id": "TRANS456",
            "resep_no": "RX789",
            "bill_id": "BILL012",
            "treat_date": "2024-07-01",
            "allocated_date": "2024-06-30",
            "brand_id": 102,
            "employee_id": 1002,
            "doctor": "Dr. Johnson",
            "quantity": 3,
            "quantity_detail": "3 capsules",
            "measure_id": 2,
            "description": "Medication B",
            "dose_presc": "2 capsules per day",
            "sold_status": false,
            "racikan": true,
            "description2": "Patient allergic to penicillin",
            "numer": 456,
            "iter": 2,
            "package_id": "PKG002",
            "module_id": "MOD003",
            "dose": 2,
            "jml_bks": 1,
            "orig_dose": 2,
            "resep_ke": 2,
            "iter_ke": 2,
            "aturanminum2": "Before meals",
            "modified_date": "2024-07-01T10:30:00Z",
            "modified_by": "admin2",
            "modified_from": "192.168.1.110",
            "valid_date": "2024-07-01",
            "valid_user": "user3",
            "valid_user_2": "user4",
            "received_date": "2024-06-30T09:45:00Z"
        },

    ]

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
            resultData += `
            <tr data-vactination-id="${e.vactination_id}">
                <td>${e.description}</td>
                <td><input class="form-check-input checkboxOdd" type="checkbox" value="" id="flexCheckDefault"></td>
                <td><input class="form-control datetime-input" type="datetime-local" name="datetime" disabled></td>
                <td><div class="qty">${!e.quantity ? 1 : parseInt(e.quantity, 10)}</div></td>
                <td><input class="form-control quantity-input" type="number" name="quantity" min="0" value="0" max="${parseInt(e.quantity, 10)}"  disabled></td>
                <td>${e.description2}</td>
                <td style="display: none;">${e.bill_id}</td>
                <td style="display: none;"><input  class="form-control disabled valid_date" id="valid_date" value="${!e.valid_date?moment(new Date()).format("YYYY-MM-DD HH:mm") :moment(e.valid_date).format("YYYY-MM-DD HH:mm")}"></td>
                <td style="display: none;"> <input class="form-control disabled valid_user" id="valid_user" value='<?= user()->fullname ?>'</td>
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
                    let valid_date = row.querySelector('.valid_date').value;
                    let valid_user = row.querySelector('.valid_user').value;


                    dataToSave.push({
                        description: description,
                        datetime: moment(datetime).format("YYYY-MM-DD HH:mm"),
                        qtySend: qtySend,
                        qtyResep: qtyResep,
                        description2: description2,
                        bill_id: bill_id,
                        valid_date: valid_date,
                        valid_user: valid_user
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




    // const getData = (props) = {
    //     // postData()
    // }
</script>