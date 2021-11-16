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
                            <a class="nav-link text-white" href="xray-token.php">X-RAY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="cancel-xapt.php">Cancel X-Ray</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div id="content" class="mt-2">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total X-Rays</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $shift_id = $_SESSION['shift_id'];
                                                $count_sql = "SELECT COUNT(xapt_id) AS total_xapts, SUM(xapt_fee) AS total_amount FROM xray_apts WHERE xapt_shift=$shift_id AND xapt_status=1";
                                                $count_result = $conn->query($count_sql);
                                                $count_row = $count_result->fetch_assoc();
                                                echo $count_row['total_xapts'];

                                                /*$cancel_sql = "SELECT COUNT(pat_id) AS total_pats, COUNT(pat_id)*50 AS total_amount FROM appointments WHERE pat_shift=$shift_id AND pat_status!=1";
                                                $cancel_result = $conn->query($cancel_sql);
                                                $cancel_row = $cancel_result->fetch_assoc();*/
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
                                                X-Ray Amount</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo round($count_row['total_amount']);?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <h1 class="h3 mb-0 text-gray-800">X-RAY</h1>        
                            
                            <form action="xray-token-process.php" method="POST">
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
                                    <select class="form-control" id="p_xray" name="p_xray" required tabindex="3">
                                        <option>Choose</option>
                                        <?php
                                        $sql = "SELECT * FROM xrays ORDER BY xray_name";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()):
                                                $x_id = $row['xray_id'];
                                                $x_name = $row['xray_name'];
                                                $x_fee = $row['xray_fee'];
                                            ?>
                                            <option value="<?php echo $x_id."|".$x_name."|".$x_fee; ?>"><?php echo $x_name; ?></option>
                                            <?php
                                            endwhile;
                                        }
                                        ?> 
                                    </select>
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
                                            ?>
                                            <option value="<?php echo $d_id."|".$d_name; ?>"><?php echo $d_name; ?></option>
                                            <?php
                                            endwhile;
                                        }
                                        ?> 
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="private-panel" id="private-pat"  value="private" checked>
                                        <label class="form-check-label" for="private-pat">Private</label>
                                    </div>
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="private-panel" id="panel-pat" value="panel">
                                        <label class="form-check-label" for="panel-pat">Panel</label>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label>X-Ray Fee</label>
                                    <input type="text" name="x_fee" id="x_fee" class="form-control" readonly required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg" tabindex="5">Print</button>
                            </form>
                            <?php
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                            <strong>X-Ray created.</strong>
                            </div>
                            <?php 
                            endif;
                            if(isset($_GET['failure'])):?>
                                <br>
                                <div class="alert alert-danger">
                                <strong>X-Ray failed. Please try again</strong>
                                </div>
                                <?php 
                                endif;
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h3>Recent X-Rays</h3>
                            <a href="view-all-xapts.php">View all X-Rays</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Token#</th>
                                            <th>X-Ray</th>
                                            <th>Patient</th>
                                            <th>Mobile</th>
                                            <th>Doctor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT xray_apts.xapt_token AS x_token, xray_apts.xapt_xname AS x_name, xray_apts.xapt_pname AS x_pname, xray_apts.xapt_phone AS x_phone, doctors.doc_name AS x_doc FROM xray_apts INNER JOIN doctors ON xray_apts.xapt_doc=doctors.doc_id WHERE xray_apts.xapt_shift='$shift_id' AND xray_apts.xapt_status=1 ORDER BY xray_apts.xapt_created_on DESC limit 10";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()):
                                                $xapt_token = $row['x_token'];
                                                $xapt_name = $row['x_name'];
                                                $xapt_phone = $row['x_phone'];
                                                $xapt_doctor = $row['x_doc'];
                                                $xapt_pat = $row['x_pname'];                                                
                                            ?>
                                            <tr>
                                                <td><?php echo $xapt_token; ?></td>
                                                <td><?php echo $xapt_name; ?></td>
                                                <td><?php echo $xapt_pat; ?></td>
                                                <td><?php echo $xapt_phone; ?></td>
                                                <td><?php echo $xapt_doctor; ?></td>
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
                        <span>Copyright &copy; Ali Hospital <?php echo Date('Y');?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php include("footer.php"); ?>