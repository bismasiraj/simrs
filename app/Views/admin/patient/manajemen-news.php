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

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


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
            <div class="row">
                <div class="col-12 p-0">
                    <div class="card rounded-4">
                        <div class="card-header mb-0">
                            <h3 class="card-title">Management News</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12 col-lg-3">
                                    <input type="text" id="search_users_form" class="form-control"
                                        placeholder="Cari Nama">
                                </div>
                                <div class="col-12 col-lg-1 mt-2 mt-lg-0">
                                    <button type="button" class="btn btn-primary w-100 w-lg-auto"
                                        id="btnsearch_users_form">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                                <div class="col-12 col-lg-2 text-lg-end mt-2 mt-lg-0">
                                    <button type="button" class="btn btn-success w-100 w-lg-auto" id="btn_add_artikel">
                                        <i class="fa fa-plus"></i> Tambah Artikel
                                    </button>
                                </div>
                                <div class="col-12 col-lg-2 text-lg-end mt-2 mt-lg-0">
                                    <button type="button" class="btn btn-success w-100 w-lg-auto"
                                        id="btn_list_catartikel">
                                        List Category
                                    </button>
                                </div>

                            </div>


                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th style="min-width: 50px;">No</th>
                                            <th>Judul</th>
                                            <th>Abstrak</th>
                                            <th>Penulis</th>
                                            <th style="width: 95px;">Status</th>
                                            <th style="min-width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="articleTable">
                                    </tbody>
                                </table>
                            </div>

                            <nav aria-label="Pagination">
                                <ul class="pagination justify-content-end" id="pagination">
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="categoryForm">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" hidden>
                        <label> Kategori id</label>
                        <input type="text" class="form-control" id="category_id_show" name="category_id">
                    </div>
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" id="category_name" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi (opsional)</label>
                        <textarea class="form-control" name="descriptions" id="category_desc"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>





