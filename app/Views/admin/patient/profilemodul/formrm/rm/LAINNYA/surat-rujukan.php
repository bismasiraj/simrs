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
        <form action="/admin/rekammedis/rmj2_4/<?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <?php csrf_field(); ?>
            <div class="row text-center mb-2">
                <div class="col-auto">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px" alt="Logo">
                </div>
                <div class="col">
                    <h3><?= @$kop['name_of_org_unit']?></h3>
                    <p><?= @$kop['contact_address']?></p>
                </div>
                <div class="col-auto">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px"
                        alt="Paripurna Logo">
                </div>
            </div>
            <div class="row mb-2">
                <h3 class="text-center"><?= $title; ?></h3>
            </div>


            <div class="row mb-2">
                <div class="col">
                    Kepada YTH: <br>
                    <?= @$data['dpjp']?> <br>
                    Bedah / Urologi <br>
                    <?= @$kop['name_of_org_unit']?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    Dengan hormat, <br>
                    Bersama ini kami kirimkan pasien:
                </div>
            </div>

            <!-- Form Input Fields -->
            <?php
            $fields = [
                'Nama' => 'nama',
                'Umur' => 'umur',
                'Alamat' => 'alamat',
                'Pekerjaan' => 'job',
                'Dengan keluhan / diagnosa' => 'diagnosis',
                'Sudah saya berikan' => 'treatment',
                'Alasan Rujuk' => 'alasan_kontrol',
                'Kebutuhan Pelayanan' => 'service_needs',
                'Keterangan Lain' => 'other_remarks'
            ];
            
            foreach ($fields as $label => $name): ?>
            <div class="row mb-2">
                <label for="<?= $name ?>" class="col-sm-3 col-form-label"><?= $label ?></label>
                <label for="<?= $name ?>" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <span id="<?= $name ?>"><?= isset($data[$name]) ? $data[$name] : '-' ?></span>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="row mb-3">
                <div class="col"></div>
                <div class="col-auto text-end">
                    <div>Dokter Penanggung Jawab Pelayanan</div>
                    <div class="col-auto justify-end" id="qrcode">
                    </div>
                </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: 'sa',
    width: 70,
    height: 70,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H // High error correction
});
</script>
<script>
$(document).ready(function() {
    $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
    $("#no_registration").val("<?= $visit['no_registration']; ?>")
    $("#visit_id").val("<?= $visit['visit_id']; ?>")
    $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
    $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
    $("#in_date").val("<?= $visit['in_date']; ?>")
    $("#exit_date").val("<?= $visit['exit_date']; ?>")
    $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
    <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        ?>
    $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
    $("#employee_id").val("<?= $visit['employee_id']; ?>")
    $("#description").val("<?= $visit['description']; ?>")
    $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
    $("#modified_by").val("<?= user()->username; ?>")
    $("#modified_from").val("<?= $visit['clinic_id']; ?>")
    $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
    $("#ageyear").val("<?= $visit['ageyear']; ?>")
    $("#agemonth").val("<?= $visit['agemonth']; ?>")
    $("#ageday").val("<?= $visit['ageday']; ?>")
    $("#thename").val("<?= $visit['diantar_oleh']; ?>")
    $("#theaddress").val("<?= $visit['visitor_address']; ?>")
    $("#theid").val("<?= $visit['pasien_id']; ?>")
    $("#isrj").val("<?= $visit['isrj']; ?>")
    $("#gender").val("<?= $visit['gender']; ?>")
    $("#doctor").val("<?= $visit['employee_id']; ?>")
    $("#kal_id").val("<?= $visit['kal_id']; ?>")
    $("#petugas_id").val("<?= user()->username; ?>")
    $("#petugas").val("<?= user()->fullname; ?>")
    $("#account_id").val("<?= $visit['account_id']; ?>")
})
$("#btnSimpan").on("click", function() {
    saveSignatureData()
    saveSignatureData1()
    console.log($("#TTD").val())
    $("#form").submit()
})
$("#btnEdit").on("click", function() {
    $("input").prop("disabled", false);
    $("textarea").prop("disabled", false);

})
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
}
</style>
<script type="text/javascript">
window.print();
</script>

</html>