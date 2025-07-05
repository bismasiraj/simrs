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
    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <div id="no_registration" name="no_registration"><?= @$visit['no_registration']; ?></div>
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <div id="thename" name="thename" class="thename"><?= @$visit['diantar_oleh']; ?></div>
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <div name="gender" id="gender">
                                <?= @$visit['name_of_gender']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <div id="patient_age" name="patient_age"><?= @$visit['date_of_birth']; ?>
                                (<?= @$visit['age']; ?> )</div>
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['contact_address']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <div id="fullname" name="fullname"><?= @@$visit['fullname']; ?></div>
                        </td>
                        <td>
                            <b>Department</b>
                            <div id="clinic_id" name="clinic_id"><?= @$visit['clinic_id']; ?></div>
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <div id="examination_date" name="examination_date"><?= @$visit['visit_date']; ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-5">
                <h4>Grafik Nadi dan Suhu</h4>
                <canvas id="myChartRecoveryRoom" width="auto" height="200"></canvas>
            </div>
            <div class="row">
                <h4>Tabel Nadi dan Suhu</h4>
            </div>
            <table class="table table-bordered">
                <thead class="fw-bold">
                    <tr>
                        <td>Tanggal</td>
                        <td>Tensi</td>
                        <td>Nadi</td>
                        <td>Suhu</td>
                        <td>Catatan</td>
                        <td>Staff</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?= isset($item['examination_date']) ? date('Y-m-d', strtotime($item['examination_date'])) : '-'; ?>
                            </td>
                            <td>
                                <?= isset($item['tension_upper']) && isset($item['tension_below'])
                                    ? $item['tension_upper'] . ' / ' . $item['tension_below']
                                    : '-'; ?>
                            </td>

                            <td><?= @$item['nadi'] ?></td>
                            <td><?= @$item['temperature'] ?></td>
                            <td><?= @$item['description'] ?></td>
                            <td><?= @$item['petugas'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    $(document).ready(function() {
        let data = <?= json_encode($data); ?>;

        ChartMonitoringDurante({
            data: data
        })
    })


    const ChartMonitoringDurante = (props) => {
        let rawData = props?.data || [];
        let dataRendersTables = '';

        let groupedData = {};

        rawData.forEach(item => {
            let dateTime = item?.examination_date ? moment(item?.examination_date).format('DD MMM YYYY HH:mm') :
                null;
            if (dateTime) {
                let dateOnly = moment(item?.examination_date).format('DD MMM YYYY');
                if (!groupedData[dateOnly]) {
                    groupedData[dateOnly] = {
                        times: [],
                        nadi: [],
                        temperature: [],
                        saturasi: [],
                        tension_upper: [],
                        tension_below: []
                    };
                }
                groupedData[dateOnly].times.push(moment(item?.examination_date).format('HH:mm'));
                groupedData[dateOnly].nadi.push(parseInt(item?.nadi ?? 0));
                groupedData[dateOnly].temperature.push(parseInt(item?.temperature ?? 0));
                groupedData[dateOnly].saturasi.push(parseInt(item?.saturasi ?? 10));
                groupedData[dateOnly].tension_upper.push(parseInt(item?.tension_upper ?? 0));
                groupedData[dateOnly].tension_below.push(parseInt(item?.tension_below ?? 0));
            }
        });
        let datasets = [{
                label: 'Nadi',
                backgroundColor: 'rgba(235, 125, 52, 0.2)',
                borderColor: '#eb7d34',
                fill: true,
                tension: 0.2,
                yAxisID: 'yNadi',
            },
            {
                label: 'Suhu',
                backgroundColor: 'rgba(52, 101, 235, 0.2)',
                borderColor: '#3465eb',
                fill: true,
                tension: 0.2,
                yAxisID: 'yTemperature',
            },
            {
                label: 'SPO2',
                backgroundColor: 'rgba(18, 41, 105, 0.2)',
                borderColor: '#122969',
                fill: true,
                tension: 0.2,
                yAxisID: 'ySaturasi',
            },
            {
                label: 'Sistole',
                backgroundColor: 'rgba(61, 235, 52, 0.2)',
                borderColor: '#3deb34',
                fill: true,
                tension: 0.2,
                yAxisID: 'yTension',
            },
            {
                label: 'Diastole',
                backgroundColor: 'rgba(61, 235, 52, 0.2)',
                borderColor: '#3deb34',
                fill: true,
                tension: 0.2,
                yAxisID: 'yTension',
            },
            {
                label: 'Respirasi',
                backgroundColor: 'rgba(230, 242, 5, 0.2)',
                borderColor: '#e6f205',
                fill: true,
                tension: 0.2,
                yAxisID: 'yRespirasi',
            },
        ];

        // Untuk tiap tanggal, render dataset secara terpisah untuk setiap jam
        let labels = [];
        Object.keys(groupedData).forEach(date => {
            let dateData = groupedData[date];
            dateData.times.forEach(time => {
                labels.push(`${date} ${time}`);
            });

            datasets.forEach((dataset, index) => {
                switch (dataset.label) {
                    case 'Nadi':
                        dataset.data = dataset.data || [];
                        dataset.data.push(...dateData.nadi);
                        break;
                    case 'Suhu':
                        dataset.data = dataset.data || [];
                        dataset.data.push(...dateData.temperature);
                        break;
                    case 'SPO2':
                        dataset.data = dataset.data || [];
                        dataset.data.push(...dateData.saturasi);
                        break;
                    case 'Sistole':
                        dataset.data = dataset.data || [];
                        dataset.data.push(...dateData.tension_upper);
                        break;
                    case 'Diastole':
                        dataset.data = dataset.data || [];
                        dataset.data.push(...dateData.tension_below);
                        break;
                    case 'Respirasi':
                        dataset.data = dataset.data || [];
                        dataset.data.push(...dateData.nadi); // Assuming respirasi is mapped to nadi
                        break;
                }
            });
        });

        const ctxChart = document.getElementById(`myChartRecoveryRoom`).getContext('2d');
        new Chart(ctxChart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                plugins: {
                    datalabels: false
                },
                scales: {
                    yNadi: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Nadi'
                        }
                    },
                    yTemperature: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Suhu'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    ySaturasi: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'SPO2'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    yTension: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Tekanan Darah'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    yRespirasi: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Respirasi'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                }
            }
        });
    };
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
    }
</style>
<script type="text/javascript">
    setTimeout(() => {
        window.print();
    }, 200);
</script>

</html>