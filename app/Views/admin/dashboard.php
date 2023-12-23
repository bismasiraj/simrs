<?php $this->extend('layout/dashlayout', [
    'dokter' => $dokter,
    'kunjJalan' => $kunjJalan,
    'kunjInap' => $kunjInap,
    'kunjUGD' => $kunjUGD,
    'kunjRS' => $kunjRS,
    'status' => $status,
    'topXRanap' => $topXRanap,
    'topXRajal' => $topXRajal,
    'kunjungan' => $kunjungan,
    'umur' => $umur,
    'totalUmurRI' => $totalUmurRI,
    'totalUmurRJ' => $totalUmurRJ,
    'totalUmur' => $totalUmur,
    'kamar' => $kamar,
    'poli' => $poli,
    'kunjPoli' => $kunjPoli,
    'orgunit' => $orgunit,
    'img_time' => $img_time
]) ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-cube-outline float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Rawat Jalan</h6>
                    <h2 class="mb-4 text-white"><?= $kunjJalan; ?></h2>
                    <!-- <span class="badge bg-info"> +11% </span> <span class="ms-2">From previous period</span> -->
                    <span class="ms-2">1 Bulan</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-buffer float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Rawat Inap</h6>
                    <h2 class="mb-4 text-white"><?= $kunjInap; ?></h2>
                    <!-- <span class="badge bg-danger"> -29% </span> <span class="ms-2">From previous period</span> -->
                    <span class="ms-2">1 Bulan</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-tag-text-outline float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">IGD</h6>
                    <h2 class="mb-4 text-white"><?= $kunjUGD; ?></h2>
                    <!-- <span class="badge bg-warning"> 0% </span>  -->
                    <span class="ms-2">1 Bulan</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card mini-stat bg-primary">
            <div class="card-body mini-stat-img">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-briefcase-check float-end"></i>
                </div>
                <div class="text-white">
                    <h6 class="text-uppercase mb-3 font-size-16 text-white">Total</h6>
                    <h2 class="mb-4 text-white"><?php echo $kunjRS; ?></h2>
                    <!-- <span class="badge bg-info"> +89% </span> <span class="ms-2">From previous period</span> -->
                    <span class="ms-2">1 Bulan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Top X Rawat Jalan</h4>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20"></h5>
                        <p class="text-muted"></p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20"></h5>
                        <p class="text-muted"></p>
                    </div>
                </div>

                <div id="topXRajal" data-colors='["--bs-info","#adb5bd"]' class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>


    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Kunjungan Poli</h4>

                <div class="row text-center mt-4">
                    <div class="col-4">
                        <h5 class="font-size-20"><?= $kunjJalan; ?></h5>
                        <p class="text-muted">Rawat Jalan</p>
                    </div>
                    <div class="col-4">
                        <h5 class="font-size-20"><?= $kunjInap; ?></h5>
                        <p class="text-muted">Rawat Inap</p>
                    </div>
                    <div class="col-4">
                        <h5 class="font-size-20"><?= $kunjUGD; ?></h5>
                        <p class="text-muted">IGD</p>
                    </div>
                </div>

                <div id="kunjunganChart" data-colors='["#adb5bd","--bs-primary","--bs-info"]' class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Top X Rawat Inap</h4>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20"></h5>
                        <p class="text-muted"></p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20"></h5>
                        <p class="text-muted"></p>
                    </div>
                </div>

                <div id="topXRanap" data-colors='["--bs-info","#adb5bd"]' class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>

</div>
<!-- end row -->

