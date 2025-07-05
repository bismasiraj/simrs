<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

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
        /* height: 29.7cm; */
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
        <div class="modal-body pt0 pb0">
            <div class="container-fluid mt-5">
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
                <br>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                </div>

                <div class="row">
                    <div class="col text-center">
                        <h3><b><u id="content-title" class="content-title">Surat Pengantar
                                    Pemeriksaan</u></b>
                        </h3>
                    </div>
                </div>

                <form id="form-lab-cover-latter">
                    <input id="org_unit_code-lab-val-lab-latter" name="org_unit_code" placeholder="org_unit_code"
                        type="hidden" class="form-control block" />
                    <input id="visit_id-lab-val-lab-latter" name="visit_id" placeholder="visit_id" type="hidden"
                        class="form-control block" />
                    <input id="trans_id-lab-val-lab-latter" name="trans_id" placeholder="trans_id" type="hidden"
                        class="form-control block" />
                    <input id="document_id-lab-val-lab-latter" name="document_id" placeholder="document_id"
                        type="hidden" class="form-control block" />
                    <input id="no_registration-lab-val-lab-latter" name="no_registration" placeholder="no_registration"
                        type="hidden" class="form-control block" />
                    <input id="bill_id-lab-val-lab-latter" name="bill_id" placeholder="bill_id" type="hidden"
                        class="form-control block" />
                    <input id="clinic_id-lab-val-lab-latter" name="clinic_id" placeholder="clinic_id" type="hidden"
                        class="form-control block" />
                    <input id="validation-lab-val-lab-latter" name="validation" placeholder="validation" type="hidden"
                        class="form-control block" />
                    <input id="terlayani-lab-val-lab-latter" name="terlayani" placeholder="terlayani" type="hidden"
                        class="form-control block" />
                    <input id="iscito-lab-val-lab-latter" name="iscito" placeholder="iscito" type="hidden"
                        class="form-control block" />
                    <input id="employee_id-lab-val-lab-latter" name="employee_id" placeholder="employee_id"
                        type="hidden" class="form-control block" />
                    <input id="patient_category_id-lab-val-lab-latter" name="patient_category_id"
                        placeholder="patient_category_id" type="hidden" class="form-control block" />
                    <input id="treat_date-lab-val-lab-latter" name="treat_date" placeholder="treat_date" type="hidden"
                        class="form-control block" />
                    <input id="thename-lab-val-lab-latter" name="thename" placeholder="thename" type="hidden"
                        class="form-control block" />
                    <input id="theaddress-lab-val-lab-latter" name="theaddress" placeholder="theaddress" type="hidden"
                        class="form-control block" />
                    <input id="theid-lab-val-lab-latter" name="theid" placeholder="theid" type="hidden"
                        class="form-control block" />
                    <input id="isrj-lab-val-lab-latter" name="isrj" placeholder="isrj" type="hidden"
                        class="form-control block" />
                    <input id="ageyear-lab-val-lab-latter" name="ageyear" placeholder="ageyear" type="hidden"
                        class="form-control block" />
                    <input id="agemonth-lab-val-lab-latter" name="agemonth" placeholder="agemonth" type="hidden"
                        class="form-control block" />
                    <input id="ageday-lab-val-lab-latter" name="ageday" placeholder="ageday" type="hidden"
                        class="form-control block" />
                    <input id="status_pasien_id-lab-val-lab-latter" name="status_pasien_id"
                        placeholder="status_pasien_id" type="hidden" class="form-control block" />
                    <input id="gender-lab-val-lab-latter" name="gender" placeholder="gender" type="hidden"
                        class="form-control block" />
                    <input id="doctor-lab-val-lab-latter" name="doctor" placeholder="doctor" type="hidden"
                        class="form-control block" />
                    <input id="class_room_id-lab-val-lab-latter" name="class_room_id" placeholder="class_room_id"
                        type="hidden" class="form-control block" />
                    <input id="bed_id-lab-val-lab-latter" name="bed_id" placeholder="bed_id" type="hidden"
                        class="form-control block" />
                    <input id="keluar_id-lab-val-lab-latter" name="keluar_id" placeholder="keluar_id" type="hidden"
                        class="form-control block" />
                    <input id="perujuk-lab-val-lab-latter" name="perujuk" placeholder="perujuk" type="hidden"
                        class="form-control block" />
                    <input id="nota_no-lab-val-lab-latter" name="nota_no" placeholder="nota_no" type="hidden"
                        class="form-control block" />
                    <div class="p-3 mt-3">
                        <div class="row">
                            <div class="col">
                                Dengan hormat, <br>
                                Bersama ini kami kirimkan pasien :
                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Nama
                                pasien</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="diantar_oleh-val2-lab-latter" class="thename">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Umur</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="age-val2-lab-latter" class="age"></div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Tgl Lahir</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="tgl_lahir-val2-lab-latter" class="tgl_lahir"></div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">No.
                                Register</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="no_registration-val2-lab-latter"></div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Alamat</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="visitor_address-val2-lab-latter" class="theaddress">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="sa" class="col-sm-3 col-form-label">Diagnosis</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="diagnosa_desc-val2-lab-latter" class="diagnosa_desc">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="sa" class="col-sm-3 col-form-label">Dokter Pengirim</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="fullname-val2-lab-latter" class="fullname">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="sa" class="col-sm-3 col-form-label">Unit Pengirim</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="name_of_clinic-val2-lab-latter" class="name_of_clinic">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                Mohon dapat diberikan tindakan / pemeriksaan : <br>
                                <div class="col pt-2">
                                    <div id="descriptions-val2-lab-latter" class="descriptions">
                                    </div>
                                </div>
                                <!-- <span id="hasil-tindakan-val2-coverfisio"></span> -->
                                <br>
                                Atas perhatian dan kerjasamanya kami ucapkan terima
                                kasih.

                            </div>
                        </div>

                    </div>
                </form>

                <div class="row mb-2 hidden-show-ttd" hidden id="lab-ttd-result">
                    <div class="col-3" align="center">
                        <br>
                        <br><br>
                        <i class="hidden-show-ttd">Dicetak pada tanggal
                            <?= tanggal_indo(date('Y-m-d')); ?></i>

                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>
                            <div id="datetime-now" class="datetime-now"></div><br>
                            Dokter
                        </div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode-lab-conver-dokter">
                            </div>
                        </div>
                        <div id="validator-ttd-lab-conver-dokter"></div>
                    </div>
                </div>

            </div>
            <span id="avttotal_score"></span>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
