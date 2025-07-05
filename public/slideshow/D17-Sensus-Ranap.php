<?php
  require_once('connection.php');
  require_once('function.php');
  $qSensusRanap = 'execute dbo.web_D17_Sensus_Ranap';

  $rSensusRanap = querryResult($dbconnect,$qSensusRanap);
  $menu=17;
  $header='SENSUS PASIEN RAWAT INAP';

 ?>

 <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
   <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->


 <div id="bodyscroll" class="container">
    <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
      <thead>
        <tr>
          <th rowspan="2">Bangsal</th>
          <th rowspan="2">Kapasitas SK</th>
          <th rowspan="2">Pasien Awal</th>
          <th rowspan="2">Pasien Masuk</th>
          <th colspan="4">Keluar</th>
          <th rowspan="2">Lama Dirawat</th>
          <th rowspan="2">Pasien Akhir</th>
          <th rowspan="2">Hari Perawatan</th>
        </tr>
        <tr>
          <th>Hidup</th>
          <th>Mati <48</th>
          <th>Mati >48</th>
          <th>Total Keluar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rSensusRanap as $key => $value): ?>
          <tr>
            <td><?php echo $rSensusRanap[$key]['name_of_clinic']; ?></td>
            <td><?php echo $rSensusRanap[$key]['TT']; ?></td>
            <td><?php echo $rSensusRanap[$key]['awal']; ?></td>
            <td><?php echo $rSensusRanap[$key]['masuk']; ?></td>
            <td><?php echo $rSensusRanap[$key]['hidup']; ?></td>
            <td><?php echo $rSensusRanap[$key]['matik48']; ?></td>
            <td><?php echo $rSensusRanap[$key]['matil48']; ?></td>
            <?php $keluarall= $rSensusRanap[$key]['hidup']+$rSensusRanap[$key]['matik48']+$rSensusRanap[$key]['matil48']; ?>
            <td><?php echo $keluarall; ?></td>
            <td><?php echo $rSensusRanap[$key]['lama']; ?></td>
            <td><?php echo $rSensusRanap[$key]['awal']+$rSensusRanap[$key]['masuk']-$keluarall; ?></td>
            <td><?php echo $rSensusRanap[$key]['hari']+$rSensusRanap[$key]['harisama']-$keluarall; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
 </div>
<!-- </div> -->
<!-- </div> -->


         <?php
         $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=17';
           $rSlide = querryResult($dbconnect,$qSlide);
           ?>
          <script>
          var times= <?php echo $rSlide[0]['timeslide']; ?>;
          setTimeout(function(){
          scroll(times);}
          ,2000);
         </script>
