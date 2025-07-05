<?php
  require_once('connection.php');
  require_once('function.php');

  $qDiagnosaKal = 'execute dbo.web_D22_Top_Diagnosa_Kelurahan';
  $rDiagnosaKal = querryResult($dbconnect,$qDiagnosaPoli);
  $header='TOP 10 DIAGNOSA RAWAT JALAN KELURAHAN';
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>TOP 10 Diagnosa Rawat Jalan</title>
     <?php include('library.php') ?>

     <!-- script untuk grafik batang -->
     <?php $x = 0;$kalurahan; ?>
     <?php foreach ($rDiagnosaKal as $key => $value): ?>
    <?php if ($x == 0): ?>


     <script type="text/javascript">
       AmCharts.makeChart(<?php echo $rDiagnosaKal[$key]['KALURAHAN'] ?>,
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
              "text": <?php echo "Top 10 Diagnosa Rawat Jalan".$rDiagnosaKal[$key]['KALURAHAN']; ?>
            }
          ],
          "dataProvider": [
          <?php endif; ?>

              {
                <?php echo "\"category\": \"".$rDiagnosaKal[$key]['NAME_OF_DIAGNOSA']."\"," ?>
                <?php echo "\"column-1\": ".$rDiagnosaKal[$key]['jml']."," ?>
                "color": "#375E97"
              },

      <?php $keynew = $key+1;if ($x == 10 || $rDiagnosaKal[$key]['KALURAHAN'] == $rDiagnosaKal[$keynew]['KALURAHAN']): ?>
          ]
          }
       )
       <?php  ?>
     </script>
     <?php endif; ?>
   <?php endforeach; ?>
   </head>
   <body oncontextmenu="return false;">
     <!--SIDEBAR NAVIGATION-->
     <?php include('header.php') ?>

          <div style="overflow:hidden;width:99%;height:450px;">
            <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;">
              <?php $x = 0 ?>
              <?php foreach ($rDiagnosaKal as $key => $value): ?>
                <?php if ($x==0): ?>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" <?php echo "id=\"".$rDiagnosaKal[$key]['KALURAHAN']."\""; ?>id="grafikKamar" style="height: 550px; background-color: #FFFFFF;" ></div>
                <?php endif; ?>
                <?php $keynew = $key+1; ?>
                <?php if ($rDiagnosaKal[$key]['KALURAHAN'] == $rDiagnosaKal[$keynew]['KALURAHAN']): ?>
                <?php $x = $x+1;?>
                <?php endif; ?>
                <?php if ($rDiagnosaKal[$key]['KALURAHAN'] != $rDiagnosaKal[$keynew]['KALURAHAN']): ?>
                  <?php $x = 0; ?>
                <?php endif; ?>
              <?php endforeach; ?>


            </div>
          </div>
  </body>
 </html>
