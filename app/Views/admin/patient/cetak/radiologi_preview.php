<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Viewer.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/viewerjs@1.10.0/dist/viewer.min.css">

    <!-- CSS for image container -->
    <style>
        #image-container {
            text-align: center;
            margin-top: 50px;
        }

        #zoomImage {
            max-width: 100%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div id="image-container">
        <!-- Image to display, use your file ID here -->
        <img id="zoomImage" src="<?= base_url() . $url; ?>" alt="Image" />
    </div>

    <!-- Viewer.js library -->
    <script src="https://cdn.jsdelivr.net/npm/viewerjs@1.10.0/dist/viewer.min.js"></script>

    <script>
        // Wait for the DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Viewer.js on the image
            const image = document.getElementById('zoomImage');
            const viewer = new Viewer(image, {
                inline: true, // To enable inline mode
                zoomable: true, // Enable zoom
                scalable: true, // Enable scaling (zooming in and out)
                rotatable: true, // Allow rotation (optional)
                navbar: true, // Enable navbar
                toolbar: {
                    zoomIn: true, // Show zoom-in button
                    zoomOut: true, // Show zoom-out button
                    reset: true, // Show reset button
                    prev: false, // Hide previous button
                    next: false, // Hide next button
                    oneToOne: false, // Hide 1:1 button
                    rotateLeft: true, // Hide rotate left button
                    rotateRight: true, // Hide rotate right button
                    flipHorizontal: false, // Hide flip horizontal button
                    flipVertical: false, // Hide flip vertical button
                },
                title: true // Show title of the image
            });

            // Open the viewer (if needed)
            viewer.show();
        });
    </script>

</body>

</html>