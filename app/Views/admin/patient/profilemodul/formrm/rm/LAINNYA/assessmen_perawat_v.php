<!doctype html>
<html lang="en">
<?php

$selectedStatus = isset($_POST['selected-status']) ? $_POST['selected-status'] : '';
$selectedStatusFilter = isset($_POST['selected-status-filter']) ? $_POST['selected-status-filter'] : $data[0]['clinic'];

// var_dump($data[0]);

$validTriage = ["P012",];
$validAnamnesa = ["P012","all"];
$vitailsign = ["P012",'all'];
$pernapasan = ["P012","all"];
$assSirkulasi = ["P012", "all"];
$assNeurosen = ["P012","all"];
$integumen = ["P012"];
$skalanyeri = ["P012", "all"];
$gizi = ["P012", "all"];
$diagPerawat =  ["P012","all"];

//ass new 
$lifestyle = ['all'];
$psikologis = ['all'];
$sosialEkonomi = ['all'];
$childSpecial = ['all'];
$aktivitas= ['all'];
$pencernaan= ['all'];
$perkemihan= ['all'];
$sex= ['all'];
$tht= ['all'];
$sleep= ['all'];



$triageShow =in_array($selectedStatusFilter, $validTriage);
$anamnesaShow =in_array($selectedStatusFilter, $validAnamnesa);
$vitailsignShow =in_array($selectedStatusFilter, $vitailsign);
$pernapasanShow = in_array($selectedStatusFilter, $pernapasan);
$assSirkulasiShow = in_array($selectedStatusFilter, $assSirkulasi);
$assNeurosensorisShow = in_array($selectedStatusFilter, $assNeurosen);
$integumenShow = in_array($selectedStatusFilter, $assNeurosen);
$skalanyeriShow = in_array($selectedStatusFilter, $skalanyeri);
$SkriningGiziShow = in_array($selectedStatusFilter, $gizi);
$diagkeperawatanShow = in_array($selectedStatusFilter, $diagPerawat);

//ass

$historynlifestyleShow = in_array($selectedStatusFilter, $lifestyle);
$psikologisShow = in_array($selectedStatusFilter, $psikologis);
$sosialEkonomiShow = in_array($selectedStatusFilter, $sosialEkonomi);
$childSpecialShow = in_array($selectedStatusFilter, $childSpecial);
$aktivitasShow = in_array($selectedStatusFilter, $aktivitas);
$pencernaanShow = in_array($selectedStatusFilter, $pencernaan);
$perkemihanShow = in_array($selectedStatusFilter, $perkemihan);
$seksualShow = in_array($selectedStatusFilter, $sex);
$thtneyeShow = in_array($selectedStatusFilter, $tht);
$sleepnChillShow = in_array($selectedStatusFilter, $sleep);












