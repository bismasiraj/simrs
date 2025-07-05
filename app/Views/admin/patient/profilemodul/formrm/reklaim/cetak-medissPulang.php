<div class="page-break portrait">

    <body>
        <div class="container-fluid mt-5">
            <!-- template header -->
            <?= view("admin/patient/profilemodul/formrm/reklaim/template_header.php", ['key' => ['title' => 'Resume Medis']]) ?>

            <!-- end of template header -->
            <div class="row">
                <h4 class="text-start">Subjektif (S)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 33%;">
                            <b>Riwayat Penyakit Sekarang (Autoanamnesis)</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['anamnesis']; ?></p>
                            <b>Riwayat Penyakit Sekarang (Alloanamnesis)</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['alloanamnesis']; ?></p>
                        </td>
                        <td style="width: 33%;">
                            <b>Keluhan Utama</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['riwayat_penyakit_sekarang']; ?></p>
                            <b>Riwayat Penyakit Dahulu</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['riwayat_penyakit_dahulu']; ?></p>
                        </td>
                        <td>
                            <b>Riwayat Penyakit Keluarga</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['riwayat_penyakit_keluarga']; ?></p>
                            <b>Riwayat Obat Yang Dikonsumsi</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['riwayat_obat_dikonsumsi']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Obyektif (O)</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td colspan="4"><b>Vital Sign</b></td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Tekanan Darah</b>
                            <p class="m-0 mt-1 p-0">
                                <?= @(int)$resumeMediss['val']['tensi_atas'] != 0 ? @(int)$resumeMediss['val']['tensi_atas'] : '-'; ?>
                                /
                                <?= @(int)$resumeMediss['val']['tensi_bawah'] != 0 ? @(int)$resumeMediss['val']['tensi_bawah'] : '-'; ?>
                                mmHg</p>
                        </td>
                        <td class="p-1">
                            <b>Denyut Nadi</b>
                            <p class="m-0 mt-1 p-0">
                                <?= @(int)$resumeMediss['val']['nadi'] != 0 ? @(int)$resumeMediss['val']['nadi'] : '-'; ?>
                                x/m</p>
                        </td>
                        <td class="p-1">
                            <b>Suhu Tubuh</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0">
                                    <?= @$resumeMediss['val']['suhu'] != 0 ? @$resumeMediss['val']['suhu'] : '-'; ?> ℃
                                </p>
                            </div>
                        </td>
                        <td class="p-1">
                            <b>Respiration Rate</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0">
                                    <?= @(int)$resumeMediss['val']['respiration'] != 0 ? @(int)$resumeMediss['val']['respiration'] : '-'; ?>
                                    x/m</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>SpO2</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0">
                                    <?= @(int)$resumeMediss['val']['spo2'] != 0 ? @(int)$resumeMediss['val']['spo2'] : '-'; ?>
                                    %</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <b>Berat Badan</b>
                            <div class="input-group">
                                <p class="m-0 mt-0 p-0">
                                    <?= @$resumeMediss['val']['berat'] != 0 ? @$resumeMediss['val']['berat'] : '-'; ?>
                                    kg</p>
                            </div>
                        </td>
                        <td colspan="2">
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                            <p class="m-0 mt-0 p-0">
                                <?php if (is_null(@$resumeMediss['val']['gcs'])) {
                                ?>-<?php
                                } else {
                                    ?>(<?= @$resumeMediss['val']['gcs']; ?>) <?= @$resumeMediss['val']['gcs_display']; ?>
                            </p>
                        <?php
                                } ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <?php
                    // check jika data lokalis ada atau tidak
                    if (!empty($resumeMediss['lokalis2'])) {
                        // jika ada maka lakukan perulangan untuk menampilkan data
                        foreach ($resumeMediss['lokalis2'] as $key => $value) {
                            // jika data lokalis memiliki value score = 2 maka tampilkan
                            if ($value['value_score'] == 2) {
                                // jika key pada data adalah ganjil
                                if (($key + 1) % 2 != 0) {
                                    // jika data bukan data terakhir 
                                    if ($key + 1 != count($resumeMediss['lokalis2'])) {
                                        echo '<tr>';
                                        echo '<td class="p-1" style="width: 50%;">'
                                            . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                            '</td>';
                                    } else {
                                        echo '<tr>';
                                        echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                            . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                            '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<td class="p-1" style="width: 50%;">'
                                        . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                        '</td>';
                                    echo "<tr>";
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="" colspan="2">
                            <b>Diagnosis Masuk</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['namadiagnosa']; ?></p>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Diagnosis Pulang</b>
                            <p class="m-0 mt-0 p-0"><?= @$resumeMediss['val']['namadiagnosapulang']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="4">
                            <b>Indikasi Rawat Inap</b>
                            <p><?= @$resumeMediss['val']['masalah_medis']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="4">
                            <b>Procedure</b>
                            <ul class="list-group list-group-numbered">
                                <?php
                                if (!is_null($resumeMediss['procbedah']))
                                    foreach ($resumeMediss['procbedah'] as $key => $value) {
                                ?>
                                    <li class="list-group-item"><?= $value['treatment']; ?></li>
                                <?php
                                    } ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" colspan="2">
                            <b>Cara Pulang</b>
                            <?php $dischargeWay = ['', 'Atas Persetujuan', 'Atas Permintaan Sendiri', 'Rujuk', 'Rujuk Balik', 'Melarikan Diri', 'Meninggal Dunia'] ?>
                            <p class="m-0 mt-0 p-0"><?= @$dischargeWay[$resumeMediss['val']['discharge_way']]; ?></p>
                        </td>
                        <td class="p-1" colspan="2">
                            <?php $dischargeCon = ['', 'Sembuh/Sehat', 'Membaik', 'Belum Sembuh', 'Meninggal < 48 Jam', 'Meninggal > 48 Jam'] ?>
                            <b>Kondisi Pulang</b>
                            <p class="m-0 mt-0 p-0"><?= @$dischargeCon[$resumeMediss['val']['discharge_condition']]; ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Penunjang Medis</h4>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1 col-md-6 col-sm-12">
                            <b>Laboratorium</b>
                            <table class="table-borderless">
                                <tbody id="render-tables" class="">
                                </tbody>
                            </table>
                        </td>
                        <td class="p-1 col-md-6 col-sm-12">
                            <b>Radiologi</b>
                            <div id="note-val_rad"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Terapi Obat (Farmakoterapi)</h4>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>
                            <b>Nama Resep</b>
                        </td>
                        <td>
                            <b>Signa</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (@$resumeMediss['recipe'] as $key => $value) {
                    ?>
                        <tr>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$value['resep']; ?></p>
                            </td>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$value['signatura'] ?></p>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
            <div class="row">
                <h4 class="text-start">Take Home Prescription</h4>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>
                            <b>Nama Resep</b>

                        </td>
                        <td>
                            <b>Signature</b>

                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (@$resumeMediss['recipeDischarge'] as $key => $value) {
                    ?>
                        <tr>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$value['resep']; ?></p>
                            </td>
                            <td>
                                <p class="m-0 mt-0 p-0"><?= @$value['signatura'] ?></p>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
            <div class="row mb-3">
                <div class="col">
                    <b>Terapi Tindakan (Procedure)</b>
                    <ul class="list-group list-group-numbered">
                        <?php
                        if (!is_null($resumeMediss['procnonbedah']))
                            foreach ($resumeMediss['procnonbedah'] as $key => $value) {
                        ?>
                            <li class="list-group-item"><?= $value['treatment']; ?></li>
                        <?php
                            } ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-auto" align="center">
                    <div>Tanda Tangan Dokter</div>
                    <div class="mb-1">
                        <div id="mediss-qrcode"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="mediss-qrcode_name"></p>
                </div>
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Tanda Tangan Pasien/Keluarga</div>
                    <div class="mb-1">
                        <div id="mediss-qrcode1"></div>
                    </div>
                    <p class="p-0 m-0 py-1" id="mediss-qrcode_name1"></p>
                </div>
            </div>
            <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    </body>
</div>
<script>
    let val = <?= json_encode($resumeMediss['val']); ?>;
    let signResumePulang = <?= json_encode($resumeMediss['sign']); ?>;

    signResumePulang = JSON.parse(signResumePulang)
    // $.each(sign, function(key, value) {
    //     if (value.user_type == 1 && value.isvalid == 1) {
    //         var qrcode = new QRCode(document.getElementById("mediss-qrcode"), {
    //             text: value.sign_path,
    //             width: 150,
    //             height: 150,
    //             colorDark: "#000000",
    //             colorLight: "#ffffff",
    //             correctLevel: QRCode.CorrectLevel.H // High error correction
    //         });
    //         $("#mediss-qrcode_name").html(`(${value.fullname??value.user_id})`)
    //     } else if (value.user_type == 2 && value.isvalid == 1) {
    //         var qrcode1 = new QRCode(document.getElementById("mediss-qrcode1"), {
    //             text: value.sign_path,
    //             width: 150,
    //             height: 150,
    //             colorDark: "#000000",
    //             colorLight: "#ffffff",
    //             correctLevel: QRCode.CorrectLevel.H // High error correction
    //         });
    //         $("#mediss-qrcode_name1").html(`(${value.fullname??value.user_id})`)
    //     } else if (value.user_type == 3 && value.isvalid == 1) {
    //         var qrcode1 = new QRCode(document.getElementById("mediss-qrcode1"), {
    //             text: value.sign_path,
    //             width: 150,
    //             height: 150,
    //             colorDark: "#000000",
    //             colorLight: "#ffffff",
    //             correctLevel: QRCode.CorrectLevel.H // High error correction
    //         });
    //         $("#mediss-qrcode_name1").html(`(${value.fullname??value.user_id})`)
    //     }
    // })


    $.each(signResumePulang, function(key, value) {
        if (value.user_type == 1 && value.isvalid == 1) {
            $("#mediss-qrcode_name").html(`(<?= $visit['fullname']; ?>)`)
            $("#mediss-qrcode").html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file +
                '" width="400px">')

        } else if (value.user_type == 2 && value.isvalid == 1) {
            $("#mediss-qrcode_name1").html(`(${value.fullname??value.user_id})`)
            const base64ttd_cetak_resumePulang_pasien1 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumePulang_pasien1) {

                cropTransparentPNG(base64ttd_cetak_resumePulang_pasien1, (croppedImage) => {
                    if (croppedImage) {
                        $('#mediss-qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#mediss-qrcode1').html('');
                    }
                });
            } else {
                $('#mediss-qrcode1').html('');
            }

            // $("#mediss-qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        } else if (value.user_type == 3 && value.isvalid == 1) {

            $("#mediss-qrcode_name1").html(`(${value.fullname??value.user_id})`)

            const base64ttd_cetak_resumePulang_pasien2 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumePulang_pasien2) {
                cropTransparentPNG(base64ttd_cetak_resumePulang_pasien2, (croppedImage) => {
                    if (croppedImage) {
                        $('#mediss-qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#mediss-qrcode1').html('');
                    }
                });
            } else {
                $('#mediss-qrcode1').html('');
            }

            // $("#mediss-qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        }
    })
</script>
<script>
    (function() {
        $(document).ready(function() {
            dataRenderTablesLaborat();
            // renderDataPatientLaborat();
        })

        const dataRenderTablesLaborat = () => {
            <?php $dataJsonTables = json_encode($resumeMediss['lab']); ?>
            let dataTable = <?php echo $dataJsonTables; ?>;

            console.log(dataTable)

            const diagnosaList = [];
            const indicationList = [];
            dataTable?.data?.forEach((item) => {
                if (item.diagnosa_desc !== null && !diagnosaList.includes(item.diagnosa_desc)) {
                    diagnosaList.push(item.diagnosa_desc);
                }
                if (item.indication_desc !== null && !indicationList.includes(item.indication_desc)) {
                    indicationList.push(item.indicationList);
                }
            });

            let result;
            if (diagnosaList.length === 0) {
                result = "";
            } else if (diagnosaList.length === 1) {
                result = diagnosaList;
            } else {
                result = diagnosaList.join(" ,<br>");
            }
            let indication;
            if (diagnosaList.length === 0) {
                indication = "";
            } else if (indicationList.length === 1) {
                indication = indicationList;
            } else {
                indication = indicationList.join(" ,<br>");
            }

            $("#diagnosa_klinis_lab").html(result);
            $("#indication_desc_lab").html()
            let groupedData = {};

            dataTable?.data?.forEach(e => {
                if (e.tarif_name?.toLowerCase().includes("antigen")) {
                    $("#tindakan_medis").html(`<h6>Expertise :</h6>
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

                            const firstItem = groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[
                                    0]]
                                [Object.keys(groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[
                                    0]])[
                                    0]][0];

                            const formattedCheckDate = moment(firstItem?.tgl_periksa).format("DD/MM/YYYY HH:mm");
                            const formattedSampleDate = moment(firstItem?.tgl_hasil).format("DD/MM/YYYY HH:mm");


                            for (let kelPemeriksaan in groupedData[nolabLis][norm]) {
                                if (groupedData[nolabLis][norm].hasOwnProperty(kelPemeriksaan)) {

                                    for (let tarifName in groupedData[nolabLis][norm][kelPemeriksaan]) {
                                        if (groupedData[nolabLis][norm][kelPemeriksaan].hasOwnProperty(tarifName)) {

                                            groupedData[nolabLis][norm][kelPemeriksaan][tarifName].forEach(e => {
                                                dataResultTable += `<tr>
                                                    <td style="padding-left: 40px;">${e.parameter_name}</td>
                                                    <td>
                                                        ${(e.flag_hl?.trim() || '') === '' ? e.hasil : 
                                                            ['L', 'H', 'K', '(*)'].includes(e.flag_hl.trim()) ? `<b class="fw-bold">${e.hasil}</b>` : 
                                                            (e.flag_hl.trim().includes('K') ? `<b style="color:red;">${e.hasil}</b>` : 
                                                            e.hasil)}
                                                    </td>
                                                    <td>${!e.satuan? "-":e.satuan}</td>

                                                </tr>`;
                                            });
                                        }
                                    }
                                }
                            }

                            isFirstGroup = false;
                        }
                    }
                }

                $("#render-tables").html(dataResultTable);


                $("#noLab_rm").html(dataTable?.data[0]?.nolab_lis + '/ ' + dataTable?.data[0]?.norm)
                $("#name_patient").html(dataTable?.data[0]?.nama)
                $("#adresss_patient_lab").html(dataTable?.data[0]?.alamat)
                $("#date_check_lab").html(moment(dataTable?.data[0]?.tgl_hasil).format("DD/MM/YYYY HH:mm:ss"))
                $("#payment_method").html(dataTable?.data[0]?.cara_bayar_name)
                $("#doctor_send_lab").html(dataTable?.data[0]?.pengirim_name)
                $("#room_poli").html(dataTable?.data[0]?.ruang_name)
                $("#class_pay").html(`${dataTable?.data[0]?.kelas_name} - ${dataTable?.data[0]?.cara_bayar_name}`)
                $("#datetime-now-valid").html(
                    `${moment(dataTable?.data[0]?.tgl_hasil_selesai).format("DD/MM/YYYY HH:mm:ss")}`)





            }
        }
        $(document).ready(function() {
            $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

            dataRenderTables();
            setTimeout(() => {
                //window.print()
            }, 2000);
        })



        const dataRenderTables = () => {
            <?php $dataJsonTables = json_encode(@$resumeMediss['radiologi_cetak']); ?>
            <?php $dataJsonTreat = json_encode(@$resumeMediss['get_treat']); ?>

            let dataTable = <?php echo $dataJsonTables; ?>;
            let dataTreat = <?php echo $dataJsonTreat; ?>;
            let note_valrad = ''
            let result_valrad = ''
            let result_rad = ''


            //     // render patient -
            $("#no_rm").html(dataTable[0]?.no_registration)
            $("#name_patient_rad").html(dataTable[0]?.thename)
            $("#gender_patient_age").html(dataTable[0]?.gender === "2" ? "Perempuan" : dataTable[0]?.gender ===
                "2" ?
                "Laki - Laki" : !dataTable[0]?.gender ? "" : dataTable[0]?.gender + '/' +
                dataTable[0].ageyear + ' Th' + dataTable[0].agemonth + ' Bln' + dataTable[0].ageday + ' Hr')
            $("#adresss_patient_rad").html(dataTable[0]?.theaddress)
            $("#no_check").html(dataTable[0]?.nota_no)
            $("#date_check_rad").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
            $("#doctor_send_rad").html(dataTable[0]?.doctor_from)
            $("#diagnosa_desc_rad").html(dataTable[0]?.diagnosa_desc)
            $("#indicational_desc_rad").html(dataTable[0]?.indication_desc)



            dataTable?.forEach((item, index) => {
                // note_valrad += `<p>${index+1}. ${item?.conclusion}</p>`;
                result_rad += `<p>${index+1}. ${item?.result_value}</p>`;
                let matchedTreat = dataTreat.find(treat => treat.tarif_id === item?.tarif_id);
                note_valrad += `<b><p>${index+1}. ${item?.tarif_name} :${item?.conclusion}</p></b>`;
                // if (matchedTreat) {
                //     result_valrad += `<p>${index+1}.  ${matchedTreat.tarif_name}</p>`;
                // } else {

                //     result_valrad += `<p>${index+1}.  ${item?.tarif_id}</p>`;
                // }
            });

            $("#dengan-hormat-val_rad").html((result_rad?.toString() ?? '').replace(/\n/g, "<br>"))
            $("#pemeriksaan-val_rad").html((result_valrad?.toString() ?? '').replace(/\n/g, "<br>"))
            $("#note-val_rad").html(note_valrad ?? "")
            $("#validator-ttd-rad").html(dataTable[0]?.doctor)
        }
    })()
</script>
<script>

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