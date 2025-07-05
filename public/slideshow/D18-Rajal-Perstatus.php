<?php
  require_once('connection.php');
  require_once('function.php');

  $qRajalBayar = 'execute dbo.web_D18_Rajal_Perstatus';
  $rRajalBayar = querryResult($dbconnect,$qRajalBayar);
 ?>

     <script type="text/javascript">
       AmCharts.makeChart("grafikKamar",
         {
          "type": "serial",
          "categoryField": "category",
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
              "text": "Grafik Pasien Rawat Jalan Per Status Bayar"
            }
          ],
          "dataProvider": [
            <?php foreach ($rRajalBayar as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rRajalBayar[$key]['NAME_OF_STATUS_PASIEN']."\"," ?>
                <?php echo "\"column-1\": ".$rRajalBayar[$key]['jml']."," ?>
                "color": "#375E97"
              },
            <?php endforeach; ?>
          ]
          }
       )
     </script>

     <!-- script untuk grafik pie -->
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
            <?php foreach ($rRajalBayar as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rRajalBayar[$key]['NAME_OF_STATUS_PASIEN']."\"," ?>
                <?php echo "\"column-1\": ".$rRajalBayar[$key]['jml']."," ?>
              },
            <?php endforeach; ?>
          ]
          }

        )
     </script>
     <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
       <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->
         <div class="col-sm-6" id="grafikKamar" style="height: 400px; background-color: #FFFFFF;" ></div>
         <div class="col-sm-6" id="pieKamar" style="height: 400px; background-color: #FFFFFF;" ></div>
       <!-- </div> -->
     <!-- </div> -->
     <?php
$qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=18';
  $rSlide = querryResult($dbconnect,$qSlide);
  ?>
 <script>
 var times= <?php echo $rSlide[0]['timeslide']; ?>;
 setTimeout(function(){
 scroll(times);}
 ,2000);
</script>
