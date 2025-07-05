<style>
    @media print {
        @page {
            size: A4 portrait;
            /* Ukuran default untuk pencetakan */
        }

        .debug-bar-ndisplay {
            display: none !important;
        }

        body {
            margin: 0;
            font-size: 12px;
            width: 100%;
        }

        .landscape {
            width: 100%;
            height: auto;
            margin: 0 auto;
            box-sizing: border-box;
            /* background-color: #eef7ff; */
            transform-origin: left top;
            transform: scale(0.8);
            overflow: hidden;
            display: block;
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

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="<?= base_url(); ?>css/jquery.signature.css" rel="stylesheet"> -->
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url(); ?>assets/js/default.js"></script>


    <title>Cetak All </title>

    <style>
        .form-control.print-hidden-form:disabled,
        .form-control.print-hidden-form[readonly] {
            background-color: #FFF;
            opacity: 1;
            background: transparent;

        }

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

        .form-control.datepicker-tanggal-fisio {
            border: none;
            background: transparent;
        }

        .form-control.datepicker-jadwal-fisio {
            border: none;
            background: transparent;
            font-size: 10px;
        }

        .form-control.print-hidden-form,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        .input-group-text {
            background-color: transparent !important;
            border: none !important;
            font-size: 12px;
        }

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
            margin: 0;
            font-size: 12px;
            width: 21cm;
            /* padding: 1cm;
        box-sizing: border-box; */
        }

        .portrait {
            page-break-before: always;
            width: 26cm;
            height: auto;
            margin: 0 auto;
            /* padding: 1cm; */
            box-sizing: border-box;
            /* background-color: #f9f9f9; */
        }

        .landscape {
            page-break-after: always;
            width: 29.7cm;
            height: auto;
            margin: 0 auto;
            padding: 1cm;
            box-sizing: border-box;
            /* background-color: #eef7ff; */
            /* transform-origin: left top; */
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

    function calculateAge(tgl_lahir) {
        const birthDate = moment(tgl_lahir);
        const now = moment();

        const years = now.diff(birthDate, 'years');
        birthDate.add(years, 'years');

        const months = now.diff(birthDate, 'months');
        birthDate.add(months, 'months');

        const days = now.diff(birthDate, 'days');

        return {
            years,
            months,
            days
        };
    }
</script>


<?php
if ($view === "RIF") {
    if ($type === null) {
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medis.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medissPulang.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-persalinan.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-operasi.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-anestesi.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-penmedis.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radFiles.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio1.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio2.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio3.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fileklaim.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-tbc.php");
        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");


        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
    } else {
        if ($type === "SEP") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        }

        if ($type === "SRI") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
        }

        if ($type === "TRIASE") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medis.php");
        }

        if ($type === "ATS") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-triase.php");
        }
        if ($type === "ResumeMedis") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medissPulang.php");
        }

        if ($type === "Persalinan") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-persalinan.php");
        }


        if ($type === "OPRS") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-operasi.php");
        }


        if ($type === "Anestesi") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-anestesi.php");
        }

        if ($type === "REK") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");
        }

        if ($type === "TBC") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-tbc.php");
        }

        if ($type === "PNJG") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-penmedis.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radFiles.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fileklaim.php");
        }
        if ($type === "FISIO1") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio1.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        }
        if ($type === "FISIO2") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio2.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        }
        if ($type === "FISIO3") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio3.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        }
        if ($type === "LAB") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
        }

        if ($type === "INV") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
        }
    }
} else if ($view === "RJF") {

    if ($type === null) {
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-kontrol1.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medis.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-cppt.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio1.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio2.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio3.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-penmedis.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radFiles.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fileklaim.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-tbc.php");
        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");


        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
    } else {
        if ($type === "SEP") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
            // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        }
        if ($type === "SRK") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-kontrol1.php");
        }
        if ($type === "TRIASE") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medis.php");
        }
        if ($type === "CPPT") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-cppt.php");
        }
        if ($type === "SRI") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
        }
        if ($type === "SKD") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-diag.php");
        }
        if ($type === "PNJG") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-penmedis.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radFiles.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fileklaim.php");
        }
        if ($type === "FISIO1") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio1.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        }
        if ($type === "FISIO2") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio2.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        }
        if ($type === "FISIO3") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio3.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisiojs.php");
        }

        if ($type === "TBC") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-tbc.php");
        }

        if ($type === "REK") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");
        }
        if ($type === "LAB") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
        }
        if ($type === "INV") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
        }
    }
} else if ($view === "RJI") { //igd
    if ($type === null) {
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-diag.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medis.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-penmedis.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radFiles.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fileklaim.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-tbc.php");

        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio.php");
        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
    } else {
        if ($type === "SEP") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        }
        if ($type === "SKD") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-diag.php");
        }
        if ($type === "TRIASE") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-medis.php");
        }

        if ($type === "ATS") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-triage.php");
        }

        if ($type === "PNJG") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-penmedis.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radFiles.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fileklaim.php");

            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-fisio.php");
        }

        if ($type === "TBC") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-tbc.php");
        }

        if ($type === "LAB") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
        }

        if ($type === "REK") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");
        }
        if ($type === "INV") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
        }
    }
} else if ($view === "KRON") {

    if ($type === null) {
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-kontrol1.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab-kron.php");
        echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
    } else {
        if ($type === "SEP") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
            // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-sep.php");
        }

        if ($type === "SRK") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-kontrol1.php");
        }
        if ($type === "REK") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-resep.php");
        }
        if ($type === "HPL") {
            // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab-kron.php");
        }
        if ($type === "HPR") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-radiologi.php");
        }
        if ($type === "INV") {
            echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
        }
    }
} else if ($view === "Lab") {
    echo view("admin/patient/profilemodul/formrm/reklaim/cetak-lab.php");
}

?>


<script>
    setTimeout(() => {
        window.print()
    }, 2000);
</script>