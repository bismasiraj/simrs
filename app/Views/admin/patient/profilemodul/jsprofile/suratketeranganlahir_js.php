<script type="text/javascript">
    (function() {
        $(document).ready(function(e) {
            var nomor = '<?= $visit['no_registration']; ?>';
            var visit = '<?= $visit['visit_id']; ?>'
            $('#btn-save-skl').attr('hidden', true)
            $('#btn-tutup-skl').attr('hidden', true)
            $('#thename').attr('disabled', true)
            $('#inspection_date').attr('disabled', true)
            $('#gender').attr('disabled', true)
            $('#baby_birth').attr('disabled', true)


            $("#btn-tutup-skl").on("click", e => {
                $('#btn-save-skl').attr('hidden', true)
                $('#btn-tutup-skl').attr('hidden', true)
                $('#thename').attr('disabled', true)
                $('#inspection_date').attr('disabled', true)
                $('#gender').attr('disabled', true)
                $('#baby_birth').attr('disabled', true)
            })

            getSKL()
        })
        const getSKL = () => {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/SuratKeteranganLahir/getData',
                type: "POST",
                data: JSON.stringify({
                    'visit_id': '<?= $visit['visit_id']; ?>',
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#bodydataSKL").html("");

                    let htmlContent = '';
                    let index = 1;
                    data.forEach((element, key) => {
                        htmlContent +=
                            `<tr>
                                <th scope="row" width="1%">${index}</th>
                                <td>${element.thename}</td>
                                <td style="width:150px !important;">${element.baby_ke}</td>
                                <td width="1%"><button type="button" class="btn btn-sm btn-primary btn-show-edit-skl" id="${element.baby_id}" data-id="${element.baby_id}" data-visit_id="${element.visit_id}"><span class="mdi mdi-lead-pencil"></span> Lihat</button></td>
                                <td width="1%"><button type="button" class="btn btn-sm btn-danger btn-show-delete-skl" id="${element.baby_id}" data-id="${element.baby_id}" data-visit_id="${element.visit_id}"><span class="mdi mdi-delete"></span> Hapus</button></td>
                                <td width="1%"><button type="button" class="btn btn-sm btn-secondary btn-show-print-skl" id="${element.baby_id}" data-id="${element.baby_id}" data-visit_id="${element.visit_id}"><span class="mdi mdi-printer"></span> Print</button></td>
                            </tr>`;
                        index++;
                    });

                    $("#bodydataSKL").append(htmlContent);
                    getDetailSKL();
                    getModalDeleteSKL();
                    actionCetakSKL();
                },
                error: function() {

                }
            });
        }

        $("#btn-save-skl").on("click", e => {
            e.preventDefault();
            // $('input[name="baby_id"]').val(generateCode());

            let formElement = document.getElementById('formSKL');
            let dataSend = new FormData(formElement);
            let jsonObj = {};
            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });

            postData(jsonObj, 'admin/SuratKeteranganLahir/insertData', (res) => {
                if (res.respon === true) {
                    successSwal('Data berhasil disimpan.');
                    $('#formSKL')[0].reset();
                } else {
                    console.log('errorr');
                }
            });

            getSKL()
        })


        const generateCode = () => {
            let now = new Date();
            let code = "" + now.getFullYear() +
                ('0' + (now.getMonth() + 1)).slice(-2) +
                ('0' + now.getDate()).slice(-2) +
                ('0' + now.getHours()).slice(-2) +
                ('0' + now.getMinutes()).slice(-2) +
                ('0' + now.getSeconds()).slice(-2);
            let randomDigits = ('00' + Math.floor(Math.random() * 1000)).slice(-3);

            return code + randomDigits;
        };
        const getModalDeleteSKL = () => {
            $('.btn-show-delete-skl').on('click', function(e) {
                let id = $(this).data('id');
                let visit = $(this).data('visit_id');
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
                        deleteActionSKL({
                            id: id,
                            visit: visit
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Dibatalkan",
                            text: "File Anda aman :)",
                            icon: "error"
                        });
                    }
                    getSKL()
                });
            });
        };

        const deleteActionSKL = (props) => {
            postData({
                id: props.id,
                visit: props.visit
            }, 'admin/SuratKeteranganLahir/deleteData', (res) => {
                if (res.respon === true) {
                    successSwal('Data berhasil Dihapus.');
                    let visit_id = '<?php echo $visit['visit_id']; ?>';
                    getDataTables({
                        visit_id: visit_id
                    });
                } else {
                    errorSwal("Gagal Di hapus")
                }

            });
        };

        const getDetailSKL = () => {
            $(".btn-show-edit-skl").on('click', function(e) {
                let babyId = $(this).data('id');
                let visitId = $(this).data('visit_id');

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/SuratKeteranganLahir/getDetail',
                    type: "POST",
                    data: JSON.stringify({
                        'baby_id': babyId,
                        'visit_id': visitId,
                    }),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#btn-save-skl').attr('hidden', false)
                        $('#btn-tutup-skl').attr('hidden', false)
                        $('#thename').attr('disabled', false)
                        $('#inspection_date').attr('disabled', false)
                        $('#gender').attr('disabled', false)
                        $('#baby_birth').attr('disabled', false)
                        // visit
                        $('input[name="visit_id"]').val(data.visit_id);
                        $('input[name="clinic_id"]').val(data.clinic_id);
                        $('input[name="keluar_id"]').val(data.keluar_id);
                        $('input[name="employee_id"]').val(data.employee_id);
                        $('input[name="baby_id"]').val(data.baby_id);
                        $('input[name="ageday"]').val(data.ageday);
                        $('input[name="agemonth"]').val(data.agemonth);
                        $('input[name="ageyear"]').val(data.ageyear);
                        $('input[name="isrj"]').val(data.isrj);
                        $('input[name="status_pasien_id"]').val(data.status_pasien_id);
                        $('input[name="contact_address"]').val(data.contact_address);
                        $('input[name="pasien_id"]').val(data.pasien_id);
                        $('input[name="status_pasien_id"]').val(data.status_pasien_id);
                        $('input[name="org_unit_code"]').val(data.org_unit_code);
                        $('input[name="no_registration"]').val(data.no_registration);
                        $('input[name="diagnosa_id"]').val(data.diagnosa);
                        $('input[name="mothername"]').val(data.name_of_pasien);
                        $('input[name="doctor"]').val(data.fullname);
                        $('input[name="class_room_id"]').val(data.class_room_id);
                        $('input[name="bed_id"]').val(data.bed_id);

                        //input
                        $('#thename').val(data.thename)
                        $('#inspection_date').val(data.inspection_date)
                        $('#gender').val(data.gender)
                        $('#baby_birth').val(data.baby_birth)


                    },
                    error: function() {
                        console.error();
                    }
                });

            })
        };

        const actionCetakSKL = () => {
            $(".btn-show-print-skl").on('click', function(e) {
                console.log('cliccck');
                let RequestCentakSKL = {
                    baby_id: $(this).data('id'),
                    visit_id: $(this).data('visit_id'),
                    visit: <?= json_encode($visit); ?>
                };

                let baseUrl = '<?= base_url() ?>';
                let jsonStr = JSON.stringify(RequestCentakSKL);
                let base64DataSKL = btoa(jsonStr);
                let url = baseUrl + 'admin/SuratKeteranganLahir/cetakData/' + base64DataSKL
                window.open(url, "_blank");


            });
        };
    })();
</script>