// var_dump($data[0]);
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title class="content-title"><?= $data[0]['title']; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- swal -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= base_url('assets/js/default.js') ?>"></script>

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

    @page {
        size: A4;
    }

    body {
        width: 21cm;
        height: 29.7cm;
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

    .o_list_view_ungrouped {
        width: auto !important;
    }
    </style>
</head>
<form method="post" id="filter-form">
    <div class="row date-request pb-3 card-body">
        <div class="col-md-8">
            <div class="form-group">
                <label for="" class="fw-bold">Filter</label>
                <div class="row">
                    <div class="col-md-4">
                        <select id="selected-status" class="form-select" name="selected-status">
                            <option value="1" selected>Rawat Jalan</option>
                            <option value="0">Rawat Inap</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <select id="selected-status-filter" class="form-select" name="selected-status-filter">
                            <option value="all">Assessmen</option>
                            <option value="P012">Asesmen Medis IGD</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<body>
    <div id="data-container">
        <?php foreach ($data as $index => $item): ?>
        <?php
                $kelompok_umur_up = false;  

                if (!empty($item['data']['date_of_birth']) && !empty($item['data']['create_date'])) {
                    $dateOfBirth = strtotime($item['data']['date_of_birth']);
                    $createDate = strtotime($item['data']['create_date']);

                    if ($dateOfBirth && $createDate) {
                        $age = date('Y', $createDate) - date('Y', $dateOfBirth);

                        if (date('md', $createDate) < date('md', $dateOfBirth)) {
                            $age--;
                        }

                        $kelompok_umur_up = true;
                    }
                }
                $isrjResult = false;

                if (empty($item['isrjResult']) && $item['clinic'] !== "P012") {
                    $isrjValue = $item['isrjResult'];
                
                    if ($isrjValue === 0 || $isrjValue === "0") {
                        $isrjResult = true;
                    }
                }

                $isrjResult1 = false;
                    if (empty($item['isrjResult'])) {
                        $isrjValue = $item['isrjResult'];

                        if ($item['clinic'] === "P012") {
                            $isrjResult1 = true;
                        }
                        else if ($isrjValue === 0 || $isrjValue === "0") {
                            $isrjResult1 = true;
                        }
                    }

                var_dump($isrjResult1);


               
            ?>

        <div class="container-fluid mt-5" id="body-show-<?= $index ?>">
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center content-title" id="content-title"><?= @$item['title'] ?></h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Nomor RM</b>
                            <p id="no_registration" class="m-0 mt-1 p-0">
                                <?= isset($visit['no_registration']) && $visit['no_registration'] ? $visit['no_registration'] : '-' ?>
                            </p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Nama Pasien</b>
                            <p id="name_of_pasien" class="m-0 mt-1 p-0">
                                <?= isset($visit['name_of_pasien']) && $visit['name_of_pasien'] ? $visit['name_of_pasien'] : '-' ?>
                            </p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Jenis Kelamin</b>
                            <p id="gendername" class="m-0 mt-1 p-0 ">
                                <?= isset($visit['gendername']) && $visit['gendername'] ? $visit['gendername'] : '-' ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Tanggal Lahir (Usia)</b>
                            <p id="umur-<?= $index ?>" class="m-0 mt-1 p-0 ">
                                <?= 
                        isset($item['data']['date_of_birth']) && $item['data']['date_of_birth'] 
                            ? $item['data']['date_of_birth'] 
                            : DateTime::createFromFormat('Y-m-d H:i:s.u', $visit['tgl_lahir'])->format('d-m-Y')
                    ?>
                            </p>
                        </td>
                        <td class="p-1" style="width:66.3%" colspan="2">
                            <b>Alamat Pasien</b>
                            <p id="alamat-<?= $index ?>" class="m-0 mt-1 p-0">
                                <?= isset($item['data']['alamat']) && $item['data']['alamat'] ? $item['data']['alamat'] : '-' ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p id="dpjp-<?= $index ?>" class="m-0 mt-1 p-0">
                                <?= isset($item['data']['dpjp']) && $item['data']['dpjp'] ? $item['data']['dpjp'] : '-' ?>
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p id="departement-<?= $index ?>" class="m-0 mt-1 p-0">
                                <?= isset($item['data']['departement']) && $item['data']['departement'] ? $item['data']['departement'] : '-' ?>
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p id="tanggal_masuk-<?= $index ?>" class="m-0 mt-1 p-0 ">
                                <?= isset($item['data']['tanggal_masuk']) && $item['data']['tanggal_masuk'] ? $item['data']['tanggal_masuk'] : '-' ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="triage" id="triageShow" style="display: <?php echo $triageShow ? '' : 'none'; ?>;">
                <div class="row">
                    <h4 class="text-start">Triage</h4>
                </div>
                <?=
                   @$item['data']['triage_desc'];

                    
                ?>
            </div>

            <div class="anamnesa" id="anamnesaShow" style="display: <?php echo $anamnesaShow ? '' : 'none'; ?>;">
                <div class="row">
                    <h4 class="text-start">Anamnesa</h4>
                </div>
                <?=
                     @$item['data']['anamnesa_desc'];
                    
                ?>
            </div>

            <div class="historynlifestyle" id="historynlifestyleShow"
                style="display:<?php echo $historynlifestyleShow ? '' : 'none'; ?>;">
                <div class="row">
                    <h4 class="text-start">Riwayat & Gaya Hidup</h4>
                </div>
                <?php
                    $lifestyleDesc = @$item['data']['lifestyle_desc'];
                    if (strpos($lifestyleDesc, '<table') !== false) {
                        $lifestyleDesc .= '</table>';
                    }
                    ?>
                <?= $lifestyleDesc; ?>
            </div>

            <div class="vitailsign" id="vitailsignShow" style="display: <?= $vitailsignShow ? 'block' : 'none'; ?>;">
                <?= @$item['data']['vital_sign_desc']; ?>
            </div>

            <div class="aktivitas" id="aktivitasShow"
                style="display:<?= $aktivitasShow  && $isrjResult? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Aktivitas Dan Latihan</h5>
                </div>

                <?= @$item['data']['adl_desc'];
                ?>
            </div>

            <div class="psikologis" id="psikologisShow" style="display: <?= $psikologisShow ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Psikologis Spiritual</h5>
                </div>
                <?=
                   @$item['data']['psychology_desc'];
                ?>
            </div>

            <div class="sosialEkonomi" id="sosialEkonomiShow"
                style="display:<?= $sosialEkonomiShow ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Sosial Ekonomi</h5>
                </div>
                <?=
                   @$item['data']['sosec_desc'];
                ?>
            </div>



            <div class="pernapasan" id="pernapasanShow"
                style="display: <?= $pernapasanShow && $kelompok_umur_up & $isrjResult1 ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Pernapasan</h5>
                </div>
                <?= @$item['data']['respiratory_desc'];
                ?>
            </div>

            <div class="assSirkulasi" id="assSirkulasiShow"
                style="display: <?= $assSirkulasiShow && $isrjResult1? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Asesmen Sirkulasi</h5>
                </div>
                <?= @$item['data']['circulation_desc'];?>

            </div>

            <div class="assNeurosensoris" id="assNeurosensorisShow"
                style="display: <?= $assNeurosensorisShow && $isrjResult1 ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Asesmen Neurosensoris</h5>
                </div>
                <?= @$item['data']['neurosensoris_desc'];?>
            </div>

            <div class="integumen" id="integumenShow" style="display: <?= $integumenShow ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Integumen & Muskulo Skeletal</h5>
                </div>
                <?= @$item['data']['integumen_desc'];?>
            </div>


            <div class="pencernaan" id="pencernaanShow"
                style="display:<?= $pencernaanShow && $isrjResult ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Pencernaan</h5>
                </div>
                <?=
                    $html = @$item['data']['disgetive_desc'];
                ?>
            </div>

            <div class="skalaNyeri" id="skalanyeriShow" style="display: <?= $skalanyeriShow ? 'block' : 'none'; ?>;">
                <table class="table table-bordered" id="skalaShow">
                    <tbody>
                        <tr>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="fst-italic fw-bold">Skala Nyeri</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <span class="col-12" id="skala_nyeri-<?= $index ?>">
                                                        <?= @$item['data']['numeric_score'] 
                                                        ? nl2br((@$item['data']['numeric_score'])) 
                                                        : nl2br((@$item['data']['wong_baker_score'])); ?>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="fst-italic fw-bold">Resiko Jatuh</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <span class="col-12">
                                                        <?= nl2br(@$item['data']['fm_descriptions']); ?>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="skriningGizi" id="SkriningGiziShow"
                style="display: <?= $SkriningGiziShow ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Skrining Gizi</h5>
                </div>

                <?=
                  @$item['data']['nutrition_desc'];
                ?>

            </div>



            <div class="perkemihan" id="perkemihanShow"
                style="display: <?= $perkemihanShow && $isrjResult ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Perkemihan</h5>
                </div>
                <?=
                    @$item['data']['urinaria_desc'];
                ?>
            </div>

            <div class="seksual" id="seksualShow"
                style="display:<?= $seksualShow && $isrjResult ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Seksual/Reproduksi</h5>
                </div>
                <?= @$item['data']['obsgyn_desc'];
                ?>
            </div>

            <div class="thtneye" id="thtneyeShow"
                style="display:<?= $thtneyeShow && $isrjResult ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">THT & MATA</h5>
                </div>
                <?=
                    @$item['data']['matatht_desc'];
                ?>
            </div>

            <div class="childSpecial" id="childSpecialShow"
                style="display: <?= $childSpecialShow ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Khusus Anak</h5>
                </div>
                <?=
                   @$item['data']['pediatric_desc'];

                   
                ?>
            </div>

            <div class="sleepnChill" id="sleepnChillShow"
                style="display:<?= $sleepnChillShow && $isrjResult ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Tidur Dan Istirahat</h5>
                </div>
                <?= @$item['data']['rest_sleep_desc'];

                ?>
            </div>

            <div class="dekubitus" id="dekubitusShow" style="display:none">
                <div class="row">
                    <h5 class="text-start">Dekubitus</h5>
                </div>
                <?= @$item['data']['decubitus_desc'];
                ?>
            </div>

            <div class="activasntrain" id="activasntrainShow" style="display:none">
                <div class="row">
                    <h5 class="text-start">Aktivitas Dan Latihan</h5>
                </div>
                <?= @$item['data']['training_desc'];
                ?>
            </div>

            <div class="diagkeperawatan" id="diagkeperawatanShow"
                style="display: <?= $diagkeperawatanShow ? 'block' : 'none'; ?>;">
                <div class="row">
                    <h5 class="text-start">Diagnosis Keperawatan</h5>
                </div>
                <?=
                 @$item['data']['nurse_diagnose_desc'];
                ?>
            </div>

            <div class="tindakKolab" id="tindakKolabShow" style="display:none">
                <div class="row">
                    <h5 class="text-start">1. Tindakan Kolaborasi</h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Tanggal & Jam
                        </th>
                        <th>
                            Tindakan Keperawatan
                        </th>
                        <th>
                            Nama Terang
                        </th>
                    </tr>
                    <tr>
                        <td>isiii tgl</td>
                        <td>isiii Tindakan</td>
                        <td>isiii Nama</td>
                    </tr>
                </table>
            </div>

            <div class="tindakMan" id="tindakManShow" style="display:none">
                <div class="row">
                    <h5 class="text-start">2. Tindakan Mandiri</h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Tanggal & Jam
                        </th>
                        <th>
                            Tindakan Keperawatan
                        </th>
                        <th>
                            Nama Terang
                        </th>
                    </tr>
                    <tr>
                        <td>isiii tgl</td>
                        <td>isiii Tindakan</td>
                        <td>isiii Nama</td>
                    </tr>
                </table>
            </div>


        </div>
        <?php endforeach; ?>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
const defaultStatus = <?= json_encode($visit['isrj']) ?>;
const visit = '<?= $visit1 ?>';



$(document).ready(function() {
    let statusVisibility = {
        vitailShow: "",

    };


    if (defaultStatus !== null) {
        $('#selected-status').val(defaultStatus);
    }

    const requestAPi = () => {
        postData({
            status: $('#selected-status').val(),
            visit: visit,
            clinic: $("#selected-status-filter").val()
        }, 'admin/rm/LAINNYA/assessmen_perawat_preview', (res) => {
            const selectedValue = $("#selected-status-filter").val();
            rendersDataView({
                data: res.data,
                result_select: selectedValue,
                dataLength: res?.data?.length
            });
        });
    }

    $('#selected-status').on('change', function() {
        requestAPi();
    });

    $('#selected-status-filter').on('change', function() {
        requestAPi();
    });

    function toggleDynamicVisibility(visibilityData, user) {

        Object.keys(visibilityData).forEach((key) => {
            const isVisible = visibilityData[key]?.includes(user) ?? false;
            const element = $("#" + key);

            if (element.length > 0) {
                element.css("display", isVisible ? "" : "none");
            }
        });
    }

    const rendersDataView = (props) => {
        let {
            data,
            result_select,
            dataLength
        } = props;
        const selectedValue = result_select;


        $('#data-container').empty();

        data.map((e, index) => {
            const rows = e?.data?.pemeriksaan_mata?.split('</tr>').filter(row => row.trim() !== '');
            let leftTableHtml = '';
            let rightTableHtml = '';

            rows?.forEach((row, index) => {
                if (index % 2 === 0) {
                    leftTableHtml += row + '</tr>';
                } else {
                    rightTableHtml += row + '</tr>';
                }
            });


            const htmlView = `<div class="container-fluid mt-5" id="body-show-<?= $index ?>">
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <p><?= @$kop['contact_address'] ?? "-"?>, <?= @$kop['phone'] ?? "-"?>, Fax:
                        <?= @$kop['fax'] ?? "-"?>,
                        <?= @$kop['kota'] ?? "-"?></p>
                    <p><?= @$kop['sk'] ?? "-"?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>


            <div class="row">
                <h3 class="text-center content-title" id="content-title">${e?.title}</h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Nomor RM</b>
                            <p id="no_registration" class="m-0 mt-1 p-0">
                                <?= isset($visit['no_registration']) && $visit['no_registration'] ? $visit['no_registration'] : '-' ?>
                            </p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Nama Pasien</b>
                            <p id="name_of_pasien" class="m-0 mt-1 p-0">
                                <?= isset($visit['name_of_pasien']) && $visit['name_of_pasien'] ? $visit['name_of_pasien'] : '-' ?>
                            </p>
                        </td>
                        <td class="p-1" style="width:33.3%">
                            <b>Jenis Kelamin</b>
                            <p id="gendername" class="m-0 mt-1 p-0 ">
                                <?= isset($visit['gendername']) && $visit['gendername'] ? $visit['gendername'] : '-' ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" style="width:33.3%">
                            <b>Tanggal Lahir (Usia)</b>
                            <p class="m-0 mt-1 p-0 ">
                            ${e.data?.date_of_birth ? moment(e.data?.date_of_birth).format("DD/MM/YYYY"): "-"}
                            </p>
                        </td>
                        <td class="p-1" style="width:66.3%" colspan="2">
                            <b>Alamat Pasien</b>
                            <p class="m-0 mt-1 p-0">
                            ${e.data?.contact_address ?? "-"}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>DPJP</b>
                            <p class="m-0 mt-1 p-0">
                                ${e.data?.doctor ?? "-"}
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Department</b>
                            <p class="m-0 mt-1 p-0">
                                ${e.data?.doctor ?? "-"}
                            </p>
                        </td>
                        <td class="p-1">
                            <b>Tanggal Masuk</b>
                            <p class="m-0 mt-1 p-0 ">
                                  ${e.data?.create_date ? moment(e.data?.create_date).format("DD/MM/YYYY"): "-"}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        ${e?.data.length === 0 ? '' : `<div class="triage" id="triageShow">
                <div class="row">
                    <h4 class="text-start">Triage</h4>
                </div>
                   ${e.data?.triage_desc ? ((e.data.triage_desc))  : ""}
            </div>

            <div class="anamnesa" id="anamnesaShow">
                <div class="row">
                    <h4 class="text-start">Anamnesa</h4>
                </div>
                   ${e.data?.anamnesa_desc ? ((e.data.anamnesa_desc))  : ""}
            </div>

            <div class="historynlifestyle" id="historynlifestyleShow">
                <div class="row">
                    <h4 class="text-start">Riwayat & Gaya Hidup</h4>
                </div>
                   ${e.data?.lifestyle_desc ? ((e.data.lifestyle_desc))  : ""}
            </div>

            <div class="vitailsign" id="vitailsignShow">
                   ${e.data?.vital_sign_desc ? ((e.data.vital_sign_desc))  : ""}
            </div>

            <div class="skriningGizi" id="SkriningGiziShow">
                <div class="row">
                    <h5 class="text-start">Skrining Gizi</h5>
                </div>
                   ${e.data?.nutrition_desc ? ((e.data.nutrition_desc))  : ""}
            </div>

            <div class="skalaNyeri" id="skalanyeriShow">
                <table class="table table-bordered" id="skalaShow">
                    <tbody>
                        <tr>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="fst-italic fw-bold">Skala Nyeri</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <span class="col-12">
                                                     ${e.data?.numeric_score ? nl2br1(e.data?.numeric_score) : nl2br1(e.data?.wong_baker_score)}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="fst-italic fw-bold">Resiko Jatuh</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <span class="col-12">
                                                     ${!e.data?.fm_descriptions ? "-": nl2br1(e.data?.fm_descriptions) }
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="aktivitas" id="aktivitasShow">
                <div class="row">
                    <h5 class="text-start">Aktivitas Dan Latihan</h5>
                </div>
                   ${e.data?.adl_desc ? ((e.data.adl_desc))  : ""}
            </div>

            <div class="psikologis" id="psikologisShow">
                <div class="row">
                    <h5 class="text-start">Psikologis Spiritual</h5>
                </div>
                   ${e.data?.psychology_desc ? ((e.data.psychology_desc))  : ""}
            </div>

            <div class="sosialEkonomi" id="sosialEkonomiShow">
                <div class="row">
                    <h5 class="text-start">Sosial Ekonomi</h5>
                </div>
                   ${e.data?.sosec_desc ? ((e.data.sosec_desc))  : ""}
            </div>

              <div class="assSirkulasi" id="assSirkulasiShow">
                <div class="row">
                    <h5 class="text-start">Asesmen Sirkulasi</h5>
                </div>
                   ${e.data?.circulation_desc ? ((e.data.circulation_desc))  : ""}
            </div>

            <div class="assNeurosensoris" id="assNeurosensorisShow">
                <div class="row">
                    <h5 class="text-start">Asesmen Neurosensoris</h5>
                </div>
                   ${e.data?.neurosensoris_desc ? ((e.data.neurosensoris_desc))  : ""}
            </div>

              <div class="integumen" id="integumenShow">
                <div class="row">
                    <h5 class="text-start">Integumen & Muskulo Skeletal</h5>
                </div>
                   ${e.data?.integumen_desc ? ((e.data.integumen_desc))  : ""}
            </div>

            <div class="pencernaan" id="pencernaanShow">
                <div class="row">
                    <h5 class="text-start">Pencernaan</h5>
                </div>
                   ${e.data?.disgetive_desc ? ((e.data.disgetive_desc))  : ""}
            </div>

            <div class="pernapasan" id="pernapasanShow">
                <div class="row">
                    <h5 class="text-start">Pernapasan</h5>
                </div>
                   ${e.data?.respiratory_desc ? ((e.data.respiratory_desc))  : ""}
            </div>

            <div class="perkemihan" id="perkemihanShow">
                <div class="row">
                    <h5 class="text-start">Perkemihan</h5>
                </div>
                   ${e.data?.urinaria_desc ? ((e.data.urinaria_desc))  : ""}
            </div>

            <div class="seksual" id="seksualShow">
                <div class="row">
                    <h5 class="text-start">Seksual/Reproduksi</h5>
                </div>
                   ${e.data?.obsgyn_desc ? ((e.data.obsgyn_desc))  : ""}
            </div>

            <div class="thtneye" id="thtneyeShow">
                <div class="row">
                    <h5 class="text-start">THT & MATA</h5>
                </div>
                   ${e.data?.matatht_desc ? ((e.data.matatht_desc))  : ""}
            </div>

            <div class="childSpecial" id="childSpecialShow">
                <div class="row">
                    <h5 class="text-start">Khusus Anak</h5>
                </div>
                   ${e.data?.pediatric_desc ? ((e.data.pediatric_desc))  : ""}
            </div>

            <div class="sleepnChill" id="sleepnChillShow">
                <div class="row">
                    <h5 class="text-start">Tidur Dan Istirahat</h5>
                </div>
                   ${e.data?.rest_sleep_desc ? ((e.data.rest_sleep_desc))  : ""}
            </div>

            <div class="dekubitus" id="dekubitusShow">
                <div class="row">
                    <h5 class="text-start">Dekubitus</h5>
                </div>
                   ${e.data?.decubitus_desc ? ((e.data.decubitus_desc))  : ""}
            </div>

            <div class="activasntrain" id="activasntrainShow">
                <div class="row">
                    <h5 class="text-start">Aktivitas Dan Latihan</h5>
                </div>
                   ${e.data?.training_desc ? ((e.data.training_desc))  : ""}
            </div>

            <div class="diagkeperawatan" id="diagkeperawatanShow">
                <div class="row">
                    <h5 class="text-start">Diagnosis Keperawatan</h5>
                </div>
                   ${e.data?.nurse_diagnose_desc ? ((e.data.nurse_diagnose_desc))  : ""}
            </div>

            <div class="tindakKolab" id="tindakKolabShow">
                <div class="row">
                    <h5 class="text-start">1. Tindakan Kolaborasi</h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Tanggal & Jam
                        </th>
                        <th>
                            Tindakan Keperawatan
                        </th>
                        <th>
                            Nama Terang
                        </th>
                    </tr>
                    <tr>
                        <td>isiii tgl</td>
                        <td>isiii Tindakan</td>
                        <td>isiii Nama</td>
                    </tr>
                </table>
            </div>

            <div class="tindakMan" id="tindakManShow">
                <div class="row">
                    <h5 class="text-start">2. Tindakan Mandiri</h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Tanggal & Jam
                        </th>
                        <th>
                            Tindakan Keperawatan
                        </th>
                        <th>
                            Nama Terang
                        </th>
                    </tr>
                    <tr>
                        <td>isiii tgl</td>
                        <td>isiii Tindakan</td>
                        <td>isiii Nama</td>
                    </tr>
                </table>
            </div>`}
        </div>`

            $('#data-container').append(htmlView);


        });

        toggleDynamicVisibility(statusVisibility, selectedValue);

    }

    function nl2br(str) {
        return str.replace(/(\r\n|\n|\r)+/g, '<br>');
    }

    function nl2br1(str) {
        return str?.replace(/\r\n/g, '<br>');
    }


    function cleanBr(str) {
        let result = str.replace(/(<table[^>]*>.*?<\/table>)/gs, (match) => {
            return match.replace(/(\r\n|\n|\r)+/g, '<br>');
        });

        result = result.replace(/(<br\s*\/?>)/g, '');

        return result;
    }
});
</script>


<style>
@media print {
    @page {
        margin: none;
        scale: 85;
    }

    .container {
        width: 210mm;
        /* Sesuaikan dengan lebar kertas A4 */
    }

    .date-request {
        display: none;
    }
}
</style>

</html>