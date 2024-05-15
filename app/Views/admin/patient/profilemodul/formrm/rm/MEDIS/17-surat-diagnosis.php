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

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

</head>

<body>
    <div class="container mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>

            <input type="hidden" name="body_id" id="body_id">
            <input type="hidden" name="org_unit_code" id="org_unit_code">
            <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
            <input type="hidden" name="diagnosa_id" id="diagnosa_id">
            <input type="hidden" name="visit_id" id="visit_id">
            <input type="hidden" name="bill_id" id="bill_id">
            <input type="hidden" name="class_room_id" id="class_room_id">
            <input type="hidden" name="in_date" id="in_date">
            <input type="hidden" name="exit_date" id="exit_date">
            <input type="hidden" name="keluar_id" id="keluar_id">
            <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
            <input type="hidden" name="employee_id" id="employee_id">
            <input type="hidden" name="description" id="description">
            <input type="hidden" name="modified_date" id="modified_date">
            <input type="hidden" name="modified_by" id="modified_by">
            <input type="hidden" name="modified_from" id="modified_from">
            <input type="hidden" name="status_pasien_id" id="status_pasien_id">
            <input type="hidden" name="ageyear" id="ageyear">
            <input type="hidden" name="agemonth" id="agemonth">
            <input type="hidden" name="ageday" id="ageday">
            <input type="hidden" name="theid" id="theid">
            <input type="hidden" name="isrj" id="isrj">
            <input type="hidden" name="gender" id="gender">
            <input type="hidden" name="kal_id" id="kal_id">
            <input type="hidden" name="petugas_id" id="petugas_id">
            <input type="hidden" name="petugas" id="petugas">
            <input type="hidden" name="account_id" id="account_id">
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-md-2" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h2>RS PKU Muhammadiyah Sampangan</h2>
                    <h2>Surakarta</h2>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-md-2" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Surat Keterangan Diagnosis</h3>
            </div>
            <div class="row">
                <h4 class="text-start">Informasi Pasien</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <input type="text" class="form-control" id="no_rm" name="no_rm" value="<?= $val['no_rm']; ?>">
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $val['nama']; ?>">
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <input type="text" name="jeniskel" id="jeniskel" class="form-control" value="<?= $val['jeniskel']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <input type="text" class="form-control" id="umur" name="umur" value="<?= $val['date_of_birth']; ?> (<?= $val['umur']; ?>)">
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $val['alamat']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <input type="text" class="form-control" id="dpjp" name="dpjp" value="<?= $val['dpjp']; ?>">
                        </td>
                        <td>
                            <b>Department</b>
                            <input type="text" class="form-control" id="department" name="department" value="<?= $val['department']; ?>">
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $val['tgl_masuk']; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mb-2">
                <h2 class="text-center"><b><u>SURAT KETERANGAN DIAGNOSIS</u></b></h2>
            </div>
            <div class="row mb-1">
                <div class="col">
                    Yang bertanda tangan di bawah ini dokter RS PKU Muhammadiyah Sampangan Surakarta menerangkan bahwa:
                </div>
            </div>
            <div class="row mb-1">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <label for="nama" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $val['nama']; ?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <label for="umur" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="umur" name="umur" value="<?= $val['date_of_birth']; ?> (<?= $val['umur']; ?>)">
                </div>
            </div>
            <div class="row mb-1">
                <label for="jeniskel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <label for="jeniskel" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="jeniskel" name="jeniskel" value="<?= $val['jeniskel']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <label for="alamat" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $val['alamat']; ?>">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    Telah diperiksa di RS PKU Muhammadiyah Sampangan Surakarta pada
                </div>
            </div>
            <div class="row mb-1">
                <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal</label>
                <label for="tgl_masuk" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $val['tgl_masuk']; ?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis</label>
                <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="diagnosis" name="diagnosis" value="<?= $val['diagnosis']; ?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <label for="keterangan" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $val['keterangan']; ?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                <label for="tindakan" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="tindakan" name="tindakan" value="<?= $val['tindakan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="farmakologi" class="col-sm-2 col-form-label">Terapi</label>
                <label for="farmakologi" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="farmakologi" name="farmakologi" value="<?= $val['farmakologi']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    Demikian harap menjadikan periksa.
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Dokter yang memeriksa,</div>
                    <div class="mb-4">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '<?= $val['dpjp']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>

</html>