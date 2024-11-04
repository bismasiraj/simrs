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
            <h3 class="text-center content-title" id="content-title">Surat Permintaan Tranfusi Darah</h3>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Nomor RM</b>
                        <div id="no_registration" name="no_registration"><?= @$visit['no_registration']; ?></div>
                    </td>
                    <td>
                        <b>Nama Pasien</b>
                        <div id="thename" name="thename" class="thename"><?= @$visit['diantar_oleh']; ?></div>
                    </td>
                    <td>
                        <b>Jenis Kelamin</b>
                        <div name="gender" id="gender">
                            <?= @$visit['name_of_gender']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Tanggal Lahir (Usia)</b>
                        <div id="patient_age" name="patient_age"><?= @$visit['date_of_birth']; ?>
                            (<?= @$visit['age']; ?> )</div>
                    </td>
                    <td colspan="2">
                        <b>Alamat Pasien</b>
                        <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['contact_address']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>DPJP</b>
                        <div id="fullname" name="fullname"><?= @$visit['fullname']; ?></div>
                    </td>
                    <td>
                        <b>Department</b>
                        <div id="clinic_id" name="clinic_id"><?= @$visit['clinic_id']; ?></div>
                    </td>
                    <td>
                        <b>Tanggal Masuk</b>
                        <div id="examination_date" name="examination_date"><?= @$visit['visit_date']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col text-center">
                <h3><b><u id="content-title" class="content-title">Surat Permintaan Tranfusi Darah</u></b></h3>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-3 col-form-label">Bagian</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="thename" name="thename" class="thename"><?= @$visit['name_of_clinic']; ?></div>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-3 col-form-label">Dokter yang meminta</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="thename" name="thename" class="thename"><?= @$visit['fullname']; ?></div>
            </div>
        </div>
        <div class="row">
            <h4 for="sa" class="col-sm-12 col-form-label fw-bold"><u>PENDERITA</u></h4>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <label for="sa" class="col-sm-6 col-form-label">Nama</label>
                    <label for="sa" class="col-sm-auto col-form-label">:</label>
                    <div class="col pt-2">
                        <div id="thename" name="thename" class="thename"><?= @$visit['diantar_oleh']; ?></div>
                    </div>
                </div>

                <div class="row">
                    <label for="sa" class="col-sm-6 col-form-label">Jenis Kelamin</label>
                    <label for="sa" class="col-sm-auto col-form-label">:</label>
                    <div class="col pt-2">
                        <div id="no_Register" name="no_Register"><?= @$visit['name_of_gender']; ?></div>
                    </div>
                </div>

            </div>

            <div class="col-sm-6">
                <div class="row">
                    <label for="sa" class="col-sm-6 col-form-label">Umur</label>
                    <label for="sa" class="col-sm-auto col-form-label">:</label>
                    <div class="col pt-2">
                        <div id="umur" name="umur"><?= @$visit['age']; ?> Tahun</div> <!-- Menampilkan umur di sini -->
                    </div>
                </div>
                <div class="row">
                    <label for="sa" class="col-sm-6 col-form-label">Golongan Darah</label>
                    <label for="sa" class="col-sm-auto col-form-label">:</label>
                    <div class="col pt-2">
                        <div id="golongan_darah" name="golongan_darah">
                            <?php 
                                if (isset($data['blood_type_id']) && isset($blood_type['blood_type_id'])) {
                                    if ($data['blood_type_id'] == $blood_type['blood_type_id']) {
                                        echo $blood_type['name_of_type']; 
                                    } else {
                                        echo ''; 
                                    }
                                } else {
                                    echo ''; 
                                }
                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <div class="row">
            <label for="sa" class="col-sm-3 col-form-label">Alamat</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['contact_address']; ?></div>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-3 col-form-label">Ruang</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['class_room']; ?></div>
            </div>
        </div>
        <div class="row">
            <label for="sa" class="col-sm-3 col-form-label">Ruang</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['name_of_class']; ?></div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="sa" class="col-sm-3 col-form-label">Diagnosis sementara</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="diagnosa_sementara" name="diagnosa_sementara"></div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="sa" class="col-sm-3 col-form-label">Diperlukan tanggal</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="diagnosa_sementara" name="diagnosa_sementara"><?= @$data['using_time']; ?></div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="sa" class="col-sm-3 col-form-label">Jenis Darah di perlukan</label>
            <label for="sa" class="col-sm-auto col-form-label">:</label>
            <div class="col pt-2">
                <div id="diagnosa_sementara" name="diagnosa_sementara">
                    <?php 
                $result = '';

                $blood_usage_type = isset($data['blood_usage_type']) ? intval($data['blood_usage_type']) : 0;
                $usage_type_value = isset($usage_type['usage_type']) ? intval($usage_type['usage_type']) : 0;

              
                if ($blood_usage_type === $usage_type_value) {
                    $result .= $usage_type['usagetype'];
                }

               
                if (!empty($data['blood_quantity'])) {
                    $result .= ' | ' . $data['blood_quantity'] ;
                }

              
                $measure_id = isset($data['measure_id']) ? intval($data['measure_id']) : 0;
                $measurement_value = isset($measurement['measure_id']) ? intval($measurement['measure_id']) : 0;

                
                if ($measure_id === $measurement_value) {
                    $result .= ' ' . $measurement['measurement'];
                }

                echo $result;
            ?>
                </div>
            </div>
        </div>






        <!-- <div class="row mb-2">
            <div class="col">
                Mohon dapat diberikan tindakan / pemeriksaan : <br>
                <span id="hasil-tindakan"></span>
                Catatan:<span id="catatan"></span>
            </div>
        </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>

</script>
<script>
$(document).ready(function() {
    let visit = <?= json_encode($visit) ?>;




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