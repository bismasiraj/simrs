<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Obsteric</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <style>
        .rotate-header {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            vertical-align: middle;
        }

        table.table-bordered>thead>tr>th,
        table.table-bordered>tbody>tr>td {
            border: 1px solid #000;
        }
    </style>
    <title>Obsteric</title>

    <script type="text/javascript">
        var i = 13;

        function addRow(myTable) {

            i1 = i + 1;
            i2 = i + 2;
            i3 = i + 3;
            i4 = i + 4;
            i5 = i + 5;
            i6 = i + 6;
            i7 = i + 7;
            i8 = i + 8;
            i9 = i + 9;
            i10 = i + 10;
            i11 = i + 11;
            i12 = i + 12;

            $("#" + myTable).append($("<tr>")
                .append($("<td>").html('<input type="date" id="V_' + i + '" name="V_' + i + '" >'))
                .append($("<td>").html('<input type="text" id="V_' + i1 + '" name="V_' + i1 + '" >'))
                .append($("<td>").html('<input type="text" id="V_' + i2 + '" name="V_' + i2 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px;" id="V_' + i3 + '" name="V_' + i3 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px;" id="V_' + i4 + '" name="V_' + i4 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px;" id="V_' + i5 + '" name="V_' + i5 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px;" id="V_' + i6 + '" name="V_' + i6 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px;" id="V_' + i7 + '" name="V_' + i7 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px; id="V_' + i8 + '" name="V_' + i8 + '" >'))
                .append($("<td>").html('<input type="text" style="width: 50px; id="V_' + i9 + '" name="V_' + i9 + '" >'))
                .append($("<td>").html('<input type="text" id="V_' + i10 + '" name="V_' + i10 + '" >'))
                .append($("<td>").html('<input type="text" id="V_' + i11 + '" name="V_' + i11 + '" >'))
            )

            i += 12;


        }
    </script>


</head>

<body>

    <div class="container-fluid mt-4">
        <a href="<?= base_url('pku/halamanform2') ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i></a>
        <h4 style="text-align:center"><b>Catatan Pemeriksaan Obsteric Pertama dan seterusnya</b></h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="rotate-header text-center">Tanggal</th>
                        <th class="text-center">Tingginya Fundes Aleri</th>
                        <th class="text-center">Letaknya anak punggungnya Turunnya bagian bawah</th>
                        <th class="rotate-header text-center">Bunyi Jantung</th>
                        <th class="rotate-header text-center">Oedema</th>
                        <th class="rotate-header text-center">Urine (alb)</th>
                        <th class="rotate-header text-center">Tonsie</th>
                        <th class="rotate-header text-center">Berat Badan</th>
                        <th class="rotate-header text-center">Hamil berapa<br>minggu</th>
                        <th class="rotate-header text-center">Yang Periksa</th>
                        <th class="text-center">Hal Lain-lain</th>
                        <th class="text-center">Nasehat</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td>
                            <input type="date" name="V_01" id="V_01">
                        </td>
                        <td>
                            <input type="text" name="V_02" id="V_02">
                        </td>
                        <td>
                            <input type="text" name="V_03" id="V_03">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_04" id="V_04">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_05" id="V_05">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_06" id="V_06">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_07" id="V_07">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_08" id="V_08">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_09" id="V_09">
                        </td>
                        <td>
                            <input type="text" style="width: 50px;" name="V_10" id="V_10">
                        </td>
                        <td>
                            <input type="text" name="V_11" id="V_11">
                        </td>
                        <td>
                            <input type="text" name="V_12" id="V_12">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container text-center mt-3">
            <button class="btn btn-primary btn-add" onclick="addRow('myTable')">Tambah Baris Baru</button>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>