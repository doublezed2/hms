<?php
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:opd.php");
}

$x_name = $_POST["x_name"];
$x_fee = $_POST["x_fee"];

// Do Validation and Sanitization

include("db.php");
$sql = "INSERT INTO xrays(xray_name,xray_fee)
VALUES ('$x_name', '$x_fee')";
if ($conn->query($sql) === TRUE) {
  header("location:add-xray.php?success=1");
} 
else {
  header("location:add-xray.php?failure=1");
}
$conn->close();
?>