<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Radiologi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .kbw-signature {
            width: 150px;
            height: 90px;
        }
    </style>
    <!--[if IE]>
    <script src="excanvas.js"></script>
    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
        <form action="/admin/rekammedis/postRadOnlineRequest" method="POST">
            <input type="hidden" name="org_unit_code" value="<?= $visit['org_unit_code']; ?>">
            <input type="hidden" name="clinic_id" value="<?= $visit['clinic_id']; ?>">
            <input type="hidden" name="visit_id" value="<?= $visit['visit_id']; ?>">
            <input type="hidden" name="visit" id="visit" value='<?= json_encode($visit); ?>'>
            <input type="hidden" name="pasien" id="pasien" value='<?= json_encode($pasien); ?>'>
            <table style="width: 100%; margin-top: 10px;">
                <tr>
                    <td>
                        <img src="img/logo.png" alt="" style="width: 70px;">
                    </td>
                    <td colspan="3" style="text-align: center;">
                        <h4><b>RSUD M Yunus Bengkulu<br>FORMULIR PERMINTAAN PEMERIKSAAN<br>RADIOLOGI</b></h4>
                    </td>
                </tr>
            </table>
            <div class="row mt-3 mb-1">
                <div class="col-md-2" style="text-align: right;">
                    <label for="no_registration">No CM/MR : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="no_registration" id="no_registration" style="width: 200px;" value="<?= $pasien['no_registration']; ?>" readonly>
                </div>
                <div class="col-md-2" style="text-align: right;">
                    <label for="thename">Nama : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="thename" id="thename" style="width: 300px;" value="<?= $visit['diantar_oleh']; ?>" readonly>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2" style="text-align: right;">
                    <label for="theaddress">Alamat : </label>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="theaddress" id="theaddress" style="width: 300px;" value="<?= $visit['visitor_address']; ?>" readonly>
                </div>
                <div class="col-md-2" style="text-align: right;">
                    <label for="">Umur : </label>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <input class="form-control" type="number" name="ageyear" id="ageyear" style="width: 70%; float: left" min="0" value="<?= $visit['ageyear']; ?>" readonly>
                            <label for="ageyear"> Th</label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="number" name="agemonth" id="agemonth" style="width: 70%; float: left" min="0" value="<?= $visit['agemonth']; ?>" readonly>
                            <label for="agemonth"> Bln</label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="number" name="ageday" id="ageday" style="width: 70%; float: left" min="0" value="<?= $visit['ageday']; ?>" readonly>
                            <label for="ageday"> Hr</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2" style="text-align: right;">
                    <label for="cara_bayar">Cara bayar : </label>
                </div>
                <div class="col-md-4">
                    <select name="status_pasien_id" id="status_pasien_id" class="form-control" style="width: 200px;">
                        <option value="<?= $visit['status_pasien_id']; ?>"><?= $visit['name_of_status_pasien']; ?></option>
                    </select>
                    <!-- <input type="text" name="cara_bayar" id="cara_bayar" style="width: 200px;" readonly> -->
                </div>
            </div>
            <hr style="border: 2px solid black;">
            <div class="row mb-2">
                <div class="col">
                    <label for="" style="color: red;"><b>Lembar Permintaan: 1 dari 1 Urut Lembar Permintaan Pemeriksaan</b></label><br>
                    <label><i>Kode Lembar Permintaan : 20231124142140001710A / No. ID Kunjungan : 2023083119</i></label>
                </div>
                <div class="col-md-3">
                    <div class="box" style="background-color: red; text-align: center; width: 150px; height: 50px;" hidden>Sudah ditransaksikan</div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">
                    <b>Dokter Pengirim :</b>
                </div>
                <div class="col">
                    <select name="employee_id" id="employee_id" class="form-control">
                        <option value="<?= $visit['employee_id']; ?>"><?= $visit['fullname']; ?></option>
                    </select>
                    <!-- <input type="text" name="employee_id" id="employee_id" style="width: 300px;" readonly> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <b>Diagnosis Klinis :</b>
                </div>
                <div class="col">
                    <input class="form-control" type="text" name="description" id="description" style="width: 300px;">
                </div>
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="patient_category_id" id="patient_category_id" value="<?= $visit['patient_category_id']; ?>">
                    <label class="form-check-label" for="patient_category_id"><b>&nbsp;C &nbsp; Y &nbsp; T &nbsp; O</b></label>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="row mb-2">
                        <div class="col">
                            <b>Ekstremilitas Bawah :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_001" id="pr_001">
                                <label class="form-check-label" for="pr_001">Fermur AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_002" id="pr_002">
                                <label class="form-check-label" for="pr_002">Ankle Joint</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_003" id="pr_003">
                                <label class="form-check-label" for="pr_003">Genu AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_004" id="pr_004">
                                <label class="form-check-label" for="pr_004">Cruris AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_005" id="pr_005">
                                <label class="form-check-label" for="pr_005">Panggul AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_006" id="pr_006">
                                <label class="form-check-label" for="pr_006">Calcaneus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_007" id="pr_007">
                                <label class="form-check-label" for="pr_007">HIP Join</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_008" id="pr_008">
                                <label class="form-check-label" for="pr_008">Pedis</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_009" id="pr_009">
                                <label class="form-check-label" for="pr_009">Vertebra</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <b>Thorax :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_035" id="pr_035
                                ">
                                <label class="form-check-label" for="pr_035
                                ">Thoraks satu posisi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_037" id="pr_037">
                                <label class="form-check-label" for="pr_037">Thoraks 2 posisi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_038" id="pr_038">
                                <label class="form-check-label" for="pr_038">Top Lordotik</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <b>Tulang Belakang :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_042" id="pr_042">
                                <label class="form-check-label" for="pr_042">Cervical 2 posisi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_043" id="pr_043">
                                <label class="form-check-label" for="pr_043">Cervical 3 posisi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_044" id="pr_044">
                                <label class="form-check-label" for="pr_044">Vertebra</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_045" id="pr_045">
                                <label class="form-check-label" for="pr_045">Lumbo Sacral</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <b>Gigi :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_053" id="pr_053">
                                <label class="form-check-label" for="pr_053">Foto gigi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_046" id="pr_046">
                                <label class="form-check-label" for="pr_046">Panoramic</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <div class="col">
                            <b>Ekstremilitas Atas :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_012" id="pr_012">
                                <label class="form-check-label" for="pr_012">Manus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_013" id="pr_013">
                                <label class="form-check-label" for="pr_013">Scapula / Clavicula</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_014" id="pr_014">
                                <label class="form-check-label" for="pr_014">Antebrachi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_015" id="pr_015">
                                <label class="form-check-label" for="pr_015">Brachi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_016" id="pr_016">
                                <label class="form-check-label" for="pr_016">Clavicula</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_017" id="pr_017">
                                <label class="form-check-label" for="pr_017">Wrist Join</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_018" id="pr_018">
                                <label class="form-check-label" for="pr_018">Bahu AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_019" id="pr_019">
                                <label class="form-check-label" for="pr_019">Bone Survey</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_020" id="pr_020">
                                <label class="form-check-label" for="pr_020">Vertebra</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <b>Abdomen :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_055" id="pr_055">
                                <label class="form-check-label" for="pr_055">BNO Bayi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_056" id="pr_056">
                                <label class="form-check-label" for="pr_056">BNO AP</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_057" id="pr_057">
                                <label class="form-check-label" for="pr_057">BNO AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_058" id="pr_058">
                                <label class="form-check-label" for="pr_058">Costae</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_074" id="pr_074">
                                <label class="form-check-label" for="pr_074">Abdomen</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_036" id="pr_036">
                                <label class="form-check-label" for="pr_036">Abdomen 3 posisi</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <b>Lain -lain :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_032" id="pr_032">
                                <label class="form-check-label" for="pr_032">Mammografi </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_033" id="pr_033">
                                <label class="form-check-label" for="pr_033">Expertise Foto</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_034" id="pr_034">
                                <label class="form-check-label" for="pr_034">Chepalometri</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <div class="col">
                            <b>Kepala :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_021" id="pr_021">
                                <label class="form-check-label" for="pr_021">Mandibula</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_022" id="pr_022">
                                <label class="form-check-label" for="pr_022">Os Nasal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_023" id="pr_023">
                                <label class="form-check-label" for="pr_023">Orbita</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_028" id="pr_028">
                                <label class="form-check-label" for="pr_028">SPN (Sinus Pranasalis)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_040" id="pr_040">
                                <label class="form-check-label" for="pr_040">Kepala AP / Lat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_010" id="pr_010">
                                <label class="form-check-label" for="pr_010">Mastoid</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_011" id="pr_011">
                                <label class="form-check-label" for="pr_011">TMJ (Temporo Mandibular Join)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_066" id="pr_066">
                                <label class="form-check-label" for="pr_066">Basis Cranii</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_067" id="pr_067">
                                <label class="form-check-label" for="pr_067">Sella Tursika</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_068" id="pr_068">
                                <label class="form-check-label" for="pr_068">Foramen Opticum</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_072" id="pr_072">
                                <label class="form-check-label" for="pr_072">Maxilla</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_073" id="pr_073">
                                <label class="form-check-label" for="pr_073">Mandibulla</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col">
                            <b>Pemeriksaan dengan Kontras :</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_062" id="pr_062">
                                <label class="form-check-label" for="pr_062">Appendicografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_063" id="pr_063">
                                <label class="form-check-label" for="pr_063">Oesophagografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_064" id="pr_064">
                                <label class="form-check-label" for="pr_064">Cor Analisa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_065" id="pr_065">
                                <label class="form-check-label" for="pr_065">Cystografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_070" id="pr_070">
                                <label class="form-check-label" for="pr_070">Fistulografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_071" id="pr_071">
                                <label class="form-check-label" for="pr_071">Cholecystografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_076" id="pr_076">
                                <label class="form-check-label" for="pr_076">Uretrocystografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_075" id="pr_075">
                                <label class="form-check-label" for="pr_075">Arthrografi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_041" id="pr_041">
                                <label class="form-check-label" for="pr_041">Myelografi thoracal / cervical</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_031" id="pr_031">
                                <label class="form-check-label" for="pr_031">Myelografi Lumbal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_024" id="pr_024">
                                <label class="form-check-label" for="pr_024">HSG</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_059" id="pr_059">
                                <label class="form-check-label" for="pr_059">Colon Inloop</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_060" id="pr_060">
                                <label class="form-check-label" for="pr_060">OMD</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pr_052" id="pr_052">
                                <label class="form-check-label" for="pr_052">BNO IVP</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="tanggal_permintaan">Bengkulu, </label>
                            <input type="date" name="tanggal_permintaan" id="tanggal_permintaan" style="width: 150px;" value="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Dokter yang meminta</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div id="sig"></div><br>
                            ( <input type="text" name="doctor" id="doctor" style="width: 90%;" value="<?= $visit['fullname']; ?>"> )
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </form>
    </div>
