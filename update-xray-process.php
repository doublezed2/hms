<?php
session_start();
if($_SESSION["user_type"] != 'admin_user'){
    header("Location:opd.php");
}
include("db.php"); 
$xray_id = $_POST['xray_id'];
$xray_name = $_POST['xray_name'];
$xray_fee = $_POST['xray_fee'];
$sql = "UPDATE xrays SET xray_name='$xray_name', xray_fee='$xray_fee' WHERE xray_id=$xray_id";
if ($conn->query($sql) === TRUE) {
    header("Location:update-xray.php?id=$xray_id&success=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>