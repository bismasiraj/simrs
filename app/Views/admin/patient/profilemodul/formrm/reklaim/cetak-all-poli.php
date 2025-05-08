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

    body {
        margin: 0;
        font-size: 12px;
        width: 100%;
    }

    .page-break {
        page-break-before: always;
        margin-top: 0 !important;

        /* Menambahkan halaman baru sebelum elemen dengan kelas ini */
    }

    td {
        background-color: inherit;
        color: inherit;
        border: inherit;
        padding: inherit;
        text-align: inherit;
    }

}
</style>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">
    <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>

    <title>Cetak All </title>

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


<?php if ($type === 'SEP'): ?>
<div class="page-break">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2 align-items-center">
                            <label for="no_sep" class="col-sm-4 col-form-label">No. SEP</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['no_skp']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_sep" class="col-sm-4 col-form-label">Tgl. SEP</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$sep['json']['visit_date']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="no_kartu" class="col-sm-4 col-form-label">No. Kartu</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['kk_no']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="nama_peserta" class="col-sm-4 col-form-label">Nama Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['name_of_pasien']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$sep['json']['date_of_birth']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <?php if (@$sep['json']['gender'] == 1) { ?>
                                <span>L</span>
                                <?php } else { ?>
                                <span>P</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="poli_tujuan" class="col-sm-4 col-form-label">Poli Tujuan</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['clinic_id']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="asal_faskes" class="col-sm-4 col-form-label">Asal Faskes</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?=@$kop['display']?> - <?=@$kop['kota']?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa Awal</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['diag_awal']; ?>-<?php echo @$sep['json']['conclusion']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="catatan" class="col-sm-4 col-form-label">Catatan</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['description']; ?></span>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <p>*Saya menyetujui BPJS Kesehatan mengunakan informasi medis pasien jika diperlukan
                                <br>*SEP bukan sebagai bukti penjaminan peserta
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?=@$kop['display']?>< /b>
                        </h6>
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2">
                            <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Anak</span>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <label for="no_cm" class="col-sm-4 col-form-label">No. CM</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['json']['no_registration']; ?></span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="cob" class="col-sm-4 col-form-label">COB</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['json']['cob']; ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_rawat" class="col-sm-4 col-form-label">Jenis Rawat</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Rawat Jalan</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Kelas I</span>
                            </div>
                        </div>


                        <div class="row align-items-center mt-5">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <h6><?=@$kop['display']?>,
                                    <span><?php echo @$sep['json']['visit_date']; ?></span>
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-3">
                                <div class="text-center">
                                    <h6>Pasien/<br>Keluarga<br>Pasien</h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <h6>Petugas BPJS<br>Kesehatan</h6>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-3">
                                <hr style="border: 2px solid black;">
                            </div>
                            <div class="col-3">
                                <hr style="border: 2px solid black;">
                            </div>
                        </div>

                    </form>
                </div>
                <form action="" method="">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?=@$kop['display']?> KODE RS :
                                0701R001 KELAS RS : B </b>
                        </h6>
                        <h6 class="text-uppercase text-decoration-underline text-center"><b>rawat jalan</b></h6>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="col-5">
                                <label>Tanggal Masuk:</label>
                            </div>
                            <div class="col-12">
                                <label>Cara Keluar : 1. Sembuh 2. Rujuk <br> 3. APS 4. Meninggal 5.
                                    ..................</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Tanggal Keluar:</label>
                            <br>
                            <label>Tarif RS:</label>
                            <br>
                            <label>Jml Hari Perawatan:</label>
                            <br>
                            <label>Berat Lahir:</label>
                        </div>

                        <div class="col-3">
                            <table class="table table-bordered" style="border: solid black;">
                                <tbody>
                                    <tr style="height: 15px;">
                                        <td class="text-center">
                                            <label class="text-uppercase">urologi</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 25px;">
                                        <!-- Sesuaikan tinggi baris sesuai kebutuhan -->
                                        <td class="text-center">
                                            <label class="text-uppercase fs-2"
                                                style="font-family: 'Times New Roman', Times, serif;">
                                                <b><?php echo @$sep['json']['urutan']; ?></b>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Diagnosa Primer : </label>
                            <br>
                            <label>Dagnosa Sekunder :</label>
                            <br>
                            <label>Tindakan : </label>
                            <br>
                            <label>Special CMG : </label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <h6>Peserta</h6>
                                <br>
                                <br>
                                <div class="signature-line mt-5"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h6><?=@$kop['display']?>,............. <br>Dokter Pemeriksa</h6>
                                <br>
                                <br>
                                <div class="signature-line mt-4"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
        <style>
        /* @media print {
            @page {
                margin: 20px;
                size: auto;
            }
        } */
        </style>

        <script>
        window.print();
        </script>

    </body>

</div>
<?php elseif ($type === 'SRI'): ?>
<div class="page-break">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2 align-items-center">
                            <label for="no_sep" class="col-sm-4 col-form-label">No. Kartu</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['no_bpjs']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_sep" class="col-sm-4 col-form-label">Nama Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$skdp['json']['nama']; ?></span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$skdp['json']['date_of_birth']; ?>
                                    <?php echo @$skdp['json']['umur']; ?></span>
                            </div>
                        </div>



                        <div class="form-group row align-items-center">
                            <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['diagnosis']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="catatan" class="col-sm-4 col-form-label">Rencana Kontrol</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['tgl_kontrol_selanjutnya']; ?></span>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <p>Demikian Atas Bantuannya, diucapkan Banyak Terimakasih

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?=@$kop['display']?>< /b>
                        </h6>
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2">
                            <label for="no" class="col-sm-4 col-form-label">No</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$skdp['json']['nosep']; ?></span>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>



        <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>


        <script>
        window.print();
        </script>

    </body>

</div>
<?php elseif ($type === 'INV'): ?>
<div class="page-break">

    <!doctype html>
    <html lang="en">

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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>
                <div class="row">
                    <h4 class="text-center pt-2">INVOICE PASIEN</h4>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <tr>
                            <th>Nama</th>
                            <td colspan='3'>
                                <span id="name_patient-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>NO.RM</th>
                            <td>
                                <span id="no_rm-inv"></span>
                            </td>
                            <th>Status</th>
                            <td>
                                <span id="type-pay-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Alamat</div>
                            </th>
                            <td colspan='3'>
                                <span id="address-inv"></span>
                            </td>
                        </tr>

                    </table>
                    <table class="text-end">
                        <!--kanan -->
                        <tr>
                            <th>
                                Tgl Lahir
                            </th>
                            <td>
                                <span id="birthday-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                No.Peserta
                            </th>
                            <td>
                                <span id="nobpjs-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tanggal Masuk
                            </th>
                            <td>
                                <span id="indate-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tanggal Keluar
                            </th>
                            <td>
                                <span id="exitdate-inv"></span>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="border text-center" style="vertical-align: text-top;">
                            <tr>
                                <th class="text-center w-auto">Deskripsi</th>
                                <th class="text-center w-auto">Jumlah</th>
                                <th class="text-center w-auto">Harga/Unit</th>
                                <th class="text-center w-auto">Jumlah Harga</th>
                            </tr>
                        </thead>
                        <tbody id="render-tables-inv" class="border">
                        </tbody>
                    </table>
                </div>

                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Pasien/Keluarga</div>
                        <div id="qrcode-container">
                            <div id="qrcode-inv"></div>
                        </div>
                        <div id="datetime-now"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Kasir</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1-inv"></div>
                        </div>
                        <div id="validator-ttd"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>

    <script>
    $(document).ready(function() {

        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
        <?php $dataJsonTables2 = json_encode($treatment_bill); ?>
        let dataTable1 = <?php echo $dataJsonTables2; ?>;

        dataRenderTablesinvorat1();
        renderDataPatientinvorat1();

    })

    function formatCurrency(total) {

        var components = total.toFixed(2).toString().split(".");

        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        return components.join(",");
    }

    const dataRenderTablesinvorat1 = () => {
        <?php $dataJsonTables = json_encode($treatment_bill); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;

        let groupedData = {};

        dataTable.forEach(e => {
            if (!groupedData[e.casemix]) {
                groupedData[e.casemix] = {};
            }

            if (!groupedData[e.casemix][e.tarif_name_tt]) {
                groupedData[e.casemix][e.tarif_name_tt] = [];
            }

            groupedData[e.casemix][e.tarif_name_tt].push(e);
        });

        let dataResultTable = '';


        for (let casemix in groupedData) {
            if (groupedData.hasOwnProperty(casemix)) {
                let casemixId = casemix.replace(/[\s\/]+/g, '_');
                let totalSubtotal = 0;


                dataResultTable += `<tr>
                            <td colspan="2" class="text-start w-auto"><strong>${casemix}</strong></td>
                            <td colspan="1" class="text-end w-auto"><strong>SubTotal:</strong></td>
                            <td  class="text-end w-auto"><strong><div id="sub-inv-${casemixId}"></div></strong></td>
                        </tr>`;


                for (let tarifName in groupedData[casemix]) {
                    if (groupedData[casemix].hasOwnProperty(tarifName)) {
                        groupedData[casemix][tarifName].forEach(e => {
                            dataResultTable += `<tr>
                    <td class="w-auto">${e.tarif_name_tt ?? '-'}</td>
                    <td class="w-auto">${parseFloat(e.quantity) + ' Unit(s)' ?? 0}</td>
                    <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.sell_price ?? 0))}</td>
                    <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.subtotal ?? 0))}</td>
                </tr>`;

                            totalSubtotal += parseFloat(e.subtotal) || 0;
                        });
                    }
                }
            }
        }

        $("#render-tables-inv").html(dataResultTable);
        let grandTotal = 0;

        for (let casemix in groupedData) {
            if (groupedData.hasOwnProperty(casemix)) {
                let casemixId = casemix.replace(/[\s\/]+/g, '_');

                let totalSubtotal = 0;

                groupedData[casemix] = Object.values(groupedData[casemix]).flat();
                groupedData[casemix].forEach(e => {
                    totalSubtotal += parseFloat(e.subtotal) || 0;
                });

                $(`#sub-inv-${casemixId}`).html(`Rp. ${formatCurrency(totalSubtotal)}`);

                // Add the totalSubtotal to grandTotal
                grandTotal += totalSubtotal;
            }
        }

        $("#total-all-pay-inv").html(`Rp. ${formatCurrency(grandTotal)}`);

    };


    const renderDataPatientinvorat1 = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>;

        $("#no_rm-inv").html(data?.no_registration)
        $("#address-inv").html(data?.contact_address)
        $("#birthday-inv").html(data?.date_of_birth ? moment(data?.date_of_birth).format("DD-MM-YYYY") : "")
        $("#nobpjs-inv").html(data?.pasien_id)
        $("#indate-inv").html(data?.in_date)
        $("#exitdate-inv").html(data?.exit_date)


        // render patient 
        $("#name_patient-inv").html(data?.name_of_pasien)
        $("#type-pay-inv").html(data?.name_of_status_pasien)
        // $("#total-all-pay-inv").html(data?.phone_number)
        $("#date-pay-inv").html(
            moment(new Date(data?.exit_date || data?.in_date)).format("DD/MM/YYYY HH:mm")
        );

        new QRCode(document.getElementById("qrcode1-inv"), {
            text: `${data?.diantar_oleh || ''}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        new QRCode(document.getElementById("qrcode-inv"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

    }
    </script>




    </html>

</div>
<?php elseif ($type === 'PNJG'): ?>
<!-- ========================================================== -->
<div class="page-break">

    <!doctype html>
    <html lang="en">



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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto" align="center">

                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="row">
                    <h6 class="text-center pt-2">HASIL PEMERIKSAAN LABORATORIUM</h6>
                </div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <!-- <tr>
                            <td>No.Lab / No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="noLab_rm-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <th>Nama Pasien</th>
                            <th>:</th>
                            <th>
                                <div id="name_patient-lab"></div>
                            </th>
                        </tr>
                        <tr>
                            <td>J. Kelamin</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir - Umur</td>
                            <td>:</td>
                            <td>
                                <div id="date_age-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No.Telp.</td>
                            <td>:</td>
                            <td>
                                <div id="no_tlp-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="adresss_patient-lab"></div>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <!--kanan -->
                        <!-- <tr>
                            <td>Tgl.Priksa</td>
                            <td>:</td>
                            <td>
                                <div id="date_check-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Sampel</td>
                            <td>:</td>
                            <td>
                                <div id="date_sampel-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>
                                <div id="payment_method-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokter Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="doctor_send-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ruang/ Poliklinik</td>
                            <td>:</td>
                            <td>
                                <div id="room_poli-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Klinis</td>
                            <td>:</td>
                            <td>
                                <div id="diagnosa_klinis-lab"></div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <b class="text-start"><em>Dokter Penanggungjawab: <i id="doctor-responsible-lab"></i></em></b>
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
                    <p>H: Hasil Lebih Dari Nilai Rujukan | L: Hasil Kurang Dari Nilai Rujukan | (*): Abnormal | (K):
                        Hasil
                        Nilai Kritis</p>
                </em>

                <h6>Expertise :</h6>
                <p>Note: Rapid Antigen SARS-CoV-2
                    * Spesimen : Swab Nasofaring/ Orofaring
                    * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi
                    alat
                    * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko
                    menularkan
                    ke orang lain,
                    disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                    probabilitas pretes relatif tinggi,
                    terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi
                    COVID-19
                </p>


                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Approve & Cetak</div>
                        <div id="qrcode-container">
                            <div id="qrcode-lab"></div>
                        </div>
                        <div id="datetime-now-lab"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Diotorasi oleh:<br> Quality Validator</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1-lab"></div>
                        </div>
                        <div id="validator-ttd-lab"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->

    </body>

    <script>
    $(document).ready(function() {
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables1Laborat();
        renderDataPatient1Laborat();

    })

    const dataRenderTables1Laborat = () => {
        <?php $dataJsonTables = json_encode($lab); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;
        let groupedData = {};
        dataTable?.forEach(e => {
            if (!groupedData[e.nolab_lis]) {
                groupedData[e.nolab_lis] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm]) {
                groupedData[e.nolab_lis][e.norm] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan]) {
                groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name]) {
                groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name] = [];
            }

            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name].push(e);
        });

        let dataResultTable = '';
        let isFirstGroup = true;

        for (let nolabLis in groupedData) {
            if (groupedData.hasOwnProperty(nolabLis)) {
                for (let norm in groupedData[nolabLis]) {
                    if (groupedData[nolabLis].hasOwnProperty(norm)) {

                        const firstItem = groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]]
                            [Object.keys(groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]])[
                                0]][0];

                        const formattedCheckDate = moment(firstItem?.tgl_periksa).format("DD/MM/YYYY HH:mm");
                        const formattedSampleDate = moment(firstItem?.tgl_hasil).format("DD/MM/YYYY HH:mm");

                        if (!isFirstGroup) {
                            dataResultTable += `<tr>
                                                <td colspan="6">
                                                    <hr style="border-top: 2px solid #000;">
                                                </td>
                                            </tr>`;
                        }

                        dataResultTable += `<tr>
                                            <td colspan="6">
                                                <strong>No. Lab: ${nolabLis} / RM: ${norm}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong class="fst-italic"><u>
                                                Tgl.Priksa: ${formattedCheckDate} Tgl. Sampel :${formattedSampleDate}</u></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <hr style="border-top: 1px dashed #ddd;">
                                            </td>
                                        </tr>`;

                        for (let kelPemeriksaan in groupedData[nolabLis][norm]) {
                            if (groupedData[nolabLis][norm].hasOwnProperty(kelPemeriksaan)) {
                                dataResultTable += `<tr>
                                <td colspan="6"><strong>${kelPemeriksaan}</strong></td>
                            </tr>`;

                                for (let tarifName in groupedData[nolabLis][norm][kelPemeriksaan]) {
                                    if (groupedData[nolabLis][norm][kelPemeriksaan].hasOwnProperty(tarifName)) {
                                        dataResultTable += `<tr>
                                        <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                    </tr>`;

                                        groupedData[nolabLis][norm][kelPemeriksaan][tarifName].forEach(e => {
                                            dataResultTable += `<tr>
                                            <td style="padding-left: 40px;">${e.parameter_name}</td>
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.hasil}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.flag_hl === '(*) ' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.hasil}</td>
                                            <td>${!e.satuan ? "-" : e.satuan}</td>
                                            <td>${!e.nilai_rujukan ? "-" : e.nilai_rujukan}</td>
                                            <td>${!e.metode_periksa ? "-" : e.metode_periksa}</td>
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.flag_hl}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl === '(*)' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl}</td>
                                        </tr>`;
                                        });
                                    }
                                }
                            }
                        }

                        $("#noLab_rm-lab").html(firstItem?.nolab_lis + '/ ' + firstItem?.norm);
                        $("#name_patient-lab").html(firstItem?.nama);
                        $("#adresss_patient-lab").html(firstItem?.alamat);
                        $("#date_check-lab").html(formattedCheckDate);
                        $("#date_sampel-lab").html(formattedSampleDate);
                        $("#payment_method-lab").html(firstItem?.cara_bayar_name);
                        $("#doctor_send-lab").html(firstItem?.pengirim_name);
                        $("#room_poli-lab").html(firstItem?.ruang_name);
                        $("#doctor-responsible-lab").html(firstItem?.pengirim_name);
                        $("#validator-ttd-lab").html(firstItem?.pengirim_name);

                        isFirstGroup = false;
                    }
                }
            }

            $("#render-tables").html(dataResultTable);

            function addImageToQRCode1() {
                var qrElement = document.getElementById("qrcode");
                var qrCanvas = qrElement.querySelector('canvas');

                var img = new Image();
                img.src = '<?= base_url() ?>assets/img/logo.png';

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

            addImageToQRCode1();
        }

        new QRCode(document.getElementById("qrcode1-lab"), {
            text: `${dataTable[0]?.pengirim_name}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        new QRCode(document.getElementById("qrcode-lab"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }
    const renderDataPatient1Laborat = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>
        // render patient 
        $("#gender_patient-lab").html(data?.name_of_gender)
        $("#date_age-lab").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp-lab").html(data?.phone_number)
        $("#diagnosa_klinis-lab").html(data?.diagnosa)
    }
    </script>

    </html>

