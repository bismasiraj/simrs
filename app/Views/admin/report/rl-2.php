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
            <h4 class="text-start">RL 2 Ketenagaan</h4>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td class="p-1">Tahun</td>
                    <td class="p-1">No</td>
                    <td class="p-1">Kualifikasi Pendidikan</td>
                    <td class="p-1">Keadaan Laki-Laki</td>
                    <td class="p-1">Keadaan Perempuan</td>
                    <td class="p-1">Kebutuhan Laki-Laki</td>
                    <td class="p-1">Kebutuhan Perempuan</td>
                    <td class="p-1">Kekurangan Laki-Laki</td>
                    <td class="p-1">Kekurangan Perempuan</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $groupedData = [];

                foreach ($data as $item) {
                    $category = $item['name_of_object_category'];
                    if (!isset($groupedData[$category])) {
                        $groupedData[$category] = [
                            'description' => $item['description'],
                            'items' => []
                        ];
                    }


                    $groupedData[$category]['items'][] = $item;
                }


                foreach ($groupedData as $category => $values) {

                    echo "<tr style='font-weight: bold;'>";
                    echo "<td colspan='9'>" . htmlspecialchars($category) . "</td>";
                    echo "</tr>";


                    foreach ($values['items'] as $item) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars('2024') . "</td>";
                        echo "<td>" . htmlspecialchars($item['display']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['description']) . "</td>";


                        if (strtolower(trim($item['gender'])) === 'laki laki') {
                            echo "<td>" . htmlspecialchars($item['jml']) . "</td>";
                            echo "<td>" . htmlspecialchars(0) . "</td>";
                        } elseif (strtolower(trim($item['gender'])) === 'perempuan') {
                            echo "<td>" . htmlspecialchars(0) . "</td>";
                            echo "<td>" . htmlspecialchars($item['jml']) . "</td>";
                        } else {
                            echo "<td>" . htmlspecialchars(0) . "</td>";
                            echo "<td>" . htmlspecialchars(0) . "</td>";
                        }

                        echo "<td>" . htmlspecialchars(isset($item['kebutuhan_laki']) ? $item['kebutuhan_laki'] : "") . "</td>";
                        echo "<td>" . htmlspecialchars(isset($item['kebutuhan_perempuan']) ? $item['kebutuhan_perempuan'] : "") . "</td>";
                        echo "<td>" . htmlspecialchars(isset($item['kekurangan_laki']) ? $item['kekurangan_laki'] : "") . "</td>";
                        echo "<td>" . htmlspecialchars(isset($item['kekurangan_perempuan']) ? $item['kekurangan_perempuan'] : "") . "</td>";
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
    $(document).ready(function() {
        $("#datetime-now").html(`<em>Dicetak pada Tanggal ${moment(new Date()).format("DD-MM-YYYY HH:mm")}</em>`)


    })
</script>

<script type="text/javascript">
    window.print();
</script>

</html>