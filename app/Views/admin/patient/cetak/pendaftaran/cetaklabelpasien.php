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
            padding-top: 30px;
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
            text-align: center;
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

        .pno {
            text-align: center;
            margin: 0;
        }

        p {
            text-align: center;
            margin: 0;
        }

        h5 {
            font-weight: normal;
            margin: 0;
        }
    </style>
    <title>CETAK LABEL PASIEN</title>
</head>

<body>

    <div class="left-panel">
        <div class="no">
            <p class="pno"><?php echo $json['no_registration']; ?></p>
        </div>
        <h4><?php echo $json['name_of_pasien']; ?></h4>
        <h5><?php echo $json['date_of_birth']; ?></h5>
        <?php if ($json['gender'] == 1) { ?>
            <h5>Laki-laki</h5>
        <?php } else { ?>
            <h5>Perempuan</h5>
        <?php } ?>
        <p>*<?php echo $json['no_registration']; ?>*</p>
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
            size: A4;
        }
    }
</style>

<script>
    window.print();
</script>

</html>