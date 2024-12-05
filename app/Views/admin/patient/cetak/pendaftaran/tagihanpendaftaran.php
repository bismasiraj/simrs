<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tagihan Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php
function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function terbilang($x)
{
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

    if ($x < 12)
        return " " . $angka[$x];
    elseif ($x < 20)
        return terbilang($x - 10) . " belas";
    elseif ($x < 100)
        return terbilang($x / 10) . " puluh" . terbilang($x % 10);
    elseif ($x < 200)
        return "seratus" . terbilang($x - 100);
    elseif ($x < 1000)
        return terbilang($x / 100) . " ratus" . terbilang($x % 100);
    elseif ($x < 2000)
        return "seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
        return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
        return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}
?>

<body>
    <div class="container" style="border: 1px solid black">
        <form action="">
            <input type="hidden" id="bill_id" name="bill_id" value="<?php echo $json[0]['bill_id']; ?>">
            <div class="row mt-3" style="text-align:center">
                <div class="col">
                    <h3><b>RSUD DR M. YUNUS</b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4><b><?= $json[0]['name_of_clinic']; ?></b></h4>
                </div>
                <div class="col-md-3">
                    <h4>No Urut : &nbsp;&nbsp;&nbsp;<b><?= $json[0]['ticket_no']; ?></b></h4>
                </div>
                <hr style="border: 2px black; border-style: dashed">
            </div>
            <div class="row">
                <div class="col">
                    <p class="fst-normal">No. CM</p>
                </div>
                <div class="col-md-3">
                    <p class="fw-bolder">: <?php echo $json[0]['no_registration']; ?></p>
                </div>
                <div class="col">
                    <p class="fst-normal">Nama</p>
                </div>
                <div class="col-md-3">
                    <p class="fw-bolder">: <?php echo $json[0]['thename']; ?></p>
                </div>
                <div class="col">
                    <p class="fst-normal">Umur</p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal">: <?php echo $json[0]['ageyear']; ?>&nbsp;Th&nbsp;<?php echo $json[0]['agemonth']; ?>&nbsp;bl&nbsp;<?php echo $json[0]['ageday']; ?>&nbsp;hr</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fst-normal">Status</p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal">: <?= $json[0]['name_of_status_pasien']; ?></p>
                </div>
                <div class="col">
                    <p class="fst-normal">Alamat</p>
                </div>
                <div class="col-md-7">
                    <p class="fst-normal">: <?php echo $json[0]['visitor_address']; ?></p>
                </div>
                <hr style="border: 2px black; border-style: dashed">
            </div>
            <div class="row">
                <div class="col-md-3">
                    <p class="fst-normal">No.</p>
                </div>
                <div class="col-md-3">
                    <p class="fst-normal">Pelayanan</p>
                </div>
                <div class="col-md-2">
                    <p class="fst-normal">Tarif</p>
                </div>
                <div class="col-md-2">
                    <p class="fst-normal">Jml</p>
                </div>
                <div class="col-md-2">
                    <p class="fst-normal">Tagihan</p>
                </div>
                <hr style="border: 2px black; border-style: dashed">
                <p class="fst-normal"><i>Nota : <?php echo $json[0]['nota_no']; ?>&nbsp;&nbsp;<?php echo $json[0]['doctor']; ?>&nbsp;&nbsp;<?php echo $json[0]['payment_date']; ?></i></p>
            </div>
            <?php $tagihan = 0.0;
            foreach ($json as $key => $value) { ?>
                <div class="row mt-1">
                    <div class="col-md-1">
                        <p class="fst-normal"><?= $key + 1; ?></p>
                    </div>
                    <div class="col-md-5">
                        <p class="fst-normal"><?= $value['treatment']; ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class="fst-normal"><?php echo "Rp " . rupiah($value['amount_paid']); ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class="fst-normal"><?= rupiah($value['quantity']); ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class="fst-normal"><?php echo "Rp " . rupiah($value['tagihan']); ?></p>
                    </div>
                    <hr style="border: 2px black; border-style: dashed">
                </div>
            <?php
                $tagihan += $value['tagihan'];
            } ?>
            <div class="row" style="text-align: left;">
                <div class="col-md-2">
                    <p class="fst-normal">Terbilang :</p>
                </div>
                <div class="col-md-6">
                    <p class="fst-normal"><?= terbilang($tagihan) . 'rupiah'; ?></p>
                </div>
                <div class="col-md-2">
                    <p class="fst-normal">Tagihan :</p>
                </div>
                <div class="col-md-2">
                    <p class="fw-bolder"><?php echo "Rp " . rupiah($tagihan); ?></p>
                </div>
            </div>
            <div class="row mt-5 mb-3" style="text-align: center;">
                <div class="col">
                    <p class="fst-normal">Pasien</p><br>
                    <p class="fst-normal"><?php echo $json[0]['thename']; ?></p>
                </div>
                <div class="col">
                    <p class="fst-normal">Bengkulu, <?php echo $json[0]['payment_date']; ?></p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>