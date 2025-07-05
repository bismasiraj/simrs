<?php

$this->extend('layout/basiclayout', [
    'orgunit' => @$orgunit,
    'img_time' => @$img_time
]) ?>
<?php $this->section('cssContent') ?>
<!-- DataTables -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />
<?php $this->endSection() ?>
<?php $this->section('topbar') ?>
<?php echo view('layout/partials/topbar.php', [
    'title' => @$title,
    'pagetitle' => 'dashboard',
    'subtitle' => 'dashboard',
]); ?>
<?php $this->endSection() ?>
<?php $this->section('content') ?>


<div class="content-wrapper">
    <section>
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-lg-12 col-md-12  p-0">
                        <div class="card rounded-4">
                            <div class="card-header mb-0">
                                <h3 class="card-title">Auth Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 col-lg-4 mb-2 mb-md-0">
                                        <input type="text" id="search_users_form" class="form-control"
                                            placeholder="Cari Nama">
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <button type="button" class="btn btn-primary w-100" id="btnsearch_users_form">
                                            <i class="fa fa-search"></i> Cari
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th width="1%" class="text-center">No.</th>
                                                <th>Nama</th>
                                                <th width="1%"><i class="fas fa-user-cog"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyAuthGroupe">
                                        </tbody>
                                    </table>
                                </div>

                                <nav aria-label="User Permissions Pagination">
                                    <ul class="pagination justify-content-end custom-pagination" id="pagination">
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="authGroupe_modal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">List Aksess <span id="modal_name_of_clinic"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:75vh; overflow-y: auto;">
                <form action="" method="post" id="formAksess_users">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="row" style="width: 10%;" class="text-center">No.</th>
                                <th scope="row" class="w-auto text-nowrap">Aksess</th>
                                <th scope="row" style="width: 5%;">C</th>
                                <th scope="row" style="width: 5%;">R</th>
                                <th scope="row" style="width: 5%;">U</th>
                                <th scope="row" style="width: 5%;">D</th>
                                <th scope="row" style="width: 10%;" class="text-nowrap">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="body_container_auth_groupe_permisson">

                        </tbody>
                    </table>
                    <div id="content-add-autUserss"></div>

                </form>
            </div>
            <!-- <div class="modal-footer">
                <div class="d-flex">
                    <button class="btn btn-primary ms-auto" type="button" id="btn_save_form_Aksess_users"><i
                            class="fas fa-save"></i> Simpan</button>
                </div>
            </div> -->
        </div><!-- /.modal-content -->
    </div>
</div>


<?php $this->endSection(); ?>


