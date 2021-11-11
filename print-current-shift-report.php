<?php
session_start();
if(!isset($_SESSION["user_type"])){
header("Location:index.php");
}
include("db.php");

$s_shift_id = $_SESSION['shift_id'];
$now_date = Date("Y-m-d h:i:s");
$sh_sql = "UPDATE shifts SET end_time='$now_date' WHERE shift_id=".$s_shift_id;
if ($conn->query($sh_sql) === TRUE) {
  $_SESSION["shift_report_printed"] = 1;
}
else {
  //echo $conn->error;
  header("Location:print-shift-reports.php?failure=1");
}

$sql = "SELECT COUNT(appointments.pat_id) AS total_pats, SUM(appointments.pat_fee) AS total_amount,shifts.shift_id, shifts.start_time, shifts.end_time, shifts.shift_user_name FROM appointments 
INNER JOIN shifts ON appointments.pat_shift=shifts.shift_id 
WHERE appointments.pat_shift=$s_shift_id AND appointments.pat_status=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
else{
    header("Location:print-shift-reports.php?failure=1");
}
$cancel_sql = "SELECT COUNT(pat_id) AS total_pats, COUNT(pat_id)*50 AS total_amount FROM appointments WHERE pat_shift=$s_shift_id AND pat_status!=1";
$cancel_result = $conn->query($cancel_sql);
if ($cancel_result->num_rows > 0) {
  $cancel_row = $cancel_result->fetch_assoc();
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
      .report {
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
      <h3 style="margin-bottom:0px;">Shift Report</h3>
      <table style="width: 100%;">
      <tr>
        <td>Shift: <?php echo $_SESSION['shift_type']; ?></td>
      </tr>
      <tr>
        <td>Name: <?php echo $_SESSION['shift_user_name']; ?></td>
      </tr>
      <tr>
        <td>Start: <?php echo date("h:i A", strtotime($row['start_time'])) ; ?></td>
      </tr>
      <tr>
        <td>End: <?php echo date("h:i A", strtotime($row['end_time'])) ; ?></td>
      </tr>
      <tr>
        <td>Total patients: <?php echo $row['total_pats']; ?></td>
      </tr>
      <tr>
        <td>Patient amount: <?php echo round($row['total_amount']); ?></td>
      </tr>
      <tr>
        <td>Cancelled Patients: <?php echo $cancel_row['total_pats']; ?></td>
      </tr>
      <tr>
        <td>Cancelled amount: <?php echo round($cancel_row['total_amount']); ?></td>
      </tr>
      <tr>
        <td style="font-family:Times New Roman;font-size:14pt;">Total amount: <?php echo $row['total_amount']+$cancel_row['total_amount']; ?></td>
      </tr>
      <tr>
        <td style="font-family:Times New Roman;font-size:14pt;">Total hospital: <?php echo ($row['total_pats']*50)+$cancel_row['total_amount']; ?></td>
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