<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Pendaftaran</title>

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
                    <div id="ip-content" class="queue-item-poli mt-3 fw-bold pointer" style="display: none;"></div>
                    <div id="queueDisplay" class="queue-item mt-3 pointer fw-bold" style="display: none;">Menunggu
                        antrian...
                    </div>


                </div>
            </div>


            <div class="col-md-5" style="margin-top: 23vh;">
                <div id="groupe-content" class="row">

                </div>
                <div id="clock" class="text-center mt-2">

                </div>
            </div>
            <div class="col-md-6" hidden>
                <div class="video-container">
                    <!-- <iframe id="videoFrame" frameborder="0" allowfullscreen></iframe> -->
                    <video id="videoPlayer" class="pointer" autoplay style="width: 100%;" muted></video>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script type="module" src="<?= base_url('component/pendaftaran.js?v0.0.01') ?>"></script>
</body>

</html>