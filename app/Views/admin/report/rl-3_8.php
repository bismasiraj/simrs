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
            <h4 class="text-start">RL 3.8 KEGIATAN LABORATORIUM</h4>
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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Jumlah</th>
                </tr>
            </thead>
            <tbody id="data-all">
                <?php
                $totalJumlah = 0;
                foreach ($data as $index => $row) {
                    echo "<tr>";
                    $treatDateFormatted = !empty($row['treat_date']) ? "<script>document.write(moment('" . htmlspecialchars($row['treat_date']) . "').format('YYYY'));</script>" : '';
                    echo "<td class='p-1'>" . $treatDateFormatted . "</td>";
                    echo "<td class='p-1'>" . ($index + 1) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars(@$row['treatment']) . "</td>";
                    echo "<td class='p-1'>" . htmlspecialchars(@$row['jml']) . "</td>";
                    echo "</tr>";
                    $totalJumlah += $row['jml'];
                }
                ?>
                <tr>
                    <td colspan='3' class='p-1 text-end'><strong>Total:</strong></td>
                    <td class="p-1"><strong><?php echo htmlspecialchars($totalJumlah); ?></strong></td>
                </tr>
            </tbody>
        </table>
        </form>
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
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();


            $.ajax({
                url: '/admin/cetak/rl_3_8',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    $('#data-all').empty();
                    if (Array.isArray(response.data)) {
                        let totalJumlah = 0;
                        response.data.forEach(function(row, index) {
                            let newRow = "<tr>";
                            let formattedDate = row.treat_date ? moment(row.treat_date)
                                .format('YYYY') : '';
                            newRow += "<td class='p-1'>" + formattedDate + "</td>";
                            newRow += "<td class='p-1'>" + (index + 1) + "</td>";
                            newRow += "<td class='p-1'>" + row.treatment + "</td>";
                            newRow += "<td class='p-1'>" + row.jml + "</td>";
                            newRow += "</tr>";

                            $('#data-all').append(newRow);
                            totalJumlah += row.jml;
                        });

                        let totalRow = "<tr>";
                        totalRow +=
                            "<td colspan='3' class='p-1 text-end'><strong>Total:</strong></td>";
                        totalRow += "<td class='p-1'><strong>" + totalJumlah + "</strong></td>";
                        totalRow += "</tr>";

                        $('#data-all').append(totalRow);
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