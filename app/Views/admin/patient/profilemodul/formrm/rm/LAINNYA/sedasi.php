<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
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
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">

            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3>RS PKU Muhammadiyah Sampangan</h3>
                    <h3>Surakarta</h3>
                    <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK
                        No.449/0238/P-02/IORS/II/2018</p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><?= $title; ?></h4>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <div class="form-control" id="no_registration" name="no_registration"></div>
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <div class="form-control" id="thename" name="thename"></div>
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <div class="form-control" id="gender" name="gender"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <div class="form-control" id="patient_age" name="patient_age"></div>
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <div class="form-control" id="theaddress" name="theaddress"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <div class="form-control" id="doctor" name="doctor"> </div>
                        </td>
                        <td>
                            <b>Department</b>
                            <div class="form-control" id="clinic_id" name="clinic_id"> </div>
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <div class="form-control" id="examination_date" name="examination_date"> </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kelas</b>
                            <div class="form-control" id="kelas" name="kelas"> </div>
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <div class="form-control" id="bangsal" name="bangsal"> </div>
                        </td>
                        <td>
                            <b>Bed</b>
                            <div class="form-control" id="bed" name="bed"> </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <h4>Informasi Medis</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Hilangnya Gigi</b>
                        <div class="form-control" id="losing_teeth"></div>
                    </td>
                    <td>
                        <b>Masalah Mobilisasi Leher</b>
                        <div class="form-control" id="neck_problem"></div>
                    </td>
                    <td>
                        <b>Leher Pendek</b>
                        <div class="form-control" id="short_neck"></div>
                    </td>
                    <td>
                        <b>Batuk</b>
                        <div class="form-control" id="cough"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Sesak Nafas</b>
                        <div class="form-control" id="dispnea"></div>
                    </td>
                    <td>
                        <b>Barusaja Menderita Infeksi Saluran Nafas</b>
                        <div class="form-control" id="ispa"></div>
                    </td>
                    <td>
                        <b>Periode Menstruasi Tidak Normal</b>
                        <div class="form-control" id="abnormal_menstruation"></div>
                    </td>
                    <td>
                        <b>Stroke</b>
                        <div class="form-control" id="stroke"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Sakit Dada</b>
                        <div class="form-control" id="chest_pain"></div>
                    </td>
                    <td>
                        <b>Denyut Jantung Tidak Normal</b>
                        <div class="form-control" id="aritmia"></div>
                    </td>
                    <td>
                        <b>Muntah</b>
                        <div class="form-control" id="vomitus"></div>
                    </td>
                    <td>
                        <b>Susah Kencing</b>
                        <div class="form-control" id="urinary_retention"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kejang</b>
                        <div class="form-control" id="seizure"></div>
                    </td>
                    <td>
                        <b>Sedang Hamil</b>
                        <div class="form-control" id="pregnant"></div>
                    </td>
                    <td>
                        <b>Pingsan</b>
                        <div class="form-control" id="syncope"></div>
                    </td>
                    <td>
                        <b>Obesitas</b>
                        <div class="form-control" id="obesity"></div>
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <h4>Kajian Sistem</h4>
            </div>
            <div class="row">
                <h4>Pemeriksaan Fisik</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Tekanan Darah</b>
                        <div class="form-control" id="tension_upper"></div>
                    </td>
                    <td>
                        <b>Denyut Nadi</b>
                        <div class="form-control" id="nadi"></div>
                    </td>
                    <td>
                        <b>Suhu Tubuh</b>
                        <div class="form-control" id="temperature"></div>
                    </td>
                    <td>
                        <b>Respiration Rate</b>
                        <div class="form-control" id="nafas"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Berat Badan</b>
                        <div class="form-control" id="weight"></div>
                    </td>
                    <td>
                        <b>Tinggi Badan</b>
                        <div class="form-control" id="height"></div>
                    </td>
                    <td>
                        <b>SpO2</b>
                        <div class="form-control" id="saturasi"></div>
                    </td>
                    <td>
                        <b>BMI</b>
                        <div class="form-control" id="bmi"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Keadaan Umum</b>
                        <div class="form-control" id="pemeriksaan"></div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Kepala</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Mata</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Hidung</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Telinga</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Mulut</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Gigi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Leher</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Thorax</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Jantung</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Paru-paru</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Abdomen</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Hepar</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Lien</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ginjal</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td rowspan="2">
                        <b>Genitalia</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Ekstremitas Atas</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ekstremitas Bawah</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Keadaan Umum</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">
                        <b>Gigi Palsu</b>
                        <div class="form-control" id="denture"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Mallampati</b>
                        <div class="form-control" id="mallampati"></div>
                    </td>
                    <td>
                        <b>Kriteria ASA</b>
                        <div class="form-control" id="asa_class"></div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Diagnosis</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Diagnosis (ICD-10)</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Asesmen</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Asesmen</b>
                        <div class="form-control" id="anesthesia_assessment"></div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <h4>Perencenaan Anestesia</h4>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Sedasi</b>
                        <div class="form-control" id="sedation"></div>
                    </td>
                    <td>
                        <b>GA</b>
                        <div class="form-control" id="general_anesthesia"></div>
                    </td>
                    <td>
                        <b>Regional Spinal</b>
                        <div class="form-control" id="regional_spinal"></div>
                    </td>
                    <td>
                        <b>Regional Epidural</b>
                        <div class="form-control" id="regional_epidural"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Regional Kaudal</b>
                        <div class="form-control" id="regional_kaudal"></div>
                    </td>
                    <td>
                        <b>Regional Block Perifer</b>
                        <div class="form-control" id="regional_blokperifer"></div>
                    </td>
                    <td>
                        <b>Lain-lain</b>
                        <div class="form-control" id="others_anesthesia"></div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Perawatan Pasca Anestesi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                    <td>
                        <b>Persiapan Pre Anestesi</b>
                        <input type="text" class="form-control" id="sa" name="sa">
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Dokter Anestesi</div>
                    <div class="mb-1">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'sa',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    $(document).ready(function() {
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>

        let visitAll = <?= json_encode($visit) ?>;
        let valSelect = <?= json_encode($val) ?>;
        let option = <?= json_encode($option) ?>;
        let examination = <?= json_encode($examination) ?>;

        console.log(valSelect);



        const visit = {
            no_registration: "<?= $visit['no_registration']; ?>",
            clinic_id: visitAll?.name_of_clinic_from,
            class_room_id: "<?= $visit['class_room_id']; ?>",
            in_date: "<?= $visit['in_date']; ?>",
            exit_date: "<?= $visit['exit_date']; ?>",
            keluar_id: "<?= $visit['keluar_id']; ?>",
            examination_date: "<?= $dt->format('Y-m-d H:i:s'); ?>",
            employee_id: "<?= $visit['employee_id']; ?>",
            description: "<?= $visit['description']; ?>",
            modified_date: "<?= $dt->format('Y-m-d H:i:s'); ?>",
            modified_by: "<?= user()->username; ?>",
            modified_from: "<?= $visit['clinic_id']; ?>",
            status_pasien_id: "<?= $visit['status_pasien_id']; ?>",
            ageyear: "<?= $visit['ageyear']; ?>",
            agemonth: "<?= $visit['agemonth']; ?>",
            ageday: "<?= $visit['ageday']; ?>",
            thename: "<?= $visit['diantar_oleh']; ?>",
            theaddress: "<?= $visit['visitor_address']; ?>",
            theid: "<?= $visit['pasien_id']; ?>",
            isrj: "<?= $visit['isrj']; ?>",
            gender: visitAll?.gendername,
            doctor: visitAll?.fullname ?? visitAll?.doctor,
            kal_id: "<?= $visit['kal_id']; ?>",
            petugas_id: "<?= user()->username; ?>",
            petugas: "<?= user()->fullname; ?>",
            account_id: "<?= $visit['account_id']; ?>",
            patient_age: `${visitAll?.age} (${visitAll?.ageyear})`,
            kelas: visitAll?.ageyear,
            bangsal: visitAll?.ageyear,
            bed: visitAll?.ageyear,
        };

        for (const key in visit) {

            if (visit.hasOwnProperty(key)) {
                const element = document.getElementById(key);
                if (element) {
                    element.innerHTML = visit[key];
                } else {

                }
            }
        }

        const setElementHTML = (id, value) => {
            const element = document.getElementById(id);
            if (element) {
                element.innerHTML = value;
            }
        };


        for (const key in valSelect) {
            if (valSelect.hasOwnProperty(key)) {
                const value = valSelect[key];
                const matchedOption = option?.find(opt => opt?.value_id === value);

                if (matchedOption) {

                    setElementHTML(key, matchedOption?.value_desc);
                } else {
                    setElementHTML(key, value);
                }
            }
        }

        if (examination.hasOwnProperty('weight') && examination.hasOwnProperty('height')) {
            const weight = parseFloat(examination['weight']);
            const height = parseFloat(examination['height']);
            if (!isNaN(weight) && !isNaN(height) && height > 0) {
                const bmi = (weight * 10000 / (height * height)).toFixed(2);
                setElementHTML('bmi', bmi);
            }
        }

        for (const key in examination) {
            if (examination.hasOwnProperty(key)) {
                setElementHTML(key, examination[key]);
            }
        }




    });
</script>
<style>
    @media print {
        @page {
            margin: 0;
            scale: 80;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>
<script type="text/javascript">
    window.print();
</script>

</html>