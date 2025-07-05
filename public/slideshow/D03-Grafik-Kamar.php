<?php
  require_once('connection.php');
  require_once('function.php');
  $qGKapasitas='execute dbo.web_D03_Grafik_Kamar_GKapasitas';
  $qGTerpakai = 'execute dbo.web_D03_Grafik_Kamar_GTerpakai';

  $rGKapasitas = querryResult($dbconnect,$qGKapasitas);
  $rGTerpakai = querryResult($dbconnect,$qGTerpakai);
  $menu=3;
  $header='KETERSEDIAAN KAMAR RAWAT INAP';
 ?>

    <script type="text/javascript">
    $('#header').load("Grafik Kamar");
      AmCharts.makeChart("grafikKamar",
      {
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
        "graphs": [
          {
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
        "valueAxes": [
          {
            "id": "ValueAxis-1",
            "stackType": "regular",
            "title": "Jumlah"
          }
        ],
        "allLabels": [],
        "balloon": {},
        "legend": {
          "enabled": true,
          "useGraphSettings": true
        },
        "titles": [
          {
            "id": "Title-1",
            "size": 15,
            "text": "Ketersediaan Kamar Rawat Inap"
          }
        ],
        "dataProvider": [
          <?php foreach ($rGKapasitas as $key => $value): ?>
          {
            <?php echo "\"category\": \"".$rGKapasitas[$key]['NAME_OF_CLINIC']."\"," ?>
            <?php echo "\"column-1\": ".$rGTerpakai[$key]['TERISI']."," ?>
            <?php $sisa=$rGKapasitas[$key]['kapasitas']-$rGTerpakai[$key]['TERISI']; ?>
            <?php echo "\"column-2\": ".$sisa."," ?>
          },
          <?php endforeach; ?>
        ]
        }

      )
    </script>
    <!--SIDEBAR NAVIGATION-->
    <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
      <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" id="grafikKamar" style="height: 600px; background-color: #FFFFFF;" ></div>
      <!-- </div> -->
    <!-- </div> -->
        <?php
        $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=3';
          $rSlide = querryResult($dbconnect,$qSlide);
          ?>
          <script>
          var times= <?php echo $rSlide[0]['timeslide']; ?>;
          setTimeout(function(){
          scroll(times);}
          ,2000);
         </script>
