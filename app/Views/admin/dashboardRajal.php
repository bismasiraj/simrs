<?php $this->extend('layout/default', [
    'rKHarian' => $rKHarian,
    'rKBulanan' => $rKBulanan,
    'orgunit' => $orgunit,
    'img_time' => $img_time
]) ?>



<?php $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kunjungan Pasien Per Daerah</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="pieDaerah" style="height: 400px; background-color: #FFFFFF;"></div>
                        </div>
                    </div>

                </div>
            </div><!--./col-lg-7-->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kunjungan Pasien Per Umur</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="pieUmur" style="height: 400px; background-color: #FFFFFF;"></div>
                        </div>
                    </div>

                </div>
            </div><!--./col-lg-7-->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kunjungan Pasien Per Status Bayar</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="pieStatus" style="height: 400px; background-color: #FFFFFF;"></div>
                        </div>
                    </div>

                </div>
            </div><!--./col-lg-7-->
        </div><!--./row-->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kunjungan Pasien Harian</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="harianBL" style="height: 400px; background-color: #FFFFFF;"></div>
                        </div>
                    </div>

                </div>
            </div><!--./col-lg-7-->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kunjungan Pasien Bulanan </h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <div id="bulananBL" style="height: 400px; background-color: #FFFFFF;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--./col-lg-5-->
        </div><!--./row-->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">JUMLAH PASIEN PER DOKTER</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="grafikKamar" style="height: 800px; background-color: #FFFFFF;"></div>
                        </div>
                    </div>

                </div>
            </div><!--./col-lg-7-->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pelayanan Poli Klinik</h3>
                    </div>
                    <div class="box-body">
                        <?php $x = 0; ?>

                        <!-- memulau foreach tabel pelayanan poliklinik -->
                        <?php foreach ($rTerlayani as $key => $value) : ?>
                            <!-- div level 1 -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">

                                <!-- if conditional untuk membedakan warna tiap tabel -->
                                <?php if ($x % 5 == 0) : ?>
                                    <!-- div level 2 -->
                                    <div class="thumbnail" style="border-color: #FB6542">
                                        <!-- div level 3 -->
                                        <div class="thumbnail caption" style="background-color: #FB6542; color: white;">
                                        <?php elseif ($x % 5 == 1) : ?>
                                            <div class="thumbnail" style="border-color: #375E97">
                                                <div class="thumbnail caption" style="background-color: #375E97; color: white;">
                                                <?php elseif ($x % 5 == 2) : ?>
                                                    <div class="thumbnail" style="border-color: #FFBB00">
                                                        <div class="thumbnail caption" style="background-color: #FFBB00; color: white;">
                                                        <?php elseif ($x % 5 == 3) : ?>
                                                            <div class="thumbnail" style="border-color: #FB6542">
                                                                <div class="thumbnail caption" style="background-color: #FB6542; color: white;">
                                                                <?php elseif ($x % 5 == 4) : ?>
                                                                    <div class="thumbnail" style="border-color: #3F681C">
                                                                        <div class="thumbnail caption" style="background-color: #3F681C; color: white;">
                                                                        <?php endif; ?>
                                                                        <caption><?php echo $rTerlayani[$key]['poli']; ?></caption>
                                                                        <hr>
                                                                        </div>
                                                                        <!-- close div level 3-->
                                                                        <table style="width: 100%;">
                                                                            <thead>
                                                                                <th style="text-align: center;"><span class="glyphicon glyphicon-unchecked"></span>Pengunjung</th>
                                                                                <th style="text-align: center;"><span class="glyphicon glyphicon-check"></span>Terlayani</th>
                                                                            </thead>
                                                                            <tr>
                                                                                <td style="color: #FB6542;text-align: center;">
                                                                                    <h1><?php echo $rTerlayani[$key]['pengunjung'] ?></h1>
                                                                                </td>
                                                                                <td style="color: #375E97;text-align: center;">
                                                                                    <h1><?php echo $rTerlayani[$key]['terlayani'] ?></h1>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <!-- close div level 2 -->
                                                                </div>
                                                                <!-- close div level 1 -->

                                                                <!-- incremental variabel x -->
                                                                <?php $x = $x + 1; ?>
                                                            <?php endforeach; ?>
                                                            </div>

                                                        </div>
                                                    </div><!--./col-lg-7-->
                                                </div><!--./row-->

    </section>
</div>
<?php $this->endSection() ?>



