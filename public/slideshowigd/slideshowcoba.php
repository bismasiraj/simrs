<?php
  require_once('function.php');
  require_once('connection.php');
    $qMenu = 'select
    wm.MENU_ID,
    wm.javascript_id,
    wm.file_name,
    wm.menu_name,
    wm.header_name,
    wm.timeslide

    from WEBSITE_MENU wm
    where wm.isactive = 1
    and wm.isslide = 1
    and wm.menu_type = 1';

    $rMenu=querryResult($dbconnect,$qMenu);
    $setIntv = 1;
    $setIntv = $setIntv * 30000;
    $setRefresh = $rMenu[1]['timeslide'];
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php echo "<meta http-equiv=\"refresh\" content=\"".$setRefresh."\"/>"; ?>
    <title>Grafik Ketersediaan Kamar</title>
    <?php include('library.php'); ?>
  </head>
  <body oncontextmenu="return false;">
    <!--SIDEBAR NAVIGATION-->
    <div id="kepala" style="height:30vh;">
       <?php include('header.php') ?>
    </div>
    <div style="overflow:hidden;width:99%;height:70vh;">
      <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:70vh;">
       <div id="my_div"></div>
     </div>
   </div>

<?php
echo "<script>";
// foreach ($rMenu as $key => $value) {
  echo "setTimeout(";
  echo "function() {";
  echo "$('#my_div').load('".$rMenu[1]['file_name']."');";
  echo "document.getElementById(\"header\").innerHTML = \"".$rMenu[1]['header_name']."\";";
  // echo "setInterval(function(){";
  //   echo "$('#my_div').load('".$rMenu[$key]['file_name']."');";
  //   echo "document.getElementById(\"header\").innerHTML = \"".$rMenu[$key]['header_name']."\";";
  //   echo "}, $setIntv)";
        $setTmo = 30000 * 0;
  echo "},$setTmo);";
// }
echo "</script>";
 ?>

</div>
</div>
  </body>
</html>
