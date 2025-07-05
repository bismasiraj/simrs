<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="js/script.js"></script>

    <title>2.1.13 ASESMEN ULANG NYERI</title>


    <script type="text/javascript">
        var i = 10;

        function addRow(tableID) {

            i2 = i + 1;
            i3 = i + 2;
            i4 = i + 3;
            i5 = i + 4;
            i6 = i + 5;
            i7 = i + 6;
            i8 = i + 7;
            i9 = i + 8;

            $("#" + tableID).append($("<tr>")
                .append($("<td>").html('<div class="form-group"><input type="date" class="form-control" name="v_' + i + '" placeholder="Diagnosa Medis"></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i2 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i3 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i4 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i5 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i6 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i7 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i8 + '" ></div>'))
                .append($("<td>").html('<div class="form-group"><input type="text" class="form-control" name="v_' + i9 + '" ></div>'))
            )

            i += 9;


        }
    </script>


</head>

<body>

    <form>
        <div class="container-fluid">


            <br>
            <h3 style="text-align: right;"><b>RM 2.1.13</b></h3>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>Sehat-Amanah <br>Tanggungjawab-Islami</label>
                            </div>
                        </td>
                        <td>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</b></h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <h5><b>ASESMEN ULANG NYERI</b></h5>
                        </td>
                    </tr>

                </tbody>
            </table>



            <table class="w-full table table-striped table-bordered table-hover text-center mb-0" style="border: 1px solid black;" id="tableID">
                <thead>

                    <tr style="text-align: center;">
                        <td rowspan="2"><b>Tanggal/jam</b></td>
                        <td rowspan="2"><b>Skor Nyeri</b></td>
                        <td rowspan="2"><b>Tools Nyeri</b></td>
                        <td rowspan="2"><b>Skore Ramsay (sedasi)</b></td>
                        <td colspan="2"><b>TINDAKAN</b></td>
                        <td rowspan="2"><b>Rute</b></td>
                        <td rowspan="2"><b>Paraf & Nama Petugas</b></td>
                        <td rowspan="2"><b>Rencana asesmen ulang (Tgl & Jam)</b></td>
                    </tr>

                    <tr>
                        <td><b>Jam</b></td>
                        <td><b>Farmakologis/ Non Farmakologis</b></td>
                    </tr>

                </thead>
                <tbody id="tbody1">
                    <tr style="text-align: center;">
                        <td>
                            <div class="form-group">
                                <input type="date" class="form-control" required="required" name="v_01" id="v_01">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_02" id="v_02">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_03" id="v_03">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_04" id="v_04">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_05" id="v_05">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_06" id="v_06">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_07" id="v_07">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_08" id="v_08">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="v_09" id="v_09">
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <td colspan="9" align="center">
                        <button type="button" class="btn btn-primary" onclick="addRow('tbody1')">Tambah Baris</button>
                    </td>
                </tfoot>
            </table>












        </div>
    </form>



</body>

</html>