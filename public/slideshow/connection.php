<?php

$dbusername = "sa";
$dbpassword = "@gussalim7";
$dbservername = "sampangan";
$dbconnect = odbc_connect($dbservername, $dbusername, $dbpassword);
if (!$dbconnect) {
  die("gagal komandan");
}
