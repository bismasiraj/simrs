<?php
  require_once('connection.php');
  require_once('function.php');

  $qPemeriksaanRO = 'execute dbo.web_D05_Pemeriksaan_Radiologi';
  $rPemeriksaanRO = querryResult($dbconnect,$qPemeriksaanRO);
  $menu=5;
  $header='TOP 10 PEMERIKSAAN RADIOLOGI';
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
              "text": "Top 10 Pemeriksaan Radiologi"
            }
          ],
          "dataProvider": [
            <?php foreach ($rPemeriksaanRO as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rPemeriksaanRO[$key]['tarif_name']."\"," ?>
                <?php echo "\"column-1\": ".$rPemeriksaanRO[$key]['jml']."," ?>
                "color": "#FB6542"
              },
            <?php endforeach; ?>
          ]
          }
       )
     </script>

         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
         </div>
         <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="grafikKamar" style="height: 400px; background-color: #FFFFFF;" ></div>
         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
         </div>

         <?php
         $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=5';
           $rSlide = querryResult($dbconnect,$qSlide);
           ?>
           <script>
           var times= <?php echo $rSlide[0]['timeslide']; ?>;
           setTimeout(function(){
           scroll(times);}
           ,2000);
          </script>
