<!-- div level 1 -->
  <div class="container-fluid">
    <div class="jumbotron" style="height:15vh;background-color:#375E97;color:#C4DFE6;padding-top:2vh;margin-bottom:2vh;">
       <p id="header" style="font-size:5vh;"></p>
    </div>
  <div style="padding-left:30px;padding-top:0vh;">
     <div style="font-size:5vh">
     <?php
      $tanggal = date('Y-m-d');
       echo indostyle_date($tanggal, true);
     ?>
   </div>
  </div>
</div>

<!-- close div level 1 -->
