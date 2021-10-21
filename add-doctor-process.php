<?php
session_start();
if($_SESSION["user_type"] != 'admin_user'){
  header("Location:opd.php");
}

$d_name = $_POST["d_name"];
$d_fee = $_POST["d_fee"];

// Do Validation and Sanitization

include("db.php");
$sql = "INSERT INTO doctors(doc_name,doc_fee)
VALUES ('$d_name', '$d_fee')";
if ($conn->query($sql) === TRUE) {
  header("location:add-doctor.php?success=1");
} else {
  header("location:add-doctor.php?failure=1");
}
$conn->close();
?>