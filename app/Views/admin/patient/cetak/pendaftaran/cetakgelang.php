<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .rotated-text {
            transform: rotate(90deg);
            /* Mengatur rotasi teks sebanyak 90 derajat */
            transform-origin: left bottom;
            /* Mengatur titik pusat rotasi */
            font-weight: bold;
            font-size: 30px;
            text-transform: uppercase;
            margin: 0;
            padding: 0;
            left: 0;
        }

        body {
            margin: 0;
            display: flex;
            height: 100vh;
            /* Mengisi tinggi viewport sepenuhnya */
        }

        .left-panel {
            flex: 40%;
            padding-left: 30px;
            padding-top: 40px;
        }

        .right-panel {
            flex: 60%;
            margin: 0;

        }

        h4 {
            margin: 0;
        }

        .no {
            font-size: 20px;
            margin-right: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .nama {
            font-size: 25px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .tgl {
            font-size: 25px;
            font-weight: bold;
        }

        .jk {
            font-size: 25px;
            font-weight: bold;
        }

        .nob {
            margin-right: 10px;
        }

        p {
            text-align: center;
            margin: 0;
        }

        .rm {
            font-size: 16px;
            font-weight: normal;
        }
    </style>
    <title>CETAK GELANG PASIEN</title>
</head>

<body>

    <div class="left-panel">
        <div class="no">
            <span><?php echo $json['no_registration']; ?></span>
            <span class="rm">&emsp; *<?php echo $json['no_registration']; ?>*</span>
        </div>

        <h4><?php echo $json['name_of_pasien']; ?></h4>
        <h4><?php echo $json['date_of_birth']; ?></h4>

    </div>

    <div class="right-panel">
        <div class="rotated-text">
            rsmy
        </div>
    </div>

</body>

<style>
    @media print {
        @page {
            margin: 30px;
            size: auto;
        }
    }
</style>

<script>
    window.print();
</script>

</html>