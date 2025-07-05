<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>

    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/default.css') ?>">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    <style>
    body,
    html {
        height: 100%;
        margin: 0;
    }

    #app {
        display: flex;
        flex-direction: row;
        /* height: 100vh; */
        overflow: hidden;
    }

    #newsDetail {
        flex: 2;
        padding: 20px;
        overflow-y: auto;
        border-right: 1px solid #ccc;
    }

    #newsList {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        /* background: #f1f1f1; */
    }

    .news-card {
        background: #fff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        display: flex;
        gap: 10px;
        cursor: pointer;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s ease;
    }

    .news-card:hover {
        background-color: #e9ecef;
    }

    .news-card.active {
        background-color: #cce5ff;
        border-left: 4px solid #0d6efd;
    }

    .news-card img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    .news-card .title {
        font-weight: bold;
        font-size: 0.95rem;
    }

    #newsDetail img {
        width: 50vh;
        border-radius: 8px !important;
        margin-bottom: 15px;
    }

    #newsDetail .date {
        font-style: italic;
        color: #888;
    }

    /* Mobile friendly */
    @media (max-width: 768px) {
        #app {
            flex-direction: column;
        }

        #newsDetail,
        #newsList {
            flex: unset;
            width: 100%;
            padding: 15px;
            border-right: none;
        }

        .news-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .news-card img {
            width: 100%;
            height: auto;
        }

        .news-card .title {
            font-size: 1rem;
        }

        #detailImage {
            width: 50vh;
            height: auto;
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">News Portal</a>
        </div>
    </nav>

    <div id="app" class="container-fluid">
        <div id="newsDetail">
            <div class="card shadow-sm"
                style="border-radius: 19px;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3) !important;">
                <div class="card-body">
                    <h3 class="card-title fw-bold" id="detailTitle">Pilih berita untuk melihat detail</h3>
                    <p class="card-subtitle mb-2 text-muted date" id="detailDate"></p>
                    <img id="detailImage" src="" alt="" class="img-fluid rounded mb-3" style="display: none" />
                    <p class="card-text" id="detailContent"></p>
                </div>
            </div>
        </div>

        <div id="newsList"></div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script type="module" src="<?= base_url('component/news.js?v0.0.01') ?>"></script>
</body>

</html>