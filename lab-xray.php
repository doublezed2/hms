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
                            <a class="nav-link text-white" href="lab-xray.php">X-RAY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">CT-SCAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">MRI</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div id="content" class="mt-4">

                <!-- Begin Page Content -->
                <div class="container-fluid">


                
                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-1">
                            <h1 class="h3 mb-0 text-gray-800">X-RAY</h1>        
                            <br>
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <label>Patient Name</label>
                                    <input type="text" name="p_name" class="form-control" autocomplete="off" required tabindex="1" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="text" name="p_phone" class="form-control" autocomplete="off" required tabindex="2">
                                </div>
                                <div class="form-group">
                                    <label>Choose X-Ray Type</label>
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
                                            ?>
                                            <option value="<?php echo $d_id."|".$d_name."|".$d_fee; ?>"><?php echo $d_name; ?></option>
                                            <?php
                                            endwhile;
                                        }
                                        ?> 
                                    </select>
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
                                    <label>X-Ray Fee</label>
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