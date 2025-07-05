<?php
  require_once('connection.php');
  require_once('function.php');

  $qObatRajal = 'execute dbo.web_D06_Top_Obat_Rajal';
$qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=3';
  $rSlide = querryResult($dbconnect,$qSlide);

  $menu=6;
  $header='TOP 10 OBAT RAWAT JALAN';
  $rObatRajal = querryResult($dbconnect,$qObatRajal);
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
              "text": "Top 10 Obat Rawat Jalan"
            }
          ],
          "dataProvider": [
            <?php foreach ($rObatRajal as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rObatRajal[$key]['description']."\"," ?>
                <?php echo "\"column-1\": ".$rObatRajal[$key]['jml']."," ?>
                "color": "#FB6542"
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
         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" id="grafikKamar" style="height: 550px; background-color: #FFFFFF;" ></div>
         </div>
       <!-- </div> -->
     <!-- </div> -->

         <?php
         $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=6';
           $rSlide = querryResult($dbconnect,$qSlide);
           ?>
          <script>
          var times= <?php echo $rSlide[0]['timeslide']; ?>;
          setTimeout(function(){
          scroll(times);}
          ,2000);
         </script>
