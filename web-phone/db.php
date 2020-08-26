<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digisoftb_demohm";

//$base_url ="'http://risolvehm.digisoftbiz.ae/";
$base_url ="http://localhost/hospital/";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?> 