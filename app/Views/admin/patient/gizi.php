<?php

$this->extend('layout/nosidelayout', [
    'orgunit' => $orgunit,
    'img_time' => $img_time
]);

?>
<?php $this->section('content'); ?>
<div class="content-wrapper">
    <section>
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card border border-1 rounded-4">
                            <div class="card-body">
                                <h3 class="card-title">Order Gizi</h3>
                                <hr>
                                <form action="" method="POST" id="formSearchGizi">
                                    <input type="hidden" name="keluar_id" value="0">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Bangsal</label>
                                                <select id="iklinikGizi" class="form-select" name="klinik" autocomplete="off">
                                                    <option value="%">Semua</option>
                                                    <?php $cliniclist = array();
                                                    foreach ($clinic as $key => $value) {
                                                        if ($clinic[$key]['stype_id'] == '3') {
                                                            $cliniclist[$clinic[$key]['name_of_clinic']] = $clinic[$key]['name_of_clinic'];
                                                        }
                                                    }
                                                    asort($cliniclist);
                                                    ?>
                                                    <?php foreach ($cliniclist as $key => $value) { ?>
                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Tanggal</label>
                                                <input type="date" name="akhir" class="form-control datepicker-gizi bg-white" id="tanggal_gizi">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="mt-4">
                                                        <div class="mb-0">
                                                            <div>
                                                                <button id="btn-search-gizi" type="button" name="search" class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-search"></i> Cari</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-primary" id="generateGizi" disabled><i class="fas fa-cog"></i> Generate</button>
                                    <button class="btn btn-success" id="cetakGiziAll" disabled><i class="fas fa-print"></i> Cetak</button>
                                </div>
                                <hr>
                                <form action="" method="post" id="formGiziAll">
                                    <table class="table table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th width="1%" rowspan="2" class="text-center align-middle">No.</th>
                                                <th rowspan="2" width="23%" class="text-center align-middle">Nama Pasien</th>
                                                <th width="1%" rowspan="2" class="text-center align-middle"></th>
                                                <th colspan="3" class="text-center">Menu</th>
                                                <th width="1%" rowspan="2" class="text-center align-middle">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th width="25" class="text-center">Makan Pagi</th>
                                                <th width="25" class="text-center">Makan Siang</th>
                                                <th width="25" class="text-center">Makan Malam</th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerTableGizi">

                                        </tbody>
                                    </table>
                                </form>
                                <div class="d-flex">
                                    <button type="button" id="btn_simpanGiziAll" class="btn btn-primary ms-auto" disabled><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="cetakOrderGiziAll" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Cetak Order Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gap-2 p-3 place-items-center">
                    <button class="btn btn-success btn-cetak-all-shift" data-type="pagi" type="button" id="cetak_gizi_all_pagi"><i class="fas fa-print"></i> Cetak Pagi</button>
                    <button class="btn btn-success btn-cetak-all-shift" data-type="siang" type="button" id="cetak_gizi_all_siang"><i class="fas fa-print"></i> Cetak Siang</button>
                    <button class="btn btn-success btn-cetak-all-shift" data-type="malam" type="button" id="cetak_gizi_all_malam"><i class="fas fa-print"></i> Cetak Malam</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="cetakOrderGizi" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Cetak Order Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gap-2 p-3 place-items-center">
                    <button class="btn btn-success btn-cetak-shift" data-type="pagi" type="button" id="cetak_gizi_pagi"><i class="fas fa-print"></i> Cetak Pagi</button>
                    <button class="btn btn-success btn-cetak-shift" data-type="siang" type="button" id="cetak_gizi_siang"><i class="fas fa-print"></i> Cetak Siang</button>
                    <button class="btn btn-success btn-cetak-shift" data-type="malam" type="button" id="cetak_gizi_malam"><i class="fas fa-print"></i> Cetak Malam</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="validasiOrderGizi" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Validasi Order Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formValidasiGizi">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="validasi_pagi">
                        <label class="form-check-label" for="validasi_pagi">
                            Validasi Makanan Pagi
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="validasi_siang">
                        <label class="form-check-label" for="validasi_siang">
                            Validasi Makanan Siang
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="validasi_malam">
                        <label class="form-check-label" for="validasi_malam">
                            Validasi Makanan Malam
                        </label>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnValidasiGizi" type="button">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="bentukGizi2" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel2">Bentuk Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="bentukmultibox2">
                    <input type="hidden" id="bentukgizicontainer2">
                </div>
                <div class="panel-footer text-end mb-4">
                    <button type="button" id="saveBentukGizi2" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Pilih</span></button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="peringatanGizi2" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Peringatan Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:75vh; overflow-y: auto;">
                <div id="peringatanmultibox2">
                    <input type="hidden" id="peringatangizicontainer2">
                </div>
            </div>
            <div class="modal-footer">
                <div class="panel-footer text-end mb-4">
                    <button type="button" id="savePeringatanGizi2" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Pilih</span></button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<?php $this->endSection(); ?>
<?php $this->section('jsContent'); ?>
<script>
    $(document).ready(function() {
        let bangsal = '';
        flatpickr('.datepicker-gizi', {
            dateFormat: 'Y-m-d',
            defaultDate: moment().format('YYYY-MM-DD'),
            enableTime: false,
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {
                console.log(selectedDates);
            }
        });
    });

    function isiBentukGizi2(container) {
        $("#bentukgizicontainer2").val(container);
        $("#bentukGizi2").modal('show');
    }

    function isiPeringatanGizi2(container) {
        $("#peringatangizicontainer2").val(container)
        $("#peringatanGizi2").modal('show')
    }


    (function() {


        const arrayBentuk = <?= json_encode($diet_type); ?>;
        $.each(arrayBentuk, function(key, value) {
            $("#bentukmultibox2").append(`<div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="dtype` + key + `" value="` + key + `">
                        <label class="form-check-label" for="dtype` + key + `">
                            ` + value + `
                        </label>
                    </div>`)
        })


        $("#saveBentukGizi2").on("click", function() {
            var container = $("#bentukgizicontainer2").val()
            var bentukValue = '';
            var bentukDesc = '';
            $.each(arrayBentuk, function(key, value) {
                if ($("#dtype" + key).is(":checked")) {
                    bentukValue += ',' + $("#dtype" + key).val()
                    bentukDesc += ', ' + arrayBentuk[$("#dtype" + key).val()]
                }
            })
            if (bentukValue.charAt(0) === ',') {

                bentukValue = bentukValue.substring(1);
                bentukDesc = bentukDesc.substring(1);
            }
            if (container.includes('pagi')) {
                let dtype_siang = container.replace('pagi', 'siang');
                let dtype_malam = container.replace('pagi', 'malam');

                $("#ordergizi_all_" + dtype_siang).val(bentukValue)
                $("#ordergizi_all_" + dtype_siang + "_display").val(bentukDesc)
                $("#ordergizi_all_" + dtype_malam).val(bentukValue)
                $("#ordergizi_all_" + dtype_malam + "_display").val(bentukDesc)
            }
            $("#ordergizi_all_" + container).val(bentukValue)
            $("#ordergizi_all_" + container + "_display").val(bentukDesc)
            $("#bentukmultibox2").find("input").prop("checked", false)

            $("#bentukGizi2").modal("hide")
        })




        const arrayPeringatan = <?= json_encode($diet_warning); ?>;

        $.each(arrayPeringatan, function(key, value) {
            var textnya = `<div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="peringatan` + key + `" value="` + value + `">
                        <label class="form-check-label" for="peringatan` + key + `">
                            ` + value + `
                        </label>
                    </div>`

            $("#peringatanmultibox2").append(textnya)
        })


        $("#savePeringatanGizi2").on("click", function() {
            var container = $("#peringatangizicontainer2").val()
            var peringatan = '';

            $.each(arrayPeringatan, function(key, value) {
                if ($("#peringatan" + key).is(":checked")) {
                    peringatan += ',' + $("#peringatan" + key).val()
                }
            })

            if (peringatan.charAt(0) === ',') {
                // Remove the first character (comma)
                var peringatan = peringatan.substring(1);
                // inputField.val(newValue);
            }
            if (container.includes('pagi')) {

                let peringatan_siang = container.replace('pagi', 'siang');
                let peringatan_malam = container.replace('pagi', 'malam');

                $("#ordergizi_all_" + peringatan_siang).val(peringatan)
                $("#ordergizi_all_" + peringatan_malam).val(peringatan)
            }
            $("#ordergizi_all_" + container).val(peringatan)
            $("#peringatanmultibox2").find("input").prop("checked", false)
            $("#peringatanGizi2").modal("hide")
        })

        // =================================================
        $('#tanggal_gizi').val(moment().format('YYYY-MM-DD'))

        $("#btn-search-gizi").on('click', (function(e) {
            e.preventDefault();

            // getDataTable();
            renderData();

        }));

        $('#btn_simpanGiziAll').off().on('click', function(e) {
            let formData = document.querySelector('#formGiziAll');
            let dataSend = new FormData(formData);

            let visit_id = dataSend.getAll('visit_id[]');

            let dtype_pagi = dataSend.getAll('dtype_pagi[]');
            let dtype_siang = dataSend.getAll('dtype_siang[]');
            let dtype_malam = dataSend.getAll('dtype_malam[]');

            let dtypedesc_pagi = dataSend.getAll('dtypedesc_pagi[]');
            let dtypedesc_siang = dataSend.getAll('dtypedesc_siang[]');
            let dtypedesc_malam = dataSend.getAll('dtypedesc_malam[]');

            let ekstra_pagi = dataSend.getAll('ekstra_pagi[]');
            let ekstra_siang = dataSend.getAll('ekstra_siang[]');
            let ekstra_malam = dataSend.getAll('ekstra_malam[]');

            let mineral_pagi = dataSend.getAll('mineral_pagi[]');
            let mineral_siang = dataSend.getAll('mineral_siang[]');
            let mineral_malam = dataSend.getAll('mineral_malam[]');

            let pantangan_pagi = dataSend.getAll('pantangan_pagi[]');
            let pantangan_siang = dataSend.getAll('pantangan_siang[]');
            let pantangan_malam = dataSend.getAll('pantangan_malam[]');

            let jsonObj = {};
            jsonObj.gizi = [];
            jsonObj.date = $('#tanggal_gizi').val();

            for (let i = 0; i < visit_id.length; i++) {
                let entry = {
                    visit_id: visit_id[i],

                    dtype_pagi: dtype_pagi[i],
                    dtype_siang: dtype_siang[i],
                    dtype_malam: dtype_malam[i],

                    dtypedesc_pagi: dtypedesc_pagi[i],
                    dtypedesc_siang: dtypedesc_siang[i],
                    dtypedesc_malam: dtypedesc_malam[i],

                    mineral_pagi: mineral_pagi[i],
                    mineral_siang: mineral_siang[i],
                    mineral_malam: mineral_malam[i],

                    ekstra_pagi: ekstra_pagi[i],
                    ekstra_siang: ekstra_siang[i],
                    ekstra_malam: ekstra_malam[i],

                    pantangan_pagi: pantangan_pagi[i],
                    pantangan_siang: pantangan_siang[i],
                    pantangan_malam: pantangan_malam[i]
                }
                jsonObj.gizi.push(entry);
            };

            postData(jsonObj, 'admin/DietInap/insertData', (res) => {

                if (res.status) {
                    successSwal(res.message);
                    renderData();
                } else {
                    errorSwal(res.message)
                    renderData();
                }
            });
        })
        const renderData = () => {
            let formData = document.querySelector('#formSearchGizi')
            let dataSend = new FormData(formData)

            let jsonObj = {};
            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            let date = jsonObj.akhir;
            $.ajax({
                url: '<?php echo base_url(); ?>admin/DietInap/renderData',
                type: "POST",
                data: dataSend,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {

                    if (jsonObj.klinik.includes('%')) {
                        $('#generateGizi').prop('disabled', true);
                        $('#cetakGiziAll').prop('disabled', true);
                        $('#btn_simpanGiziAll').prop('disabled', true);
                        bangsal = '';
                    } else {
                        $('#generateGizi').prop('disabled', false);
                        $('#cetakGiziAll').prop('disabled', false);
                        $('#btn_simpanGiziAll').prop('disabled', false);
                        bangsal = $('#iklinikGizi').val();
                    }
                    let templateHtml = '';
                    getData({
                            data: res?.data,
                            date: date,
                        })
                        .then(data_diet => {

                            templateHtml = dataTemplate({
                                data: res.data,
                                container: templateHtml,
                                data_diet: data_diet,
                                date: date,
                            });
                            $('#containerTableGizi').html(templateHtml);


                            actionCetak();
                            validasi();
                            actionCetakAll({
                                data_diet: data_diet,
                                date: date,
                                bangsal: bangsal,
                            });
                            actionGenerate({
                                data_diet: data_diet,
                                date: date
                            })


                        })
                        .catch(error => {
                            console.error(error); // Handle any errors
                        });

                },
                error: function() {

                }
            });

        }
        const getDataTable = () => {
            let formData = document.querySelector('#formSearchGizi')
            let dataSend = new FormData(formData)
            let jsonObj = {};
            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            let date = jsonObj.akhir;

            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/getipddatatable',
                type: "POST",
                data: dataSend,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (jsonObj.klinik.includes('%')) {
                        $('#generateGizi').prop('disabled', true);
                        $('#cetakGiziAll').prop('disabled', true);
                        bangsal = '';
                    } else {
                        $('#generateGizi').prop('disabled', false);
                        $('#cetakGiziAll').prop('disabled', false);
                        bangsal = $('#iklinikGizi').val();
                    }
                    let templateHtml = '';
                    getData({
                            data: res?.data,
                            date: date,
                        })
                        .then(data_diet => {

                            templateHtml = dataTemplate({
                                data: res.data,
                                container: templateHtml,
                                data_diet: data_diet,
                                date: date,
                            });
                            $('#containerTableGizi').html(templateHtml);


                            actionCetak();
                            validasi();
                            actionCetakAll({
                                data_diet: data_diet,
                                date: date,
                                bangsal: bangsal,
                            });
                            actionGenerate({
                                data_diet: data_diet,
                                date: date
                            })


                        })
                        .catch(error => {
                            console.error(error); // Handle any errors
                        });

                },
                error: function() {

                }
            });
        }

        const dataTemplate = (props) => {
            // console.log(props?.date);
            // const visit = props.data.map(each => {
            //     const doc = new DOMParser().parseFromString(each[1], 'text/html');
            //     const nama_pasien = doc.querySelector('a').textContent;
            //     const visit_id = doc.querySelector('a').getAttribute('href').split("profileranap/")[1].split('/')[0];

            //     const clinic = each[4].split(/<br>/)[0] ?? '';

            //     return {
            //         nama_pasien,
            //         visit_id,
            //         clinic
            //     };
            // });
            const mergedData = props?.data.map(item => {
                const dietData = props?.data_diet.find(diet => diet.visit_id === item.visit_id);

                return {
                    ...item,
                    data: dietData || null
                };
            }).sort((a, b) => {
                // If a.data exists and b.data does not, a comes first
                if (a.data && !b.data) return -1;
                // If b.data exists and a.data does not, b comes first
                if (!a.data && b.data) return 1;
                // If both have data or both are null, maintain original order (0)
                return 0;
            });
            let dataHtml = '';
            mergedData.forEach((item, index) => {
                const formattedDate = moment(props?.date).format('YYYY-MM-DD')
                dataHtml += `
                    <tr>
                        <input type="hidden" name="visit_id[]" value="${item.visit_id}">
                        <td class="text-center align-middle ${item.keluar_id == 1 ? 'bg-danger' : ''}">${index+1}</td>
                        <td class="text-center align-middle ${item.keluar_id == 1 ? 'bg-danger' : ''}">
                            <p class="fw-bold mb-1">${item.thename}</p>
                            <small>(${item?.name_of_clinic})</small>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <span class="py-1">BENTUK</span>
                                <span class="py-1">JENIS</span>
                                <span class="py-1">MINERAL</span>
                                <span class="py-1">EXTRA</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" class="form-control form-control-sm" name="dtypedesc_pagi[]" id="ordergizi_all_dtype_pagi_` + index + 1 + `_display" onfocus="isiBentukGizi2('dtype_pagi_` + index + 1 + `')" value="${item?.data?.dtype_pagi ?? ''}" ${item?.data?.valid_date_pagi || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                                <input type="hidden" id="ordergizi_all_dtype_pagi_` + index + 1 + `" name="dtype_pagi[]" class="form-control" onfocus="isiBentukGizi('dtype_pagi` + index + 1 + `')" ${item?.data?.valid_date_pagi || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>


                                <input type="text" name="pantangan_pagi[]" id="ordergizi_all_pantangan_pagi_` + index + 1 + `" class="form-control form-control-sm" onfocus="isiPeringatanGizi2('pantangan_pagi_` + index + 1 + `')" value="${item?.data?.pantangan_pagi ?? ''}" ${item?.data?.valid_date_pagi || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>

                                <input type="text" class="form-control form-control-sm" name="mineral_pagi[]" value="${item?.data?.dtype_iddesc ?? ''}" ${item?.data?.valid_date_pagi || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                                <input type="text" class="form-control form-control-sm" name="ekstra_pagi[]" value="${item?.data?.penunggu_pagi ?? ''}" ${item?.data?.valid_date_pagi || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" class="form-control form-control-sm" name="dtypedesc_siang[]" id="ordergizi_all_dtype_siang_` + index + 1 + `_display" onfocus="isiBentukGizi2('dtype_siang_` + index + 1 + `')" value="${item?.data?.dtype_siang ?? ''}" ${item?.data?.valid_date_siang || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                                <input type="hidden" id="ordergizi_all_dtype_siang_` + index + 1 + `" name="dtype_siang[]" class="form-control" onfocus="isiBentukGizi('dtype_siang` + index + 1 + `')" ${item?.data?.valid_date_siang || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>


                                <input type="text" name="pantangan_siang[]" id="ordergizi_all_pantangan_siang_` + index + 1 + `" class="form-control form-control-sm" onfocus="isiPeringatanGizi2('pantangan_siang_` + index + 1 + `')" value="${item?.data?.pantangan_siang ?? ''}" ${item?.data?.valid_date_siang || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>

                                <input type="text" class="form-control form-control-sm" name="mineral_siang[]" value="${item?.data?.dtype_siangdesc ?? ''}" ${item?.data?.valid_date_siang || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                                <input type="text" class="form-control form-control-sm" name="ekstra_siang[]" value="${item?.data?.penunggu_siang ?? ''}" ${item?.data?.valid_date_siang || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" class="form-control form-control-sm" name="dtypedesc_malam[]" id="ordergizi_all_dtype_malam_` + index + 1 + `_display" onfocus="isiBentukGizi2('dtype_malam_` + index + 1 + `')" value="${item?.data?.dtype_malam ?? ''}" ${item?.data?.valid_date_malam || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                                <input type="hidden" id="ordergizi_all_dtype_malam_` + index + 1 + `" name="dtype_malam[]" class="form-control" onfocus="isiBentukGizi('dtype_malam` + index + 1 + `')" ${item?.data?.valid_date_malam || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>

                                <input type="text" name="pantangan_malam[]" id="ordergizi_all_pantangan_malam_` + index + 1 + `" class="form-control form-control-sm" onfocus="isiPeringatanGizi2('pantangan_malam_` + index + 1 + `')" value="${item?.data?.pantangan_malam ?? ''}" ${item?.data?.valid_date_malam || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>

                                <input type="text" class="form-control form-control-sm" name="mineral_malam[]" value="${item?.data?.dtype_malamdesc ?? ''}" ${item?.data?.valid_date_malam || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                                <input type="text" class="form-control form-control-sm" name="ekstra_malam[]" value="${item?.data?.penunggu_malam ?? ''}" ${item?.data?.valid_date_malam || item.keluar_id == 1 ? 'readonly style="pointer-events: none;"' : ''}>
                            </div>
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-group-vertical">
                                <button type="button" data-value='${item?.data != null ? JSON.stringify(item?.data) : ''}' data-date="${formattedDate}" data-clinic="${item?.clinic}" class="btn btn-sm btn-success btn-cetak" ${item?.data == null || item?.keluar_id == 1 ? 'disabled' : ''}><i class="fas fa-print"></i> Cetak</button>
                                <button type="button" data-value="${item?.thename}" date-pagi="${item?.data?.valid_date_pagi ?? 'null'}" date-siang="${item?.data?.valid_date_siang ?? 'null'}" date-malam="${item?.data?.valid_date_malam ??'null'}" data-date="${formattedDate}" data-visit="${item?.visit_id}" class="btn btn-sm btn-primary btn-validasi" ${item?.data == null || item?.keluar_id == 1 ? 'disabled' : ''}>${item?.data?.valid_date_pagi || item?.data?.valid_date_siang || item?.data?.valid_date_malam ? '<i class="far fa-check-circle"></i> Done' : '<i class="fas fa-file-signature"></i> Sign'}</button>
                            </div>
                        </td>
                    </tr>
                    `;

            });
            props.container = dataHtml;
            return props.container
        }
        // const dataTemplate = (props) => {
        //     // console.log(props?.date);
        //     const visit = props.data.map(each => {
        //         const doc = new DOMParser().parseFromString(each[1], 'text/html');
        //         const nama_pasien = doc.querySelector('a').textContent;
        //         const visit_id = doc.querySelector('a').getAttribute('href').split("profileranap/")[1].split('/')[0];

        //         const clinic = each[4].split(/<br>/)[0] ?? '';

        //         return {
        //             nama_pasien,
        //             visit_id,
        //             clinic
        //         };
        //     });
        //     const mergedData = visit.map(item => {
        //         const dietData = props?.data_diet.find(diet => diet.visit_id === item.visit_id);

        //         return {
        //             ...item,
        //             data: dietData || null
        //         };
        //     });

        //     let dataHtml = '';
        //     mergedData.forEach((item, index) => {
        //         const formattedDate = moment(props?.date).format('YYYY-MM-DD')
        //         dataHtml += `
        //             <tr>
        //                 <input type="hidden" name="visit_id[]" value="${item.visit_id}">
        //                 <td class="text-center align-middle">${index+1}</td>
        //                 <td class="text-center align-middle">${item.nama_pasien}</td>
        //                 <td>
        //                     <div class="d-flex flex-column gap-2">
        //                         <span class="py-1">BENTUK</span>
        //                         <span class="py-1">JENIS</span>
        //                         <span class="py-1">MINERAL</span>
        //                         <span class="py-1">EXTRA</span>
        //                     </div>
        //                 </td>
        //                 <td>
        //                     <div class="d-flex flex-column gap-2">
        //                         <input type="text" class="form-control form-control-sm" name="dtypedesc_pagi[]" id="ordergizi_all_dtype_pagi_` + index + 1 + `_display" onfocus="isiBentukGizi2('dtype_pagi_` + index + 1 + `')" value="${item?.data?.dtype_pagi ?? ''}" ${item?.data?.valid_date_pagi ? 'readonly style="pointer-events: none;"' : ''}>
        //                         <input type="hidden" id="ordergizi_all_dtype_pagi_` + index + 1 + `" name="dtype_pagi[]" class="form-control" onfocus="isiBentukGizi('dtype_pagi` + index + 1 + `')" ${item?.data?.valid_date_pagi ? 'readonly style="pointer-events: none;"' : ''}>


        //                         <input type="text" name="pantangan_pagi[]" id="ordergizi_all_pantangan_pagi_` + index + 1 + `" class="form-control form-control-sm" onfocus="isiPeringatanGizi2('pantangan_pagi_` + index + 1 + `')" value="${item?.data?.pantangan_pagi ?? ''}" ${item?.data?.valid_date_pagi ? 'readonly style="pointer-events: none;"' : ''}>

        //                         <input type="text" class="form-control form-control-sm" name="mineral_pagi[]" value="${item?.data?.dtype_iddesc ?? ''}" ${item?.data?.valid_date_pagi ? 'readonly style="pointer-events: none;"' : ''}>
        //                         <input type="text" class="form-control form-control-sm" name="ekstra_pagi[]" value="${item?.data?.penunggu_pagi ?? ''}" ${item?.data?.valid_date_pagi ? 'readonly style="pointer-events: none;"' : ''}>
        //                     </div>
        //                 </td>
        //                 <td>
        //                     <div class="d-flex flex-column gap-2">
        //                         <input type="text" class="form-control form-control-sm" name="dtypedesc_siang[]" id="ordergizi_all_dtype_siang_` + index + 1 + `_display" onfocus="isiBentukGizi2('dtype_siang_` + index + 1 + `')" value="${item?.data?.dtype_siang ?? ''}" ${item?.data?.valid_date_siang ? 'readonly style="pointer-events: none;"' : ''}>
        //                         <input type="hidden" id="ordergizi_all_dtype_siang_` + index + 1 + `" name="dtype_siang[]" class="form-control" onfocus="isiBentukGizi('dtype_siang` + index + 1 + `')" ${item?.data?.valid_date_siang ? 'readonly style="pointer-events: none;"' : ''}>


        //                         <input type="text" name="pantangan_siang[]" id="ordergizi_all_pantangan_siang_` + index + 1 + `" class="form-control form-control-sm" onfocus="isiPeringatanGizi2('pantangan_siang_` + index + 1 + `')" value="${item?.data?.pantangan_siang ?? ''}" ${item?.data?.valid_date_siang ? 'readonly style="pointer-events: none;"' : ''}>

        //                         <input type="text" class="form-control form-control-sm" name="mineral_siang[]" value="${item?.data?.dtype_siangdesc ?? ''}" ${item?.data?.valid_date_siang ? 'readonly style="pointer-events: none;"' : ''}>
        //                         <input type="text" class="form-control form-control-sm" name="ekstra_siang[]" value="${item?.data?.penunggu_siang ?? ''}" ${item?.data?.valid_date_siang ? 'readonly style="pointer-events: none;"' : ''}>
        //                     </div>
        //                 </td>
        //                 <td>
        //                     <div class="d-flex flex-column gap-2">
        //                         <input type="text" class="form-control form-control-sm" name="dtypedesc_malam[]" id="ordergizi_all_dtype_malam_` + index + 1 + `_display" onfocus="isiBentukGizi2('dtype_malam_` + index + 1 + `')" value="${item?.data?.dtype_malam ?? ''}" ${item?.data?.valid_date_malam ? 'readonly style="pointer-events: none;"' : ''}>
        //                         <input type="hidden" id="ordergizi_all_dtype_malam_` + index + 1 + `" name="dtype_malam[]" class="form-control" onfocus="isiBentukGizi('dtype_malam` + index + 1 + `')" ${item?.data?.valid_date_malam ? 'readonly style="pointer-events: none;"' : ''}>

        //                         <input type="text" name="pantangan_malam[]" id="ordergizi_all_pantangan_malam_` + index + 1 + `" class="form-control form-control-sm" onfocus="isiPeringatanGizi2('pantangan_malam_` + index + 1 + `')" value="${item?.data?.pantangan_malam ?? ''}" ${item?.data?.valid_date_malam ? 'readonly style="pointer-events: none;"' : ''}>

        //                         <input type="text" class="form-control form-control-sm" name="mineral_malam[]" value="${item?.data?.dtype_malamdesc ?? ''}" ${item?.data?.valid_date_malam ? 'readonly style="pointer-events: none;"' : ''}>
        //                         <input type="text" class="form-control form-control-sm" name="ekstra_malam[]" value="${item?.data?.penunggu_malam ?? ''}" ${item?.data?.valid_date_malam ? 'readonly style="pointer-events: none;"' : ''}>
        //                     </div>
        //                 </td>
        //                 <td class="text-center align-middle">
        //                     <div class="btn-group-vertical">
        //                         <button type="button" data-value='${item?.data != null ? JSON.stringify(item?.data) : ''}' data-date="${formattedDate}" data-clinic="${item?.clinic}" class="btn btn-sm btn-success btn-cetak" ${item?.data == null ? 'disabled' : ''}><i class="fas fa-print"></i> Cetak</button>
        //                         <button type="button" data-value="${item?.nama_pasien}" date-pagi="${item?.data?.valid_date_pagi ?? 'null'}" date-siang="${item?.data?.valid_date_siang ?? 'null'}" date-malam="${item?.data?.valid_date_malam ??'null'}" data-date="${formattedDate}" data-visit="${item?.visit_id}" class="btn btn-sm btn-primary btn-validasi" ${item?.data == null ? 'disabled' : ''}>${item?.data?.valid_date_pagi || item?.data?.valid_date_siang || item?.data?.valid_date_malam ? '<i class="far fa-check-circle"></i> Done' : '<i class="fas fa-file-signature"></i> Sign'}</button>
        //                     </div>
        //                 </td>
        //             </tr>
        //             `;

        //     });
        //     props.container = dataHtml;
        //     return props.container
        // }

        const getData = (props) => {
            const visit = props.data.map(each => {
                return each.visit_id
            });
            // const visit = props.data.map(each => {
            //     const doc = new DOMParser().parseFromString(each[1], 'text/html');
            //     return doc.querySelector('a').getAttribute('href').split("profileranap/")[1].split('/')[0];
            // });

            return new Promise((resolve, reject) => {
                // resolve(visit);
                postData({
                    date: props?.date,
                    visit_id: visit
                }, 'admin/DietInap/getData', (res) => {
                    if (res.respon) {
                        resolve(res.data); // Resolve the promise with the data
                    } else {
                        reject(new Error('Failed to fetch data')); // Reject on error
                    }
                });
            });
        };

        const getDataBentuk = (props) => {
            postData({
                date: props?.date
            }, 'admin/DietInap/getDataBentuk', (res) => {
                if (res.status) {
                    const arrayBentuk = res.data.reduce((acc, item) => {
                        acc[item.dtype_id] = item.dtype_id; // Set key-value pair
                        return acc;
                    }, {});
                    console.log(arrayBentuk);
                } else {

                }
            });
        }

        const cetakGiziAll = (props) => {

            // Construct the URL
            // var url = '<?= base_url() . 'admin/DietInap/cetakAll/'; ?>' + btoa(props.data);
            var url = '<?= base_url() . 'admin/DietInap/cetakAll/'; ?>' + props?.shift + '/' + props?.date + '/' + props.clinic + '/' + btoa(props.data);

            // Redirect to the URL
            window.open(url, '_blank'); // Open in a new tab
        }
        const cetakGizi = (props) => {

            // Construct the URL
            // var url = '<?= base_url() . 'admin/DietInap/cetak/'; ?>' + btoa(props.data);
            var url = '<?= base_url() . 'admin/DietInap/cetak/'; ?>' + props?.shift + '/' + props?.date + '/' + props.clinic + '/' + btoa(props.data);

            // Redirect to the URL
            window.open(url, '_blank'); // Open in a new tab
        }
        const actionCetakAll = (props) => {
            $('#cetakGiziAll').off().on('click', function(e) {
                $("#cetakOrderGiziAll").modal('show')
                $('#cetak_gizi_all_pagi').off().on('click', function(e) {
                    console.log($(this).data('type'));
                    cetakGiziAll({
                        shift: $(this).data('type'),
                        data: JSON.stringify(props?.data_diet),
                        date: props?.date,
                        clinic: props?.bangsal
                    })
                })
                $('#cetak_gizi_all_siang').off().on('click', function(e) {
                    console.log($(this).data('type'));
                    cetakGiziAll({
                        shift: $(this).data('type'),
                        data: JSON.stringify(props?.data_diet),
                        date: props?.date,
                        clinic: props?.bangsal
                    })
                })
                $('#cetak_gizi_all_malam').off().on('click', function(e) {
                    console.log($(this).data('type'));
                    cetakGiziAll({
                        shift: $(this).data('type'),
                        data: JSON.stringify(props?.data_diet),
                        date: props?.date,
                        clinic: props?.bangsal
                    })
                })
            })
        }

        const actionGenerate = (props) => {
            $('#generateGizi').off().on('click', function() {

                Swal.fire({
                    title: "Generate Data Order Gizi?",
                    text: "Data baru akan dibuat sesuai data yang digenerate",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#7a6fbe",
                    confirmButtonText: "Generate",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        let dataJson = {
                            data: props?.data_diet,
                            date: props?.date
                        }
                        postData(dataJson, 'admin/DietInap/generate', (result) => {
                            if (result.status) {

                                successSwal('Data berhasil Digenerate.');
                            } else {
                                errorSwal(result.message)
                            }
                        });

                    }
                });
            })
        }

        const actionCetak = () => {
            document.querySelectorAll('.btn-cetak').forEach(button => {
                button.addEventListener('click', function(event) {
                    const data = button.getAttribute('data-value');
                    const date = button.getAttribute('data-date');
                    const clinic = button.getAttribute('data-clinic');
                    // console.log(3, data);
                    $("#cetakOrderGizi").modal('show')
                    $('#cetak_gizi_pagi').off().on('click', function(e) {
                        console.log($(this).data('type'));
                        cetakGizi({
                            shift: $(this).data('type'),
                            data: data,
                            date: date,
                            clinic: clinic
                        })
                    })
                    $('#cetak_gizi_siang').off().on('click', function(e) {
                        console.log($(this).data('type'));
                        cetakGizi({
                            shift: $(this).data('type'),
                            data: data,
                            date: date,
                            clinic: clinic
                        })
                    })
                    $('#cetak_gizi_malam').off().on('click', function(e) {
                        console.log($(this).data('type'));
                        cetakGizi({
                            shift: $(this).data('type'),
                            data: data,
                            date: date,
                            clinic: clinic
                        })
                    })
                });
            })
        }

        const validasi = () => {
            document.querySelectorAll('.btn-validasi').forEach(button => {
                button.addEventListener('click', function(event) {
                    const data = button.getAttribute('data-value');
                    const date = button.getAttribute('data-date');
                    const clinic = button.getAttribute('data-clinic');
                    const visit_id = button.getAttribute('data-visit');
                    const valid_pagi = button.getAttribute('date-pagi');
                    const valid_siang = button.getAttribute('date-siang');
                    const valid_malam = button.getAttribute('date-malam');

                    $("#validasiOrderGizi").modal('show')

                    const setCheckboxState = (selector, valid) => {
                        $(selector).prop("checked", valid !== "null");
                        $(selector).val(valid !== "null");
                    };


                    setCheckboxState("#validasi_pagi", valid_pagi);
                    setCheckboxState("#validasi_siang", valid_siang);
                    setCheckboxState("#validasi_malam", valid_malam);

                    // Default True
                    if (valid_pagi === "null" && valid_siang === "null" && valid_malam === "null") {
                        $("#validasi_pagi, #validasi_siang, #validasi_malam").prop("checked", true);
                    }

                    $('#btnValidasiGizi').off().on('click', function(e) {

                        const results = {
                            pagi: $("#validasi_pagi").is(':checked'),
                            siang: $("#validasi_siang").is(':checked'),
                            malam: $("#validasi_malam").is(':checked'),
                            data: data,
                            visit_id: visit_id,
                            date: date,
                        };


                        postData(
                            JSON.stringify(results),
                            'admin/DietInap/validasi', (res) => {
                                if (res.status) {
                                    successSwal(res.message);
                                    renderData();
                                } else {
                                    errorSwal(res.message);
                                    renderData();
                                }
                            }
                        );
                    })
                });
            })
        }
    })()
</script>
<?php $this->endSection(); ?>