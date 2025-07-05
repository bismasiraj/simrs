<?php
  require_once('connection.php');
  require_once('function.php');

  $qPemeriksaanLab = '    execute dbo.web_D04_Pemeriksaan_Lab';

  $rPemeriksaanLab = querryResult($dbconnect,$qPemeriksaanLab);
  $menu=4;
  $header='TOP 10 PEMERIKSAAN LAB';
   ?>
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
              "text": "Top 10 Pemeriksaan Lab"
            }
          ],
          "dataProvider": [
            <?php foreach ($rPemeriksaanLab as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rPemeriksaanLab[$key]['tarif_name']."\"," ?>
                <?php echo "\"column-1\": ".$rPemeriksaanLab[$key]['jml']."," ?>
                "color": "#FB6542"
              },
            <?php endforeach; ?>
          ]
          }
       )
     </script>


         <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
         </div>
         <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="grafikKamar" style="height: 400px; background-color: #FFFFFF;" ></div>
         <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
         </div>

         <?php
         $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=4';
           $rSlide = querryResult($dbconnect,$qSlide);
           ?>
           <script>
           var times= <?php echo $rSlide[0]['timeslide']; ?>;
           setTimeout(function(){
           scroll(times);}
           ,2000);
          </script>
