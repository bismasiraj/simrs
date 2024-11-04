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
        <table class="table table-bordered">
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
                        <b>Diagnosa</b>
                        <p class="m-0 mt-1 p-0" id="diagnosa-name">-</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex flex-wrap mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-uppercase ">TGL/JAM</th>
                        <th rowspan="2" class="align-middle text-uppercase">KESADARAN</th>
                        <th colspan="2" class="align-middle text-uppercase text-center">CAIRAN MASUK</th>
                        <th colspan="6" class="align-middle text-uppercase text-center">CAIRAN Keluar</th>
                        <th rowspan="2" class="align-middle text-uppercase">Infus</th>
                        <th rowspan="2" class="align-middle text-uppercase">Tranfusi</th>
                        <th rowspan="2" class="align-middle text-uppercase">Tetesan</th>
                        <th rowspan="2" class="align-middle text-uppercase">Botol Ke</th>
                        <th rowspan="2" class="align-middle text-uppercase">Nama petugas</th>
                        <th rowspan="2" class="align-middle text-uppercase">paraf</th>
                    </tr>
                    <tr>
                        <th class="text-uppercase">Oral</th>
                        <th class="text-uppercase">Perenteral</th>
                        <th class="text-uppercase">Urine</th>
                        <th class="text-uppercase">Muntah</th>
                        <th class="text-uppercase">NGT</th>
                        <th class="text-uppercase">BAB</th>
                        <th class="text-uppercase">DRAIN </th>
                        <th class="text-uppercase">DRAIN II</th>
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

    const groupData = (data) => {
        const grouped = {};
        data.forEach(item => {
            const dateKey = moment(new Date(item.examination_date)).format("DD-MM-YYYY HH")

            if (!grouped[dateKey]) {
                grouped[dateKey] = [];
            }
            grouped[dateKey].push(item);
        });
        return grouped;
    };

    const groupByAwarenessAndType = (data) => {
        const grouped = {};
        data.forEach(item => {
            const key = `${item.awareness}-${item.fluid_type}`;
            if (!grouped[key]) {
                grouped[key] = {
                    oral: 0,
                    parenteral: 0,
                    urine: 0,
                    muntah: 0,
                    ngt: 0,
                    bab: 0,
                    drain: 0,
                    drain2: 0,
                    infus: 0,
                    tranfusi: 0,
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

    const groupedData = groupData(result);
    let data = '';
    let total = {
        oral: 0,
        parenteral: 0,
        urine: 0,
        muntah: 0,
        ngt: 0,
        bab: 0,
        drain: 0,
        drain2: 0,
        infus: 0,
        tranfusi: 0,
        drip_rate: 0,
        botle_amount: 0
    };

    Object.keys(groupedData).forEach(dateKey => {
        const group = groupedData[dateKey];

        const dateHeader = dateKey.replace('T', ' ');
        data += `<tr><td colspan="20" class="text-center fw-bold">${dateHeader}</td></tr>`;

        const groupedByAwarenessAndType = groupByAwarenessAndType(group);
        Object.keys(groupedByAwarenessAndType).forEach(key => {
            const groupDetails = groupedByAwarenessAndType[key];
            const [awarenessCode, fluidTypeCode] = key.split('-');

            let awarenessDesc = filteredDataValue.find(e => e?.value_id === awarenessCode)
                ?.value_desc || awarenessCode;

            data += `<tr>
                <td>${moment(group[0].examination_date).format("DD/MM/YYYY HH:mm")}</td>
                <td>${awarenessDesc}</td>
                <td>${groupDetails.oral || ''}</td>  
                <td>${groupDetails.parenteral || ''}</td> 
                <td>${groupDetails.urine || ''}</td> 
                <td>${groupDetails.muntah || ''}</td> 
                <td>${groupDetails.ngt || ''}</td> 
                <td>${groupDetails.bab || ''}</td> 
                <td>${groupDetails.drain || ''}</td> 
                <td>${groupDetails.drain2 || ''}</td> 
                <td>${groupDetails.infus || ''}</td> 
                <td>${groupDetails.tranfusi || ''}</td> 
                <td>${groupDetails.drip_rate}</td>
                <td>${groupDetails.botle_amount}</td>
                <td>${groupDetails.items[0].valid_user ?? ""}</td>
                <td>${groupDetails.items[0].valid_user ?? ""}</td>
            </tr>`;

            total.oral += groupDetails.oral || 0;
            total.parenteral += groupDetails.parenteral || 0;
            total.urine += groupDetails.urine || 0;
            total.muntah += groupDetails.muntah || 0;
            total.ngt += groupDetails.ngt || 0;
            total.bab += groupDetails.bab || 0;
            total.drain += groupDetails.drain || 0;
            total.drain2 += groupDetails.drain2 || 0;
            total.infus += groupDetails.infus || 0;
            total.tranfusi += groupDetails.tranfusi || 0;
            total.drip_rate += groupDetails.drip_rate || 0;
            total.botle_amount += groupDetails.botle_amount || 0;
        });
    });


    data += `<tr class="fw-bold">
                <td colspan="2" class="text-center">JUMLAH TOTAL</td>
                <td>${total.oral}</td>
                <td>${total.parenteral}</td>
                <td>${total.urine}</td>
                <td>${total.muntah}</td>
                <td>${total.ngt}</td>
                <td>${total.bab}</td>
                <td>${total.drain}</td>
                <td>${total.drain2}</td>
                <td>${total.infus}</td>
                <td>${total.tranfusi}</td>
                <td>${total.drip_rate}</td>
                <td>${total.botle_amount}</td>
                <td></td>
                <td></td>
            </tr>`;

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