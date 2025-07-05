<?php
  require_once("connection.php");
  require_once("function.php");
  $qKHarian = 'execute dbo.web_D01_1_PoliHarian';
  $rKHarian = querryResult($dbconnect,$qKHarian);
  $qKBulanan='execute dbo.web_D01_2_PoliBulanan';
  $rKBulanan = querryResult($dbconnect,$qKBulanan);
  $menu=1;
  $header='KUNJUNGAN PASIEN';

 ?>
<script type="text/javascript">
      // script Kunjungan Harian
      $('#header').load("Kunjungan Pasien");
      AmCharts.makeChart("harianBL",
        {
          "type": "serial",
          "categoryField": "category",
          "angle": 30,
          "depth3D": 30,
          "colors": [
            "#FB6542",
            "#375E97",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#CD0D74",
            "#CC0000",
            "#00CC00",
            "#0000CC",
            "#DDDDDD",
            "#999999",
            "#333333",
            "#990000"
          ],
          "startDuration": 1,
          "fontSize": 8,
          "theme": "light",
          "categoryAxis": {
            "gridPosition": "start"
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "LAMA",
              "type": "column",
              "valueField": "column-1"
            },
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-2",
              "title": "BARU",
              "type": "column",
              "valueField": "column-2"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "stackType": "regular",
              "title": "Jumlah Pasien"
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
              "size": 8,
              "text": "Kunjungan Pasien Baru/Lama Harian"
            }
          ],
          "dataProvider": [
            <?php foreach ($rKHarian as $key => $value): ?>
            {
              <?php echo "\"category\": \"".$rKHarian[$key]['tanggal']."\"," ?>
              <?php echo "\"column-1\": ".$rKHarian[$key]['pasien_lama']."," ?>
              <?php echo "\"column-2\": ".$rKHarian[$key]['pasien_baru']."," ?>
            },
            <?php endforeach; ?>
          ]
        }
      );
      // script kunjungan bulanan
      AmCharts.makeChart("bulananBL",
        {
          "type": "serial",
          "categoryField": "category",
          "angle": 30,
          "depth3D": 30,
          "colors": [
            "#FB6542",
            "#375E97",
            "#B0DE09",
            "#0D8ECF",
            "#2A0CD0",
            "#CD0D74",
            "#CC0000",
            "#00CC00",
            "#0000CC",
            "#DDDDDD",
            "#999999",
            "#333333",
            "#990000"
          ],
          "startDuration": 1,
          "fontSize": 8,
          "theme": "light",
          "categoryAxis": {
            "gridPosition": "start"
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "LAMA",
              "type": "column",
              "valueField": "column-1"
            },
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-2",
              "title": "BARU",
              "type": "column",
              "valueField": "column-2"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "stackType": "regular",
              "title": "Jumlah Pasien"
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
              "size": 8,
              "text": "Kunjungan Pasien Baru/Lama Bulanan"
            }
          ],
          "dataProvider": [
            <?php foreach ($rKBulanan as $key => $value): ?>
            {
              <?php echo "\"category\": \"".$rKBulanan[$key]['bulan']."/".$rKBulanan[$key]['tahun']."\"," ?>
              <?php echo "\"column-1\": ".$rKBulanan[$key]['pasien_lama']."," ?>
              <?php echo "\"column-2\": ".$rKBulanan[$key]['pasien_baru']."," ?>
            },
            <?php endforeach; ?>
          ]
        }
      );
		</script>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="harianBL" style="height: 400px; background-color: #FFFFFF;" ></div>
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="bulananBL" style="height: 400px; background-color: #FFFFFF;" ></div>

    <?php
      $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=1';
      $rSlide = querryResult($dbconnect,$qSlide);
    ?>
    <script>
    var times= <?php echo $rSlide[0]['timeslide']; ?>;
    setTimeout(function(){
    scroll(times);}
    ,2000);
   </script>
