<?php
if (!empty($lab['dataTablesLab'])) :
    
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" /> -->


    <title><?= $lab['title']; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>



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
        /* height: 29.7cm; */
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
<?php foreach ($lab['dataTablesLab'] as $index => $group) : ?>
<div class="page-break portrait">

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
                        <p><?= @$kop['contact_address'] ?>,<?= @$kop['phone'] ?>, Fax: <?= @$kop['fax'] ?>,
                            <?= @$kop['kota'] ?>
                            <br><?= @$kop['sk'] ?>
                        </p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">
                    </div>
                </div>
                <br>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="row">
                    <h5 class="text-center pt-2 fw-bold"><?= $lab['title']; ?></h5>
                </div>
                <div class="table-container-split">
                    <table>
                        <!-- kiri -->
                        <tr>
                            <td>No.Lab / No.RM</td>
                            <td>:</td>
                            <td>
                                <div id="noLab_rm_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>:</th>
                            <th>
                                <div id="name_patient_labkron_<?= $index ?>"></div>
                            </th>
                        </tr>
                        <tr>
                            <td>J. Kelamin</td>
                            <td>:</td>
                            <td>
                                <div id="gender_patient_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir - Umur</td>
                            <td>:</td>
                            <td>
                                <div id="date_age_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No.Telp.</td>
                            <td>:</td>
                            <td>
                                <div id="no_tlp_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td>
                                <div id="adresss_patient_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <!--kanan -->
                        <tr>
                            <td>Tgl.Priksa</td>
                            <td>:</td>
                            <td>
                                <div id="date_check_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>
                                <div id="payment_method_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokter Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="doctor_send_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Kelas - Cara Bayar</td>
                            <td>:</td>
                            <td>
                                <div id="class_pay_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ruang/ Poliklinik</td>
                            <td>:</td>
                            <td>
                                <div id="room_poli_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Klinis</td>
                            <td>:</td>
                            <td>
                                <div id="diagnosa_klinis_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Indikasi Medis</td>
                            <td>:</td>
                            <td>
                                <div id="indikasi_medis_labkron_<?= $index ?>"></div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row">
                    <b class="text-start"><em>Dokter Penanggungjawab: <i
                                id="doctor-responsible_labkron_<?= $index ?>"></i></em></b>
                </div>
                <table class="table-borderless">
                    <thead class="border" style="vertical-align: text-top;">
                        <tr>
                            <th style="width: 10%;">Nama pemeriksaan</th>
                            <th style="width: 5%;">Hasil</th>
                            <th style="width: 2%;">Flag</th>
                            <th style="width: 5%;">Satuan</th>
                            <th style="width: 10%;">Nilai Rujukan</th>
                            <th style="width: 15%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="render-tables_labkron_<?= $index ?>" class="border">
                    </tbody>
                </table>

                <em>Hasil berupa angka menggunakan desimal dengan separator titik
                    <p>H: Hasil Lebih Dari Nilai Rujukan | L: Hasil Kurang Dari Nilai Rujukan | (*): Abnormal | (K):
                        Hasil
                        Nilai Kritis</p>
                </em>

                <div id="tindakan_medis_labkron_<?= $index ?>"></div>



                <div class="row mb-2">
                    <div class="col-3" align="center">
                        <br>
                        <!-- <div>Approve & Cetak</div> -->
                        <!-- <div id="qrcode-container">
                        <div id="qrcode"></div>
                    </div> -->
                        <!-- <div id="datetime-now-valid"></div> -->
                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>Diotorasi oleh:<br> Quality Validator</div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode1_labkron_<?= $index ?>"></div>
                        </div>
                        <div id="validator-ttd_labkron_<?= $index ?>"></div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->

    </body>
    <script>
    $(document).ready(function() {
        dataRenderTablesLabKron_<?= $index?>();
    })

    const dataRenderTablesLabKron_<?= $index?> = () => {
        <?php $dataJsonTables = json_encode($lab['dataTablesLab'][$index]); ?>

        let dataTable = <?php echo $dataJsonTables; ?>;

        <?php $dataJson = json_encode($lab['visit']); ?>
        let data = <?php echo $dataJson; ?>;

        // render patient 
        const age = calculateAge(data?.tgl_lahir);


        $("#gender_patient_labkron_<?= $index ?>").html(data?.gender === 1 || data?.gender === "1" ? "Laki - Laki" :
            "Perempuan")
        $("#doctor-responsible_labkron_<?= $index ?>").html(data?.doctor_responsible)

        $("#date_age_labkron_<?= $index ?>").html(moment(data?.tgl_lahir).format("DD/MM/YYYY") + ' - ' + age
            ?.years + ' th')
        $("#no_tlp_labkron_<?= $index ?>").html(data?.mobile)





        const diagnosaList = [];
        dataTable.forEach((item) => {
            if (item.diagnosa_desc !== null && !diagnosaList.includes(item.diagnosa_desc)) {
                diagnosaList.push(item.diagnosa_desc);
            }
        });

        const indikasiList = [];
        dataTable.forEach((item) => {
            if (item.indication_desc !== null && !indikasiList.includes(item.indication_desc)) {
                indikasiList.push(item.indication_desc);
            }
        });



        let result;
        if (diagnosaList.length === 0) {
            result = "";
        } else if (diagnosaList.length === 1) {
            result = diagnosaList
        } else {
            result = diagnosaList.join(" ,<br>");
        }

        let resultindikasi;
        if (indikasiList.length === 0) {
            resultindikasi = "";
        } else if (indikasiList.length === 1) {
            resultindikasi = indikasiList
        } else {
            resultindikasi = indikasiList.join(" ,<br>");
        }

        $("#diagnosa_klinis_labkron_<?= $index ?>").html(result);

        $("#indikasi_medis_labkron_<?= $index ?>").html(resultindikasi);


        let groupedData = {};

        dataTable.forEach(e => {
            if (e.tarif_name?.toLowerCase().includes("antigen")) {
                $("#tindakan_medis_labkron_<?= $index ?>").html(`<h6>Expertise :</h6>
            <p>Note: Rapid Antigen SARS-CoV-2
                * Spesimen : Swab Nasofaring/ Orofaring
                * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi alat
                * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko menularkan
                ke orang lain,
                disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                probabilitas pretes relatif tinggi,
                terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi COVID-19
            </p>`);
            }
            if (!groupedData[e.kel_pemeriksaan]) {
                groupedData[e.kel_pemeriksaan] = {};
            }

            if (!groupedData[e.kel_pemeriksaan][e.tarif_name]) {
                groupedData[e.kel_pemeriksaan][e.tarif_name] = [];
            }

            groupedData[e.kel_pemeriksaan][e.tarif_name].push(e);
        });


        let dataResultTable = '';

        for (let kelPemeriksaan in groupedData) {
            if (groupedData.hasOwnProperty(kelPemeriksaan)) {
                dataResultTable += `<tr>
                                        <td colspan="6"><strong>${kelPemeriksaan}</strong></td>
                                    </tr>`;
                for (let tarifName in groupedData[kelPemeriksaan]) {
                    if (groupedData[kelPemeriksaan].hasOwnProperty(tarifName)) {
                        dataResultTable += `<tr>
                                                <td colspan="6" style="padding-left: 20px;"><strong>${tarifName}</strong></td>
                                            </tr>`;

                        groupedData[kelPemeriksaan][tarifName].forEach(e => {

                            dataResultTable += `<tr>
                                                    <td style="padding-left: 40px;">${e.parameter_name}</td>
                                                    <td>
                                                        ${(e.flag_hl?.trim() || '') === '' ? e.hasil : 
                                                            ['L', 'H', 'K', '(*)'].includes(e.flag_hl.trim()) ? `<b class="fw-bold">${e.hasil}</b>` : 
                                                            (e.flag_hl.trim().includes('K') ? `<b style="color:red;">${e.hasil}</b>` : 
                                                            e.hasil)}
                                                    </td>

                                                    <td>${(e.flag_hl?.trim() || '') === '' ? '-' : 
                                                            (e.flag_hl?.trim().includes('K') ? `<b style="color:red;">${e.flag_hl.trim()}</b>` :
                                                            ['L', 'H', 'K' , '(*)'].includes(e.flag_hl?.trim()) ? `<b class="fw-bold">${e.flag_hl.trim()}</b>` : 
                                                            e.flag_hl.trim())}
                                                    </td>
                                                    <td>${!e.satuan? "-":e.satuan}</td>
                                                    <td>${!e.nilai_rujukan? "-":e.nilai_rujukan.replace(/\n/g, '<br>')}</td>
                                                    <td>${!e.catatan? "-": e.catatan === "-" ? !e.rekomendasi ? "-" : e.rekomendasi : e.catatan }</td>

                                                </tr>`;
                        });
                    }
                }
            }
        }
        $("#render-tables_labkron_<?= $index ?>").html(dataResultTable)

        // render patient -


        $("#noLab_rm_labkron_<?= $index ?>").html(dataTable[0]?.nolab_lis + '/ ' + dataTable[0]?.norm)
        $("#name_patient_labkron_<?= $index ?>").html(dataTable[0]?.nama)
        $("#adresss_patient_labkron_<?= $index ?>").html(dataTable[0]?.alamat || data?.visitor_address)
        $("#date_check_labkron_<?= $index ?>").html(moment(dataTable[0]?.tgl_hasil).format("DD/MM/YYYY HH:mm:ss"))
        $("#payment_method_labkron_<?= $index ?>").html(dataTable[0]?.cara_bayar_name)
        $("#doctor_send_labkron_<?= $index ?>").html(dataTable[0]?.pengirim_name)
        $("#room_poli_labkron_<?= $index ?>").html(dataTable[0]?.ruang_name)
        $("#class_pay_labkron_<?= $index ?>").html(`${dataTable[0]?.kelas_name} - ${dataTable[0]?.cara_bayar_name}`)
        $("#datetime-now-valid").html(`${moment(dataTable[0]?.tgl_hasil_selesai).format("DD/MM/YYYY HH:mm:ss")}`)


        $("#validator-ttd_labkron_<?= $index ?>").html(dataTable[0]?.valid_user ?? "")

        // var qrcode = new QRCode(document.getElementById("qrcode1_labkron_<?= $index ?>"), {
        //     text: `${dataTable[0]?.valid_user ?? ""}`, // Your text here
        //     width: 70,
        //     height: 70,
        //     colorDark: "#000000",
        //     colorLight: "#ffffff",
        //     correctLevel: QRCode.CorrectLevel.H // High error correction
        // });

        const base64_ttd_labkron = dataTable[0]?.ttd_dokter_validasi
        if (base64_ttd_labkron) {
            $('#qrcode1_labkron_<?= $index ?>').html(
                `<img src="${base64_ttd_labkron}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`
            );
        } else {
            $('#qrcode1_labkron_<?= $index ?>').html('');
        }


    }




    setTimeout(() => {
        //window.print()
    }, 2000);
    </script>
    <style>
    @media print {
        @page {
            /* margin: none; */
            /* scale: 85; */
        }

        body {
            transform: scale(0.95);
            transform-origin: top left;
        }

        .container {
            width: 100%;
            /* Sesuaikan dengan lebar kertas A4 */
        }

        td {
            background-color: inherit;
            color: inherit;
            border: inherit;
            padding: inherit;
            text-align: inherit;
        }

        .d-flex button {
            display: none;
        }

    }
    </style>


</div>
<?php endforeach; ?>

</html>
<?php
endif;
?>