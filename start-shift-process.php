<?php
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
$shift_user_name = $_POST["shift_user_name"];
$shift_type = $_POST["shift_type"];
$start_time = "";
$end_time = "";
$total_apts="";
$total_amount="";

// Do Validation and Sanitization

include("db.php");
$sql = "INSERT INTO shifts(start_time,end_time,shift_user_name,shift_type)
VALUES (NOW(), '', '$shift_user_name','$shift_type')";
if ($conn->query($sql) === TRUE) {
  $_SESSION['shift_id'] = $conn->insert_id;
  $_SESSION['shift_user_name'] = $shift_user_name;
  $_SESSION['shift_type'] = $shift_type;
  header("location:opd.php");
} else {
  //echo $conn->error;
  header("location:start-shift.php?failure=1");
}
$conn->close();
?>