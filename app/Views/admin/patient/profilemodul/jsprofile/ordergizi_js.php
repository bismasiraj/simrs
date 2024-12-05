<script>
var orderGiziAll;
$("#orderGiziTab").on("click", async function() {
    // getDataDiewt()
    getOrderGizi()
    await fetchDataDiet();
})
</script>

<script type='text/javascript'>
// const getDataDiewt = () => {
$(document).ready(async function(e) {

    // initializeDietTypes();
})

async function fetchDataDiet() {
    await getDataList('admin/DietRequest/getData', (res) => {

        let result = res.data;
        let diet_type = result.diet_type;
        let diet_warning = result.diet_warning;
        window.arrayBentuk = diet_type
        window.arrayPeringatan = diet_warning

        initializeDietTypes({
            data: diet_type
        })
        initializeDietWarning({
            data: diet_warning
        })
    });

}
// }

const initializeDietTypes = (props) => {
    let arrayBentuk = props?.data;

    let rowContainer = $('<div class="row"></div>');
    let column1 = $('<div class="col-6"></div>');
    let column2 = $('<div class="col-6"></div>');

    const halfLength = Math.ceil(arrayBentuk.length / 2);

    $.each(arrayBentuk, function(key, value) {
        const checkbox = `
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="dtype${key}" value="${value}">
                            <label class="form-check-label" for="dtype${key}">
                                ${value}
                            </label>
                        </div>
                    `;

        if (key < halfLength) {
            column1.append(checkbox);
        } else {
            column2.append(checkbox);
        }
    });

    rowContainer.append(column1);
    rowContainer.append(column2);

    $("#bentukmultibox").append(rowContainer);


    $("#saveBentukGizi").on("click", function() {
        var container = $("#bentukgizicontainer").val()
        var bentukValue = '';
        var bentukDesc = '';

        $.each(arrayBentuk, function(key, value) {
            if ($("#dtype" + key).is(":checked")) {
                bentukValue += ',' + $("#dtype" + key).val()
            }
        })

        if (bentukValue.charAt(0) === ',') {
            bentukValue = bentukValue.substring(1);
        }

        if (container.includes('pagi')) {

            let dtype_siang = container.replace('pagi', 'siang');
            let dtype_malam = container.replace('pagi', 'malam');

            $("#ordergizi" + dtype_siang).val(bentukValue)
            $("#ordergizi" + dtype_malam).val(bentukValue)
        }


        $("#ordergizi" + container).val(bentukValue)
        // $("#ordergizi" + container + "display").val(bentukDesc)
        $("#bentukmultibox").find("input").prop("checked", false)

        $("#bentukGizi").modal("hide")
    })
}


function isiBentukGizi(container) {
    $("#bentukgizicontainer").val(container)
    $("#bentukGizi").modal('show')
}
</script>

<script>
const initializeDietWarning = (props) => {
    let arrayPeringatan = props?.data

    let rowContainer = $('<div class="row"></div>');
    let columns = [$('<div class="col-4"></div>'), $('<div class="col-4"></div>'), $('<div class="col-4"></div>')];

    $.each(arrayPeringatan, function(key, value) {
        var textnya = `<div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="peringatan${key}" value="${value}">
                            <label class="form-check-label" for="peringatan${key}">
                                ${value}
                            </label>
                        </div>`;

        columns[key % 3].append(textnya);
    });

    columns.forEach(column => {
        rowContainer.append(column);
    });

    $("#peringatanmultibox").append(rowContainer);

    $("#savePeringatanGizi").on("click", function() {
        var container = $("#peringatangizicontainer").val()
        const id = container?.split("pantangan_pagi");
        var peringatan = '';

        $.each(arrayPeringatan, function(key, value) {
            if ($("#peringatan" + key).is(":checked")) {
                peringatan += ',' + $("#peringatan" + key).val()
            }
        })

        if (peringatan.charAt(0) === ',') {
            peringatan = peringatan.substring(1);
        }
        if (container.includes('pagi')) {
            let peringatan_siang = container.replace('pagi', 'siang');
            let peringatan_malam = container.replace('pagi', 'malam');

            $("#ordergizi" + peringatan_siang).val(peringatan)
            $("#ordergizi" + peringatan_malam).val(peringatan)
        }
        $("#ordergizi" + container).val(peringatan)
        $("#peringatanmultibox").find("input").prop("checked", false)
        $("#peringatanGizi").modal("hide")
    })
}


