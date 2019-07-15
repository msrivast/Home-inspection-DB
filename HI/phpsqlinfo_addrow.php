<?php
require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters.
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];


// Opens a connection to a MySQL server.
$connection=mysqli_connect ("localhost", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysqli_error($connection));
}

// Sets the active MySQL database.
$db_selected = mysqli_select_db($connection, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($connection));
}

// Inserts new row with place data.
$query = sprintf("INSERT INTO markers " .
         " (id, address, lat, lng ) " .
         " VALUES (NULL, '%s', '%s', '%s');",
         mysqli_real_escape_string($connection,$address),
         mysqli_real_escape_string($connection,$lat),
         mysqli_real_escape_string($connection,$lng));

$result = mysqli_query($connection,$query);



if (!$result) {
  die('Invalid query: ' . mysqli_error($connection));
}
else {
  $id = mysqli_insert_id($connection);
  echo $id;
}

?>