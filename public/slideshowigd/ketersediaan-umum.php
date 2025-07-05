<?php
require_once('connection.php');
require_once('function.php');

$qKamarKelas = 'execute dbo.web_D11_Ketersediaan_TT_Perkelas';
$rKamarKelas = querryResult($dbconnect, $qKamarKelas);
$k1Utama = $k2Kelas1 = $k3Kelas2 = $k4Kelas3 = $k6VIP2 = $k7VIP1 = $k8VIPUtama = $kapasitas = $terisi = 0;
$c1Utama = $c2Kelas1 = $c3Kelas2 = $c4Kelas3 = $c6VIP2 = $c7VIP1 = $c8VIPUtama = 0;
$utama = $kelas1 = $kelas2 = $kelas3 = $vip2 = $vip1 = $vipUtama = array();

foreach ($rKamarKelas as $key => $value) {
  foreach ($value as $key1 => $value1) {
    if ($rKamarKelas[$key]['CLASS_ID'] == 11) {
      $utama[$key][$key1] = $value1;
    } elseif ($rKamarKelas[$key]['CLASS_ID'] == 2) {
      $kelas1[$key][$key1] = $value1;
    } elseif ($rKamarKelas[$key]['CLASS_ID'] == 3) {
      $kelas2[$key][$key1] = $value1;
    } elseif ($rKamarKelas[$key]['CLASS_ID'] == 4) {
      $kelas3[$key][$key1] = $value1;
    } elseif ($rKamarKelas[$key]['CLASS_ID'] == 6) {
      $vip2[$key][$key1] = $value1;
    } elseif ($rKamarKelas[$key]['CLASS_ID'] == 9) {
      $vip1[$key][$key1] = $value1;
    } elseif ($rKamarKelas[$key]['CLASS_ID'] == 8) {
      $vipUtama[$key][$key1] = $value1;
    }
  }

  $terisi = $terisi + $rKamarKelas[$key]['ISI'];
  $kapasitas = $kapasitas + $rKamarKelas[$key]['cap'];
}
$sisa = $kapasitas - $terisi;
?>

