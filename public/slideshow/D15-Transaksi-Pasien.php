<?php
  require_once('connection.php');
  require_once('function.php');
  $qTransPasien = 'execute dbo.web_D15_Transaksi_Pasien';

  $rTransPasien = querryResult($dbconnect,$qTransPasien);
  $menu=15;
  $header='TRANSAKSI PASIEN PER POLI';
 ?>
 <!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
   <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->

         <div class="container">
           <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
           </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="overflow: scroll;height:500px;">
            <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
              <thead>
                <tr>
                  <th>Unit Pelayanan</th>
                  <th>Total Tagihan</th>
                  <th>Titak Bayar</th>
                  <th>Total Retur Pembayaran</th>
                  <th>Sisa Tagihan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rTransPasien as $key => $value): ?>
                  <tr>
                    <td><?php echo $rTransPasien[$key]['NAME_OF_CLINIC']; ?></td>
                    <td><?php echo "Rp.".number_format($rTransPasien[$key]['tagihan'],2,',','.'); ?></td>
                    <td><?php echo "Rp.".number_format($rTransPasien[$key]['BAYAR'],2,',','.'); ?></td>
                    <td><?php echo "Rp.".number_format(0,2,',','.'); ?></td>
                    <td><?php echo "Rp.".number_format($rTransPasien[$key]['tagihan']-$rTransPasien[$key]['BAYAR'],2,',','.'); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          </div>
         </div>
   <!-- </div> -->
 <!-- </div> -->


         <?php
         $qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=15';
           $rSlide = querryResult($dbconnect,$qSlide);
           ?>
          <script>
          var times= <?php echo $rSlide[0]['timeslide']; ?>;
          setTimeout(function(){
          scroll(times);}
          ,2000);
         </script>