let val = <?= json_encode(@$val); ?>;
let sign = <?= json_encode(@$sign); ?>;
let visit = <?= json_encode(@$visit); ?>;

sign = JSON.parse(sign)
</script>
<script>
const renderLatterSendCheck = (props) => {
    if (props?.data) {
        if (props?.data?.valid_user) {
            $("#save-form-lab-cover-latter").hide();
            $("#sign-form-lab-cover-latter").hide();
            $("#lab-ttd-result").attr("hidden", false);
            // read Only

            $("#descriptions-lab-val-lab-latter").attr("readonly", true);
            $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", true);
            $("#qrcode-lab-conver-dokter").empty();
            // var qrcode = new QRCode(document.getElementById("qrcode-lab-conver-dokter"), {
            //     text: `${props?.data?.valid_user || ""}`, // Your text here
            //     width: 70,
            //     height: 70,
            //     colorDark: "#000000",
            //     colorLight: "#ffffff",
            //     correctLevel: QRCode.CorrectLevel.H // High error correction
            // });

            // $("#validator-ttd-lab-conver-dokter").text(props?.data?.valid_user || "")

        } else if (props?.data?.modified_by === '<?= user()->username; ?>') {
            $("#save-form-lab-cover-latter").show();
            $("#sign-form-lab-cover-latter").show();
            $("#descriptions-lab-val-lab-latter").attr("readonly", false);
            $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", false);
            $("#lab-ttd-result").attr("hidden", true);
        } else {
            $("#lab-ttd-result").attr("hidden", true);
            $("#sign-form-lab-cover-latter").hide();
            $("#save-form-lab-cover-latter").hide();
            $("#descriptions-lab-val-lab-latter").attr("readonly", true);
            $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", true);
        }
    } else {
        $("#save-form-lab-cover-latter").show();
        $("#lab-ttd-result").attr("hidden", true);
        $("#descriptions-lab-val-lab-latter").attr("readonly", false);
        $("#diagnosa_desc-lab-val-lab-latter").attr("readonly", false);
    }






    let result = props?.data
    let resultTemplate = props?.visit
    let nameValueVisit2 = [
        'diantar_oleh', 'age', 'no_registration',
        'visitor_address'
    ];

    nameValueVisit2?.forEach(name => {
        let id = `${name}-val2-lab-latter`;
        let value = resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).text(value);
        }
    });
    $(`#tgl_lahir-val2-lab-latter`).text(resultTemplate?.tgl_lahir.toString().substr(0, 10));

    let nameValueVisit1 = [
        "name_of_clinic", "fullname", "descriptions", "diagnosa_desc"
    ];

    nameValueVisit1?.forEach(name => {
        let id = `${name}-val2-lab-latter`;
        let value = result?. [name];
        if (value !== undefined) {
            $(`#${id}`).text(value);
        }
    });

    let nameValueHidden = [
        'visit_id', 'trans_id', "no_registration", "employee_id",
        "patient_category_id", "isrj", "ageyear", "agemonth", "ageday", "status_pasien_id", "gender",
        "class_room_id", "bed_id", "keluar_id"
    ];

    nameValueHidden?.forEach(name => {
        let id = `${name}-lab-val-lab-latter`;
        let value = result?. [name] ?? resultTemplate?. [name];
        if (value !== undefined) {
            $(`#${id}`).val(value);
        }
    });


    let nota_nogenerate = ''
    $("#org_unit_code-lab-val-lab-latter").val("-")
    $("#clinic_id-lab-val-lab-latter").val("P013")
    $("#nota_no-lab-val-lab-latter").val(result?.nota_no ?? nota_nogenerate)
    $("#document_id-lab-val-lab-latter").val(result?.document_id ?? resultTemplate?.session_id)
    $("#validation-lab-val-lab-latter").val(result?.validation ?? 0)
    $("#terlayani-lab-val-lab-latter").val(result?.terlayani ?? 0)
    $("#iscito-lab-val-lab-latter").val(result?.iscito ?? 0)
    $("#treat_date-lab-val-lab-latter").val(result?.treat_date)
    $("#thename-lab-val-lab-latter").val(result?.thename ?? resultTemplate?.diantar_oleh)
    $("#theaddress-lab-val-lab-latter").val(result?.theaddress ?? resultTemplate?.contact_address)
    $("#theid-lab-val-lab-latter").val(result?.theid ?? resultTemplate?.pasien_id)
    $("#doctor-lab-val-lab-latter").val(result?.doctor ?? resultTemplate?.fullname)
    $("#perujuk-lab-val-lab-latter").val(result?.perujuk ?? resultTemplate?.employee_id_from)
    $("#diagnosa_desc-lab-val-lab-latter").val(result?.diagnosa_desc ?? null)
    $("#descriptions-lab-val-lab-latter").val(result?.descriptions ?? null)

}
renderLatterSendCheck({
    data: val,
    visit: visit
})
</script>
<script>
const cropTransparentPNG = (base64, callback) => {
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0);

        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        let top = null,
            bottom = null,
            left = null,
            right = null;

        for (let y = 0; y < canvas.height; y++) {
            for (let x = 0; x < canvas.width; x++) {
                const index = (y * canvas.width + x) * 4;
                const alpha = data[index + 3];
                if (alpha > 0) {
                    if (top === null || y < top) top = y;
                    if (bottom === null || y > bottom) bottom = y;
                    if (left === null || x < left) left = x;
                    if (right === null || x > right) right = x;
                }
            }
        }

        if (top === null) return callback(null); // tidak ada gambar

        const width = right - left + 1;
        const height = bottom - top + 1;

        const croppedCanvas = document.createElement('canvas');
        croppedCanvas.width = width;
        croppedCanvas.height = height;

        const croppedCtx = croppedCanvas.getContext('2d');
        croppedCtx.drawImage(canvas, left, top, width, height, 0, 0, width, height);

        const croppedBase64 = croppedCanvas.toDataURL('image/png');
        callback(croppedBase64);
    };
    img.src = base64;
};

