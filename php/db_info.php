<?php
$conn = mysqli_connect("localhost", "mrgoodway", "whdmsrlf1!");
mysqli_select_db($conn, "mrgoodway");
if (!$conn) {
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;}
// $root_url = 'http://bmrmentoring.run.goorm.io/phpmyadmin/';
?>