<script type="text/javascript">
  function utama() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas Umum";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas Umum"
        }],
        "dataProvider": [
          <?php foreach ($utama as $key => $value): ?> {
              <?php echo "\"category\": \"" . $utama[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $utama[$key]['ISI'] . "," ?>
              <?php $sisa = $utama[$key]['cap'] - $utama[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($utama as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $utama[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $utama[$key]['cap']; ?></td>' +
        '<td><?php echo $utama[$key]['cap'] - $utama[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($utama[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<script type="text/javascript">
  function kelas1() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas 1";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "colors": [
          "#375E97",
          "#FB6542",
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
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas 1"
        }],
        "dataProvider": [
          <?php foreach ($kelas1 as $key => $value): ?> {
              <?php echo "\"category\": \"" . $kelas1[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $kelas1[$key]['ISI'] . "," ?>
              <?php $sisa = $kelas1[$key]['cap'] - $kelas1[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($kelas1 as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $kelas1[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $kelas1[$key]['cap']; ?></td>' +
        '<td><?php echo $kelas1[$key]['cap'] - $kelas1[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($kelas1[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<script type="text/javascript">
  function kelas2() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas 2";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "colors": [
          "#FFBB00",
          "#FB6542",
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
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas 3"
        }],
        "dataProvider": [
          <?php foreach ($kelas2 as $key => $value): ?> {
              <?php echo "\"category\": \"" . $kelas2[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $kelas2[$key]['ISI'] . "," ?>
              <?php $sisa = $kelas2[$key]['cap'] - $kelas2[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($kelas2 as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $kelas2[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $kelas2[$key]['cap']; ?></td>' +
        '<td><?php echo $kelas2[$key]['cap'] - $kelas2[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($kelas2[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<script type="text/javascript">
  function kelas3() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas 3";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "colors": [
          "#FFBB00",
          "#FCD202",
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
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas 3"
        }],
        "dataProvider": [
          <?php foreach ($kelas3 as $key => $value): ?> {
              <?php echo "\"category\": \"" . $kelas3[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $kelas3[$key]['ISI'] . "," ?>
              <?php $sisa = $kelas3[$key]['cap'] - $kelas3[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($kelas3 as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $kelas3[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $kelas3[$key]['cap']; ?></td>' +
        '<td><?php echo $kelas3[$key]['cap'] - $kelas3[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($kelas3[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<script type="text/javascript">
  function vip2() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar VIP";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "colors": [
          "#FFBB00",
          "#F8FF01",
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
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas VIP 2"
        }],
        "dataProvider": [
          <?php foreach ($vip2 as $key => $value): ?> {
              <?php echo "\"category\": \"" . $vip2[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $vip2[$key]['ISI'] . "," ?>
              <?php $sisa = $vip2[$key]['cap'] - $vip2[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($vip2 as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $vip2[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $vip2[$key]['cap']; ?></td>' +
        '<td><?php echo $vip2[$key]['cap'] - $vip2[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($vip2[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<script type="text/javascript">
  function vip1() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas VIP 1";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "colors": [
          "#B0DE09",
          "#04D215",
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
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas VIP 1"
        }],
        "dataProvider": [
          <?php foreach ($vip1 as $key => $value): ?> {
              <?php echo "\"category\": \"" . $vip1[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $vip1[$key]['ISI'] . "," ?>
              <?php $sisa = $vip1[$key]['cap'] - $vip1[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($vip1 as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $vip1[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $vip1[$key]['cap']; ?></td>' +
        '<td><?php echo $vip1[$key]['cap'] - $vip1[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($vip1[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<script type="text/javascript">
  function vipUtama() {
    document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas VIP Utama";
    AmCharts.makeChart("pieKamar", {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 22,
        "sequencedAnimation": false,
        "rotate": true,
        "marginLeft": 19,
        "marginRight": 19,
        "colors": [
          "#B0DE09",
          "#04D215",
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
        "startDuration": 0.5,
        "startEffect": "bounce",
        "theme": "light",
        "categoryAxis": {
          "gridPosition": "start"
        },
        "chartCursor": {
          "enabled": true
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "[[category]] Terisi:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Kamar Terisi",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Tersisa:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Kamar Tersisa",
            "type": "column",
            "valueField": "column-2"
          }
        ],
        "guides": [],
        "valueAxes": [{
          "id": "ValueAxis-1",
          "stackType": "regular",
          "title": "Jumlah"
        }],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [{
          "id": "Title-1",
          "size": 15,
          "text": "Ketersediaan Kamar Kelas VIP Utama"
        }],
        "dataProvider": [
          <?php foreach ($vipUtama as $key => $value): ?> {
              <?php echo "\"category\": \"" . $vipUtama[$key]['NAME_OF_CLASS'] . "\"," ?>
              <?php echo "\"column-1\": " . $vipUtama[$key]['ISI'] . "," ?>
              <?php $sisa = $vipUtama[$key]['cap'] - $vipUtama[$key]['ISI']; ?>
              <?php echo "\"column-2\": " . $sisa . "," ?>
            },
          <?php endforeach; ?>
        ]
      }

    )
    document.getElementById("bodyTabel").innerHTML = "";
    <?php foreach ($vipUtama as $key => $value): ?>
      $("#bodyTabel").append('<tr>' +
        '<td><?php echo $vipUtama[$key]['NAME_OF_CLASS']; ?></td>' +
        '<td><?php echo $vipUtama[$key]['cap']; ?></td>' +
        '<td><?php echo $vipUtama[$key]['cap'] - $vipUtama[$key]['ISI']; ?></td>' +
        '<td><?php echo "Rp." . number_format($vipUtama[$key]['TARIF'], 2, ',', '.'); ?></td>' +
        '</tr>');
    <?php endforeach; ?>
  }
</script>
<!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
<!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="pieKamar" style="height: 500px; background-color: #FFFFFF;"></div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height:450px;">
  <form method="post">
    <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
      <thead>
        <th>Bangsal</th>
        <th>Kapasitas</th>
        <th>Kosong</th>
        <th>Harga</th>
      </thead>
      <tbody id="bodyTabel">

      </tbody>
    </table>
</div>



<!-- </div> -->
<!-- </div> -->

<?php
$qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=11';
$rSlide = querryResult($dbconnect, $qSlide);
?>
<script>
  // // var times= <?php echo $rSlide[0]['timeslide']; ?>;
  // setTimeout(function(){
  // }
  // ,2000);
  // setTimeout(function() {
  //   utama();
  //   setTimeout(function() {
  //     scroll(20);
  //   }, 2000);
  // }, 0);
  setTimeout(function() {
    kelas1();
    setTimeout(function() {
      scroll(20);
    }, 2000);
  }, 0);
  setTimeout(function() {
    kelas2();
    setTimeout(function() {
      scroll(20);
    }, 2000);
  }, 10000);
  setTimeout(function() {
    kelas3();
    setTimeout(function() {
      scroll(20);
    }, 2000);
  }, 20000);
  setTimeout(function() {
    vip2();
    setTimeout(function() {
      scroll(20);
    }, 2000);
  }, 30000);
  setTimeout(function() {
    vip1();
    setTimeout(function() {
      scroll(20);
    }, 2000);
  }, 40000);
  // setTimeout(function() {
  //   vipUtama();
  //   setTimeout(function() {
  //     scroll(20);
  //   }, 2000);
  // }, 60000);
  setTimeout(function() {
    location.reload();
  }, 50000);
</script>