<!DOCTYPE html>
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
    <link href="<?= base_url('assets/css/jquery.min.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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

        @media print {
            .page {
                page-break-before: always;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
            }

            .footer .pagenum:before {
                content: counter(page);
            }

            /* Menampilkan konten sesuai dengan halaman */
            .content {
                display: block;
            }
        }

        .table-container-data {
            border: 1px solid black;
            width: 100%;
        }

        .table-container-data th,
        .table-container-data td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }


        .table-container-data .text-left.isi-informasi {
            font-size: 12px;
            max-width: 300px;
            word-wrap: break-word;
            max-height: 100px;
            overflow-y: auto;
        }


        .table-container-data .text-left.tanda {
            font-size: 12px;
            white-space: nowrap;
            text-align: center;
        }
    </style>
</head>
<div id="CM_A_03-content">

    <body>
        <div class="page">
            <div class="container-fluid">

                <!-- template kop -->
                <?= view(
                    "admin/patient/profilemodul/template/template-kop-3.php"
                ) ?>
                <!-- endof template kop -->
                <div class="p-2" id="data-informasi-CM_A_03">
                    <h5 class="text-center">Dokumentasi Case Manager Form</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['no_registration']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['name_of_pasien']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['gender'] == 2 ? 'Perempuan' : 'Laki-Laki'; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0"><?= tanggal_indo($visit['visit']['date_of_birth']) . ' (' . @$visit['visit']['age'] . ')'; ?></p>

                            </td>
                            <td class="p-1" style="width:66.3%" colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['contact_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1" style="width:33.3%">
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['fullname']; ?></p>
                            </td>
                            <td class="p-1" style="width:33.3%">
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['departmen']; ?></p>
                            </td class="p-1">
                            <td class="p-1" style="width:33.3%">
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= tanggal_indo(date('Y-m-d')) ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1">
                                <b>Kelas</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['class_id']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bangsal/Kamar</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['class_room_id']; ?></p>
                            </td>
                            <td class="p-1">
                                <b>Bed</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit']['bed']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-2" id="data-informasi-CM_A_03">
                    <h5 class="text-center">Dokumentasi Case Manager Form</h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3" class="text-center">EVALUASI AWAL CASE MANAGER</th>
                    </tr>
                    <tr>
                        <th width="60%">SKRINING AWAL</th>
                        <th width="20%"><?= 'Tanggal: ' . tanggal_indo(date_format(date_create($data1[0]['modified_date']), 'Y-m-d')); ?></th>
                        <th width="20%"><?= 'Jam : ' . date_format(date_create($data1[0]['modified_date']), 'H:i'); ?></th>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Beri tanda (√) pada pilihan data risiko yang sesuai:</th>
                        </tr>
                        <tr>
                            <th width="1%">No</th>
                            <th width="1%"></th>
                            <th>Data Resiko</th>
                            <th>Problem Pelayanan</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-CM_A_01">
                        <?php foreach ($data1 as $key => $row) : ?>
                            <tr>
                                <td class="py-0" width="1%"><?= $key + 1; ?></td>
                                <td class="py-0" width="1%"><?= empty($row['value_info']) ? $row['value_info'] : '&#10003;'; ?></td>
                                <td class="py-0" width="59%"><?= $row['value_desc']; ?></td>
                                <td class="py-0" width="39%"><?= $row['desc']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">ASESMEN MANAJEMEN PELAYANAN PASIEN</th>
                        </tr>
                        <tr>
                            <th width="1%">No</th>
                            <th>Asesmen</th>
                            <th>Asesmen</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-CM_A_02">
                        <?php foreach ($data2 as $key => $row) : ?>
                            <tr>
                                <td class="py-0" width="1%"><?= $key + 1; ?></td>
                                <td class="py-0" width="59%"><?= $row['value_desc']; ?></td>
                                <td class="py-0" width="40%"><?= $row['value_info']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">ASESMEN MANAJEMEN PELAYANAN PASIEN</th>
                        </tr>
                        <tr>
                            <th width="1%">No</th>
                            <th></th>
                            <th>Asesmen</th>
                        </tr>
                    </thead>
                    <tbody id="data-ttd-CM_A_03">
                        <?php foreach ($data3 as $key => $row) : ?>
                            <tr>
                                <td class="py-0" width="1%"><?= $key + 1; ?></td>
                                <td class="py-0" width="1%"><?= empty($row['value_info']) ? $row['value_info'] : '&#10003;'; ?></td>
                                <td class="py-0" width="58%"><?= $row['value_desc']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <i class="my-4">*dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')) ?></i>
            </div>
        </div>

    </body>
</div>
<!-- <script>
    $(document).ready(function() {
        getDataStart()
    });

    const getDataStart = () => {
        let data1 = <?= json_encode($visit) ?>;
        console.log(data1);
        let param = data1?.parameter_id;
        if (param !== undefined) {
            let lastPart;

            if (typeof param === 'string') {
                if (param.includes('_')) {
                    let parts = param.split('_');
                    lastPart = parts[parts.length - 1];
                } else {
                    lastPart = param;
                }
            } else if (typeof param === 'number') {
                lastPart = param.toString();
            } else {
                console.error('Parameter ID is not valid or undefined.');
            }



            if (lastPart !== undefined) {
                $(`#${lastPart}-content`).removeAttr("hidden");
            } else {
                console.error('Cannot find valid lastPart to remove hidden attribute.');
            }
        } else {
            console.error('Parameter ID is not valid or undefined.');
        }

        postData({
            body_id: data1?.body_id,
            visit_id: data1?.visit_id,
        }, 'admin/CaseManager/getDetailByVisit', (res) => {
            let hasil = {
                data: res
            };
            contentData(hasil);
        });

    };
    const contentData = (result) => {
        let data2 = <?= json_encode($AValue) ?>;
        let hasil = "";
        let aValue = data2.filter(item => item?.p_type === "GEN0019");
        let dataContent = '';
        let dataInformasi = '';
        let dataTTD = '';
        result1 = result.data.filter(item => item?.p_type === "GEN0019" && item?.parameter_id === 'CM_A_01');
        // result2 = result.data.filter(item => item?.p_type === "GEN0019" && item?.parameter_id === 'CM_A_02');
        // result3 = result.data.filter(item => item?.p_type === "GEN0019" && item?.parameter_id === 'CM_A_03');
        console.log(result1);
        // console.log(result2);
        // console.log(result3);
        // getDataIdTables({
        //     id: result.data[2].value_info,
        //     score: result.data[2].value_score,
        //     vId: result.data[2].value_id,
        //     element: "#jenis-kelamin-B03"
        // })
        // getDataByID({
        //     table: 'sex',
        //     value_info: visit[aValue[12].value_info],
        //     value_id: aValue[12].value_info,
        //     element: "#jenis-kelamin-2-B03"
        // })
        // getDataIdTables({
        //     id: result.data[4].value_info,
        //     score: result.data[4].value_score,
        //     vId: result.data[4].value_id,
        //     element: "#pekerjaan-B03"
        // })
        // getDataIdTables({
        //     id: result.data[7].value_info,
        //     score: result.data[7].value_score,
        //     vId: result.data[7].value_id,
        //     element: "#selaku-B03"
        // })

        // dataInformasi +=
        //     `
        //         <h5 class="text-center">${aValue[0].value_info}</h5>

        //         `;

        // dataContent +=
        //     `
        //         <tr>
        //             <td class="py-0" style="width: 200px;">Yang bertandatangan dibawah ini</td>
        //             <td class="py-0" width="1%">:</td>
        //             <td class="py-0"></td>
        //         </tr>
        //     `;
        result1.forEach((element, index) => {
            dataContent +=
                `
                    <tr>
                        <td class="py-0" width="1%">${index+1}</td>
                        <td class="py-0">${element.value_desc}</td>
                        <td class="py-0">${element.value_info}</td>
                    </tr>
                    `;
        });


        $("#data-informasi-CM_A_03").html(dataInformasi);
        $("#data-table-CM_A_01").html(dataContent);
        // $("#data-ttd-CM_A_03").html(dataTTD);

        // let element = document.getElementById(`ttd-pernyataan-B03`);
        // let element1 = document.getElementById(`ttd-dokter-B03`);
        // let element2 = document.getElementById(`ttd-medis-B03`);
        // let element3 = document.getElementById(`ttd-saksi-B03`);

        // if (element) {
        //     generateQRCode(`ttd-pernyataan-B03`, visit.name_of_pasien, 100, 100);
        // }
        // if (element1) {
        //     generateQRCode(`ttd-dokter-B03`, visit.fullname, 100, 100);
        // }
        // if (element2) {
        //     generateQRCode(`ttd-medis-B03`, visit.fullname, 100, 100);
        // }
        // if (element3) {
        //     generateQRCode(`ttd-saksi-B03`, result.data[1].value_info, 100, 100);
        // }
    }
</script> -->

</html>