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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url() ?>css/jquery.signature.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>js/jquery.signature.js"></script>

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
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                </div>
                <div class="col mt-2">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p class="mb-0"><?= @$kop['contact_address'] ?>, <?= @$kop['phone']; ?>, Fax: <?= @$kop['fax']; ?>, <?= @$kop['kota']; ?></p>
                    <p><?= @$kop['sk']; ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
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
                        <td>No.RM</td>
                        <td>:</td>
                        <td>
                            <div id="no_rm"><?= $visit['no_registration']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>:</td>
                        <td>
                            <div id="name_patient"><?= $visit['diantar_oleh']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>JK/Umur</td>
                        <td>:</td>
                        <td>
                            <div id="gender_patient_age"><?= $visit['gender'] == 1 ? 'Laki-laki' : 'Perempuan'; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Pasien</td>
                        <td>:</td>
                        <td>
                            <div id="adresss_patient"><?= $visit['visitor_address']; ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <!--kanan -->
                    <tr>
                        <td>No.Pemeriksaan</td>
                        <td>:</td>
                        <td>
                            <div id="no_check"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>
                            <div id="date_check"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Dokter Pengirim</td>
                        <td>:</td>
                        <td>
                            <div id="doctor_send"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <table class="table-borderless">
                <thead class="border" style="vertical-align: text-top;">
                    <tr>
                        <td style="width: 10%;">Pemeriksaan : </td>
                        <td>
                            <div id="pemeriksaan-val" class="fw-bold"></div>
                        </td>
                    </tr>
                </thead>
            </table>

            <div><b>Dengan Hormat</b></div>
            <p id="dengan-hormat-val"></p>
            <div><b>Catatan/Rekomendasi</b></div>
            <p id="note-val"></p>


            <div class="row mb-2">
                <div class="col-3" align="center">
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Pemeriksa</div>
                    <div>
                        <div class="pt-2 pb-2" id="qrcode"></div>
                    </div>
                    <div id="validator-ttd"></div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>



<script>
    $(document).ready(function() {
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables();
        renderDataPatient();

    })

    const dataRenderTables = () => {
        <?php $dataJsonTables = json_encode(@$dataTables); ?>

        let dataTable = <?php echo $dataJsonTables; ?>


        $("#no_check").html(dataTable[0]?.nota_no)
        $("#date_check").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
        $("#doctor_send").html(dataTable[0]?.doctor)
        $("#pemeriksaan-val").html(dataTable[0]?.tarif_name)
        $("#dengan-hormat-val").html(dataTable[0]?.result_value)
        $("#note-val").html(dataTable[0]?.conclusion)
        $("#validator-ttd").html(dataTable[0]?.doctor)



        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: `${dataTable[0]?.doctor}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });


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

    }
</style>

<script type="text/javascript">
    window.print();
</script>

</html>