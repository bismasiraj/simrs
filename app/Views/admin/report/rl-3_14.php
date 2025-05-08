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
            <h4 class="text-start">RL 3.14 KEGIATAN RUJUKAN</h4>
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
                    <th class="p-1 align-middle text-center">Tahun</th>
                    <th class="p-1 align-middle text-center">No</th>
                    <th class="p-1 align-middle text-center">Jenis Spesialisasi</th>
                    <th class="p-1 align-middle text-center">Rujukan_Diterina dari Puskesmas</th>
                    <th class="p-1 align-middle text-center">Rujukan_Diterima dari fasilitas kesehatan lain</th>
                    <th class="p-1 align-middle text-center">Rujukan_Diterima dari RS lain</th>
                    <th class="p-1 align-middle text-center">Rujukan_Dikembalikan ke puskesmas</th>
                    <th class="p-1 align-middle text-center">Rujukan_Dikembalikan ke fasilitas faskes Lain</th>
                    <th class="p-1 align-middle text-center">Rujukan_Dikembalikan ke RS Asal</th>
                    <th class="p-1 align-middle text-center">Dirujuk Pasien Rujukan</th>
                    <th class="p-1 align-middle text-center">Dirujuk_Pasien Datang Sendiri</th>
                    <th class="p-1 align-middle text-center">Dirujuk Diterima Kembali</th>
                </tr>
            </thead>
            <tbody id="data-all">
                <?php 
                    $totalJumlahisactive = 0; 
                    $totalJumlahisgeneric = 0; 
                    $totalJumlahisformularium = 0; 

                    $groupedData = [];

                    foreach ($data as $current) {
                        $key = $current['clinic_type'];

                        if (!isset($groupedData[$key])) {
                            $groupedData[$key] = [
                                "clinic_type" => $key,
                                "clinictype" => $current['clinictype'],
                                "totalJml" => 0,
                                "sub" => []
                            ];
                        }

                        $groupedData[$key]['sub'][] = [
                            "follow_up" => $current['follow_up'],
                            "jml" => $current['jml'],
                            "rujukan_id" => $current['rujukan_id']
                        ];

                        $groupedData[$key]['totalJml'] += $current['jml'];
                    }

                    $result = array_values($groupedData);

                    foreach ($result as $index => $row) {
                        $treatDateFormatted = (new DateTime())->format('Y');
                        echo "<tr>";
                        echo "<td class='p-1'>" . htmlspecialchars($treatDateFormatted) . "</td>";
                        echo "<td class='p-1'>" . ($index + 1) . "</td>";
                        echo "<td class='p-1'>" . htmlspecialchars($row['clinictype']) . "</td>";

                        $jumlahKolom4 = 0;
                        $jumlahKolom5 = 0;
                        $jumlahKolom6 = 0;
                        $jumlahKolom7 = 0;
                        $jumlahKolom8 = 0;
                        $jumlahKolom9 = 0;
                        $jumlahKolom10 = 0;
                        $jumlahKolom11 = 0;

                        foreach ($row['sub'] as $subRow) {
                            if ($subRow['rujukan_id'] === "3" && $subRow['follow_up'] === "0") {
                                $jumlahKolom4 += $subRow['jml'] ?? 0;
                            }

                            if (!in_array($subRow['rujukan_id'], ["1", "3", "4", "5"])) {
                                $jumlahKolom5 += $subRow['jml'] ?? 0;
                            }

                            if (in_array($subRow['rujukan_id'], ["4", "5"])) {
                                $jumlahKolom6 += $subRow['jml'] ?? 0;
                            }

                            if ($subRow['follow_up'] == "9") {
                                $jumlahKolom7 += $subRow['jml'] ?? 0;
                            }

                            if (in_array($subRow['follow_up'], ["3", "8"])) {
                                $jumlahKolom8 += $subRow['jml'] ?? 0;
                            }

                            if ($subRow['follow_up'] == "7") {
                                $jumlahKolom9 += $subRow['jml'] ?? 0;
                            }

                            if ($subRow['follow_up'] == "2") {
                                $jumlahKolom10 += $subRow['jml'] ?? 0;
                            }

                            if ($subRow['rujukan_id'] == "1" && $subRow['follow_up'] != "0") {
                                $jumlahKolom11 += $subRow['jml'] ?? 0;
                            }
                        }

                        echo "<td class='p-1'>" . $jumlahKolom4 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom5 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom6 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom7 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom8 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom9 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom10 . "</td>";
                        echo "<td class='p-1'>" . $jumlahKolom11 . "</td>";
                        echo "<td class='p-1'>" . 0 . "</td>";

                        echo "</tr>";

                    }
                    ?>



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
            url: '/admin/cetak/rl_3_14',
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                $('#data-all').empty();
                if (Array.isArray(response.data)) {
                    let totalJumlah = 0;

                    const groupedData = response.data.reduce((acc, current) => {
                        const key = current.clinic_type;

                        if (!acc[key]) {
                            acc[key] = {
                                clinic_type: key,
                                clinictype: current.clinictype,
                                totalJml: 0,
                                sub: []
                            };
                        }

                        acc[key].sub.push({
                            follow_up: current.follow_up,
                            jml: current.jml,
                            rujukan_id: current.rujukan_id
                        });

                        acc[key].totalJml += current.jml;

                        return acc;
                    }, {});

                    const result = Object.values(groupedData);

                    result.forEach(function(row, index) {
                        let formattedDate = moment($("#startDate")
                                .val())
                            .format('YYYY') ?? '';

                        let newRow = "<tr>";
                        newRow += "<td class='p-1'>" + formattedDate + "</td>";
                        newRow += "<td class='p-1'>" + (index + 1) + "</td>";
                        newRow += "<td class='p-1'>" + row.clinictype + "</td>";


                        let jumlahKolom4 = 0;
                        let jumlahKolom5 = 0;
                        let jumlahKolom6 = 0;
                        let jumlahKolom7 = 0;
                        let jumlahKolom8 = 0;
                        let jumlahKolom9 = 0;
                        let jumlahKolom10 = 0;
                        let jumlahKolom11 = 0;
                        let jumlahKolom12 = 0;


                        row.sub.forEach(function(subRow) {

                            if (parseInt(subRow.rujukan_id) === 3 &&
                                parseInt(subRow.follow_up) ===
                                0) {
                                jumlahKolom4 += subRow.jml ?? 0;
                            }

                            if (![1, 3, 4, 5].includes(parseInt(
                                    subRow.rujukan_id))) {
                                jumlahKolom5 += subRow.jml ?? 0;
                            }
                            if ([4, 5].includes(parseInt(subRow
                                    .rujukan_id))) {
                                jumlahKolom6 += subRow.jml ?? 0;
                            }
                            if (parseInt(subRow.follow_up) === 9) {
                                jumlahKolom7 += subRow.jml ?? 0;
                            }

                            if ([3, 8].includes(parseInt(subRow
                                    .follow_up))) {
                                jumlahKolom8 += subRow.jml ?? 0;
                            }
                            if (parseInt(subRow.follow_up) === 7) {
                                jumlahKolom9 += subRow.jml ?? 0;
                            }
                            if (parseInt(subRow.follow_up) === 2) {
                                jumlahKolom10 += subRow.jml ?? 0;
                            }

                            if (parseInt(subRow.rujukan_id) === 1 &&
                                parseInt(subRow.follow_up) !==
                                0) {
                                jumlahKolom11 += subRow.jml ?? 0;
                            }

                        });

                        newRow += "<td class='p-1'>" + jumlahKolom4 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom5 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom6 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom7 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom8 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom9 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom10 +
                            "</td>";
                        newRow += "<td class='p-1'>" + jumlahKolom11 +
                            "</td>";

                        newRow += "<td class='p-1'>" + 0 +
                            "</td>";

                        newRow += "</tr>";
                        $('#data-all').append(newRow);
                        totalJumlah +=
                            row.totalJml;
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

// window.print();
</script>


</html>