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
            <h5 class="text-center"><?= $date['start']?> - <?= $date['end']?> </h5>
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
                        <th rowspan="3" class="align-middle text-uppercase  text-center">TGL/JAM</th>
                        <th rowspan="3" class="align-middle text-uppercase text-center">Berat</th>
                        <th colspan="5" class="align-middle text-uppercase text-center text-center">PEMASUKAN</th>
                        <th colspan="9" class="align-middle text-uppercase text-center text-center">PENGLUARAN</th>
                        <th rowspan="3" class="align-middle text-uppercase text-center">Kesimpulan</th>


                        <th rowspan="3" class="align-middle text-uppercase text-center">Nama petugas</th>
                        <th rowspan="3" class="align-middle text-uppercase text-center">paraf</th>
                    </tr>
                    <tr>
                        <!-- <th class="text-uppercase align-middle text-center" colspan="2 ">Oral</th> -->
                        <th class="text-uppercase align-middle text-center" colspan="2">ENTERAL</th>
                        <th class="text-uppercase align-middle text-center" colspan="2">Perenteral</th>
                        <th rowspan="2" class="align-middle text-uppercase">Total Cairan Masuk</th>
                        <th class="text-uppercase align-middle text-center" colspan="2">Muntah</th>
                        <th rowspan="2" class="align-middle text-uppercase text-center">Drain Wsd</th>
                        <th rowspan="2" class="align-middle text-center">BAK (cc) Warna</th>
                        <th rowspan="2" class="align-middle text-uppercasetext-center">BAB</th>
                        <th rowspan="2" class="align-middle text-center">NGT (cc)</th>
                        <th rowspan="2" class="align-middle text-center">IWL (cc)</th>
                        <th rowspan="2" class="align-middle text-center">Urine</th>
                        <th rowspan="2" class="align-middle text-uppercasetext-center">Total Cairan Keluar</th>
                    </tr>
                    <tr>
                        <!-- <th class="align-middle">Jenis</th> -->
                        <!-- <th class="align-middle">jml (cc)</th> -->
                        <th class="align-middle">Jenis</th>
                        <th class="align-middle">jml (cc)</th>
                        <th class="align-middle">Jenis Cairan</th>
                        <th class="align-middle">jml (cc)</th>
                        <th class="align-middle">Jenis</th>
                        <th class="align-middle">jml (cc)</th>
                    </tr>
                </thead>
                <tbody id="data_tables">

                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-start mb-3">
            <button type="button" onclick="window.print()" data-loading-text="<?php echo lang('processing') ?>"
                class="btn btn-warning">
                <i class="fas fa-print"></i> Cetak
            </button>


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
    let dateTime = <?= json_encode($date)?>;
    let vitail = <?= json_encode($exam) ?>


    let filteredDataValue = aValue?.filter(item => item?.p_type === "GEN0023");
    const resultNotIwl = result.filter(item => item.fluid_type !== "G0230308");
    const resultIwl = result.filter(item => item.fluid_type === "G0230308");


    const filteredData = resultIwl.filter(item => {
        const examinationDate = moment(item.examination_date).format("YYYY-MM-DD HH")
        const iwlTime = moment(item.iwl_time).format("YYYY-MM-DD HH")
        return examinationDate === dateTime.start && iwlTime === dateTime.end;
    });
    let resultIwlValue = {}



    if (filteredData.length > 0) {
        resultIwlValue = filteredData[0]
    }

    const fluidTypeMapping = {
        "G0230301": "oral",
        "G0230309": "enteral",
        "G0230302": "parenteral",
    };

    const groupData = (data) => {
        const grouped = {};


        data.forEach(item => {
            const dateKey = moment(new Date(item.examination_date)).format("DD-MM-YYYY");
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
    let kesimpuanblc = '';


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
                } else if (item.fluid_type === "G0230312") {
                    pengeluaran.bak += item.fluid_amount || 0;
                } else if (item.fluid_type === "G0230306") {
                    pengeluaran.bab += item.fluid_amount || 0;
                } else if (item.fluid_type === "G0230303") {
                    pengeluaran.urin += item.fluid_amount || 0;
                }
                // else if (item.fluid_type === "G0230308") {
                //     pengeluaran.iwl += resultIwlValue.fluid_amount || 0;
                // }

                if (item.fluid_type !== "G0230308") {
                    pengeluaran.totalKeluar += item.fluid_amount || 0;
                }
            }
        });

        function removeDuplicatesAndJoin(array) {
            return [...new Set(array)].join(', ');
        }


        let oralJenis = removeDuplicatesAndJoin(pemasukan.oral.jenis)
        let enteralJenis = removeDuplicatesAndJoin(pemasukan.enteral.jenis);
        let parenteralJenis = removeDuplicatesAndJoin(pemasukan.parenteral.jenis);
        let muntahJenis = removeDuplicatesAndJoin(pengeluaran.muntah.jenis);

        const kesimpulan = pemasukan?.totalMasuk - pengeluaran?.totalKeluar - resultIwlValue?.fluid_amount;
        const dateHeader = group[0].examination_date.replace('T', ' ');

        const startDate = new Date(convertCairanDateTime(dateTime.start));
        const endDate = new Date(convertCairanDateTime(dateTime.end));
        const timeDifference = endDate - startDate;

        const hoursDifference = timeDifference / (1000 * 60 * 60);

        let weight = parseFloat(vitail?.weight);
        let hasilkesimpulanblc = 0;

        if (weight && timeDifference) {
            const raw = pengeluaran.urin / weight / timeDifference;
            hasilkesimpulanblc = Number(raw.toPrecision(3));
        }

        let finalHasilhasilkesimpulanblc = Number(hasilkesimpulanblc.toPrecision(3));
        let tampilkanhasilkesimpulanblc = parseFloat(finalHasilhasilkesimpulanblc.toExponential(2).split(
            'e')[0]);
        console.log("hasil:", tampilkanhasilkesimpulanblc);



        data += `<tr>
            <td>${moment(group[0].examination_date).format("DD/MM/YYYY")} Jam ${moment(group[0].examination_date).format("HH")}</td>
            <td>${/^[0-9]+$/.test(group[0].awareness) ? parseInt(group[0].awareness, 10) : ''}</td>
            <!--<td>${oralJenis}</td>
            <td>${pemasukan.oral.jumlah}</td>-->
            <td>${enteralJenis}</td>
            <td>${pemasukan.enteral.jumlah}</td>
            <td>${parenteralJenis}</td>
            <td>${pemasukan.parenteral.jumlah}</td>
            <td class='fw-bold'>${pemasukan.totalMasuk}</td>
            <td>${muntahJenis}</td>
            <td>${pengeluaran.muntah.jumlah}</td>
            <td>${pengeluaran.drain}</td>
            <td>${pengeluaran.bak}</td>
            <td>${pengeluaran.bab}</td>
            <td>${pengeluaran.ngt}</td>
            <td>${resultIwlValue.fluid_amount}</td>
            <td>${pengeluaran.urin}</td>
            <td class='fw-bold'>${pengeluaran.totalKeluar}</td>
            <td class='fw-bold'>${kesimpulan >= 0 ? '+' : ''}${kesimpulan}</td>
            <td>${group[0].nama_petugas || ''}</td>
            <td>${group[0].paraf || ''}</td>
        </tr>`;

        kesimpuanblc = `<tr>
                            <td colspan="15"></td>
                            <td style="text-align: center; vertical-align: middle;" colspan="2">
                                            <label class="fw-bold">KESIMPULAN BALANCE</label><br>
                                            <span></span>
                                            <span></span>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="15"></td>
                            <td style="text-align: center; vertical-align: middle;" colspan="2">
                                            <label class="fw-bold">Diuresis</label><br>
                                            <span></span>
                                            <span>${tampilkanhasilkesimpulanblc}</span>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        `
    });


    $("#data_tables").html(data + kesimpuanblc);
};

const convertCairanDateTime = (dateString) => {
    if (/^\d{4}-\d{2}-\d{2} \d{2}$/.test(dateString)) {
        dateString += ":00";
    }

    const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
    const parsedDate = moment(dateString, formats, true);

    if (parsedDate.isValid()) {
        return parsedDate.format("YYYY-MM-DD HH:mm");
    } else {
        return null;
    }
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

    .d-flex button {
        display: none;
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
    // window.print();
}, 2000);
</script>

</html>