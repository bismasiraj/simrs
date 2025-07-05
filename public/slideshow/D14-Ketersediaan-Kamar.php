<?php
    require_once('connection.php');
    require_once('function.php');

    $qKamar = 'execute dbo.web_D14_Ketersediaan_Kamar';
    $rKamar = querryResult($dbconnect,$qKamar);
 ?>
 <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
   <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->

         <!-- close div level 1 -->
         <!-- close header jumbotron -->

         <!-- bagian isi ketersediaan kamar -->
         <!-- div level 1 -->
         <div class="container-fluid">
           <!-- div level 2 -->
            <div class="row">
              <br>
                  <!-- div level 3 -->
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center" style="height:300px;">
                    <?php $caption=$rKamar['0']['name_of_clinic'];
                      // variable x digunakan untuk penggunaan suatu syntax yang hanya ingin digunakan di setiap kelipatan tertentu.
                      // dalam hal ini variable x nilainya akan bertambah apabila terdapat tabel baru
                      $x=0;
                    ?>
                    <!-- div level 4 -->
                    <!-- div pembukaan ini dibuat diluar foreach statement sebagai div inisiasi awal dari foreach. kenapa tidak didalam
                    foreach saja?karena algoritma looping yang digunakan, pada awal looping akan dilakukan pengecekan apakah caption
                    sudah bernilai berbeda atau belum. apabila ternyata berbeda, maka akan dibuat tabel baru.
                    apabila tidak. akan terus mengisi konten dari tabel ketersediaan kamar per jenis kamarnya -->
                    <div class="thumbnail" style="background-color:#FB6542;color:white;">
                      <caption style="background-color:#07575B"><h4><?php echo "$caption"; ?></h4></caption>
                      <hr>
                    </div>
                    <!-- close div level 4 -->
                    <!-- div level 4 -->
                    <div style="max-height:380px;overflow-y:scroll;">
                    <!-- create table ketersediaan kamar -->
                    <table class="table-striped table-hover table-condensed table-bordered dt-responsive" cellspacing="0" width="100%">
                      <thead>
                        <th> </th>
                        <th>Kapasitas</th>
                        <th>Isi</th>
                        <th>Sisa</th>
                        <th>Tarif</th>
                      </thead>
                    <!-- tidak ada penutup untuk div-div diatas (</div>), karena penutupnya akan dibuat didalam foreach statement -->

              <!-- membuka looping tabel ketersediaan kamar. program akan otomatis membuat tabel baru apabila caption dari setiap loop sebelum dan sesudahnya tidaklah sama -->
              <?php foreach ($rKamar as $key => $value): ?>

                <!-- if statement level 1 -->
                <!-- apabila caption pada loop sekarang tidak sama dengan loop sebelumnya, maka akan dibuat tabel baru -->
                <?php if ($caption!=$rKamar[$key]['name_of_clinic']): ?>
                  <!-- penambahan variabel $x apabila dibuat tabel baru -->
                  <?php $x = $x+1; ?>
                    </table>
                    </div>
                    <!-- close div level 4 -->
                  </div>
                  <!-- close div level 3 -->

                  <!-- if statement level 2 -->
                  <?php if ($x%3==0): ?>
                    <br><br><br>
                  <?php endif; ?>
                  <!-- close if statement level 2 -->

                  <!-- membuat tabel baru -->
                  <!-- div level 3 -->
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center" style="height:300px;">
                      <?php $caption=$rKamar[$key]['name_of_clinic']; ?>

                      <!-- if statement level 2 -->
                      <!-- sebagai variasi dari warna background caption. variasi warna ada 4, sehingga kelipatan yang digunakan adalah 4,
                      dengan setiap warnanya akan digunakan untuk kondisi sisa pembagian tertentu sesuai statment if dibawah -->
                      <?php if ($x%4==1): ?>
                        <div class="thumbnail" style="background-color:#66A5AD;color:white;">
                      <?php elseif ($x%4==2): ?>
                        <div class="thumbnail" style="background-color:#FFBB00;color:white;">
                      <?php elseif ($x%4==3):?>
                        <div class="thumbnail" style="background-color:#3F681C;color:white;">
                      <?php elseif($x%4==0) :?>
                        <div class="thumbnail" style="background-color:#FB6542;color:white;">
                      <?php endif; ?>
                      <!-- close if level 2 -->

                        <caption><h4><?php echo "$caption"; ?></h4></caption><hr>
                    </div>
                    <!-- close div level 3 -->
                    <!-- div level 3 -->
                    <div style="max-height:180px;overflow-y:scroll;">
                    <table class="table-striped table-hover table-condensed table-bordered dt-responsive" cellspacing="0" width="100%">
                      <thead>
                        <th> </th>
                        <th>Kapasitas</th>
                        <th>Isi</th>
                        <th>Sisa</th>
                        <th>Tarif</th>
                      </thead>
                <?php endif; ?>
                <!-- close if level 1 -->
                <!-- yaitu close if untuk kondisi jika caption looping sekarang tidak sama dengan looping sebelumnya. apabila sama,
                maka tabel baru tidak akan dibuat (isi dari if statement diatas akan diabaikan), dan langsung dilanjutkan syntax
                dibawah -->

                      <tr>

                        <td style="color:"><h6><?php echo $rKamar[$key]['NAME_OF_CLASS']; ?></h6></td>
                        <td><h6><?php echo $rKamar[$key]['cap']; ?></h6></td>
                        <td><h6><?php echo $rKamar[$key]['ISI']; ?></h6></td>
                        <td><h6><?php $sisaKamar =$rKamar[$key]['cap']-$rKamar[$key]['ISI'];
                              echo $sisaKamar;
                          ?></h6></td>
                        <td><h6><?php echo "Rp.".number_format($rKamar[$key]['TARIF'],2,',','.'); ?></h6></td>

                      </tr>


              <?php endforeach; ?>
                    </table>
                  </div>
                  <!-- close div level 3 -->
                  <!-- dibuat diluar statement if karena pada saat terakhir looping, sudah tidak akan masuk ke if statement (caption berbeda),
                  dan langsung keluar dari foreach statement, padahal tabel dan div nya belum ditutup -->
            </div>
            <!-- close div level 2 -->
         </div>
         <!-- close div level 1 -->

  <!-- </div> -->
<!-- </div> -->


<?php
$qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=14';
  $rSlide = querryResult($dbconnect,$qSlide);
  ?>
 <script>
 var times= <?php echo $rSlide[0]['timeslide']; ?>;
 setTimeout(function(){
 scroll(times);}
 ,2000);
</script>
