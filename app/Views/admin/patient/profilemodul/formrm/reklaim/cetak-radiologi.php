<?php if (!empty($radiologi_cetak)) : ?>

<?php foreach ($radiologi_cetak as $index => $group) : ?>

<body>
    <div class="container-fluid mt-5">
        <div class="page-break portrait">
            <form>
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2 text-center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p class="mb-0"><?= @$kop['contact_address'] ?>, <?= @$kop['phone']; ?>, Fax:
                            <?= @$kop['fax']; ?>, <?= @$kop['kota']; ?></p>
                        <p><?= @$kop['sk']; ?></p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>

                <div
                    style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px; margin-top:10px;">
                </div>
                <div class="row">
                    <h6 class="text-center pt-2">HASIL PEMERIKSAAN RADIOLOGI</h6>
                </div>

                <div class="table-container-split">
                    <table>
                        <!-- Kiri -->
                        <tr>
                            <td>No.RM</td>
                            <td>:</td>
                            <td><?= $visit['no_registration']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td><?= $visit['diantar_oleh']; ?></td>
                        </tr>
                        <tr>
                            <td>JK/Umur</td>
                            <td>:</td>
                            <td> <?= (@$visit['gender'] === 1 || @$visit['gender'] === '1') ? 'Laki-laki' : 'Perempuan'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td><?= $visit['visitor_address']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= substr($visit['tgl_lahir'], 0, 10); ?></td>
                        </tr>
                    </table>

                    <table>
                        <!-- Kanan -->
                        <tr>
                            <td>No.Pemeriksaan</td>
                            <td>:</td>
                            <td>
                                <div id="no_check_rad_<?=$index?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>
                                <div id="date_check_rad_<?=$index?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokter Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="doctor_send_rad_<?=$index?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Unit Pengirim</td>
                            <td>:</td>
                            <td>
                                <div id="clinic_send_rad_<?=$index?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Klinis</td>
                            <td>:</td>
                            <td>
                                <div id="diagnosa_klinis_rad_<?=$index?>"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Indikasi Medis</td>
                            <td>:</td>
                            <td>
                                <div id="indikasi_medis_rad_<?=$index?>"></div>
                            </td>
                        </tr>
                    </table>
                </div>

                <table class="table-borderless" style="width: 100%;">
                    <thead class="border" style="vertical-align: text-top;">
                        <tr>
                            <td style="width: 15%;">Pemeriksaan : </td>
                            <td>
                                <div id="pemeriksaan-val_<?=$index?>"></div>
                            </td>
                        </tr>
                    </thead>
                </table>


                <div><b>Dengan Hormat</b></div>
                <p id="dengan-hormat-val_<?=$index?>"></p>

                <div><b>Catatan/Rekomendasi</b></div>
                <p id="note-val_<?=$index?>"></p>

                <div class="row mb-2">
                    <div class="col-3" align="center">
                    </div>
                    <div class="col"></div>
                    <div class="col-4" align="center">
                        <div>Pemeriksa</div>
                        <div>
                            <div id="qrcode_radId_<?=$index?>" class="pt-2 pb-2"></div>
                        </div>
                        <div id="validator-ttd_<?=$index?>"></div>
                    </div>
                </div>


            </form>
        </div>

        <script>
        $(document).ready(function() {
            let dataTable = <?= json_encode($group) ?>;


            if (dataTable) {
                $("#no_check_rad_<?=$index?>").html(dataTable.nota_no || '');
                $("#date_check_rad_<?=$index?>").html(moment(dataTable.pickup_date).format(
                    "DD-MMM-YYYY HH:mm"));
                $("#doctor_send_rad_<?=$index?>").html(dataTable.doctor_from || '');
                $("#clinic_send_rad_<?=$index?>").html(dataTable.name_of_clinic || '');
                $("#diagnosa_klinis_rad_<?=$index?>").html(dataTable.diagnosa_desc || '');
                $("#indikasi_medis_rad_<?=$index?>").html(dataTable.indication_desc || '');
                $("#pemeriksaan-val_<?=$index?>").html(dataTable.tarif_name || '');
                $("#dengan-hormat-val_<?=$index?>").html((dataTable.result_value || '').replace(/\n/g, "<br>"));
                $("#note-val_<?=$index?>").html((dataTable.conclusion || '').replace(/\n/g, "<br>"));


                const base64_ttd_Radiologi = dataTable?.ttd_dok
                if (base64_ttd_Radiologi) {
                    $('#qrcode_radId_<?=$index?>').html(
                        `<img src="${base64_ttd_Radiologi}" alt="QR Code" width="300">`);
                    $("#validator-ttd_<?=$index?>").html(dataTable.doctor || '');
                } else {
                    $('#qrcode_radId_<?=$index?>').html('');
                }

                // new QRCode(document.getElementById("qrcode_radId_<?=$index?>"), {
                //     text: `${dataTable.doctor || ''}`,
                //     width: 70,
                //     height: 70,
                //     colorDark: "#000000",
                //     colorLight: "#ffffff",
                //     correctLevel: QRCode.CorrectLevel.H
                // });
            }

        });
        </script>

    </div>


</body>


<?php endforeach; ?>

<script>
$(document).ready(function() {
    // window.print();

})
</script>
<!-- ========================================================== -->

<?php endif; ?>