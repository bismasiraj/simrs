<?php
  require_once('connection.php');
  require_once('function.php');
  $qTerlayani = 'execute dbo.web_D02_PelayananPoli';
  $rTerlayani = querryResult($dbconnect,$qTerlayani);

  $menu=2;
  $header='PELAYANAN POLIKLINIK';
 ?>
 <!-- variable x digunakan untuk randomisasi warna -->
 <?php $x = 0; ?>

 <!-- memulau foreach tabel pelayanan poliklinik -->
 <?php foreach ($rTerlayani as $key => $value): ?>
   <!-- div level 1 -->
   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">

     <!-- if conditional untuk membedakan warna tiap tabel -->
     <?php if ($x%5==0): ?>
       <!-- div level 2 -->
       <div class="thumbnail" style="border-color: #FB6542">
         <!-- div level 3 -->
         <div class="thumbnail caption" style="background-color: #FB6542; color: white;">
      <?php elseif($x%5==1): ?>
        <div class="thumbnail" style="border-color: #375E97">
          <div class="thumbnail caption" style="background-color: #375E97; color: white;">
      <?php elseif($x%5==2): ?>
        <div class="thumbnail" style="border-color: #FFBB00">
          <div class="thumbnail caption" style="background-color: #FFBB00; color: white;">
      <?php elseif($x%5==3): ?>
        <div class="thumbnail" style="border-color: #FB6542">
          <div class="thumbnail caption" style="background-color: #FB6542; color: white;">
      <?php elseif($x%5==4): ?>
        <div class="thumbnail" style="border-color: #3F681C">
          <div class="thumbnail caption" style="background-color: #3F681C; color: white;">
     <?php endif; ?>
         <caption><?php echo $rTerlayani[$key]['poli']; ?></caption><hr>
       </div>
       <!-- close div level 3-->
        <table style="width: 100%;">
          <thead>
            <th style="text-align: center;"><span class="glyphicon glyphicon-unchecked"></span>Pengunjung</th>
            <th style="text-align: center;"><span class="glyphicon glyphicon-check"></span>Terlayani</th>
          </thead>
          <tr>
            <td style="color: #FB6542;text-align: center;"><h1><?php echo $rTerlayani[$key]['pengunjung'] ?></h1></td>
            <td style="color: #375E97;text-align: center;"><h1><?php echo $rTerlayani[$key]['terlayani'] ?></h1></td>
          </tr>
        </table>
     </div>
     <!-- close div level 2 -->
   </div>
   <!-- close div level 1 -->

   <!-- incremental variabel x -->
   <?php $x=$x+1; ?>
 <?php endforeach; ?>


<?php
$qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=2';
  $rSlide = querryResult($dbconnect,$qSlide);
  ?>
 <script>
 var times= <?php echo $rSlide[0]['timeslide']; ?>;
 setTimeout(function(){
 scroll(times);}
 ,2000);
</script>