</body>
<script>
    $("input:checkbox").val(1)
    $("document").ready(function() {
        <?php if (isset($rad)) {
        ?>
            $("#org_unit_code").val('<?= $rad['org_unit_code']; ?>')
            $("#vactination_id").val('<?= $rad['vactination_id']; ?>')
            $("#no_registration").val('<?= $rad['no_registration']; ?>')
            $("#visit_id").val('<?= $rad['visit_id']; ?>')
            $("#bill_id").val('<?= $rad['bill_id']; ?>')
            $("#clinic_id").val('<?= $rad['clinic_id']; ?>')
            $("#validation").val('<?= $rad['validation']; ?>')
            $("#terlayani").val('<?= $rad['terlayani']; ?>')
            $("#employee_id").val('<?= $rad['employee_id']; ?>')
            $("#patient_category_id").val('<?= $rad['patient_category_id']; ?>')
            $("#vactination_date").val('<?= $rad['vactination_date']; ?>')
            $("#description").val('<?= $rad['description']; ?>')
            $("#modified_date").val('<?= $rad['modified_date']; ?>')
            $("#modified_by").val('<?= $rad['modified_by']; ?>')
            $("#modified_from").val('<?= $rad['modified_from']; ?>')
            $("#thename").val('<?= $rad['thename']; ?>')
            $("#theaddress").val('<?= $rad['theaddress']; ?>')
            $("#theid").val('<?= $rad['theid']; ?>')
            $("#isrj").val('<?= $rad['isrj']; ?>')
            $("#ageyear").val('<?= $rad['ageyear']; ?>')
            $("#agemonth").val('<?= $rad['agemonth']; ?>')
            $("#ageday").val('<?= $rad['ageday']; ?>')
            $("#status_pasien_id").val('<?= $rad['status_pasien_id']; ?>')
            $("#gender").val('<?= $rad['gender']; ?>')
            $("#doctor").val('<?= $rad['doctor']; ?>')
            $("#kal_id").val('<?= $rad['kal_id']; ?>')
            $("#class_room_id").val('<?= $rad['class_room_id']; ?>')
            $("#bed_id").val('<?= $rad['bed_id']; ?>')
            $("#keluar_id").val('<?= $rad['keluar_id']; ?>')
            $("#pr_001").prop("checked", <?= $rad['pr_001']; ?>)
            $("#pr_002").prop("checked", <?= $rad['pr_002']; ?>)
            $("#pr_003").prop("checked", <?= $rad['pr_003']; ?>)
            $("#pr_004").prop("checked", <?= $rad['pr_004']; ?>)
            $("#pr_005").prop("checked", <?= $rad['pr_005']; ?>)
            $("#pr_006").prop("checked", <?= $rad['pr_006']; ?>)
            $("#pr_007").prop("checked", <?= $rad['pr_007']; ?>)
            $("#pr_008").prop("checked", <?= $rad['pr_008']; ?>)
            $("#pr_009").prop("checked", <?= $rad['pr_009']; ?>)
            $("#pr_010").prop("checked", <?= $rad['pr_010']; ?>)
            $("#pr_011").prop("checked", <?= $rad['pr_011']; ?>)
            $("#pr_012").prop("checked", <?= $rad['pr_012']; ?>)
            $("#pr_013").prop("checked", <?= $rad['pr_013']; ?>)
            $("#pr_014").prop("checked", <?= $rad['pr_014']; ?>)
            $("#pr_015").prop("checked", <?= $rad['pr_015']; ?>)
            $("#pr_016").prop("checked", <?= $rad['pr_016']; ?>)
            $("#pr_017").prop("checked", <?= $rad['pr_017']; ?>)
            $("#pr_018").prop("checked", <?= $rad['pr_018']; ?>)
            $("#pr_019").prop("checked", <?= $rad['pr_019']; ?>)
            $("#pr_020").prop("checked", <?= $rad['pr_020']; ?>)
            $("#pr_021").prop("checked", <?= $rad['pr_021']; ?>)
            $("#pr_022").prop("checked", <?= $rad['pr_022']; ?>)
            $("#pr_023").prop("checked", <?= $rad['pr_023']; ?>)
            $("#pr_024").prop("checked", <?= $rad['pr_024']; ?>)
            $("#pr_025").prop("checked", <?= $rad['pr_025']; ?>)
            $("#pr_026").prop("checked", <?= $rad['pr_026']; ?>)
            $("#pr_027").prop("checked", <?= $rad['pr_027']; ?>)
            $("#pr_028").prop("checked", <?= $rad['pr_028']; ?>)
            $("#pr_029").prop("checked", <?= $rad['pr_029']; ?>)
            $("#pr_030").prop("checked", <?= $rad['pr_030']; ?>)
            $("#pr_031").prop("checked", <?= $rad['pr_031']; ?>)
            $("#pr_032").prop("checked", <?= $rad['pr_032']; ?>)
            $("#pr_033").prop("checked", <?= $rad['pr_033']; ?>)
            $("#pr_034").prop("checked", <?= $rad['pr_034']; ?>)
            $("#pr_035").prop("checked", <?= $rad['pr_035']; ?>)
            $("#pr_036").prop("checked", <?= $rad['pr_036']; ?>)
            $("#pr_037").prop("checked", <?= $rad['pr_037']; ?>)
            $("#pr_038").prop("checked", <?= $rad['pr_038']; ?>)
            $("#pr_039").prop("checked", <?= $rad['pr_039']; ?>)
            $("#pr_040").prop("checked", <?= $rad['pr_040']; ?>)
            $("#pr_041").prop("checked", <?= $rad['pr_041']; ?>)
            $("#pr_042").prop("checked", <?= $rad['pr_042']; ?>)
            $("#pr_043").prop("checked", <?= $rad['pr_043']; ?>)
            $("#pr_044").prop("checked", <?= $rad['pr_044']; ?>)
            $("#pr_045").prop("checked", <?= $rad['pr_045']; ?>)
            $("#pr_046").prop("checked", <?= $rad['pr_046']; ?>)
            $("#pr_047").prop("checked", <?= $rad['pr_047']; ?>)
            $("#pr_048").prop("checked", <?= $rad['pr_048']; ?>)
            $("#pr_049").prop("checked", <?= $rad['pr_049']; ?>)
            $("#pr_050").prop("checked", <?= $rad['pr_050']; ?>)
            $("#pr_051").prop("checked", <?= $rad['pr_051']; ?>)
            $("#pr_052").prop("checked", <?= $rad['pr_052']; ?>)
            $("#pr_053").prop("checked", <?= $rad['pr_053']; ?>)
            $("#pr_054").prop("checked", <?= $rad['pr_054']; ?>)
            $("#pr_055").prop("checked", <?= $rad['pr_055']; ?>)
            $("#pr_056").prop("checked", <?= $rad['pr_056']; ?>)
            $("#pr_057").prop("checked", <?= $rad['pr_057']; ?>)
            $("#pr_058").prop("checked", <?= $rad['pr_058']; ?>)
            $("#pr_059").prop("checked", <?= $rad['pr_059']; ?>)
            $("#pr_060").prop("checked", <?= $rad['pr_060']; ?>)
            $("#pr_061").prop("checked", <?= $rad['pr_061']; ?>)
            $("#pr_062").prop("checked", <?= $rad['pr_062']; ?>)
            $("#pr_063").prop("checked", <?= $rad['pr_063']; ?>)
            $("#pr_064").prop("checked", <?= $rad['pr_064']; ?>)
            $("#pr_065").prop("checked", <?= $rad['pr_065']; ?>)
            $("#pr_066").prop("checked", <?= $rad['pr_066']; ?>)
            $("#pr_067").prop("checked", <?= $rad['pr_067']; ?>)
            $("#pr_068").prop("checked", <?= $rad['pr_068']; ?>)
            $("#pr_069").prop("checked", <?= $rad['pr_069']; ?>)
            $("#pr_070").prop("checked", <?= $rad['pr_070']; ?>)
            $("#pr_071").prop("checked", <?= $rad['pr_071']; ?>)
            $("#pr_072").prop("checked", <?= $rad['pr_072']; ?>)
            $("#pr_073").prop("checked", <?= $rad['pr_073']; ?>)
            $("#pr_074").prop("checked", <?= $rad['pr_074']; ?>)
            $("#pr_075").prop("checked", <?= $rad['pr_075']; ?>)
            $("#pr_076").prop("checked", <?= $rad['pr_076']; ?>)
            $("#pr_077").prop("checked", <?= $rad['pr_077']; ?>)
            $("#pr_078").prop("checked", <?= $rad['pr_078']; ?>)
            $("#pr_079").prop("checked", <?= $rad['pr_079']; ?>)
            $("#pr_080").prop("checked", <?= $rad['pr_080']; ?>)
            $("#pr_081").prop("checked", <?= $rad['pr_081']; ?>)
            $("#pr_082").prop("checked", <?= $rad['pr_082']; ?>)
            $("#pr_083").prop("checked", <?= $rad['pr_083']; ?>)
            $("#pr_084").prop("checked", <?= $rad['pr_084']; ?>)
            $("#pr_085").prop("checked", <?= $rad['pr_085']; ?>)
            $("#pr_086").prop("checked", <?= $rad['pr_086']; ?>)
            $("#pr_087").prop("checked", <?= $rad['pr_087']; ?>)
            $("#pr_088").prop("checked", <?= $rad['pr_088']; ?>)
            $("#pr_089").prop("checked", <?= $rad['pr_089']; ?>)
            $("#pr_090").prop("checked", <?= $rad['pr_090']; ?>)
            $("#pr_091").prop("checked", <?= $rad['pr_091']; ?>)
            $("#pr_092").prop("checked", <?= $rad['pr_092']; ?>)
            $("#pr_093").prop("checked", <?= $rad['pr_093']; ?>)
            $("#pr_094").prop("checked", <?= $rad['pr_094']; ?>)
            $("#pr_095").prop("checked", <?= $rad['pr_095']; ?>)
            $("#pr_096").prop("checked", <?= $rad['pr_096']; ?>)
            $("#pr_097").prop("checked", <?= $rad['pr_097']; ?>)
            $("#pr_098").prop("checked", <?= $rad['pr_098']; ?>)
            $("#pr_099").prop("checked", <?= $rad['pr_099']; ?>)
            $("#pr_100").prop("checked", <?= $rad['pr_100']; ?>)
            $("#pr_101").prop("checked", <?= $rad['pr_101']; ?>)
            $("#pr_102").prop("checked", <?= $rad['pr_102']; ?>)
            $("#pr_103").prop("checked", <?= $rad['pr_103']; ?>)
            $("#pr_104").prop("checked", <?= $rad['pr_104']; ?>)
            $("#pr_105").prop("checked", <?= $rad['pr_105']; ?>)
            $("#pr_106").prop("checked", <?= $rad['pr_106']; ?>)
            $("#pr_107").prop("checked", <?= $rad['pr_107']; ?>)
            $("#pr_108").prop("checked", <?= $rad['pr_108']; ?>)
            $("#pr_109").prop("checked", <?= $rad['pr_109']; ?>)
            $("#pr_110").prop("checked", <?= $rad['pr_110']; ?>)
            $("#pr_111").prop("checked", <?= $rad['pr_111']; ?>)
            $("#pr_112").prop("checked", <?= $rad['pr_112']; ?>)
            $("#pr_113").prop("checked", <?= $rad['pr_113']; ?>)
            $("#pr_114").prop("checked", <?= $rad['pr_114']; ?>)
            $("#pr_115").prop("checked", <?= $rad['pr_115']; ?>)
            $("#pr_116").prop("checked", <?= $rad['pr_116']; ?>)
            $("#pr_117").prop("checked", <?= $rad['pr_117']; ?>)
            $("#pr_118").prop("checked", <?= $rad['pr_118']; ?>)
            $("#pr_119").prop("checked", <?= $rad['pr_119']; ?>)
            $("#pr_120").prop("checked", <?= $rad['pr_120']; ?>)
            $("#pr_121").prop("checked", <?= $rad['pr_121']; ?>)
            $("#pr_122").prop("checked", <?= $rad['pr_122']; ?>)
            $("#pr_123").prop("checked", <?= $rad['pr_123']; ?>)
            $("#pr_124").prop("checked", <?= $rad['pr_124']; ?>)
            $("#pr_125").prop("checked", <?= $rad['pr_125']; ?>)
            $("#pr_126").prop("checked", <?= $rad['pr_126']; ?>)
            $("#pr_127").prop("checked", <?= $rad['pr_127']; ?>)
            $("#pr_128").prop("checked", <?= $rad['pr_128']; ?>)
            $("#pr_129").prop("checked", <?= $rad['pr_129']; ?>)
            $("#pr_130").prop("checked", <?= $rad['pr_130']; ?>)
            $("#perujuk").val("<?= $rad['perujuk']; ?>")
            $("#alamat_perujuk").val("<?= $rad['alamat_perujuk']; ?>")
            $("#pemeriksaan_lain").val("<?= $rad['pemeriksaan_lain']; ?>")
            $("#iscito").val("<?= $rad['iscito']; ?>")
            $("#pr_131").prop("checked", <?= $rad['pr_131']; ?>)
            $("#pr_132").prop("checked", <?= $rad['pr_132']; ?>)
            $("#pr_133").prop("checked", <?= $rad['pr_133']; ?>)
            $("#pr_134").prop("checked", <?= $rad['pr_134']; ?>)
            $("#pr_135").prop("checked", <?= $rad['pr_135']; ?>)
            $("#pr_136").prop("checked", <?= $rad['pr_136']; ?>)
            $("#pr_137").prop("checked", <?= $rad['pr_137']; ?>)
            $("#pr_138").prop("checked", <?= $rad['pr_138']; ?>)
            $("#pr_139").prop("checked", <?= $rad['pr_139']; ?>)
            $("#pr_140").prop("checked", <?= $rad['pr_140']; ?>)
            $("#pr_141").prop("checked", <?= $rad['pr_141']; ?>)
            $("#pr_142").prop("checked", <?= $rad['pr_142']; ?>)
            $("#pr_143").prop("checked", <?= $rad['pr_143']; ?>)
            $("#pr_144").prop("checked", <?= $rad['pr_144']; ?>)
            $("#pr_145").prop("checked", <?= $rad['pr_145']; ?>)
            $("#pr_146").prop("checked", <?= $rad['pr_146']; ?>)
            $("#pr_147").prop("checked", <?= $rad['pr_147']; ?>)
            $("#pr_148").prop("checked", <?= $rad['pr_148']; ?>)
            $("#pr_149").prop("checked", <?= $rad['pr_149']; ?>)
            $("#pr_150").prop("checked", <?= $rad['pr_150']; ?>)
            $("#pr_151").prop("checked", <?= $rad['pr_151']; ?>)
            $("#pr_152").prop("checked", <?= $rad['pr_152']; ?>)
            $("#pr_153").prop("checked", <?= $rad['pr_153']; ?>)
            $("#pr_154").prop("checked", <?= $rad['pr_154']; ?>)
            $("#pr_155").prop("checked", <?= $rad['pr_155']; ?>)
            $("#pr_156").prop("checked", <?= $rad['pr_156']; ?>)
            $("#pr_157").prop("checked", <?= $rad['pr_157']; ?>)
            $("#pr_158").prop("checked", <?= $rad['pr_158']; ?>)
            $("#pr_159").prop("checked", <?= $rad['pr_159']; ?>)
            $("#pr_160").prop("checked", <?= $rad['pr_160']; ?>)
            $("#pr_161").prop("checked", <?= $rad['pr_161']; ?>)
            $("#pr_162").prop("checked", <?= $rad['pr_162']; ?>)
            $("#pr_163").prop("checked", <?= $rad['pr_163']; ?>)
            $("#pr_164").prop("checked", <?= $rad['pr_164']; ?>)
            $("#pr_165").prop("checked", <?= $rad['pr_165']; ?>)
            $("#pr_166").prop("checked", <?= $rad['pr_166']; ?>)
            $("#pr_167").prop("checked", <?= $rad['pr_167']; ?>)
            $("#pr_168").prop("checked", <?= $rad['pr_168']; ?>)
            $("#pr_169").prop("checked", <?= $rad['pr_169']; ?>)
            $("#pr_170").prop("checked", <?= $rad['pr_170']; ?>)
            $("#pr_171").prop("checked", <?= $rad['pr_171']; ?>)
            $("#pr_172").prop("checked", <?= $rad['pr_172']; ?>)
            $("#pr_173").prop("checked", <?= $rad['pr_173']; ?>)
            $("#pr_174").prop("checked", <?= $rad['pr_174']; ?>)
            $("#pr_175").prop("checked", <?= $rad['pr_175']; ?>)
            $("#pr_176").prop("checked", <?= $rad['pr_176']; ?>)
            $("#pr_177").prop("checked", <?= $rad['pr_177']; ?>)
            $("#pr_178").prop("checked", <?= $rad['pr_178']; ?>)
            $("#pr_179").prop("checked", <?= $rad['pr_179']; ?>)
            $("#pr_180").prop("checked", <?= $rad['pr_180']; ?>)
            $("#pr_181").prop("checked", <?= $rad['pr_181']; ?>)
            $("#pr_182").prop("checked", <?= $rad['pr_182']; ?>)
            $("#pr_183").prop("checked", <?= $rad['pr_183']; ?>)
            $("#pr_184").prop("checked", <?= $rad['pr_184']; ?>)
            $("#pr_185").prop("checked", <?= $rad['pr_185']; ?>)
            $("#pr_186").prop("checked", <?= $rad['pr_186']; ?>)
            $("#pr_187").prop("checked", <?= $rad['pr_187']; ?>)
            $("#pr_188").prop("checked", <?= $rad['pr_188']; ?>)
            $("#pr_189").prop("checked", <?= $rad['pr_189']; ?>)
            $("#pr_190").prop("checked", <?= $rad['pr_190']; ?>)
            $("#pr_191").prop("checked", <?= $rad['pr_191']; ?>)
            $("#pr_192").prop("checked", <?= $rad['pr_192']; ?>)
            $("#pr_193").prop("checked", <?= $rad['pr_193']; ?>)
            $("#pr_194").prop("checked", <?= $rad['pr_194']; ?>)
            $("#pr_195").prop("checked", <?= $rad['pr_195']; ?>)
            $("#pr_196").prop("checked", <?= $rad['pr_196']; ?>)
            $("#pr_197").prop("checked", <?= $rad['pr_197']; ?>)
            $("#pr_198").prop("checked", <?= $rad['pr_198']; ?>)
            $("#pr_199").prop("checked", <?= $rad['pr_199']; ?>)
            $("#pr_200").prop("checked", <?= $rad['pr_200']; ?>)
            $("#no_specimen").val("<?= $rad['no_specimen']; ?>")
            $("#pr_201").prop("checked", <?= $rad['pr_201']; ?>)
            $("#pr_202").prop("checked", <?= $rad['pr_202']; ?>)
            $("#pr_203").prop("checked", <?= $rad['pr_203']; ?>)
            $("#pr_204").prop("checked", <?= $rad['pr_204']; ?>)
            $("#pr_205").prop("checked", <?= $rad['pr_205']; ?>)
            $("#pr_206").prop("checked", <?= $rad['pr_206']; ?>)
            $("#pr_207").prop("checked", <?= $rad['pr_207']; ?>)
            $("#pr_208").prop("checked", <?= $rad['pr_208']; ?>)
            $("#pr_209").prop("checked", <?= $rad['pr_209']; ?>)
            $("#pr_210").prop("checked", <?= $rad['pr_210']; ?>)
            $("#pr_211").prop("checked", <?= $rad['pr_211']; ?>)
            $("#pr_212").prop("checked", <?= $rad['pr_212']; ?>)
            $("#pr_213").prop("checked", <?= $rad['pr_213']; ?>)
            $("#pr_214").prop("checked", <?= $rad['pr_214']; ?>)
            $("#pr_215").prop("checked", <?= $rad['pr_215']; ?>)
            $("#pr_216").prop("checked", <?= $rad['pr_216']; ?>)
            $("#pr_217").prop("checked", <?= $rad['pr_217']; ?>)
            $("#pr_218").prop("checked", <?= $rad['pr_218']; ?>)
            $("#pr_219").prop("checked", <?= $rad['pr_219']; ?>)
            $("#pr_220").prop("checked", <?= $rad['pr_220']; ?>)
            $("#pr_221").prop("checked", <?= $rad['pr_221']; ?>)
            $("#pr_222").prop("checked", <?= $rad['pr_222']; ?>)
            $("#pr_223").prop("checked", <?= $rad['pr_223']; ?>)
            $("#pr_224").prop("checked", <?= $rad['pr_224']; ?>)
            $("#pr_225").prop("checked", <?= $rad['pr_225']; ?>)
            $("#pr_226").prop("checked", <?= $rad['pr_226']; ?>)
            $("#pr_227").prop("checked", <?= $rad['pr_227']; ?>)
            $("#pr_228").prop("checked", <?= $rad['pr_228']; ?>)
            $("#pr_229").prop("checked", <?= $rad['pr_229']; ?>)
            $("#pr_230").prop("checked", <?= $rad['pr_230']; ?>)
            $("#pr_231").prop("checked", <?= $rad['pr_231']; ?>)
            $("#pr_232").prop("checked", <?= $rad['pr_232']; ?>)
            $("#pr_233").prop("checked", <?= $rad['pr_233']; ?>)
            $("#pr_234").prop("checked", <?= $rad['pr_234']; ?>)
            $("#pr_235").prop("checked", <?= $rad['pr_235']; ?>)
            $("#pr_236").prop("checked", <?= $rad['pr_236']; ?>)
            $("#pr_237").prop("checked", <?= $rad['pr_237']; ?>)
            $("#pr_238").prop("checked", <?= $rad['pr_238']; ?>)
            $("#pr_239").prop("checked", <?= $rad['pr_239']; ?>)
            $("#pr_240").prop("checked", <?= $rad['pr_240']; ?>)
            $("#pr_251").prop("checked", <?= $rad['pr_251']; ?>)
            $("#pr_252").prop("checked", <?= $rad['pr_252']; ?>)
            $("#pr_253").prop("checked", <?= $rad['pr_253']; ?>)
            $("#pr_254").prop("checked", <?= $rad['pr_254']; ?>)
            $("#pr_255").prop("checked", <?= $rad['pr_255']; ?>)
            $("#pr_256").prop("checked", <?= $rad['pr_256']; ?>)
            $("#pr_257").prop("checked", <?= $rad['pr_257']; ?>)
            $("#pr_258").prop("checked", <?= $rad['pr_258']; ?>)
            $("#pr_259").prop("checked", <?= $rad['pr_259']; ?>)
            $("#pr_260").prop("checked", <?= $rad['pr_260']; ?>)
            $("#pr_261").prop("checked", <?= $rad['pr_261']; ?>)
            $("#pr_262").prop("checked", <?= $rad['pr_262']; ?>)
            $("#pr_263").prop("checked", <?= $rad['pr_263']; ?>)
            $("#pr_264").prop("checked", <?= $rad['pr_264']; ?>)
            $("#pr_265").prop("checked", <?= $rad['pr_265']; ?>)
            $("#pr_266").prop("checked", <?= $rad['pr_266']; ?>)
            $("#pr_267").prop("checked", <?= $rad['pr_267']; ?>)
            $("#pr_268").prop("checked", <?= $rad['pr_268']; ?>)
            $("#pr_269").prop("checked", <?= $rad['pr_269']; ?>)
            $("#pr_270").prop("checked", <?= $rad['pr_270']; ?>)
            $("#pr_241").prop("checked", <?= $rad['pr_241']; ?>)
            $("#pr_242").prop("checked", <?= $rad['pr_242']; ?>)
            $("#pr_243").prop("checked", <?= $rad['pr_243']; ?>)
            $("#pr_244").prop("checked", <?= $rad['pr_244']; ?>)
            $("#pr_245").prop("checked", <?= $rad['pr_245']; ?>)
            $("#pr_246").prop("checked", <?= $rad['pr_246']; ?>)
            $("#pr_247").prop("checked", <?= $rad['pr_247']; ?>)
            $("#pr_248").prop("checked", <?= $rad['pr_248']; ?>)
            $("#pr_249").prop("checked", <?= $rad['pr_249']; ?>)
            $("#pr_250").prop("checked", <?= $rad['pr_250']; ?>)
        <?php }
        ?>
    })
</script>

</html>