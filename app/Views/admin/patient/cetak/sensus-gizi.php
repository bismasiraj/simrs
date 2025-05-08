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

    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

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
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
            </div>
            <div class="col mt-2 text-center">
                <h4><?= $organization['name_of_org_unit']; ?></h4>
                <h5>SENSUS HARIAN GIZI PASIEN</h5>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary">
                    <th rowspan="2" class="text-center align-middle" width="1%">No.</th>
                    <th rowspan="2" class="text-center align-middle" width="1%">Ruang</th>
                    <th rowspan="2" class="text-center align-middle" width="1%">Kelas</th>
                    <th rowspan="2" class="text-center align-middle" width="1%">No. RM</th>
                    <th rowspan="2" class="text-center align-middle">Nama Pasien</th>
                    <th rowspan="2" class="text-center align-middle">JK</th>
                    <th rowspan="2" class="text-center align-middle">TTL Pasien</th>
                    <th rowspan="2" class="text-center align-middle">Diet</th>
                    <th rowspan="2" class="text-center align-middle">Alergi</th>
                    <th colspan="9" class="text-center align-middle">TTD Pasien</th>
                </tr>
                <tr class="table-light">
                    <th>Pagi</th>
                    <th>Siang</th>
                    <th>Sore</th>
                </tr>
            </thead>
            <tbody id="containerTableSensus"></tbody>
        </table>
    </div>
</body>



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
    $(document).ready(function() {
        let data = <?= json_encode($data); ?>;
        let data_gizi = <?= json_encode($data_gizi); ?>;
        let data_alergi = <?= json_encode($data_alergi); ?>;

        const mergedData = data.map(item => {
            const dietData = data_gizi.find(diet => diet.visit_id === item.visit_id);
            const alergyData = data_alergi.find(alergy => alergy.visit_id === item.visit_id);

            return {
                ...item,
                data: dietData || null,
                alergi: alergyData || null,
            };
        });
        let dataHtml = '';
        mergedData.forEach((item, index) => {

            dataHtml += `
            <tr>
                <td class="text-center align-middle ${item.keluar_id == 1 ? 'bg-danger' : ''}">${index+1}</td>
                <td class="text-center align-middle">${item.name_of_clinic ?? ''}</td>
                <td class="text-center align-middle">${item.name_of_class ?? ''}</td>
                <td class="text-center align-middle" width="1%">${item.no_registration}</td>
                <td class="text-center align-middle">${item.thename}</td>
                <td class="text-center align-middle" width="1%">${item.gender == '1' ? 'L' : 'P'}</td>
                <td class="text-start align-middle">
                    <small>Pagi : <b>${item?.data?.dtype_pagi ?? '-'}</b></small><br>
                    <small>Siang : <b>${item?.data?.dtype_siang ?? '-'}</b></small><br>
                    <small>Malam : <b>${item?.data?.dtype_malam ?? '-'}</b></small>
                </td>
                <td class="text-start align-middle">
                    <small>Pagi : <b>${item?.data?.pantangan_pagi ?? '-'}</b></small><br>
                    <small>Siang : <b>${item?.data?.pantangan_siang ?? '-'}</b></small><br>
                    <small>Malam : <b>${item?.data?.pantangan_malam ?? '-'}</b></small>
                </td>
                <td class="text-center align-middle">${item?.alergi?.food_alergy ?? '-'}</td>
                <td class="text-center align-middle" id="valid_pasien_pagi_${index}" data-value="${item.data?.valid_pasien_pagi ?? ''}"></td>
                <td class="text-center align-middle" id="valid_pasien_siang_${index}" data-value="${item.data?.valid_pasien_siang ?? ''}"></td>
                <td class="text-center align-middle" id="valid_pasien_malam_${index}" data-value="${item.data?.valid_pasien_malam ?? ''}"></td>
            </tr>
        `;
        });
        $('#containerTableSensus').html(dataHtml);

        mergedData.forEach((item, index) => {
            const pagiElementId = `valid_pasien_pagi_${index}`;
            const siangElementId = `valid_pasien_siang_${index}`;
            const malamElementId = `valid_pasien_malam_${index}`;

            const pagiValue = item.data?.valid_pasien_pagi ?? '';
            const siangValue = item.data?.valid_pasien_siang ?? '';
            const malamValue = item.data?.valid_pasien_malam ?? '';

            if (pagiValue) {
                new QRCode(document.getElementById(pagiElementId), {
                    text: pagiValue,
                    width: 30,
                    height: 30,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }


            if (siangValue) {
                new QRCode(document.getElementById(siangElementId), {
                    text: siangValue,
                    width: 30,
                    height: 30,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }

            if (malamValue) {
                new QRCode(document.getElementById(malamElementId), {
                    text: malamValue,
                    width: 30,
                    height: 30,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }
        });
    });
</script>

</html>