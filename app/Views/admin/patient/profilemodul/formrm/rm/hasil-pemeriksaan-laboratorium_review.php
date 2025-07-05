<?php if (!empty($dataTables['file_image_base64'])): ?>
    <?php
    $fileType = explode(';', $dataTables['file_image_base64'])[0]; // Ambil tipe MIME
    if (strpos($fileType, 'image') !== false):
    ?>
        <img src="<?= $dataTables['file_image_base64']; ?>" alt="Hasil Pemeriksaan" style="max-width: 100%;">
    <?php elseif (strpos($fileType, 'pdf') !== false): ?>
        <?php
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"hasil_pemeriksaan.pdf\"");
        echo base64_decode(explode(',', $dataTables['file_image_base64'])[1]);
        exit();
        ?>
    <?php else: ?>
        <p>Format file tidak didukung.</p>
    <?php endif; ?>
<?php elseif (!empty($dataTables['file_url'])): ?>
    <?php
    $fileExtension = pathinfo($dataTables['file_url'], PATHINFO_EXTENSION);
    if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])):
    ?>
        <img src="<?= $dataTables['file_url']; ?>" alt="Hasil Pemeriksaan" style="max-width: 100%;">
    <?php elseif ($fileExtension === 'pdf'): ?>
        <?php
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"hasil_pemeriksaan.pdf\"");
        readfile($dataTables['file_url']);
        exit();
        ?>
    <?php else: ?>
        <p>Format file tidak didukung.</p>
    <?php endif; ?>
<?php else: ?>
    <p>File tidak ditemukan.</p>
<?php endif; ?>