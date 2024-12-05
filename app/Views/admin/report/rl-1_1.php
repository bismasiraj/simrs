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

    @media print {
        @page {
            margin: none;
            scale: 85;
            size: A4 landscape;
            width: auto;
        }

        body {
            width: auto;
            /* Memastikan konten mencakup seluruh lebar kertas A4 */
            height: auto;
            /* Mengatur tinggi halaman otomatis sesuai dengan konten */
            margin: 0;
            font-size: 12px;
        }

        .logo-ci4 {
            display: none;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <h4 class="text-start">RL 1.1 Data Dasar Rumah Sakit</h4>
        </div>
        <ol class="list-group list-group-numbered">
            <li class="list-group-item d-flex">
                <div class="col-4"><span>No. Kode Rumah Sakit</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['org_unit_code'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Tanggal Registrasi</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['registration_date'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Nama Rumah Sakit</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['name_of_org_unit'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Jenis Rumah Sakit</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['org_type'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Kelas Rumah Sakit</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['class_id'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Nama Direktur</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['direct_parent'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Penyelenggara</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['name_of_org_unit'] ?></span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Alamat / Lokasi:</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= $data['contact_address'] ?></span></div>
            </li>

            <ol class="list-group list-group-numbered ms-1">
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kota/Kab</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['kota'] ?> </span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kode Pos</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['postal_code'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Telepon</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['phone'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Fax</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['fax'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>e-Mail</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['email'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>No. telp bagian</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['phone'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Website</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['website'] ?></span></div>
                </li>
            </ol>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Luas Rumah Sakit</span></div>
            </li>
            <ol class="list-group list-group-numbered ms-1">
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Luas Tanah</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['luas_tanah'] ?> m2</span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Luas Bangunan</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['luas_bangunan'] ?> m2</span></div>
                </li>
            </ol>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Surat izin/penetapan</span></div>
            </li>
            <ol class="list-group list-group-numbered ms-1">
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>No. SK</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['sk'] ?> </span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Tanggal</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['sk_date'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Oleh</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['luas_bangunan'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Status SK</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Berlaku hingga</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['sk_masa'] ?></span></div>
                </li>
            </ol>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Status Penyelenggaraan Swasta</span></div>
            </li>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Akreditasi</span></div>
            </li>
            <ol class="list-group list-group-numbered ms-1">
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Pentahapan</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span> <?php
                                            switch (@$data['accreditation']) {
                                                case 0:
                                                    echo 'Belum diidentifikasi';
                                                    break;
                                                case 1:
                                                    echo '5 Pelayanan';
                                                    break;
                                                case 2:
                                                    echo '12 Pelayanan';
                                                    break;
                                                case 3:
                                                    echo '16 Pelayanan';
                                                    break;
                                                default:
                                                    echo 'Tidak diketahui';
                                                    break;
                                            }
                                            ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Status</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span> <?php
                                                switch (@$data['accredit_status']) {
                                                    case 0:
                                                        echo 'Belum diidentifikasi';
                                                        break;
                                                    case 1:
                                                        echo 'Penuh';
                                                        break;
                                                    case 2:
                                                        echo 'Bersyarat';
                                                        break;
                                                    case 3:
                                                        echo 'Gagal';
                                                        break;
                                                    case 4:
                                                        echo 'Belum';
                                                        break;
                                                    default:
                                                        echo '';
                                                        break;
                                                }
                                                ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Tanggal</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['accreditation_date'] ?></span></div>
                </li>
            </ol>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Tempat Tidur</span></div>
            </li>
            <ol class="list-group list-group-numbered ms-1">
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kls VVIP</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['tt_vvip'] ?> </span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kls VIP</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['tt_vip'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kls I</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['tt_1'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kls II</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['tt_2'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Kls III</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['tt_3'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Non Kelas</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span></span></div>
                </li>
            </ol>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Tenaga Medis</span></div>
            </li>
            <ol class="list-group list-group-numbered ms-1">
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.A</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_spa'] ?> </span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.OG</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_spog'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.PD</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_sppd'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.B</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_spb'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.Rad</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_sprad'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.RM</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_sprm'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.An</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_span'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.JP</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_spjp'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.M</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_spm'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.THT</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_sptht'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Sp.KJ</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_spkj'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Umum</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['dr_um'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Gigi</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['drg'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Dokter Gigi Sps</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['drg_sp'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Perawat</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['prwt'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Bidan</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['bdn'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Farmasi</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['far'] ?></span></div>
                </li>
                <li class="list-group-item d-flex">
                    <div class="col-4"><span>Tenaga Kes Lain</span></div>
                    <div class="col-1">:</div>
                    <div class="col"><span><?= @$data['tkes'] ?></span></div>
                </li>
            </ol>
            <li class="list-group-item d-flex">
                <div class="col-4"><span>Tenaga non Kesehatan</span></div>
                <div class="col-1">:</div>
                <div class="col"><span><?= @$data['tnonkes'] ?></span></div>
            </li>

        </ol>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
$(document).ready(function() {
    $("#datetime-now").html(`<em>Dicetak pada Tanggal ${moment(new Date()).format("DD-MM-YYYY HH:mm")}</em>`)


})
</script>

<script type="text/javascript">
window.print();
</script>

</html>