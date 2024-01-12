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
                    <input class="form-control" type="datetime-local" name="vactination_date" id="vactination_date" style="width: 200px;" value="<?= date('Y-m-d'); ?>">
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
</script>

</html>