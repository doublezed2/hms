<?php
session_start();
if(!isset($_SESSION["user_type"])){
header("Location:index.php");
}
include("db.php");

$doctor_arr = explode("|",$_POST["p_doctor"]);
$doctor_id = $doctor_arr[0];
$doctor_name = $doctor_arr[1];
$doctor_fee = $doctor_arr[2];
$date_from = date("Y-m-d 00:00:00");
$date_to = date("Y-m-d 23:59:59");

$sql = "SELECT COUNT(pat_id) AS total_pats, SUM(pat_fee) AS total_amount FROM appointments 
WHERE `pat_doctor` LIKE '$doctor_id' AND `pat_created_on` BETWEEN '$date_from' AND '$date_to'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
else{
  //echo $conn->error;  
  header("Location:print-shift-reports.php?failure=1");
}
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
    .report{
      display:block;
      font-weight:bold;
      font-size: 12pt;
    }
    h3{
      margin-bottom:14px;
      text-align:center;

    }
    .report {
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
    <p class="print-message">Printing Report...</p>
    <div class="report">
      <div class="logo"><img src="img/logo-black.jpg" width="200px"></div>
      <h3 style="margin-bottom:0px;">Doctor Report</h3>
      <table style="width: 100%;">
      <tr>
        <td>Date: <?php echo date("d/m/Y");?></td>
      </tr>
      <tr>
        <td>Doctor: <?php echo $doctor_name; ?></td>
      </tr>
      <tr>
        <td>Total patients: <?php echo $row['total_pats']; ?></td>
      </tr>
      <tr>
        <td>Total amount: <?php echo $row['total_amount']*1; ?></td>
      </tr>
      <tr>
        <td>Hospital fees: <?php echo $row['total_pats']*50; ?></td>
      </tr>
      <tr>
        <td>Doctor fees: <?php echo $row['total_amount']-($row['total_pats']*50); ?></td>
      </tr>
      </table>
      <hr>
      <p style="text-align:center; margin-top:0px;">Print Time:<br><?php echo date("h:i A d/m/Y");?></p>
    </div>
    <script>
      window.print();
      setTimeout(() => {
        document.location.href = "print-shift-reports.php?success=1";
      }, 1000);
    </script>
  </body>
  </html>

<?php
$conn->close();
?>