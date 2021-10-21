<?php
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
include("db.php");
$sql = "UPDATE shifts SET end_time=NOW() WHERE shift_id=".$_SESSION['shift_id'];
if ($conn->query($sql) === TRUE) {
  unset($_SESSION['shift_id']);
  header("location:print-shift-reports.php");
} else {
  //echo $conn->error;
  header("location:close-shift.php?failure=1");
}
$conn->close();
?>