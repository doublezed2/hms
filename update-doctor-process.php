<?php
session_start();
if($_SESSION["user_type"] != 'admin_user'){
    header("Location:opd.php");
}
include("db.php"); 
$doc_id = $_POST['doc_id'];
$doc_name = $_POST['doc_name'];
$doc_fee = $_POST['doc_fee'];
$sql = "UPDATE doctors SET doc_name='$doc_name', doc_fee='$doc_fee' WHERE doc_id=$doc_id";
if ($conn->query($sql) === TRUE) {
    header("Location:update-doctor.php?id=$doc_id&success=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>