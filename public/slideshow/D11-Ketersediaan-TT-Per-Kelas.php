<?php
require_once('connection.php');
require_once('function.php');

$qKamarKelas = 'execute dbo.web_D11_Ketersediaan_TT_Perkelas';
$rKamarKelas = querryResult($dbconnect,$qKamarKelas);
$k1Utama = $k2Kelas1 = $k3Kelas2 = $k4Kelas3 = $k6VIP2 = $k7VIP1 = $k8VIPUtama = $kapasitas = $terisi = 0;
$c1Utama = $c2Kelas1 = $c3Kelas2 = $c4Kelas3 = $c6VIP2 = $c7VIP1 = $c8VIPUtama = 0;
foreach ($rKamarKelas as $key => $value) {
  if ($rKamarKelas[$key]['CLASS_ID']==1) {
    $k1Utama = $k1Utama+$rKamarKelas[$key]['ISI'];
    $c1Utama = $k1Utama+$rKamarKelas[$key]['cap'];
  }elseif ($rKamarKelas[$key]['CLASS_ID']==2) {
    $k2Kelas1 = $k2Kelas1+$rKamarKelas[$key]['ISI'];
    $c2Kelas1 = $c2Kelas1+$rKamarKelas[$key]['cap'];
  }elseif ($rKamarKelas[$key]['CLASS_ID']==3) {
    $k3Kelas2 = $k3Kelas2+$rKamarKelas[$key]['ISI'];
    $c3Kelas2 = $c3Kelas2+$rKamarKelas[$key]['cap'];
  }elseif ($rKamarKelas[$key]['CLASS_ID']==4) {
    $k4Kelas3 = $k4Kelas3+$rKamarKelas[$key]['ISI'];
    $c4Kelas3 = $c4Kelas3+$rKamarKelas[$key]['cap'];
  }elseif ($rKamarKelas[$key]['CLASS_ID']==6) {
    $k6VIP2 = $k6VIP2+$rKamarKelas[$key]['ISI'];
    $c6VIP2 = $c6VIP2+$rKamarKelas[$key]['cap'];
  }elseif ($rKamarKelas[$key]['CLASS_ID']==7) {
    $k7VIP1 = $k7VIP1+$rKamarKelas[$key]['ISI'];
    $c7VIP1 = $c7VIP1+$rKamarKelas[$key]['cap'];
  }elseif ($rKamarKelas[$key]['CLASS_ID']==8) {
    $k8VIPUtama = $k8VIPUtama+$rKamarKelas[$key]['ISI'];
    $c8VIPUtama = $c8VIPUtama+$rKamarKelas[$key]['cap'];
  }
  $terisi = $terisi + $rKamarKelas[$key]['ISI'];
  $kapasitas = $kapasitas + $rKamarKelas[$key]['cap'];
}
$sisa=$kapasitas-$terisi;
 ?>

     <script type="text/javascript">
       AmCharts.makeChart("pieKamar",
       {
          "type": "pie",
          "angle": 12,
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "depth3D": 15,
          "colors": [
           "#375E97",
           "#FB6542",
           "#FFBB00",
           "#FCD202",
           "#F8FF01",
           "#B0DE09",
           "#04D215",
           "#0D8ECF",
           "#0D52D1",
           "#2A0CD0",
           "#8A0CCF",
           "#CD0D74",
           "#754DEB",
           "#DDDDDD",
           "#999999",
           "#333333",
           "#000000",
           "#57032A",
           "#CA9726",
           "#990000",
           "#4B0C25"
          ],
          "titleField": "category",
          "valueField": "column-1",
          "allLabels": [],
          "balloon": {},
          "legend": {
           "enabled": true,
           "align": "center",
           "markerType": "circle"
          },
          "titles": [],
          "dataProvider": [
            {
              <?php echo "\"category\": \"UTAMA\"," ?>
              <?php echo "\"column-1\": ".$k1Utama."," ?>
            },
            {
              <?php echo "\"category\": \"KELAS 1\"," ?>
              <?php echo "\"column-1\": ".$k2Kelas1."," ?>
            },
            {
              <?php echo "\"category\": \"KELAS 2\"," ?>
              <?php echo "\"column-1\": ".$k3Kelas2."," ?>
            },
            {
              <?php echo "\"category\": \"KELAS 3\"," ?>
              <?php echo "\"column-1\": ".$k4Kelas3."," ?>
            },
            {
              <?php echo "\"category\": \"VIP 2\"," ?>
              <?php echo "\"column-1\": ".$k6VIP2."," ?>
            },
            {
              <?php echo "\"category\": \"VIP 1\"," ?>
              <?php echo "\"column-1\": ".$k7VIP1."," ?>
            },
            {
              <?php echo "\"category\": \"VIP UTAMA\"," ?>
              <?php echo "\"column-1\": ".$k8VIPUtama."," ?>
            },
            {
              <?php echo "\"category\": \"KAMAR KOSONG\"," ?>
              <?php echo "\"column-1\": ".$sisa."," ?>
            },
          ]
          }

        )
     </script>