<div class="modal fade" id="categoryListModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">List Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-content">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 1px;">No</th>
                                <th>Category</th>
                                <th>Deskripsi</th>
                                <th style="min-width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="articlecatTable">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="articleModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-fullscreen-lg-down">
        <div class="modal-content">
            <form id="articleForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="article_id" id="article_id">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <div class="d-flex gap-2">
                            <select class="form-control" name="category_id" id="category_id_artikel" required></select>
                            <button type="button" class="btn btn-outline-primary" id="btn_add_category">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Abstrak</label>
                        <textarea class="form-control" name="abstract" id="abstract"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Konten</label>
                        <textarea class="form-control" name="article_content" id="article_content" required></textarea>
                    </div>
                    <div class="mb-3" hidden>
                        <label>Penulis</label>
                        <input type="text" class="form-control" name="author" id="author">
                    </div>
                    <div class="mb-3" hidden>
                        <label>Status</label>
                        <select class="form-control" name="article_status" id="article_status">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label fw-bold">Gambar</label>
                        <input class="form-control" data-index="1" type="file" id="thumbnail" name="thumbnail"
                            accept=".jpg, .jpeg, .png" multiple />
                        <div id="previewImagesthumbnail" class="mt-3 d-flex flex-wrap gap-2"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
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
            const pageSize = 5;
            let articles = [];
            let allArticles = [];


            const renderTable = () => {
                let start = (currentPage - 1) * pageSize;
                let end = start + pageSize;
                let pagedArticles = articles.slice(start, end);

                let html = '';
                if (pagedArticles.length === 0) {
                    html = tempTablesNull();
                } else {
                    $.each(pagedArticles, function(i, item) {
                        html += `<tr>
                        <td>${start + i + 1}</td>
                        <td>${item.title}</td>
                        <td>${item.abstract ? item.abstract.substring(0, 50) + '...' : ''}</td>
                        <td>${item.author || ''}</td>
                        <td>
                            <button class="btn btn-sm ${item.article_status === 'published' ? 'btn-success' : 'btn-secondary'} w-100 btn-toggle-status" 
                                data-id="${item.article_id}" 
                                data-status="${item.article_status}">
                                ${item.article_status === 'published' ? 'Active' : 'Non Active'}
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-warning btn-edit-news" data-id="${item.article_id}">Edit</button>
                            <button class="btn btn-sm btn-outline-danger btn-delete-news" data-id="${item.article_id}">Hapus</button>
                        </td>
                    </tr>`;
                    });
                }

                $('#articleTable').html(html);
                renderPagination();
            }

            const renderPagination = () => {
                let totalPages = Math.ceil(articles.length / pageSize);
                let html = '';

                if (totalPages <= 1) {
                    $('#pagination').html('');
                    return;
                }

                for (let i = 1; i <= totalPages; i++) {
                    html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`;
                }

                $('#pagination').html(html);
            }

            const loadArticles = () => {
                getDataList('admin/news/all', function(res) {
                    if (res?.data.length > 0) {
                        articles = res?.data || [];
                        allArticles = articles;
                        currentPage = 1;
                        renderTable();
                    } else {
                        $('#articleTable').html(tempTablesNull());
                    }


                }, function() {
                    console.log('Loading articles...');
                });
            }

            $('#btn_add_category').on('click', function() {
                $('#categoryForm')[0].reset();
                $('#articleModal').modal('hide');

                $('#categoryModal').modal('show');
            });
            $('#pagination').off('click').on('click', '.page-link', function(e) {
                e.preventDefault();
                let page = parseInt($(this).data('page'));
                if (page && page !== currentPage) {
                    currentPage = page;
                    renderTable();
                }
            });


            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();
                const formData = {
                    category: $('#category_name').val(),
                    category_id: $('#category_id_show').val() || undefined,
                    descriptions: $('#category_desc').val()
                };

                postData(formData, 'admin/news/addCategory', (res) => {
                    if (res.status) {
                        $('#categoryModal').modal('hide');
                        loadCategories();
                        // setTimeout(() => {
                        //     $('#category_id_artikel').val(res.inserted_id);
                        // }, 500);
                    } else {
                        alert('Gagal menambah kategori');
                    }

                })

            });


            $('#btn_add_artikel').off('click').on('click', function() {
                $('#articleForm')[0].reset();
                $('#article_id').val('');
                $('#modalTitle').text('Tambah Artikel');
                $('#previewImagesthumbnail').empty();
                $('#articleModal').modal('show');
                loadCategories()
            });





            const getDataListCatArtikel = () => {
                getDataList('admin/news/getCategories', (res) => {
                    let html = '';

                    if (res?.data?.length > 0) {
                        res.data.forEach((item, index) => {
                            html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.category}</td>
                        <td>${item.description || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1 btn-edit-category" data-id="${item.category_id}">Edit</button>
                            <button class="btn btn-sm btn-danger btn-delete-category" data-id="${item.category_id}">Hapus</button>
                        </td>
                    </tr>
                `;
                        });
                    } else {
                        html = `
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data kategori</td>
                </tr>
            `;
                    }

                    $('#articlecatTable').html(html);
                });
            };

            $('#btn_list_catartikel').off('click').on('click', function() {
                $('#categoryListModal').modal('show');
                getDataListCatArtikel()
            })

            $('#articleForm').submit(function(e) {
                e.preventDefault();

                const fileInput = $('#thumbnail')[0];
                const file = fileInput.files[0];

                function sendData(base64Thumbnail) {
                    let formData = {
                        article_id: $('#article_id').val() || undefined,
                        category_id: $("#category_id_artikel").val() || undefined,
                        title: $('#title').val(),
                        abstract: $('#abstract').val(),
                        article_content: $('#article_content').val(),
                        author: $('#author').val() || `<?= user()->fullname ?>`,
                        article_status: $('#article_status').val(),
                    };

                    if (base64Thumbnail) {
                        formData.thumbnail_base64 = base64Thumbnail;
                    }

                    postData(formData, 'admin/news/createUpdate', (res) => {
                        if (res?.status === true) {
                            successSwal(res?.message);
                            $('#articleModal').modal('hide');
                            loadArticles();
                        } else {
                            errorSwal(res?.message);
                        }
                    }, function() {
                        console.log('Saving article...');
                    });
                }

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        sendData(evt.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    sendData(null);
                }
            });

            $('#btnsearch_users_form').off('click').on('click', function() {
                let keyword = $('#search_users_form').val().toLowerCase();
                if (keyword === '') {
                    articles = allArticles;
                } else {
                    articles = allArticles.filter(a => a.title.toLowerCase().includes(keyword));
                }
                currentPage = 1;
                renderTable();
            });


            loadArticles();


            $(document).on('click', '.btn-delete-category', function() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success ms-2",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                const id = $(this).data('id');

                swalWithBootstrapButtons.fire({
                    title: 'Yakin ingin menghapus artikel ini?',
                    text: "Tindakan ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        postData({
                            category_id: id
                        }, 'admin/news/deleteCategory', (res) => {
                            if (res?.status === true) {
                                successSwal(res?.message);
                                getDataListCatArtikel()
                            } else {
                                errorSwal(res?.message);
                                getDataListCatArtikel()
                            }
                        }, function() {
                            console.log('Deleting article...');
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire(
                            'Dibatalkan',
                            'Data tidak jadi dihapus :)',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '.btn-delete-news', function() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success ms-2",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                const id = $(this).data('id');

                swalWithBootstrapButtons.fire({
                    title: 'Yakin ingin menghapus artikel ini?',
                    text: "Tindakan ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        postData({
                            article_id: id
                        }, 'admin/news/delete', (res) => {
                            if (res?.status === true) {
                                successSwal(res?.message);
                                loadArticles();
                            } else {
                                errorSwal(res?.message);
                                loadArticles();
                            }
                        }, function() {
                            console.log('Deleting article...');
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire(
                            'Dibatalkan',
                            'Data tidak jadi dihapus :)',
                            'error'
                        );
                    }
                });
            });


        });


        const loadCategories = () => {
            getDataList('admin/news/getCategories', (res) => {
                const select = $('#category_id_artikel');
                select.empty();
                res.data.forEach((cat) => {
                    select.append(
                        `<option value="${cat.category_id}">${cat.category}</option>`
                    );
                });
            });
        };






        $(document).on('click', '.btn-toggle-status', function() {
            const button = $(this);
            const articleId = button.data('id');
            const currentStatus = button.data('status');
            const newStatus = currentStatus === 'published' ? 'draft' : 'published';

            postData({
                status: newStatus
            }, `admin/news/updateStatus/${articleId}`, (res) => {
                successSwal(res?.message)
                button
                    .data('status', newStatus)
                    .removeClass(currentStatus === 'published' ? 'btn-success' : 'btn-secondary')
                    .addClass(newStatus === 'published' ? 'btn-success' : 'btn-secondary')
                    .text(newStatus === 'published' ? 'Active' : 'Non Active');
            })
        });


        $(document).on('click', '.btn-edit-category', function() {
            const id = $(this).data('id');

            postData({
                category_id: id
            }, 'admin/news/showCategory', (res) => {
                if (res.status && res.data) {
                    const item = res.data;
                    $('#category_id_show').val(item.category_id);
                    $('#category_name').val(item.category);
                    $('#category_desc').val(item.description);
                    $('#categoryModal').modal('show');
                    $('#categoryListModal').modal('hide');

                } else {
                    errorSwal(res.message || 'Data kategori tidak ditemukan');
                }
            });
        });




        $('#articleTable').off('click').on('click', '.btn-edit-news', function() {
            loadCategories()
            let id = $(this).data('id');

            postData({
                article_id: id
            }, 'admin/news/show', (res) => {
                if (res.status) {
                    let data = res.data;
                    $('#article_id').val(data?.article_id);
                    $('#title').val(data?.title);
                    $('#abstract').val(data?.abstract);
                    $('#article_content').val(data?.article_content);
                    $('#author').val(data?.author);
                    $('#article_status').val(data?.article_status);
                    $("#category_id_artikel").val(data?.category_id || '')


                    const preview = $('#previewImagesthumbnail');
                    preview.empty();

                    if (data.thumbnail) {
                        const img = $('<img>')
                            .attr('src', data.thumbnail)
                            .css({
                                width: '100px',
                                height: '100px',
                                objectFit: 'cover',
                                borderRadius: '4px',
                                border: '1px solid #ccc',
                            });
                        preview.append(img).show();
                    } else {
                        preview.hide();
                    }

                    $('#modalTitle').text('Edit Artikel');
                    $('#articleModal').modal('show');
                } else {
                    errorSwal(res.message || 'Gagal mengambil data artikel');
                }
            }, function() {
                console.log('Fetching article detail...');
            });
        });




        $('#thumbnail').on('change', function(e) {
            const files = e.target.files;
            const preview = $('#previewImagesthumbnail');
            preview.empty();

            if (files.length === 0) return;

            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = $('<img>')
                        .attr('src', event.target.result)
                        .css({
                            width: '100px',
                            height: '100px',
                            objectFit: 'cover',
                            borderRadius: '4px',
                            border: '1px solid #ccc',
                        });
                    preview.append(img);
                };
                reader.readAsDataURL(file);
            });
        });

    })();
</script>
<?php $this->endSection(); ?>