</div>

<!-- ========================================================== -->
<div class="page-break">
    <!doctype html>
    <html lang="en">

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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto" align="center">

                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>

                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="row">
                    <h6 class="text-center pt-2">HASIL PEMERIKSAAN RADIOLOGI</h6>
                </div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <tr>
                            <td>No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="no_rm"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="name_patient"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>JK/Umur</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient_age"></div>
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
                            <td style="width: 15%;">Pemeriksaan : </td>
                            <td>
                                <div id="pemeriksaan-val"></div>
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
                            <div class="pt-2 pb-2" id="qrcode-rad"></div>
                        </div>
                        <div id="validator-ttd-rad"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>



    <script>
    $(document).ready(function() {
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables1();
        renderDataPatient1();

    })


    const dataRenderTables1 = () => {
        <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>
        <?php $dataJsonTreat = json_encode(@$get_treat); ?>

        let dataTable = <?php echo $dataJsonTables; ?>;
        let dataTreat = <?php echo $dataJsonTreat; ?>;
        let note_valrad = ''
        let result_valrad = ''
        let result_rad = ''


        //     // render patient -
        $("#no_rm").html(dataTable[0]?.no_registration)
        $("#name_patient").html(dataTable[0]?.thename)
        $("#gender_patient_age").html(dataTable[0]?.gender === "2" ? "Perempuan" : dataTable[0]?.gender === "2" ?
            "Laki - Laki" : !dataTable[0]?.gender ? "" : dataTable[0]?.gender + '/' +
            dataTable[0].ageyear + ' Th' + dataTable[0].agemonth + ' Bln' + dataTable[0].ageday + ' Hr')
        $("#adresss_patient").html(dataTable[0]?.theaddress)
        $("#no_check").html(dataTable[0]?.nota_no)
        $("#date_check").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
        $("#doctor_send").html(dataTable[0]?.doctor_from)



        dataTable?.forEach((item, index) => {
            note_valrad += `<p>${index+1}. ${item?.conclusion}</p>`;
            result_rad += `<p>${index+1}. ${item?.result_value}</p>`;
            let matchedTreat = dataTreat.find(treat => treat.tarif_id === item?.tarif_id);

            if (matchedTreat) {
                result_valrad += `<p>${index+1}.  ${matchedTreat.tarif_name}</p>`;
            } else {

                result_valrad += `<p>${index+1}.  ${item?.tarif_id}</p>`;
            }
        });

        $("#dengan-hormat-val").html(result_rad)
        $("#pemeriksaan-val").html(result_valrad ?? "")
        $("#note-val").html(note_valrad ?? "")
        $("#validator-ttd-rad").html(dataTable[0]?.doctor)



        var qrcode = new QRCode(document.getElementById("qrcode-rad"), {
            text: `${dataTable[0]?.doctor}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });


    }

    const renderDataPatient1 = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>;
        // render patient 
        $("#gender_patient").html(data?.name_of_gender)
        $("#date_age").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp").html(data?.phone_number)
        $("#diagnosa_klinis").html(data?.diagnosa)
    }
    </script>


    <script type="text/javascript">
    // window.print();
    </script>

    </html>
</div>

<?php else: ?>

<div class="page-break">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2 align-items-center">
                            <label for="no_sep" class="col-sm-4 col-form-label">No. SEP</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['no_skp']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_sep" class="col-sm-4 col-form-label">Tgl. SEP</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$sep['json']['visit_date']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="no_kartu" class="col-sm-4 col-form-label">No. Kartu</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['kk_no']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="nama_peserta" class="col-sm-4 col-form-label">Nama Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['name_of_pasien']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$sep['json']['date_of_birth']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <?php if (@$sep['json']['gender'] == 1) { ?>
                                <span>L</span>
                                <?php } else { ?>
                                <span>P</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="poli_tujuan" class="col-sm-4 col-form-label">Poli Tujuan</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['clinic_id']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="asal_faskes" class="col-sm-4 col-form-label">Asal Faskes</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?=@$kop['display']?> - <?=@$kop['kota']?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa Awal</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['diag_awal']; ?>-<?php echo @$sep['json']['conclusion']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="catatan" class="col-sm-4 col-form-label">Catatan</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$sep['json']['description']; ?></span>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <p>*Saya menyetujui BPJS Kesehatan mengunakan informasi medis pasien jika diperlukan
                                <br>*SEP bukan sebagai bukti penjaminan peserta
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT ELIGIBILITAS PESERTA <br> <?=@$kop['display']?>< /b>
                        </h6>
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2">
                            <label for="peserta" class="col-sm-4 col-form-label">Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Anak</span>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <label for="no_cm" class="col-sm-4 col-form-label">No. CM</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['json']['no_registration']; ?></span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="cob" class="col-sm-4 col-form-label">COB</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$sep['json']['cob']; ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_rawat" class="col-sm-4 col-form-label">Jenis Rawat</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Rawat Jalan</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span>Kelas I</span>
                            </div>
                        </div>


                        <div class="row align-items-center mt-5">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <h6><?=@$kop['display']?>,
                                    <span><?php echo @$sep['json']['visit_date']; ?></span>
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-3">
                                <div class="text-center">
                                    <h6>Pasien/<br>Keluarga<br>Pasien</h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <h6>Petugas BPJS<br>Kesehatan</h6>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-3">
                                <hr style="border: 2px solid black;">
                            </div>
                            <div class="col-3">
                                <hr style="border: 2px solid black;">
                            </div>
                        </div>

                    </form>
                </div>
                <form action="" method="">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT BUKTI PELAYANAN <br> NAMA RS : <?=@$kop['display']?> KODE RS :
                                0701R001 KELAS RS : B </b>
                        </h6>
                        <h6 class="text-uppercase text-decoration-underline text-center"><b>rawat jalan</b></h6>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="col-5">
                                <label>Tanggal Masuk:</label>
                            </div>
                            <div class="col-12">
                                <label>Cara Keluar : 1. Sembuh 2. Rujuk <br> 3. APS 4. Meninggal 5.
                                    ..................</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Tanggal Keluar:</label>
                            <br>
                            <label>Tarif RS:</label>
                            <br>
                            <label>Jml Hari Perawatan:</label>
                            <br>
                            <label>Berat Lahir:</label>
                        </div>

                        <div class="col-3">
                            <table class="table table-bordered" style="border: solid black;">
                                <tbody>
                                    <tr style="height: 15px;">
                                        <td class="text-center">
                                            <label class="text-uppercase">urologi</label>
                                        </td>
                                    </tr>
                                    <tr style="height: 25px;">
                                        <!-- Sesuaikan tinggi baris sesuai kebutuhan -->
                                        <td class="text-center">
                                            <label class="text-uppercase fs-2"
                                                style="font-family: 'Times New Roman', Times, serif;">
                                                <b><?php echo @$sep['json']['urutan']; ?></b>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Diagnosa Primer : </label>
                            <br>
                            <label>Dagnosa Sekunder :</label>
                            <br>
                            <label>Tindakan : </label>
                            <br>
                            <label>Special CMG : </label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <h6>Peserta</h6>
                                <br>
                                <br>
                                <div class="signature-line mt-5"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h6><?=@$kop['display']?>,............. <br>Dokter Pemeriksa</h6>
                                <br>
                                <br>
                                <div class="signature-line mt-4"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
        <style>
        /* @media print {
            @page {
                margin: 20px;
                size: auto;
            }
        } */
        </style>

        <script>
        window.print();
        </script>

    </body>

</div>

<!-- ========================================================== -->
<div class="page-break portrait">

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6">
                    <div>
                        <img src="<?= base_url() ?>assets/img/logo-bpjs.jpg" alt="BPJS KESEHATAN" style="width: 260px;">
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2 align-items-center">
                            <label for="no_sep" class="col-sm-4 col-form-label">No. Kartu</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['no_bpjs']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tgl_sep" class="col-sm-4 col-form-label">Nama Peserta</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$skdp['json']['nama']; ?></span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-4">
                                <span><?php echo @$skdp['json']['date_of_birth']; ?>
                                    <?php echo @$skdp['json']['umur']; ?></span>
                            </div>
                        </div>



                        <div class="form-group row align-items-center">
                            <label for="diagnosa_awal" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['diagnosis']; ?></span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="catatan" class="col-sm-4 col-form-label">Rencana Kontrol</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7">
                                <span><?php echo @$skdp['json']['tgl_kontrol_selanjutnya']; ?></span>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <p>Demikian Atas Bantuannya, diucapkan Banyak Terimakasih

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <h6 class="text-center"><b>SURAT RENCANA KONTROL <br> <?=@$kop['display']?></b></h6>
                    </div>
                    <form action="" method="">
                        <div class="form-group row mt-2">
                            <label for="no" class="col-sm-4 col-form-label">No</label>
                            <div class="col-sm-1 d-flex align-items-center">
                                <p class="mb-0">:</p>
                            </div>
                            <div class="col-sm-7 align-items-center">
                                <span><?php echo @$skdp['json']['nosep']; ?></span>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>



        <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>


        <script>
        window.print();
        </script>

    </body>

</div>
<!-- ========================================================== -->
<div class="page-break">

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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                            <?= @$kop['fax'] ?? "-"?>,
                            <?= @$kop['kota'] ?? "-"?></p>
                        <p><?= @$kop['sk'] ?? "-"?></p>
                    </div>
                    <div class="col-auto" align="center">

                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>
                <div class="row">
                    <h4 class="text-center pt-2">INVOICE PASIEN</h4>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <tr>
                            <th>Nama</th>
                            <td colspan='3'>
                                <span id="name_patient-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>NO.RM</th>
                            <td>
                                <span id="no_rm-inv"></span>
                            </td>
                            <th>Status</th>
                            <td>
                                <span id="type-pay-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Alamat</div>
                            </th>
                            <td colspan='3'>
                                <span id="address-inv"></span>
                            </td>
                        </tr>

                    </table>
                    <table class="text-end">
                        <!--kanan -->
                        <tr>
                            <th>
                                Tgl Lahir
                            </th>
                            <td>
                                <span id="birthday-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                No.Peserta
                            </th>
                            <td>
                                <span id="nobpjs-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tanggal Masuk
                            </th>
                            <td>
                                <span id="indate-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tanggal Keluar
                            </th>
                            <td>
                                <span id="exitdate-inv"></span>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="border text-center" style="vertical-align: text-top;">
                            <tr>
                                <th class="text-center w-auto">Deskripsi</th>
                                <th class="text-center w-auto">Jumlah</th>
                                <th class="text-center w-auto">Harga/Unit</th>
                                <th class="text-center w-auto">Jumlah Harga</th>
                            </tr>
                        </thead>
                        <tbody id="render-tables-inv" class="border">
                        </tbody>
                    </table>
                </div>

                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Pasien/Keluarga</div>
                        <div id="qrcode-container">
                            <div id="qrcode-inv"></div>
                        </div>
                        <div id="datetime-now"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Kasir</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1-inv"></div>
                        </div>
                        <div id="validator-ttd"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>

    <script>
    $(document).ready(function() {

        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)
        <?php $dataJsonTables2 = json_encode($treatment_bill); ?>
        let dataTable1 = <?php echo $dataJsonTables2; ?>;

        dataRenderTablesinvorat();
        renderDataPatientinvorat();

    })

    function formatCurrency(total) {

        var components = total.toFixed(2).toString().split(".");

        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        return components.join(",");
    }

    const dataRenderTablesinvorat = () => {
        <?php $dataJsonTables = json_encode($treatment_bill); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;

        let groupedData = {};

        dataTable.forEach(e => {
            if (!groupedData[e.casemix]) {
                groupedData[e.casemix] = {};
            }

            if (!groupedData[e.casemix][e.tarif_name_tt]) {
                groupedData[e.casemix][e.tarif_name_tt] = [];
            }

            groupedData[e.casemix][e.tarif_name_tt].push(e);
        });

        let dataResultTable = '';


        for (let casemix in groupedData) {
            if (groupedData.hasOwnProperty(casemix)) {
                let casemixId = casemix.replace(/[\s\/]+/g, '_');
                let totalSubtotal = 0;


                dataResultTable += `<tr>
                                    <td colspan="2" class="text-start w-auto"><strong>${casemix}</strong></td>
                                    <td colspan="1" class="text-end w-auto"><strong>SubTotal:</strong></td>
                                    <td  class="text-end w-auto"><strong><div id="sub-inv-${casemixId}"></div></strong></td>
                                </tr>`;


                for (let tarifName in groupedData[casemix]) {
                    if (groupedData[casemix].hasOwnProperty(tarifName)) {
                        groupedData[casemix][tarifName].forEach(e => {
                            dataResultTable += `<tr>
                            <td class="w-auto">${e.tarif_name_tt ?? '-'}</td>
                            <td class="w-auto">${parseFloat(e.quantity) + ' Unit(s)' ?? 0}</td>
                            <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.sell_price ?? 0))}</td>
                            <td class="text-end w-auto">Rp. ${formatCurrency(parseFloat(e.subtotal ?? 0))}</td>
                        </tr>`;

                            totalSubtotal += parseFloat(e.subtotal) || 0;
                        });
                    }
                }
            }
        }

        $("#render-tables-inv").html(dataResultTable);
        let grandTotal = 0;

        for (let casemix in groupedData) {
            if (groupedData.hasOwnProperty(casemix)) {
                let casemixId = casemix.replace(/[\s\/]+/g, '_');

                let totalSubtotal = 0;

                groupedData[casemix] = Object.values(groupedData[casemix]).flat();
                groupedData[casemix].forEach(e => {
                    totalSubtotal += parseFloat(e.subtotal) || 0;
                });

                $(`#sub-inv-${casemixId}`).html(`Rp. ${formatCurrency(totalSubtotal)}`);

                // Add the totalSubtotal to grandTotal
                grandTotal += totalSubtotal;
            }
        }

        $("#total-all-pay-inv").html(`Rp. ${formatCurrency(grandTotal)}`);

    };
    const renderDataPatientinvorat = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>;
        $("#no_rm-inv").html(data?.no_registration)
        $("#address-inv").html(data?.contact_address)
        $("#birthday-inv").html(data?.date_of_birth ? moment(data?.date_of_birth).format("DD-MM-YYYY") : "")
        $("#nobpjs-inv").html(data?.pasien_id)
        $("#indate-inv").html(data?.in_date)
        $("#exitdate-inv").html(data?.exit_date)

        // render patient 
        $("#name_patient-inv").html(data?.name_of_pasien)
        $("#type-pay-inv").html(data?.name_of_status_pasien)
        // $("#total-all-pay-inv").html(data?.phone_number)
        $("#date-pay-inv").html(
            moment(new Date(data?.exit_date || data?.in_date)).format("DD/MM/YYYY HH:mm")
        );

        new QRCode(document.getElementById("qrcode1-inv"), {
            text: `${data?.diantar_oleh || ''}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        new QRCode(document.getElementById("qrcode-inv"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

    }
    </script>





</div>

<!-- ========================================================== -->
<div class="page-break">

    <!doctype html>
    <html lang="en">



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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto" align="center">

                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="row">
                    <h6 class="text-center pt-2">HASIL PEMERIKSAAN LABORATORIUM</h6>
                </div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <!-- <tr>
                            <td>No.Lab / No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="noLab_rm-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <th>Nama Pasien</th>
                            <th>:</th>
                            <th>
                                <div id="name_patient-lab"></div>
                            </th>
                        </tr>
                        <tr>
                            <td>J. Kelamin</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir - Umur</td>
                            <td>:</td>
                            <td>
                                <div id="date_age-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No.Telp.</td>
                            <td>:</td>
                            <td>
                                <div id="no_tlp-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="adresss_patient-lab"></div>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <!--kanan -->
                        <!-- <tr>
                            <td>Tgl.Priksa</td>
                            <td>:</td>
                            <td>
                                <div id="date_check-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Sampel</td>
                            <td>:</td>
                            <td>
                                <div id="date_sampel-lab"></div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>
                                <div id="payment_method-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokter Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="doctor_send-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ruang/ Poliklinik</td>
                            <td>:</td>
                            <td>
                                <div id="room_poli-lab"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Klinis</td>
                            <td>:</td>
                            <td>
                                <div id="diagnosa_klinis-lab"></div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <b class="text-start"><em>Dokter Penanggungjawab: <i id="doctor-responsible-lab"></i></em></b>
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
                    <p>H: Hasil Lebih Dari Nilai Rujukan | L: Hasil Kurang Dari Nilai Rujukan | (*): Abnormal | (K):
                        Hasil
                        Nilai Kritis</p>
                </em>

                <h6>Expertise :</h6>
                <p>Note: Rapid Antigen SARS-CoV-2
                    * Spesimen : Swab Nasofaring/ Orofaring
                    * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi
                    alat
                    * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko
                    menularkan
                    ke orang lain,
                    disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                    probabilitas pretes relatif tinggi,
                    terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi
                    COVID-19
                </p>


                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <div>Approve & Cetak</div>
                        <div id="qrcode-container">
                            <div id="qrcode-lab"></div>
                        </div>
                        <div id="datetime-now-lab"></div>
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Diotorasi oleh:<br> Quality Validator</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1-lab"></div>
                        </div>
                        <div id="validator-ttd-lab"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->

    </body>

    <script>
    $(document).ready(function() {
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTablesLaborat();
        renderDataPatientLaborat();

    })

    const dataRenderTablesLaborat = () => {
        <?php $dataJsonTables = json_encode($lab); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;
        let groupedData = {};
        dataTable?.forEach(e => {
            if (!groupedData[e.nolab_lis]) {
                groupedData[e.nolab_lis] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm]) {
                groupedData[e.nolab_lis][e.norm] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan]) {
                groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name]) {
                groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name] = [];
            }

            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name].push(e);
        });

        let dataResultTable = '';
        let isFirstGroup = true;

        for (let nolabLis in groupedData) {
            if (groupedData.hasOwnProperty(nolabLis)) {
                for (let norm in groupedData[nolabLis]) {
                    if (groupedData[nolabLis].hasOwnProperty(norm)) {

                        const firstItem = groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]]
                            [Object.keys(groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]])[
                                0]][0];

                        const formattedCheckDate = moment(firstItem?.tgl_periksa).format("DD/MM/YYYY HH:mm");
                        const formattedSampleDate = moment(firstItem?.tgl_hasil).format("DD/MM/YYYY HH:mm");

                        if (!isFirstGroup) {
                            dataResultTable += `<tr>
                                                <td colspan="6">
                                                    <hr style="border-top: 2px solid #000;">
                                                </td>
                                            </tr>`;
                        }

                        dataResultTable += `<tr>
                                            <td colspan="6">
                                                <strong>No. Lab: ${nolabLis} / RM: ${norm}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong class="fst-italic"><u>
                                                Tgl.Priksa: ${formattedCheckDate} Tgl. Sampel :${formattedSampleDate}</u></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <hr style="border-top: 1px dashed #ddd;">
                                            </td>
                                        </tr>`;

                        for (let kelPemeriksaan in groupedData[nolabLis][norm]) {
                            if (groupedData[nolabLis][norm].hasOwnProperty(kelPemeriksaan)) {
                                dataResultTable += `<tr>
                                <td colspan="6"><strong>${kelPemeriksaan}</strong></td>
                            </tr>`;

                                for (let tarifName in groupedData[nolabLis][norm][kelPemeriksaan]) {
                                    if (groupedData[nolabLis][norm][kelPemeriksaan].hasOwnProperty(tarifName)) {
                                        dataResultTable += `<tr>
                                        <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                    </tr>`;

                                        groupedData[nolabLis][norm][kelPemeriksaan][tarifName].forEach(e => {
                                            dataResultTable += `<tr>
                                            <td style="padding-left: 40px;">${e.parameter_name}</td>
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.hasil}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.flag_hl === '(*) ' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.hasil}</b>` :
                                                e.hasil}</td>
                                            <td>${!e.satuan ? "-" : e.satuan}</td>
                                            <td>${!e.nilai_rujukan ? "-" : e.nilai_rujukan}</td>
                                            <td>${!e.metode_periksa ? "-" : e.metode_periksa}</td>
                                            <td>${e.flag_hl === 'L ' || e.flag_hl === 'L' ? `<b style="color:blue;">${e.flag_hl}</b>` :
                                                e.flag_hl === 'H ' || e.flag_hl === 'H' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl === '(*)' || e.flag_hl === '(*)' ? `<b style="color:red;">${e.flag_hl}</b>` :
                                                e.flag_hl}</td>
                                        </tr>`;
                                        });
                                    }
                                }
                            }
                        }

                        $("#noLab_rm-lab").html(firstItem?.nolab_lis + '/ ' + firstItem?.norm);
                        $("#name_patient-lab").html(firstItem?.nama);
                        $("#adresss_patient-lab").html(firstItem?.alamat);
                        $("#date_check-lab").html(formattedCheckDate);
                        $("#date_sampel-lab").html(formattedSampleDate);
                        $("#payment_method-lab").html(firstItem?.cara_bayar_name);
                        $("#doctor_send-lab").html(firstItem?.pengirim_name);
                        $("#room_poli-lab").html(firstItem?.ruang_name);
                        $("#doctor-responsible-lab").html(firstItem?.pengirim_name);
                        $("#validator-ttd-lab").html(firstItem?.pengirim_name);

                        isFirstGroup = false;
                    }
                }
            }

            $("#render-tables").html(dataResultTable);

            function addImageToQRCode1() {
                var qrElement = document.getElementById("qrcode");
                var qrCanvas = qrElement.querySelector('canvas');

                var img = new Image();
                img.src = '<?= base_url() ?>assets/img/logo.png';

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

            addImageToQRCode1();
        }

        new QRCode(document.getElementById("qrcode1-lab"), {
            text: `${dataTable[0]?.pengirim_name}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        new QRCode(document.getElementById("qrcode-lab"), {
            text: `<?= user()->fullname; ?> | ${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }
    const renderDataPatientLaborat = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>
        // render patient 
        $("#gender_patient-lab").html(data?.name_of_gender)
        $("#date_age-lab").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp-lab").html(data?.phone_number)
        $("#diagnosa_klinis-lab").html(data?.diagnosa)
    }
    </script>

    </html>

</div>

<!-- ========================================================== -->
<div class="page-break">
    <!doctype html>
    <html lang="en">

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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <!-- <h3>Surakarta</h3> -->
                        <p><?= @$kop['contact_address'] ?></p>
                    </div>
                    <div class="col-auto" align="center">

                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>

                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="row">
                    <h6 class="text-center pt-2">HASIL PEMERIKSAAN RADIOLOGI</h6>
                </div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <tr>
                            <td>No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="no_rm"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="name_patient"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>JK/Umur</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient_age"></div>
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
                            <td style="width: 15%;">Pemeriksaan : </td>
                            <td>
                                <div id="pemeriksaan-val"></div>
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
                            <div class="pt-2 pb-2" id="qrcode-rad"></div>
                        </div>
                        <div id="validator-ttd-rad"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->

    </body>



    <script>
    $(document).ready(function() {
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables();
        renderDataPatient();

    })

    // const dataRenderTables = () => {
    //     <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>

    //     let dataTable = <?php echo $dataJsonTables; ?>;
    //     <?php $dataJson = json_encode($visit); ?>
    //     let visit = <?php echo $dataJson; ?>;

    //     //     // render patient -
    //     $("#no_rm").html(visit?.no_registration)
    //     $("#name_patient").html(visit?.thename ?? visit?.name_of_pasien)
    //     $("#gender_patient_age").html(visit?.gender === "2" ? "Perempuan" : visit?.gender === "2" ?
    //         "Laki - Laki" : !visit?.gender ? "" : visit?.gender + '/' +
    //         visit.ageyear + ' Th' + visit.agemonth + ' Bln' + visit.ageday + ' Hr')
    //     $("#adresss_patient").html(visit?.theaddress ?? visit?.visitor_address)
    //     $("#no_check").html(visit?.nota_no ?? visit?.org_unit_code)
    //     $("#date_check").html(moment(visit?.pickup_date).format("DD-MMM-YYYY HH:ss"))
    //     $("#doctor_send").html(visit?.doctor_from ?? visit?.fullname_from)
    //     $("#pemeriksaan-val").html(visit?.tarif_name)
    //     $("#dengan-hormat-val").html(visit?.result_value)
    //     $("#note-val").html(visit?.conclusion)
    //     $("#validator-ttd").html(visit?.doctor)



    //     var qrcode = new QRCode(document.getElementById("qrcode"), {
    //         text: `${dataTable[0]?.doctor}`, // Your text here
    //         width: 70,
    //         height: 70,
    //         colorDark: "#000000",
    //         colorLight: "#ffffff",
    //         correctLevel: QRCode.CorrectLevel.H // High error correction
    //     });


    // }

    const dataRenderTables = () => {
        <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>
        <?php $dataJsonTreat = json_encode(@$get_treat); ?>

        let dataTable = <?php echo $dataJsonTables; ?>;
        let dataTreat = <?php echo $dataJsonTreat; ?>;
        let note_valrad = ''
        let result_valrad = ''
        let result_rad = ''


        //     // render patient -
        $("#no_rm").html(dataTable[0]?.no_registration)
        $("#name_patient").html(dataTable[0]?.thename)
        $("#gender_patient_age").html(dataTable[0]?.gender === "2" ? "Perempuan" : dataTable[0]?.gender === "2" ?
            "Laki - Laki" : !dataTable[0]?.gender ? "" : dataTable[0]?.gender + '/' +
            dataTable[0].ageyear + ' Th' + dataTable[0].agemonth + ' Bln' + dataTable[0].ageday + ' Hr')
        $("#adresss_patient").html(dataTable[0]?.theaddress)
        $("#no_check").html(dataTable[0]?.nota_no)
        $("#date_check").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
        $("#doctor_send").html(dataTable[0]?.doctor_from)



        dataTable?.forEach((item, index) => {
            note_valrad += `<p>${index+1}. ${item?.conclusion}</p>`;
            result_rad += `<p>${index+1}. ${item?.result_value}</p>`;
            let matchedTreat = dataTreat.find(treat => treat.tarif_id === item?.tarif_id);

            if (matchedTreat) {
                result_valrad += `<p>${index+1}.  ${matchedTreat.tarif_name}</p>`;
            } else {

                result_valrad += `<p>${index+1}.  ${item?.tarif_id}</p>`;
            }
        });

        $("#dengan-hormat-val").html(result_rad)
        $("#pemeriksaan-val").html(result_valrad ?? "")
        $("#note-val").html(note_valrad ?? "")
        $("#validator-ttd-rad").html(dataTable[0]?.doctor)



        var qrcode = new QRCode(document.getElementById("qrcode-rad"), {
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
        let data = <?php echo $dataJson; ?>;
        // render patient 
        $("#gender_patient").html(data?.name_of_gender)
        $("#date_age").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp").html(data?.phone_number)
        $("#diagnosa_klinis").html(data?.diagnosa)
    }
    </script>


    <script type="text/javascript">
    // window.print();
    </script>

    </html>
</div>



<?php endif; ?>