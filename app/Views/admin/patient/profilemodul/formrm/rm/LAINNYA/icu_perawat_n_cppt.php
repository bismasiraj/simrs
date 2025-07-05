<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">


    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets\libs\flatpickr\flatpickr.min.css">
    <script src="<?= base_url() ?>assets\libs\flatpickr\flatpickr.js"></script>
    <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        /* @page {
        size: A4;
    } */

        body {
            /* width: 29.7cm; */
            /* height: 21cm; */
            margin: 0;
            font-size: 12px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .3rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .dot1 {
            height: 10px;
            width: 10px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot2 {
            height: 15px;
            width: 15px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot3 {
            height: 20px;
            width: 20px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot4 {
            height: 25px;
            width: 25px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot5 {
            height: 30px;
            width: 30px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot6 {
            height: 35px;
            width: 35px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot7 {
            height: 40px;
            width: 40px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }

        .dot8 {
            height: 45px;
            width: 45px;
            background-color: #0c0e10;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <?php
    if (!empty($data)) {
        $dataNumerik = array_values($data);
    ?>
        <?php foreach ($dataNumerik as $index => $item): ?>
            <?php
            // echo json_encode($item['data_vt'], JSON_PRETTY_PRINT);

            $filteredData = array_filter($item['data_odd'], function ($item) {
                return isset($item['signa_4']) && (strpos(strtolower($item['signa_4']), 'p.o') !== false || strpos(strtolower($item['signa_4']), 'po') !== false);
            });
            $lenghtodd = count($filteredData);
            $filteredDataPaternal = array_filter($item['data_odd'], function ($item) {
                return isset($item['signa_4']) && (strpos(strtolower($item['signa_4']), 'i.v') !== false || strpos(strtolower($item['signa_4']), 'iv') !== false);
            });
            $lenghtoddPaternal = count($filteredDataPaternal);

            $mergedDataCount = [];

            $filteredDataCairan = array_filter($item['data_cairan'] ?? [], function ($cairan) use (&$mergedDataCount) {
                if (!isset($cairan['fluid_type']) || strpos($cairan['fluid_type'], 'G0230302') === false) {
                    return false;
                }

                $key = strtolower(trim($cairan['iv_line'])) . '|' . strtolower(trim($cairan['iv_description'] ?? ''));

                if (!isset($mergedDataCount[$key])) {
                    $mergedDataCount[$key] = $cairan;
                    $mergedDataCount[$key]['fluid_amount'] = (int) $cairan['fluid_amount'];
                } else {
                    $mergedDataCount[$key]['fluid_amount'] += (int) $cairan['fluid_amount'];
                }

                return true;
            });

            $lenghtcairanIn = count($mergedDataCount);

            $filteredDataCairanE = array_filter($item['data_cairan'], function ($item) {
                return isset($item['fluid_type']) && strpos($item['fluid_type'], 'G0230309') !== false;
            });
            $lenghtcairanInE = count($filteredDataCairanE);

            $rawatke = ($index == 0) ? 1 : 0;
            // $rawatkeResult = $rawatke + 1;

            function hitungHariKe($tanggal_awal, $tanggal_pemeriksaan)
            {
                $start = strtotime(date('Y-m-d', strtotime($tanggal_awal)));
                $current = strtotime(date('Y-m-d', strtotime($tanggal_pemeriksaan)));

                $selisih_hari = floor(($current - $start) / (60 * 60 * 24)) + 1;
                return $selisih_hari;
            }

            $tanggal_awal = $visit['visit_date'];
            $tanggal_pemeriksaan = $item['data_vt'][0]['examination_date'];
            $rawatkeResult = hitungHariKe($tanggal_awal, $tanggal_pemeriksaan);

            $filteredDataShiftVtPagi = array_filter($item['data_vt'], function ($item) {
                $hour = date('H', strtotime($item['examination_date']));
                return ($hour >= 6 && $hour < 14);
            });

            $modifiedDataVtPagi = array_unique(array_map(function ($data) {
                return $data['modified_by'];
            }, $filteredDataShiftVtPagi));

            $filteredDataShiftVtSiang = array_filter($item['data_vt'], function ($item) {
                $hour = date('H', strtotime($item['examination_date']));
                return ($hour >= 15 && $hour < 20);
            });

            $modifiedDataVtSiang = array_unique(array_map(function ($data) {
                return $data['modified_by'];
            }, $filteredDataShiftVtSiang));

            $filteredDataShiftVtMalam = array_filter($item['data_vt'], function ($item) {
                $hour = date('H', strtotime($item['examination_date']));
                return ($hour >= 21 && $hour < 5);
            });

            $modifiedDataVtMalam = array_unique(array_map(function ($data) {
                return $data['modified_by'];
            }, $filteredDataShiftVtMalam));



            // $filteredDataShiftVtSiang = array_filter($item['data_implementasi'], function($item) {
            //     $hour = date('H', strtotime($item['examination_date']));
            //     return ($hour >= 15 && $hour < 20); 
            // });



            // if (!empty($filteredDataShiftImplemntasiSiang)) {
            //     foreach ($filteredDataShiftImplemntasiSiang as $row) {
            //         echo date('H:i', strtotime($row['treat_date'])) . " - " . $row['treatment'] . "<br>";
            //     }
            // } else {
            //     echo " "; 
            // }



            ?>

            <div class="container-fluid">
                <table class="table table-bordered" border="1" style="border-color:#000000">
                    <tbody>
                        <tr>
                            <td rowspan="1" colspan="11" class="cell"
                                style="/* border-bottom: 0.07rem solid #000000; */width: 17.580rem;/* height: 5.895rem; */border-top: 0.07rem solid #000000;border-left: 0.07rem solid #000000;vertical-align: top;border-right: 0.07rem solid #000000;">
                                <div class="flex-container"
                                    style="display: flex; align-items: center; justify-content: flex-start; width: 100%; height: 100%; padding-left: 1rem;">

                                    <div class="group" style="width: 5.79rem;height: 2.68rem;">
                                        <img src="<?= base_url('assets/img/logo.png') ?>"
                                            style="width: 3.82rem;height: 3.7rem;display: block;">
                                    </div>

                                    <div style="padding-left: 1rem;">
                                        <h3
                                            style="margin: 0;/* font-family: 'Times New Roman', serif; */font-weight: 700;/* font-size: 0.65rem; */">
                                            <?= @$kop['name_of_org_unit'] ?>
                                        </h3>
                                        <p style=" margin: 0; font-size: 0.65rem;">
                                            <?= @$kop['contact_address'] ?>, <?= @$kop['phone'] ?>, Fax: <?= @$kop['fax'] ?>,
                                            <?= @$kop['kota'] ?>
                                            <br>
                                            <?= @$kop['sk'] ?>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td colspan="6" rowspan="1">
                                <div class="d-flex flex-column">
                                    <!-- HARI / TANGGAL -->
                                    <div class="d-flex mb-2">
                                        <span class="fw-bold" style="width: 150px;">HARI / TANGGAL</span>
                                        <span>:
                                            <?= $item['data_vt'] ? date('Y-m-d', strtotime($item['data_vt'][0]['examination_date'])) : "" ?></span>
                                    </div>

                                    <!-- TANGGAL MRS -->
                                    <div class="d-flex mb-2">
                                        <span class="fw-bold" style="width: 150px;">TANGGAL MRS</span>
                                        <span>: <?= @$visit['visit_date'] ?></span>
                                    </div>

                                    <!-- HARI RAWAT KE -->
                                    <div class="d-flex mb-2">
                                        <span class="fw-bold" style="width: 150px;">HARI RAWAT KE</span>
                                        <span>: <?= $rawatkeResult ?></span>
                                    </div>

                                    <!-- BB/TB -->
                                    <div class="d-flex mb-2">
                                        <span class="fw-bold" style="width: 150px;">BB/TB</span>
                                        <span>:
                                            <?= $item['data_vt'] ? $item['data_vt'][0]['weight'] . ' / ' . $item['data_vt'][0]['height'] : "" ?></span>
                                    </div>

                                    <!-- GOL. DARAH / RH -->
                                    <div class="d-flex">
                                        <span class="fw-bold" style="width: 150px;">GOL. DARAH / RH</span>
                                        <span>: <?= $pasien['jenis_gol_darah'] ?></span>
                                    </div>
                                </div>
                            </td>

                            <td colspan="18" rowspan="7">
                                <!-- DOKTER DPJP -->
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">DOKTER DPJP</span>
                                    <span>: <?= @@$visit['fullname'] ?></span>
                                </div>

                                <!-- DOKTER ANASTESI -->
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">DOKTER ANASTESI</span>
                                    <span>:
                                        <?php
                                        $nameDocAnes = [];
                                        foreach ($doc_anes as $docAnes) {
                                            if (!in_array($docAnes['doctor'], $nameDocAnes)) {
                                                $nameDocAnes[] = $docAnes['doctor'];
                                            }
                                        }
                                        echo implode(', ', $nameDocAnes);
                                        ?>
                                    </span>
                                </div>

                                <!-- RABERAN -->
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">RABERAN</span>
                                    <span>:</span>
                                </div>

                                <!-- DOKTER KONSULAN -->
                                <?php if (!empty($doc_konsulan)): ?>
                                    <?php foreach ($doc_konsulan as $keykonsulan => $valuekonsulan): ?>
                                        <div class="mb-3 d-flex">
                                            <span class="fw-bold" style="width: 200px;"><?= $keykonsulan + 1; ?>.</span>
                                            <span><?= htmlspecialchars($valuekonsulan['doctor']); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="mb-3 d-flex">
                                        <span class="fw-bold" style="width: 200px;"></span>
                                        <span></span>
                                    </div>
                                <?php endif; ?>

                                <!-- PERAWAT PENANGGUNG JAWAB -->
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">PERAWAT PENANGGUNG JAWAB</span>
                                </div>
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">1. PERAWAT PAGI</span>
                                    <span>: <?php foreach ($modifiedDataVtPagi as $modified) {
                                                echo $modified . "<br>";
                                            } ?></span>
                                </div>
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">2. PERAWAT SIANG</span>
                                    <span>: <?php foreach ($modifiedDataVtSiang as $modified) {
                                                echo $modified . "<br>";
                                            } ?></span>
                                </div>
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 200px;">3. PERAWAT MALAM</span>
                                    <span>: <?php foreach ($modifiedDataVtMalam as $modified) {
                                                echo $modified . "<br>";
                                            } ?></span>
                                </div>
                            </td>


                            <td colspan="21" rowspan="1">
                                <!-- DIAGNOSA MEDIS -->
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 150px;">DIAGNOSA MEDIS</span>
                                    <span>
                                        : <?php
                                            $uniqueDiagnosaNames = array_unique(array_column($diag, 'diagnosa_name'));
                                            $diagnosaList = implode(', ', $uniqueDiagnosaNames);
                                            echo $diagnosaList;
                                            ?>
                                    </span>
                                </div>

                                <!-- TIPE OPERASI -->
                                <div class="mb-3 d-flex">
                                    <span class="fw-bold" style="width: 150px;">TIPE OPERASI</span>
                                    <span>
                                        : <?php
                                            $tarif_ids = [];
                                            foreach ($oprs as $itemOprs) {
                                                if (!in_array($itemOprs['tarif_id'], $tarif_ids)) {
                                                    $tarif_ids[] = $itemOprs['tarif_id'];
                                                }
                                            }
                                            echo implode(', ', $tarif_ids);
                                            ?>
                                    </span>
                                </div>

                                <!-- POST OP HARI KE -->
                                <div class="d-flex">
                                    <span class="fw-bold" style="width: 150px;">POST OP HARI KE</span>
                                    <span>: <?= $oprs ? count($oprs) : ""; ?></span>
                                </div>
                            </td>



                            <td colspan="21" rowspan="1">
                                <div class="text-center mb-2">
                                    <p class="fw-bold">IDENTITAS PASIEN</p>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold" style="flex: 1;">NAMA/UMUR</span>
                                        <span style="flex: 2;">: <?= @$visit['diantar_oleh']; ?> /
                                            <?= @$visit['ageyear']; ?></span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold" style="flex: 1;">NO RM</span>
                                        <span style="flex: 2;">: <?= @$visit['no_registration']; ?></span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold" style="flex: 1;">JENIS KELAMIN</span>
                                        <span style="flex: 2;">
                                            : <?php
                                                if (@$visit['gender'] == 1) {
                                                    echo "Laki-Laki";
                                                } elseif (@$visit['gender'] == 2) {
                                                    echo "Perempuan";
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold" style="flex: 1;">NO BED</span>
                                        <span style="flex: 2;">: <?= @$visit['class_room']; ?></span>
                                    </div>
                                </div>
                            </td>

                            <td colspan="1" rowspan="7">
                                <p class="">
                                    <span class="d-block text-center">
                                        GAMBAR EKG
                                    </span>
                                    <span class="d-block">
                                        NSR – Normal Sinus Rhythm
                                    </span>
                                    <span class="d-block">
                                        AF – Atrial Fibrilation
                                    </span>
                                    <span class="d-block">
                                        VF – Ventricular Fibrilation
                                    </span>
                                    <span class="d-block">
                                        SVES – Supra Ventricular Extrasyatcle
                                    </span>
                                    <span class="d-block">
                                        VES – Ventricular Extrasyatcle
                                    </span>
                                    <span class="d-block">
                                        1 HB – First Degree Heart Block
                                    </span>
                                    <span class="d-block">
                                        2 HB – Second Degree Heart Block
                                    </span>
                                    <span class="d-block">
                                        3 HB – Third Degree Heart Block
                                    </span>
                                    <span class="d-block">
                                        PAT – Paroxysmal Atrial Tachycardia
                                    </span>
                                    <span class="d-block">
                                        JR – Junctional Rhythm – Nodal Rhythm
                                    </span>
                                    <span class="d-block">
                                        VT – Ventricular Tachycardia
                                    </span>
                                    <span class="d-block">
                                        ST – Sinus Tachycardia
                                    </span>
                                    <span class="d-block">
                                        SB – Sinus Bradycardia
                                    </span>
                                    <span class="d-block">
                                        CAP – Captured
                                    </span>
                                </p>
                            </td>

                        </tr>
                        <!-- ======= judul header ==== -->
                        <tr>
                            <?php
                            $filteredToolsVena = array_filter($tools, function ($tool) {
                                return $tool['tool_id'] === 'GEN002501';
                            });
                            $toolVena = reset($filteredToolsVena);
                            $filteredToolsNgt = array_filter($tools, function ($tool) {
                                return $tool['tool_id'] === 'GEN002502';
                            });
                            $toolNgt = reset($filteredToolsNgt);

                            $filteredToolsUrin = array_filter($tools, function ($tool) {
                                return $tool['tool_id'] === 'GEN002503';
                            });
                            $toolUrin = reset($filteredToolsUrin);
                            $filteredToolsEtt = array_filter($tools, function ($tool) {
                                return $tool['tool_id'] === 'GEN002504';
                            });
                            $toolEtt = reset($filteredToolsEtt);
                            $filteredToolsLine = array_filter($tools, function ($tool) {
                                return $tool['tool_id'] === 'GEN002505';
                            });
                            $toolLine = reset($filteredToolsLine);

                            ?>
                            <td colspan="3" rowspan="6"></td>
                            <td class="fw-bold text-center" colspan="5" rowspan="1">
                                ALAT INVASIF
                            </td>
                            <td class="fw-bold text-center" colspan="3" rowspan="1">
                                HARI/TANGGAL
                            </td>
                            <td class="fw-bold text-center" colspan="3" rowspan="1">
                                POSISI
                            </td>
                            <td class="fw-bold text-center" colspan="3" rowspan="1">
                                UKURAN
                            </td>
                            <td class="fw-bold text-center" colspan="9" rowspan="1">
                                HASIL KULTUR
                            </td>
                            <td class="fw-bold text-center" colspan="33" rowspan="1">
                                HASIL LAB KRITIS
                            </td>
                        </tr>
                        <tr>

                            <td colspan="5" rowspan="1">
                                VENA LINE
                            </td>
                            <td colspan="3" rowspan="1">
                                <?php echo @$toolVena['examination_date'] ? date('Y-m-d', strtotime(@$toolVena['examination_date'])) : ''; ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolVena['tool_location'] ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolVena['tool_size'] ?>

                            </td>

                            <!-- HASIL KULTUR -->
                            <td colspan="9" rowspan="5">
                            </td>
                            <!-- /HASIL LAB KRITIS -->
                            <td colspan="33" rowspan="5">
                                <table border="1" style="border-collapse: collapse; width: 100%;">
                                    <?php
                                    foreach ($lab as $e) {
                                        echo "<tr>
                                                <td  style='border: 1px solid black; padding: 5px;'>{$e['parameter_name']}</td>
                                                <td class='text-center' style='border: 1px solid black; padding: 5px;'>{$e['hasil']}</td>
                                            </tr>";
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" rowspan="1">
                                NGT/OGT
                            </td>
                            <td colspan="3" rowspan="1">
                                <?php echo @$toolNgt['examination_date'] ? date('Y-m-d', strtotime(@$toolNgt['examination_date'])) : ''; ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolNgt['tool_location'] ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolNgt['tool_size'] ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" rowspan="1">
                                URINE CATHETER
                            </td>
                            <td colspan="3" rowspan="1">
                                <?php echo @$toolUrin['examination_date'] ? date('Y-m-d', strtotime(@$toolUrin['examination_date'])) : ''; ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolUrin['tool_location'] ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolUrin['tool_size'] ?>

                            </td>

                        </tr>
                        <tr>
                            <td colspan="5" rowspan="1">
                                ETT/TRACHEOSTOMI
                            </td>
                            <td colspan="3" rowspan="1">
                                <?php echo @$toolEtt['examination_date'] ? date('Y-m-d', strtotime(@$toolEtt['examination_date'])) : ''; ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolEtt['tool_location'] ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolEtt['tool_size'] ?>

                            </td>

                        </tr>
                        <tr>
                            <td colspan="5" rowspan="1">
                                ARTERI LINE/CVP
                            </td>
                            <td colspan="3" rowspan="1">
                                <?php echo @$toolLine['examination_date'] ? date('Y-m-d', strtotime(@$toolLine['examination_date'])) : ''; ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolLine['tool_location'] ?>
                            </td>
                            <td colspan="3" rowspan="1">
                                <?= @$toolLine['tool_size'] ?>

                            </td>

                        </tr>
                        <!-- chart  -->

                        <tr>
                            <!-- <td colspan="73">chart</td> -->
                            <td colspan="77" class="text-center">
                                <div style="width: 95%; margin: auto;">
                                    <canvas id="myChartVt-<?= $index ?>" width="800" height="400"></canvas>
                                </div>
                            </td>
                            <td colspan="1" rowspan="5" style="width: 20%;">
                                <p>
                                    <span class="d-block text-center fw-bold">TINGKAT KESADARAN</span>
                                    <span class="d-block">1. COMPOSMENTIS: Bereaksi segera dengan orientasi sempurna.</span>
                                    <span class="d-block">2. APATIS: Terlihat mengantuk tetapi mudah dibangunkan dan reaksi
                                        penglihatan.</span>
                                    <span class="d-block">3. SOMNOLENT: Dapat dibangunkan bila dirangsang, dapat disuruh dan
                                        menjawab pertanyaan. Bila rangsangan berhenti, penderita tidur lagi.</span>
                                    <span class="d-block">4. SOPOR: Dapat dibangunkan bila dirangsang dengan kasar dan
                                        terus-menerus.</span>
                                    <span class="d-block">5. SOPORCOMA: Refleks motoris terjadi hanya bila dirangsang dengan
                                        rangsangan nyeri.</span>
                                    <span class="d-block">6. COMA: Tidak ada refleks motoris sekalipun dengan
                                        rangsangan.</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];
                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];


                            foreach ($item['data_vt'] as $indexgcs => $gcsRow) {
                                $examinationDate = $gcsRow['examination_date'];
                                $hour = (int)date('H', strtotime($examinationDate));

                                if ($indexgcs === 0) {
                                    $colNumber = $hour;

                                    if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                        echo "<td colspan='3' class='text-center fw-bold'>{$hour}</td>";
                                        $displayedColumns[] = $colNumber;
                                    }
                                    break;
                                }
                            }



                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    if (!in_array($i, $displayedColumns)) {
                                        echo "<td colspan='3' class='text-center fw-bold'>{$i}</td>";
                                    }
                                }
                            } else {
                                for ($i = 0; $i < 24; $i++) {
                                    echo '<td colspan="3"></td>';
                                }
                                // echo "<td colspan='3' class='text-center'></td>";
                            }

                            ?>
                        </tr>

                        <!-- data bawah  -->
                        <tr>
                            <td colspan="5">GCS(EVM)</td>
                            <?php
                            usort($item['data_gcs'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumnsDatagcs = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                            foreach ($allColumnsDatagcs as $i) {
                                $gcsRow = current(array_filter($item['data_gcs'], function ($gcsRow) use ($i) {
                                    return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                }));

                                if ($gcsRow !== false) {
                                    $matchingtreatPData = array_filter($item['data_gcs'], function ($gcsevPRow) use ($i) {
                                        $hour = (int)date('H', strtotime($gcsevPRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($gcsevPRow['examination_date']) && (int)date('H', strtotime($gcsevPRow['examination_date'])) === $i;
                                    });

                                    $datagcsValuesE = array_column($matchingtreatPData, 'gcs_e');
                                    $datagcsValuesV = array_column($matchingtreatPData, 'gcs_v');
                                    $datagcsValuesM = array_column($matchingtreatPData, 'gcs_m');

                                    $dataGcse = implode(', ', $datagcsValuesE);
                                    $dataGcsv = implode(', ', $datagcsValuesV);
                                    $dataGcsm = implode(', ', $datagcsValuesM);

                                    echo "<td class='text-center'>e : {$dataGcse}</td>";
                                    echo "<td class='text-center'>v : {$dataGcsv}</td>";
                                    echo "<td class='text-center'>m : {$dataGcsm}</td>";
                                    $displayedColumns[] = $i;
                                } else {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                            }

                            if (!empty($allColumnsDatagcs)) {
                                // foreach ($allColumnsDatagcs as $i) {
                                // if (!in_array($i, $displayedColumns)) {
                                //     echo "<td colspan='3' class='text-center'></td>";
                                // }
                                // }
                            } else {
                                for ($i = 0; $i < 24; $i++) {
                                    echo '<td colspan="3"></td>';
                                }
                            }
                            ?>
                        </tr>
                        <tr>
                            <td colspan="5">KESADARAN</td>
                            <?php
                            foreach ($allColumnsDatagcs as $i) {
                                $consciousnessData = current(array_filter($item['data_gcs'], function ($gcsRow) use ($i) {
                                    return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                }));

                                if ($consciousnessData !== false) {
                                    $datagcsValuesDesc = array_column([$consciousnessData], 'gcs_desc');
                                    $datadescGsc = implode(', ', $datagcsValuesDesc);
                                    echo "<td class='text-center' colspan='3'>{$datadescGsc}</td>";
                                } else {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                            }
                            ?>
                        </tr>


                        <tr>
                            <td colspan="5">ECG MONITORING (RYHTM)</td>
                            <?php
                            $filterDataEcgMonitoring = array_filter($item['data_exam_agd'], function ($e) {
                                return $e['parameter_id'] === '06';
                            });

                            $indexVentilator = 0;

                            foreach ($filterDataEcgMonitoring as $result) {
                                $indexVentilator++;

                                if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : null;
                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;
                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : range(1, 24);

                                    foreach ($allColumns as $i) {
                                        $matchingtreatPData = array_filter($filterDataEcgMonitoring, function ($treatPRow) use ($i, $result) {
                                            $hour = (int)date('H', strtotime($treatPRow['examination_date']));
                                            return isset($treatPRow['examination_date']) && $hour === $i && $treatPRow['body_id'] === $result['body_id'];
                                        });

                                        $datamatchingtreatPData = array_filter($matchingtreatPData, function ($item) {
                                            return isset($item['results']) && !empty($item['results']);
                                        });

                                        $resultsString = implode(',', array_column($datamatchingtreatPData, 'results'));

                                        echo !empty($matchingtreatPData)
                                            ? "<td class='text-center' colspan='3'>$resultsString</td>"
                                            : "<td class='text-center' colspan='3'></td>";
                                    }
                                } else {
                                    for ($i = 0; $i < 24; $i++) {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            }

                            if ($indexVentilator === 0) {
                                for ($i = 0; $i < 24; $i++) {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                            }
                            ?>
                        </tr>

                        <?php
                        $filterDataPupilMata = array_filter($item['data_exam_agd'], function ($e) {
                            return $e['parameter_id'] === '03';
                        });
                        $filterDataExTangan = array_filter($item['data_exam_agd'], function ($e) {
                            return $e['parameter_id'] === '04';
                        });
                        $filterDataExKaki = array_filter($item['data_exam_agd'], function ($e) {
                            return $e['parameter_id'] === '05';
                        });
                        ?>
                        <tr>
                            <td colspan="5">PUPIL MATA</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";
                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingPupilMataData = array_filter($filterDataPupilMata, function ($pupilRow) use ($i) {
                                        $hour = (int)date('H', strtotime($pupilRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return $hour === $i;
                                    });

                                    $kananData = array_filter($matchingPupilMataData, function ($pupilRow) {
                                        return $pupilRow['treatment_id'] === 'G0260302';  // Kiri
                                    });
                                    $kiriData = array_filter($matchingPupilMataData, function ($pupilRow) {
                                        return $pupilRow['treatment_id'] === 'G0260301';  // Kanan
                                    });

                                    $kananResults = array_map(function ($pupilRow) {
                                        return $pupilRow['results'];
                                    }, $kananData);
                                    $kiriResults = array_map(function ($pupilRow) {
                                        return $pupilRow['results'];
                                    }, $kiriData);

                                    $kanan = !empty($kananResults) ? implode(', ', $kananResults) : '';
                                    $kiri = !empty($kiriResults) ? implode(', ', $kiriResults) : '';

                                    echo "<td class='text-center' colspan='2'>{$kanan}</td>";
                                    echo "<td class='text-center' >{$kiri}</td>";
                                }
                            } else {
                                echo "<td class='text-center' colspan='2'></td>";
                                echo "<td class='text-center'></td>";
                            }
                            ?>
                            <td colspan="1" rowspan="<?= $lenghtodd + 7 + $lenghtoddPaternal  ?>"
                                style="width: 20%; vertical-align: top; padding: 10px; border: 1px solid #000;">
                                <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                                    <tr>
                                        <td
                                            style="width: 50%; vertical-align: top; padding-right: 10px; border-right: 1px solid #000; word-wrap: break-word; overflow: hidden;">
                                            <b>GLASGOW COMA SCALE</b>
                                            <hr>
                                            <br>
                                            <b>BUKA MATA</b><br>
                                            1. Tidak ada<br>
                                            2. Pada nyeri<br>
                                            3. Pada bicara<br>
                                            4. Spontan<br><br>
                                            <b>RESPON MOTOR</b><br>
                                            1. Tidak ada<br>
                                            2. Ekstensi<br>
                                            3. Fleksi abn<br>
                                            4. Menarik<br>
                                            5. Tunjuk nyeri<br>
                                            6. Menurut perintah<br><br>
                                            <b>RESPON VERBAL</b><br>
                                            1. Tidak ada<br>
                                            2. Tanpa arti<br>
                                            3. Kata tak benar<br>
                                            4. Bicara ngaco<br>
                                            5. Orientasi Baik
                                        </td>
                                        <td
                                            style="width: 50%; vertical-align: top; padding-left: 10px; word-wrap: break-word; overflow: hidden;">
                                            <b>GLASGOW PITTSBURG COMA SCALE</b>
                                            <hr>
                                            <br>
                                            <b>RESPON PUPIL</b><br>
                                            1. Tidak ada<br>
                                            2. Besar tak sama<br>
                                            3. Tidak ada<br>
                                            4. Lambat<br><br>
                                            <b>REFLEKSI SY. OTAK</b><br>
                                            1. Semua neg.<br>
                                            2. Dol’s eye neg.<br>
                                            3. Ref. kornea neg.<br>
                                            4. Ref. bulbar neg.<br><br>
                                            <b>KEJANG</b><br>
                                            1. Flaksia<br>
                                            2. Umum, kontinyu<br>
                                            3. Umum, intermiten<br>
                                            4. Fokus<br>
                                            5. Tak ada<br><br>
                                            <b>NAFAS SPONTAN</b><br>
                                            1. Apnea<br>
                                            2. Irregular<br>
                                            3. Hiperventilasi<br>
                                            4. Periodik<br>
                                            5. Normal
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="5">EXTREMITAS TANGAN</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";
                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingexTanganData = array_filter($filterDataExTangan, function ($exTanganRow) use ($i) {
                                        $hour = (int)date('H', strtotime($exTanganRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return $hour === $i;
                                    });

                                    $kananData = array_filter($matchingexTanganData, function ($exTanganRow) {
                                        return $exTanganRow['treatment_id'] === 'G0260402';  // Kiri
                                    });
                                    $kiriData = array_filter($matchingexTanganData, function ($exTanganRow) {
                                        return $exTanganRow['treatment_id'] === 'G0260401';  // Kanan
                                    });

                                    $kananResults = array_map(function ($exTanganRow) {
                                        return $exTanganRow['results'];
                                    }, $kananData);
                                    $kiriResults = array_map(function ($exTanganRow) {
                                        return $exTanganRow['results'];
                                    }, $kiriData);

                                    $kanan = !empty($kananResults) ? implode(', ', $kananResults) : '';
                                    $kiri = !empty($kiriResults) ? implode(', ', $kiriResults) : '';

                                    echo "<td class='text-center' colspan='2'>{$kanan}</td>";
                                    echo "<td class='text-center' >{$kiri}</td>";
                                }
                            } else {
                                echo "<td class='text-center' colspan='2'></td>";
                                echo "<td class='text-center'></td>";
                            }
                            ?>
                        </tr>
                        <tr>
                            <td colspan="5">EXTREMITAS KAKI</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";
                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingexTanganData = array_filter($filterDataExKaki, function ($exKakiRow) use ($i) {
                                        $hour = (int)date('H', strtotime($exKakiRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return $hour === $i;
                                    });

                                    $kananData = array_filter($matchingexTanganData, function ($exKakiRow) {
                                        return $exKakiRow['treatment_id'] === 'G0260502';  // Kiri
                                    });
                                    $kiriData = array_filter($matchingexTanganData, function ($exKakiRow) {
                                        return $exKakiRow['treatment_id'] === 'G0260501';  // Kanan
                                    });

                                    $kananResults = array_map(function ($exKakiRow) {
                                        return $exKakiRow['results'];
                                    }, $kananData);
                                    $kiriResults = array_map(function ($exKakiRow) {
                                        return $exKakiRow['results'];
                                    }, $kiriData);

                                    $kanan = !empty($kananResults) ? implode(', ', $kananResults) : '';
                                    $kiri = !empty($kiriResults) ? implode(', ', $kiriResults) : '';

                                    echo "<td class='text-center' colspan='2'>{$kanan}</td>";
                                    echo "<td class='text-center' >{$kiri}</td>";
                                }
                            } else {
                                echo "<td class='text-center' colspan='2'></td>";
                                echo "<td class='text-center'></td>";
                            }
                            ?>
                        </tr>
                        <tr>
                            <td colspan="5">RR</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    // $matchingVtData = array_filter($item['data_vt'], function($vtRow) use ($i) {
                                    //     return (int)date('H', strtotime($vtRow['examination_date'])) === $i;
                                    // });
                                    $matchingVtData = array_filter($item['data_vt'], function ($vtRow) use ($i) {
                                        $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                            && $hour === $i;
                                        // && $vtRow['body_id'] === $result['body_id'];
                                    });

                                    if (!empty($matchingVtData)) {
                                        $nafasValues = array_map(function ($vtRow) {
                                            return $vtRow['nafas'];
                                        }, $matchingVtData);

                                        $nafasValues = array_unique($nafasValues);
                                        $nafasOutput = implode(', ', $nafasValues);
                                        echo "<td class='text-center' colspan='3'>{$nafasOutput}</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }


                            ?>
                        </tr>
                        <tr>
                            <td colspan="5">SPO2</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingVtData = array_filter($item['data_vt'], function ($vtRow) use ($i) {
                                        $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                            && $hour === $i;
                                        // && $vtRow['body_id'] === $result['body_id'];
                                    });

                                    // $matchingVtData = array_filter($item['data_vt'], function($vtRow) use ($i,$result) {

                                    //     return (int)date('H', strtotime($vtRow['examination_date'])) === $i  && $vtRow['body_id'] === $result['body_id'];
                                    // });

                                    if (!empty($matchingVtData)) {
                                        // echo json_encode($matchingVtData, JSON_PRETTY_PRINT);
                                        $nafasValues = array_map(function ($vtRow) {
                                            return $vtRow['saturasi'];
                                        }, $matchingVtData);
                                        $nafasValues = array_unique($nafasValues);

                                        $nafasOutput = implode(', ', $nafasValues);
                                        echo "<td class='text-center' colspan='3'>{$nafasOutput}</td>";
                                    } else {
                                        echo "<td class='text-center'  colspan='3'></td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }

                            ?>

                        </tr>

                        <tr>
                            <td rowspan="<?= $lenghtodd + 1 ?>"></td>
                            <td class="text-center">Obat ETERNAL</td>
                            <td>INDIKASI</td>
                            <td>RUTE</td>
                            <td>DOSIS</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;
                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            foreach ($item['data_vt'] as $indexgcs => $gcsRow) {
                                $examinationDate = $gcsRow['examination_date'];
                                $hour = (int)date('H', strtotime($examinationDate));

                                if ($indexgcs === 0) {
                                    $colNumber = $hour;

                                    if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                        echo "<td colspan='3' class='text-center fw-bold'>{$hour}</td>";
                                        $displayedColumns[] = $colNumber;
                                    }
                                    break;
                                }
                            }

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    if (!in_array($i, $displayedColumns)) {
                                        echo "<td colspan='3' class='text-center fw-bold'>{$i}</td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }
                            ?>
                        </tr>


                        <?php foreach ($item['data_odd'] as $indexOddEnternal => $result): ?>
                            <?php
                            if (isset($result['signa_4']) && (strpos(strtolower($result['signa_4']), 'p.o') !== false || strpos(strtolower($result['signa_4']), 'po') !== false)):
                            ?>
                                <tr>
                                    <td><?= $result['nama_obat'] ?></td>
                                    <td><?= $result['signa_1'] ?? $result['description2'] ?></td>
                                    <td><?= $result['signa_4'] ?></td>
                                    <td><?= $result['dose_presc'] ?></td>

                                    <?php
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $displayedColumns = [];

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;

                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";


                                    if (!empty($allColumns)) {
                                        foreach ($allColumns as $i) {
                                            $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                                return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                            }));

                                            if ($gcsRow === false) {
                                                $gcsRow = null;
                                            }

                                            $matchingOddoralData = array_filter($item['data_odd'], function ($oddRow) use ($i, $result) {
                                                return isset($oddRow['received_date']) && $oddRow['received_date'] !== null
                                                    && (int)date('H', strtotime($oddRow['received_date'])) === $i
                                                    && $oddRow['vactination_id'] === $result['vactination_id']
                                                    && isset($oddRow['signa_4']) && (strpos(strtolower($oddRow['signa_4']), 'p.o') !== false || strpos(strtolower($oddRow['signa_4']), 'po') !== false);
                                            });

                                            if (!empty($matchingOddoralData)) {
                                                echo "<td class='text-center fw-bold' colspan='3'>✓</td>";
                                            } else {
                                                echo "<td class='text-center' colspan='3'></td>";
                                            }
                                        }
                                    } else {
                                        echo "<td class='text-center'  colspan='3'></td>";
                                    }
                                    ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td rowspan="<?= $lenghtoddPaternal + 1 + $lenghtcairanIn + $lenghtcairanInE + 1 ?>"></td>
                            <td class="text-center">Obat PARENTERAL</td>
                            <td>INDIKASI</td>
                            <td>RUTE</td>
                            <td>DOSIS</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;
                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            foreach ($item['data_vt'] as $indexgcs => $gcsRow) {
                                $examinationDate = $gcsRow['examination_date'];
                                $hour = (int)date('H', strtotime($examinationDate));

                                if ($indexgcs === 0) {
                                    $colNumber = $hour;

                                    if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                        echo "<td colspan='3' class='text-center fw-bold'>{$hour}</td>";
                                        $displayedColumns[] = $colNumber;
                                    }
                                    break;
                                }
                            }

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    if (!in_array($i, $displayedColumns)) {
                                        echo "<td colspan='3' class='text-center fw-bold'>{$i}</td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }
                            ?>
                        </tr>

                        <?php foreach ($item['data_odd'] as $indexOddPaternal => $result): ?>
                            <?php
                            if (isset($result['signa_4']) && (strpos(strtolower($result['signa_4']), 'i.v') !== false || strpos(strtolower($result['signa_4']), 'iv') !== false)):
                            ?>
                                <tr>
                                    <td><?= $result['nama_obat'] ?></td>
                                    <td><?= $result['signa_1'] ?? $result['description2'] ?></td>
                                    <td><?= $result['signa_4'] ?></td>
                                    <td><?= $result['dose_presc'] ?></td>

                                    <?php
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $displayedColumns = [];

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;

                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                                    if (!empty($allColumns)) {
                                        foreach ($allColumns as $i) {
                                            $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                                return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                            }));

                                            if ($gcsRow === false) {
                                                $gcsRow = null;
                                            }

                                            $matchingOddoralData = array_filter($item['data_odd'], function ($oddRow) use ($i, $result) {
                                                return isset($oddRow['received_date']) && $oddRow['received_date'] !== null
                                                    && (int)date('H', strtotime($oddRow['received_date'])) === $i
                                                    && $oddRow['vactination_id'] === $result['vactination_id']
                                                    && isset($oddRow['signa_4']) && (strpos(strtolower($oddRow['signa_4']), 'i.v') !== false || strpos(strtolower($oddRow['signa_4']), 'iv') !== false);
                                            });

                                            if (!empty($matchingOddoralData)) {
                                                echo "<td class='text-center fw-bold' colspan='3'>✓</td>";
                                            } else {
                                                echo "<td class='text-center' colspan='3'></td>";
                                            }
                                        }
                                    } else {
                                        echo "<td class='text-center'  colspan='3'></td>";
                                    }


                                    ?>
                                </tr>

                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php
                        $mergedData = [];

                        foreach ($item['data_cairan'] as $indexcairanIn => $result) {
                            if (isset($result['fluid_type']) && strpos($result['fluid_type'], 'G0230302') !== false) {
                                $key = strtolower(trim($result['iv_line'])) . '|' . strtolower(trim($result['iv_description'] ?? ''));

                                if (!isset($mergedData[$key])) {
                                    $mergedData[$key] = $result;
                                    $mergedData[$key]['fluid_amount'] = (int) $result['fluid_amount'];
                                } else {
                                    $mergedData[$key]['fluid_amount'] += (int) $result['fluid_amount'];
                                }
                            }
                        }

                        foreach ($mergedData as $indexcairanIn => $result):
                        ?>
                            <tr>
                                <td colspan="4">
                                    <?= "Line " . htmlspecialchars($result['iv_line']) . " " . htmlspecialchars($result['iv_description']) ?>
                                </td>
                                <?php
                                if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });
                                }

                                $firstExaminationDate = $item['data_vt'][0]['examination_date'] ?? null;
                                $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;
                                $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                foreach ($allColumns as $i) {
                                    $matchingcairanInData = array_filter($item['data_cairan'] ?? [], function ($cairanInRow) use ($i, $result) {
                                        return isset($cairanInRow['examination_date']) &&
                                            (int)date('H', strtotime($cairanInRow['examination_date'])) === $i &&
                                            strtolower(trim($cairanInRow['iv_line'])) === strtolower(trim($result['iv_line'])) &&
                                            strtolower(trim($cairanInRow['iv_description'] ?? '')) === strtolower(trim($result['iv_description'] ?? ''));
                                    });

                                    if (!empty($matchingcairanInData)) {
                                        $totalAmount = array_sum(array_column($matchingcairanInData, 'fluid_amount'));
                                        echo "<td class='text-center fw-bold' colspan='3'>{$totalAmount}</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                                ?>

                                <?php if ($indexcairanIn === array_key_first($mergedData)): ?>
                                    <td rowspan="<?= count($mergedData) ?>">
                                        <h5 class="fw-bold">BESAR PUPIL</h5>
                                        <span class="dot1"></span><span>1</span>
                                        <span class="dot2"></span><span>2</span>
                                        <span class="dot3"></span><span>3</span>
                                        <span class="dot4"></span><span>4</span>
                                        <span class="dot5"></span><span>5</span>
                                        <span class="dot6"></span><span>6</span>
                                        <span class="dot7"></span><span>7</span>
                                        <span class="dot8"></span><span>8</span>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>


                        <?php foreach ($item['data_cairan'] as $indexcairanIn => $result): ?>
                            <?php
                            if (isset($result['fluid_type']) && strpos($result['fluid_type'], 'G0230309') !== false):
                            ?>
                                <tr>
                                    <td colspan="4">Eternal</td>
                                    <?php
                                    if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                        usort($item['data_vt'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });
                                    }

                                    $displayedColumns = [];

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];


                                    $firstHour = $firstExaminationDate
                                        ? (int)date('H', strtotime($firstExaminationDate))
                                        : null;

                                    $allColumns = $firstHour
                                        ? array_merge(range($firstHour, 24), range(1, $firstHour - 1))
                                        : [];

                                    if (is_array($allColumns)) {
                                        foreach ($allColumns as $i) {
                                            $gcsRow = current(array_filter($item['data_vt'] ?? [], function ($gcsRow) use ($i) {
                                                return isset($gcsRow['examination_date']) &&
                                                    (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                            }));

                                            if ($gcsRow === false) {
                                                $gcsRow = null;
                                            }

                                            $matchingcairanInData = array_filter($item['data_cairan'] ?? [], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) &&
                                                    $cairanInRow['examination_date'] !== null &&
                                                    (int)date('H', strtotime($cairanInRow['examination_date'])) === $i &&
                                                    $cairanInRow['body_id'] === $result['body_id'] &&
                                                    isset($cairanInRow['fluid_type']) &&
                                                    strpos($cairanInRow['fluid_type'], 'G0230309') !== false;
                                            });

                                            if (!empty($matchingcairanInData)) {
                                                $matchingData = reset($matchingcairanInData);
                                                echo "<td class='text-center fw-bold' colspan='3'>" . (int)$matchingData['fluid_amount'] . "</td>";
                                            } else {
                                                echo "<td class='text-center' colspan='3'></td>";
                                            }
                                        }
                                    } else {
                                        echo "<td class='text-center' colspan='3'>No data available</td>";
                                    }
                                    ?>
                                </tr>
                            <?php endif; ?>


                        <?php endforeach; ?>
                        <?php
                        $totalPerHourCairan = [];

                        $item['data_cairan'] = $item['data_cairan'] ?? [];
                        $item['data_vt'] = $item['data_vt'] ?? [];

                        if (is_array($item['data_cairan'])) {
                            foreach ($item['data_cairan'] as $indexcairanIn => $result) {
                                if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230309') !== false || strpos($result['fluid_type'], 'G0230302') !== false)) {
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;
                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                    foreach ($allColumns as $i) {
                                        $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                            return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null
                                                && (int)date('H', strtotime($cairanInRow['examination_date'])) === $i
                                                && $cairanInRow['body_id'] === $result['body_id']
                                                && (strpos($cairanInRow['fluid_type'], 'G0230309') !== false || strpos($cairanInRow['fluid_type'], 'G0230302') !== false);
                                        });

                                        if (!empty($matchingcairanInData)) {
                                            $matchingData = reset($matchingcairanInData);
                                            $hour = (int)date('H', strtotime($matchingData['examination_date']));

                                            if (!isset($totalPerHourCairan[$hour])) {
                                                $totalPerHourCairan[$hour] = 0;
                                            }

                                            $totalPerHourCairan[$hour] += (int)$matchingData['fluid_amount'];
                                        }
                                    }
                                }
                            }
                        }

                        usort($item['data_vt'], function ($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                        $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;
                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                        echo "<tr>\n    <td colspan='4'>Total</td>";

                        $totalKeseluruhanMasuk = 0;
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourCairan[$hour] ?? 0;
                                $totalKeseluruhanMasuk += $total;
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center' colspan='3'></td>";
                        }

                        echo "<td rowspan='4'>
                        <b>JENIS VENTILASI</b>
                        <hr>
                        <p>SR : SPONTAN RESPIRASI</p>
                        <p>HB : HEAD BOX</p>
                        <p>MCV : MECH, CONTROL VENT</p>
                        <p>AMV : ASSIST, MECH. VENT</p>
                        <p>(S) IMV : (SYNCH) INTERMIT MECH,VENT</p>
                        <p>CPAP : CONT. POS. AIRWAY PASS</p>
                        <p>PS : PRESS. SUPP</p>
                    </td>";
                        echo "</tr>";
                        ?>

                        <?php
                        $totalPerHourUrine = [];
                        if (is_array($item['data_cairan'])) {
                            foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230303') !== false)):
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int) date('H', strtotime($firstExaminationDate)) : null;
                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                    foreach ($allColumns as $i) {
                                        $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                            return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null
                                                && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i
                                                && $cairanInRow['body_id'] === $result['body_id']
                                                && (strpos($cairanInRow['fluid_type'], 'G0230303') !== false);
                                        });

                                        if (!empty($matchingcairanInData)) {
                                            $matchingData = reset($matchingcairanInData);
                                            $hour = (int) date('H', strtotime($matchingData['examination_date']));

                                            if (!isset($totalPerHourUrine[$hour])) {
                                                $totalPerHourUrine[$hour] = 0;
                                            }

                                            $totalPerHourUrine[$hour] += (int) $matchingData['fluid_amount'];
                                        }
                                    }
                                endif;
                            endforeach;
                        }

                        usort($item['data_vt'], function ($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                        $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;
                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                        echo "<tr>\n 
                        <td class='fw-bold text-center' rowspan='5' style='writing-mode: vertical-rl;'>OUTPUT</td>
                        <td colspan='4'>URINE</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {

                                $total = $totalPerHourUrine[$hour] ?? '';
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
                        }
                        echo "</tr>";
                        ?>

                        <?php
                        $totalPerHourMuntah = [];

                        if (is_array($item['data_cairan'])) {
                            foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                if (
                                    isset($result['fluid_type']) &&
                                    (strpos($result['fluid_type'], 'G0230304') !== false || strpos($result['fluid_type'], 'G0230305') !== false)
                                ):

                                    if (is_array($item['data_vt'])) {
                                        usort($item['data_vt'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });
                                    }

                                    $firstExaminationDate = !empty($item['data_vt']) && isset($item['data_vt'][0]['examination_date'])
                                        ? $item['data_vt'][0]['examination_date']
                                        : null;

                                    $firstHour = $firstExaminationDate ? (int) date('H', strtotime($firstExaminationDate)) : null;
                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                    foreach ($allColumns as $i) {
                                        $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                            return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null
                                                && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i
                                                && $cairanInRow['body_id'] === $result['body_id']
                                                && (strpos($cairanInRow['fluid_type'], 'G0230304') !== false || strpos($cairanInRow['fluid_type'], 'G0230305') !== false);
                                        });

                                        if (!empty($matchingcairanInData)) {
                                            $matchingData = reset($matchingcairanInData);
                                            $hour = (int) date('H', strtotime($matchingData['examination_date']));

                                            if (!isset($totalPerHourMuntah[$hour])) {
                                                $totalPerHourMuntah[$hour] = 0;
                                            }

                                            $totalPerHourMuntah[$hour] += (int) $matchingData['fluid_amount'];
                                        }
                                    }
                                endif;
                            endforeach;
                        }
                        usort($item['data_vt'], function ($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                        $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;
                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                        echo "<tr>\n 
                        <td colspan='4'>NGT/RETENTION/MUNTAH</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourMuntah[$hour] ?? '';
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
                        }

                        echo "</tr>";
                        ?>

                        <?php
                        $totalPerHourDrain = [];

                        foreach ($item['data_cairan'] as $indexcairanIn => $result):
                            if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230307') !== false)):
                                usort($item['data_vt'], function ($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                $firstHour = $firstExaminationDate ? (int) date('H', strtotime($firstExaminationDate)) : "";
                                $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                                foreach ($allColumns as $i) {
                                    $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                        return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null
                                            && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i
                                            && $cairanInRow['body_id'] === $result['body_id']
                                            && (strpos($cairanInRow['fluid_type'], 'G0230307') !== false);
                                    });

                                    if (!empty($matchingcairanInData)) {
                                        $matchingData = reset($matchingcairanInData);
                                        $hour = (int) date('H', strtotime($matchingData['examination_date']));

                                        if (!isset($totalPerHourDrain[$hour])) {
                                            $totalPerHourDrain[$hour] = 0;
                                        }

                                        $totalPerHourDrain[$hour] += (int) $matchingData['fluid_amount'];
                                    }
                                }
                            endif;
                        endforeach;

                        usort($item['data_vt'], function ($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                        $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;
                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                        echo "<tr>\n 
                        <td colspan='4'>DRAIN/PENDARAHAN</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourDrain[$hour] ?? '';
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
                        }

                        echo "</tr>";
                        ?>
                        <?php
                        $totalPerHourkosong = [];

                        foreach ($item['data_cairan'] as $indexcairanIn => $result):
                            if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'a') !== false)):
                                usort($item['data_vt'], function ($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                $firstHour = $firstExaminationDate ? (int) date('H', strtotime($firstExaminationDate)) : "";
                                $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                                foreach ($allColumns as $i) {
                                    $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                        return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null
                                            && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i
                                            && $cairanInRow['body_id'] === $result['body_id']
                                            && (strpos($cairanInRow['fluid_type'], 'a') !== false);
                                    });

                                    if (!empty($matchingcairanInData)) {
                                        $matchingData = reset($matchingcairanInData);
                                        $hour = (int) date('H', strtotime($matchingData['examination_date']));

                                        if (!isset($totalPerHourkosong[$hour])) {
                                            $totalPerHourkosong[$hour] = 0;
                                        }

                                        $totalPerHourkosong[$hour] += (int) $matchingData['fluid_amount'];
                                    }
                                }
                            endif;
                        endforeach;

                        usort($item['data_vt'], function ($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                        $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";;
                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                        echo "<tr>\n 
                        <td colspan='4'>DEFEKASI/KOLOSTOMI</td>";

                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourkosong[$hour] ?? "";

                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
                        }


                        $allowedTypesDataUrine = ["G0230303"];

                        $filteredDataUrine = array_filter($item['data_cairan'], function ($item) use ($allowedTypesDataUrine) {
                            return in_array($item['fluid_type'], $allowedTypesDataUrine);
                        });

                        $totalFluidUrine = array_sum(array_column($filteredDataUrine, 'fluid_amount'));


                        $allowedTypesDataOutput = ["G0230304", "G0230306", "G0230307", "G0230303", "G0230305"];

                        $filteredDataOutput = array_filter($item['data_cairan'], function ($item) use ($allowedTypesDataOutput) {
                            return in_array($item['fluid_type'], $allowedTypesDataOutput);
                        });

                        $totalFluidOutput = array_sum(array_column($filteredDataOutput, 'fluid_amount'));

                        $allowedTypesDataInput = ["G0230309", "G0230302", "G0230301"];

                        $filteredDataInput = array_filter($item['data_cairan'], function ($item) use ($allowedTypesDataInput) {
                            return in_array($item['fluid_type'], $allowedTypesDataInput);
                        });

                        $totalFluidInput = array_sum(array_column($filteredDataInput, 'fluid_amount'));


                        $data_vt = $item['data_vt'];

                        usort($data_vt, function ($a, $b) {
                            return strtotime($b['examination_date']) - strtotime($a['examination_date']);
                        });

                        $data_terbaru = $data_vt[0];



                        $tgl_lahir = new DateTime($visit['tgl_lahir']);
                        $visit_datetime = new DateTime();

                        $umur = $tgl_lahir->diff($visit_datetime);
                        $age_konstaIwl = $umur->y;

                        if ($age_konstaIwl <= 1) {
                            $konsta_iwl = 50;
                        } elseif ($age_konstaIwl <= 12) {
                            $konsta_iwl = 40;
                        } elseif ($age_konstaIwl <= 60) {
                            $konsta_iwl = 30;
                        } elseif ($age_konstaIwl <= 120) {
                            $konsta_iwl = 20;
                        } else {
                            $konsta_iwl = 10;
                        }

                        $resultIwl = $data_terbaru['weight'] * $konsta_iwl / 24;
                        $resultBc = $totalFluidInput - ($totalFluidOutput + $resultIwl);
                        $resultDiuresis = ($data_terbaru['weight'] > 0)
                            ? number_format(($totalFluidUrine / $data_terbaru['weight'] / 24), 2)
                            : number_format(0);


                        // print_r($data_terbaru);

                        echo "<td rowspan='4'><b>BALANS CAIRAN</b>
                        <p>Masuk  $totalFluidInput cc</p>
                        <p>Keluar $totalFluidOutput cc</p>
                        <p>IWL $resultIwl cc</p>
                        <p>BC 24j $resultBc cc</p>
                        <p>Urine $totalFluidUrine cc</p>
                        <p>Diuresis $resultDiuresis cc</p>
                        
                        
                        </td>";
                        echo "</tr>";
                        ?>

                        <?php
                        $totalPerHourBab = [];

                        if (!isset($item['data_cairan']) || !is_array($item['data_cairan'])) {
                            $item['data_cairan'] = [];
                        }

                        foreach ($item['data_cairan'] as $indexcairanIn => $result):
                            if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230306') !== false)):
                                usort($item['data_vt'], function ($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                $firstHour = $firstExaminationDate ? (int) date('H', strtotime($firstExaminationDate)) : null;
                                $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                foreach ($allColumns as $i) {
                                    $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                        return isset($cairanInRow['examination_date'])
                                            && $cairanInRow['examination_date'] !== null
                                            && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i
                                            && $cairanInRow['body_id'] === $result['body_id']
                                            && (strpos($cairanInRow['fluid_type'], 'G0230306') !== false);
                                    });

                                    if (!empty($matchingcairanInData)) {
                                        $matchingData = reset($matchingcairanInData);
                                        $hour = (int) date('H', strtotime($matchingData['examination_date']));

                                        if (!isset($totalPerHourBab[$hour])) {
                                            $totalPerHourBab[$hour] = 0;
                                        }

                                        $totalPerHourBab[$hour] += (int) $matchingData['fluid_amount'];
                                    }
                                }
                            endif;
                        endforeach;

                        usort($item['data_vt'], function ($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                        $firstHour = $firstExaminationDate ? (int) date('H', strtotime($firstExaminationDate)) : null;
                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                        echo "<tr>\n 
                <td colspan='4'>BAB</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourBab[$hour] ?? '';
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
                        }
                        echo "</tr>";
                        ?>


                        <?php
                        $totalPerHourAll = [];

                        if (!empty($item['data_cairan']) && is_array($item['data_cairan'])) {
                            foreach ($item['data_cairan'] as $indexcairanIn => $result) {
                                if (isset($result['fluid_type']) && (
                                    strpos($result['fluid_type'], 'G0230306') !== false ||
                                    strpos($result['fluid_type'], 'G0230307') !== false ||
                                    strpos($result['fluid_type'], 'G0230304') !== false ||
                                    strpos($result['fluid_type'], 'G0230305') !== false ||
                                    strpos($result['fluid_type'], 'G0230303') !== false)) {

                                    if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                        usort($item['data_vt'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                        $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                                        $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null &&
                                                    (int)date('H', strtotime($cairanInRow['examination_date'])) === $i &&
                                                    $cairanInRow['body_id'] === $result['body_id'] &&
                                                    (strpos($cairanInRow['fluid_type'], 'G0230306') !== false ||
                                                        strpos($cairanInRow['fluid_type'], 'G0230307') !== false ||
                                                        strpos($cairanInRow['fluid_type'], 'G0230304') !== false ||
                                                        strpos($cairanInRow['fluid_type'], 'G0230305') !== false ||
                                                        strpos($cairanInRow['fluid_type'], 'G0230303') !== false);
                                            });

                                            if (!empty($matchingcairanInData)) {
                                                $matchingData = reset($matchingcairanInData);
                                                $hour = (int)date('H', strtotime($matchingData['examination_date']));

                                                if (!isset($totalPerHourAll[$hour])) {
                                                    $totalPerHourAll[$hour] = 0;
                                                }

                                                $totalPerHourAll[$hour] += (int)$matchingData['fluid_amount'];
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";
                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                            echo "<tr>\n";
                            echo "<td></td>";
                            echo "<td colspan='4' class='fw-bold'>TOTAL OUTPUT</td>";

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $hour) {
                                    $total = $totalPerHourAll[$hour] ?? '';
                                    echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                                }
                            } else {
                                echo "<td class='text-center' colspan='3'></td>";
                            }

                            echo "</tr>";
                        }

                        ?>
                        <tr>
                            <td></td>
                            <td colspan="76"></td>
                        </tr>

                        <?php
                        foreach ($item['data_treat_perawat'] as $indextreat_perawat => $result): ?>

                            <tr>
                                <?php if ($indextreat_perawat === 0) {
                                ?>
                                    <td style="writing-mode: vertical-rl;" rowspan="<?= count($item['data_treat_perawat']); ?>"
                                        class="fw-bold text-center">INTERVENSI KEPERAWATAN</td>
                                <?php
                                } ?>
                                <td colspan="4"><?= $result['treatment'] ?></td>
                                <?php
                                if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $displayedColumns = [];

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;

                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                    if (!empty($allColumns) && is_array($allColumns)) {
                                        foreach ($allColumns as $i) {
                                            $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                                return isset($gcsRow['examination_date']) &&
                                                    (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                            }));

                                            if ($gcsRow === false) {
                                                $gcsRow = null;
                                            }

                                            $matchingtreatPData = array_filter($item['data_treat_perawat'] ?? [], function ($treatPRow) use ($i, $result) {
                                                return isset($treatPRow['treat_date'], $treatPRow['tarif_id']) &&
                                                    $treatPRow['treat_date'] !== null &&
                                                    (int)date('H', strtotime($treatPRow['treat_date'])) === $i &&
                                                    $treatPRow['tarif_id'] === $result['tarif_id'];
                                            });

                                            if (!empty($matchingtreatPData)) {
                                                echo "<td class='text-center fw-bold' colspan='3'>✓</td>";
                                            } else {
                                                echo "<td class='text-center' colspan='3'></td>";
                                            }
                                        }
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                } else {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                                ?>


                                <?php if ($indextreat_perawat === 0) {
                                ?>
                                    <td rowspan="<?= count($item['data_treat_perawat']) + 1 ?>"><b>SKALA NYERI / NUMERIK</b>
                                        <p>0 :Tidak ada nyeri</p>
                                        <p>1 - 3 : Nyeri ringan</p>
                                        <p>4 - 6 : Nyeri sedang</p>
                                        <p>7 - 10 :Nyeri berat </p>
                                    </td>
                                <?php
                                } ?>
                            </tr>

                        <?php endforeach; ?>
                        <?php if (!empty($item['data_treat_perawat'])) { ?>
                            <tr>
                                <td></td>
                                <td colspan="76"></td>
                            </tr>
                        <?php } ?>
                        <?php $filterDataVentilator = array_filter($item['data_exam_agd'], function ($e) {
                            return $e['parameter_id'] === '01';
                        });

                        $filterDataPemeriksaanAgd = array_filter($item['data_exam_agd'], function ($e) {
                            return $e['parameter_id'] === '02';
                        });

                        ?>

                        <?php
                        $indexVentilator = 0;
                        foreach ($filterDataVentilator as $Ventilator => $result):
                            $indexVentilator++;
                        ?>

                            <tr>
                                <?php if ($indexVentilator === 1) {
                                ?>
                                    <td style="writing-mode: vertical-rl;" rowspan="<?= count($filterDataVentilator); ?>"
                                        class="fw-bold text-center">DATA VENTILATOR & RESPIRASI</td>
                                <?php
                                } ?>
                                <td colspan="4"><?= $result['treatment_name'] ?></td>
                                <?php
                                if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $displayedColumns = [];

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;

                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                    if (is_array($allColumns) && !empty($allColumns)) {
                                        foreach ($allColumns as $i) {
                                            $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                                return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                            }));

                                            if ($gcsRow === false) {
                                                $gcsRow = null;
                                            }

                                            if (isset($filterDataVentilator) && is_array($filterDataVentilator)) {
                                                $matchingtreatPData = array_filter($filterDataVentilator, function ($treatPRow) use ($i, $result) {
                                                    $hour = (int)date('H', strtotime($treatPRow['examination_date']));
                                                    $hour = $hour === 0 ? 24 : $hour;
                                                    return isset($treatPRow['examination_date']) && $treatPRow['examination_date'] !== null
                                                        && $hour === $i
                                                        && $treatPRow['body_id'] === $result['body_id'];
                                                });
                                                $datamatchingtreatPData = array_filter($matchingtreatPData, function ($item) {
                                                    return isset($item['results']) && !empty($item['results']);
                                                });

                                                $datamatchingtreatPData = array_column($datamatchingtreatPData, 'results');

                                                $resultsString = implode(',', $datamatchingtreatPData);


                                                if (!empty($matchingtreatPData)) {
                                                    echo "<td class='text-center fw-bold' colspan='3'>$resultsString</td>";
                                                } else {
                                                    echo "<td class='text-center' colspan='3'></td>";
                                                }
                                            } else {
                                                echo "<td class='text-center' colspan='3'></td>";
                                            }
                                        }
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                } else {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                                ?>


                                <?php if ($indexVentilator === 1) {
                                ?>
                                    <td rowspan="<?= count($filterDataVentilator) ?>"><b>SKOR RESIKO JATUH / FAIL MORSE SCALE</b>
                                        <p>Skor : 0 - 24 : Resiko Rendah (RR)</p>
                                        <p>Skor : 25 - 45 : Resiko Sedang (RS)</p>
                                        <p>Skor : > 45 : Resiko Tinggi (RT)</p>
                                    </td>
                                <?php
                                } ?>
                            </tr>

                        <?php endforeach; ?>

                        <?php if (!empty($item['data_treat_perawat'])) { ?>
                            <tr>
                                <td></td>
                                <td colspan="76"></td>
                            </tr>
                        <?php } ?>


                        <?php
                        $indexPemeriksaanAgd = 0;
                        foreach ($filterDataPemeriksaanAgd as $PemeriksaanAgd => $result):
                            $indexPemeriksaanAgd++;
                        ?>
                            <tr>
                                <?php
                                if ($indexPemeriksaanAgd === 1) {
                                ?>
                                    <td style="writing-mode: vertical-rl;" rowspan="<?= count($filterDataPemeriksaanAgd); ?>"
                                        class="fw-bold text-center">PEMERIKSAAN AGD</td>
                                <?php
                                } ?>
                                <td colspan="4"><?= $result['treatment_name'] ?></td>
                                <?php
                                if (!empty($item['data_vt']) && is_array($item['data_vt'])) {
                                    usort($item['data_vt'], function ($a, $b) {
                                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                    });

                                    $displayedColumns = [];

                                    $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : null;

                                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                                    if (is_array($allColumns) && !empty($allColumns)) {
                                        foreach ($allColumns as $i) {
                                            $gcsRow = current(array_filter($item['data_vt'], function ($gcsRow) use ($i) {
                                                return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                            }));

                                            if ($gcsRow === false) {
                                                $gcsRow = null;
                                            }

                                            if (isset($filterDataPemeriksaanAgd) && is_array($filterDataPemeriksaanAgd)) {
                                                $matchingtreatPData = array_filter($filterDataPemeriksaanAgd, function ($treatPRow) use ($i, $result) {
                                                    $hour = (int)date('H', strtotime($treatPRow['examination_date']));
                                                    $hour = $hour === 0 ? 24 : $hour; // Mengatur jam 0 menjadi 24
                                                    return isset($treatPRow['examination_date']) && $treatPRow['examination_date'] !== null
                                                        && $hour === $i
                                                        && $treatPRow['body_id'] === $result['body_id'];
                                                });

                                                $datamatchingtreatPData = array_filter($matchingtreatPData, function ($item) {
                                                    return isset($item['results']) && !empty($item['results']);
                                                });

                                                $datamatchingtreatPData = array_column($datamatchingtreatPData, 'results');

                                                $resultsString = implode(',', $datamatchingtreatPData);

                                                if (!empty($matchingtreatPData)) {
                                                    echo "<td class='text-center fw-bold' colspan='3'>" . $resultsString . "</td>";
                                                } else {
                                                    echo "<td class='text-center' colspan='3'></td>";
                                                }
                                            } else {
                                                echo "<td class='text-center' colspan='3'></td>";
                                            }
                                        }
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                } else {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                                ?>


                                <?php if ($indexPemeriksaanAgd === 1) {
                                ?>
                                    <td rowspan="<?= count($filterDataPemeriksaanAgd) + 3 ?>"><b>CRITICAL CARE PAIN OBSERVATION TOOL
                                            (CPTO)</b>
                                        <p>Skor : 0 : Tidak nyer</p>
                                        <p>Skor : 1 - 2 : Nyeri ringan</p>
                                        <p>Skor : 3 - 4 : Nyeri sedang</p>
                                        <p>Skor : 5 - 6 : Nyeri berat</p>
                                        <p>Skor : 7 - 8 : Nyeri berat sekali</p>
                                    </td>
                                <?php
                                } ?>
                            </tr>

                        <?php endforeach; ?>

                        <tr>
                            <td colspan="5">SKALA NYERI</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'] ?? [], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingskalaNyari = array_filter($item['data_skala_nyeri'] ?? [], function ($vtRow) use ($i) {
                                        $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                            && $hour === $i;
                                    });

                                    if (!empty($matchingskalaNyari)) {
                                        $resultValues = array_map(function ($vtRow) {
                                            return $vtRow['total_value_score'];
                                        }, $matchingskalaNyari);

                                        $resultOutput = implode($resultValues);
                                        echo "<td class='text-center fw-bold' colspan='3'>{$resultOutput}</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center' colspan='3'></td>";
                            }
                            ?>
                        </tr>

                        <tr>
                            <td colspan="5">RESIKO JATUH</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'] ?? [], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingResikoJatuh = array_filter($item['data_resiko_jatuh'] ?? [], function ($vtRow) use ($i) {
                                        $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                            && $hour === $i;
                                        // && $vtRow['body_id'] === $result['body_id'];
                                    });

                                    if (!empty($matchingResikoJatuh)) {
                                        $resultValues = array_map(function ($vtRow) {
                                            return $vtRow['total_score'];
                                        }, $matchingResikoJatuh);

                                        $resultOutput = implode($resultValues);
                                        echo "<td class='text-center fw-bold' colspan='3'>{$resultOutput}</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center' colspan='3'></td>";
                            }
                            ?>
                        </tr>

                        <tr>
                            <td colspan="5">SKORE NUTRISI</td>
                            <?php
                            usort($item['data_vt'], function ($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];

                            $firstExaminationDate = isset($item['data_vt'][0]) ? $item['data_vt'][0]['examination_date'] : [];

                            $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                            $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_vt'] ?? [], function ($gcsRow) use ($i) {
                                        return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    $matchingScoreNutrisi = array_filter($item['data_score_nutrisi'] ?? [], function ($vtRow) use ($i) {
                                        $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                            && $hour === $i;
                                        // && $vtRow['body_id'] === $result['body_id'];
                                    });

                                    if (!empty($matchingScoreNutrisi)) {
                                        $resultValues = array_map(function ($vtRow) {
                                            return $vtRow['hasil_score'];
                                        }, $matchingScoreNutrisi);

                                        $resultOutput = implode($resultValues);
                                        echo "<td class='text-center fw-bold' colspan='3'>{$resultOutput}</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center' colspan='3'></td>";
                            }
                            ?>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td colspan="24"></td>
                            <td colspan="3">Paraf</td>
                            <td colspan="15"></td>
                            <td colspan="3">Paraf</td>
                            <td colspan="24"></td>
                            <td colspan="3">Paraf</td>
                        </tr>

                        <tr>
                            <td style="writing-mode: vertical-rl;" colspan="5" class="fw-bold text-center align-middle">TINDAKAN
                            </td>
                            <td colspan="24">
                                <span class="fw-bold">Shift 06:00 - 14:00</span><br>
                                <?php
                                $filteredDataShiftImplemntasiPagi = array_filter($item['data_implementasi'], function ($item) {
                                    $hour = date('H', strtotime($item['treat_date']));
                                    return ($hour >= 6 && $hour < 14);
                                });

                                if (!empty($filteredDataShiftImplemntasiPagi)) {
                                    foreach ($filteredDataShiftImplemntasiPagi as $row) {
                                        echo date('H:i', strtotime($row['treat_date'])) . " - " . $row['treatment'] . "<br>";
                                    }
                                } else {
                                    echo " ";
                                }
                                ?>
                            </td>
                            <td colspan="3"></td>
                            <td colspan="15">
                                <span class="fw-bold">Shift 15:00 - 20:00</span><br>
                                <?php
                                $filteredDataShiftImplemntasiSiang = array_filter($item['data_implementasi'], function ($item) {

                                    $hour = date('H', strtotime($item['treat_date']));
                                    return ($hour >= 15 && $hour < 20);
                                });

                                if (!empty($filteredDataShiftImplemntasiSiang)) {
                                    foreach ($filteredDataShiftImplemntasiSiang as $row) {
                                        echo date('H:i', strtotime($row['treat_date'])) . " - " . $row['treatment'] . "<br>";
                                    }
                                } else {
                                    echo " ";
                                }
                                ?>
                            </td>
                            <td colspan="3"></td>
                            <td colspan="24">
                                <span class="fw-bold">Shift 21:00 - 05:00</span><br>
                                <?php
                                $filteredDataShiftImplemntasiMalam = array_filter($item['data_implementasi'], function ($item) {

                                    $hour = date('H', strtotime($item['treat_date']));
                                    return ($hour >= 21 && $hour < 5);
                                });

                                if (!empty($filteredDataShiftImplemntasiMalam)) {
                                    foreach ($filteredDataShiftImplemntasiMalam as $row) {
                                        echo date('H:i', strtotime($row['treat_date'])) . " - " . $row['treatment'] . "<br>";
                                    }
                                } else {
                                    echo " ";
                                }
                                ?>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="fw-bold text-center align-middle">CATATAN PENTING:
                            </td>
                            <td colspan="24">
                                <?php
                                $start = isset($_GET['start']) ? $_GET['start'] : null;
                                $end = isset($_GET['end']) ? $_GET['end'] : null;

                                if ($start && $end) {
                                    $startFormat = new DateTime($start, new DateTimeZone('UTC'));
                                    $endFormat = new DateTime($end, new DateTimeZone('UTC'));

                                    $startFormat->setTimezone(new DateTimeZone('Asia/Jakarta'));
                                    $endFormat->setTimezone(new DateTimeZone('Asia/Jakarta'));


                                    $startLocal = $startFormat->format("Y-m-d H:i");
                                    $endLocal = $endFormat->format("Y-m-d H:i");

                                    $datavalueindex = array_values($data);
                                    $lengthvalueindex = count($datavalueindex);
                                    $firstKeyData = key($datavalueindex);
                                    $lastKeyData = key(array_slice($datavalueindex, -1, 1, true));

                                    $startFormatPlush = new DateTime($start, new DateTimeZone('UTC'));
                                    $startPlushDay = $startFormatPlush->modify("+1 day");
                                    $startPlushResult = $startFormatPlush->setTime("24", "00");

                                    $endFormatPlush = new DateTime($end, new DateTimeZone('UTC'));
                                    $endPlushDay = $endFormatPlush->modify("-1 day");
                                    $endPlushResult = $endFormatPlush->setTime("24", "00");

                                    $firstKeyDataVt = array_key_first($item['data_vt']);
                                    $firstValue = $item['data_vt'][$firstKeyDataVt];



                                    if ($firstKeyData === $index) {
                                        if ($lengthvalueindex === 1) {
                                            $resultDateTime = $startFormat->diff($endFormat);
                                            $hoursResultData = $resultDateTime->h + ($resultDateTime->days * 24);
                                        } else {
                                            $resultDateTime = $startFormat->diff($startPlushResult);
                                            $hoursResultData = $resultDateTime->h + ($resultDateTime->days * 24);
                                        }
                                    } elseif ($lastKeyData === $index) {
                                        $resultDateTime = $endPlushResult->diff($endFormat);
                                        $hoursResultData = $resultDateTime->h + ($resultDateTime->days * 24);
                                    } else {
                                        $hoursResultData = 24;
                                    }


                                    // ==================
                                    $allowedTypesDataUrineV2 = ["G0230303"];

                                    $filteredDataUrineV2 = array_filter($item['data_cairan'], function ($item) use ($allowedTypesDataUrineV2) {
                                        return in_array($item['fluid_type'], $allowedTypesDataUrineV2);
                                    });

                                    $totalFluidUrineV2 = array_sum(array_column($filteredDataUrineV2, 'fluid_amount'));


                                    $allowedTypesDataOutputV2 = ["G0230304", "G0230306", "G0230307", "G0230303", "G0230305"];

                                    $filteredDataOutputV2 = array_filter($item['data_cairan'], function ($item) use ($allowedTypesDataOutputV2) {
                                        return in_array($item['fluid_type'], $allowedTypesDataOutputV2);
                                    });

                                    $totalFluidOutputV2 = array_sum(array_column($filteredDataOutputV2, 'fluid_amount'));

                                    $allowedTypesDataInputV2 = ["G0230309", "G0230302", "G0230301"];

                                    $filteredDataInputV2 = array_filter($item['data_cairan'], function ($item) use ($allowedTypesDataInputV2) {
                                        return in_array($item['fluid_type'], $allowedTypesDataInputV2);
                                    });

                                    $totalFluidInputV2 = array_sum(array_column($filteredDataInputV2, 'fluid_amount'));


                                    $data_vtV2 = $item['data_vt'];

                                    usort($data_vtV2, function ($a, $b) {
                                        return strtotime($b['examination_date']) - strtotime($a['examination_date']);
                                    });

                                    $data_terbaruV2 = $data_vtV2[0];

                                    $tgl_lahirV2 = new DateTime($visit['tgl_lahir']);
                                    $visit_datetimeV2 = new DateTime();

                                    $umurV2 = $tgl_lahirV2->diff($visit_datetimeV2);
                                    $age_konstaIwlV2 = $umurV2->y;

                                    if ($age_konstaIwlV2 <= 1) {
                                        $konsta_iwlV2 = 50;
                                    } elseif ($age_konstaIwlV2 <= 12) {
                                        $konsta_iwlV2 = 40;
                                    } elseif ($age_konstaIwlV2 <= 60) {
                                        $konsta_iwlV2 = 30;
                                    } elseif ($age_konstaIwlV2 <= 120) {
                                        $konsta_iwlV2 = 20;
                                    } else {
                                        $konsta_iwlV2 = 10;
                                    }

                                    $resultIwlV2 = $data_terbaru['weight'] * $konsta_iwlV2 / 24;
                                    $resultIwlShiftV2 = $resultIwlV2 * $hoursResultData;
                                    $resultBcV2 = $totalFluidInputV2 - ($totalFluidOutputV2 + $resultIwlShiftV2);
                                    if ($data_terbaruV2['weight'] != 0 && $hoursResultData != 0) {
                                        $resultDiuresisV2 = number_format(($totalFluidUrineV2 / $data_terbaruV2['weight'] / $hoursResultData), 2);
                                    } else {
                                        $resultDiuresisV2 = 0;
                                    }


                                    echo "
                        <h6 class='fw-bold text-center'>Shift $hoursResultData Jam </h6>
                        <table class='w-100'>
                                <tr>
                                    <td>
                                    <table>
                                        <tr class='fw-bold'>
                                            <td>Input</td>
                                            <td>:</td>
                                            <td >$totalFluidInputV2</td>
                                        </tr>
                                        <tr class='fw-bold'>
                                            <td>Output</td>
                                            <td>:</td>
                                            <td>$totalFluidOutputV2</td>
                                        </tr>
                                        <tr class='fw-bold'>
                                            <td>IWL</td>
                                            <td>:</td>
                                            <td>$resultIwlShiftV2</td>
                                        </tr>
                                    </table>
                                    </td>
                                    <td>
                                    <table>
                                        <tr class='fw-bold'>
                                            <td>BC</td>
                                            <td>:</td>
                                            <td> $resultBcV2 </td>
                                        </tr>
                                        <tr class='fw-bold'>
                                            <td>Urine</td>
                                            <td>:</td>
                                            <td> $totalFluidUrineV2 </td>
                                        </tr>
                                        <tr class='fw-bold'>
                                            <td>Diuresis</td>
                                            <td>:</td>
                                            <td>$resultDiuresisV2</td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                                </table>";
                                }
                                ?>
                            </td>
                            <td colspan="3"></td>
                            <td colspan="15"></td>
                            <td colspan="3"></td>
                            <td colspan="24"></td>
                            <td colspan="3"></td>
                        </tr>




                    </tbody>
                </table>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {


                    let dataVT = <?= json_encode($item['data_vt']) ?>;
                    const extractedData = dataVT.map(item => {
                        const hour = parseInt(item.examination_date.split(' ')[1].split(':')[0], 10);
                        return {
                            hour,
                            temperature: parseFloat(item.temperature),
                            tension_upper: parseFloat(item.tension_upper),
                            tension_below: parseFloat(item.tension_below),
                            nadi: parseFloat(item.nadi),
                            nafas: parseFloat(item.nafas),
                            saturasi: parseFloat(item.saturasi)
                        };
                    });

                    const firstHour = extractedData.reduce((min, item) => Math.min(min, item.hour), 24);

                    const hours = [];
                    for (let i = firstHour; i < firstHour + 24; i++) {
                        hours.push(i > 24 ? i - 24 : i);
                    }

                    const formattedHours = hours.map(hour => (hour === 0 ? 24 : hour));

                    const temperatureData = Array(24).fill(0);
                    const tensionUpperData = Array(24).fill(0);
                    const tensionBelowData = Array(24).fill(0);
                    const nadiData = Array(24).fill(0);
                    const nafasData = Array(24).fill(0);
                    const saturasiData = Array(24).fill(0);

                    extractedData.forEach(item => {
                        const index = hours.indexOf(item.hour);
                        if (index !== -1) {
                            temperatureData[index] = item.temperature ?? 0;
                            nadiData[index] = item.nadi ?? 0;
                            nafasData[index] = item.nafas ?? 0;
                            tensionUpperData[index] = item.tension_upper ?? 0;
                            tensionBelowData[index] = item.tension_below ?? 0;
                        }
                    });

                    const ctx = document.getElementById('myChartVt-<?= $index ?>').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            // labels: formattedHours,
                            datasets: [{
                                    label: 'SUHU (°C)',
                                    data: formattedHours.map((val, index) => ({
                                        x: val,
                                        y: temperatureData[index]
                                    })),
                                    borderColor: 'red',
                                    backgroundColor: 'rgba(255, 0, 0, 0.1)',
                                    fill: true
                                },
                                {
                                    label: 'TEKANAN DARAH',
                                    data: formattedHours.map((val, index) => ({
                                        x: val,
                                        y: tensionUpperData[index]
                                    })),
                                    borderColor: 'blue',
                                    backgroundColor: 'rgba(0, 0, 255, 0.1)',
                                    fill: true
                                },
                                {
                                    label: 'TEKANAN DARAH',
                                    data: formattedHours.map((val, index) => ({
                                        x: val,
                                        y: tensionBelowData[index]
                                    })),
                                    borderColor: 'cyan',
                                    backgroundColor: 'rgba(0, 255, 255, 0.1)',
                                    fill: true
                                },
                                {
                                    label: 'Nadi (HR)',
                                    data: formattedHours.map((val, index) => ({
                                        x: val,
                                        y: nadiData[index]
                                    })),
                                    borderColor: 'green',
                                    backgroundColor: 'rgba(0, 255, 0, 0.1)',
                                    fill: true
                                },
                                {
                                    label: 'FREK. NAFAS (RR)',
                                    data: formattedHours.map((val, index) => ({
                                        x: val,
                                        y: nafasData[index]
                                    })),
                                    borderColor: 'orange',
                                    backgroundColor: 'rgba(255, 165, 0, 0.1)',
                                    fill: true
                                },

                            ]
                        },
                        options: {
                            legend: {
                                display: true
                            },
                            scales: {
                                xAxes: [{
                                    type: 'linear',
                                    position: 'top',
                                    ticks: {
                                        stepSize: 1,
                                        // reverse: true
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        // min: 0,
                                        // max: 200
                                    }
                                }]
                            }
                        }
                    });

                });
            </script>
        <?php endforeach; ?>
    <?php
    }
    ?>