<?php $this->section('jsContent') ?>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
</script>
<script>
    (function() {
        $(document).ready(function() {
            let currentPage = 1;
            getDataList(
                'admin/UsersPermission/getDataGroupeAuth', (res) => {
                    window.dataSendAuthgroupe = res?.dataSend
                    window.selectOptionAuthGroupe = res?.select
                    if (res.respon) {
                        renderDataAuthGroupe({
                            data: res?.value
                        })
                    }
                    const totalData = res?.value?.count_data || 0;
                    renderPagination(totalData, 15, currentPage);

                }, (beforesend) => {
                    getLoadingGlobalServices('tbodyAuthGroupe')
                }
            );
        });

        const renderDataAuthGroupe = (props) => {
            let htmlContent = '';
            const pageNumber = props.data.page;
            const perPage = 15 || Math.floor(props.data.count_data / props.data.total_pages);

            props?.data.data.forEach((row, key) => {
                const no = (pageNumber - 1) * perPage + (key + 1);
                const filteredDataGroupe = window.dataSendAuthgroupe
                    .filter(item => item.group_id === row?.id)
                    .map(item => item.permission_name)
                    .join(', ');

                htmlContent += `<tr>
                                <th>${no}</th>
                                <td class="slideContentUser">${row?.description}</td>
                                <td>
                                    <button class="btn btn-warning formContentAuthGroupe" data-id="${row?.id}" type="button"><i class="fas fa-user-cog"></i></button>
                                </td>
                            </tr>
                        <tr class="slide-content" style="display: none;">
                            <td></td>
                            <td colspan="3">${filteredDataGroupe || ''}</td>
                        </tr>`;

            });

            $('#tbodyAuthGroupe').html(htmlContent);

            $('.slideContentUser1').on('click', function() {
                const parentRow = $(this).closest('tr');
                const slideRow = parentRow.next('.slide-content');

                if (slideRow.is(':visible')) {
                    slideRow.slideUp();
                } else {
                    slideRow.slideDown();
                }
            });

            actionButtonUsers(props);
        };



        const actionButtonUsers = (props) => {
            $("#tbodyAuthGroupe").on("click", ".formContentAuthGroupe", function() {
                const id = $(this).data("id");
                renderModalAuthGroupe({
                    data: window.dataSendAuthgroupe,
                    id: id
                })

            });
        }

        const renderModalAuthGroupe = (props) => {
            let result = "";
            const dataResultProps = props.data.filter(item => item.group_id === props?.id) || [];

            if (dataResultProps.length > 0) {
                dataResultProps.forEach((e, index) => {
                    result += `
                <tr data-group-id="${e?.permission_id}">
                    <td class="text-center">${index + 1}</td>
                    <td>${e?.description}</td>
                    <td>
                        <input class="form-check-input" disabled type="checkbox" value="${e.c}"  name="c"
                            ${e.c === 1 ? 'checked' : ''}>
                    </td>
                    <td>
                        <input class="form-check-input" disabled type="checkbox" value="${e.r}" name="r"
                            ${e.r === 1 ? 'checked' : ''}>
                    </td>
                    <td>
                        <input class="form-check-input" disabled type="checkbox" value="${e.u}" name="u"
                            ${e.u === 1 ? 'checked' : ''}>
                    </td>
                    <td>
                        <input class="form-check-input" disabled type="checkbox" value="${e.d}" name="d"
                            ${e.d === 1 ? 'checked' : ''}>
                    </td>
                    <td class="d-flex justify-content-between">
                        <button 
                            class="btn btn-outline-primary formModalEditAuthRequest w-45" 
                            data-id="${e?.permission_id}" 
                            type="button">
                            <i class="far fa-edit"></i>
                        </button>
                        <button 
                            class="btn btn-outline-danger formModalDeleteAuthRequest w-45" 
                            data-id="${e?.permission_id}" 
                            type="button">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>`;
                });
            }

            $("#body_container_auth_groupe_permisson").html(result);

            const templateBtnAdd = `
        <div class="box-tab-tools my-3" style="text-align: center;">
            <button type="button" id="addGrouppermisson_btn" class="btn btn-outline-info w-100" style="border-radius: 20px;">
                <span><i class="fas fa-plus fa-2xl"></i> Tambah</span>
            </button>
        </div>`;
            $("#content-add-autUserss").html(templateBtnAdd);

            $("#authGroupe_modal").modal("show");

            $(document).off().on("click", ".formModalDeleteAuthRequest", function() {
                const id = $(this).data("id");
                console.log(props?.id);

                deleteDataModalAuthGroupe({
                    group_id: props?.id,
                    id: id
                });
            });

            $(document).on("click", ".formModalEditAuthRequest", function() {
                const permissionId = $(this).data('id');
                const row = $(`tr[data-group-id="${permissionId}"]`);

                row.find('input.form-check-input').removeAttr('disabled');

                $(this).replaceWith(`
            <button class="btn btn-outline-primary btn-save-aut-groupe w-45" data-id="${permissionId}" type="button">
                <i class="fas fa-save"></i>
            </button>
        `);
            });


            $("#addGrouppermisson_btn").on("click", () => {
                if ($(".new-select").val() === null || $(".new-select").val() === "") {
                    errorSwal("Harap Isi Terlebih Dahulu Baru Add Kembali");
                    return;
                }

                const selectOptions = window.selectOptionAuthGroupe;

                const existingGroupIds = $("#body_container_auth_groupe_permisson tr").map((_, tr) => $(
                        tr)
                    .data("group-id")).get();

                const currentIndex = $("#body_container_auth_groupe_permisson tr").length + 1;

                let selectHTML = `<select class="form-select new-select select2" required>
            <option value="" disabled selected>Pilih Akses</option>`;
                selectOptions.forEach(option => {
                    if (!existingGroupIds.includes(option.id)) {
                        selectHTML +=
                            `<option value="${option.id}">${option.description}</option>`;
                    }
                });
                selectHTML += `</select>`;

                const newRow = `
            <tr data-group-id="new">
                <td class="text-center">${currentIndex}</td>
                <td>${selectHTML}</td>
                <td>
                        <input class="form-check-input"  type="checkbox" value="1"  name="c">
                    </td>
                    <td>
                        <input class="form-check-input"  type="checkbox" value="1" name="r">
                    </td>
                    <td>
                        <input class="form-check-input"  type="checkbox" value="1" name="u">
                    </td>
                    <td>
                        <input class="form-check-input"  type="checkbox" value="1" name="d">
                    </td>
                <td>
                    <div class="d-flex justify-content-between w-100">
                        <button class="btn btn-outline-primary btn-save-aut-groupe w-45" type="button">
                            <i class="fas fa-save"></i>
                        </button>
                        <button class="btn btn-outline-danger formModalUsers w-45" type="button">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>`;

                $("#body_container_auth_groupe_permisson").append(newRow);

                $(".select2").select2({
                    dropdownParent: $("#authGroupe_modal"),
                    width: "100%"
                });

                $(document).on("click", ".formModalUsers", function() {
                    $(this).closest("tr").remove();
                });

            });

            $(document).off("click", ".btn-save-aut-groupe").on("click", ".btn-save-aut-groupe", function() {
                const row = $(this).closest("tr");
                const permissionId = row.data("group-id");
                const selectElement = row.find("select");
                const selectedValue = selectElement.val();

                const saveButton = $(this);
                saveButton.prop("disabled", true);

                const permissionData = {
                    c: row.find("input[name='c']").is(":checked") ? 1 : 0,
                    r: row.find("input[name='r']").is(":checked") ? 1 : 0,
                    u: row.find("input[name='u']").is(":checked") ? 1 : 0,
                    d: row.find("input[name='d']").is(":checked") ? 1 : 0,
                };

                if (selectElement.length > 0 && selectedValue) {
                    saveDataModalAuthGroupe({
                        group_id: props?.id,
                        id: selectedValue ?? permissionId,
                        permission: permissionData,
                    });

                    row.find("input.form-check-input").attr("disabled", true);
                    selectElement.prop("disabled", true);
                    row.data("group-id", selectedValue);

                    saveButton.replaceWith(`
                        <button 
                            class="btn btn-outline-primary formModalEditAuthRequest w-45" 
                            data-id="${selectedValue ?? permissionId}" 
                            type="button">
                            <i class="far fa-edit"></i>
                        </button>
                    `);
                } else {
                    saveDataModalAuthGroupe({
                        group_id: props?.id,
                        id: selectedValue ?? permissionId,
                        permission: permissionData,
                    });
                }
            });

        };


        const deleteDataModalAuthGroupe = (props) => {
            postData({
                    group_id: props?.group_id,
                    id: props?.id
                },
                'admin/UsersPermission/deleteDataAuthGroupe', (res) => {
                    let result_id = res?.id
                    if (res.status === "success") {
                        successSwal(res.status)
                        getDataList(
                            'admin/UsersPermission/getAuthGroupes', (res) => {
                                window.dataSendAuthgroupe = res?.dataSend
                                renderModalAuthGroupe({
                                    data: window.dataSendAuthgroupe,
                                    id: result_id
                                })

                            }, (beforesend) => {
                                $("#body_container_auth_groupe_permisson").html(`<tr>
                                                                        <td colspan="50">
                                                                        <div class="card" aria-hidden="true">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title placeholder-glow">
                                                                                <span class="placeholder col-6"></span>
                                                                                </h5>
                                                                                <p class="card-text placeholder-glow">
                                                                                <span class="placeholder col-7"></span>
                                                                                <span class="placeholder col-4"></span>
                                                                                <span class="placeholder col-4"></span>
                                                                                <span class="placeholder col-6"></span>
                                                                                <span class="placeholder col-8"></span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        </td>
                                                                    </tr>`)
                            }
                        );
                    }
                }, (beforesend) => {
                    $('.formModalUsers').prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin"></i>');
                }
            );
        }

        const saveDataModalAuthGroupe = (props) => {
            postData({
                    group_id: props.group_id,
                    id: props?.id,
                    permission: props?.permission
                },
                'admin/UsersPermission/saveDataAuthGroupe', (res) => {
                    let result_id = res?.id
                    if (res.status === "success") {
                        successSwal(res.status)

                        getDataList(
                            'admin/UsersPermission/getAuthGroupes', (res) => {
                                window.dataSendAuthgroupe = res?.dataSend

                                renderModalAuthGroupe({
                                    data: window.dataSendAuthgroupe,
                                    id: result_id
                                })
                            }, (beforesend) => {
                                $("#body_container_auth_groupe_permisson").html(`<tr>
                                                                        <td colspan="50">
                                                                        <div class="card" aria-hidden="true">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title placeholder-glow">
                                                                                <span class="placeholder col-6"></span>
                                                                                </h5>
                                                                                <p class="card-text placeholder-glow">
                                                                                <span class="placeholder col-7"></span>
                                                                                <span class="placeholder col-4"></span>
                                                                                <span class="placeholder col-4"></span>
                                                                                <span class="placeholder col-6"></span>
                                                                                <span class="placeholder col-8"></span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        </td>
                                                                    </tr>`)
                            }
                        );
                    }
                }, (beforesend) => {
                    $('.btn-save').prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin"></i>');
                }
            );
        }


        function renderPagination(totalData, perPage, currentPage) {
            const totalPages = Math.ceil(totalData / perPage);
            const paginationContainer = $('.custom-pagination');

            paginationContainer.empty();

            let paginationHTML = '';

            if (currentPage > 1) {
                paginationHTML +=
                    `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage - 1}">&laquo;</a></li>`;
            }

            const maxVisible = 4;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
            let endPage = Math.min(totalPages, startPage + maxVisible - 1);

            if (currentPage <= Math.ceil(maxVisible / 2)) {
                endPage = Math.min(totalPages, maxVisible);
            }

            if (currentPage > totalPages - Math.floor(maxVisible / 2)) {
                startPage = Math.max(1, totalPages - maxVisible + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                          </li>`;
            }

            if (endPage < totalPages) {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                paginationHTML += `<li class="page-item">
                            <a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>
                          </li>`;
            }

            if (currentPage < totalPages) {
                paginationHTML +=
                    `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage + 1}">&raquo;</a></li>`;
            }

            paginationContainer.append(paginationHTML);

            $('.page-link').off('click').on('click', function(event) {
                event.preventDefault();

                const pageNumber = $(this).data('page');
                if (pageNumber) {
                    changePage(pageNumber);
                }
            });
        }

        const changePage = (pageNumber) => {
            postData({
                    page: pageNumber,
                    limit: 15,
                    search: $("#search_users_form").val()
                }, 'admin/UsersPermission/getDataGroupe',
                (res) => {
                    if (res && res.respon) {
                        renderDataAuthGroupe({
                            data: res?.value
                        })
                        const totalData = res?.value?.count_data || 0;
                        renderPagination(totalData, 15, pageNumber);
                    }
                }, (beforesend) => {
                    getLoadingGlobalServices('tbodyAuthGroupe')
                }
            );
        }


        $("#btnsearch_users_form").off().on("click", function(e) {
            postData({
                    page: 1,
                    limit: 15,
                    search: $("#search_users_form").val()
                }, 'admin/UsersPermission/getDataGroupe',
                (res) => {
                    if (res && res.respon) {
                        renderDataAuthGroupe({
                            data: res?.value
                        })
                        const totalData = res?.value?.count_data || 0;
                        renderPagination(totalData, 15, res?.value?.page);
                    }
                }, (beforesend) => {
                    getLoadingGlobalServices('tbodyAuthGroupe')
                }
            );

        })





    })()
</script>
<?php $this->endSection(); ?>