<div class="row">


    <div class="col-xl-4 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Grafik Per Daerah</h4>

                <!-- <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20"><?= $status[1]['JML']; ?></h5>
                        <p class="text-muted">UMUM</p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20"><?= $status[18]['JML']; ?></h5>
                        <p class="text-muted">BPJS</p>
                    </div>
                </div> -->
                <div id="daerahChart" data-colors='["#adb5bd","--bs-primary","--bs-info"]' class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Grafik Per Status Pasien</h4>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20"><?= $status[1]['JML']; ?></h5>
                        <p class="text-muted">UMUM</p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20"><?= $status[18]['JML']; ?></h5>
                        <p class="text-muted">BPJS</p>
                    </div>
                </div>
                <div id="statusChart" data-colors='["#adb5bd","--bs-primary","--bs-info"]' class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Grafik Per Umur</h4>

                <!-- <div class="row text-center mt-4">
                    <div class="col-6">
                        <h5 class="font-size-20"><?= $status[1]['JML']; ?></h5>
                        <p class="text-muted">UMUM</p>
                    </div>
                    <div class="col-6">
                        <h5 class="font-size-20"><?= $status[18]['JML']; ?></h5>
                        <p class="text-muted">BPJS</p>
                    </div>
                </div> -->
                <div id="umurChart" data-colors='["#adb5bd","--bs-primary","--bs-info"]' class="morris-charts morris-charts-height" dir="ltr"></div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- end row -->
<?php $this->endSection() ?>

