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
            <h4 class="text-start">RL 4-B DATA KEADAAN MORBIDITAS PASIEN RAWAT JALAN RUMAH SAKIT</h4>
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
                    <th class="p-1 align-middle text-center" rowspan="3">No</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No.DTD</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No. Daftar Terperinci</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Golongan Sebab-Sebab Sakit</th>
                    <th class="p-1 align-middle text-center" colspan="18">Kasus Baru Menurut Golongan Umur</th>
                    <th class="p-1 align-middle text-center" colspan="3">Kasus baru Menurut Sex</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Jumlah Kunjungan</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center" colspan="2">0 - 6 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2">7 - 28 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2">
                        < 1 TH</th>
                    <th class="p-1 align-middle text-center" colspan="2">1 - 4 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">5 - 14 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">15 - 24 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">25 - 44 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">45 - 64 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">>= 65 th</th>
                    <th class="p-1 align-middle text-center" rowspan="2">L</th>
                    <th class="p-1 align-middle text-center" rowspan="2">P</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Jml</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>

                </tr>
            </thead>
            <tbody id="data-all">
                <?php 
                        $groupedData = [];
                        $totalVisits = 0;
                        foreach ($data as $row) {
                            $daftarterinci = $row['daftarterinci'];
                            $gender = $row['gender'];
                            $ageyear = $row['ageyear'];
                            $result_id = $row['result_id'];
                            $suffer_type = @$row['suffer_type'];

                            if ($ageyear <= 0) {
                                $ageGroup = '0-6 HR';
                            } elseif ($ageyear <= 1) {
                                $ageGroup = '7-28 HR';
                            } elseif ($ageyear < 1) {
                                $ageGroup = '<1 TH';
                            } elseif ($ageyear <= 4) {
                                $ageGroup = '1-4 TH';
                            } elseif ($ageyear <= 14) {
                                $ageGroup = '5-14 TH';
                            } elseif ($ageyear <= 24) {
                                $ageGroup = '15-24 TH';
                            } elseif ($ageyear <= 44) {
                                $ageGroup = '25-44 TH';
                            } elseif ($ageyear <= 64) {
                                $ageGroup = '45-64 TH';
                            } else {
                                $ageGroup = '>=65 TH';
                            }

                            if (!isset($groupedData[$daftarterinci][$ageGroup])) {
                                $groupedData[$daftarterinci][$ageGroup] = [
                                    'icd10' => $row['icd10'],
                                    'nodtd' => $row['nodtd'],
                                    'golongan_sakit' => $row['golongan_sakit'],
                                    'L' => 0, 
                                    'P' => 0, 
                                    'mati' => 0,
                                ];
                            }

                            if ($gender == '1' && ($suffer_type == 0 || $suffer_type == 1)) {
                                $groupedData[$daftarterinci][$ageGroup]['L'] += $row['jml'];
                            } elseif ($gender == '2' && ($suffer_type == 0 || $suffer_type == 1)) {
                                $groupedData[$daftarterinci][$ageGroup]['P'] += $row['jml'];
                            }

                            $totalVisits += $row['jml'];
                        }

                        $index = 1;
                        foreach ($groupedData as $daftarterinci => $ageGroups) {
                            foreach ($ageGroups as $ageGroup => $row) {
                                $totalL += $row['L'];
                                $totalP += $row['P'];
                                $totalMati += $row['jml'];

                                echo "<tr>";
                                echo "<td class='p-1'>". $index++ . "</td>";
                                echo "<td class='p-1'>" . htmlspecialchars($row['nodtd']) . "</td>";
                                echo "<td class='p-1'>" . htmlspecialchars($daftarterinci) . "</td>";
                                echo "<td class='p-1'>" . htmlspecialchars($row['golongan_sakit']) . "</td>";

                                for ($i = 0; $i < 9; $i++) {
                                    $ageLabel = ['0-6 HR', '7-28 HR', '<1 TH', '1-4 TH', '5-14 TH', '15-24 TH', '25-44 TH', '45-64 TH', '>=65 TH'][$i];
                                    echo "<td class='p-1 text-center'>" . (($ageGroup == $ageLabel) ? $row['L'] : '') . "</td>";
                                    echo "<td class='p-1 text-center'>" . (($ageGroup == $ageLabel) ? $row['P'] : '') . "</td>";
                                }
                                echo "<td class='p-1 text-center'>" . $totalL . "</td>";
                                echo "<td class='p-1 text-center'>" . $totalP . "</td>";
                                echo "<td class='p-1 text-center'>" . ($totalL + $totalP) . "</td>";
                                echo "<td class='p-1 text-center'>" . $totalVisits . "</td>";
                                echo "</tr>";
                            }

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
            url: '/admin/cetak/rl_4_B',
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                $('#data-all').empty();

                if (Array.isArray(response.data)) {
                    let totalData = {};
                    let index = 1;
                    let total = 0;

                    response.data.forEach(function(row) {
                        let daftarterinci = row.daftarterinci;
                        let gender = row.gender;
                        let ageyear = row.ageyear;

                        let suffer_type = $row.suffer_type;
                        let result_id = row.result_id;

                        let ageGroup;
                        if (ageyear <= 0) {
                            ageGroup = '0-6 HR';
                        } else if (ageyear <= 1) {
                            ageGroup = '7-28 HR';
                        } else if (ageyear < 1) {
                            ageGroup = '<1 TH';
                        } else if (ageyear <= 4) {
                            ageGroup = '1-4 TH';
                        } else if (ageyear <= 14) {
                            ageGroup = '5-14 TH';
                        } else if (ageyear <= 24) {
                            ageGroup = '15-24 TH';
                        } else if (ageyear <= 44) {
                            ageGroup = '25-44 TH';
                        } else if (ageyear <= 64) {
                            ageGroup = '45-64 TH';
                        } else {
                            ageGroup = '>=65 TH';
                        }

                        if (!totalData[daftarterinci]) {
                            totalData[daftarterinci] = {
                                'nodtd': row.nodtd,
                                'golongan_sakit': row.golongan_sakit,
                                'ageGroups': {},
                                'totalL': 0,
                                'totalP': 0,
                                'totalMati': 0
                            };
                        }

                        if (gender == '1' && (suffer_type == 0 || suffer_type ==
                                1)) {
                            totalData[daftarterinci]['totalL'] += row.jml;
                            if (!totalData[daftarterinci]['ageGroups'][ageGroup]) {
                                totalData[daftarterinci]['ageGroups'][ageGroup] = {
                                    'L': 0,
                                    'P': 0,
                                    'mati': 0
                                };
                            }
                            totalData[daftarterinci]['ageGroups'][ageGroup]['L'] +=
                                row.jml;
                        } else if (gender == '2' && (suffer_type == 0 ||
                                suffer_type ==
                                1)) {
                            totalData[daftarterinci]['totalP'] += row.jml;
                            if (!totalData[daftarterinci]['ageGroups'][ageGroup]) {
                                totalData[daftarterinci]['ageGroups'][ageGroup] = {
                                    'L': 0,
                                    'P': 0,
                                    'mati': 0
                                };
                            }
                            totalData[daftarterinci]['ageGroups'][ageGroup]['P'] +=
                                row.jml;
                        }

                        total += row.jml;
                    });

                    for (const daftarterinci in totalData) {
                        let row = totalData[daftarterinci];
                        let newRow = "<tr>";
                        newRow += "<td class='p-1'>" + index++ + "</td>";
                        newRow += "<td class='p-1'>" + row.nodtd + "</td>";
                        newRow += "<td class='p-1'>" + daftarterinci + "</td>";
                        newRow += "<td class='p-1'>" + row.golongan_sakit + "</td>";

                        for (const ageGroup of ['0-6 HR', '7-28 HR', '<1 TH', '1-4 TH',
                                '5-14 TH', '15-24 TH', '25-44 TH', '45-64 TH', '>=65 TH'
                            ]) {
                            if (row.ageGroups[ageGroup]) {
                                newRow += "<td class='p-1 text-center'>" + row.ageGroups[
                                    ageGroup].L + "</td>";
                                newRow += "<td class='p-1 text-center'>" + row.ageGroups[
                                    ageGroup].P + "</td>";
                            } else {
                                newRow += "<td class='p-1 text-center'></td>";
                                newRow += "<td class='p-1 text-center'></td>";
                            }
                        }

                        newRow += "<td class='p-1 text-center'>" + row.totalL + "</td>";
                        newRow += "<td class='p-1 text-center'>" + row.totalP + "</td>";
                        newRow += "<td class='p-1 text-center'>" + (row.totalL + row
                            .totalP) + "</td>";
                        newRow += "<td class='p-1 text-center'>" + total + "</td>";
                        newRow += "</tr>";

                        $('#data-all').append(newRow);
                    }

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