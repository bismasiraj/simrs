<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">
    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
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
        <div class="row">
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col text-center">
                <h3><?= @$organization['name_of_org_unit'] ?></h3>

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
        <h5>Informasi Medis</h5>
        <table class="table table-bordered mb-3">
            <tbody>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Nomor RM</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Nama Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Jenis Kelamin</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['gendername']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Tanggal Lahir (Usia)</b>
                        <p class="m-0 mt-1 p-0">
                            <?= date("d M Y", strtotime($visit['date_of_birth'])) . ' (' . (!empty($visit['age']) ? $visit['age'] : 'N/A') . ')'; ?>
                        </p>


                    </td>
                    <td class="p-1" style="width:66.3%" colspan="2">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['fullname_inap']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic_from']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['in_date'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Kelas</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['class_room']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Bangsal/Kamar</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Bed</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['bed']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4>FORMULIR SKRINING NUTRISI</h4>
        <div class="d-flex flex-wrap mb-3">
            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b>Tinggi Badan</b>
                <p class="m-0 mt-1 p-0"><?= @$val['height']; ?> cm</p>
            </div>
            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b>Berat Badan</b>
                <p class="m-0 mt-1 p-0"><?= @$val['weight']; ?> cm</p>
            </div>
            <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                <b>IMT</b>
                <p class="m-0 mt-1 p-0"><?= @$val['imt']; ?></p>
            </div>
        </div>
        <table class="table table-bordered">
            <tr class="table-primary">
                <th class="p-1" style="width:1% !important">No.</th>
                <th class="p-1">Pertanyaan</th>
                <th class="p-1" style="width:40% !important;">Deskripsi</th>
                <th class="p-1" style="width:1% !important;">Skor</th>
            </tr>
            <tbody id="tbodyScreeningCetak">

            </tbody>
        </table>

    </div>
    <br>
    <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

<script>
    let aParameter = <?= json_encode($aParameter) ?>;
    let aValue = <?= json_encode($aValue) ?>;
    let p_type = <?= json_encode($val['p_type']) ?>;
    let data = <?= json_encode($val) ?>;
    let htmlContent = '';
    let totalSkor = 0;
    aParameter.forEach((parameter, index) => {
        let text = '';
        let skor = '';
        let arr = aValue.filter(item => item?.parameter_id === parameter.parameter_id && item?.p_type === p_type);

        if (data != null) {

            text = parameter?.entry_type === 3 ?
                `<span>${arr.find(item => item.value_score === data[parameter?.column_name.toLowerCase()])?.value_desc || ''}</span>` :
                `<span>${data.p_type === p_type ? data[parameter?.column_name.toLowerCase()] ?? '' : ''}</span>`;


            skor = arr.find(item => item.value_score === data[parameter?.column_name.toLowerCase()])?.value_score ?? 0;
            totalSkor += skor;
        } else {
            text = parameter?.entry_type === 3 ?
                `<span></span>` :
                `<span></span>`;
        }


        htmlContent += `
        <tr>
            <th class="p-1 text-center align-middle" style="width:1% !important">${index + 1}</th>
            <td class="p-1">${parameter?.parameter_desc}</td>
            <td class="p-1" style="width:120px !important;">
                ${text}
            </td>
            <td class="text-center align-middle">${skor}</td>
        </tr>
    `;
    });

    htmlContent +=
        `
        <tr>
            <th colspan="3">Total Skor</th>
            <th class="text-center align-middle">${totalSkor ?? 0}</th>
        </tr>
        <tr>
            <th colspan="4">Kesimpulan : ${data.score_desc ?? ''}</th>
        </tr>
    `;
    $('#tbodyScreeningCetak').html(htmlContent);
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
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
    }, 1000);
</script>

</html>