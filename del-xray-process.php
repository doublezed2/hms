<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
    header("Location:opd.php");
}
include("db.php"); 
$xray_id = $_POST['xray_id'];
$sql = "DELETE FROM xrays WHERE xray_id = $xray_id";
if ($conn->query($sql) === TRUE) {
    header("Location:view-xrays.php?del=$xray_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>