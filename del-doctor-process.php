<?php     
session_start();
if($_SESSION["user_type"] != 'admin_user'){
    header("Location:opd.php");
}
include("db.php"); 
$doc_id = $_POST['doc_id'];
echo $sql = "DELETE FROM doctors WHERE doc_id = $doc_id";
if ($conn->query($sql) === TRUE) {
    header("Location:view-doctors.php?del=$doc_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>