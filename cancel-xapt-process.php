<?php
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
if(isset($_POST["xapt-id"])){
  include("db.php");
  $xapt_id = $_POST["xapt-id"];
  $status = ($_POST["cancel-free"] == "cancel") ? 0 : 2;

  $now_date = Date("Y-m-d h:i:s");
  $sql = "UPDATE xray_apts SET xapt_status=$status, xapt_updated_on='$now_date' WHERE xapt_id=$xapt_id";
  if ($conn->query($sql) === TRUE && $conn-> affected_rows > 0) {
    header("Location:cancel-xapt.php?id=$xapt_id&success=1");
  }
  else {
    header("Location:cancel-xapt.php?failure=1");
  }

  $conn->close();
}
else{
  header("location:cancel-xapt.php?failure=1");
}
?>