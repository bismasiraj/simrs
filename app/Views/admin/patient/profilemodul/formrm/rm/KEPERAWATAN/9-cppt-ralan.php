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
        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header_only.php"); ?>
        <!-- end of template header -->
        <div class="row">
            <h4 class="text-start">Bagian I: Informasi Pasien</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <b>No. RM / Nama Pasien / Jenis Kelamin</b>
                        <p class="p-1"><?= $info['no_rm'] . ' / ' . $info['nama'] . ' / ' . $info['jeniskel']  ?></p>
                    </td>
                    <td style="width: 50%;">
                        <b>Tanggal Masuk</b>
                        <p class="p-1"><?= tanggal_indo(date('Y-m-d')) ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <b>Tanggal Lahir (Umur)</b>
                        <p class="p-1"><?= tanggal_indo($info['date_of_birth']) . ' (' . @$info['umur'] . ')'; ?></p>
                    </td>
                    <td style="width: 50%;">
                        <b>No. Episode</b>
                        <p class="p-1"><?= @$info['no_episode']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <b>Alamat</b>
                        <p class="p-1"><?= @$info['alamat']; ?></p>
                    </td>
                    <td style="width: 50%;">
                        <b>DPJP / Department</b>
                        <p class="p-1"><?= @$info['departmen']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="fw-bold">
                <tr>
                    <td style="width: 7%;">Tanggal</td>
                    <td style="width: 5%;">Kode PPA</td>
                    <td style="width: 13%;">Dokter/PPA</td>
                    <td>Catatan Dokter</td>
                    <td>Response</td>
                    <td>Verifikasi</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($val as $key => $value) : ?>
                    <tr>
                        <td><?= $value['examination_date']; ?></td>
                        <td><?= $value['kode_ppa']; ?></td>
                        <td><?= $value['nama_ppa']; ?></td>
                        <?php if ($value['kode_ppa'] == 'D') : ?>
                            <td colspan="2">
                                <p>
                                    S : <?= $value['subyectif']; ?> <br>
                                    O : <?= $value['obyektif']; ?> <br>
                                    A : <?= $value['asesmen']; ?> <br>
                                    P : <?= $value['planning']; ?> <br>
                                </p>
                            </td>
                        <?php else : ?>
                            <td width="1%">-</td>
                            <td>
                                <p>
                                    S : <?= $value['subyectif']; ?> <br>
                                    O : <?= $value['obyektif']; ?> <br>
                                    A : <?= $value['asesmen']; ?> <br>
                                    P : <?= $value['planning']; ?> <br>
                                </p>
                            </td>
                        <?php endif; ?>
                        <td>
                            <p>
                                <b>Tgl Ditulis: </b><?= empty($value['tanggal_dibuat']) ? '-' : $value['tanggal_dibuat']; ?> <br>
                                <b>Tgl Konfirm: </b><?= empty($value['tanggal_konfirm']) ? '-' : $value['tanggal_konfirm']; ?> <br>
                                <b>Konfirm Oleh: </b><?= empty($value['konfirm_oleh']) ? '-' : $value['konfirm_oleh']; ?><br>
                            </p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

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