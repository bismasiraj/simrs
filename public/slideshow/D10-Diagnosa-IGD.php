<?php
  require_once('connection.php');
  require_once('function.php');

  $qDiagnosaIGD = 'execute dbo.web_D10_Diagnosa_IGD';
  $rDiagnosaIGD = querryResult($dbconnect,$qDiagnosaIGD);
  $menu=10;
  $header='TOP 10 DIAGNOSA IGD (PER BULAN BERJALAN)';
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
              "text": "Top 10 Diagnosa IGD (PER BULAN BERJALAN)"
            }
          ],
          "dataProvider": [
            <?php foreach ($rDiagnosaIGD as $key => $value): ?>
              {
                <?php echo "\"category\": \"".$rDiagnosaIGD[$key]['name_of_diagnosa']."\"," ?>
                <?php echo "\"column-1\": ".$rDiagnosaIGD[$key]['jml']."," ?>
                "color": "#375E97"
              },
            <?php endforeach; ?>
          ]
          }
       )
     </script>

     <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
       <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->
         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" id="grafikKamar" style="height: 550px; background-color: #FFFFFF;" ></div>

       <!-- </div> -->
     <!-- </div> -->


     <?php
   $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=10';
     $rSlide = querryResult($dbconnect,$qSlide);
     ?>
    <script>
    var times= <?php echo $rSlide[0]['timeslide']; ?>;
    setTimeout(function(){
    scroll(times);}
    ,2000);
   </script>
