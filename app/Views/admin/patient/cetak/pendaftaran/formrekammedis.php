<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" media='screen,print' href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">


    <title>Form Rekam Medis Pendaftaran</title>
</head>

<body>
    <div class="container">
        <form>
            <h1 style="text-align: right;" class="fw-bold mt-3"><?php echo $json['no_registration']; ?></h1>
            <br>
            <h3 style="text-align: right;" class="fw-bolder">BPJS KESEHATAN</h3>
            <br>
            <div class="row mb-3" style="text-align: center;">
                <div class="col-md-3">
                    <p class="fw-bolder"><?php echo $json['name_of_pasien']; ?></p>
                </div>
                <div class="col-md-3">
                    <?php if ($json['gender'] == 1) { ?>
                        <p class="fst-normal">Laki-laki</p>
                    <?php } else { ?>
                        <p class="fst-normal">Perempuan</p>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal"> th bln hr</p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal"><?php echo $json['date_of_birth']; ?></p>
                </div>
            </div>
            <div class="row mb-5" style="text-align: center;">
                <div class="col-md-3">
                    <p class="fw-normal"><?php echo $json['contact_address']; ?></p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal">-</p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal"><?php echo $json['job_id']; ?></p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal"><?php echo $json['kode_agama']; ?></p>
                </div>
            </div>
            <div class="row mb-3" style="text-align: center;">
                <div class="col-md-4">
                    <p class="fst-normal"><?php echo $json['father']; ?></p>
                </div>
                <div class="col-md-4">
                    <p class="fst-normal"><?php echo $json['mother']; ?></p>
                </div>
                <div class="col-md-4">
                    <p class="fst-normal"><?php echo $json['registration_date']; ?></p>
                </div>
            </div>
        </form>
    </div>
    <style>
        @media print {
            @page {
                margin: 0;
            }
        }
    </style>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>