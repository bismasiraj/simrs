<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian</title>

    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link ke file CSS kustom -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles-antrian.css') ?>">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- swal -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="queue-container">
                    <div id="ip-content" class="queue-item-poli mt-3 fw-bold" style="display: none;"></div>

                    <div id="poli-content" class="queue-item-poli mt-3 fw-bold" style="display: none;"></div>
                    <div id="queueDisplay" class="queue-item mt-3 pointer fw-bold" style="display: none;">Menunggu
                        antrian...
                    </div>
                    <div id="trx-content" class="queue-item-poli mt-3 fw-bold" style="display: none;"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="video-container">
                    <!-- <iframe id="videoFrame" frameborder="0" allowfullscreen></iframe> -->
                    <video id="videoPlayer" autoplay></video>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script src="<?= base_url('component/antrain.js?v0.0.01') ?>"></script>
</body>

</html>