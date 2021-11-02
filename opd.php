<?php
session_start();
if(!isset($_SESSION["user_type"])){
    header("Location:index.php");
}
if(!isset($_SESSION["shift_id"])){
    header("Location:start-shift.php");
}
if(isset($_SESSION["shift_report_printed"])){
    header("Location:print-shift-reports.php");
}
include("db.php");
include("header.php");
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include("sidebar.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="container-fluid p-2" style="background-color:#333;">
                <div class="row">
                    <div class="col-md-12">
                    <ul class="nav"> <!-- class for justify-content-center -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="opd.php">OPD</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="cancel-apt.php">Cancel/Free</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div id="content" class="mt-4">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">OPD</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $shift_id = $_SESSION['shift_id'];
                                                $count_sql = "SELECT COUNT(pat_id) AS total_pats, SUM(pat_fee) AS total_amount FROM appointments WHERE pat_shift=$shift_id AND pat_status=1";
                                                $count_result = $conn->query($count_sql);
                                                $count_row = $count_result->fetch_assoc();
                                                echo $count_row['total_pats'];

                                                $cancel_sql = "SELECT COUNT(pat_id) AS total_pats, COUNT(pat_id)*50 AS total_amount FROM appointments WHERE pat_shift=$shift_id AND pat_status!=1";
                                                $cancel_result = $conn->query($cancel_sql);
                                                $cancel_row = $cancel_result->fetch_assoc();
                                            ?>    
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Cash</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round($count_row['total_amount']); echo" + "; echo round($cancel_row['total_amount']); echo" = "; echo round($count_row['total_amount']+$cancel_row['total_amount']); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h3>Create Appointment</h3>
                            <form action="opd-process.php" method="POST">
                                <div class="form-group">
                                    <label>Patient Name</label>
                                    <input type="text" name="p_name" class="form-control" autocomplete="off" required tabindex="1" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="text" name="p_phone" class="form-control" autocomplete="off" required tabindex="2">
                                </div>
                                <div class="form-group">
                                    <label>Choose Doctor</label>
                                    <select class="form-control" id="p_doctor" name="p_doctor" required tabindex="3">
                                        <option>Choose</option>
                                        <?php
                                        $sql = "SELECT * FROM doctors";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()):
                                                $d_id = $row['doc_id'];
                                                $d_name = $row['doc_name'];
                                                $d_fee = $row['doc_fee'];
                                                $d_clinic = $row['clinic'];
                                            ?>
                                            <option value="<?php echo $d_id."|".$d_name."|".$d_fee."|".$d_clinic; ?>"><?php echo $d_name; ?></option>
                                            <?php
                                            endwhile;
                                        }
                                        ?> 
                                    </select>
                                </div>
                                <div id="new-old-pat" class="form-group new-old-pat">
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="new-old-pat" id="old-pat" value="old-pat" checked>
                                        <label class="form-check-label" for="old-pat">Old Patient</label>
                                    </div>
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="new-old-pat" id="new-pat"  value="new-pat">
                                        <label class="form-check-label" for="new-pat">New Patient</label>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top:35px;">
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="p_date" id="radioToday"  value="<?php echo date("Y-m-d"); ?>" checked>
                                        <label class="form-check-label" for="radioToday">
                                        Today (<?php echo date("d/m/Y"); ?>)
                                        </label>
                                    </div>
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="p_date" id="radioTomorrow" value="<?php echo date("Y-m-d", strtotime("+1 day")); ?>">
                                        <label class="form-check-label" for="radioTomorrow">
                                            Tomorrow (<?php echo date("d/m/Y", strtotime("+1 day")); ?>) 
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="private-panel" id="private-pat"  value="private" checked>
                                        <label class="form-check-label" for="private-pat">Private</label>
                                    </div>
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="private-panel" id="panel-pat" value="panel">
                                        <label class="form-check-label" for="panel-pat">Panel</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Doctor Fee</label>
                                    <input type="text" name="p_fee" id="p_fee" class="form-control" readonly required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg" tabindex="5">Save</button>
                            </form>
                            <?php
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                            <strong>Appointment created.</strong>
                            </div>
                            <?php 
                            endif;
                            if(isset($_GET['failure'])):?>
                                <br>
                                <div class="alert alert-danger">
                                <strong>Appointment failed. Please try again</strong>
                                </div>
                                <?php 
                                endif;
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h3>Recent Appointments</h3>
                            <a href="view-appointments.php">View all Appointments</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Token#</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Doctor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT appointments.pat_token AS p_token, appointments.pat_name AS p_name , appointments.pat_phone AS p_phone, doctors.doc_name AS p_doc FROM appointments INNER JOIN doctors ON appointments.pat_doctor=doctors.doc_id WHERE appointments.pat_shift='$shift_id' AND pat_status=1 ORDER BY appointments.pat_created_on DESC limit 10";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()):
                                                $pat_token = $row['p_token'];
                                                $pat_name = $row['p_name'];
                                                $pat_phone = $row['p_phone'];
                                                $pat_doctor = $row['p_doc'];                                                
                                            ?>
                                            <tr>
                                                <td><?php echo $pat_token; ?></td>
                                                <td><?php echo $pat_name; ?></td>
                                                <td><?php echo $pat_phone; ?></td>
                                                <td><?php echo $pat_doctor; ?></td>
                                            </tr>
                                            <?php
                                            endwhile;
                                        }
                                        ?>
                                        </tbody>
                                </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ali Hospital 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php include("footer.php"); ?>