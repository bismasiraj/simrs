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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet"> -->
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>
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

                <p><?= @$organization['contact_address'] ?>,<?= @$organization['phone'] ?>, Fax:
                    <?= @$organization['fax'] ?>,
                    <?= @$organization['kota'] ?>
                    <br><?= @$organization['sk'] ?>
                </p>
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
        <div class="d-flex flex-wrap mb-3 contain-tabels">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="3" class="align-middle text-uppercase ">TGL/JAM</th>
                        <th rowspan="3" class="align-middle text-uppercase">Berat</th>
                        <th colspan="5" class="align-middle text-uppercase text-center">PEMASUKAN</th>
                        <th colspan="8" class="align-middle text-uppercase text-center">PENGLUARAN</th>
                        <th rowspan="3" class="align-middle text-uppercase">Kesimpulan</th>


                        <!-- <th rowspan="3" class="align-middle text-uppercase">Nama petugas</th>
                        <th rowspan="3" class="align-middle text-uppercase">paraf</th> -->
                    </tr>
                    <tr>
                        <!-- <th class="text-uppercase align-middle" colspan="2">Oral</th> -->
                        <th class="text-uppercase align-middle" colspan="2">ENTERAL</th>
                        <th class="text-uppercase align-middle" colspan="2">Perenteral</th>
                        <th rowspan="2" class="align-middle text-uppercase">Total Cairan Masuk</th>
                        <th class="text-uppercase align-middle" colspan="2">Muntah</th>
                        <th rowspan="2" class="align-middle text-uppercase">Drain Wsd</th>
                        <th rowspan="2" class="align-middle ">BAK (cc) Warna</th>
                        <th rowspan="2" class="align-middle text-uppercase">BAB</th>
                        <th rowspan="2" class="align-middle ">NGT (cc)</th>
                        <th rowspan="2" class="align-middle ">IWL</th>
                        <!-- <th rowspan="2" class="align-middle ">Urine</th> -->
                        <th rowspan="2" class="align-middle text-uppercase">Total Cairan Keluar</th>
                    </tr>
                    <tr>
                        <!-- <th>Jenis</th>
                        <th>jml (cc)</th> -->
                        <th>Jenis</th>
                        <th>jml (cc)</th>
                        <th>Jenis Cairan</th>
                        <th>jml (cc)</th>
                        <th>Jenis</th>
                        <th>jml (cc)</th>
                    </tr>
                </thead>
                <tbody id="data_tables">

                </tbody>
            </table>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->

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
        const resultNotIwl = result
        // const resultNotIwl = result.filter(item => item.fluid_type !== "G0230308");
        console.log(resultNotIwl);


        const fluidTypeMapping = {
            "G0230301": "oral",
            "G0230309": "enteral",
            "G0230302": "parenteral",
            // "G0230303": "urine",
            // "G0230304": "muntah",
            // "G0230305": "ngt",
            // "G0230306": "bab",
            // "G0230307": "drain",
            // "G0230308": "drain2",
            // "G0230310": "tranfusi",
        };

        const groupData = (data) => {
            const grouped = {};


            data.forEach(item => {
                const dateKey = moment(new Date(item.examination_date)).format("DD-MM-YYYY HH");
                if (!grouped[dateKey]) {
                    grouped[dateKey] = [];
                }
                grouped[dateKey].push(item);
            });

            Object.keys(grouped).forEach(dateKey => {
                grouped[dateKey].sort((a, b) => new Date(b.examination_date) - new Date(a
                    .examination_date));
            });
            return grouped;
        };

        const groupedData = groupData(resultNotIwl);
        let data = '';


        Object.keys(groupedData).forEach(dateKey => {

            const group = groupedData[dateKey];

            let pemasukan = {
                oral: {
                    jenis: [],
                    jumlah: 0
                },
                enteral: {
                    jenis: [],
                    jumlah: 0
                },
                parenteral: {
                    jenis: [],
                    jumlah: 0
                },

                totalMasuk: 0
            };

            let pengeluaran = {
                muntah: {
                    jenis: [],
                    jumlah: 0
                },
                drain: 0,
                bak: 0,
                bab: 0,
                ngt: 0,
                iwl: 0,
                urin: 0,
                totalKeluar: 0
            };

            group.forEach(item => {
                let fluidType = fluidTypeMapping[item.fluid_type];
                if (fluidType && fluidType !== "muntah") {
                    pemasukan[fluidType].jenis.push(item?.fluid_category);
                    pemasukan[fluidType].jumlah += item.fluid_amount || 0;
                    pemasukan.totalMasuk += item.fluid_amount || 0;
                } else {
                    if (item.fluid_type === "G0230304") {
                        pengeluaran.muntah.jenis.push(item.fluid_category);
                        pengeluaran.muntah.jumlah += item.fluid_amount || 0;
                    }
                    if (item.fluid_type === "G0230307") {
                        pengeluaran.drain += item.fluid_amount || 0;
                        // } else if (item.fluid_type === "G0230312") {
                        //     pengeluaran.bak += item.fluid_amount || 0;
                    } else if (item.fluid_type === "G0230306") {
                        pengeluaran.bab += item.fluid_amount || 0;
                    } else if (item.fluid_type === "G0230303") {
                        pengeluaran.urin += item.fluid_amount || 0;
                    } else if (item.fluid_type === "G0230308") {
                        pengeluaran.iwl += item.fluid_amount || 0;
                    }
                    pengeluaran.totalKeluar += item.fluid_amount || 0;
                }
            });

            function removeDuplicatesAndJoin(array) {
                return [...new Set(array)].join(', ');
            }


            let oralJenis = removeDuplicatesAndJoin(pemasukan.oral.jenis)
            let enteralJenis = removeDuplicatesAndJoin(pemasukan.enteral.jenis);
            let parenteralJenis = removeDuplicatesAndJoin(pemasukan.parenteral.jenis);
            let muntahJenis = removeDuplicatesAndJoin(pengeluaran.muntah.jenis);

            const kesimpulan = pemasukan.totalMasuk - pengeluaran.totalKeluar;
            const dateHeader = group[0].examination_date.replace('T', ' ');
            data +=
                `<tr><td colspan="21" class="text-center fw-bold">${moment(dateHeader).format("DD/MM/YYYY HH:mm")}</td></tr>`;
            data += `<tr>
            <td>${moment(group[0].examination_date).format("DD/MM/YYYY HH:mm")}</td>
            <td>${/^[0-9]+$/.test(group[0].awareness) ? parseInt(group[0].awareness, 10) : ''}</td>
          <!--  <td>${oralJenis}</td>
            <td>${pemasukan.oral.jumlah}</td>-->
            <td>${enteralJenis}</td>
            <td>${pemasukan.enteral.jumlah}</td>
            <td>${parenteralJenis}</td>
            <td>${pemasukan.parenteral.jumlah}</td>
            <td class='fw-bold'>${pemasukan.totalMasuk}</td>
            <td>${muntahJenis}</td>
            <td>${pengeluaran.muntah.jumlah}</td>
            <td>${pengeluaran.drain}</td>
            <!--<td>${pengeluaran.bak} fgdgd</td>--->
            <td>${pengeluaran.urin}</td>
            <td>${pengeluaran.bab}</td>
            <td>${pengeluaran.ngt}</td>
            <td>${pengeluaran.iwl}</td>
            <td class='fw-bold'>${pengeluaran.totalKeluar}</td>
            <td class='fw-bold'>${kesimpulan >= 0 ? '+' : ''}${kesimpulan}</td>
        </tr>`;
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

        .contain-tabels {
            width: 100%;
            max-width: 210mm;
            font-size: 12px;
        }

        @media (max-width: 210mm) {
            .contain-tabels {
                font-size: 10px;
            }
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