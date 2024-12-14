<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian</title>

    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">

    <!-- Link ke file CSS kustom -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles-antrian.css">

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>

    <!-- Moment.js -->
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>

    <!-- Flatpickr JS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/flatpickr/flatpickr.min.css">
    <script src="<?= base_url(); ?>assets/libs/flatpickr/flatpickr.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assetsss\font-awesome\css\font-awesome.css">

    <!-- swal -->
    <link href="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js">

</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 text-center">
                <div class="queue-container">
                    <div id="ip-content" class="queue-item-poli mt-3 fw-bold pointer" style="display: none;"></div>

                    <div id="poli-content" class="queue-item-poli mt-3 fw-bold" style="display: none;"></div>
                    <div id="queueDisplay" class="queue-item mt-3 pointer fw-bold" style="display: none;">Menunggu
                        antrian...
                    </div>
                    <div id="trx-content" class="queue-item-poli mt-3 fw-bold" style="display: none;"></div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 text-center">
                <div class="video-container">
                    <!-- <iframe id="videoFrame" frameborder="0" allowfullscreen></iframe> -->
                    <video id="videoPlayer" autoplay class="pointer" style="width: 100%;"></video>

                </div>
                <div id="clock" class="text-center mt-2">

                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ipModal" tabindex="-1" aria-labelledby="ipModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ipModalLabel">Konfigurasi Alamat IP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="fw-bold">Masukkan Alamat IP yang Diinginkan</label>
                        <input type="text" class="form-control" id="set-ipModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary" id="save-setIp">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url() ?>assets/js/default.js"></script>
    <script type="module" src="<?= base_url() ?>component/antrain.js?v0.0.02"></script>
</body>

</html>