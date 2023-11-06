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
                <h4 class="card-title mb-3">Inbox</h4>
                <div class="inbox-wid">
                    <a href="#" class="text-dark">
                        <div class="inbox-item">
                            <div class="inbox-item-img float-start me-3"><img src="assets/images/users/user-1.jpg" class="avatar-sm rounded-circle" alt=""></div>
                            <h6 class="inbox-item-author mb-1 font-size-16">Misty</h6>
                            <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                            <p class="inbox-item-date text-muted">13:40 PM</p>
                        </div>
                    </a>
                    <a href="#" class="text-dark">
                        <div class="inbox-item">
                            <div class="inbox-item-img float-start me-3"><img src="assets/images/users/user-2.jpg" class="avatar-sm rounded-circle" alt=""></div>
                            <h6 class="inbox-item-author mb-1 font-size-16">Melissa</h6>
                            <p class="inbox-item-text text-muted mb-0">I've finished it! See you so...</p>
                            <p class="inbox-item-date text-muted">13:34 PM</p>
                        </div>
                    </a>
                    <a href="#" class="text-dark">
                        <div class="inbox-item">
                            <div class="inbox-item-img float-start me-3"><img src="assets/images/users/user-3.jpg" class="avatar-sm rounded-circle" alt=""></div>
                            <h6 class="inbox-item-author mb-1 font-size-16">Dwayne</h6>
                            <p class="inbox-item-text text-muted mb-0">This theme is awesome!</p>
                            <p class="inbox-item-date text-muted">13:17 PM</p>
                        </div>
                    </a>
                    <a href="#" class="text-dark">
                        <div class="inbox-item">
                            <div class="inbox-item-img float-start me-3"><img src="assets/images/users/user-4.jpg" class="avatar-sm rounded-circle" alt=""></div>
                            <h6 class="inbox-item-author mb-1 font-size-16">Martin</h6>
                            <p class="inbox-item-text text-muted mb-0">Nice to meet you</p>
                            <p class="inbox-item-date text-muted">12:20 PM</p>
                        </div>
                    </a>
                    <a href="#" class="text-dark">
                        <div class="inbox-item">
                            <div class="inbox-item-img float-start me-3"><img src="assets/images/users/user-5.jpg" class="avatar-sm rounded-circle" alt=""></div>
                            <h6 class="inbox-item-author mb-1 font-size-16">Vincent</h6>
                            <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                            <p class="inbox-item-date text-muted">11:47 AM</p>
                        </div>
                    </a>

                    <a href="#" class="text-dark">
                        <div class="inbox-item">
                            <div class="inbox-item-img float-start me-3"><img src="assets/images/users/user-6.jpg" class="avatar-sm rounded-circle" alt=""></div>
                            <h6 class="inbox-item-author mb-1 font-size-16">Robert Chappa</h6>
                            <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                            <p class="inbox-item-date text-muted">10:12 AM</p>
                        </div>
                    </a>

                </div>
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
                <h4 class="card-title mb-4">Recent Activity Feed</h4>

                <ol class="activity-feed mb-0">
                    <li class="feed-item">
                        <div class="feed-item-list">
                            <span class="date">Jun 25</span>
                            <span class="activity-text">Responded to need “Volunteer Activities”</span>
                        </div>
                    </li>
                    <li class="feed-item">
                        <div class="feed-item-list">
                            <span class="date">Jun 24</span>
                            <span class="activity-text">Added an interest “Volunteer Activities”</span>
                        </div>
                    </li>
                    <li class="feed-item">
                        <div class="feed-item-list">
                            <span class="date">Jun 23</span>
                            <span class="activity-text">Joined the group “Boardsmanship Forum”</span>
                        </div>
                    </li>
                    <li class="feed-item">
                        <div class="feed-item-list">
                            <span class="date">Jun 21</span>
                            <span class="activity-text">Responded to need “In-Kind Opportunity”</span>
                        </div>
                    </li>
                </ol>

                <div class="text-center">
                    <a href="#" class="btn btn-sm btn-primary">Load More</a>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-4">
        <div class="card widget-user">
            <div class="widget-user-desc p-4 text-center bg-primary position-relative">
                <i class="fas fa-quote-left h2 text-white-50"></i>
                <p class="text-white mb-0">The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe the same vocabulary. The languages only in their grammar.</p>
            </div>
            <div class="p-4">
                <div class="float-start mt-2 me-3">
                    <img src="<?php echo base_url(); ?>assets/images/users/user-2.jpg" alt="" class="rounded-circle avatar-sm">
                </div>
                <h6 class="mb-1 font-size-16 mt-2">Marie Minnick</h6>
                <p class="text-muted mb-0">Marketing Manager</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Yearly Sales</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <h3>52,345</h3>
                            <p class="text-muted">The languages only differ grammar</p>
                            <a href="#" class="text-primary">Learn more <i class="mdi mdi-chevron-double-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-8 text-end">
                        <div id="sparkline" data-colors='["--bs-primary"]'></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Transactions</h4>

                <div class="table-responsive">
                    <table class="table align-middle table-centered table-vertical table-nowrap">

                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs rounded-circle me-2" /> Herbert C. Patton
                                </td>
                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                <td>
                                    $14,584
                                    <p class="m-0 text-muted font-size-14">Amount</p>
                                </td>
                                <td>
                                    5/12/2016
                                    <p class="m-0 text-muted font-size-14">Date</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-3.jpg" alt="user-image" class="avatar-xs rounded-circle me-2" /> Mathias N. Klausen
                                </td>
                                <td><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Waiting payment</td>
                                <td>
                                    $8,541
                                    <p class="m-0 text-muted font-size-14">Amount</p>
                                </td>
                                <td>
                                    10/11/2016
                                    <p class="m-0 text-muted font-size-14">Date</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-4.jpg" alt="user-image" class="avatar-xs rounded-circle me-2" /> Nikolaj S. Henriksen
                                </td>
                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                <td>
                                    $954
                                    <p class="m-0 text-muted font-size-14">Amount</p>
                                </td>
                                <td>
                                    8/11/2016
                                    <p class="m-0 text-muted font-size-14">Date</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-5.jpg" alt="user-image" class="avatar-xs rounded-circle me-2" /> Lasse C. Overgaard
                                </td>
                                <td><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Payment expired</td>
                                <td>
                                    $44,584
                                    <p class="m-0 text-muted font-size-14">Amount</p>
                                </td>
                                <td>
                                    7/11/2016
                                    <p class="m-0 text-muted font-size-14">Date</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-6.jpg" alt="user-image" class="avatar-xs rounded-circle me-2" /> Kasper S. Jessen
                                </td>
                                <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                <td>
                                    $8,844
                                    <p class="m-0 text-muted font-size-14">Amount</p>
                                </td>
                                <td>
                                    1/11/2016
                                    <p class="m-0 text-muted font-size-14">Date</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Orders</h4>

                <div class="table-responsive">
                    <table class="table align-middle table-centered table-vertical table-nowrap mb-1">

                        <tbody>
                            <tr>
                                <td>#12354781</td>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-1.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $185
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#52140300</td>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-2.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Shine Company Catalina
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $1,024
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#96254137</td>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-3.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Trex Outdoor Furniture Cape
                                </td>
                                <td><span class="badge rounded-pill bg-danger">Cancel</span></td>
                                <td>
                                    $657
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#12365474</td>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-4.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Oasis Bathroom Teak Corner
                                </td>
                                <td><span class="badge rounded-pill bg-warning">Shipped</span></td>
                                <td>
                                    $8451
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                            <tr>
                                <td>#85214796</td>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-5.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> BeoPlay Speaker
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $584
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#12354781</td>
                                <td>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user-6.jpg" alt="user-image" class="avatar-xs me-2 rounded-circle" /> Riverston Glass Chair
                                </td>
                                <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                <td>
                                    $185
                                </td>
                                <td>
                                    5/12/2016
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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