<?php $this->section('cssContent') ?>


<script src="<?php echo base_url(); ?>plugin/amcharts/amcharts.js"></script>
<script src="<?php echo base_url(); ?>plugin/amcharts/serial.js"></script>
<script src="<?php echo base_url(); ?>plugin/amcharts/pie.js"></script>
<script src="<?php echo base_url(); ?>plugin/amcharts/themes/light.js"></script>
<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>

<script type="text/javascript">
    AmCharts.makeChart("harianBL", {
        "type": "serial",
        "categoryField": "category",
        "angle": 30,
        "depth3D": 30,
        "colors": [
            "#FB6542",
            "#375E97",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#CD0D74",
            "#CC0000",
            "#00CC00",
            "#0000CC",
            "#DDDDDD",
            "#999999",
            "#333333",
            "#990000"
        ],
        "startDuration": 1,
        "fontSize": 8,
        "theme": "light",
        "categoryAxis": {
            "gridPosition": "start"
        },
        "trendLines": [],
        "graphs": [{
                "balloonText": "[[title]] of [[category]]:[[value]]",
                "fillAlphas": 1,
                "id": "AmGraph-1",
                "title": "LAMA",
                "type": "column",
                "valueField": "column-1"
            },
            {
                "balloonText": "[[title]] of [[category]]:[[value]]",
                "fillAlphas": 1,
                "id": "AmGraph-2",
                "title": "BARU",
                "type": "column",
                "valueField": "column-2"
            }
        ],
        "guides": [],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "stackType": "regular",
            "title": "Jumlah Pasien"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
            "enabled": true,
            "useGraphSettings": true
        },
        "titles": [{
            "id": "Title-1",
            "size": 8,
            "text": "Kunjungan Pasien Baru/Lama Harian"
        }],
        "dataProvider": [
            <?php foreach ($rKHarian as $key => $value) : ?> {
                    <?php echo "\"category\": \"" . $rKHarian[$key]['tanggal'] . "\"," ?>
                    <?php echo "\"column-1\": " . $rKHarian[$key]['pasien_lama'] . "," ?>
                    <?php echo "\"column-2\": " . $rKHarian[$key]['pasien_baru'] . "," ?>
                },
            <?php endforeach; ?>
        ]
    });
    // script kunjungan bulanan
    AmCharts.makeChart("bulananBL", {
        "type": "serial",
        "categoryField": "category",
        "angle": 30,
        "depth3D": 30,
        "colors": [
            "#FB6542",
            "#375E97",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#CD0D74",
            "#CC0000",
            "#00CC00",
            "#0000CC",
            "#DDDDDD",
            "#999999",
            "#333333",
            "#990000"
        ],
        "startDuration": 1,
        "fontSize": 8,
        "theme": "light",
        "categoryAxis": {
            "gridPosition": "start"
        },
        "trendLines": [],
        "graphs": [{
                "balloonText": "[[title]] of [[category]]:[[value]]",
                "fillAlphas": 1,
                "id": "AmGraph-1",
                "title": "LAMA",
                "type": "column",
                "valueField": "column-1"
            },
            {
                "balloonText": "[[title]] of [[category]]:[[value]]",
                "fillAlphas": 1,
                "id": "AmGraph-2",
                "title": "BARU",
                "type": "column",
                "valueField": "column-2"
            }
        ],
        "guides": [],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "stackType": "regular",
            "title": "Jumlah Pasien"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
            "enabled": true,
            "useGraphSettings": true
        },
        "titles": [{
            "id": "Title-1",
            "size": 8,
            "text": "Kunjungan Pasien Baru/Lama Bulanan"
        }],
        "dataProvider": [
            <?php foreach ($rKBulanan as $key => $value) : ?> {
                    <?php echo "\"category\": \"" . $rKBulanan[$key]['bulan'] . "/" . $rKBulanan[$key]['tahun'] . "\"," ?>
                    <?php echo "\"column-1\": " . $rKBulanan[$key]['pasien_lama'] . "," ?>
                    <?php echo "\"column-2\": " . $rKBulanan[$key]['pasien_baru'] . "," ?>
                },
            <?php endforeach; ?>
        ]
    });
