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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url() ?>css/jquery.signature.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>js/jquery.signature.js"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

    <style>
        .table-container-split {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .table-container-split table {
            width: 45%;
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

        thead.border {
            border-bottom: 1px solid black !important;
            border-top: 1px solid black !important;
        }

        tbody.border {
            border-bottom: 1px solid black !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                </div>
                <div class="col mt-2 text-center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p class="mb-0"><?= @$kop['contact_address'] ?>, <?= @$kop['phone']; ?>, Fax: <?= @$kop['fax']; ?>,
                        <?= @$kop['kota']; ?></p>
                    <p><?= @$kop['sk']; ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="70px">
                </div>
            </div>
            <br>

            <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
            <div class="row">
                <h6 class="text-center pt-2"><?= $title; ?></h6>
            </div>
            <div class="table-container-split">
                <table>
                    <!-- kiri -->
                    <tr>
                        <td>No.RM</td>
                        <td>:</td>
                        <td>
                            <div id="no_rm"><?= $visit['no_registration']; ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Pasien</td>
                        <td>:</td>
                        <td>
                            <div id="name_patient"><?= $visit['diantar_oleh']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>JK/Umur</td>
                        <td>:</td>
                        <td>
                            <div id="gender_patient_age"><?= $visit['gender'] == 1 ? 'Laki-laki' : 'Perempuan'; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Pasien</td>
                        <td>:</td>
                        <td>
                            <div id="adresss_patient"><?= $visit['visitor_address']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>
                            <div id="tgl_lahir_patient"><?= substr($visit['tgl_lahir'], 0, 10); ?></div>
                        </td>
                    </tr>
                </table>

                <table>
                    <!--kanan -->
                    <tr>
                        <td>No.Pemeriksaan</td>
                        <td>:</td>
                        <td>
                            <div id="no_check"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>
                            <div id="date_check"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Dokter Pengirim</td>
                        <td>:</td>
                        <td>
                            <div id="doctor_send"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Unit Pengirim</td>
                        <td>:</td>
                        <td>
                            <div id="clinic_send"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosa Klinis</td>
                        <td>:</td>
                        <td>
                            <div id="diagnosa_klinis"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Indikasi Medis</td>
                        <td>:</td>
                        <td>
                            <div id="indikasi_medis"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <table class="table-borderless">
                <thead class="border" style="vertical-align: text-top;">
                    <tr>
                        <td style="width: 10%;">Pemeriksaan : </td>
                        <td>
                            <div id="pemeriksaan-val" class="fw-bold"></div>
                        </td>
                    </tr>
                </thead>
            </table>

            <div><b>Dengan Hormat</b></div>
            <p id="dengan-hormat-val"></p>
            <div><b>Catatan/Rekomendasi</b></div>
            <p id="note-val"></p>


            <div class="row mb-2">
                <div class="col-3" align="center">
                </div>
                <div class="col"></div>
                <div class="col-3" align="center">
                    <div>Pemeriksa</div>
                    <div>
                        <div class="pt-2 pb-2" id="qrcode"></div>
                    </div>
                    <div id="validator-ttd"></div>
                </div>
            </div>
        </form>
    </div>

    <?php if (!empty($dataTables)) : ?>
        <?php
        $result = $dataTables;
        $nameRadFiless = $result['tarif_name'];

        $fields = ['treat_image', 'file_a', 'file_b', 'file_c', 'file_d'];
        $hasValidFile = false;

        foreach ($fields as $fieldName) {
            if (!empty($result[$fieldName]) && strpos($result[$fieldName], 'data:') === 0) {
                $hasValidFile = true;
                break;
            }
        }

        if ($hasValidFile):
        ?>

            <div class="page-break portrait">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
                <div class="container-fluid mt-5">
                    <?php foreach ($fields as $fieldName) :
                        $fileData = $result[$fieldName] ?? '';
                        if (!$fileData || strpos($fileData, 'data:') !== 0) continue;

                        $data = explode(',', $fileData);
                        $mime = explode(';', explode(':', $data[0])[1])[0];
                        $ext = explode('/', $mime)[1] ?? 'png';
                        $pureBase64 = $data[1] ?? '';

                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                            <div class="image-container" style="margin-top: 20px; margin-bottom: 20px;">
                                <img src="<?= $fileData ?>" alt="<?= $fieldName ?>"
                                    style="width: 100%; max-height: 500px; object-fit: contain;" />
                            </div>
                        <?php elseif ($ext === 'pdf') :
                            $containerId = 'pdf-container-' . md5($pureBase64);
                        ?>
                            <div class="pdf-container" style="margin-bottom: 20px;">
                                <div id="<?= $containerId ?>" style="width: 100%;"></div>
                            </div>

                            <script>
                                (function() {
                                    const base64PDF = '<?= $pureBase64 ?>';
                                    const containerId = '<?= $containerId ?>';
                                    const pdfData = atob(base64PDF);
                                    const loadingTask = pdfjsLib.getDocument({
                                        data: new Uint8Array([...pdfData].map(c => c.charCodeAt(0)))
                                    });

                                    loadingTask.promise.then(function(pdf) {
                                        const container = document.getElementById(containerId);
                                        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                                            pdf.getPage(pageNumber).then(function(page) {
                                                const scale = 1.5;
                                                const viewport = page.getViewport({
                                                    scale
                                                });

                                                const canvas = document.createElement('canvas');
                                                const context = canvas.getContext('2d');
                                                canvas.height = viewport.height;
                                                canvas.width = viewport.width;
                                                container.appendChild(canvas);

                                                page.render({
                                                    canvasContext: context,
                                                    viewport: viewport
                                                });
                                            });
                                        }
                                    }).catch(function(error) {
                                        console.error('Error loading PDF:', error);
                                    });
                                })();
                            </script>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>



<script>
    $(document).ready(function() {
        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables();
        renderDataPatient();

        setTimeout(function() {
            window.print();
        }, 1000)
    })

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


    const dataRenderTables = () => {
        <?php $dataJsonTables = json_encode(@$dataTables); ?>

        let dataTable = <?php echo $dataJsonTables; ?>;

        $("#no_check").html(dataTable?.nota_no)
        $("#date_check").html(moment(dataTable?.pickup_date).format("DD-MMM-YYYY HH:ss"))
        $("#tgl_lahir_patient").html(moment('<?= @$visit['tgl_lahir']; ?>').format("DD-MMM-YYYY"))
        $("#doctor_send").html(dataTable?.doctor_from)
        $("#clinic_send").html(dataTable?.name_of_clinic)
        $("#name_of_clinic_id_from").html(dataTable?.doctor_from)
        $("#pemeriksaan-val").html(dataTable?.tarif_name)
        $("#dengan-hormat-val").html((dataTable?.result_value?.toString() ?? '').replace(/\n/g, "<br>"))
        // $("#dengan-hormat-val").html(dataTable?.result_value)
        $("#note-val").html((dataTable?.conclusion?.toString() ?? '').replace(/\n/g, "<br>"))
        // $("#note-val").html(dataTable?.conclusion)


        $("#diagnosa_klinis").html(dataTable?.diagnosa_desc)

        $("#indikasi_medis").html(dataTable?.indication_desc);

        const base64_ttd_rad = dataTable?.ttd_dok

        if (base64_ttd_rad) {
            cropSignatureFromImageIDOne(base64_ttd_rad, (cropped) => {
                if (cropped) {
                    cropTransparentPNG(cropped, (croppedNew) => {
                        if (croppedNew) {
                            $('#qrcode').html(
                                `<img src="${croppedNew}" alt="Signature" style="width:100%;max-width: 70px;max-height: 80px;">`
                            );
                        }
                    });

                    $("#validator-ttd").html(`(${dataTable?.ttd_dok_name??""})`)

                } else {
                    $('#qrcode').empty();
                }
            });
        }



        // if (base64_ttd_rad) {
        //     $('#qrcode').html(
        //         `<img src="${base64_ttd_rad}" alt="QR Code" style="width: 100%; max-width: 300px; height: auto;">`);
        //     $("#validator-ttd").html(dataTable?.ttd_dok_name)

        // } else {
        //     $('#qrcode').html('');
        //     $('#validator-ttd').html('');
        // }

        // var qrcode = new QRCode(document.getElementById("qrcode"), {
        //     text: `${dataTable?.doctor}`, // Your text here
        //     width: 70,
        //     height: 70,
        //     colorDark: "#000000",
        //     colorLight: "#ffffff",
        //     correctLevel: QRCode.CorrectLevel.H // High error correction
        // });
    }



    const renderDataPatient = () => {
        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>
        // render patient 
        $("#gender_patient").html(data?.name_of_gender)
        $("#date_age").html(moment(data?.date_of_birth).format("DD/MM/YYYY") + ' - ' + data?.age)
        $("#no_tlp").html(data?.phone_number)


    }
</script>
<style>
    @media print {
        @page {
            margin: none;
            /* scale: 85; */
        }

        .debug-bar-ndisplay {
            display: none !important;
        }

        .container {
            width: 100%;
            /* Sesuaikan dengan lebar kertas A4 */
        }

        .portrait {
            page-break-before: always;
            /* width: 21cm; */
            /* Ukuran A4 portrait */
            /* height: auto; */
            margin-top: 0 !important;
        }

    }
</style>

<script type="text/javascript">
</script>

</html>