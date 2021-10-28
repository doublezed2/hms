<?php
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
$_SESSION['shift_id'] = $_POST["shift_id"];
$_SESSION['shift_type'] = $_POST["shift_type"];
$_SESSION['shift_user_name'] = $_POST["shift_user_name"];
header("location:opd.php");
?>