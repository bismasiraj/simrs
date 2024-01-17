<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Lab Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .kbw-signature {
            width: 150px;
            height: 70px;
        }
    </style>
    <!--[if IE]>
    <script src="excanvas.js"></script>
    <![endif]-->
    <script src="js/jquery.signature.js"></script>
    <script>
        // $(function() {
        //     var sig = $('#sig').signature();
        //     $('#disable').click(function() {
        //         var disable = $(this).text() === 'Disable';
        //         $(this).text(disable ? 'Enable' : 'Disable');
        //         sig.signature(disable ? 'disable' : 'enable');
        //     });
        //     $('#clear').click(function() {
        //         sig.signature('clear');
        //     });
        //     $('#json').click(function() {
        //         alert(sig.signature('toJSON'));
        //     });
        //     $('#svg').click(function() {
        //         alert(sig.signature('toSVG'));
        //     });
        // });
    </script>
</head>

<body>
    <div class="container" style="font-family: Verdana;">
        <form action="/admin/rekammedis/postLabOnlineRequest" method="POST">
            <input type="hidden" name="class_id" id="class_id" value="<?= $visit['class_id'] == '0' ? '3' : $visit['class_id']; ?>">
            <input type="hidden" name="doctor" id="doctor" value="<?= $visit['fullname'] ?? ''; ?>">
            <input type="hidden" name="theid" id="theid" value="<?= $pasien['kk_no'] ?? ''; ?>">
            <input type="hidden" name="org_unit_code" id="org_unit_code" value="<?= $pasien['org_unit_code'] ?? ''; ?>">
            <input type="hidden" name="isrj" id="isrj" value="<?= $pasien['isrj'] ?? ''; ?>">
            <input type="hidden" name="ageyear" id="ageyear" value="<?= $visit['ageyear'] ?? ''; ?>">
            <input type="hidden" name="agemonth" id="agemonth" value="<?= $visit['agemonth'] ?? ''; ?>">
            <input type="hidden" name="ageday" id="ageday" value="<?= $visit['ageday'] ?? ''; ?>">
            <input type="hidden" name="visit_id" id="visit_id" value="<?= $visit['visit_id'] ?? ''; ?>">
            <input type="hidden" name="trans_id" id="trans_id" value="<?= $visit['agedady'] ?? ''; ?>">
            <input type="hidden" name="visit" id="visit" value='<?= json_encode($visit); ?>'>
            <input type="hidden" name="pasien" id="pasien" value='<?= json_encode($pasien); ?>'>
            <input type="hidden" name="vactination_id" id="vactination_id">
            <div class="row mt-5">
                <div class="col" style="text-align: center;">
                    <h4><b>DR. M YUNUS BENGKULU<br></b></h4>
                    <h5>Jl. Bhayangkara, Sidomulyo, Kec. Gading Cemp., Kota Bengkulu 38211<br>
                        Telp.(0736) 52004
                    </h5>
                </div>
                <hr style="border: 1px solid black;">
            </div>
            <div class="row">
                <div class="col" style="text-align: center;">
                    <h5><b>FORMULIR PERMINTAAN LABORATORIUM</b></h5>
                </div>
            </div>
            <div class="row mt-3 mb-1">
                <div class="col-md-2" style="text-align: right;">
                    <label for="no_registration">No RM : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="no_registration" id="no_registration" style="width: 200px;" value="<?= $visit['no_registration']; ?>" readonly>
                </div>
                <div class="col-md-2" style="text-align: right;">
                    <label for="gender">Jenis Kelamin : </label>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_laki" value="0" checked="<?= $visit['gender'] == '1' ? true : false; ?>" readonly>
                        <label class="form-check-label" for="gender_laki">Laki-laki</label>&nbsp;
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_perempuan" value="1" checked="<?= $visit['gender'] == '2' ? true : false; ?>" readonly>
                        <label class="form-check-label" for="gender_perempuan">Perempuan</label>&nbsp;
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2" style="text-align: right;">
                    <label for="thename">Nama : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="thename" id="thename" style="width: 300px;" value="<?= $visit['diantar_oleh']; ?>" readonly>
                </div>
                <div class="col-md-2" style="text-align: right;">
                    <label for="date_of_birth">Tanggal Lahir : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="date" name="date_of_birth" id="date_of_birth" style="width: 200px;" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2" style="text-align: right;">
                    <label for="theaddress">Alamat : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="theaddress" id="theaddress" value="<?= $visit['visitor_address']; ?>" style="width: 300px;" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <i>Kode Lembar Permintaan : 202311251357360130017 / No. ID Kunjungan : 20230831192</i>
                <hr style="border: 2px solid black;">
            </div>
            <div class="row mb-1">
                <div class="col-md-2" style="text-align: right;">
                    <label for="cara_bayar"><b>Cara Bayar :</b></label>
                </div>
                <div class="col">
                    <select class="form-control" name="cara_bayar" id="cara_bayar" style="width: 300px;">
                        <option value="<?= $visit['name_of_status_pasien']; ?>" selected><?= $visit['name_of_status_pasien']; ?></option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2" style="text-align: right;">
                    <label for="employee_id"><b>Pengirim :</b></label>
                </div>
                <div class="col">
                    <select class="form-control" name="employee_id" id="employee_id" style="width: 300px;">
                        <option value="<?= $visit['employee_id']; ?>" selected><?= $visit['fullname']; ?></option>
                    </select>
                    <!-- <input type="text" name="employee_id" id="employee_id" readonly> -->
                    <select class="form-control" name="clinic_id" id="clinic_id" style="width: 200px;">
                        <option value="<?= $visit['clinic_id']; ?>" selected><?= $visit['name_of_clinic']; ?></option>
                    </select>
                    <!-- <input type="text" name="clinic_id" id="clinic_id" readonly> -->
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="vactination_date">Tanggal Periksa</label>
                </div>
                <div class="col-md-4">
                    <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                    ?>
                    <input class="form-control" type="datetime-local" name="vactination_date" id="vactination_date" style="width: 200px;" value="<?= $dt->format('Y-m-d H:i:s'); ?>">
                </div>
                <div class="col-md-3" style="color: red; border-color: red;">
                    <input class="form-check-input" type="checkbox" name="patient_category_id" id="patient_category_id" value="<?= $visit['patient_category_id']; ?>">
                    <label class="form-check-label" for="patient_category_id"><b>CITO</b></label>
                </div>
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="validation" id="validation">
                    <label class="form-check-label" for="validation"><b>Hasil</b></label>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-2">
                    <label for="description"><b>Diagnosis Klinis</b></label>
                </div>
                <div class="col">
                    <input class="form-control" type="text" name="description" id="description" style="width: 200px;" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-3" style="background-color: rgb(138, 207, 224);">
                            <b>HEMATOLOGI</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_011" id="pl_011" value="<?= isset($laborat['pl_011']) ? $laborat['pl_011'] : false; ?>">
                                <label class="form-check-label" for="pl_011">Laju Endap Darah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_010" id="pl_010" value="<?= isset($laborat['pl_010']) ? $laborat['pl_010'] : false; ?>">
                                <label class="form-check-label" for="pl_010">Hematokrit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_024" id="pl_024" value="<?= isset($laborat['pl_024']) ? $laborat['pl_024'] : false; ?>">
                                <label class="form-check-label" for="pl_024">Haemoglobin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_025" id="pl_025" value="<?= isset($laborat['pl_025']) ? $laborat['pl_025'] : false; ?>">
                                <label class="form-check-label" for="pl_025">Eritrosit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_029" id="pl_029" value="<?= isset($laborat['pl_029']) ? $laborat['pl_029'] : false; ?>">
                                <label class="form-check-label" for="pl_029">Leukosit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_037" id="pl_037" value="<?= isset($laborat['pl_037']) ? $laborat['pl_037'] : false; ?>">
                                <label class="form-check-label" for="pl_037">Trombosit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_022" id="pl_022" value="<?= isset($laborat['pl_022']) ? $laborat['pl_022'] : false; ?>">
                                <label class="form-check-label" for="pl_022">Retikulosit</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_064" id="pl_064">
                                <label class="form-check-label" for="pl_064">Hitung Jenis Leukosit Sdif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_065" id="pl_065">
                                <label class="form-check-label" for="pl_065">Masa Pendarahan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_051" id="pl_051">
                                <label class="form-check-label" for="pl_051">Masa Pembekuan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_041" id="pl_041">
                                <label class="form-check-label" for="pl_041">Tes Rumpel Leede</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_046" id="pl_046">
                                <label class="form-check-label" for="pl_046">Gambar Darah Tepi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_178" id="pl_178">
                                <label class="form-check-label" for="pl_178">MCV</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_179" id="pl_179">
                                <label class="form-check-label" for="pl_179">MCHC</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_087" id="pl_087">
                                <label class="form-check-label" for="pl_087">RDW</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_086" id="pl_086">
                                <label class="form-check-label" for="pl_086">SI TIBC</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_005" id="pl_005">
                                <label class="form-check-label" for="pl_005">APTT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_115" id="pl_115">
                                <label class="form-check-label" for="pl_115">Fibrinogen</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_117" id="pl_117">
                                <label class="form-check-label" for="pl_117">D. Dimer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_116" id="pl_116">
                                <label class="form-check-label" for="pl_116">PT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_122" id="pl_122">
                                <label class="form-check-label" for="pl_122">INR</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-3" style="background-color: rgb(138, 207, 224);">
                            <b>KIMIA DARAH</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_006" id="pl_006">
                                <label class="form-check-label" for="pl_006">Gula Darah Sewaktu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_021" id="pl_021">
                                <label class="form-check-label" for="pl_021">Gula Darah Puasa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_001" id="pl_001">
                                <label class="form-check-label" for="pl_001">Gula Darah Post Prandial</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_026" id="pl_026">
                                <label class="form-check-label" for="pl_026">Cholesterol Total</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_028" id="pl_028">
                                <label class="form-check-label" for="pl_028">Trigliserida</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_031" id="pl_031">
                                <label class="form-check-label" for="pl_031">HDL Cholesterol</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_020" id="pl_020">
                                <label class="form-check-label" for="pl_020">LDL Cholesterol</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_033" id="pl_033">
                                <label class="form-check-label" for="pl_033">Uric Acid</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_066" id="pl_066">
                                <label class="form-check-label" for="pl_066">Ureum</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_039" id="pl_039">
                                <label class="form-check-label" for="pl_039">Creatinin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_048" id="pl_048">
                                <label class="form-check-label" for="pl_048">Protein Total</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_063" id="pl_063">
                                <label class="form-check-label" for="pl_063">Albumin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_181" id="pl_181">
                                <label class="form-check-label" for="pl_181">Globulin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_069" id="pl_069">
                                <label class="form-check-label" for="pl_069">Bilirubin Total</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_059" id="pl_059">
                                <label class="form-check-label" for="pl_059">Bilirubin Direct</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_044" id="pl_044">
                                <label class="form-check-label" for="pl_044">Bilirubin Indirect</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_125" id="pl_125">
                                <label class="form-check-label" for="pl_125">Alkaline Phosphatase</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_096" id="pl_096">
                                <label class="form-check-label" for="pl_096">Gamma-GT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_113" id="pl_113">
                                <label class="form-check-label" for="pl_113">SGOT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_114" id="pl_114">
                                <label class="form-check-label" for="pl_114">SGPT</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_060" id="pl_060">
                                <label class="form-check-label" for="pl_060">LDH</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_102" id="pl_102">
                                <label class="form-check-label" for="pl_102">CK</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_120" id="pl_120">
                                <label class="form-check-label" for="pl_120">CK-MB</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_119" id="pl_119">
                                <label class="form-check-label" for="pl_119">HB A1C</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-3" style="background-color: rgb(138, 207, 224);">
                            <b>ELEKTROLIT</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_075" id="pl_075">
                                <label class="form-check-label" for="pl_075">Natrium</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_072" id="pl_072">
                                <label class="form-check-label" for="pl_072">Kalium</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_071" id="pl_071">
                                <label class="form-check-label" for="pl_071">AGD</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_018" id="pl_018">
                                <label class="form-check-label" for="pl_018">Clorida</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_019" id="pl_019">
                                <label class="form-check-label" for="pl_019">Calsium</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_079" id="pl_079">
                                <label class="form-check-label" for="pl_079">Magnesium</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_173" id="pl_173">
                                <label class="form-check-label" for="pl_173">TPSA</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-3" style="background-color: rgb(138, 207, 224);">
                            <b>SEROLOGI / IMUNOLOGI</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_013" id="pl_013">
                                <label class="form-check-label" for="pl_013">Hbs Ag</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_008" id="pl_008">
                                <label class="form-check-label" for="pl_008">Anti HBS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_034" id="pl_034">
                                <label class="form-check-label" for="pl_034">VDRL</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_017" id="pl_017">
                                <label class="form-check-label" for="pl_017">ASTO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_015" id="pl_015">
                                <label class="form-check-label" for="pl_015">CRP</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_184" id="pl_184">
                                <label class="form-check-label" for="pl_184">Rhemotoid Factor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_070" id="pl_070">
                                <label class="form-check-label" for="pl_070">Widal Test</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_073" id="pl_073">
                                <label class="form-check-label" for="pl_073">HIV</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_074" id="pl_074">
                                <label class="form-check-label" for="pl_074">Serologi DHF</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_108" id="pl_108">
                                <label class="form-check-label" for="pl_108">TORCH</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_139" id="pl_139">
                                <label class="form-check-label" for="pl_139">T3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_140" id="pl_140">
                                <label class="form-check-label" for="pl_140">T4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_112" id="pl_112">
                                <label class="form-check-label" for="pl_112">TSH</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_109" id="pl_109">
                                <label class="form-check-label" for="pl_109">Troponin</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-3" style="background-color: rgb(138, 207, 224);">
                            <b>PARASITOLOGI</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_007" id="pl_007">
                                <label class="form-check-label" for="pl_007">Malaria</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_036" id="pl_036">
                                <label class="form-check-label" for="pl_036">Telur Cacing</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_050" id="pl_050">
                                <label class="form-check-label" for="pl_050">BTA Sputum</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_009" id="pl_009">
                                <label class="form-check-label" for="pl_009">Filaria</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_077" id="pl_077">
                                <label class="form-check-label" for="pl_077">Secret Urethra</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_110" id="pl_110">
                                <label class="form-check-label" for="pl_110">Secret Vagina</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="row mb-1">
                        <div class="col-md-9" style="background-color: rgb(138, 207, 224);">
                            <b>KLINIK RUTIN</b>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_027" id="pl_027">
                                    <label class="form-check-label" for="pl_027">Urine Lengkap</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_016" id="pl_016">
                                    <label class="form-check-label" for="pl_016">Faeces Lengkap</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-5" style="background-color: rgb(138, 207, 224);">
                            <b>MIKROBIOLOGI</b>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_050" id="pl_050">
                                    <label class="form-check-label" for="pl_050">BTA Sputum</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_040" id="pl_040">
                                    <label class="form-check-label" for="pl_040">Analisa Sperma</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_068" id="pl_068">
                                    <label class="form-check-label" for="pl_068">None-Pandy</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_154" id="pl_154">
                                    <label class="form-check-label" for="pl_154">Narkoba Test</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pl_152" id="pl_152">
                                    <label class="form-check-label" for="pl_152">Test Kelamin</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <div class="row mb-1">
                        <div class="col-md-3" style="background-color: rgb(138, 207, 224);">
                            <b>LAIN-LAIN</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_038" id="pl_038">
                                <label class="form-check-label" for="pl_038">Analisa Fluera / Acites</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_012" id="pl_012">
                                <label class="form-check-label" for="pl_012">Analisa LCS</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pl_049" id="pl_049">
                                <label class="form-check-label" for="pl_049">Analisa Cairan Sendi</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="pemeriksaan_lain"><b><i>Pemeriksaan Lain</i></b></label><br>
                    <textarea name="pemeriksaan_lain" id="pemeriksaan_lain" style="width: 500px; height: 100px;"></textarea>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label for="doctor">Tanda Tangan Dokter</label>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <div id="sig"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            ( <input type="text" name="doctor" id="doctor" style="width: 150px;"> )
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    $("input:checkbox").val(1)
    $("document").ready(function() {
        <?php if (isset($lab)) {
        ?>
            $("#org_unit_code").val('<?= $lab['org_unit_code']; ?>')
            $("#vactination_id").val('<?= $lab['vactination_id']; ?>')
            $("#no_registration").val('<?= $lab['no_registration']; ?>')
            $("#visit_id").val('<?= $lab['visit_id']; ?>')
            $("#bill_id").val('<?= $lab['bill_id']; ?>')
            $("#clinic_id").val('<?= $lab['clinic_id']; ?>')
            $("#validation").val('<?= $lab['validation']; ?>')
            $("#terlayani").val('<?= $lab['terlayani']; ?>')
            $("#employee_id").val('<?= $lab['employee_id']; ?>')
            $("#patient_category_id").val('<?= $lab['patient_category_id']; ?>')
            $("#vactination_date").val('<?= $lab['vactination_date']; ?>')
            $("#description").val('<?= $lab['description']; ?>')
            $("#modified_date").val('<?= $lab['modified_date']; ?>')
            $("#modified_by").val('<?= $lab['modified_by']; ?>')
            $("#modified_from").val('<?= $lab['modified_from']; ?>')
            $("#thename").val('<?= $lab['thename']; ?>')
            $("#theaddress").val('<?= $lab['theaddress']; ?>')
            $("#theid").val('<?= $lab['theid']; ?>')
            $("#isrj").val('<?= $lab['isrj']; ?>')
            $("#ageyear").val('<?= $lab['ageyear']; ?>')
            $("#agemonth").val('<?= $lab['agemonth']; ?>')
            $("#ageday").val('<?= $lab['ageday']; ?>')
            $("#status_pasien_id").val('<?= $lab['status_pasien_id']; ?>')
            $("#gender").val('<?= $lab['gender']; ?>')
            $("#doctor").val('<?= $lab['doctor']; ?>')
            $("#kal_id").val('<?= $lab['kal_id']; ?>')
            $("#class_room_id").val('<?= $lab['class_room_id']; ?>')
            $("#bed_id").val('<?= $lab['bed_id']; ?>')
            $("#keluar_id").val('<?= $lab['keluar_id']; ?>')
            $("#pl_001").prop('checked', '<?= $lab['pl_001']; ?>')
            $("#pl_002").prop('checked', '<?= $lab['pl_002']; ?>')
            $("#pl_003").prop('checked', '<?= $lab['pl_003']; ?>')
            $("#pl_004").prop('checked', '<?= $lab['pl_004']; ?>')
            $("#pl_005").prop('checked', '<?= $lab['pl_005']; ?>')
            $("#pl_006").prop('checked', '<?= $lab['pl_006']; ?>')
            $("#pl_007").prop('checked', '<?= $lab['pl_007']; ?>')
            $("#pl_008").prop('checked', '<?= $lab['pl_008']; ?>')
            $("#pl_009").prop('checked', '<?= $lab['pl_009']; ?>')
            $("#pl_010").prop('checked', '<?= $lab['pl_010']; ?>')
            $("#pl_011").prop('checked', '<?= $lab['pl_011']; ?>')
            $("#pl_012").prop('checked', '<?= $lab['pl_012']; ?>')
            $("#pl_013").prop('checked', '<?= $lab['pl_013']; ?>')
            $("#pl_014").prop('checked', '<?= $lab['pl_014']; ?>')
            $("#pl_015").prop('checked', '<?= $lab['pl_015']; ?>')
            $("#pl_016").prop('checked', '<?= $lab['pl_016']; ?>')
            $("#pl_017").prop('checked', '<?= $lab['pl_017']; ?>')
            $("#pl_018").prop('checked', '<?= $lab['pl_018']; ?>')
            $("#pl_019").prop('checked', '<?= $lab['pl_019']; ?>')
            $("#pl_020").prop('checked', '<?= $lab['pl_020']; ?>')
            $("#pl_021").prop('checked', '<?= $lab['pl_021']; ?>')
            $("#pl_022").prop('checked', '<?= $lab['pl_022']; ?>')
            $("#pl_023").prop('checked', '<?= $lab['pl_023']; ?>')
            $("#pl_024").prop('checked', '<?= $lab['pl_024']; ?>')
            $("#pl_025").prop('checked', '<?= $lab['pl_025']; ?>')
            $("#pl_026").prop('checked', '<?= $lab['pl_026']; ?>')
            $("#pl_027").prop('checked', '<?= $lab['pl_027']; ?>')
            $("#pl_028").prop('checked', '<?= $lab['pl_028']; ?>')
            $("#pl_029").prop('checked', '<?= $lab['pl_029']; ?>')
            $("#pl_030").prop('checked', '<?= $lab['pl_030']; ?>')
            $("#pl_031").prop('checked', '<?= $lab['pl_031']; ?>')
            $("#pl_032").prop('checked', '<?= $lab['pl_032']; ?>')
            $("#pl_033").prop('checked', '<?= $lab['pl_033']; ?>')
            $("#pl_034").prop('checked', '<?= $lab['pl_034']; ?>')
            $("#pl_035").prop('checked', '<?= $lab['pl_035']; ?>')
            $("#pl_036").prop('checked', '<?= $lab['pl_036']; ?>')
            $("#pl_037").prop('checked', '<?= $lab['pl_037']; ?>')
            $("#pl_038").prop('checked', '<?= $lab['pl_038']; ?>')
            $("#pl_039").prop('checked', '<?= $lab['pl_039']; ?>')
            $("#pl_040").prop('checked', '<?= $lab['pl_040']; ?>')
            $("#pl_041").prop('checked', '<?= $lab['pl_041']; ?>')
            $("#pl_042").prop('checked', '<?= $lab['pl_042']; ?>')
            $("#pl_043").prop('checked', '<?= $lab['pl_043']; ?>')
            $("#pl_044").prop('checked', '<?= $lab['pl_044']; ?>')
            $("#pl_045").prop('checked', '<?= $lab['pl_045']; ?>')
            $("#pl_046").prop('checked', '<?= $lab['pl_046']; ?>')
            $("#pl_047").prop('checked', '<?= $lab['pl_047']; ?>')
            $("#pl_048").prop('checked', '<?= $lab['pl_048']; ?>')
            $("#pl_049").prop('checked', '<?= $lab['pl_049']; ?>')
            $("#pl_050").prop('checked', '<?= $lab['pl_050']; ?>')
            $("#pl_051").prop('checked', '<?= $lab['pl_051']; ?>')
            $("#pl_052").prop('checked', '<?= $lab['pl_052']; ?>')
            $("#pl_053").prop('checked', '<?= $lab['pl_053']; ?>')
            $("#pl_054").prop('checked', '<?= $lab['pl_054']; ?>')
            $("#pl_055").prop('checked', '<?= $lab['pl_055']; ?>')
            $("#pl_056").prop('checked', '<?= $lab['pl_056']; ?>')
            $("#pl_057").prop('checked', '<?= $lab['pl_057']; ?>')
            $("#pl_058").prop('checked', '<?= $lab['pl_058']; ?>')
            $("#pl_059").prop('checked', '<?= $lab['pl_059']; ?>')
            $("#pl_060").prop('checked', '<?= $lab['pl_060']; ?>')
            $("#pl_061").prop('checked', '<?= $lab['pl_061']; ?>')
            $("#pl_062").prop('checked', '<?= $lab['pl_062']; ?>')
            $("#pl_063").prop('checked', '<?= $lab['pl_063']; ?>')
            $("#pl_064").prop('checked', '<?= $lab['pl_064']; ?>')
            $("#pl_065").prop('checked', '<?= $lab['pl_065']; ?>')
            $("#pl_066").prop('checked', '<?= $lab['pl_066']; ?>')
            $("#pl_067").prop('checked', '<?= $lab['pl_067']; ?>')
            $("#pl_068").prop('checked', '<?= $lab['pl_068']; ?>')
            $("#pl_069").prop('checked', '<?= $lab['pl_069']; ?>')
            $("#pl_070").prop('checked', '<?= $lab['pl_070']; ?>')
            $("#pl_071").prop('checked', '<?= $lab['pl_071']; ?>')
            $("#pl_072").prop('checked', '<?= $lab['pl_072']; ?>')
            $("#pl_073").prop('checked', '<?= $lab['pl_073']; ?>')
            $("#pl_074").prop('checked', '<?= $lab['pl_074']; ?>')
            $("#pl_075").prop('checked', '<?= $lab['pl_075']; ?>')
            $("#pl_076").prop('checked', '<?= $lab['pl_076']; ?>')
            $("#pl_077").prop('checked', '<?= $lab['pl_077']; ?>')
            $("#pl_078").prop('checked', '<?= $lab['pl_078']; ?>')
            $("#pl_079").prop('checked', '<?= $lab['pl_079']; ?>')
            $("#pl_080").prop('checked', '<?= $lab['pl_080']; ?>')
            $("#pl_081").prop('checked', '<?= $lab['pl_081']; ?>')
            $("#pl_082").prop('checked', '<?= $lab['pl_082']; ?>')
            $("#pl_083").prop('checked', '<?= $lab['pl_083']; ?>')
            $("#pl_084").prop('checked', '<?= $lab['pl_084']; ?>')
            $("#pl_085").prop('checked', '<?= $lab['pl_085']; ?>')
            $("#pl_086").prop('checked', '<?= $lab['pl_086']; ?>')
            $("#pl_087").prop('checked', '<?= $lab['pl_087']; ?>')
            $("#pl_088").prop('checked', '<?= $lab['pl_088']; ?>')
            $("#pl_089").prop('checked', '<?= $lab['pl_089']; ?>')
            $("#pl_090").prop('checked', '<?= $lab['pl_090']; ?>')
            $("#pl_091").prop('checked', '<?= $lab['pl_091']; ?>')
            $("#pl_092").prop('checked', '<?= $lab['pl_092']; ?>')
            $("#pl_093").prop('checked', '<?= $lab['pl_093']; ?>')
            $("#pl_094").prop('checked', '<?= $lab['pl_094']; ?>')
            $("#pl_095").prop('checked', '<?= $lab['pl_095']; ?>')
            $("#pl_096").prop('checked', '<?= $lab['pl_096']; ?>')
            $("#pl_097").prop('checked', '<?= $lab['pl_097']; ?>')
            $("#pl_098").prop('checked', '<?= $lab['pl_098']; ?>')
            $("#pl_099").prop('checked', '<?= $lab['pl_099']; ?>')
            $("#pl_100").prop('checked', '<?= $lab['pl_100']; ?>')
            $("#pl_101").prop('checked', '<?= $lab['pl_101']; ?>')
            $("#pl_102").prop('checked', '<?= $lab['pl_102']; ?>')
            $("#pl_103").prop('checked', '<?= $lab['pl_103']; ?>')
            $("#pl_104").prop('checked', '<?= $lab['pl_104']; ?>')
            $("#pl_105").prop('checked', '<?= $lab['pl_105']; ?>')
            $("#pl_106").prop('checked', '<?= $lab['pl_106']; ?>')
            $("#pl_107").prop('checked', '<?= $lab['pl_107']; ?>')
            $("#pl_108").prop('checked', '<?= $lab['pl_108']; ?>')
            $("#pl_109").prop('checked', '<?= $lab['pl_109']; ?>')
            $("#pl_110").prop('checked', '<?= $lab['pl_110']; ?>')
            $("#pl_111").prop('checked', '<?= $lab['pl_111']; ?>')
            $("#pl_112").prop('checked', '<?= $lab['pl_112']; ?>')
            $("#pl_113").prop('checked', '<?= $lab['pl_113']; ?>')
            $("#pl_114").prop('checked', '<?= $lab['pl_114']; ?>')
            $("#pl_115").prop('checked', '<?= $lab['pl_115']; ?>')
            $("#pl_116").prop('checked', '<?= $lab['pl_116']; ?>')
            $("#pl_117").prop('checked', '<?= $lab['pl_117']; ?>')
            $("#pl_118").prop('checked', '<?= $lab['pl_118']; ?>')
            $("#pl_119").prop('checked', '<?= $lab['pl_119']; ?>')
            $("#pl_120").prop('checked', '<?= $lab['pl_120']; ?>')
            $("#pl_121").prop('checked', '<?= $lab['pl_121']; ?>')
            $("#pl_122").prop('checked', '<?= $lab['pl_122']; ?>')
            $("#pl_123").prop('checked', '<?= $lab['pl_123']; ?>')
            $("#pl_124").prop('checked', '<?= $lab['pl_124']; ?>')
            $("#pl_125").prop('checked', '<?= $lab['pl_125']; ?>')
            $("#pl_126").prop('checked', '<?= $lab['pl_126']; ?>')
            $("#pl_127").prop('checked', '<?= $lab['pl_127']; ?>')
            $("#pl_128").prop('checked', '<?= $lab['pl_128']; ?>')
            $("#pl_129").prop('checked', '<?= $lab['pl_129']; ?>')
            $("#pl_130").prop('checked', '<?= $lab['pl_130']; ?>')
            $("#pl_131").prop('checked', '<?= $lab['pl_131']; ?>')
            $("#pl_132").prop('checked', '<?= $lab['pl_132']; ?>')
            $("#pl_133").prop('checked', '<?= $lab['pl_133']; ?>')
            $("#pl_134").prop('checked', '<?= $lab['pl_134']; ?>')
            $("#pl_135").prop('checked', '<?= $lab['pl_135']; ?>')
            $("#pl_136").prop('checked', '<?= $lab['pl_136']; ?>')
            $("#pl_137").prop('checked', '<?= $lab['pl_137']; ?>')
            $("#pl_138").prop('checked', '<?= $lab['pl_138']; ?>')
            $("#pl_139").prop('checked', '<?= $lab['pl_139']; ?>')
            $("#pl_140").prop('checked', '<?= $lab['pl_140']; ?>')
            $("#pl_141").prop('checked', '<?= $lab['pl_141']; ?>')
            $("#pl_142").prop('checked', '<?= $lab['pl_142']; ?>')
            $("#pl_143").prop('checked', '<?= $lab['pl_143']; ?>')
            $("#pl_144").prop('checked', '<?= $lab['pl_144']; ?>')
            $("#pl_145").prop('checked', '<?= $lab['pl_145']; ?>')
            $("#pl_146").prop('checked', '<?= $lab['pl_146']; ?>')
            $("#pl_147").prop('checked', '<?= $lab['pl_147']; ?>')
            $("#pl_148").prop('checked', '<?= $lab['pl_148']; ?>')
            $("#pl_149").prop('checked', '<?= $lab['pl_149']; ?>')
            $("#pl_150").prop('checked', '<?= $lab['pl_150']; ?>')
            $("#pl_151").prop('checked', '<?= $lab['pl_151']; ?>')
            $("#pl_152").prop('checked', '<?= $lab['pl_152']; ?>')
            $("#pl_153").prop('checked', '<?= $lab['pl_153']; ?>')
            $("#pl_154").prop('checked', '<?= $lab['pl_154']; ?>')
            $("#pl_155").prop('checked', '<?= $lab['pl_155']; ?>')
            $("#pl_156").prop('checked', '<?= $lab['pl_156']; ?>')
            $("#pl_157").prop('checked', '<?= $lab['pl_157']; ?>')
            $("#pl_158").prop('checked', '<?= $lab['pl_158']; ?>')
            $("#pl_159").prop('checked', '<?= $lab['pl_159']; ?>')
            $("#pl_160").prop('checked', '<?= $lab['pl_160']; ?>')
            $("#pl_161").prop('checked', '<?= $lab['pl_161']; ?>')
            $("#pl_162").prop('checked', '<?= $lab['pl_162']; ?>')
            $("#pl_163").prop('checked', '<?= $lab['pl_163']; ?>')
            $("#pl_164").prop('checked', '<?= $lab['pl_164']; ?>')
            $("#pl_165").prop('checked', '<?= $lab['pl_165']; ?>')
            $("#pl_166").prop('checked', '<?= $lab['pl_166']; ?>')
            $("#pl_167").prop('checked', '<?= $lab['pl_167']; ?>')
            $("#pl_168").prop('checked', '<?= $lab['pl_168']; ?>')
            $("#pl_169").prop('checked', '<?= $lab['pl_169']; ?>')
            $("#pl_170").prop('checked', '<?= $lab['pl_170']; ?>')
            $("#pl_171").prop('checked', '<?= $lab['pl_171']; ?>')
            $("#pl_172").prop('checked', '<?= $lab['pl_172']; ?>')
            $("#pl_173").prop('checked', '<?= $lab['pl_173']; ?>')
            $("#pl_174").prop('checked', '<?= $lab['pl_174']; ?>')
            $("#pl_175").prop('checked', '<?= $lab['pl_175']; ?>')
            $("#pl_176").prop('checked', '<?= $lab['pl_176']; ?>')
            $("#pl_177").prop('checked', '<?= $lab['pl_177']; ?>')
            $("#pl_178").prop('checked', '<?= $lab['pl_178']; ?>')
            $("#pl_179").prop('checked', '<?= $lab['pl_179']; ?>')
            $("#pl_180").prop('checked', '<?= $lab['pl_180']; ?>')
            $("#pl_181").prop('checked', '<?= $lab['pl_181']; ?>')
            $("#pl_182").prop('checked', '<?= $lab['pl_182']; ?>')
            $("#pl_183").prop('checked', '<?= $lab['pl_183']; ?>')
            $("#pl_184").prop('checked', '<?= $lab['pl_184']; ?>')
            $("#pl_185").prop('checked', '<?= $lab['pl_185']; ?>')
            $("#desc_1").val('<?= $lab['desc_1']; ?>')
            $("#desc_2").val('<?= $lab['desc_2']; ?>')
            $("#desc_3").val('<?= $lab['desc_3']; ?>')
            $("#desc_4").val('<?= $lab['desc_4']; ?>')
            $("#desc_5").val('<?= $lab['desc_5']; ?>')
            $("#desc_6").val('<?= $lab['desc_6']; ?>')
            $("#desc_7").val('<?= $lab['desc_7']; ?>')
            $("#pl_188").prop('checked', '<?= $lab['pl_188']; ?>')
            $("#pl_189").prop('checked', '<?= $lab['pl_189']; ?>')
            $("#pl_190").prop('checked', '<?= $lab['pl_190']; ?>')
            $("#pl_191").prop('checked', '<?= $lab['pl_191']; ?>')
            $("#pl_192").prop('checked', '<?= $lab['pl_192']; ?>')
            $("#pl_193").prop('checked', '<?= $lab['pl_193']; ?>')
            $("#pl_194").prop('checked', '<?= $lab['pl_194']; ?>')
            $("#pl_195").prop('checked', '<?= $lab['pl_195']; ?>')
            $("#pl_196").prop('checked', '<?= $lab['pl_196']; ?>')
            $("#pl_197").prop('checked', '<?= $lab['pl_197']; ?>')
            $("#pl_198").prop('checked', '<?= $lab['pl_198']; ?>')
            $("#pl_199").prop('checked', '<?= $lab['pl_199']; ?>')
            $("#pl_200").prop('checked', '<?= $lab['pl_200']; ?>')
            $("#pl_201").prop('checked', '<?= $lab['pl_201']; ?>')
            $("#pl_202").prop('checked', '<?= $lab['pl_202']; ?>')
            $("#pl_203").prop('checked', '<?= $lab['pl_203']; ?>')
            $("#pl_204").prop('checked', '<?= $lab['pl_204']; ?>')
            $("#pl_205").prop('checked', '<?= $lab['pl_205']; ?>')
            $("#pl_206").prop('checked', '<?= $lab['pl_206']; ?>')
            $("#pl_207").prop('checked', '<?= $lab['pl_207']; ?>')
            $("#pl_208").prop('checked', '<?= $lab['pl_208']; ?>')
            $("#pl_209").prop('checked', '<?= $lab['pl_209']; ?>')
            $("#pl_210").prop('checked', '<?= $lab['pl_210']; ?>')
            $("#pl_211").prop('checked', '<?= $lab['pl_211']; ?>')
            $("#pl_212").prop('checked', '<?= $lab['pl_212']; ?>')
            $("#pl_213").prop('checked', '<?= $lab['pl_213']; ?>')
            $("#pl_214").prop('checked', '<?= $lab['pl_214']; ?>')
            $("#pl_215").prop('checked', '<?= $lab['pl_215']; ?>')
            $("#pl_216").prop('checked', '<?= $lab['pl_216']; ?>')
            $("#pl_217").prop('checked', '<?= $lab['pl_217']; ?>')
            $("#pl_218").prop('checked', '<?= $lab['pl_218']; ?>')
            $("#pl_219").prop('checked', '<?= $lab['pl_219']; ?>')
            $("#pl_220").prop('checked', '<?= $lab['pl_220']; ?>')
            $("#pl_221").prop('checked', '<?= $lab['pl_221']; ?>')
            $("#pl_222").prop('checked', '<?= $lab['pl_222']; ?>')
            $("#pl_223").prop('checked', '<?= $lab['pl_223']; ?>')
            $("#pl_224").prop('checked', '<?= $lab['pl_224']; ?>')
            $("#pl_225").prop('checked', '<?= $lab['pl_225']; ?>')
            $("#pl_226").prop('checked', '<?= $lab['pl_226']; ?>')
            $("#pl_227").prop('checked', '<?= $lab['pl_227']; ?>')
            $("#pl_228").prop('checked', '<?= $lab['pl_228']; ?>')
            $("#pl_229").prop('checked', '<?= $lab['pl_229']; ?>')
            $("#pl_230").prop('checked', '<?= $lab['pl_230']; ?>')
            $("#pl_231").prop('checked', '<?= $lab['pl_231']; ?>')
            $("#pl_232").prop('checked', '<?= $lab['pl_232']; ?>')
            $("#pl_233").prop('checked', '<?= $lab['pl_233']; ?>')
            $("#pl_234").prop('checked', '<?= $lab['pl_234']; ?>')
            $("#pl_235").prop('checked', '<?= $lab['pl_235']; ?>')
            $("#pl_236").prop('checked', '<?= $lab['pl_236']; ?>')
            $("#pl_237").prop('checked', '<?= $lab['pl_237']; ?>')
            $("#pl_238").prop('checked', '<?= $lab['pl_238']; ?>')
            $("#pl_239").prop('checked', '<?= $lab['pl_239']; ?>')
            $("#pl_240").prop('checked', '<?= $lab['pl_240']; ?>')
            $("#pl_241").prop('checked', '<?= $lab['pl_241']; ?>')
            $("#pl_242").prop('checked', '<?= $lab['pl_242']; ?>')
            $("#pl_243").prop('checked', '<?= $lab['pl_243']; ?>')
            $("#pl_244").prop('checked', '<?= $lab['pl_244']; ?>')
            $("#pl_245").prop('checked', '<?= $lab['pl_245']; ?>')
            $("#pl_246").prop('checked', '<?= $lab['pl_246']; ?>')
            $("#pl_247").prop('checked', '<?= $lab['pl_247']; ?>')
            $("#pl_248").prop('checked', '<?= $lab['pl_248']; ?>')
            $("#pl_249").prop('checked', '<?= $lab['pl_249']; ?>')
            $("#pl_250").prop('checked', '<?= $lab['pl_250']; ?>')
            $("#pl_186").prop('checked', '<?= $lab['pl_186']; ?>')
            $("#pl_187").prop('checked', '<?= $lab['pl_187']; ?>')
            $("#pl_251").prop('checked', '<?= $lab['pl_251']; ?>')
            $("#pl_252").prop('checked', '<?= $lab['pl_252']; ?>')
            $("#pl_253").prop('checked', '<?= $lab['pl_253']; ?>')
            $("#pl_254").prop('checked', '<?= $lab['pl_254']; ?>')
            $("#pl_255").prop('checked', '<?= $lab['pl_255']; ?>')
            $("#pl_256").prop('checked', '<?= $lab['pl_256']; ?>')
            $("#pl_257").prop('checked', '<?= $lab['pl_257']; ?>')
            $("#pl_258").prop('checked', '<?= $lab['pl_258']; ?>')
            $("#pl_259").prop('checked', '<?= $lab['pl_259']; ?>')
            $("#pl_260").prop('checked', '<?= $lab['pl_260']; ?>')
            $("#pl_261").prop('checked', '<?= $lab['pl_261']; ?>')
            $("#pl_262").prop('checked', '<?= $lab['pl_262']; ?>')
            $("#pl_263").prop('checked', '<?= $lab['pl_263']; ?>')
            $("#pl_264").prop('checked', '<?= $lab['pl_264']; ?>')
            $("#pl_265").prop('checked', '<?= $lab['pl_265']; ?>')
            $("#pl_266").prop('checked', '<?= $lab['pl_266']; ?>')
            $("#pl_267").prop('checked', '<?= $lab['pl_267']; ?>')
            $("#pl_268").prop('checked', '<?= $lab['pl_268']; ?>')
            $("#pl_269").prop('checked', '<?= $lab['pl_269']; ?>')
            $("#pl_270").prop('checked', '<?= $lab['pl_270']; ?>')
        <?php
        } ?>
    })
</script>

</html>