<?php
// echo '<pre>';
// var_dump($bound);
// var_dump($val);
// die();
?>
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
    <script src="<?= base_url('/assets/js/default.js') ?>"></script>

    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
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
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
            </div>
            <div class="col mt-2">
                <h3><?= $organization['name_of_org_unit']; ?></h3>
                <p class="mb-0"><?= @$organization['contact_address'] ?>, <?= @$organization['phone']; ?>, Fax:
                    <?= @$organization['fax']; ?>,
                    <?= @$organization['kota']; ?></p>
                <p><?= @$organization['sk']; ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">
            </div>
        </div>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
        <h3 class="text-center mb-0 my-1">HASIL PEMERIKSAAN</h3>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
        <table class="table table-borderless mb-0">
            <tr>
                <td width="20%">Nama</td>
                <td width="1%">:</td>
                <td colspan="2"><?= $visit['diantar_oleh']; ?></td>
                <td width="20%">No.RM</td>
                <td width="1%">:</td>
                <td><?= $visit['no_registration']; ?></td>
            </tr>
            <tr>
                <td width="20%">Umur</td>
                <td width="1%">:</td>
                <td><?= $visit['age']; ?></td>
                <td>LP:
                    <?= $visit['gender'] == 2 ? 'Perempuan' : ($visit['gender'] == 1 ? 'Laki-laki' : 'Tidak Diketahui'); ?>
                </td>

                <td width="20%">Tanggal</td>
                <td width="1%">:</td>
                <td><?= date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td width="20%">Alamat</td>
                <td width="1%">:</td>
                <td colspan="2"><?= $visit['visitor_address']; ?></td>
                <td width="20%">Dokter</td>
                <td width="1%">:</td>
                <td id="dokter_penunjang_cetak"></td>
            </tr>
        </table>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;" class="mb-2">
        </div>
        <div id="ContainerbodyBoundPrint" class="row mt-0" style="margin-top: 0 !important;">
        </div>
        <div>
            <?php
            if (!empty($val)) {
                $treatImage = $val[0]['treat_image'];
                $filePath = 'C:\Users\Public\Pictures\\' . substr($treatImage, strpos($treatImage, 'uploads'));

                if (file_exists($filePath)) {
                    if (in_array(pathinfo($treatImage, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) :
                        $imageData = base64_encode(file_get_contents($filePath));
                        $imageType = mime_content_type($filePath);
            ?>
                        <div class="dataimgandpdf">
                            <div class="image-container" style="margin-top: 20px; margin-bottom: 20px;">
                                <img src="data:<?= $imageType ?>;base64,<?= $imageData; ?>" alt="Image"
                                    style="width: 100%; max-height: 500px; object-fit: contain;" />
                            </div>
                        </div>
                    <?php
                    elseif (pathinfo($treatImage, PATHINFO_EXTENSION) === 'pdf') :
                        $pdfData = base64_encode(file_get_contents($filePath)); // Menggunakan $filePath untuk memastikan file yang benar
                    ?>
                        <div class="pdf-container" style="margin-bottom: 20px;">
                            <div id="pdf-container-<?= md5($filePath); ?>" style="width: 100%;"></div>
                        </div>

                        <script>
                            (function() {
                                const base64PDF = '<?= $pdfData; ?>';
                                const containerId = 'pdf-container-<?= md5($filePath); ?>';
                                const pdfData1 = atob(base64PDF.split(',')[1]);
                                const loadingTask1 = pdfjsLib.getDocument({
                                    data: new Uint8Array(pdfData1.split("").map(c => c.charCodeAt(0)))
                                });

                                loadingTask1.promise.then(function(pdf) {
                                    const container = document.getElementById(containerId);
                                    for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
                                        pdf.getPage(pageNumber).then(function(page) {
                                            const scale = 1.5;
                                            const viewport = page.getViewport({
                                                scale: scale
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
                    <?php endif; ?>
                <?php } else { ?>

                <?php } ?>
            <?php } ?>
        </div>

        <br>
        <div class="row justify-content-end px-3" id="id-qr-code">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
        </div>
        <br>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

</body>
<script>
    var doctor = '';
    $(document).ready(function(e) {
        let items = <?= json_encode($bound ?? []); ?>;
        let data = <?= json_encode($val ?? []); ?>;



        doctor = data[0]?.doctor
        $('#dokter_penunjang_cetak').html(data[0]?.doctor)

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: doctor,
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });

        if (
            data.length > 0 &&
            data[0].conclusion === null &&
            data[0].result_value === null
        ) {
            $("#ContainerbodyBoundPrint").remove();
            $("#id-qr-code").remove();
            $('#dokter_penunjang_cetak').html("")



        } else {
            $('.dataimgandpdf').addClass('page-break');
            $("#id-qr-code").remove();
            $('#dokter_penunjang_cetak').html("")

        }


        const FilterBound = [{
                name: "CHECK UP",
                value: 1
            },
            {
                name: "HIPERTENSI",
                value: 1
            },
            {
                name: "ARRHYTMIA",
                value: 1
            },
            {
                name: "CHEST PAIN",
                value: 1
            },
            {
                name: "PULMONARY DISEASE",
                value: 1
            },
            {
                name: "OBESITAS",
                value: 1
            },
            {
                name: "Keluhan/ gejala lain",
                value: 3
            },
            {
                name: "Sinus Rhytme",
                value: 1
            },
            {
                name: "Sinus Tachycardia",
                value: 1
            },
            {
                name: "Sinus Bpenunjangmedisycardia",
                value: 1
            },
            {
                name: "Sinus Arrhytmia",
                value: 1
            },
            {
                name: "Low Voltage",
                value: 1
            },
            {
                name: "AF / AFF",
                value: 1
            },
            {
                name: "SVT (PAT)",
                value: 1
            },
            {
                name: "VT / VF",
                value: 1
            },
            {
                name: "RBBB complete / incomplete",
                value: 1
            },
            {
                name: "LBBB complete / incomplete",
                value: 1
            },
            {
                name: "\"LVH",
                value: 1
            },
            {
                name: "\"RVH",
                value: 1
            },
            {
                name: "\"LAH",
                value: 1
            },
            {
                name: "RAH",
                value: 1
            },
            {
                name: "First / second/ third degree",
                value: 1
            },
            {
                name: "QRS Rate",
                value: 2
            },
            {
                name: "P-P Rate",
                value: 2
            },
            {
                name: "QRS Axis",
                value: 2
            },
            {
                name: "P-R Interval",
                value: 2
            },
            {
                name: "Q-T Interval",
                value: 2
            },
            {
                name: "SVES / VES",
                value: 2
            },
            {
                name: "Delta wave / U wave di lead",
                value: 2
            },
            {
                name: "Q Wave di lead",
                value: 2
            },
            {
                name: "r Premordial di lead",
                value: 2
            },
            {
                name: "ST depresed di lead",
                value: 2
            },
            {
                name: "ST Elevation di lead",
                value: 2
            },
            {
                name: "T Flat / T inverted di lead",
                value: 2
            },
            {
                name: "Kesan",
                value: 3
            },
            {
                name: "Anjuran",
                value: 3
            },
            {
                name: "Hasil",
                value: 3
            }
        ];

        const exists = items.map(each => {
            const match = FilterBound.find(f => f.name.trim() === each.description.trim());
            return match ? {
                description: each.description.trim(),
                value: match.value,
                reagent_id: each.reagent_id
            } : null;
        }).filter(each => each !== null);

        const container = document.getElementById('ContainerbodyBoundPrint');
        container.innerHTML = ''; // Clear any existing content

        if (data[0].clinic_id == 'P016') {
            exists.forEach(item => {
                if (item.value === 3) {
                    const inputElement = `
                <div class="mb-3">
                    <label for="${item.reagent_id}" class="form-label">${item.description}</label>
                    <div class=" p-2" style="min-height: 120px">
                        ${item.description !== 'Kesan' ? (data[0].result_value) : (data[0]?.conclusion || '')}
                    </div>
                </div>
            `;
                    container.innerHTML += inputElement;
                }
            });
        } else {
            exists.forEach(item => {
                const isChecked = data.some(d => d.reagent_id === item.reagent_id);
                const foundData = data.find(d => d.reagent_id === item.reagent_id);
                let inputElement = '';

                if (item.value === 1) {
                    inputElement = `
                                        <div class="col-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="${item.reagent_id}" name="bound[]" onclick="return false;" value="${item.description.replace(/"/g, '')}" ${isChecked ? 'checked' : ''}>
                                                <label class="form-check-label fw-bold" for="${item.reagent_id}">
                                                    ${item.description}
                                                </label>
                                            </div>
                                        </div>
                                    `;
                } else if (item.value === 2) {
                    inputElement = `
                                        <div class="mb-3">
                                            <label for="${item.reagent_id}" class="form-label fw-bold">${item.description}</label>
                                            <div class=" p-2">${foundData ? foundData.result_value : '-'}</div>
                                        </div>
                                    `;
                } else if (item.value === 3) {
                    inputElement = `
                                        <div class="mb-3">
                                            <label for="${item.reagent_id}" class="form-label fw-bold">${item.description}</label>
                                            <div class="p-2">${item.description !== 'Kesan' ? (foundData ? foundData.result_value : '') : (data[0]?.conclusion || '')}</div>
                                        </div>
                                    `;
                }

                container.innerHTML += inputElement;
            });
        }



    })
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


        /* .container {
        width: 210mm;
    } */

        /* #ContainerbodyBoundPrint {
        page-break-after: always;
    } */

        .page-break {
            page-break-before: always;
        }
    }
</style>
<script type="text/javascript">
    setTimeout(() => {
        window.print();
    }, 1000);
</script>

</html>