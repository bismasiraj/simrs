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
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

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

        @media print {
            .row {
                display: flex;
                flex-wrap: nowrap;
                /* Mencegah elemen stack ke bawah saat print */
            }

            .col-md-4,
            .col-md-3,
            .col-md-5 {
                flex: 1;
                max-width: none;
                /* Atur agar kolom tetap lebar sesuai proporsi */
            }

            .container,
            .row {
                width: 100%;
                max-width: 210mm;
                /* Lebar kertas A4 */
                margin: 0 auto;
            }

            /* Pastikan margin dan padding tidak membuat tampilan overflow */
            body,
            .container {
                margin: 0;
                padding: 0;
            }

            h5 {
                margin-bottom: 10px;
                /* Mengurangi jarak antar heading saat print */
            }
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
            <div class="row mb-4">
                <div class="col text-center">
                    <h4><?= $title ?></h4>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5>Simbol dan Keterangan</h5>
                    <ul>
                        <li><strong>v</strong> : Obat telah diberikan</li>
                        <li><strong>T</strong> : Pasien menolak</li>
                        <li><strong>A</strong> : Alergi</li>
                        <li><strong>K</strong> : Kondisi pasien menyebabkan ditundanya pemberian obat</li>
                        <li><strong>ESO</strong> : Reaksi efek samping obat</li>
                        <li><strong>OTT</strong> : Obat tidak tersedia</li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>Obat Isi - 7 Benar</h5>
                    <ol>
                        <li>Benar Pasien</li>
                        <li>Benar Obat</li>
                        <li>Benar Dosis</li>
                        <li>Benar Rute/Cara</li>
                        <li>Benar Indikasi</li>
                        <li>Benar Waktu</li>
                        <li>Benar Dokumentasi</li>
                    </ol>
                </div>

                <div class="col-md-5">
                    <h5>Waktu Pemberian Obat Oral</h5>
                    <ul>
                        <li><strong>1 X 1</strong> : 06-07 (Pagi), 21-22 (Malam)</li>
                        <li><strong>2 X 1</strong> : 06-07, 18-19</li>
                        <li><strong>3 X 1</strong> : 06-07, 12-13, 19-20</li>
                        <li><strong>4 X 1</strong> : 06-07, 12-13, 18-19, 22-23</li>
                        <li><strong>5 X 1</strong> : 06-07, 10-11, 15-16, 23-24</li>
                        <li><strong>6 X 1</strong> : 05-06, 09-10, 13-14, 17-18, 21-22, 01-02</li>
                    </ul>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="fw-bold">
                    <tr>
                        <td rowspan="3" class="align-middle text-center">No</td>
                        <td rowspan="3" class="align-middle text-center">Nama dan Jenis Obat</td>
                        <td rowspan="3" class="align-middle text-center">Dosis</td>
                        <td rowspan="3" class="align-middle text-center">Rute</td>
                        <td rowspan="3" class="align-middle text-center">Indikasi</td>
                        <td colspan="" id="jam-beri" class="text-center">JAM PEMBERIAN</td>
                        <td rowspan="3" class="text-center">Ket</td>
                    </tr>
                    <tr id="date-header-row">
                    </tr>
                </thead>
                <tbody id="data-tables">
                    <!-- Data akan diisi di sini melalui JavaScript -->
                </tbody>
            </table>

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
        $("#datetime-now").html(`<em>Dicetak pada Tanggal ${moment(new Date()).format("DD-MM-YYYY HH:mm")}</em>`)

        renderTables()
        data = [{
                "org_unit_code": "3372238",
                "vactination_id": "099FA664-A07A-46F3-849C-D818EC85D41A",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020004",
                "bill_id": "20240716162117745",
                "treat_date": "2024-07-19 11:00:00.000",
                "allocated_date": null,
                "brand_id": "3888",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Ambroxol Tablet",
                "dose_presc": ".00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "",
                "numer": "9",
                "iter": 1,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "30.00",
                "resep_ke": 2,
                "iter_ke": 1,
                "aturanminum2": null,
                "modified_date": "2024-07-16 16:21:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 16:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "M",
                "class_room_id": null,
                "bed_id": null,
                "rn": "1"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "B7E34E25-07E3-42EE-87FA-115A853AFC5E",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020004",
                "bill_id": "20240716162117745",
                "treat_date": "2024-07-19 11:00:00.000",
                "allocated_date": null,
                "brand_id": "3888",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Ambroxol Tablet",
                "dose_presc": ".00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "",
                "numer": "9",
                "iter": 1,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "30.00",
                "resep_ke": 2,
                "iter_ke": 2,
                "aturanminum2": null,
                "modified_date": "2024-07-16 16:21:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 17:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "T",
                "class_room_id": null,
                "bed_id": null,
                "rn": "2"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "52A66447-B814-4E0D-9F3E-3AAB0C46DD19",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020004",
                "bill_id": "20240716162117745",
                "treat_date": "2024-07-19 11:00:00.000",
                "allocated_date": null,
                "brand_id": "3888",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Ambroxol Tablet",
                "dose_presc": ".00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "",
                "numer": "9",
                "iter": 1,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "30.00",
                "resep_ke": 2,
                "iter_ke": 3,
                "aturanminum2": null,
                "modified_date": "2024-07-16 16:21:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 18:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "T",
                "class_room_id": null,
                "bed_id": null,
                "rn": "3"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "BF493765-0CB9-45ED-9B90-28D5C3E3A0FC",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020004",
                "bill_id": "20240716162117745",
                "treat_date": "2024-07-20 11:00:00.000",
                "allocated_date": null,
                "brand_id": "3888",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Ambroxol Tablet",
                "dose_presc": ".00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "",
                "numer": "9",
                "iter": 2,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "30.00",
                "resep_ke": 2,
                "iter_ke": 1,
                "aturanminum2": null,
                "modified_date": "2024-07-16 16:21:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 19:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "4"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "AA1E0121-431E-4454-9AB5-C7111FA46BAD",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020004",
                "bill_id": "20240716162117745",
                "treat_date": "2024-07-20 11:00:00.000",
                "allocated_date": null,
                "brand_id": "3888",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Ambroxol Tablet",
                "dose_presc": ".00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "",
                "numer": "9",
                "iter": 2,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "30.00",
                "resep_ke": 2,
                "iter_ke": 2,
                "aturanminum2": null,
                "modified_date": "2024-07-16 16:21:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 20:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "5"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "366CDCE2-AF80-4D2A-BEAD-56F23F7481BC",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020004",
                "bill_id": "20240716162117745",
                "treat_date": "2024-07-20 11:00:00.000",
                "allocated_date": null,
                "brand_id": "3888",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Ambroxol Tablet",
                "dose_presc": ".00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "",
                "numer": "9",
                "iter": 2,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "30.00",
                "resep_ke": 2,
                "iter_ke": 3,
                "aturanminum2": null,
                "modified_date": "2024-07-16 16:21:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 21:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "6"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "FC316C24-37B6-4ADC-BBE1-9C2F5E112076",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020003",
                "bill_id": "20240716141809608",
                "treat_date": "2024-07-18 15:00:00.000",
                "allocated_date": null,
                "brand_id": "4087",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Sanmol",
                "dose_presc": "12.00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "3 x sehari 2 Kapsul    ",
                "numer": "9",
                "iter": 1,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "500.00",
                "resep_ke": 1,
                "iter_ke": 1,
                "aturanminum2": null,
                "modified_date": "2024-07-16 14:18:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 23:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "1"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "78F936A1-0DF1-4BD0-9F9F-8E1CF2267678",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020003",
                "bill_id": "20240716141809608",
                "treat_date": "2024-07-18 15:00:00.000",
                "allocated_date": null,
                "brand_id": "4087",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Sanmol",
                "dose_presc": "12.00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "3 x sehari 2 Kapsul    ",
                "numer": "9",
                "iter": 1,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "500.00",
                "resep_ke": 1,
                "iter_ke": 2,
                "aturanminum2": null,
                "modified_date": "2024-07-16 14:18:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 16:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "2"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "B7D9FCEB-4BBD-4E51-822E-2D4A4ACF553D",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020003",
                "bill_id": "20240716141809608",
                "treat_date": "2024-07-18 15:00:00.000",
                "allocated_date": null,
                "brand_id": "4087",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Sanmol",
                "dose_presc": "12.00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "3 x sehari 2 Kapsul    ",
                "numer": "9",
                "iter": 1,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "500.00",
                "resep_ke": 1,
                "iter_ke": 3,
                "aturanminum2": null,
                "modified_date": "2024-07-16 14:18:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 17:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "3"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "91C38EC0-D7CB-45D5-873A-A480D698A111",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020003",
                "bill_id": "20240716141809608",
                "treat_date": "2024-07-19 15:00:00.000",
                "allocated_date": null,
                "brand_id": "4087",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Sanmol",
                "dose_presc": "12.00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "3 x sehari 2 Kapsul    ",
                "numer": "9",
                "iter": 2,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "500.00",
                "resep_ke": 1,
                "iter_ke": 1,
                "aturanminum2": null,
                "modified_date": "2024-07-16 14:18:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-16 18:21:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "4"
            },
            {
                "org_unit_code": "3372238",
                "vactination_id": "133BBF93-EFDF-435B-AFDC-07934108E975",
                "no_registration": "021732",
                "visit_id": "202406231817490203553",
                "trans_id": "021732202406231817490200",
                "resep_no": "RIE240716B020003",
                "bill_id": "20240716141809608",
                "treat_date": "2024-07-19 15:00:00.000",
                "allocated_date": null,
                "brand_id": "4087",
                "employee_id": "41",
                "doctor": "",
                "quantity": "1.00",
                "quantity_detail": ".00",
                "measure_id": 3,
                "description": "Sanmol",
                "dose_presc": "12.00",
                "sold_status": 7,
                "racikan": 0,
                "description2": "3 x sehari 2 Kapsul    ",
                "numer": "9",
                "iter": 2,
                "package_id": null,
                "module_id": "",
                "dose": "1.00",
                "jml_bks": 0,
                "orig_dose": "500.00",
                "resep_ke": 1,
                "iter_ke": 2,
                "aturanminum2": null,
                "modified_date": "2024-07-16 14:18:00.000",
                "modified_by": null,
                "modified_from": "B020",
                "valid_date": null,
                "valid_user": null,
                "valid_user_2": null,
                "received_date": "2024-07-17 17:22:00.000",
                "signa_1": null,
                "signa_2": null,
                "signa_3": null,
                "signa_4": null,
                "signa_5": null,
                "clinic_id_from": null,
                "tagihan": null,
                "thename": null,
                "theaddress": null,
                "serial_nb": null,
                "isrj": null,
                "theid": null,
                "status_pasien_id": null,
                "status_obat": "V",
                "class_room_id": null,
                "bed_id": null,
                "rn": "5"
            },

        ]




    })
    const renderTables = () => {
        <?php $dataJson = json_encode($data); ?>
        let dataResult = '';
        let data = <?php echo $dataJson; ?>;


        let groupedData = {};
        let uniqueDates = new Set();

        data.forEach((e) => {
            let brandKey = e.brand_id;
            let dateKey = !e?.received_date ? "" : moment(e?.received_date).format("YYYY-MM-DD");
            uniqueDates.add(dateKey);

            if (!groupedData[brandKey]) {
                groupedData[brandKey] = {};
            }

            if (!groupedData[brandKey][dateKey]) {
                groupedData[brandKey][dateKey] = {
                    nama_obat: e.description,
                    aturan_pakai: e.description2,
                    quantity: 0,
                    signa: e.signa_4,
                    status_obat: [],
                    times: [],
                };
            }

            if (e?.received_date) {
                groupedData[brandKey][dateKey].times.push(moment(e.received_date).format("HH:mm"));
                groupedData[brandKey][dateKey].status_obat.push(e.status_obat);
            }

            groupedData[brandKey][dateKey].quantity += parseFloat(e.quantity_detail) || 0;
        });

        const uniqueDatesCount = uniqueDates.size;
        const allDates = new Set();
        for (let brandKey in groupedData) {
            for (let dateKey in groupedData[brandKey]) {
                allDates.add(dateKey);
            }
        }

        const sortedDates = Array.from(allDates).sort();

        let colsResult = uniqueDatesCount * 6;
        $("#jam-beri").attr("colspan", colsResult);

        let dateHeaderRow = '';
        sortedDates?.forEach(date => {

            dateHeaderRow +=
                `<td style="text-align:center;" colspan="6">${!date?"": moment(date).format("DD-MM-YYYY")}</td>`;
        });
        $("#date-header-row").html(dateHeaderRow);

        let index = 1;
        for (let brandKey in groupedData) {
            const group = groupedData[brandKey];

            dataResult += `<tr>`;
            dataResult += `<td rowspan="2" class="align-middle text-center">${index++}</td>`;
            dataResult +=
                `<td rowspan="2" class="align-middle text-center">${group[Object.keys(group)[0]].nama_obat}</td>`;
            dataResult +=
                `<td rowspan="2" class="align-middle text-center">${group[Object.keys(group)[0]].aturan_pakai || '-'}</td>`;
            dataResult +=
                `<td rowspan="2" class="align-middle text-center">${group[Object.keys(group)[0]].signa || '-'}</td>`;
            dataResult += `<td rowspan="2" class="align-middle text-center">-</td>`;


            sortedDates.forEach(date => {
                const timesRow = group[date] ? group[date].times : [];
                const timesCount = timesRow.length;


                for (let i = 0; i < 6; i++) {
                    if (i < timesCount) {
                        dataResult += `<td class="text-center">${timesRow[i]}</td>`;
                    } else {
                        dataResult += `<td class="text-center"></td>`;
                    }
                }
            });

            dataResult += `<td rowspan="2" class="align-middle text-center"></td>`;
            dataResult += `</tr>`;

            dataResult += `<tr>`;
            sortedDates.forEach(date => {
                const statusRow = group[date] ? group[date].status_obat === "V" ? "v" : group[date]
                    .status_obat : [];

                const statusCount = statusRow.length;


                for (let i = 0; i < 6; i++) {
                    if (i < statusCount) {
                        dataResult += `<td class="text-center">${statusRow[i]=== "V" ? "v":statusRow[i]}</td>`;
                    } else {
                        dataResult += `<td class="text-center"></td>`;
                    }
                }
            });

            dataResult += `</tr>`;
        }

        if (data.length === 0) {
            dataResult = `<tr style="height: 200px;">
                        <td colspan="100">
                           <center> 
                               <h3>Data Kosong</h3>
                           </center>
                        </td>
                    </tr>`;
        }

        $("#data-tables").html(dataResult);
    };
</script>
<style>

</style>
<script type="text/javascript">
    window.print();
</script>

</html>