</body>



<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateRangeModalLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dateRangeForm">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Tanggal Mulai</label>
                        <input type="text" id="startDate" class="form-control date-timepicker" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Tanggal Akhir</label>
                        <input type="text" id="endDate" class="form-control date-timepicker" required>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100">Generate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                This modal cannot be closed by clicking outside of it or pressing escape.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<style>
    @media print {
        @page {
            margin: none;
            size: A2 landscape;
        }

        .dot1,
        .dot2,
        .dot3,
        .dot4,
        .dot5,
        .dot6,
        .dot7,
        .dot8 {
            visibility: visible !important;
            display: inline !important;
        }

        /* 
    body {
        font-size: 0.3vw;
    } */

        .container {
            /* width: 210mm; */
        }

    }
</style>
<script type="text/javascript">
    $(document).ready(function() {

        function getUrlParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                start: params.get('start'),
                end: params.get('end'),
            };
        }
        const {
            start,
            end
        } = getUrlParams();

        if (!start || !end) {
            $("#startDate").val(moment(new Date()).format("DD/MM/YYYY HH:00"))
            $("#endDate").val(moment(new Date()).format("DD/MM/YYYY HH:00"))
            $("#dateRangeModal").modal("show");
        } else {
            // console.log(`Tanggal Start: ${start}, Tanggal End: ${end}`);
            let datasss = <?= json_encode(@$data) ?>;

            if (Object.keys(datasss).length) {
                setTimeout(() => {
                    // window.print();

                }, 200);
            }

        }

        flatpickr(".date-timepicker", {
            enableTime: true,
            dateFormat: "d/m/Y H:i",
            time_24hr: true,
            allowInput: true,
            onChange: function(selectedDates, dateStr, instance) {}
        });

        $(".date-timepicker").removeAttr("readonly");

        btnAction()
    });


    const btnAction = (props) => {
        $("#dateRangeForm").on("submit", function(e) {
            e.preventDefault();

            const startDate = $("#startDate").val();
            const endDate = $("#endDate").val();

            const resultList = $("#result");
            const outsideResultList = $("#outsideResult");

            resultList.empty();
            outsideResultList.empty();

            const dates = generateDateRange(convertLabDate(startDate), convertLabDate(endDate));

            if (dates.length > 0) {
                dates.forEach(function(date) {
                    resultList.append(`<li class="list-group-item">${date}</li>`);
                    outsideResultList.append(`<li class="list-group-item">${date}</li>`);
                });

                const newUrl =
                    `${window.location.origin}${window.location.pathname}?start=${convertLabDate(startDate)}&end=${convertLabDate(endDate)}`;
                window.history.pushState({
                    path: newUrl
                }, "", newUrl);
            }

            $("#dateRangeModal").modal("hide");
            window.location.reload();
        });

        const convertLabDate = (dateString) => {
            const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
            const parsedDate = moment(dateString, formats, true);

            if (parsedDate.isValid()) {
                return parsedDate.utc().toISOString();
            } else {
                return null;
            }
        };



        function generateDateRange(start, end) {
            const startDate = new Date(start);
            const endDate = new Date(end);
            const dates = [];

            while (startDate <= endDate) {
                dates.push(startDate.toISOString().split("T")[0]);
                startDate.setDate(startDate.getDate() + 1);
            }

            return dates;
        }



    }
</script>




</html>