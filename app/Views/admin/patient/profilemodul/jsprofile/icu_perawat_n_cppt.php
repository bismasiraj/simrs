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
    <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>
    <script src="<?= base_url('/assets/js/default.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                //   echo json_encode($data, JSON_PRETTY_PRINT);

         ?>
    <?php foreach ($data as $index => $item): ?>
    <?php 
        $filteredData = array_filter($item['data_odd'], function($item) {
            return isset($item['signa_4']) && strpos($item['signa_4'], 'p.o') !== false;
        });
        $lenghtodd = count($filteredData);
        $filteredDataPaternal = array_filter($item['data_odd'], function($item) {
            return isset($item['signa_4']) && strpos($item['signa_4'], 'i.v') !== false;
        });
        $lenghtoddPaternal = count($filteredDataPaternal);

        $filteredDataCairan = array_filter($item['data_cairan'], function($item) {
            return isset($item['fluid_type']) && strpos($item['fluid_type'], 'G0230302') !== false;
        });
        $lenghtcairanIn = count($filteredDataCairan);
        $filteredDataCairanE = array_filter($item['data_cairan'], function($item) {
            return isset($item['fluid_type']) && strpos($item['fluid_type'], 'G0230309') !== false;
        });
        $lenghtcairanInE = count($filteredDataCairanE);

        


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
                        <p class="" style="display: flex; flex-direction: column;">
                            <span style="display: flex; justify-content: space-between;">
                                <span>HARI / TANGGAL</span>
                                <span>:</span>
                            </span>
                            <span style="display: flex; justify-content: space-between;">
                                <span>TANGGAL MRS</span>
                                <span>:</span>
                            </span>
                            <span style="display: flex; justify-content: space-between;">
                                <span>HARI RAWAT KE</span>
                                <span>:</span>
                            </span>
                            <span style="display: flex; justify-content: space-between;">
                                <span>BB/TB</span>
                                <span>:</span>
                            </span>
                            <span style="display: flex; justify-content: space-between;">
                                <span>GOL. DARAH / RH</span>
                                <span>:</span>
                            </span>
                        </p>
                    </td>
                    <td colspan="18" rowspan="7">
                        <p class="">
                        <div style="display: flex; justify-content: space-between;">
                            <span>DOKTER DPJP</span>
                            <span>: <?= @$visit['fullname'] ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>DOKTER ANASTESI</span>
                            <span>:</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>RABERAN</span>
                            <span>:</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <span>1.</span>
                            <span>3.</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <span>2.</span>
                            <span>4.</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <span>PERAWAT PENANGGUNG JAWAB</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>1. PERAWAT PAGI</span>
                            <span>:</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>2. PERAWAT SIANG</span>
                            <span>:</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>2. PERAWAT MALAM</span>
                            <span>:</span>
                        </div>
                        </p>
                    </td>

                    <td colspan="21" rowspan="1">
                        <p class="" style="display: flex; justify-content: space-between;">
                            <span class="d-block">DIAGNOSA MEDIS</span>
                            <?php 
                            $uniqueDiagnosaNames = array_unique(array_column($diag, 'diagnosa_name'));
                            $diagnosaList = implode(', ', $uniqueDiagnosaNames);
                            echo "<span class='d-block'>: {$diagnosaList}</span>";
                            ?>
                        </p>
                        <p class="" style="display: flex; justify-content: space-between;">
                            <span class="d-block">TIPE OPERASI</span>
                            <span class="d-block">:<?= 
                            @$oprs['tarif_id']?></span>
                        </p>
                        <p class="" style="display: flex; justify-content: space-between;">
                            <span class="d-block">POST OP HARI KE</span>
                            <span class="d-block">:</span>
                        </p>
                    </td>

                    <td colspan="21" rowspan="1">
                        <div class="text-center mb-2">
                            <p class=" fw-bold">IDENTITAS PASIEN</p>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">NAMA/UMUR</span>
                                <span> : <?= @$visit['diantar_oleh']; ?> / <?= @$visit['ageyear']; ?></span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">NO RM</span>
                                <span> : <?= @$visit['no_registration']; ?></span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">JENIS KELAMIN</span>
                                <span>
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
                                <span class="fw-bold">NO BED</span>
                                <span>: <?= @$visit['class_room']; ?></span>
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
                        <?=@$toolVena['tool_location'] ?>
                    </td>
                    <td colspan="3" rowspan="1">
                        <?=@$toolVena['tool_size'] ?>

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
                        <?=@$toolNgt['tool_location'] ?>
                    </td>
                    <td colspan="3" rowspan="1">
                        <?=@$toolNgt['tool_size'] ?>

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
                        <?=@$toolUrin['tool_location'] ?>
                    </td>
                    <td colspan="3" rowspan="1">
                        <?=@$toolUrin['tool_size'] ?>

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
                        <?=@$toolEtt['tool_location'] ?>
                    </td>
                    <td colspan="3" rowspan="1">
                        <?=@$toolEtt['tool_size'] ?>

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
                        <?=@$toolLine['tool_location'] ?>
                    </td>
                    <td colspan="3" rowspan="1">
                        <?=@$toolLine['tool_size'] ?>

                    </td>

                </tr>
                <!-- chart  -->

                <tr>
                    <!-- <td colspan="73">chart</td> -->
                    <td colspan="77" class="text-center">
                        <div style="width: 95%; margin: auto;">
                            <canvas id="myChartVt-<?= $index?>" width="800" height="400"></canvas>
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
                            usort($item['data_gcs'], function($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            
                            $firstExaminationDate = $item['data_gcs']? $item['data_gcs'][0]['examination_date'] :[];
                            $firstHour =  $firstExaminationDate ?(int)date('H', strtotime($firstExaminationDate)):"";
                            $allColumns = $firstHour?array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : "";

                            foreach ($item['data_gcs'] as $gcsRow) {
                                $examinationDate = $gcsRow['examination_date']; 
                                $hour = date('H', strtotime($examinationDate));

                                $colNumber = (int)$hour; 
                                
                                if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                    echo "<td colspan='3' class='text-center'>{$hour}</td>";
                                    $displayedColumns[] = $colNumber; 
                                }
                            }
                            
                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    if (!in_array($i, $displayedColumns)) {
                                        echo "<td colspan='3' class='text-center'>{$i}</td>";
                                    }
                                }
                            } else {
                                echo "<td colspan='3' class='text-center'></td>";
                            }
                            
                            ?>
                </tr>

                <!-- data bawah  -->
                <tr>
                    <td colspan="5">GCS(EVM)</td>
                    <?php
                        $displayedColumns = [];
                        foreach ($item['data_gcs'] as $gcsRow) {
                            $examinationDate = $gcsRow['examination_date']; 
                            $hour = date('H', strtotime($examinationDate)); 

                            $colNumber = (int)$hour; 
                            
                            if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                echo "<td class='text-center'>e : {$gcsRow['gcs_e']}</td>";
                                echo "<td class='text-center'>v : {$gcsRow['gcs_v']}</td>";
                                echo "<td class='text-center'>m : {$gcsRow['gcs_m']}</td>";
                                $displayedColumns[] = $colNumber; 
                            }
                        }

                        if (!empty($allColumns)) {
                            foreach ($allColumns as $i) {
                                if (!in_array($i, $displayedColumns)) {
                                    echo "<td colspan='3' class='text-center'></td>";
                                }
                            }
                        } else {
                            echo "<td colspan='3' class='text-center'></td>";
                        }
                        ?>
                </tr>
                <tr>
                    <td colspan="5">KESADARAN</td>
                    <?php
                    $displayedColumns = [];
                    foreach ($item['data_gcs'] as $gcsRow) {
                        $examinationDate = $gcsRow['examination_date']; 
                        $hour = date('H', strtotime($examinationDate)); 
                        $colNumber = (int)$hour; 
                        
                        if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                            echo "<td class='text-center' colspan='3'>{$gcsRow['gcs_desc']}</td>";
                            $displayedColumns[] = $colNumber; 
                        }
                    }
                    

                    if (!empty($allColumns)) {
                        foreach ($allColumns as $i) {
                            if (!in_array($i, $displayedColumns)) {
                                echo "<td colspan='3' class='text-center'>{$i}</td>";
                            }
                        }
                    } else {
                        echo "<td colspan='3' class='text-center'></td>";
                    }
                    ?>
                </tr>
                <tr>
                    <td colspan="5">ECG MONITORING (RYHTM)</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                    <td colspan="3">1</td>
                </tr>
                <tr>
                    <td colspan="5">PUPIL MATA</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="1" rowspan="<?= $lenghtodd + 7 +$lenghtoddPaternal  ?>"
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
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="5">EXTREMITAS KAKI</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                    <td colspan="2">1</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td colspan="5">RR</td>
                    <?php
                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = []; 

                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                        $firstHour =$firstExaminationDate? (int)date('H', strtotime($firstExaminationDate)):"";

                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                        if (!empty($allColumns)) {
                            foreach ($allColumns as $i) {
                                $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                    return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                }));
    
                                // $matchingVtData = array_filter($item['data_vt'], function($vtRow) use ($i) {
                                //     return (int)date('H', strtotime($vtRow['examination_date'])) === $i;
                                // });
                                $matchingVtData = array_filter($item['data_vt'], function($vtRow) use ($i) {
                                    $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                    $hour = $hour === 0 ? 24 : $hour;
                                    return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null 
                                        && $hour === $i ;
                                        // && $vtRow['body_id'] === $result['body_id'];
                                });
    
                                if (!empty($matchingVtData)) {
                                    $nafasValues = array_map(function($vtRow) {
                                        return $vtRow['nafas'];
                                    }, $matchingVtData);
    
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
                    <td colspan="5">SPO2</td>
                    <?php
                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = []; 

                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                        $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";

                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                        if (!empty($allColumns)) {
                            foreach ($allColumns as $i) {
                                $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                    return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                }));
    
                                $matchingVtData = array_filter($item['data_vt'], function($vtRow) use ($i) {
                                    $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                    $hour = $hour === 0 ? 24 : $hour;
                                    return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null 
                                        && $hour === $i ;
                                        // && $vtRow['body_id'] === $result['body_id'];
                                });

                                // $matchingVtData = array_filter($item['data_vt'], function($vtRow) use ($i,$result) {
                                    
                                //     return (int)date('H', strtotime($vtRow['examination_date'])) === $i  && $vtRow['body_id'] === $result['body_id'];
                                // });
                                
                                if (!empty($matchingVtData)) {
                                    // echo json_encode($matchingVtData, JSON_PRETTY_PRINT);
                                    $nafasValues = array_map(function($vtRow) {
                                        return $vtRow['saturasi'];
                                    }, $matchingVtData);
    
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
                    <td rowspan="<?=$lenghtodd + 1?>"></td>
                    <td>Obat ETERNAL</td>
                    <td>INDIKASI</td>
                    <td>RUTE</td>
                    <td>DOSIS</td>
                    <?php
                            usort($item['data_gcs'], function($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            
                            $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                           $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                            $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                            foreach ($item['data_gcs'] as $gcsRow) {
                                $examinationDate = $gcsRow['examination_date']; 
                                $hour = date('H', strtotime($examinationDate));

                                $colNumber = (int)$hour; 
                                
                                if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                    echo "<td colspan='3' class='text-center'>{$hour}</td>";
                                    $displayedColumns[] = $colNumber; 
                                }
                            }

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    if (!in_array($i, $displayedColumns)) {
                                        echo "<td colspan='3' class='text-center'>{$i}</td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }
                            ?>
                </tr>
                <?php
                //   echo json_encode($item['data_odd'], JSON_PRETTY_PRINT);
                    ?>

                <?php foreach ($item['data_odd'] as $indexOddEnternal => $result): ?>
                <?php 
                            if (isset($result['signa_4']) && strpos($result['signa_4'], 'p.o') !== false): 
                        ?>
                <tr>
                    <td><?= $result['nama_obat'] ?></td>
                    <td><?= $result['signa_1'] ?? $result['description2'] ?></td>
                    <td><?= $result['signa_4'] ?></td>
                    <td><?= $result['dose_presc'] ?></td>

                    <?php
                                usort($item['data_gcs'], function($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $displayedColumns = [];

                                $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                               $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;

                                $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                

                                if (!empty($allColumns)) {
                                    foreach ($allColumns as $i) {
                                        $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                            return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                        }));
    
                                        if ($gcsRow === false) {
                                            $gcsRow = null;
                                        }
    
                                        $matchingOddoralData = array_filter($item['data_odd'], function($oddRow) use ($i, $result) {
                                            return isset($oddRow['received_date']) && $oddRow['received_date'] !== null 
                                                && (int)date('H', strtotime($oddRow['received_date'])) === $i 
                                                && $oddRow['vactination_id'] === $result['vactination_id']
                                                && isset($oddRow['signa_4']) && strpos($oddRow['signa_4'], 'p.o') !== false; 
                                        });
    
                                        if (!empty($matchingOddoralData)) {
                                            echo "<td class='text-center fw-bold' colspan='3'>?</td>";
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
                    <td rowspan="<?=$lenghtoddPaternal + 1 +$lenghtcairanIn + $lenghtcairanInE + 1?>"></td>
                    <td>Obat PARENTERAL</td>
                    <td>INDIKASI</td>
                    <td>RUTE</td>
                    <td>DOSIS</td>
                    <?php
                            usort($item['data_gcs'], function($a, $b) {
                                return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                            });

                            $displayedColumns = [];
                            $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                           $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                            $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                            foreach ($item['data_gcs'] as $gcsRow) {
                                $examinationDate = $gcsRow['examination_date']; 
                                $hour = date('H', strtotime($examinationDate));

                                $colNumber = (int)$hour; 
                                
                                if (!in_array($colNumber, $displayedColumns) && $colNumber >= 1 && $colNumber <= 24) {
                                    echo "<td colspan='3' class='text-center'>{$hour}</td>";
                                    $displayedColumns[] = $colNumber; 
                                }
                            }

                            if (!empty($allColumns)) {
                                foreach ($allColumns as $i) {
                                    if (!in_array($i, $displayedColumns)) {
                                        echo "<td colspan='3' class='text-center'>{$i}</td>";
                                    }
                                }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }
                            ?>
                </tr>

                <?php foreach ($item['data_odd'] as $indexOddPaternal => $result): ?>
                <?php 
                            if (isset($result['signa_4']) && strpos($result['signa_4'], 'i.v') !== false): 
                        ?>
                <tr>
                    <td><?= $result['nama_obat'] ?></td>
                    <td><?= $result['signa_1'] ?? $result['description2'] ?></td>
                    <td><?= $result['signa_4'] ?></td>
                    <td><?= $result['dose_presc'] ?></td>

                    <?php
                                usort($item['data_gcs'], function($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $displayedColumns = [];

                                $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                               $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;

                                $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                if (!empty($allColumns)) {
                                    foreach ($allColumns as $i) {
                                        $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                            return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                        }));
    
                                        if ($gcsRow === false) {
                                            $gcsRow = null;
                                        }
    
                                        $matchingOddoralData = array_filter($item['data_odd'], function($oddRow) use ($i, $result) {
                                            return isset($oddRow['received_date']) && $oddRow['received_date'] !== null 
                                                && (int)date('H', strtotime($oddRow['received_date'])) === $i 
                                                && $oddRow['vactination_id'] === $result['vactination_id']
                                                && isset($oddRow['signa_4']) && strpos($oddRow['signa_4'], 'i.v') !== false; 
                                        });
    
                                        if (!empty($matchingOddoralData)) {
                                            echo "<td class='text-center fw-bold' colspan='3'>?</td>";
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


                <?php foreach ($item['data_cairan'] as $indexcairanIn => $result): ?>
                <?php 
                
                // echo json_encode($result, JSON_PRETTY_PRINT);
                if (isset($result['fluid_type']) && strpos($result['fluid_type'], 'G0230302') !== false): 

                        ?>
                <tr>
                    <td colspan="4"><?= @$result['balance_category'] ?></td>
                    <?php
                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];

                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;

                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $i) {
                                $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                    return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                }));
            
                                if ($gcsRow === false) {
                                    $gcsRow = null;
                                }
            
                                $matchingcairanInData = array_filter($item['data_cairan'], function($cairanInRow) use ($i, $result) {
                                    return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                        && (int)date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                        && $cairanInRow['body_id'] === $result['body_id']
                                        && isset($cairanInRow['fluid_type']) && strpos($cairanInRow['fluid_type'], 'G0230302') !== false; 
                                });
            
                                if (!empty($matchingcairanInData)) {
                                    $matchingData = reset($matchingcairanInData);
                                    echo "<td class='text-center fw-bold' colspan='3'>" . (int)$matchingData['fluid_amount'] . "</td>";
                                } else {
                                    echo "<td class='text-center' colspan='3'></td>";
                                }
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
                        }

                       
                    ?>
                    <?php if($indexcairanIn === 0): ?>
                    <td rowspan="<?= $lenghtcairanIn +$lenghtcairanInE?>">
                        <h5 class="fw-bold">BESAR PUPIL</h5>
                        <span class="dot1"></span>
                        <span>1</span>
                        <span class="dot2"></span>
                        <span>2</span>
                        <span class="dot3"></span>
                        <span>3</span>
                        <span class="dot4"></span>
                        <span>4</span>
                        <span class="dot5"></span>
                        <span>5</span>
                        <span class="dot6"></span>
                        <span>6</span>
                        <span class="dot7"></span>
                        <span>7</span>
                        <span class="dot8"></span>
                        <span>8</span>
                    </td>
                    <?php endif; ?>

                </tr>
                <?php endif; ?>


                <?php endforeach; ?>
                <?php foreach ($item['data_cairan'] as $indexcairanIn => $result): ?>
                <?php 
                
                // echo json_encode($result, JSON_PRETTY_PRINT);
                if (isset($result['fluid_type']) && strpos($result['fluid_type'], 'G0230309') !== false): 
                        ?>
                <tr>
                    <td colspan="4">Eternal</td>
                    <?php
                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];

                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;

                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                        foreach ($allColumns as $i) {
                            $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                            }));
        
                            if ($gcsRow === false) {
                                $gcsRow = null;
                            }
        
                            $matchingcairanInData = array_filter($item['data_cairan'], function($cairanInRow) use ($i, $result) {
                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                    && (int)date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                    && $cairanInRow['body_id'] === $result['body_id']
                                    && isset($cairanInRow['fluid_type']) && strpos($cairanInRow['fluid_type'], 'G0230309') !== false; 
                            });
        
                            if (!empty($matchingcairanInData)) {
                                $matchingData = reset($matchingcairanInData);
                                echo "<td class='text-center fw-bold' colspan='3'>" . (int)$matchingData['fluid_amount'] . "</td>";
                            } else {
                                echo "<td class='text-center' colspan='3'></td>";
                            }
                        }
                    ?>

                </tr>
                <?php endif; ?>


                <?php endforeach; ?>
                <?php 
                    $totalPerHourCairan = []; 
                                foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230309') !== false || strpos($result['fluid_type'], 'G0230302') !== false)):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'G0230309') !== false || strpos($cairanInRow['fluid_type'], 'G0230302') !== false);
                                            });

                                            if (!empty($matchingcairanInData)) {
                                                $matchingData = reset($matchingcairanInData);
                                                $hour = (int) date('H', strtotime($matchingData['examination_date']));
                                                
                                                if (!isset($totalPerHourCairan[$hour])) {
                                                    $totalPerHourCairan[$hour] = 0;
                                                }

                                                $totalPerHourCairan[$hour] += (int) $matchingData['fluid_amount'];
                                            }
                                        }
                                        endif;
                                        endforeach;

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                        echo "<tr>\n    <td colspan='4'>Total</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourCairan[$hour] ?? 0; 
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                        } else {
                            echo "<td class='text-center'  colspan='3'></td>";
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
                                foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230303') !== false )):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'G0230303') !== false );
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

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

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
                             
                                foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230304') !== false )|| strpos($result['fluid_type'], 'G0230305') !== false):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'G0230304') !== false|| strpos($cairanInRow['fluid_type'], 'G0230305') !== false );
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

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

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
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230307') !== false )):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'G0230307') !== false );
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

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

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
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'a') !== false )):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'a') !== false );
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

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                       $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                        echo "<tr>\n 
                        <td colspan='4'>DEFEKASI/KOLOSTOMI</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourkosong[$hour] ?? ''; 
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }
                        
                        echo "<td rowspan='4'><b>BALANS CAIRAN</b>
                        <p>Masuk cc</p>
                        <p>Keluar cc</p>
                        <p>IWL cc</p>
                        <p>BC 24 cc</p>
                        <p>Bcsblm cc</p>
                        <p>BC kum cc</p>
                        
                        
                        </td>";
                echo "</tr>";
                ?>

                <?php 
                             $totalPerHourBab = []; 
                             
                                foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230306') !== false )):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'G0230306') !== false );
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

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                        $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)) : "";
                        
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

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
                             
                                foreach ($item['data_cairan'] as $indexcairanIn => $result):
                                    if (isset($result['fluid_type']) && (strpos($result['fluid_type'], 'G0230306') !== false ||
                                    strpos($result['fluid_type'], 'G0230307') !== false || strpos($result['fluid_type'], 'G0230304') !== false )||
                                     strpos($result['fluid_type'], 'G0230305') !== false || strpos($result['fluid_type'], 'G0230303') !== false):
                                        usort($item['data_gcs'], function ($a, $b) {
                                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                        });

                                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                        $firstHour = $firstExaminationDate?(int) date('H', strtotime($firstExaminationDate)) :"";
                                        
                                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";
                                        

                                        foreach ($allColumns as $i) {
                                            $matchingcairanInData = array_filter($item['data_cairan'], function ($cairanInRow) use ($i, $result) {
                                                return isset($cairanInRow['examination_date']) && $cairanInRow['examination_date'] !== null 
                                                    && (int) date('H', strtotime($cairanInRow['examination_date'])) === $i 
                                                    && $cairanInRow['body_id'] === $result['body_id']
                                                    && (strpos($cairanInRow['fluid_type'], 'G0230306') !== false ||strpos($cairanInRow['fluid_type'], 'G0230307') !== false
                                                     ||strpos($cairanInRow['fluid_type'], 'G0230304') !== false|| strpos($cairanInRow['fluid_type'], 'G0230305') !== false ||strpos($cairanInRow['fluid_type'], 'G0230303') !== false );
                                            });

                                            if (!empty($matchingcairanInData)) {
                                                $matchingData = reset($matchingcairanInData);
                                                $hour = (int) date('H', strtotime($matchingData['examination_date']));
                                                
                                                if (!isset($totalPerHourAll[$hour])) {
                                                    $totalPerHourAll[$hour] = 0;
                                                }

                                                $totalPerHourAll[$hour] += (int) $matchingData['fluid_amount'];
                                            }
                                        }
                                        endif;
                                        endforeach;

                        usort($item['data_gcs'], function($a, $b) {
                            return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                        });

                        $displayedColumns = [];
                        $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                        $firstHour =$firstExaminationDate? (int)date('H', strtotime($firstExaminationDate)):"";
                        $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                        echo "<tr>\n 
                        <td></td>
                        <td colspan='4' class='fw-bold'>TOTAL OUTPUT</td>";
                        if (!empty($allColumns)) {
                            foreach ($allColumns as $hour) {
                                $total = $totalPerHourAll[$hour] ?? ''; 
                                echo "<td class='text-center fw-bold' colspan='3'>{$total}</td>";
                            }
                            } else {
                                echo "<td class='text-center'  colspan='3'></td>";
                            }
                        
                        echo "</tr>";
                    ?>
                <tr>
                    <td></td>
                    <td colspan="76"></td>
                </tr>

                <?php 
                foreach ($item['data_treat_perawat'] as $indextreat_perawat => $result): ?>

                <tr>
                    <?php if($indextreat_perawat === 0){
                        ?>
                    <td style="writing-mode: vertical-rl;" rowspan="<?=count($item['data_treat_perawat']); ?>"
                        class="fw-bold text-center">INTERVENSI
                        KEPERAWATAN</td>
                    <?php
                    } ?>
                    <td colspan="4"><?= $result['treatment'] ?></td>
                    <?php
                                usort($item['data_gcs'], function($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $displayedColumns = [];

                                $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                                $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";

                                $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                        return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    if ($gcsRow === false) {
                                        $gcsRow = null;
                                    }

                                    $matchingtreatPData = array_filter($item['data_treat_perawat'], function($treatPRow) use ($i, $result) {
                                        return isset($treatPRow['treat_date']) && $treatPRow['treat_date'] !== null 
                                            && (int)date('H', strtotime($treatPRow['treat_date'])) === $i 
                                            && $treatPRow['tarif_id'] === $result['tarif_id'];
                                           
                                    });

                                    if (!empty($matchingtreatPData)) {
                                        echo "<td class='text-center fw-bold' colspan='3'>?</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            ?>

                    <?php if($indextreat_perawat === 0){
                        ?>
                    <td rowspan="<?= count($item['data_treat_perawat']) + 1?>"><b>SKALA NYERI / NUMERIK</b>
                        <p>0 :Tidak ada nyeri</p>
                        <p>1 - 3 : Nyeri ringan</p>
                        <p>4 - 6 : Nyeri sedang</p>
                        <p>7 - 10 :Nyeri berat </p>
                    </td>
                    <?php
                    } ?>
                </tr>

                <?php endforeach; ?>

                <tr>
                    <td></td>
                    <td colspan="76"></td>
                </tr>
                <?php   $filterDataVentilator = array_filter($item['data_exam_agd'], function ($e) {
                        return $e['parameter_id'] === '01';
                        });

                        $filterDataPemeriksaanAgd = array_filter($item['data_exam_agd'], function ($e) {
                            return $e['parameter_id'] === '02';
                            });
                    
                    ?>

                <?php 
                    $indexVentilator= 0; 
                    foreach ($filterDataVentilator as $Ventilator => $result):
                    $indexVentilator++; 
                ?>

                <tr>
                    <?php if($indexVentilator === 1){
                        ?>
                    <td style="writing-mode: vertical-rl;" rowspan="<?=count($filterDataVentilator); ?>"
                        class="fw-bold text-center">DATA VENTILATOR & RESPIRASI</td>
                    <?php
                    } ?>
                    <td colspan="4"><?= $result['treatment_name'] ?></td>
                    <?php
                                usort($item['data_gcs'], function($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $displayedColumns = [];

                                $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                               $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;

                                $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                        return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    if ($gcsRow === false) {
                                        $gcsRow = null;
                                    }

                                    $matchingtreatPData = array_filter($filterDataVentilator, function($treatPRow) use ($i, $result) {
                                        $hour = (int)date('H', strtotime($treatPRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($treatPRow['examination_date']) && $treatPRow['examination_date'] !== null 
                                            && $hour === $i 
                                            && $treatPRow['body_id'] === $result['body_id'];
                                           
                                    });

                                    if (!empty($matchingtreatPData)) {
                                        echo "<td class='text-center fw-bold' colspan='3'>?</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            ?>

                    <?php if($indexVentilator === 1){
                        ?>
                    <td rowspan="<?= count($filterDataVentilator) + 1?>"><b>SKOR RESIKO JATUH / FAIL MORSE SCALE</b>
                        <p>Skor : 0 - 24 : Resiko Rendah (RR)</p>
                        <p>Skor : 25 - 45 : Resiko Sedang (RS)</p>
                        <p>Skor : > 45 : Resiko Tinggi (RT)</p>
                    </td>
                    <?php
                    } ?>
                </tr>

                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td colspan="76"></td>
                </tr>

                <?php 
                    $indexPemeriksaanAgd = 0; 
                    foreach ($filterDataPemeriksaanAgd as $PemeriksaanAgd => $result): 
                        $indexPemeriksaanAgd++; 
                    ?>
                <tr>
                    <?php
                    if($indexPemeriksaanAgd === 1){
                        ?>
                    <td style="writing-mode: vertical-rl;" rowspan="<?=count($filterDataPemeriksaanAgd); ?>"
                        class="fw-bold text-center">DATA VENTILATOR & RESPIRASI</td>
                    <?php
                    } ?>
                    <td colspan="4"><?= $result['treatment_name'] ?></td>
                    <?php
                                usort($item['data_gcs'], function($a, $b) {
                                    return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                                });

                                $displayedColumns = [];

                                $firstExaminationDate = $item['data_gcs']?$item['data_gcs'][0]['examination_date'] : [];
                               $firstHour = $firstExaminationDate?(int)date('H', strtotime($firstExaminationDate)):"";;

                                $allColumns = $firstHour? array_merge(range($firstHour, 24), range(1, $firstHour - 1)):"";

                                foreach ($allColumns as $i) {
                                    $gcsRow = current(array_filter($item['data_gcs'], function($gcsRow) use ($i) {
                                        return isset($gcsRow['examination_date']) && (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                                    }));

                                    if ($gcsRow === false) {
                                        $gcsRow = null;
                                    }

                                    $matchingtreatPData = array_filter($filterDataPemeriksaanAgd, function($treatPRow) use ($i, $result) {
                                        $hour = (int)date('H', strtotime($treatPRow['examination_date']));
                                        $hour = $hour === 0 ? 24 : $hour;
                                        return isset($treatPRow['examination_date']) && $treatPRow['examination_date'] !== null 
                                            && $hour === $i 
                                            && $treatPRow['body_id'] === $result['body_id'];
                                           
                                    });

                                    if (!empty($matchingtreatPData)) {
                                        echo "<td class='text-center fw-bold' colspan='3'>?</td>";
                                    } else {
                                        echo "<td class='text-center' colspan='3'></td>";
                                    }
                                }
                            ?>

                    <?php if($indexPemeriksaanAgd === 1){
                        ?>
                    <td rowspan="<?= count($filterDataPemeriksaanAgd) + 3?>"><b>CRITICAL CARE PAIN OBSERVATION TOOL
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
                    usort($item['data_gcs'], function($a, $b) {
                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                    });

                    $displayedColumns = [];

                    $firstExaminationDate = !empty($item['data_gcs']) ? $item['data_gcs'][0]['examination_date'] : null;
                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                    if (!empty($allColumns)) {
                        foreach ($allColumns as $i) {
                            $gcsRow = current(array_filter($item['data_gcs'] ?? [], function($gcsRow) use ($i) {
                                return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                            }));

                            $matchingskalaNyari = array_filter($item['data_skala_nyeri'] ?? [], function($vtRow) use ($i, $result) {
                                $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                $hour = $hour === 0 ? 24 : $hour;
                                return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                    && $hour === $i;
                                    // && $vtRow['body_id'] === $result['body_id'];
                            });

                            if (!empty($matchingskalaNyari)) {
                                $resultValues = array_map(function($vtRow) {
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
                    usort($item['data_gcs'], function($a, $b) {
                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                    });

                    $displayedColumns = [];

                    $firstExaminationDate = !empty($item['data_gcs']) ? $item['data_gcs'][0]['examination_date'] : null;
                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                    if (!empty($allColumns)) {
                        foreach ($allColumns as $i) {
                            $gcsRow = current(array_filter($item['data_gcs'] ?? [], function($gcsRow) use ($i) {
                                return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                            }));

                            $matchingResikoJatuh = array_filter($item['data_resiko_jatuh'] ?? [], function($vtRow) use ($i) {
                                $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                $hour = $hour === 0 ? 24 : $hour;
                                return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                && $hour === $i;
                                // && $vtRow['body_id'] === $result['body_id'];
                            });
                            
                            if (!empty($matchingResikoJatuh)) {
                                $resultValues = array_map(function($vtRow) {
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
                    usort($item['data_gcs'], function($a, $b) {
                        return strtotime($a['examination_date']) - strtotime($b['examination_date']);
                    });

                    $displayedColumns = [];

                    $firstExaminationDate = !empty($item['data_gcs']) ? $item['data_gcs'][0]['examination_date'] : null;
                    $firstHour = $firstExaminationDate ? (int)date('H', strtotime($firstExaminationDate)) : "";

                    $allColumns = $firstHour ? array_merge(range($firstHour, 24), range(1, $firstHour - 1)) : [];

                    if (!empty($allColumns)) {
                        foreach ($allColumns as $i) {
                            $gcsRow = current(array_filter($item['data_gcs'] ?? [], function($gcsRow) use ($i) {
                                return (int)date('H', strtotime($gcsRow['examination_date'])) === $i;
                            }));

                            $matchingScoreNutrisi = array_filter($item['data_score_nutrisi'] ?? [], function($vtRow) use ($i) {
                                $hour = (int)date('H', strtotime($vtRow['examination_date']));
                                $hour = $hour === 0 ? 24 : $hour;
                                return isset($vtRow['examination_date']) && $vtRow['examination_date'] !== null
                                && $hour === $i;
                                // && $vtRow['body_id'] === $result['body_id'];
                            });
                            
                            if (!empty($matchingScoreNutrisi)) {
                                $resultValues = array_map(function($vtRow) {
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

        const temperatureData = Array(24).fill(null);
        const tensionUpperData = Array(24).fill(null);
        const tensionBelowData = Array(24).fill(null);
        const nadiData = Array(24).fill(null);
        const nafasData = Array(24).fill(null);
        const saturasiData = Array(24).fill(null);

        extractedData.forEach(item => {
            const index = hours.indexOf(item.hour);
            if (index !== -1) {
                temperatureData[index] = item.temperature;
                nadiData[index] = item.nadi;
                nafasData[index] = item.nafas;
                tensionUpperData[index] = item.tension_upper;
                tensionBelowData[index] = item.tension_below;
            }
        });

        const ctx = document.getElementById('myChartVt-<?= $index?>').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: formattedHours,
                datasets: [{
                        label: 'SUHU (°C)',
                        data: temperatureData,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        fill: true
                    },
                    {
                        label: 'TEKANAN DARAH',
                        data: tensionUpperData,
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.1)',
                        fill: true
                    },
                    {
                        label: 'TEKANAN DARAH',
                        data: tensionBelowData,
                        borderColor: 'cyan',
                        backgroundColor: 'rgba(0, 255, 255, 0.1)',
                        fill: true
                    },
                    {
                        label: 'Nadi (HR)',
                        data: nadiData,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.1)',
                        fill: true
                    },
                    {
                        label: 'FREK. NAFAS (RR)',
                        data: nafasData,
                        borderColor: 'orange',
                        backgroundColor: 'rgba(255, 165, 0, 0.1)',
                        fill: true
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: '24-Hour Vital Signs Chart'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: ''
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Values'
                        }
                    }
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



<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
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
                        <input type="date" id="startDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Tanggal Akhir</label>
                        <input type="date" id="endDate" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100">Generate</button>
                </form>
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
        $("#startDate").val(moment(new Date()).format("YYYY-MM-DD"))
        $("#endDate").val(moment(new Date()).format("YYYY-MM-DD"))
        $("#dateRangeModal").modal("show");
    } else {
        console.log(`Tanggal Start: ${start}, Tanggal End: ${end}`);
    }
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

        const dates = generateDateRange(startDate, endDate);

        if (dates.length > 0) {
            dates.forEach(function(date) {
                resultList.append(`<li class="list-group-item">${date}</li>`);
                outsideResultList.append(`<li class="list-group-item">${date}</li>`);
            });

            const newUrl =
                `${window.location.origin}${window.location.pathname}?start=${startDate}&end=${endDate}`;
            window.history.pushState({
                path: newUrl
            }, "", newUrl);
        }

        $("#dateRangeModal").modal("hide");
        window.location.reload();
    });

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