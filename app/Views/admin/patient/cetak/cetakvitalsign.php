<?php
// echo "<pre>";
// var_dump($visit);
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
            size: A4 landscape;
        }

        body {
            height: 21cm;
            width: 29.7cm;
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
        <div class="row">
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col text-center">
                <h3><?= @$organization['name_of_org_unit'] ?></h3>
                <!-- <h3>Surakarta</h3> -->
                <p><?= @$organization['contact_address'] ?></p>
            </div>
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
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
                    <th style="width: 10%; text-align: center;">Tanggal / Jam</th>
                    <th style="width: 9%; text-align: center;">EWS</th>
                    <th style="width: 10%; text-align: center;">Pernapasan</th>
                    <th style="width: 9%; text-align: center;">Saturasi 1</th>
                    <th style="width: 9%; text-align: center;">Saturasi 2</th>
                    <th style="width: 9%; text-align: center;">Oksigen</th>
                    <th style="width: 9%; text-align: center;">Tekanan Darah</th>
                    <th style="width: 9%; text-align: center;">Nadi</th>
                    <th style="width: 9%; text-align: center;">Tingkat Kesadaran</th>
                    <th style="width: 9%; text-align: center;">Suhu</th>
                    <th style="width: 8%; text-align: center;">Total Score</th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered mb-2">
            <tbody id="vitalSignBody">

            </tbody>
        </table>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Bidan</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
            </div>
        </div>
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
                data = evaluateScore(item?.vs_status_id, prop.data_type, value);
                prop.textContent = data.score;
                console.log(data.score);
                break;
            case "avttemperature":
                data = evaluateScore(item?.vs_status_id, prop.data_type, value);
                prop.textContent = data.score;
                break;
            case "avtsaturasi":
                data = evaluateScore(item?.vs_status_id, prop.data_type, value);
                prop.textContent = data.score;
                break;
            case "avtnafas":
                data = evaluateScore(item?.vs_status_id, prop.data_type, value);
                prop.textContent = data.score;
                break;
            case "avttension_upper":
                data = evaluateScore(item?.vs_status_id, prop.data_type, value);
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

        // postData({
        //     'visit_id': pasien?.visit_id,
        //     'nomor': pasien?.no_registration
        // }, "admin/rm/assessment/getAssessmentKeperawatan", (res) => {
        //     console.log(res.examInfo);
        //     addRowVitalSign(res.examInfo)

        // })
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

                vitalsign = data.examInfo

            },
            error: function() {

            }
        });
    }

    const checkEWS = (value) => {
        switch (value) {
            case 1:
                return 'Dewasa'
                break;
            case 4:
                return 'Neonatus'
                break;
            case 5:
                return 'Anak'
                break;
            default:
                return '-'
                break;
        }
    }

    const addRowVitalSign = (data) => {
        let resultTables = []

        data.map(item => {
            let score = 0;
            score += evaluateScore(item?.vs_status_id, "pernapasan", item?.nafas).score +
                evaluateScore(item?.vs_status_id, "saturasi", item?.saturasi).score +
                evaluateScore(item?.vs_status_id, "oksigen", item?.oxygen_usage).score +
                evaluateScore(item?.vs_status_id, "darah", item?.tension_upper).score +
                evaluateScore(item?.vs_status_id, "nadi", item?.nadi).score +
                evaluateScore(item?.vs_status_id, "kesadaran", item?.gcs_desc).score +
                evaluateScore(item?.vs_status_id, "suhu", item?.temperature).score;
            resultTables += `
            <tr>
                <th style="width: 10%; vertical-align:middle; text-align: center;" rowspan="2">${moment(item?.examination_date).format('DD MMM YYYY, HH:mm')}</th>
                <th style="width: 9%; text-align: center;" rowspan="2">${checkEWS(item?.vs_status_id)}</th>
                <td style="width: 10%; text-align: center;">${item?.nafas}</td>
                <td style="width: 9%; text-align: center;">${item?.oxygen_usage !== null ?'': item?.saturasi}</td>
                <td style="width: 9%; text-align: center;">${item?.oxygen_usage !== null ?item?.saturasi: ''}</td>
                <td style="width: 9%; text-align: center;">${item?.oxygen_usage === null ? "":item?.oxygen_usage}</td>
                <td style="width: 9%; text-align: center;">${item?.tension_upper}/${item?.tension_below}</td>
                <td style="width: 9%; text-align: center;">${item?.nadi}</td>
                <td style="width: 9%; text-align: center;">${item?.gcs_desc === null ? "":item?.gcs_desc}</td>
                <td style="width: 9%; text-align: center;">${item?.temperature}</td>
                <th style="width: 8%; vertical-align:middle; text-align: center;" rowspan="2">${score}</th>
            </tr>
            <tr>
                <th class="score_${item.body_id}" style="width: 10%; text-align: center; background:${evaluateScore(item?.vs_status_id, "pernapasan", item?.nafas).colorPicker}">${evaluateScore(item?.vs_status_id, "pernapasan", item?.nafas).score}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${item?.oxygen_usage !== null ?'': evaluateScore(item?.vs_status_id, "saturasi", item?.saturasi).colorPicker}">${item?.oxygen_usage !== null ?'': evaluateScore(item?.vs_status_id, "saturasi", item?.saturasi).score}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${item?.oxygen_usage !== null ? evaluateScore(item?.vs_status_id, "saturasi2", item?.saturasi).colorPicker: ''}">${item?.oxygen_usage !== null ? evaluateScore(item?.vs_status_id, "saturasi2", item?.saturasi).score: ''}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${item?.oxygen_usage === null ? '': evaluateScore(item?.vs_status_id, "oksigen", item?.oxygen_usage).colorPicker}">${item?.oxygen_usage === null ? '': evaluateScore(item?.vs_status_id, "oksigen", item?.oxygen_usage).score}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${evaluateScore(item?.vs_status_id, "darah", item?.tension_upper).colorPicker}">${evaluateScore(item?.vs_status_id, "nadi", item?.tension_upper).score}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${evaluateScore(item?.vs_status_id, "nadi", item?.nadi).colorPicker}">${evaluateScore(item?.vs_status_id, "nadi", item?.nadi).score}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${evaluateScore(item?.vs_status_id, "kesadaran", item?.gcs_desc).colorPicker}">${evaluateScore(item?.vs_status_id, "kesadaran", item?.gcs_desc).score}</th>
                <th class="score_${item.body_id}" style="width: 9%; text-align: center; background:${evaluateScore(item?.vs_status_id, "suhu", item?.temperature).colorPicker}">${evaluateScore(item?.vs_status_id, "suhu", item?.temperature).score}</th>
            </tr>
            `
        })
        $("#vitalSignBody").html(resultTables)
        window.print();


    }
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'sa',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: 'sa',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
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
<script type="text/javascript">

</script>

</html>