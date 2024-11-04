<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <style>
        .table-container-split {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .table-container-split table {
            width: 45%;
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

        thead.border {
            border-bottom: 1px solid black !important;
            border-top: 1px solid black !important;
        }

        tbody.border {
            border-bottom: 1px solid black !important;
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
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                </div>
                <div class="col mt-2">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                    <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                </div>
            </div>
            <br>
            <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
            <div class="row">
                <h6 class="text-center pt-2"><?= $title; ?></h6>
            </div>
            <div class="table-container-split">
                <table>
                    <!-- kiri -->
                    <tr>
                        <td>No.Lab / No.RM</td>
                        <td>:</td>
                        <td>
                            <div id="noLab_rm"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Pasien</th>
                        <th>:</th>
                        <th>
                            <div id="name_patient"></div>
                        </th>
                    </tr>
                    <tr>
                        <td>J. Kelamin</td>
                        <td>:</td>
                        <td>
                            <div id="gender_patient"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tgl. Lahir - Umur</td>
                        <td>:</td>
                        <td>
                            <div id="date_age"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>No.Telp.</td>
                        <td>:</td>
                        <td>
                            <div id="no_tlp"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Pasien</td>
                        <td>:</td>
                        <td>
                            <div id="adresss_patient"></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <!--kanan -->
                    <tr>
                        <td>Tgl.Priksa</td>
                        <td>:</td>
                        <td>
                            <div id="date_check"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tgl. Sampel</td>
                        <td>:</td>
                        <td>
                            <div id="date_sampel"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Cara Bayar</td>
                        <td>:</td>
                        <td>
                            <div id="payment_method"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Dokter Pengirim</td>
                        <td>:</td>
                        <td>
                            <div id="doctor_send"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruang/ Poliklinik</td>
                        <td>:</td>
                        <td>
                            <div id="room_poli"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosa Klinis</td>
                        <td>:</td>
                        <td>
                            <div id="diagnosa_klinis"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <b class="text-start"><em>Dokter Penanggungjawab: <i id="doctor-responsible"></i></em></b>
            </div>
            <table class="table-borderless">
                <thead class="border" style="vertical-align: text-top;">
                    <tr>
                        <th style="width: 10%;">Nama pemeriksaan</th>
                        <th style="width: 5%;">Hasil</th>
                        <th style="width: 5%;">Satuan</th>
                        <th style="width: 7%;">Nilai Rujukan</th>
                        <th style="width: 15%;">Metode</th>
                        <th style="width: 2%;">Flag</th>
                    </tr>
                </thead>
                <tbody id="render-tables" class="border">
                </tbody>
            </table>

            <em>Hasil berupa angka menggunakan desimal dengan separator titik
                <p>H: Hasil Lebih Dari Nilai Rujukan | L: Hasil Kurang Dari Nilai Rujukan | (*): Abnormal | (K): Hasil
                    Nilai Kritis</p>
            </em>

            <h6>Expertise :</h6>
            <p>Note: Rapid Antigen SARS-CoV-2
                * Spesimen : Swab Nasofaring/ Orofaring
                * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi alat
                * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko menularkan
                ke orang lain,
                disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                probabilitas pretes relatif tinggi,
                terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi COVID-19
            </p>


            <div class="row mb-2">
                <div class="col-3" align="center">
                    <br>
                    <div>Approve & Cetak</div>
                    <div id="qrcode-container">
                        <div id="qrcode"></div>
                    </div>
                    <div id="datetime-now"></div>
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Diotorasi oleh:<br> Quality Validator</div>
                    <div>
                        <div class="pt-2 pb-2" id="qrcode1"></div>
                    </div>
                    <div id="validator-ttd"></div>
                </div>
            </div>
            <?php if (user()->checkPermission("lab", 'c') || user()->checkRoles(['dokterlab', 'superuser', 'adminlab', 'eklaim'])) { ?>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" id="Print-labbbbb" onclick="window.print()"
                        data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning">
                        <i class="fas fa-print"></i> Cetak
                    </button>


                </div>
            <?php } ?>
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
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables();
        renderDataPatient();

    })

    const dataRenderTables = () => {
        <?php $dataJsonTables = json_encode($dataTables); ?>

        let dataTable = <?php echo $dataJsonTables; ?>;
        console.log(dataTable);



        let groupedData = {};

        dataTable.forEach(e => {
            if (!groupedData[e.kel_pemeriksaan]) {
                groupedData[e.kel_pemeriksaan] = {};
            }

            if (!groupedData[e.kel_pemeriksaan][e.tarif_name]) {
                groupedData[e.kel_pemeriksaan][e.tarif_name] = [];
            }

            groupedData[e.kel_pemeriksaan][e.tarif_name].push(e);
        });


        let dataResultTable = '';

        for (let kelPemeriksaan in groupedData) {
            if (groupedData.hasOwnProperty(kelPemeriksaan)) {
                dataResultTable += `<tr>
                                        <td colspan="6"><strong>${kelPemeriksaan}</strong></td>
                                    </tr>`;
                for (let tarifName in groupedData[kelPemeriksaan]) {
                    if (groupedData[kelPemeriksaan].hasOwnProperty(tarifName)) {
                        dataResultTable += `<tr>
                                                <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                            </tr>`;

                        groupedData[kelPemeriksaan][tarifName].forEach(e => {
                            console.log(e);

                            dataResultTable += `<tr>
                                                    <td style="padding-left: 40px;">${e.parameter_name}</td>
                                                    <td>${(e.flag_hl?.trim() || '') === 'L' ? `<b style="color:blue;">${e.hasil}</b>` : 
                                                            (e.flag_hl?.trim() || '') === 'H' ? `<b style="color:red;">${e.hasil}</b>` :
                                                            (e.flag_hl?.trim() || '') === '(*)' ? `<b style="color:red;">${e.hasil}</b>` :
                                                            e.hasil}

                                                        </td>

                                                    <td>${!e.satuan? "-":e.satuan}</td>
                                                    <td>${!e.nilai_rujukan? "-":e.nilai_rujukan}</td>
                                                    <td>${!e.metode_periksa ? "-" : e.metode_periksa}</td>
                                                    <td>${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                                        (e.flag_hl?.trim() || '') === 'L' ? `<b style="color:blue;">${e.flag_hl.trim()}</b>` : 
                                                        (e.flag_hl?.trim() || '') === 'H' ? `<b style="color:red;">${e.flag_hl.trim()}</b>` :
                                                        (e.flag_hl?.trim() || '') === '(*)' ? `<b style="color:red;">${e.flag_hl.trim()}</b>` : 
                                                        e.flag_hl.trim()}


                                                    </td>

                                                </tr>`;
                        });
                    }
                }
            }
        }
        $("#render-tables").html(dataResultTable)

        // render patient -
        $("#noLab_rm").html(dataTable[0]?.nolab_lis + '/ ' + dataTable[0]?.norm)
        $("#name_patient").html(dataTable[0]?.nama)
        $("#adresss_patient").html(dataTable[0]?.alamat)
        $("#date_check").html(moment(dataTable[0]?.tgl_periksa).format("DD/MM/YYYY HH:mm:ss"))
        $("#date_sampel").html(moment(dataTable[0]?.tgl_hasil).format("DD/MM/YYYY HH:mm:ss"))
        $("#payment_method").html(dataTable[0]?.cara_bayar_name)
        $("#doctor_send").html(dataTable[0]?.pengirim_name)
        $("#room_poli").html(dataTable[0]?.ruang_name)
        $("#doctor-responsible").html(dataTable[0]?.pengirim_name)
        $("#validator-ttd").html(dataTable[0]?.pengirim_name)


        var qrcode = new QRCode(document.getElementById("qrcode1"), {
            text: `${dataTable[0]?.pengirim_name}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });

        function addImageToQRCode() {
            var qrElement = document.getElementById("qrcode");
            var qrCanvas = qrElement.querySelector('canvas');

            var img = new Image();
            img.src = '<?= base_url('assets/img/logo.png') ?>';

            img.onload = function() {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                canvas.width = qrCanvas.width;
                canvas.height = qrCanvas.height;

                ctx.drawImage(qrCanvas, 0, 0, canvas.width, canvas.height);

                var imgSize = Math.min(canvas.width, canvas.height) * 0.3;
                var imgX = (canvas.width - imgSize) / 2;
                var imgY = (canvas.height - imgSize) / 2;

                ctx.drawImage(img, imgX, imgY, imgSize, imgSize);

                qrElement.innerHTML = '';
                qrElement.appendChild(canvas);
            };
        }

        addImageToQRCode();

    }



    const renderDataPatient = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>
        // render patient 
        $("#gender_patient").html(data?.name_of_gender)
        $("#date_age").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp").html(data?.phone_number)
        $("#diagnosa_klinis").html(data?.diagnosa)
    }
</script>
<style>
    @media print {
        @page {
            margin: none;
            /* scale: 85; */
        }

        .container {
            width: 100%;
            /* Sesuaikan dengan lebar kertas A4 */
        }

        td {
            background-color: inherit;
            color: inherit;
            border: inherit;
            padding: inherit;
            text-align: inherit;
        }

        .d-flex button {
            display: none;
        }

    }
</style>

<script type="text/javascript">
    // window.print();
</script>

</html>