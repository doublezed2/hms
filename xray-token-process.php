<?php
session_start();
include("db.php");
if(!isset($_SESSION["user_type"])){
  header("Location:index.php");
}
$p_name = trim($_POST["p_name"]);
$p_phone = trim($_POST["p_phone"]);

$p_x_arr = explode("|",$_POST["p_xray"]);
$p_xray_id = $p_x_arr[0];
$p_xray_name = $p_x_arr[1];
$x_fee = $_POST["x_fee"];

$doc_arr = explode("|",$_POST["p_doctor"]);
$doc_id = $doc_arr[0];
$p_doc_name = $doc_arr[1];

$pat_shift = $_SESSION["shift_id"];
$p_date = date("Y-m-d H:i:s"); //2021-10-23

$sql = "INSERT INTO xray_apts(xapt_token, xapt_xname, xapt_pname, xapt_phone, xapt_doc, xapt_fee, xapt_created_on, xapt_shift)
SELECT IFNULL(MAX(xapt_token) + 1, 1), '$p_xray_name', '$p_name', '$p_phone', '$doc_id', $x_fee, '$p_date', $pat_shift
FROM xray_apts WHERE date(xapt_created_on) = CURDATE()";
if ($conn->query($sql) === TRUE) {
  $serial_no = $conn->insert_id;
  $inner_sql = "SELECT xapt_token FROM xray_apts WHERE xapt_id=".$conn->insert_id;
  $inner_result = $conn->query($inner_sql);
  $inner_row = $inner_result->fetch_assoc();
  $xapt_token = $inner_row['xapt_token'];
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
      <h3>X-Ray Token</h3>
      <span class="rx_token_number"><?php echo $xapt_token;?></span>
      <table style="width: 100%;">
      <tr>
        <td>Date: <?php echo date("d-m-Y", strtotime($p_date)) ; ?></td>
      </tr>
      <tr>
        <td>Patient: <?php echo $p_name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 13pt;font-family: arial;"><?php echo $p_xray_name; ?></td>
      </tr>
      <tr>
        <td>Dr: <?php echo $p_doc_name; ?></td>
      </tr>
      <tr>
        <td>Fee paid: <?php echo $x_fee; ?></td>
      </tr>
      </table>
      <hr>
      <p style="font-size: 10pt;"><span style="float: left;">User: <?php echo $_SESSION['shift_user_name']; ?></span><span style="float: right;">Serial: xray-<?php echo $serial_no; ?></span></p>
      <p style="font-size: 10pt;"><span style="float: left;">Date/Time: <?php echo Date("h:i A d/m/Y"); ?></span></p>
    </div>
    <script>
      window.print();
      setTimeout(() => {
       document.location.href = "xray-token.php?success=1";
      }, 1000);
    </script>
  </body>
  </html>
  <?php
} 
else {
  header("location:xray-token.php?failure=1");
}
$conn->close();
?>