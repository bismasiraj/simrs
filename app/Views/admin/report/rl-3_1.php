<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        crossorigin="anonymous">



    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>



    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        /* .form-control,
    .input-group-text {
        background-color: #fff;
        border: 1px solid #fff;
        font-size: 12px;
    } */


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

        @media print {
            @page {
                margin: none;
                scale: 85;
                size: A4 landscape;
                width: auto;
            }

            body {
                width: auto;
                /* Memastikan konten mencakup seluruh lebar kertas A4 */
                height: auto;
                /* Mengatur tinggi halaman otomatis sesuai dengan konten */
                margin: 0;
                font-size: 12px;
            }

            .logo-ci4 {
                display: none;
            }

            .container {
                width: 100%;
                margin: 0 auto;
            }

            .date-request {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <h4 class="text-start">RL 3.1 KEGIATAN PELAYANAN RAWAT INAP</h4>
        </div>

        <div class="row date-request pb-3">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="startDate">Start Date</label>
                    <input type="text" id="startDate" class="form-control dateflatpickr flatpickr-input active">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="text" id="endDate" class="form-control dateflatpickr flatpickr-input">
                </div>
            </div>
            <div class="col-md-3">
                <div class="row pt-3">
                    <div class="form-group d-flex justify-content-between align-items-center w-100">
                        <button type="button" id="submitDate" class="btn btn-primary" name="cari">
                            <i class="fa fa-search"></i> Lihat
                        </button>
                        <button type="button" id="cetak-submit" class="btn btn-outline-warning">
                            <i class="fa-solid fa-print"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>


        </div>

        <table class="table table-bordered" id="reportTable">
            <thead>
                <tr>
                    <td class="p-1">Tahun</td>
                    <td class="p-1">No</td>
                    <td class="p-1">Pelayanan</td>
                    <td class="p-1">Pasien Awal Tahun</td>
                    <td class="p-1">Pasien Masuk</td>
                    <td class="p-1">Pasien Keluar Hidup</td>
                    <td class="p-1">Mati &lt; 48 jam</td>
                    <td class="p-1">Mati &gt;= 48 jam</td>
                    <td class="p-1">Jumlah Lama Dirawat</td>
                    <td class="p-1">Pasien Akhir Tahun</td>
                    <td class="p-1">Jumlah Hari Perawatan</td>
                    <td class="p-1">VVIP</td>
                    <td class="p-1">VIP</td>
                    <td class="p-1">I</td>
                    <td class="p-1">II</td>
                    <td class="p-1">III</td>
                    <td class="p-1">Kelas Khusus</td>
                </tr>
            </thead>
            <tbody id="data-all">
                <?php
                foreach ($data as $index => $row) {
                    echo "<tr>";
                    echo "<td class='p-1'></td>"; // Menampilkan tahun dari data
                    echo "<td class='p-1'>" . ($index + 1) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['clinictype']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['awal']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['masuk']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['hidup']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['matik48']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['matil48']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['lama']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['awal'] + $row['masuk'] - $row['hidup'] - $row['matik48'] - $row['matil48']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['hari']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['harivvip']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['harivip']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['harik1']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['harik2']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['harik3']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars($row['harinon']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>

        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.dateflatpickr').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });

        $('#cetak-submit').on('click', function(e) {
            window.print();

        })

        let tgl = new Date();

        $('#startDate').val(moment(tgl).format("YYYY-MM-01"))
        $('#endDate').val(moment(tgl).format("YYYY-MM-DD"))

        $('#submitDate').on('click', function(e) {
            e.preventDefault();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();


            $.ajax({
                url: '/admin/cetak/rl_3_1',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {

                    $('#data-all').empty();
                    console.log(response);


                    if (Array.isArray(response.data)) {
                        response.data.forEach(function(row, index) {
                            var newRow = "<tr>";
                            newRow += "<td class='p-1'></td>";
                            newRow += "<td class='p-1'>" + (index + 1) + "</td>";
                            newRow += "<td class='p-1'>" + row.clinictype + "</td>";
                            newRow += "<td class='p-1'>" + row.awal + "</td>";
                            newRow += "<td class='p-1'>" + row.masuk + "</td>";
                            newRow += "<td class='p-1'>" + row.hidup + "</td>";
                            newRow += "<td class='p-1'>" + row.matik48 + "</td>";
                            newRow += "<td class='p-1'>" + row.matil48 + "</td>";
                            newRow += "<td class='p-1'>" + row.lama + "</td>";
                            newRow += "<td class='p-1'>" + (row.awal + row.masuk - row
                                .hidup - row.matik48 - row.matil48) + "</td>";
                            newRow += "<td class='p-1'>" + row.hari + "</td>";
                            newRow += "<td class='p-1'>" + row.harivvip + "</td>";
                            newRow += "<td class='p-1'>" + row.harivip + "</td>";
                            newRow += "<td class='p-1'>" + row.harik1 + "</td>";
                            newRow += "<td class='p-1'>" + row.harik2 + "</td>";
                            newRow += "<td class='p-1'>" + row.harik3 + "</td>";
                            newRow += "<td class='p-1'>" + row.harinon + "</td>";
                            newRow += "</tr>";

                            $('#data-all').append(newRow);
                        });
                    } else {
                        console.error("Data tidak tersedia atau bukan array");
                    }
                },

                error: function(xhr, status, error) {

                    console.log('Error:', error);
                }
            });
        });
    });
</script>

</html>