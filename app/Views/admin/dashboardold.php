<?php $this->extend('layout/default', [
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

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box" title="kunjunganrajal">
                    <a href="<?php echo site_url('admin/admin/dashboardrajal') ?>">
                        <span class="info-box-icon bg-green"><i class="fas fa-stethoscope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rawat Jalan</span>
                            <span class="info-box-number"><?= $kunjJalan; ?></span>
                            <p class="m-0">1 Bulan</p>
                        </div>
                    </a>
                </div>
            </div><!--./col-lg-3-->
            <div class="col-lg-3 col-md-3 col-sm-6" title="Rawat Inap">
                <div class="info-box">
                    <a href="<?php echo site_url('admin/admin/dashboardranap') ?>">
                        <span class="info-box-icon bg-green"><i class="fas fa-procedures"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rawat Inap</span>
                            <span class="info-box-number"><?= $kunjInap; ?></span>
                            <span class="info-box-text">1 Bulan</span>
                        </div>
                    </a>
                </div>
            </div><!--./col-lg-2-->
            <div class="col-lg-3 col-md-3 col-sm-6" title="IGD">
                <div class="info-box">
                    <a href="<?php echo site_url('admin/vehicle/getcallambulance') ?>">
                        <span class="info-box-icon bg-green"><i class="fas fa-ambulance"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">IGD</span>
                            <span class="info-box-number"><?= $kunjUGD; ?></span>
                            <span class="info-box-text">1 Bulan</span>
                        </div>
                    </a>
                </div>
            </div><!--./col-lg-2-->
            <div class="col-lg-3 col-md-3 col-sm-6" title="Total">
                <div class="info-box">
                    <a href="<?php echo site_url('admin/income') ?>">
                        <span class="info-box-icon bg-green"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total</span>
                            <span class="info-box-number"><?php echo $kunjRS; ?></span>
                            <span class="info-box-text">1 Bulan</span>
                        </div>
                    </a>
                </div>
            </div><!--./col-lg-2-->
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col60">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kunjungan Tahunan</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <?php $x = 0; ?>
                    <?php foreach ($kunjungan as $keychart => $valuechart) { ?>
                        <?php if ($x % 6 == 0) { ?>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="lineChart<?= $x; ?>" style="height:250"></canvas>
                                </div>
                            </div>
                        <?php } ?>
                        <?php $x++; ?>
                    <?php } ?>

                </div>
            </div><!--./col-lg-7-->
            <div class="col-lg-6 col-md-6 col-sm-12 col40">
                <div class="row">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Grafik Per Status Pasien </h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="statusChart" style="height:250px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top X Diagnosa Rawat Jalan </h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="rajalChart" style="height:250px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top X Diagnosa Rawat Inap </h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="ranapChart" style="height:250px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kunjungan Saat Ini </h3>
                            <p class="text-muted font-14 m-b-20">
                                Antrian poli berikut bersifat realtime
                            </p>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="widget-chart text-center">
                            <table class="table table-striped table-bordered" style="font-size: 10px">
                                <thead>
                                    <tr>
                                        <th>Nama Poli</th>
                                        <th>Antrian Saat Ini</th>
                                        <th>Pasien Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody id="antrian">
                                    <tr>
                                        <td>ANAK</td>
                                        <td>5</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH DIGESTIF</td>
                                        <td>11</td>
                                        <td>17</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH MULUT</td>
                                        <td>0</td>
                                        <td>21</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH ONKOLOGI</td>
                                        <td>0</td>
                                        <td>43</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH ORTOPEDI</td>
                                        <td>7</td>
                                        <td>7</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH SYARAF</td>
                                        <td>0</td>
                                        <td>24</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH UMUM</td>
                                        <td>0</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>BEDAH VASKULER DAN ENDOVASKULER</td>
                                        <td>7</td>
                                        <td>7</td>
                                    </tr>
                                    <tr>
                                        <td>DALAM</td>
                                        <td>0</td>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <td>DEPO IGD</td>
                                        <td>0</td>
                                        <td>null</td>
                                    </tr>
                                    <tr>
                                        <td>DEPO RAWAT INAP</td>
                                        <td>0</td>
                                        <td>null</td>
                                    </tr>
                                    <tr>
                                        <td>DEPO RAWAT JALAN</td>
                                        <td>0</td>
                                        <td>null</td>
                                    </tr>
                                    <tr>
                                        <td>GASTRO</td>
                                        <td>0</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>GIGI DAN MULUT</td>
                                        <td>0</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>HEMODIALISA</td>
                                        <td>0</td>
                                        <td>26</td>
                                    </tr>
                                    <tr>
                                        <td>IRD/UGD</td>
                                        <td>0</td>
                                        <td>62</td>
                                    </tr>
                                    <tr>
                                        <td>JANTUNG</td>
                                        <td>46</td>
                                        <td>46</td>
                                    </tr>
                                    <tr>
                                        <td>KULIT &amp; KELAMIN</td>
                                        <td>0</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>MATA</td>
                                        <td>0</td>
                                        <td>6</td>
                                    </tr>
                                    <tr>
                                        <td>MEDICAL CHECK-UP</td>
                                        <td>0</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>ONKOLOGI GINEKOLOGI</td>
                                        <td>0</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>PARU</td>
                                        <td>0</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td>PKT-VCT</td>
                                        <td>0</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td>REHABILITASI MEDIK</td>
                                        <td>0</td>
                                        <td>58</td>
                                    </tr>
                                    <tr>
                                        <td>SYARAF</td>
                                        <td>8</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>T.H.T</td>
                                        <td>0</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>TB MDR</td>
                                        <td>0</td>
                                        <td>19</td>
                                    </tr>
                                    <tr>
                                        <td>UROLOGI</td>
                                        <td>8</td>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <td>VISUM</td>
                                        <td>0</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--./col-lg-5-->
        </div><!--./row-->
        <!-- <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col80">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo lang('calendar'); ?></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-hover table-striped table-bordered ajaxlist dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>KLINIK</th>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                    <th>Minggu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dokter as $key => $value) { ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" data-toggle="tooltip" data-target="#viewModal" title="" onclick="viewDetail(4569)" data-original-title=""><?= $key; ?></a></td>
                                        <td><?= $dokter[$key]['1']; ?></td>
                                        <td><?= $dokter[$key]['2']; ?></td>
                                        <td><?= $dokter[$key]['3']; ?></td>
                                        <td><?= $dokter[$key]['4']; ?></td>
                                        <td><?= $dokter[$key]['5']; ?></td>
                                        <td><?= $dokter[$key]['6']; ?></td>
                                        <td><?= $dokter[$key]['7']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
</div>

<script src="<?php echo base_url() ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url() ?>backend/js/utils.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var dataPointss = [];
        var MONTHS = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var color = ['#f56954', '#00a65a', '#f39c12', '#2f4074', '#00c0ef', '#3c8dbc', '#d2d6de', '#b7b83f'];

        <?php $y = 0; ?>
        <?php $maxindex = count($kunjungan); ?>
        <?php foreach ($kunjungan as $keydata => $valuedata) { ?>
            <?php $randnumber = rand(0, 7); ?>
            <?php if ($y % 6 == 0) { ?>
                <?php $index = $y ?>
                var config<?= $y; ?> = {
                    type: 'line',
                    data: {
                        labels: MONTHS,
                        datasets: [
                        <?php } ?> {
                            label: '<?= $keydata; ?>',
                            fill: false,
                            backgroundColor: color[<?= $randnumber; ?>],
                            borderColor: color[<?= $randnumber; ?>],
                            data: [
                                <?php foreach ($valuedata as $key1 => $value1) { ?>
                                    <?= $valuedata[$key1]; ?>,
                                <?php } ?>

                            ],
                        },
                        <?php if ($y % 6 == 5 || $y == $maxindex - 1) { ?>
                        ]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: false,
                            text: 'Chart Data'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Month'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Value'
                                },

                            }]
                        }
                    }
                };
                var ctx<?= $index; ?> = document.getElementById('lineChart<?= $index; ?>').getContext('2d');
                window.myLine = new Chart(ctx<?= $index; ?>, config<?= $index; ?>);
            <?php } ?>


            <?php $y++; ?>
        <?php } ?>


        function shuffle(array) {
            let currentIndex = array.length,
                randomIndex;

            // While there remain elements to shuffle.
            while (currentIndex != 0) {

                // Pick a remaining element.
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;

                // And swap it with the current element.
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex], array[currentIndex]
                ];
            }

            return array;
        }

        /* Rajal chart */
        var colors = ['#f56954', '#00a65a', '#f39c12', '#2f4074', '#00c0ef', '#3c8dbc', '#d2d6de', '#b7b83f'];
        var color = shuffle(colors);
        var datas = {
            "value": [
                <?php foreach ($topXRajal as $key => $value) { ?>
                    <?= $topXRajal[$key]['JML']; ?>,
                <?php } ?>
            ],
            "label": [
                <?php foreach ($topXRajal as $key => $value) { ?> "<?= $topXRajal[$key]['DIAGNOSA_ID']; ?>",
                <?php } ?>
            ]
        };
        var configrajal = {
            type: 'bar',
            data: {
                datasets: [{
                    data: datas.value,
                    backgroundColor: [
                        '#715d20',
                        window.chartColors.orange,
                        window.chartColors.yellow,
                        window.chartColors.green,
                        window.chartColors.purple,
                        window.chartColors.blue,
                        window.chartColors.grey,
                        '#42b782',
                        '#66aa18',
                    ],
                    label: 'Top X Diagnosa Rajal'
                }],
                labels: datas.label,
            },
            options: {
                indexAxis: 'y',
                beginAtZero: true,
                responsive: true,
            }
        };
        var ctxrajal = document.getElementById('rajalChart').getContext('2d');
        window.myDoughnut = new Chart(ctxrajal, configrajal);


        /* Ranap chart */
        color = shuffle(colors);
        var datas = {
            "value": [
                <?php foreach ($topXRanap as $key => $value) { ?>
                    <?= $topXRanap[$key]['JML']; ?>,
                <?php } ?>
            ],
            "label": [
                <?php foreach ($topXRanap as $key => $value) { ?> "<?= $topXRanap[$key]['DIAGNOSA_ID']; ?>",
                <?php } ?>
            ]
        };
        var configranap = {
            type: 'bar',
            data: {
                datasets: [{
                    data: datas.value,
                    backgroundColor: [
                        '#715d20',
                        window.chartColors.orange,
                        window.chartColors.yellow,
                        window.chartColors.green,
                        window.chartColors.purple,
                        window.chartColors.blue,
                        window.chartColors.grey,
                        '#42b782',
                        '#66aa18',
                    ],
                    label: 'Top X Diagnosa Rajal'
                }],
                labels: datas.label,
            },
            options: {
                indexAxis: 'y',
                beginAtZero: true,
                responsive: true,
            }
        };
        var ctxranap = document.getElementById('ranapChart').getContext('2d');
        window.myDoughnut = new Chart(ctxranap, configranap);


        /* Status chart */
        var color = ['#f56954', '#00a65a', '#f39c12', '#2f4074', '#00c0ef', '#3c8dbc', '#d2d6de', '#b7b83f'];
        var datas = {
            "value": [
                <?php foreach ($status as $key => $value) { ?>
                    <?= $status[$key]['JML']; ?>,
                <?php } ?>
            ],
            "label": [
                <?php foreach ($status as $key => $value) { ?> "<?= $status[$key]['name']; ?>",
                <?php } ?>
            ]
        };
        /* donut chart */
        var configstatus = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: datas.value,
                    backgroundColor: [
                        '#715d20',
                        window.chartColors.orange,
                        window.chartColors.yellow,
                        window.chartColors.green,
                        window.chartColors.purple,
                        window.chartColors.blue,
                        window.chartColors.grey,
                        '#42b782',
                        '#66aa18',
                    ],
                    label: 'Dataset 1'
                }],
                labels: datas.label,
            },
            options: {
                indexAxis: 'y',
                beginAtZero: true,
                responsive: true,
                circumference: Math.PI,
                rotation: -Math.PI,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Chart.js Doughnut Chart'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };
        var ctxstatus = document.getElementById('statusChart').getContext('2d');
        window.myDoughnut = new Chart(ctxstatus, configstatus);
    }

    $(document).ready(function() {
        $(document).on('click', '.close_notice', function() {
            var data = $(this).data();
            $.ajax({
                type: "POST",
                url: base_url + "admin/notification/read",
                data: {
                    'notice': data.noticeid
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == "fail") {

                        errorMsg(data.msg);
                    } else {
                        successMsg(data.msg);
                    }

                }
            });
        });
    });
</script>

<?php $this->endSection() ?>