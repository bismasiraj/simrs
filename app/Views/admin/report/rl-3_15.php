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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        crossorigin="anonymous">



    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
            <h4 class="text-start">RL 3.15 CARA BAYAR</h4>
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
                    <th class="p-1 align-middle text-center" rowspan="2">No</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Cara Pembayaran</th>
                    <th class="p-1 align-middle text-center" colspan="2">Pasien Rawat Inap</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Jumlah Pasien Rawat Jalan</th>
                    <th class="p-1 align-middle text-center" colspan="3">Jumlah Pasien Rawat Jalan</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center">Jumlah Pasien Keluar</th>
                    <th class="p-1 align-middle text-center">Jumlah Lama Dirawat</th>
                    <th class="p-1 align-middle text-center">Laboratorium</th>
                    <th class="p-1 align-middle text-center">Radiologi</th>
                    <th class="p-1 align-middle text-center">Lain-Lain</th>
                </tr>
            </thead>
            <tbody id="data-all">
                <?php 
                        $tpasien_ranap = 0; 
                        $thari_rawat = 0; 
                        $tpasien_ralan = 0; 
                        $tlab = 0; 
                        $tro = 0; 
                        $tlain = 0; 
                        foreach (@$data as $index => $row) {
                            echo "<tr>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['display']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['paymethod']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['pasien_ranap']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['hari_rawat']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['pasien_ralan']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['lab']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['ro']) . "</td>";
                            echo "<td class='p-1'>" . htmlspecialchars(@$row['lain']) . "</td>";
                            
                            echo "</tr>";
                            $tpasien_ranap += @$row['pasien_ranap'];
                            $thari_rawat += @$row['hari_rawat'];
                            $tpasien_ralan += @$row['pasien_ralan'];
                            $tlab += @$row['lab'];
                            $tro += @$row['ro'];
                            $tlain += @$row['lain'];
                            
                        }
                    ?>
                <tr>
                    <td colspan='2' class='p-1 text-end'><strong>Total:</strong></td>

                    <td class="p-1"><strong><?php echo htmlspecialchars($tpasien_ranap); ?></strong></td>
                    <td class="p-1"><strong><?php echo htmlspecialchars($thari_rawat); ?></strong></td>
                    <td class="p-1"><strong><?php echo htmlspecialchars($tpasien_ralan); ?></strong></td>
                    <td class="p-1"><strong><?php echo htmlspecialchars($tlab); ?></strong></td>
                    <td class="p-1"><strong><?php echo htmlspecialchars($tro); ?></strong></td>
                    <td class="p-1"><strong><?php echo htmlspecialchars($tlain); ?></strong></td>
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
            url: '/admin/cetak/rl_3_15',
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                $('#data-all').empty();
                if (Array.isArray(response.data)) {
                    let tpasien_ranap = 0
                    let thari_rawat = 0
                    let tpasien_ralan = 0
                    let tlab = 0
                    let tro = 0
                    let tlain = 0

                    response.data.forEach(function(row, index) {
                        let newRow = "<tr>";
                        let formattedDate = row.treat_date ? moment(row.treat_date)
                            .format('YYYY') : '';
                        newRow += "<td class='p-1'>" + row.display + "</td>";
                        newRow += "<td class='p-1'>" + row.paymethod + "</td>";
                        newRow += "<td class='p-1'>" + row.pasien_ranap + "</td>";
                        newRow += "<td class='p-1'>" + row.hari_rawat + "</td>";
                        newRow += "<td class='p-1'>" + row.pasien_ralan + "</td>";
                        newRow += "<td class='p-1'>" + row.lab + "</td>";
                        newRow += "<td class='p-1'>" + row.ro + "</td>";
                        newRow += "<td class='p-1'>" + row.lain + "</td>";
                        newRow += "</tr>";

                        $('#data-all').append(newRow);
                        tpasien_ranap += row?.pasien_ranap
                        thari_rawat += row?.hari_rawat
                        tpasien_ralan += row?.pasien_ralan
                        tlab += row?.lab
                        tro += row?.ro
                        tlain += row?.lain
                    });

                    let totalRow = "<tr>";
                    totalRow +=
                        "<td colspan='2' class='p-1 text-end'><strong>Total:</strong></td>";
                    totalRow += "<td class='p-1'><strong>" + tpasien_ranap +
                        "</strong></td>";
                    totalRow += "<td class='p-1'><strong>" + thari_rawat + "</strong></td>";
                    totalRow += "<td class='p-1'><strong>" + tpasien_ralan +
                        "</strong></td>";
                    totalRow += "<td class='p-1'><strong>" + tlab + "</strong></td>";
                    totalRow += "<td class='p-1'><strong>" + tro + "</strong></td>";
                    totalRow += "<td class='p-1'><strong>" + tlain + "</strong></td>";
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

// window.print();
</script>


</html>