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
    and wm.menu_type = 101';

$rMenu = querryResult($dbconnect, $qMenu);
$setIntv = 0;

foreach ($rMenu as $key => $value) {
  $setIntv = $setIntv + $rMenu[$key]['timeslide'];
}
$setRefresh = $setIntv;
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <?php echo "<meta http-equiv=\"refresh\" content=\"" . $setRefresh . "\"/>"; ?>
  <title>Grafik Ketersediaan Kamar</title>
  <?php include('library.php'); ?>
</head>

<body oncontextmenu="return false;">
  <!--SIDEBAR NAVIGATION-->
  <div id="kepala" style="height:25vh;">
    <?php include('header.php') ?>
  </div>
  <div style="overflow:hidden;width:99%;height:75vh;">
    <div id="bodyscroll" style="overflow-y:scroll;overflow-x:hidden;width:102%;height:70vh;">
      <div id="my_div"></div>
    </div>
  </div>
  <script>
    /* Get the documentElement (<html>) to display the page in fullscreen */
    var elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) {
        /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        /* IE11 */
        elem.msRequestFullscreen();
      }
    }

    /* Close fullscreen */
    function closeFullscreen() {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
      }
    }
  </script>
  <script type="text/javascript">
    setTimeout(function() {
      $('#my_div').load('ketersediaan-umum.php');
      document.getElementById("header").innerHTML = "Ketersediaan Kamar Kelas UTAMA";
    }, 0);
    openFullscreen()
  </script>
  </div>
  </div>
</body>

</html>