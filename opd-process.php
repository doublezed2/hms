<?php
session_start();
include("db.php");
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
$p_name = trim($_POST["p_name"]);
$p_phone = trim($_POST["p_phone"]);
$p_doctor_arr = explode("|",$_POST["p_doctor"]);
$p_doctor = $p_doctor_arr[0];
$p_doctor_name = $p_doctor_arr[1];
$p_doctor_clinic = $p_doctor_arr[3];
$p_date = $_POST["p_date"];
$p_fee = $_POST["p_fee"];
$pat_shift = $_SESSION["shift_id"];
$now_date = Date("Y-m-d h:i:s");
$sql = "INSERT INTO appointments(pat_token, pat_name,pat_phone, pat_doctor, pat_apt_time, pat_fee, pat_created_on, pat_shift)
SELECT IFNULL(MAX(pat_token) + 1, 1), '$p_name', '$p_phone', '$p_doctor', '$p_date', $p_fee, '$now_date', $pat_shift
FROM appointments WHERE pat_doctor=$p_doctor AND pat_apt_time = '$p_date'"; // Trying using currdate like xray token

if ($conn->query($sql) === TRUE) {
  $serial_no = $conn->insert_id;
  $inner_sql = "SELECT pat_token FROM appointments WHERE pat_id=".$conn->insert_id;
  $inner_result = $conn->query($inner_sql);
  $inner_row = $inner_result->fetch_assoc();
  $p_token = $inner_row['pat_token'];
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    body{
      font-family:monospace;
    }
    .logo{
      text-align:center;
    }
    .receipt{
      display:block;
      font-weight:bold;
      font-size: 12pt;
    }
    h3{
      margin-bottom:14px;
      text-align:center;

    }
    .rx_token_number{
      width: 34px;
      border: 2px solid #000;
      padding: 12px 12px;
      border-radius: 50%;
      font-size: 26px;
      display: block;
      margin: 0px auto;
      margin-bottom: 15px;
      text-align: center;
    }
    .receipt {
          display: none;
    }
    .print-message{
        font-size: 16px;
    }
    @media print {
      .receipt {
          display: block;
      }
      .print-message{
        display:none;
      }
    }
    </style>
  </head>
  <body>
    <p class="print-message">Printing Slip...</p>
    <div class="receipt">
      <div class="logo"><img src="img/logo-black.jpg" width="200px"></div>
      <h3>OPD Slip</h3>
      <span class="rx_token_number"><?php echo $p_token;?></span>
      <table style="width: 100%;">
      <tr>
        <td>Date: <?php echo date("d-m-Y", strtotime($p_date)) ; ?></td>
      </tr>
      <tr>
        <td>Patient: <?php echo $p_name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 13pt;font-family: arial;"><?php echo $p_doctor_name; ?></td>
      </tr>
      <tr>
        <td>Clinic: <?php echo $p_doctor_clinic;?></td>
      </tr>
      <tr>
        <td>Company: <?php echo "Private"; ?></td>
      </tr>
      <tr>
        <td>Fee paid: <?php echo $p_fee; ?></td>
      </tr>      
      </table>
      <hr>
      <p style="font-size: 10pt;"><span style="float: left;">User: <?php echo $_SESSION['shift_user_name']; ?></span><span style="float: right;">Serial: AH-<?php echo $serial_no; ?></span></p>
      <p style="font-size: 10pt;"><span style="float: left;">Date/Time: <?php echo Date("h:i A d/m/Y"); ?></span></p>
    </div>
    <script>
      window.print();
      setTimeout(() => {
       document.location.href = "opd.php?success=1";
      }, 1000);
    </script>
  </body>
  </html>
  <?php
} 
else {
  header("location:opd.php?failure=1");
}
$conn->close();

?>