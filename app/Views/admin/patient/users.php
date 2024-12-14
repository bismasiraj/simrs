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
                                <h3 class="card-title">User Permissions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <input type="text" id="search_users_form" class="form-control"
                                            placeholder="Cari Nama">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary" id="btnsearch_users_form">
                                            <i class="fa fa-search"></i> Cari
                                        </button>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th width="1%" class="text-center">No.</th>
                                            <th>Nama</th>
                                            <th width="1%">Email</th>
                                            <th width="1%"><i class="fas fa-user-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyUsers">
                                    </tbody>
                                </table>

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


<div class="modal fade" id="user_profile_modal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered">
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
                                <th scope="row" style="width: 10%;" class="text-nowrap">No.</th>
                                <th scope="row" class="w-auto text-nowrap">Aksess</th>
                                <th scope="row" style="width: 20%;" class="text-nowrap">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="body_container_Aksess_users">

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
                'admin/UsersPermission/getUsers', (res) => {
                    window.dataSendUsers = res?.dataSend
                    window.selectOptionAuth = res?.select
                    if (res.respon) {
                        renderDataUsers({
                            data: res?.value
                        })
                    }
                    const totalData = res?.value?.count_data || 0;
                    renderPagination(totalData, 15, currentPage);

                }, (beforesend) => {
                    getLoadingGlobalServices('tbodyUsers')
                }
            );
        });

        const renderDataUsers = (props) => {
            let htmlContent = '';
            const pageNumber = props.data.page;
            const perPage = 15 || Math.floor(props.data.count_data / props.data.total_pages);

            props?.data.data.forEach((row, key) => {
                const no = (pageNumber - 1) * perPage + (key + 1);
                const filteredData = window.dataSendUsers
                    .filter(item => item.user_id === row?.id)
                    .map(item => item.group_name)
                    .join(', ');

                htmlContent += `<tr>
                                <th>${no}</th>
                                <td class="slideContentUser">${row?.fullname}</td>
                                <td>${row?.email}</td>
                                <td>
                                    <button class="btn btn-warning formContentUsers" data-id="${row?.id}" type="button"><i class="fas fa-user-cog"></i></button>
                                </td>
                            </tr>
                        <tr class="slide-content" style="display: none;">
                            <td></td>
                            <td colspan="3">${filteredData || ''}</td>
                        </tr>`;
            });

            $('#tbodyUsers').html(htmlContent);

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
            $("#tbodyUsers").on("click", ".formContentUsers", function() {
                const id = $(this).data("id");
                renderModalUsers({
                    data: window.dataSendUsers,
                    id_users: id
                })

            });
        }

        const renderModalUsers = (props) => {
            let result = "";
            let dataResultProps = props.data.filter(item => item.user_id === props?.id_users);
            const existingData = dataResultProps || [];
            let isDataSaved = existingData.length > 0;

            if (existingData.length > 0) {
                existingData.map((e, index) => {
                    result += `
                <tr data-group-id="${e?.group_id}">
                    <td class="text-center">${index + 1}</td>
                    <td>${e?.group_name}</td>
                    <td>
                        <button class="btn btn-outline-danger formModalUsersRequest w-100" data-id="${e?.group_id}" type="button">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>`;
                });
            }

            $("#body_container_Aksess_users").html(result);

            const templateBtnAdd = `
                            <div class="box-tab-tools my-3" style="text-align: center;">
                                <button type="button" id="addUsersGroup_btn" name="addUsersGroup_btn" class="btn btn-outline-success w-100">
                                    <span><i class="fas fa-plus fa-2xl"></i> Tambah</span>
                                </button>
                            </div>
                        `;
            $("#content-add-autUserss").html(templateBtnAdd);

            $("#user_profile_modal").modal("show");

            const checkSaveActive = () => {
                return $("button.btn-save").filter(function() {
                    return !$(this).prop('disabled');
                }).length > 0;
            };

            $("button.formModalUsersRequest").on("click", function() {
                const id = $(this).data("id");
                deleteDataModalUsers({
                    group_id: id,
                    user_id: props?.id_users
                })
            });

            $("#addUsersGroup_btn").on("click", () => {

                if (checkSaveActive()) {
                    return;
                }

                const selectOptions = window.selectOptionAuth;
                const existingGroupIds = [...$("#body_container_Aksess_users tr").map((_, tr) => $(tr)
                    .data("group-id"))];

                const currentIndex = $("#body_container_Aksess_users tr").length + 1;

                let selectHTML = `<select class="form-select new-select select2" required>
                    <option value="" disabled selected>Pilih Akses</option>`;
                selectOptions.forEach(option => {
                    if (!existingGroupIds.includes(option.id)) {
                        selectHTML += `
                                <option value="${option.id}">${option.description}</option>`;
                    }
                });
                selectHTML += `</select>`;
                const newRow = `
                                <tr data-group-id="new">
                                    <td class="text-center">${currentIndex}</td>
                                    <td>${selectHTML}</td>
                                    <td>
                                       <div class="d-flex justify-content-between w-100">
                                            <button class="btn btn-outline-primary btn-save w-45" type="button">
                                                <i class="fas fa-save"></i>
                                            </button>
                                            <button class="btn btn-outline-danger formModalUsers w-45" type="button">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        <div>
                                    </td>   
                                </tr>
                            `;
                $("#body_container_Aksess_users").append(newRow);

                $("button.formModalUsers").on("click", function() {
                    $(this).closest("tr").remove();
                });

                $("button.btn-save").on("click", function() {
                    const selectElement = $(this).closest("tr").find("select");
                    const selectedValue = selectElement.val();

                    if (selectElement.length > 0 && selectedValue) {
                        const isDuplicate = existingGroupIds.includes(selectedValue);

                        if (isDuplicate) {
                            errorSwal(
                                "Akses ini sudah dipilih sebelumnya. Silakan pilih akses lain."
                            );
                            return;
                        }

                        saveDataModalUsers({
                            group_id: selectedValue,
                            user_id: props?.id_users
                        })
                        $(this).prop("disabled", true);
                        selectElement.prop("disabled", true);
                        $(this).closest("tr").data("group-id",
                            selectedValue);
                        existingGroupIds.push(selectedValue);
                    } else {
                        errorSwal("Silakan pilih Akses terlebih dahulu.");
                    }
                });
            });
        };

        const deleteDataModalUsers = (props) => {
            postData({
                    group_id: props.group_id,
                    user_id: props?.user_id
                },
                'admin/UsersPermission/deleteData', (res) => {
                    let result_id = res?.id
                    if (res.status === "success") {
                        successSwal(res.status)
                        getDataList(
                            'admin/UsersPermission/getUsersEmploye', (res) => {
                                window.dataSendUsers = res?.dataSend
                                renderModalUsers({
                                    data: window.dataSendUsers,
                                    id_users: result_id
                                })

                            }, (beforesend) => {
                                $("#body_container_Aksess_users").html(`<tr>
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

        const saveDataModalUsers = (props) => {
            postData({
                    group_id: props.group_id,
                    user_id: props?.user_id
                },
                'admin/UsersPermission/saveData', (res) => {
                    let result_id = res?.id
                    if (res.status === "success") {
                        successSwal(res.status)
                        getDataList(
                            'admin/UsersPermission/getUsersEmploye', (res) => {
                                window.dataSendUsers = res?.dataSend
                                renderModalUsers({
                                    data: window.dataSendUsers,
                                    id_users: result_id
                                })
                            }, (beforesend) => {
                                $("#body_container_Aksess_users").html(`<tr>
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
                }, 'admin/UsersPermission/getDataUsers',
                (res) => {
                    if (res && res.respon) {
                        renderDataUsers({
                            data: res?.value
                        })
                        const totalData = res?.value?.count_data || 0;
                        renderPagination(totalData, 15, pageNumber);
                    }
                }, (beforesend) => {
                    getLoadingGlobalServices('tbodyUsers')
                }
            );
        }


        $("#btnsearch_users_form").off().on("click", function(e) {
            postData({
                    page: 1,
                    limit: 15,
                    search: $("#search_users_form").val()
                }, 'admin/UsersPermission/getDataUsers',
                (res) => {
                    if (res && res.respon) {
                        renderDataUsers({
                            data: res?.value
                        })
                        const totalData = res?.value?.count_data || 0;
                        renderPagination(totalData, 15, res?.value?.page);
                    }
                }, (beforesend) => {
                    getLoadingGlobalServices('tbodyUsers')
                }
            );

        })





    })()
</script>
<?php $this->endSection(); ?>