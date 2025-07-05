<?php
  require_once('connection.php');
  require_once('function.php');
  $qTerlayani='execute web_D20_Grafik_Poliklinik';

  $rTerlayani = querryResult($dbconnect,$qTerlayani);
  $menu=20;
  $header='GRAFIK PELAYANAN POLIKLINIK';
 ?>


    <script type="text/javascript">
      AmCharts.makeChart("grafikKamar",
      {
        "type": "serial",
        "categoryField": "category",
        "dataDateFormat": "",
        "maxSelectedSeries": 30,
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
            "balloonText": "[[category]] Pasien Baru:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "title": "Pasien Baru",
            "type": "column",
            "valueField": "column-1"
          },
          {
            "balloonText": "[[category]] Pasien Lama:[[value]]",
            "fillAlphas": 1,
            "id": "AmGraph-2",
            "title": "Pasien Lama",
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
            "text": "Grafik Pelayanan Poliklinik"
          }
        ],
        "dataProvider": [
          <?php foreach ($rTerlayani as $key => $value): ?>
          {
            <?php echo "\"category\": \"".$rTerlayani[$key]['poli']."\"," ?>
            <?php echo "\"column-1\": ".$rTerlayani[$key]['bterlayani']."," ?>
            <?php echo "\"column-2\": ".$rTerlayani[$key]['lterlayani']."," ?>
          },
          <?php endforeach; ?>
        ]
        }

      )
    </script>

    <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
      <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->


       <div style="width:80%;margin-left:auto ;margin-right: auto; text-align: center;"><h2>TABEL PELAYANAN POLIKLINIK</h2></div>
       <div style="width:80%;overflow:scroll;margin-left:auto ;margin-right: auto ;">
         <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
           <thead>
             <tr>
               <th></th>
               <?php foreach ($rTerlayani as $key => $value): ?>
               <th><?php echo $rTerlayani[$key]['poli']; ?></th>
               <?php endforeach; ?>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>Baru</td>
               <?php foreach ($rTerlayani as $key => $value): ?>
                 <td><?php echo $rTerlayani[$key]['bterlayani'] ?></td>
               <?php endforeach; ?>
             </tr>
             <tr>
               <td>Lama</td>
               <?php foreach ($rTerlayani as $key => $value): ?>
                 <td><?php echo $rTerlayani[$key]['lterlayani'] ?></td>
               <?php endforeach; ?>
             </tr>
           </tbody>
         </table>
       </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" id="grafikKamar" style="height: 650px; background-color: #FFFFFF;margin-bottom:100px;" ></div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="height: 650px;"></div>
      <!-- </div> -->
    <!-- </div> -->

    <?php
    $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=20';
      $rSlide = querryResult($dbconnect,$qSlide);
      ?>
     <script>
     var times= <?php echo $rSlide[0]['timeslide']; ?>;
     setTimeout(function(){
     scroll(times);}
     ,2000);
    </script>
