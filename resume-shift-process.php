<?php
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
$shift_id = $_POST["shift_id"];
$shift_user_name = $_POST["shift_user_name"];

$_SESSION['shift_id'] = $shift_id;
$_SESSION['shift_user_name'] = $shift_user_name;
 header("location:opd.php");
?>