function isiPeringatanGizi(container) {
    $("#peringatangizicontainer").val(container)
    $("#peringatanGizi").modal('show')
}
</script>
<script>
function addOrderGizi(flag, counter, document_id, container) {
    var bodyId = get_bodyid()
    var content = `<form id="formGiziRequest` + counter + `" action="">
                    <input type="hidden" id="ordergiziorg_unit_code` + counter + `" name="org_unit_code" value="<?= @$visit['org_unit_code']; ?>">
                    <input type="hidden" id="ordergizivisit_id` + counter + `" name="visit_id" value="<?= @$visit['visit_id']; ?>">
                    <input type="hidden" id="ordergizino_registration` + counter + `" name="no_registration" value="<?= @$visit['no_registration']; ?>">
                    <input type="hidden" id="ordergizidtype_id` + counter + `" name="dtype_id" value="` + bodyId + `">
                    <input type="hidden" id="ordergizidescription` + counter + `" name="description">
                    <input type="hidden" id="ordergiziorder_date` + counter + `" name="order_date" value="` +
        get_date() + `">
                    <input type="hidden" id="ordergizithename` + counter + `" name="thename" value="<?= @$visit['diantar_oleh']; ?>">
                    <input type="hidden" id="ordergizitheaddress` + counter + `" name="theaddress" value="<?= @$visit['visitor_address']; ?>">
                    <input type="hidden" id="ordergiziclinic_id` + counter + `" name="clinic_id" value="<?= @$visit['clinic_id']; ?>">
                    <input type="hidden" id="ordergizibed_id` + counter + `" name="bed_id" value="<?= @$visit['bed_id']; ?>">
                    <input type="hidden" id="ordergiziclass_room_id` + counter + `" name="class_room_id" value="<?= @$visit['bed_id']; ?>">
                    <input type="hidden" id="ordergizikeluar_id` + counter + `" name="keluar_id" value="<?= @$visit['bed_id']; ?>">
                    <input type="hidden" id="ordergiziemployee_id` + counter + `" name="employee_id" value="<?= @$visit['bed_id']; ?>">
                    <input type="hidden" id="ordergizidoctor` + counter + `" name="doctor" value="<?= @$visit['fullname']; ?>">
                    <div class="table-responsive mb-4">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th style='width:5%'>No</th>
                                    <th style='width:10%'>Tanggal</th>
                                    <th style='width:10%'></th>
                                    <th style='width:25%'>Makan Pagi</th>
                                    <th style='width:25%'>Makan Siang</th>
                                    <th style='width:25%'>Makan Malam</th>
                                </tr>
                            </thead>
                            <tbody id="ordergizi` + counter +
        `" class="table-group-divider">
                                <tr>
                                    <td rowspan="4">1.</td>
                                    <td rowspan="4">
                                    <input type="text" class="form-control" id="flatordergizidiet_date${counter}">
                                    <input type="hidden" class="form-control" name="diet_date" id="ordergizidiet_date${counter}">
                                    </td>
                                    <!-- <td><?= $visit['diantar_oleh']; ?></td> -->
                                    <td>Bentuk</td>
                                 
                                    <td>
                                        <input type="text" id="ordergizidtype_pagi${counter}" name="dtype_pagi" class="form-control" onfocus="isiBentukGizi('dtype_pagi${counter}')" autocomplete="off">
                                    </td>
                                    <td>
                                        <input type="text" id="ordergizidtype_siang${counter}" name="dtype_siang" class="form-control" onfocus="isiBentukGizi('dtype_siang${counter}')" autocomplete="off">
                                    </td>
                                    <td>
                                        
                                        <input type="text" id="ordergizidtype_malam${counter}" name="dtype_malam" class="form-control" onfocus="isiBentukGizi(  'dtype_malam${counter}')" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <!-- <td><?= $visit['no_registration']; ?></td> -->
                                    <td>Jenis</td>
                                    <td><input type="text" name="pantangan_pagi" id="ordergizipantangan_pagi${counter}" class="form-control" onfocus="isiPeringatanGizi('pantangan_pagi` +
        counter + `')" autocomplete="off"></td>
                                    <td><input type="text" name="pantangan_siang" id="ordergizipantangan_siang` +
        counter + `" class="form-control" onfocus="isiPeringatanGizi('pantangan_siang` + counter + `')" autocomplete="off"></td>
                                    <td><input type="text" name="pantangan_malam" id="ordergizipantangan_malam` +
        counter + `" class="form-control" onfocus="isiPeringatanGizi('pantangan_malam` + counter + `')" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <!-- <td><?= $visit['ageyear']; ?> th <?= $visit['agemonth']; ?> bln <?= $visit['ageday'] ?> hr</td> -->
                                    <td>Mineral</td>
                                    <td><input type="text" name="dtype_iddesc" id="ordergizidtype_iddesc` + counter + `" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" name="dtype_siangdesc" id="ordergizidtype_siangdesc` +
        counter + `" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" name="dtype_malamdesc" id="ordergizidtype_malamdesc` +
        counter + `" class="form-control" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <!-- <td></td> -->
                                    <td>Menu</td>
                                    <td><input type="text" name="penunggu_pagi" id="ordergizipenunggu_pagi` + counter + `" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" name="penunggu_siang" id="ordergizipenunggu_siang` +
        counter + `" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" name="penunggu_malam" id="ordergizipenunggu_malam` +
        counter + `" class="form-control" autocomplete="off"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-footer text-end mb-4">
                            <button type="submit" id="formSaveOrderGiziBtn` + counter + `" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formEditOrderGiziBtn` + counter + `" name="edit" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right" style="display: none;"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <button type="button" id="formDeleteOrderGiziBtn` + counter + `" name="delete" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-danger pull-right" style="display: none;"><i class="fa fa-trash"></i> <span>Delete</span></button>
                            <button type="button" id="formsign` + counter + `" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right" style="display: none;"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        </div>
                    </div>
                </form>`;

    $("#" + container).append(content)

    datetimepickerbyid("flatordergizidiet_date" + counter)

    $("#formGiziRequest" + counter).on("submit", function(e) {
        e.preventDefault()
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveOrderGizi',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log("formGiziRequest" + counter)
                $("#formGiziRequest" + counter).find("input").prop("readonly", true)
                successSwal("Berhasil disimpan")
                $("#formSaveOrderGiziBtn" + counter).slideUp()
                $("#formEditOrderGiziBtn" + counter).slideDown()
                $("#formDeleteOrderGiziBtn" + counter).slideUp()
                $("#formsign" + counter).slideDown()
            },
            error: function() {

            }
        });
    })

    $("#formEditOrderGiziBtn" + counter).on("click", function() {
        console.log("formSaveOrderGiziBtn" + counter)
        $("#formSaveOrderGiziBtn" + counter).slideDown()
        $("#formEditOrderGiziBtn" + counter).slideUp()
        $("#formDeleteOrderGiziBtn" + counter).slideDown()
        $("#formsign" + counter).slideDown()
    })
    $("#formDeleteOrderGiziBtn" + counter).on("click", function() {
        deleteOrderIgizi("formGiziRequest" + counter, counter, bodyId)
    })

    if (flag == 0) {
        var detailnya = orderGiziAll[counter]
        $.each(detailnya, function(key, value) {
            $("#ordergizi" + key + counter).val(value)
            //bentuk
            var bentuk = value
            bentuk = String(bentuk).split(",")
            var bentukDesc = ''

            $.each(window.arrayBentuk, function(key, value) {
                if (bentuk.includes(key)) {
                    console.log(value)
                    bentukDesc += ', ' + value
                }
            })
            if (bentukDesc.charAt(0) === ',') {
                bentukDesc = bentukDesc.substring(1);
            }
            $("#ordergizi" + key + counter + "display").val(bentukDesc)
        })
        $("#formSaveOrderGiziBtn" + counter).slideUp()
        $("#formEditOrderGiziBtn" + counter).slideDown()
        $("#formDeleteOrderGiziBtn" + counter).slideUp()
        $("#formsign" + counter).slideDown()
        $("#flatordergizidiet_date" + counter).val(formatedDatetimeFlat(detailnya.diet_date)).trigger("change")
        $("#formGiziRequest" + counter).find("input").prop("disabled", true)
    } else {
        $("#formSaveOrderGiziBtn" + counter).slideDown()
        $("#formEditOrderGiziBtn" + counter).slideUp()
        $("#formDeleteOrderGiziBtn" + counter).slideDown()
        $("#formsign" + counter).slideDown()
        $("#formGiziRequest" + counter).find("input").prop("disabled", false)
    }

    $("#ordergiziAdd").html(`<a data-toggle="modal" onclick="addOrderGizi(1,` + counter + 1 +
        `, '','orderGiziBody')" class="btn btn-primary btn-lg" id="addOrderGiziBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Order Gizi</a>`
    )

}
const deleteOrderIgizi = (container, counter, bodyId) => {
    bodyId = $("#ordergizidtype_id" + counter).val()
    postData({
        dtype_id: bodyId
    }, "admin/rm/assessment/deleteOrderGizi", (res) => {
        if (res.status == 'success') {
            console.log(container)
            $("#" + container).remove()
            successSwal("Berhasil Delete")
        } else {
            errorSwal("Gagal Delete, silahkan hubungi Admin")
        }
    }, function() {
        console.log("proses dulu")
    })
}
</script>
<script>
function getOrderGizi() {
    $.ajax({
        url: '<?php echo base_url(); ?>admin/rm/assessment/getOrderGizi',
        type: "POST",
        data: JSON.stringify({
            'visit_id': visit,
            'nomor': nomor
        }),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(e) {
            getLoadingscreen("contentOrderGizi", "loadContentOrderGizi")
        },
        success: function(data) {
            orderGiziAll = data.orderGizi

            $("#orderGiziBody").html("")
            orderGiziAll.forEach((element, key) => {
                addOrderGizi(0, key, '', 'orderGiziBody')
            });
        },
        error: function() {

        }
    });
}
</script>