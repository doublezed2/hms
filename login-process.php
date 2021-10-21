<?php     
include("db.php"); 
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * from users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if($row['user_role'] == "admin_user"){
        $_SESSION['user_type'] = "admin_user";
        $_SESSION['user_name'] = "admin";
        $_SESSION['shift_id'] = "0";
        $_SESSION['shift_user_name'] = "Admin";

    }
    else{
        $_SESSION['user_type'] = "non_admin";
        $_SESSION['user_name'] = $row['username'];        
    }
    header("Location:opd.php");
}
else{
    header("Location:index.php");
}

$conn->close();
?>