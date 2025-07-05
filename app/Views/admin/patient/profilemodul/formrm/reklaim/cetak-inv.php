<!-- ========================================================== -->
<div class="page-break portrait">

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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                    </div>
                    <div class="col mt-2" align="center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                            <?= @$kop['fax'] ?? "-" ?>,
                            <?= @$kop['kota'] ?? "-" ?></p>
                        <p><?= @$kop['sk'] ?? "-" ?></p>

                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                    </div>
                </div>
                <br>
                <div class="row">
                    <h4 class="text-center pt-2">INVOICE PASIEN</h4>
                </div>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div style="display: flex;">
                    <table style="width: 50%;">
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
                                Tgl Lahir
                            </th>
                            <td>
                                <span id="birthday-inv"></span>
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
                        <tr>
                            <th>
                                No.kartu
                            </th>
                            <td>
                                <span id="nobpjs-inv"></span>
                            </td>
                        </tr>

                    </table>
                    <table class="text-end" style="width: 50%;">
                        <!--kanan -->
                        <tr>
                            <th>
                                Tanggal Masuk
                            </th>
                            <td class="text-start ps-3">
                                <span id="indate-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tanggal Keluar
                            </th>
                            <td class="text-start ps-3">
                                <span id="exitdate-inv"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Dokter
                            </th>
                            <td class="text-start ps-3">
                                <span id="docter-inv-temp"></span>
                            </td>
                        </tr>

                        <tr>
                            <th>Kelas Rawat</th>
                            <td class="text-start ps-3">
                                <?= @$visit['name_of_class']; ?>
                            </td>
                            <th>Hak Kelas </th>
                            <td class="text-start ps-3">
                                <span id="hak_rawat-inv">
                                    <?= @$visit['name_of_class_plafond']; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                No.SEP
                            </th>
                            <td class="text-start ps-3">
                                <span id="no_sep-inv-temp"></span>
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
                        <tfoot>
                            <tr>
                                <td colspan="3" class="fw-bold text-end">Grand Total</td>
                                <td class="fw-bold text-end" id="total-all-pay-inv"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mb-2">

                    <div class="col"></div>
                    <div class="col-4" align="center">
                        <div>Kasir</div>

                        <div>
                            <div class="pt-2 pb-2" id="qrcode-inv"></div>
                        </div>
                        <div id="validator-ttd-bill"></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->


    </body>

    <script>
    $(document).ready(function() {

        $("#keluarga").html(`<?= $visit['diantar_oleh']; ?>`)
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
                            <td class="w-auto">${e?.casemix_id=== 13 ? e?.description :e.tarif_name_tt ?? '-'}</td>
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

        <?php $dataJson = json_encode($visit); ?>;
        let data = <?php echo $dataJson; ?>;
        <?php $dataValidJson = json_encode($valid_bill); ?>

        let valid_bill = <?php echo $dataValidJson; ?>;



        $("#no_rm-inv").html(data?.no_registration)
        $("#address-inv").html(data?.visitor_address)
        $("#birthday-inv").html(data?.tgl_lahir ? moment(data?.tgl_lahir).format("DD-MM-YYYY") : "")
        $("#nobpjs-inv").html(data?.pasien_id)
        $("#indate-inv").html(data?.visit_date)
        const rawDate = data?.exit_date || data?.exit_date_tf;

        const formattedDate = rawDate ? moment(rawDate).format('DD/MM/YYYY HH:mm') : '-';

        $("#exitdate-inv").html(formattedDate);

        $("#docter-inv-temp").html(data?.fullname)
        // $("#kelas_rawat-inv").html(data?.class_id)
        // $("#hak_rawat-inv").html(data?.fullname)
        $("#no_sep-inv-temp").html((data?.no_skpinap || data?.no_skp) ?? "-")





        // render patient 
        $("#name_patient-inv").html(data?.diantar_oleh)
        $("#type-pay-inv").html(data?.name_of_status_pasien)
        // $("#total-all-pay-inv").html(data?.phone_number)
        $("#date-pay-inv").html(
            moment(new Date(data?.exit_date || data?.visit_date)).format("DD/MM/YYYY HH:mm")
        );

        $("#validator-ttd-bill").html(valid_bill?.fullname)



        // const base64ttd_cetak_inv_pasien = valid_bill?.ttd_pasien;
        // if (base64ttd_cetak_inv_pasien) {
        //     $('#qrcode1-inv').html(
        //         `<img src="${base64ttd_cetak_inv_pasien}" alt="QR Code" width="300" style="position: absolute;top: -63px; left: -100px;width: 498px;">`
        //     );
        // } else {
        //     $('#qrcode1-inv').html(' ');
        // }


        // if (base64ttd_cetak_inv_pasien) {
        //     cropTransparentPNG(base64ttd_cetak_inv_pasien, (croppedImage) => {
        //         if (croppedImage) {
        //             $('#qrcode1-inv').html(
        //                 `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
        //             );
        //         } else {
        //             $('#qrcode1-inv').html('');
        //         }
        //     });
        // } else {
        //     $('#qrcode1-inv').html('');
        // }


        // new QRCode(document.getElementById("qrcode1-inv"), {
        //     text: `${data?.ttd_pasien || ''}`,
        //     width: 70,
        //     height: 70,
        //     colorDark: "#000000",
        //     colorLight: "#ffffff",
        //     correctLevel: QRCode.CorrectLevel.H
        // });


        const base64ttd_cetak_inv = valid_bill?.ttd_dok;
        if (base64ttd_cetak_inv) {
            cropTransparentPNG(base64ttd_cetak_inv, (croppedImage) => {
                if (croppedImage) {
                    $('#qrcode-inv').html(
                        `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                    );
                } else {
                    $('#qrcode-inv').html('');
                }
            });
        } else {
            $('#qrcode-inv').html('');
        }

        // if (base64ttd_cetak_inv) {
        //     $('#qrcode-inv').html(
        //         `<img src="${base64ttd_cetak_inv}" alt="QR Code" width="300">`);
        // } else {
        //     $('#qrcode-inv').html(' ');
        // }


        // new QRCode(document.getElementById("qrcode-inv"), {
        //     text: `${valid_bill?.validuser || ''}`,
        //     width: 70,
        //     height: 70,
        //     colorDark: "#000000",
        //     colorLight: "#ffffff",
        //     correctLevel: QRCode.CorrectLevel.H
        // });
        //window.print();

    }
    </script>




    </html>

</div>