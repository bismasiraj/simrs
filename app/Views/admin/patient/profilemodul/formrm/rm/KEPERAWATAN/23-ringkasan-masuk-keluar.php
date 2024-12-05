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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>


            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit']?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address']?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Ringkasan Masuk Keluar</h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b>Nomor RM</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Nama Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Jenis Kelamin</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_gender']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tanggal Lahir (Usia)</b>
                            <?php if (!empty($visit['date_of_birth'])) : ?>
                            <p class="m-0 mt-1 p-0">
                                <?=date('d/m/Y', strtotime($visit['date_of_birth'])) . ' (' . @$visit['age'] . ')'; ?>
                            </p>
                            <?php else : ?>
                            <p class="m-0 mt-1 p-0">-</p>
                            <?php endif; ?>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['contact_address']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Agama</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['nama_agama']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Status Pernikahan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pasien['pernikahan_desc']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Pendidikan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pasien['pendidikan_desc']; ?> </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Golongan Darah</b>
                            <p class="m-0 mt-1 p-0"><?= @$pasien['gol'] === 0 ? "":@$pasien['gol']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Kewarganegaraan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pasien['warganegara_desc']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Pekerjaan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pasien['pekerjaan_desc']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['sspractitioner_name']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0"> <?= date('d-m-Y H:i', strtotime( @$visit['visit_datetime'])) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Kelas</b>
                            <div><?= @$visit['name_of_class']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bangsal/ Kamar</b>
                            <div><?= @$visit['name_of_class']; ?></div>
                        </td>
                        <td class="p-1">
                            <b>Bed</b>
                            <div><?= @$visit['bed_id'] === 0 ? "":@$visit['bed_id']; ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Informasi Medis</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Asal Pasien</b>
                            <div><?= @$visit['visitor_address'] ?></div>
                        </td>
                        <td>
                            <b>Pengirim Pasien</b>
                            <div><?= @$visit['diantar_oleh'] ?></div>
                        </td>
                        <td>
                            <b>Keluarga Dekat Pasien</b>
                            <div></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Masuk</b>
                            <div><?= @$visit['visit_date'] ?></div>
                        </td>
                        <td>
                            <b>Tanggal Keluar</b>
                            <div> <?= !@$visit['exit_date'] ? "-":@$visit['exit_date'] ?></div>
                        </td>
                        <td rowspan="3">
                            <b>Catatan</b>
                            <div></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Diagnosis (ICD-10)</b>
                            <div class="container px-3">
                                <ul id="diagnosis-data">

                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Procedure (ICD-9-CM)</b>
                            <div class="container px-3">
                                <ul id="procedure-data">

                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Status Pulang</b>
                            <div><?= @$status['nama']  ?></div>
                        </td>
                        <td>
                            <b>Kondisi Pulang</b>
                            <div><?= @$kondisi['cara_keluar']  ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tindakan Operasi</b>
                            <div><?= @$tindakan[0]['operasi']  ?></div>
                        </td>
                        <td>
                            <b>Riwayat Imunisasi</b>
                            <div><?= @$riwayat[0]['riwayat_imunisasi']?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="datetime-now"></div>
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
    Procedure()
    Diagnosis()
    $("#datetime-now").html(`<em>Dicetak pada Tanggal ${moment(new Date()).format("DD-MM-YYYY HH:mm")}</em>`)

})

const Procedure = () => {
    <?php $dataJson = json_encode( $prod); ?>
    let dataResult = []
    let data = <?php echo $dataJson; ?>;

    data.map(e => {
        dataResult += `<li>${e.diagnosa_id} - ${e.diagnosa_name}</li>`
    })
    $("#procedure-data").html(dataResult)

}

const Diagnosis = () => {
    <?php $dataJson = json_encode( $diag); ?>
    let dataResult = []
    let data = <?php echo $dataJson; ?>;

    data.map(e => {
        dataResult += `<li>${e.diagnosa_id} - ${e.diagnosa_name}</li>`
    })
    $("#diagnosis-data").html(dataResult)
}
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