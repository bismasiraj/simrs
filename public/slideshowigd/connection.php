<?php

// $dbusername = "sa";
// $dbpassword = "Agussalim7";
// $dbservername = "192.168.110.240:1433";

// Connection string with database name
// $server = '192.168.110.240';   // Server IP
// $port = '1433';                 // SQL Server Port (default is 1433)
// $database = 'PKUSAMPANGAN_VCLAIM_V11';      // Your database name
// $user = 'sa';        // Username for SQL Server
// $password = '@gussalim7';    // Password for SQL Server

// // Connection string
// $conn_str = "Driver={ODBC Driver 17 for SQL Server};Server=$server,$port;Database=$database;Uid=$user;Pwd=$password;";
// $dbconnect = odbc_connect($conn_str, $user, $password);
// $dbconnect = odbc_connect($dbservername, $dbusername, $dbpassword);

// $serverName = "192.168.110.240,1433"; // Specify server and port (use a comma for separation)
// $database = "PKUSAMPANGAN_VCLAIM_V11";  // Your database name
// $username = "sa";  // Your SQL Server username
// $password = "@gussalim7";  // Your SQL Server password

// // Create the connection string
// $dsn = "sqlsrv:Server=$serverName;Database=$database"; // Construct the correct DSN
// $dbconnect;
// try {
//   // Establish the connection
//   $dbconnect = new PDO($dsn, $username, $password);
//   $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enable exception mode for error handling
//   echo "Connection established!";
// } catch (PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();  // Catch and display any errors
// }


$dbusername = "sa";
$dbpassword = "@gussalim7";
$dbservername = "sampangan";
$dbconnect = odbc_connect($dbservername, $dbusername, $dbpassword);
if (!$dbconnect) {
  die("gagal komandan");
}
