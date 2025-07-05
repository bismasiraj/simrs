<?php
if (!empty($resep)) : ?>

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
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                            <?= @$kop['fax'] ?? "-" ?>,
                            <?= @$kop['kota'] ?? "-" ?></p>
                        <p><?= @$kop['sk'] ?? "-" ?></p>
                    </div>
                    <div class="col-auto" align="center">

                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                    </div>
                </div>
                <br>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                <div class="row">
                    <h4 class="text-center pt-2">CETAK RESEP</h4>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                            </td>
                            <td>
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                            </td>
                            <td>
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0"><?= (@$visit['gender'] == 1) ? 'Laki-laki' : 'Perempuan'; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0"><?= substr(@$visit['tgl_lahir'], 0, 10); ?></p>

                            </td>
                            <td colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['fullname'] ?></p>

                            </td>
                            <td>
                                <b>No SEP</b>
                                <p class="m-0 p-0">
                                    <?= !empty($visit['no_skpinap']) ? $visit['no_skpinap'] : (!empty($visit['no_skp']) ? $visit['no_skp'] : ""); ?>
                                </p>
                            </td>
                            <td>
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit_date']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="table-responsive">
                    <table class="table table-borderless">

                        <tbody id="render-tables-resep" class="border">
                        </tbody>
                    </table>
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




        dataRenderTablesresep();
        renderDataPatientresep();

    })

    function formatCurrency(total) {

        var components = total.toFixed(2).toString().split(".");

        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        return components.join(",");
    }


    const dataRenderTablesresep = () => {
        <?php $dataJsonTablesResep = json_encode($resep); ?>
        const dataTable = <?php echo $dataJsonTablesResep; ?>;


        const groupedByResepNo = {};

        dataTable.forEach(e => {
            const resepNo = e?.resep_no ?? 'Lainnya';
            if (!groupedByResepNo[resepNo]) {
                groupedByResepNo[resepNo] = [];
            }
            groupedByResepNo[resepNo].push(e);
        });

        let dataResultTable = "";
        let grandTotalResep = 0;

        for (let resepNo in groupedByResepNo) {
            if (groupedByResepNo.hasOwnProperty(resepNo)) {
                const groupedData = {};

                groupedByResepNo[resepNo].forEach(e => {
                    const treatment = e?.treatment ?? 'Tanpa Treatment';
                    if (!groupedData[treatment]) {
                        groupedData[treatment] = [];
                    }
                    groupedData[treatment].push(e);
                });

                dataResultTable += `
                                    <tr>
                                        <td colspan="4" class="fw-bold text-center" style="border-top: 2px solid black; border-bottom: 2px solid black; border-left: none; border-right: none;">
                                            Resep No. <br> ${resepNo}
                                        </td>
                                    </tr>`;



                for (let treatment in groupedData) {
                    if (groupedData.hasOwnProperty(treatment)) {
                        let totalSubtotalResep = 0;

                        groupedData[treatment].forEach(e => {
                            const quantity = parseFloat(e?.quantity ?? 0);
                            totalSubtotalResep += quantity;

                            dataResultTable += `
                            <tr >
                                <td class="w-auto ">R/${e?.resep_ke ?? "-"}</td>
                                <td class="w-auto ">
                                    <small> Tgl Order : ${!e?.treat_date ? "-" : e?.treat_date}</small><br>
                                    <b>${e?.description ?? "-"}</b>
                                    <br>
                                    <small>${e?.description2 ?? "-"}</small>
                                </td>
                                <td class="w-auto ">Order by : ${(e?.doctor || e?.doctor_from) ?? "-"}</td>
                                <td class="w-auto  text-center"><small class="fw-bold">${quantity}</small> UNIT</td>
                            </tr>`;
                        });

                        grandTotalResep += totalSubtotalResep;
                    }
                }
            }
        }

        $("#render-tables-resep").html(dataResultTable);
        $("#total-all-pay-resep").html(`Rp. ${formatCurrency(grandTotalResep ?? 0)}`);
    };






    const renderDataPatientresep = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>;

        // render patient 
        $("#name_patient-resep").html(data?.name_of_pasien)
        $("#type-pay-resep").html(data?.payor)
        // $("#total-all-pay-resep").html(data?.phone_number)
        $("#date-pay-resep").html(
            moment(new Date(data?.exit_date || data?.in_date)).format("DD/MM/YYYY HH:mm")
        );



    }
    </script>

    </html>

</div>
<?php endif; ?>