<?php $this->section('jsContent') ?>
<script type="text/javascript">
    var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    <?php
    $month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    $months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    ?>

    function getChartColorsArray(e) {
        if (null !== document.getElementById(e)) {
            var r = document.getElementById(e).getAttribute("data-colors");
            if (r)
                return (r = JSON.parse(r)).map(function(e) {
                    var r = e.replace(" ", "");
                    if (-1 === r.indexOf(",")) {
                        var o = getComputedStyle(document.documentElement).getPropertyValue(r);
                        return o || r;
                    }
                    var a = e.split(",");
                    return 2 != a.length ? r : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(a[0]) + "," + a[1] + ")";
                });
            console.warn("data-colors Attribute not found on:", e);
        }
    }

    function ChartColorChange(r, o) {
        document.querySelectorAll(".theme-color").forEach(function(e) {
            e.addEventListener("click", function(e) {
                setTimeout(function() {
                    var e = getChartColorsArray(o);
                    r.options && (r.options.colors ? (r.options.colors = e) : r.options.lineColors ? (r.options.lineColors = e) : r.options.barColors && (r.options.barColors = e), r.redraw());
                }, 0);
            });
        });
    }

    function ChartColorChangeSparkLine(r, o, a) {
        document.querySelectorAll(".theme-color").forEach(function(e) {
            e.addEventListener("click", function(e) {
                setTimeout(function() {
                    var e = getChartColorsArray(a);
                    (o.barColor = e), $("#" + a).sparkline(r, o);
                }, 0);
            });
        });
    }!(function(e) {
        "use strict";

        function r() {}
        (r.prototype.createAreaChart = function(e, r, o, a, t, n, i, l, j) {
            ChartColorChange(
                Morris.Area({
                    element: e,
                    pointSize: 0,
                    lineWidth: 1,
                    data: a,
                    xkey: t,
                    ykeys: n,
                    labels: i,
                    resize: !0,
                    gridLineColor: "rgba(108, 120, 151, 0.1)",
                    hideHover: "auto",
                    lineColors: l,
                    fillOpacity: 0.9,
                    behaveLikeLine: !0,
                    xLabels: j,
                    xLabelFormat: function(s) {
                        return month[s.getMonth()];
                    }
                }),
                "morris-area-example"
            );
        }),
        (r.prototype.createDonutChart = function(e, r, o) {
            ChartColorChange(Morris.Donut({
                element: e,
                data: r,
                resize: !0,
                colors: o
            }), "morris-donut-example");
        }),
        (r.prototype.createStackedChart = function(e, r, o, a, t, n) {
            ChartColorChange(Morris.Bar({
                element: e,
                data: r,
                xkey: o,
                ykeys: a,
                stacked: !0,
                labels: t,
                hideHover: "auto",
                resize: !0,
                gridLineColor: "rgba(108, 120, 151, 0.1)",
                barColors: n
            }), "morris-bar-stacked");
        }),
        (r.prototype.init = function() {
            var e = getChartColorsArray("kunjunganChart");
            e &&
                this.createAreaChart(
                    "kunjunganChart",
                    0,
                    0,
                    [
                        <?php $y = 0; ?>
                        <?php foreach ($kunjungan as $key => $value) { ?> {
                                y: "2023-<?= $y + 1; ?>",
                                <?php $i = 0; ?>
                                <?php foreach ($value as $key1 => $value1) {
                                    echo $i . ':' . $value1 . ',';
                                    $i++;
                                } ?>
                                <?php $y++; ?>
                            },
                        <?php } ?>
                    ],
                    "y",
                    [
                        <?php foreach ($kunjungan as $key => $value) { ?>
                            <?php $i = 0; ?>
                            <?php foreach ($value as $key1 => $value1) {
                                echo '"' . $i . '",';
                                $i++;
                            }
                            break; ?>
                        <?php } ?>
                    ],
                    [
                        <?php foreach ($kunjungan as $key => $value) { ?>
                            <?php foreach ($value as $key1 => $value1) {
                                echo '"' . $key1 . '",';
                            }
                            break; ?>
                        <?php } ?>
                    ],
                    e,
                    "month"
                );

            var r = getChartColorsArray("daerahChart");
            r &&
                this.createDonutChart(
                    "daerahChart",
                    [
                        <?php foreach ($rPasienDaerah as $key => $value) : ?> {
                                label: "<?= $rPasienDaerah[$key]['isnew']; ?>",
                                value: <?= $rPasienDaerah[$key]['jml']; ?>,
                            },
                        <?php endforeach; ?>
                    ],
                    r
                );
            var r = getChartColorsArray("statusChart");
            r &&
                this.createDonutChart(
                    "statusChart",
                    [
                        <?php $jmlLain = 0; ?>
                        <?php foreach ($status as $key => $value) { ?>
                            <?php if ($key != '1' && $key != '18') { ?>
                                <?php $jmlLain += $status[$key]['JML']; ?>
                            <?php } ?>
                            <?php if ($key == '1' || $key == '18') { ?> {
                                    label: "<?= $status[$key]['name']; ?>",
                                    value: <?= $status[$key]['JML']; ?>,
                                },
                            <?php } ?>
                        <?php } ?> {
                            label: "Lain-lain",
                            value: <?= $jmlLain; ?>,
                        }
                    ],
                    r
                );
            var r = getChartColorsArray("umurChart");
            r &&
                this.createDonutChart(
                    "umurChart",
                    [
                        <?php foreach ($rPasienUmur as $key => $value) : ?> {
                                label: "<?= $rPasienUmur[$key]['isnew']; ?>",
                                value: <?= $rPasienUmur[$key]['jml']; ?>,
                            },
                        <?php endforeach; ?>
                    ],
                    r
                );
            var o = getChartColorsArray("topXRajal");
            o &&
                this.createStackedChart(
                    "topXRajal",
                    [
                        <?php foreach ($topXRajal as $key => $value) { ?> {
                                y: "<?= $topXRajal[$key]['DIAGNOSA_ID']; ?>",
                                jml: <?= $topXRajal[$key]['JML']; ?>,
                            },
                        <?php } ?>
                    ],
                    "y",
                    ["jml"],
                    ["Jumlah"],
                    o
                );
            var o = getChartColorsArray("topXRanap");
            o &&
                this.createStackedChart(
                    "topXRanap",
                    [
                        <?php foreach ($topXRanap as $key => $value) { ?> {
                                y: "<?= $topXRanap[$key]['DIAGNOSA_ID']; ?>",
                                jml: <?= $topXRanap[$key]['JML']; ?>,
                            },
                        <?php } ?>
                    ],
                    "y",
                    ["jml"],
                    ["Jumlah"],
                    o
                );
        }),
        (e.Dashboard = new r()),
        (e.Dashboard.Constructor = r);
    })(window.jQuery),
    (function() {
        "use strict";
        window.jQuery.Dashboard.init();
    })();
    var series,
        chartoption,
        demo,
        sparklineChart1Colors = getChartColorsArray("sparkline");
    sparklineChart1Colors &&
        ((series = [8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12]),
            (chartoption = {
                type: "bar",
                height: "130",
                barWidth: "10",
                barSpacing: "7",
                barColor: "#7A6FBE"
            }),
            (demo = $("#sparkline").sparkline(series, chartoption)),
            ChartColorChangeSparkLine(series, chartoption, "sparkline"));
</script>
<?php $this->endSection() ?>