<html>

<head>
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="https://avirtum.com/list/ipages-jquery-plugin/demo/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://avirtum.com/list/ipages-jquery-plugin/min_version/ipages.min.css">
    <!-- /end css -->
    <!-- scripts-section -->
    <script type="text/javascript" src="https://avirtum.com/list/ipages-jquery-plugin/demo/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://avirtum.com/list/ipages-jquery-plugin/min_version/pdf.min.js"></script>
    <script type="text/javascript" src="https://avirtum.com/list/ipages-jquery-plugin/min_version/jquery.ipages.min.js"></script>


    <script>
        $(document).ready(function() {
            var options = {
                responsive: true,
                autoFit: true,

                padding: 10,
                bookEngine: 'OnePageSwipe',

                pageImagesUrl: '<?php echo base_url() . $url; ?>',
                pageImagesFirst: 1, // The number of the first image (starting from 1)
                pageImagesCount: 1, // Set to the number of images you have

                zoom: 1,

                bookmarks: [{
                        text: 'Profile List',
                        link: '',
                        folded: false,
                        bookmarks: [{
                                text: 'Avirtum',
                                link: 'http://avirtum.com',
                                target: 'blank'
                            },
                            {
                                text: 'Twitter',
                                link: 'https://twitter.com/avirtumcom',
                                target: 'blank'
                            }
                        ]
                    },
                    {
                        text: 'The first page',
                        link: '1'
                    },
                    {
                        text: 'The last page',
                        link: '-1'
                    }
                ],
                toolbarControls: [{
                        type: 'sound',
                        active: false,
                        title: 'turn on/off flip sound',
                        icon: 'ipgs-icon-sound',
                        optional: true
                    },
                    {
                        type: 'share',
                        active: false,
                        title: 'share',
                        icon: 'ipgs-icon-share',
                        optional: false
                    },
                    {
                        type: 'outline',
                        active: false,
                        title: 'toggle outline/bookmarks',
                        icon: 'ipgs-icon-outline',
                        optional: false
                    },
                    {
                        type: 'thumbnails',
                        active: false,
                        title: 'toggle thumbnails',
                        icon: 'ipgs-icon-thumbnails',
                        optional: false
                    },
                    {
                        type: 'zoom-in',
                        active: false,
                        title: 'zoom in',
                        icon: 'ipgs-icon-zoom-in',
                        optional: false
                    },
                    {
                        type: 'zoom-out',
                        active: false,
                        title: 'zoom out',
                        icon: 'ipgs-icon-zoom-out',
                        optional: false
                    },
                    {
                        type: 'zoom-default',
                        active: false,
                        title: 'zoom default',
                        icon: 'ipgs-icon-zoom-default',
                        optional: true
                    }
                ],
            };

            // Initialize the flipbook with the specified options
            $('#flipbook').ipages(options);
        });
    </script>

    <!-- /end scripts-section -->
</head>

<body>

    <!-- flipbook markup -->
    <div id="flipbook"></div>
    <!-- /end flipbook markup -->

</body>

</html>