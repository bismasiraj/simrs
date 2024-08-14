<?php
// echo "<pre>";
// var_dump($val);
// die();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>
    <script src="<?= base_url('/assets/js/default.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
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
        <div class="row mb-5">
            <div class="col-2 d-flex">
                <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 110px; height: 110px;">
            </div>
            <div class="col-6">
                <h3><?= @$organization['name_of_org_unit'] ?></h3>
                <h5><?= strtoupper(@$organization['kota']) ?></h5>
                <b><?= @$organization['contact_address'] ?></b>
                <br>
                <b><?= 'Telp ' . @$organization['phone'] . ' Fax: ' . @$organization['fax'] ?></b>
            </div>
            <div class="col-4">
                <div class="border border-1 d-flex justify-content-center align-items-center" style="height: 100px;">
                    <span>Label Identitas Pasien</span>
                </div>
            </div>
        </div>
        <div class="row">
            <h4 class="text-center"><?= $title; ?></h4>
        </div>
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Nomor RM</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Nama Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_pasien']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Jenis Kelamin</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_gender']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Tanggal Lahir (Usia)</b>
                        <?php if (!empty($visit['date_of_birth'])) : ?>
                            <p class="m-0 mt-1 p-0"><?= date('d/m/Y', strtotime($visit['date_of_birth'])) . ' (' . @$visit['age'] . ')'; ?></p>
                        <?php else : ?>
                            <p class="m-0 mt-1 p-0">-</p>
                        <?php endif; ?>
                    </td>
                    <td class="p-1" colspan="2">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['contact_address']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['sspractitioner_name']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visit_datetime'] ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered mb-2">
            <thead>
                <tr>
                    <th style="width: 30%; text-align: center;">Tanggal / Jam</th>
                    <th style="width: 10%; text-align: center;">SpO2</th>
                    <th style="width: 10%; text-align: center;">Pernapasan</th>
                    <th style="width: 10%; text-align: center;">Nadi</th>
                    <th style="width: 10%; text-align: center;">Suhu</th>
                    <th style="width: 10%; text-align: center;">Neuro</th>
                    <th style="width: 10%; text-align: center;">Warna Kulit</th>
                    <th style="width: 10%; text-align: center;">Total Score</th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered mb-2">
            <tbody id="vitalSignBody">

            </tbody>
        </table>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    $(document).ready(function() {
        getVitalSign()
    })

    function vitalsignInput(prop) {
        var value = prop.textContent.trim();
        var data_tipe = prop.data_type;
        var data;
        // console.log(prop);
        if (isNaN(value) || value === "") {
            value = 0;
        } else {
            value = parseFloat(value);
        }

        switch (data_tipe) {
            case "avtnadi":
                data = getAdultScore(prop.data_type, value);
                prop.textContent = data.score;
                console.log(data.score);
                break;
            case "avttemperature":
                data = getAdultScore(prop.data_type, value);
                prop.textContent = data.score;
                break;
            case "avtsaturasi":
                data = getAdultScore(prop.data_type, value);
                prop.textContent = data.score;
                break;
            case "avtnafas":
                data = getAdultScore(prop.data_type, value);
                prop.textContent = data.score;
                break;
            case "avttension_upper":
                data = getAdultScore(prop.data_type, value);
                prop.textContent = data.score;
                break;
            default:
                break;
        }

        // Update total score after setting the score
        document.getElementById('total_score').textContent = 'Total Skor: ' + sumTextContentFromClass('badge-score');
    }


    const getVitalSign = () => {
        let pasien = <?= json_encode($visit); ?>;

        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': pasien?.visit_id,
                'nomor': pasien?.no_registration
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                addRowVitalSign(data.examInfo)

            },
            error: function() {

            }
        });
    }

    const addRowVitalSign = (data) => {
        let resultTables = []

        data.map(item => {
            let score = 0;
            score += getAdultScore("pernapasan", item?.nafas).score + getAdultScore("saturasi", item?.saturasi).score + getAdultScore("oksigen", item?.oxygen_usage).score + getAdultScore("darah", item?.tension_upper).score + getAdultScore("nadi", item?.nadi).score + getAdultScore("kesadaran", item?.gcs_desc).score + getAdultScore("suhu", item?.temperature).score;
            resultTables += `
            <tr>
                <th style="width: 30%; vertical-align:middle; text-align: center;" rowspan="2">${moment(item?.examination_date).format('DD MMM YYYY, HH:mm')}</th>
                <td style="width: 10%; text-align: center;">${item?.saturasi}</td>
                <td style="width: 10%; text-align: center;">${item?.oxygen_usage === null ? "":item?.oxygen_usage}</td>
                <td style="width: 10%; text-align: center;">${item?.tension_upper}/${item?.tension_below}</td>
                <td style="width: 10%; text-align: center;">${item?.nadi}</td>
                <td style="width: 10%; text-align: center;">${item?.gcs_desc === null ? "":item?.gcs_desc}</td>
                <td style="width: 10%; text-align: center;">${item?.temperature}</td>
                <th style="width: 10%; vertical-align:middle; text-align: center;" rowspan="2">${score}</th>
            </tr>
            <tr>
                <td class="score_${item.body_id}" style="width: 10%; text-align: center; background:${getAdultScore("saturasi", item?.saturasi).colorPicker}">${getAdultScore("saturasi", item?.saturasi).score}</td>
                <td class="score_${item.body_id}" style="width: 10%; text-align: center; background:${getAdultScore("oksigen", item?.oxygen_usage === null ?"":item?.oxygen_usage).colorPicker}">${getAdultScore("oksigen", item?.oxygen_usage === null ?"":item?.oxygen_usage).score}</td>
                <td class="score_${item.body_id}" style="width: 10%; text-align: center; background:${getAdultScore("darah", item?.tension_upper).colorPicker}">${getAdultScore("nadi", item?.tension_upper).score}</td>
                <td class="score_${item.body_id}" style="width: 10%; text-align: center; background:${getAdultScore("nadi", item?.nadi).colorPicker}">${getAdultScore("nadi", item?.nadi).score}</td>
                <td class="score_${item.body_id}" style="width: 10%; text-align: center; background:${getAdultScore("kesadaran", item?.gcs_desc).colorPicker}">${getAdultScore("kesadaran", item?.gcs_desc).score}</td>
                <td class="score_${item.body_id}" style="width: 10%; text-align: center; background:${getAdultScore("suhu", item?.temperature).colorPicker}">${getAdultScore("suhu", item?.temperature).score}</td>
            </tr>
            `
        })
        $("#vitalSignBody").html(resultTables)
        window.print();


    }
</script>


<style>
    @media print {
        @page {
            margin: none;
            size: landscape;

        }

        .container-fluid {
            width: 100%;
            /* Set to 100% for full width */
        }

        body {
            margin: 0;
            font-size: 12px;
            width: auto;
            height: auto;
        }

    }
</style>


</html>