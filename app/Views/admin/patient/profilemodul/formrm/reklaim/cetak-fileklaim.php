<?php 
if (!empty($filelab['data']) && is_array($filelab['data'])):
?>
<div class="page-break portrait">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <?php foreach ($filelab['data'] as $item): ?>
    <?php
        if (!empty($item['file_image_base64'])) {
            $fileType = substr($item['file_image_base64'], 5, strpos($item['file_image_base64'], ';') - 5);
        ?>

    <?php if ($fileType === 'application/pdf'): ?>
    <div class="pdf-container" style="margin-bottom: 20px;">
        <div id="pdf-container-<?php echo md5($item['file_image_base64']); ?>" style="width: 100%;"></div>
    </div>

    <script>
    (function() {
        const base64PDF = '<?= $item['file_image_base64']; ?>';
        const containerId = 'pdf-container-<?= md5($item['file_image_base64']); ?>';
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

    <?php elseif (strpos($fileType, 'image/') === 0): ?>
    <div class="image-container" style="margin-top: 20px; margin-bottom: 20px;">
        <img src="<?= $item['file_image_base64']; ?>" alt="Image"
            style="width: 100%; max-height: 500px; object-fit: contain;" />
    </div>
    <?php endif; ?>
    <?php } ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>