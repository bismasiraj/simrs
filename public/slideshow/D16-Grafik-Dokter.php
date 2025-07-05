<?php
  require_once('connection.php');
  require_once('function.php');

  $qGrafikDokter = 'execute dbo.web_D16_Grafik_Dokter';
  $rGrafikDokter = querryResult($dbconnect,$qGrafikDokter);
  $menu=16;
  $header='JUMLAH PASIEN PER DOKTER';

 ?>

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
              "text": "Jumlah Pasien Per Dokter"
            }
          ],
          "dataProvider": [
            <?php foreach ($rGrafikDokter as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rGrafikDokter[$key]['fullname']."\"," ?>
                <?php echo "\"column-1\": ".$rGrafikDokter[$key]['jml']."," ?>
                "color": "#FFBB00"
              },
            <?php endforeach; ?>
          ]
          }
       )
     </script>

     <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
       <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->
         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
         </div>
         <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="grafikKamar" style="height: 800px; background-color: #FFFFFF;" ></div>
         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
         </div>
       <!-- </div> -->
     <!-- </div> -->

     <?php
     $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=16';
       $rSlide = querryResult($dbconnect,$qSlide);
       ?>
      <script>
      var times= <?php echo $rSlide[0]['timeslide']; ?>;
      setTimeout(function(){
      scroll(times);}
      ,2000);
     </script>
