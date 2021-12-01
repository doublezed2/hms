<?php
session_start();
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
if(isset($_POST["apt-id"])){
  include("db.php");
  $apt_id = $_POST["apt-id"];
  $status = ($_POST["cancel-free"] == "cancel") ? 0 : 2;

  $now_date = Date("Y-m-d H:i:s");
  $sql = "UPDATE appointments SET pat_status=$status, pat_updated_on='$now_date' WHERE pat_id=$apt_id";
  if ($conn->query($sql) === TRUE && $conn-> affected_rows > 0) {
    header("Location:cancel-apt.php?id=$apt_id&success=1");
  }
  else {
    header("Location:cancel-apt.php?failure=1");
  }

  $conn->close();
}
else{
  header("location:cancel-apt.php?failure=1");
}
?>
