<?php
  require_once('connection.php');
  require_once('function.php');

  $qPasienRujukan = 'execute dbo.web_D21_Grafik_Rujukan';
  $rPasienRujukan = querryResult($dbconnect,$qPasienRujukan);
  $menu=12;
  $header='GRAFIK ASAL PASIEN RUJUKAN';
 ?>

     <meta charset="utf-8">
     <title>GRAFIK ASAL PASIEN RUJUKAN</title>
     <?php include('library.php') ?>

     <!-- script untuk grafik batang -->
     <script type="text/javascript">
       AmCharts.makeChart("grafikKamar",
         {
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
          "graphs": [
            {
              "colorField": "color",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "lineColorField": "color",
              "title": "graph 1",
              "type": "column",
              "valueField": "column-1"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": "Jumlah"
            }
          ],
          "allLabels": [],
          "balloon": {},
          "titles": [
            {
              "id": "Title-1",
              "size": 15,
              "text": "GRAFIK BATANG ASAL PASIEN RUJUKAN"
            }
          ],
          "dataProvider": [
            <?php foreach ($rPasienRujukan as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rPasienRujukan[$key]['NAME_OF_RUJUKAN']."\"," ?>
                <?php echo "\"column-1\": ".$rPasienRujukan[$key]['jml']."," ?>
                "color": "#FFBB00"
              },
            <?php endforeach; ?>
          ]
          }
       )
     </script>
     <script type="text/javascript">
       AmCharts.makeChart("pieKamar",
       {
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
            <?php foreach ($rPasienRujukan as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rPasienRujukan[$key]['NAME_OF_RUJUKAN']."\"," ?>
                <?php echo "\"column-1\": ".$rPasienRujukan[$key]['jml']."," ?>
              },
            <?php endforeach; ?>
          ]
          }

        )
     </script>

        <?php include('header.php') ?>
        <div style="overflow:hidden;width:99%;height:450px;">
          <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="grafikKamar" style="height: 2000px; background-color: #FFFFFF;" ></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="pieKamar" style="height: 2000px; background-color: #FFFFFF;" ></div>

          </div>
        </div>
        $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=21';
          $rSlide = querryResult($dbconnect,$qSlide);
          ?>
         <script>
         var times= <?php echo $rSlide[0]['timeslide']; ?>;
         setTimeout(function(){
         scroll(times);}
         ,2000);
        </script>