</script>
<script type="text/javascript">
    AmCharts.makeChart("pieDaerah", {
            "type": "pie",
            "angle": 12,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "depth3D": 15,
            "colors": [
                "#375E97",
                "#FB6542",
                "#FFBB00",
                "#FCD202",
                "#F8FF01",
                "#B0DE09",
                "#04D215",
                "#0D8ECF",
                "#0D52D1",
                "#2A0CD0",
                "#8A0CCF",
                "#CD0D74",
                "#754DEB",
                "#DDDDDD",
                "#999999",
                "#333333",
                "#000000",
                "#57032A",
                "#CA9726",
                "#990000",
                "#4B0C25"
            ],
            "titleField": "category",
            "valueField": "column-1",
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": true,
                "align": "center",
                "markerType": "circle"
            },
            "titles": [],
            "dataProvider": [
                <?php foreach ($rPasienDaerah as $key => $value) : ?> {
                        <?php echo "\"category\": \"" . $rPasienDaerah[$key]['isnew'] . "\"," ?>
                        <?php echo "\"column-1\": " . $rPasienDaerah[$key]['jml'] . "," ?>
                    },
                <?php endforeach; ?>
            ]
        }

    )
</script>
<script type="text/javascript">
    AmCharts.makeChart("pieUmur", {
            "type": "pie",
            "angle": 12,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "depth3D": 15,
            "colors": [
                "#375E97",
                "#FB6542",
                "#FFBB00",
                "#FCD202",
                "#F8FF01",
                "#B0DE09",
                "#04D215",
                "#0D8ECF",
                "#0D52D1",
                "#2A0CD0",
                "#8A0CCF",
                "#CD0D74",
                "#754DEB",
                "#DDDDDD",
                "#999999",
                "#333333",
                "#000000",
                "#57032A",
                "#CA9726",
                "#990000",
                "#4B0C25"
            ],
            "titleField": "category",
            "valueField": "column-1",
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": true,
                "align": "center",
                "markerType": "circle"
            },
            "titles": [],
            "dataProvider": [
                <?php foreach ($rPasienUmur as $key => $value) : ?> {
                        <?php echo "\"category\": \"" . $rPasienUmur[$key]['isnew'] . "\"," ?>
                        <?php echo "\"column-1\": " . $rPasienUmur[$key]['jml'] . "," ?>
                    },
                <?php endforeach; ?>
            ]
        }

    )
</script>
<script type="text/javascript">
    AmCharts.makeChart("pieStatus", {
            "type": "pie",
            "angle": 12,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "depth3D": 15,
            "colors": [
                "#375E97",
                "#FB6542",
                "#FFBB00",
                "#FCD202",
                "#F8FF01",
                "#B0DE09",
                "#04D215",
                "#0D8ECF",
                "#0D52D1",
                "#2A0CD0",
                "#8A0CCF",
                "#CD0D74",
                "#754DEB",
                "#DDDDDD",
                "#999999",
                "#333333",
                "#000000",
                "#57032A",
                "#CA9726",
                "#990000",
                "#4B0C25"
            ],
            "titleField": "category",
            "valueField": "column-1",
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": true,
                "align": "center",
                "markerType": "circle"
            },
            "titles": [],
            "dataProvider": [
                <?php foreach ($rRajalBayar as $key => $value) : ?> {
                        <?php echo "\"category\": \"" . $rRajalBayar[$key]['NAME_OF_STATUS_PASIEN'] . "\"," ?>
                        <?php echo "\"column-1\": " . $rRajalBayar[$key]['jml'] . "," ?>
                    },
                <?php endforeach; ?>
            ]
        }

    )
</script>
<script type="text/javascript">
    AmCharts.makeChart("grafikKamar", {
        "type": "serial",
        "categoryField": "category",
        "rotate": true,
        "angle": 50,
        "depth3D": 20,
        "startDuration": 1,
        "categoryAxis": {
            "gridPosition": "start"
        },
        "chartCursor": {
            "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "colorField": "color",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "lineColorField": "color",
            "title": "graph 1",
            "type": "column",
            "valueField": "column-1"
        }],
        "guides": [],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "titles": [{
            "id": "Title-1",
            "size": 15,
            "text": "Jumlah Pasien Per Dokter"
        }],
        "dataProvider": [
            <?php foreach ($rGrafikDokter as $key => $value) : ?> {
                    <?php echo "\"category\": \"" . $rGrafikDokter[$key]['fullname'] . "\"," ?>
                    <?php echo "\"column-1\": " . $rGrafikDokter[$key]['jml'] . "," ?>
                        "color": "#FFBB00"
                },
            <?php endforeach; ?>
        ]
    })
</script>
<?php $this->endSection() ?>