<!-- <div style="overflow:hidden;width:99%;height:450px;"> -->
  <!-- <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:450px;"> -->


     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="pieKamar" style="height: 400px; background-color: #FFFFFF;" ></div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height:450px;">
       <form method="post">
         <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
           <thead>
             <tr>
               <th>KELAS</th>
               <th>TERISI</th>
               <th>KAPASITAS</th>
               <th>SISA</th>
             </tr>
           </thead>
           <tbody>

            <tr>
              <td>UTAMA</td>
              <td><?php echo "$k1Utama"; ?></td>
              <td><?php echo "$c1Utama"; ?></td>
              <td><?php $sisa = $c1Utama-$k1Utama;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#utamaModal" name="">Detil</button></td> -->
            </tr>

            <tr>
              <td>KELAS 1</td>
              <td><?php echo "$k2Kelas1"; ?></td>
              <td><?php echo "$c2Kelas1"; ?></td>
              <td><?php $sisa = $c2Kelas1-$k2Kelas1;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#kelas1Modal">Detil</button></td> -->
            </tr>

            <tr>
              <td>KELAS 2</td>
              <td><?php echo "$k3Kelas2"; ?></td>
              <td><?php echo "$c3Kelas2"; ?></td>
              <td><?php $sisa = $c3Kelas2-$k3Kelas2;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#kelas2Modal">Detil</button></td> -->
            </tr>


            <tr>
              <td>KELAS 3</td>
              <td><?php echo "$k4Kelas3"; ?></td>
              <td><?php echo "$c4Kelas3"; ?></td>
              <td><?php $sisa = $c4Kelas3-$k4Kelas3;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#kelas3Modal">Detil</button></td> -->
            </tr>

            <tr>
              <td>VIP 2</td>
              <td><?php echo "$k6VIP2"; ?></td>
              <td><?php echo "$c6VIP2"; ?></td>
              <td><?php $sisa = $c6VIP2-$k6VIP2;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#vip2Modal">Detil</button></td> -->
            </tr>

            <tr>
              <td>VIP 1</td>
              <td><?php echo "$k7VIP1"; ?></td>
              <td><?php echo "$c7VIP1"; ?></td>
              <td><?php $sisa = $c7VIP1-$k7VIP1;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#vip1Modal">Detil</button></td> -->
            </tr>
            <tr>
              <td>VIP Utama</td>
              <td><?php echo "$k8VIPUtama"; ?></td>
              <td><?php echo "$c8VIPUtama"; ?></td>
              <td><?php $sisa = $c8VIPUtama-$k8VIPUtama;echo "$sisa";?></td>
              <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#vipUtamaModal">Detil</button></td> -->
            </tr>
           </tbody>
         </table>
     </div>
     <div class="container">

			 <!-- Modal UTAMA-->
			 <div class="modal fade" id="utamaModal" role="dialog">
		     <div class="modal-dialog">
		       <!-- Modal content-->
		       <div class="modal-content">
		         <div class="modal-header">
		           <button type="button" class="close" data-dismiss="modal">&times;</button>
		           <h4 class="modal-title">UTAMA</h4>
		         </div>
		         <div class="modal-body">
		           <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
		             <thead>
		               <tr>
		                 <th>Nama Klinik</th>
		                 <th>Nama Kelas</th>
		                 <th>Kapasitas</th>
		                 <th>Terisi</th>
		                 <th>Sisa</th>
		                 <th>Tarif</th>
		               </tr>
		             </thead>
		             <tbody>
		               <?php foreach ($rKamarKelas as $key => $value): ?>
		                 <?php if ($rKamarKelas[$key]['CLASS_ID']==1): ?>
		                   <tr>
		                     <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
		                     <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
		                     <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
		                     <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
		                     <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
		                     <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
		                   </tr>
		                 <?php endif; ?>
		               <?php endforeach; ?>
		             </tbody>
		           </table>
		         </div>
		         <div class="modal-footer">
		           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		         </div>
		       </div>

		     </div>
		   </div>
			 <!-- close modal  UTAMA-->

  <!-- Modal KELAS 1-->
  <div class="modal fade" id="kelas1Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">KELAS 1</h4>
        </div>
        <div class="modal-body">
          <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Tarif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rKamarKelas as $key => $value): ?>
                <?php if ($rKamarKelas[$key]['CLASS_ID']==2): ?>
                  <tr>
                    <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- close modal kelas 1 -->

  <!-- Modal KELAS 2-->
  <div class="modal fade" id="kelas2Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">KELAS 2</h4>
        </div>
        <div class="modal-body">
          <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Tarif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rKamarKelas as $key => $value): ?>
                <?php if ($rKamarKelas[$key]['CLASS_ID']==3): ?>
                  <tr>
                    <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- close modal kelas 2 -->

  <!-- Modal KELAS 3-->
  <div class="modal fade" id="kelas3Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">KELAS 3</h4>
        </div>
        <div class="modal-body">
          <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Tarif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rKamarKelas as $key => $value): ?>
                <?php if ($rKamarKelas[$key]['CLASS_ID']==4): ?>
                  <tr>
                    <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- close modal kelas 3 -->

  <!-- Modal VIP 2-->
  <div class="modal fade" id="vip2Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">VIP 2</h4>
        </div>
        <div class="modal-body">
          <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Tarif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rKamarKelas as $key => $value): ?>
                <?php if ($rKamarKelas[$key]['CLASS_ID']==6): ?>
                  <tr>
                    <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- close modal VIP 2 -->

  <!-- Modal VIP 1-->
  <div class="modal fade" id="vip1Modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">KELAS 2</h4>
        </div>
        <div class="modal-body">
          <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Tarif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rKamarKelas as $key => $value): ?>
                <?php if ($rKamarKelas[$key]['CLASS_ID']==7): ?>
                  <tr>
                    <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- close modal VIP 1 -->

  <!-- Modal KELAS 2-->
  <div class="modal fade" id="vipUtamaModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">VIP UTAMA</h4>
        </div>
        <div class="modal-body">
          <table id="onetable" class="table table-striped table-responsive table-hover table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Nama Kelas</th>
                <th>Kapasitas</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Tarif</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rKamarKelas as $key => $value): ?>
                <?php if ($rKamarKelas[$key]['CLASS_ID']==8): ?>
                  <tr>
                    <td><?php echo $rKamarKelas[$key]['name_of_clinic']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['NAME_OF_CLASS']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo $rKamarKelas[$key]['cap']-$rKamarKelas[$key]['ISI']; ?></td>
                    <td><?php echo "Rp.".number_format($rKamarKelas[$key]['TARIF'],2,',','.'); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- close modal VIP Utama -->
</div>


 <!-- </div> -->
<!-- </div> -->

<?php
$qSlide = 'select timeslide from WEBSITE_MENU where MENU_ID=11';
	$rSlide = querryResult($dbconnect,$qSlide);
	?>
 <script>
 var times= <?php echo $rSlide[0]['timeslide']; ?>;
 setTimeout(function(){
 scroll(times);}
 ,2000);
</script>
