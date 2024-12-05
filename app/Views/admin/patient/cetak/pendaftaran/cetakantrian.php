<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Antrian</title>
    <link rel="stylesheet" media='screen,print' href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="border: 1px solid black; width:250px; margin-left:0px;">
        <form action="">
            <div class="row mt-3" style="text-align:center">
                <div class="col">
                    <h5 class="fw-bolder"><u>RSUD Dr. M.YUNUS</u></h5>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-bolder"><?php echo $json['diantar_oleh']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fst-normal"><?php echo $json['visitor_address']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="align-middle mt-2"><?php echo $json['no_registration']; ?></h3>
                </div>
                <div class="col-md-6">
                    <p class="fst-normal">BPJS<br>KESEHATAN</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fst-normal">Umur : <?php echo $json['ageyear']; ?>&nbsp;Th&nbsp;<?php echo $json['agemonth']; ?>&nbsp;bl&nbsp;<?php echo $json['ageday']; ?>&nbsp;hr</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="fst-normal"><b>DALAM</b><br><?php echo $json['visit_date']; ?></p>
                </div>
                <div class="col-md-6">
                    <div class="container" style="border: 1px solid black; width:fit-content; height:70px;">
                        <h4 class="fw-bolder align-middle mt-3"><?php echo $json['urutan']; ?></h4>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <style>
        @media print {
            @page {
                margin: none;
            }
        }
    </style>
    <script type="text/javascript">
        window.print();
    </script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>