function cropSignatureFromImageIDOne(base64, callback) {
    const img = new Image();
    img.onload = () => {
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);

        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];

            if (!(r === 0 && g === 0 && b === 0)) {
                data[i + 3] = 0;
            }
        }

        ctx.putImageData(imageData, 0, 0);

        callback(canvas.toDataURL('image/png'));
    };
    img.src = base64;
}



$.each(sign, function(key, value) {
    if (value.user_type == 1 && value.isvalid == 1) {
        const resultBase64 = `data:image/png;base64,${value?.sign_file}`;

        cropSignatureFromImageIDOne(resultBase64, (cropped) => {
            if (cropped) {
                cropTransparentPNG(cropped, (croppedNew) => {
                    if (croppedNew) {
                        $('#qrcode-lab-conver-dokter').html(
                            `<img src="${croppedNew}" alt="Signature" style="width:100%;max-width: 100px;max-height: 100px;">`
                        );
                    }
                });

            } else {
                $('#qrcode-lab-conver-dokter').empty();
            }
        });

        $("#validator-ttd-lab-conver-dokter").html(`(${value.fullname??value.user_id})`)
        // $("#qrcode-lab-conver-dokter").html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file +
        //     '" width="400px">')

    } else if (value.user_type == 2 && value.isvalid == 1) {
        $("#validator-ttd-lab-conver-dokter").html(`(${value.fullname??value.user_id})`)
        const base64ttd_cetak_pasein = `data:image/gif;base64,${value.sign_file}`

        if (base64ttd_cetak_pasein) {

            cropTransparentPNG(base64ttd_cetak_pasein, (croppedImage) => {
                if (croppedImage) {
                    $('#qrcode-lab-conver-dokter').html(
                        `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                    );
                } else {
                    $('#qrcode-lab-conver-dokter').html('');
                }
            });
        } else {
            $('#qrcode-lab-conver-dokter').html('');
        }

        // $("#qrcode-lab-conver-dokter").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
        //     '" width="400px">')

    } else if (value.user_type == 3 && value.isvalid == 1) {

        $("#validator-ttd-lab-conver-dokter").html(`(${value.fullname??value.user_id})`)

        const base64ttd_cetak_resumePulang_pasien2 = `data:image/gif;base64,${value.sign_file}`

        if (base64ttd_cetak_resumePulang_pasien2) {
            cropTransparentPNG(base64ttd_cetak_resumePulang_pasien2, (croppedImage) => {
                if (croppedImage) {
                    $('#qrcode-lab-conver-dokter').html(
                        `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                    );
                } else {
                    $('#qrcode-lab-conver-dokter').html('');
                }
            });
        } else {
            $('#qrcode-lab-conver-dokter').html('');
        }

        // $("#mediss-qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
        //     '" width="400px">')

    }
})
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
}
</style>
<script type="text/javascript">
window.print();
</script>

</html>