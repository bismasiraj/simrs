<?php if (!empty($radFiles)) : ?>
<?php foreach ($radFiles['data'] as $group) : ?>
<?php if (!empty($group['result'])) :
            $result = $group['result'];
            $nameRadFiless = $result['tarif_name'];
            
            $fields = ['treat_image', 'file_a', 'file_b', 'file_c', 'file_d'];
            $hasValidFile = false;

            foreach ($fields as $fieldName) {
                if (!empty($result[$fieldName]) && strpos($result[$fieldName], 'data:') === 0) {
                    $hasValidFile = true;
                    break;
                }
            }

            if (!$hasValidFile) continue; 
        ?>
<div class="page-break portrait">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
            </div>
            <div class="col mt-2">
                <h3><?= $kop['name_of_org_unit']; ?></h3>
                <p class="mb-0"><?= @$kop['contact_address'] ?>, <?= @$kop['phone']; ?>, Fax: <?= @$kop['fax']; ?>,
                    <?= @$kop['kota']; ?></p>
                <p><?= @$kop['sk']; ?></p>
            </div>
            <div class="col-auto text-center">
                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">
            </div>
        </div>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
        <h3 class="text-center mb-0 my-1"><?= $nameRadFiless; ?></h3>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>

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
<?php endforeach; ?>
<?php endif; ?>