<?php
date_default_timezone_set("Asia/Karachi");
$servername = "localhost";
$username = "root";
$password = "zZ991231";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>