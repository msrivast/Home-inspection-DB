<?php
require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters.
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];

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
         " (id, name, address, lat, lng, type ) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s');",
         mysqli_real_escape_string($connection,$name),
         mysqli_real_escape_string($connection,$address),
         mysqli_real_escape_string($connection,$lat),
         mysqli_real_escape_string($connection,$lng),
         mysqli_real_escape_string($connection,$type));

$result = mysqli_query($connection,$query);

$id = mysqli_insert_id($connection);
echo 'id:'$id;

if (!$result) {
  die('Invalid query: ' . mysqli_error($connection));
}

?>