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
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

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
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <h4 class="text-start">RL 1.3 Tempat Tidur</h4>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="p-1">
                        Tahun
                    </th>
                    <th class="p-1">
                        Jenis Pelayanan
                    </th>
                    <th class="p-1">
                        Total
                    </th>
                    <th class="p-1">
                        VVIP
                    </th>
                    <th class="p-1">
                        VIP
                    </th>
                    <th class="p-1">
                        Kls 1
                    </th>
                    <th class="p-1">
                        Kls 2
                    </th>
                    <th class="p-1">
                        Kls 3
                    </th>
                    </th>
                    <th class="p-1">
                        Kls Khusus
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $groupedData = [];
                foreach ($data as $item) {
                    $clinicType = $item['clinictype'];
                    if (!isset($groupedData[$clinicType])) {
                        $groupedData[$clinicType] = [
                            'jenis_pelayanan' => $clinicType,
                            'total' => 0,
                            'vvip' => 0,
                            'vip' => 0,
                            'kls_1' => 0,
                            'kls_2' => 0,
                            'kls_3' => 0,
                            'kls_khusus' => 0,
                        ];
                    }

                    $groupedData[$clinicType]['total']++;
                    switch ($item['class_id']) {
                        case 6: // KLAS VIP
                            $groupedData[$clinicType]['vip']++;
                            break;
                        case 1: // Utama

                        case 2: // Kelas I
                            $groupedData[$clinicType]['kls_1']++;
                            break;
                        case 3: // Kelas II
                            $groupedData[$clinicType]['kls_2']++;
                            break;
                        case 4: // Kelas III
                            $groupedData[$clinicType]['kls_3']++;
                            break;
                        case 0: // Rawat Jalan
                        case 5: // KLAS III B
                        case 7: // KLAS VIP 1
                            $groupedData[$clinicType]['vvip']++;
                            break;
                        case 8: // KLAS Super VIP
                            $groupedData[$clinicType]['kls_khusus']++;
                            break;

                        case 9: // ICU
                        case 11: // UMUM
                            $groupedData[$clinicType]['kelas_lain']++;
                            break;
                    }
                }

                foreach ($groupedData as $row) {
                    echo '<tr>';
                    echo '<td class="p-1"></td>';
                    echo '<td class="p-1">' . htmlspecialchars($row['jenis_pelayanan']) . '</td>';
                    echo '<td class="p-1">' . $row['total'] . '</td>';
                    echo '<td class="p-1">' . $row['vvip'] . '</td>';
                    echo '<td class="p-1">' . $row['vip'] . '</td>';
                    echo '<td class="p-1">' . $row['kls_1'] . '</td>';
                    echo '<td class="p-1">' . $row['kls_2'] . '</td>';
                    echo '<td class="p-1">' . $row['kls_3'] . '</td>';
                    echo '<td class="p-1">' . $row['kls_khusus'] . '</td>';
                    echo '</tr>';
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
    $(document).ready(function() {
        $("#datetime-now").html(`<em>Dicetak pada Tanggal ${moment(new Date()).format("DD-MM-YYYY HH:mm")}</em>`)


    })
</script>
<script type="text/javascript">
    window.print();
</script>

</html>