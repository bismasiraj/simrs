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
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


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
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                <!-- <h3>Surakarta</h3> -->
                <p><?= @$kop['contact_address'] ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
        </div>
        <div class="row">
            <h3 class="text-center content-title" id="content-title">Surat Pengantar Pemeriksaan Fisioterapi</h3>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Nomor RM</b>
                        <div id="no_registration" name="no_registration"></div>
                    </td>
                    <td>
                        <b>Nama Pasien</b>
                        <div id="thename" name="thename" class="thename"></div>
                    </td>
                    <td>
                        <b>Jenis Kelamin</b>
                        <div name="gender" id="gender">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Tanggal Lahir (Usia)</b>
                        <div id="patient_age" name="patient_age"></div>
                    </td>
                    <td colspan="2">
                        <b>Alamat Pasien</b>
                        <div id="theaddress" name="theaddress" class="theaddress"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>DPJP</b>
                        <div id="doctor" name="doctor"></div>
                    </td>
                    <td>
                        <b>Department</b>
                        <div id="clinic_id" name="clinic_id"></div>
                    </td>
                    <td>
                        <b>Tanggal Masuk</b>
                        <div id="examination_date" name="examination_date"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col text-center">
                <h3><b><u id="content-title" class="content-title"></u></b></h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Dengan hormat, <br>
                Bersama ini kami kirimkan pasien :
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-2 col-form-label">Nama pasien</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="thename" name="thename" class="thename"></div>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-2 col-form-label">Umur</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="age" name="age" class="age"></div>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-2 col-form-label">No. Register</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="no_Register" name="no_Register"></div>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-2 col-form-label">Alamat</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="theaddress" name="theaddress" class="theaddress"></div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="sa" class="col-sm-2 col-form-label">Diagnosis sementara</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="diagnosa_sementara" name="diagnosa_sementara"></div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                Mohon dapat diberikan tindakan / pemeriksaan : <br>
                <span id="hasil-tindakan"></span>
                Catatan:<span id="catatan"></span>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div><span id="name-rs"></span><br>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>

</script>
<script>
    $(document).ready(function() {
        let visit = <?= json_encode($visit) ?>;
        let aValue = <?= json_encode($aValue) ?>;
        let kop = <?= json_encode($kop) ?>;

        $("#name-rs").html(kop?.name_of_org_unit)


        const body_id = "202407081107530267EB3"; // bawa bodyIdnya 
        aValue.forEach(item => {
            if (item.value_score === 10) {
                item.value_info = item.value_info.replace('$body_id', body_id);
            }
            item.value_desc = item.value_desc;
        });

        postData(aValue, 'admin/rm/lainnya/getDataAllLabRad', (res) => {
            dataResultFisioterapiApi({
                result: res?.data
            });

        }, () => {

        });

        // Render informasi pasien dan judul konten
        $("#no_registration").html(visit?.no_registration);
        $(".thename").html(visit?.diantar_oleh);
        $("#gender").html(visit?.gendername);
        $("#patient_age").html(visit?.org_unit_code);
        $(".theaddress").html(visit?.visitor_address);
        $("#doctor").html(visit?.employee_id);
        $("#clinic_id").html(visit?.clinic_id);
        $("#examination_date").html(moment(new Date()).format("YYYY-MM-DD HH:mm"));
        $("#age").html(visit?.age);

        $(".content-title").html(aValue[0]?.value_info);


        setTimeout(function() {
            window.print();
        }, 1000);
    });

    const dataResultFisioterapiApi = (data) => {
        $("#no_Register").html(data.result[0].query_results[0].body_id);
        $("#diagnosa_sementara").html(data.result[1].query_results[0].diagnosa_desc);
        $("#catatan").html(data.result[3].query_results[0].descriptions);

        let resultTindakan = '';
        data.result[2].query_results.forEach((item, index) => {
            resultTindakan += `<p>${index + 1}. ${item?.treatment}</p>`;
        });

        $("#hasil-tindakan").html(resultTindakan);
    };
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'sa',
        width: 100,
        height: 100,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>

<style>
    @media print {
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
    }
</style>


</html>