<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title class="content-title"><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- swal -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>

    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        @page {
            size: A4;
        }

        body {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            font-size: 12px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .3rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .o_list_view_ungrouped {
            width: auto !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                <p><?= @$kop['contact_address'] ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
        </div>
        <div class="row date-request pb-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="fw-bold">Status</label>
                    <select id="selected-status" class="form-select">
                        <option value="1">Rawat Jalan</option>
                        <option value="0">Rawat Inap</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <h3 class="text-center content-title" id="content-title"><?= @$title ?></h3>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>No RM / Nama Pasien / Jenis Kelamin</b>
                        <div id="no_registration" name="no_registration"><?= @$visit['no_registration']; ?> /
                            <?= @$visit['diantar_oleh']; ?> / <?= @$visit['name_of_gender']; ?> </div>
                    </td>
                    <td>
                        <b>Tanggal Masuk</b>
                        <div id="thename" name="thename" class="thename"><?= @$visit['visit_date']; ?></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <b>Tanggal Lahir (Umur)</b>
                        <div id="patient_age" name="patient_age"><?= @$visit['date_of_birth']; ?>
                            (<?= @$visit['age']; ?> )</div>
                    </td>
                    <td>
                        <b>No. Episode</b>
                        <div id="theaddress" name="theaddress" class="theaddress">
                            <?= @$visit['trans_id']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Alamat</b>
                        <div id="fullname" name="fullname"><?= @$visit['contact_address']; ?></div>
                    </td>
                    <td>
                        <b>DPJP / Department</b>
                        <div id="clinic_id" name="clinic_id"><?= @@$visit['fullname']; ?> / <?= @$clin; ?>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>

        <table class="table table-bordered" id="tabels-body">
            <thead class="table-light">
                <tr>
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">Kode PPA</th>
                    <th class="text-center align-middle">Dokter/PPA</th>
                    <th class="text-center align-middle">Catatan Dokter</th>
                    <th class="text-start align-middle">Response</th>
                    <?php
                    if ($visit['isrj'] == 1 || $visit['isrj'] == "1") {
                        echo '<th class="text-start align-middle">Verifikasi</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1;  ?>
                <?php foreach ($data as $patient): ?>
                    <tr>
                        <td><?= $patient['tanggal']; ?></td>
                        <td><?= $patient['kode_ppa'] ?? $patient['petugas'] ?></td>
                        <td><?= $patient['nama_ppa'] ?? $patient['doctor'] ?? "-" ?></td>

                        <?php if ($patient['petugas'] == 'D' || $patient['petugas'] == 'd'): ?>
                            <td colspan="2" class="text-break"><?= $patient['catatan_respon'] ?? '-'; ?></td>
                        <?php else: ?>
                            <td class="text-break">-</td>
                            <td class="text-break"><?= $patient['catatan_respon'] ?? '-'; ?></td>
                        <?php endif; ?>
                        <?php
                        $class_room_id = isset($visit['class_room_id']) ? $visit['class_room_id'] : null;
                        if (!$class_room_id) {
                            echo '<td>' . $patient['verifikasi'] . '</td>';
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    const defaultStatus = <?= json_encode($visit['isrj']) ?>;
    const visit = '<?= $visit1 ?>';
    $(document).ready(function() {
        if (defaultStatus !== null) {
            $('#selected-status').val(defaultStatus);
        }

        $('#selected-status').on('change', function() {
            const selectedValue = $(this).val();

            postData({
                status: selectedValue,
                visit: visit
            }, 'admin/rm/LAINNYA/cppt_preview', (res) => {
                $('.content-title').text(res.title);
                $('#tabels-body tbody').empty();

                if (selectedValue == 1) {
                    $('#tabels-body thead tr').append(
                        '<th class="text-start align-middle">Verifikasi</th>');
                } else {
                    if ($('#tabels-body thead th').length > 5) {
                        $('#tabels-body thead th:last').remove();
                    }
                }

                if (res.data.length > 0) {
                    res.data.forEach((patient, index) => {

                        let row = `<tr>
                        <td>${patient.tanggal}</td>
                        <td>${patient.kode_ppa??patient.petugas}</td>
                        <td>${patient.nama_ppa ?? patient.doctor ?? '-'}</td>`;

                        if (patient.kode_ppa === 'D' || patient.petugas === 'D' || patient
                            .petugas === 'd') {
                            row +=
                                `<td colspan="2" class="text-break">${patient.catatan_respon ? patient.catatan_respon : '-'}</td>`;
                        } else {
                            row += `<td class="text-break">-</td>
                                <td class="text-break">${patient.catatan_respon ? patient.catatan_respon : '-'}</td>`;
                        }

                        if (patient?.isrj === "1" || patient?.isrj === 1) {
                            row +=
                                `<td>${patient.verifikasi ? patient.verifikasi : '-'}</td>`;
                        }

                        row += `</tr>`;

                        $('#tabels-body tbody').append(row);
                    });
                } else {
                    const colspan = selectedValue === 0 ? 5 :
                        6;
                    $('#tabels-body tbody').append(
                        `<tr><td colspan="${colspan}" class="text-center">No data available</td></tr>`
                    );
                }
            });
        });
    });
</script>


<style>
    @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }

        .date-request {
            display: none;
        }
    }
</style>

</html>