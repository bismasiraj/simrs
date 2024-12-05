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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
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
        <div class="d-flex flex-wrap mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center text-uppercase ">No</th>
                        <th class="text-center text-uppercase">Tgl./Jam</th>
                        <th class="text-center text-uppercase">Jenis Cairan</th>
                        <th class="text-center text-uppercase">Tetesan</th>
                        <th class="text-center text-uppercase">Plabot ke</th>
                        <th class="text-center text-uppercase">Nama Petugas</th>
                        <th class="text-center text-uppercase">Ttd</th>
                    </tr>
                </thead>
                <tbody id="data_tables">

                </tbody>
            </table>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
$(document).ready(function() {
    renderDiagnosa()
    dataRender()

})

const renderDiagnosa = () => {
    let result = <?= json_encode($diagnosa); ?>;

    let descriptions = result
        .filter(item => item.diagnosa_desc)
        .map(item => item.diagnosa_desc)
        .join(', ');

    descriptions = descriptions;

    $("#diagnosa-name").html(descriptions);
};

const dataRender = () => {
    let result = <?= json_encode($dataTabels); ?>;
    let aValue = <?= json_encode($aValue); ?>;

    let filteredDataValue = aValue?.filter(item => item?.p_type === "GEN0023");

    const fluidTypeMapping = {
        "G0230301": "oral",
        "G0230302": "parenteral",
        "G0230303": "urine",
        "G0230304": "muntah",
        "G0230305": "ngt",
        "G0230306": "bab",
        "G0230307": "drain",
        "G0230308": "drain2",
        "G0230309": "infus",
        "G0230310": "tranfusi",
    };

    const filterByInfus = (data) => {
        return data.filter(item => item.fluid_type === "G0230309");
    };

    const groupByAwarenessAndType = (data) => {
        const grouped = {};
        data.forEach(item => {
            const key = `${item.awareness}-${item.fluid_type}`;
            if (!grouped[key]) {
                grouped[key] = {
                    infus: 0,
                    drip_rate: 0,
                    botle_amount: 0,
                    items: []
                };
            }
            let columnKey = fluidTypeMapping[item.fluid_type];
            if (columnKey) {
                grouped[key][columnKey] += item.fluid_amount || 0;
            }

            grouped[key].drip_rate += item.drip_rate ? parseInt(item.drip_rate, 10) : 0;
            grouped[key].botle_amount += item.botle_amount || 0;
            grouped[key].items.push(item);
        });
        return grouped;
    };

    const filteredData = filterByInfus(result);
    let data = '';
    let total = {
        infus: 0,
        drip_rate: 0,
        botle_amount: 0
    };

    let index = 1;

    const groupedByAwarenessAndType = groupByAwarenessAndType(filteredData);
    Object.keys(groupedByAwarenessAndType).forEach(key => {
        const groupDetails = groupedByAwarenessAndType[key];
        const [awarenessCode, fluidTypeCode] = key.split('-');

        let awarenessDesc = filteredDataValue.find(e => e?.value_id === awarenessCode)
            ?.value_desc || awarenessCode;


        data += `<tr>
            <td>${index++}</td>
            <td>${moment(groupDetails.items[0].examination_date).format("DD/MM/YYYY HH:mm")}</td>
            <td>Infus</td>
            <td>${groupDetails.drip_rate || ''}</td>
            <td>${groupDetails.botle_amount}</td>
            <td>${groupDetails.items[0].valid_user ?? ""}</td>
            <td>${groupDetails.items[0].valid_user ?? ""}</td>
        </tr>`;

        total.infus += groupDetails.infus || 0;
        total.drip_rate += groupDetails.drip_rate || 0;
        total.botle_amount += groupDetails.botle_amount || 0;
    });



    $("#data_tables").html(data);
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


    body {
        margin: 0;
        font-size: 12px;
        width: auto;
        height: auto;
    }

}
</style>
<script type="text/javascript">
setTimeout(() => {
    window.print();
}, 2000);
</script>

</html>