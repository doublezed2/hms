<?php
session_start();
if(!isset($_SESSION["user_type"])){
header("Location:index.php");
}
if(isset($_SESSION["shift_id"])){
    header("Location:close-shift.php");
}
include("db.php");
include("header.php");
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="mt-4">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-3 offset-md-1">
                            <h3>Print Shift Reports</h3>
                            <form action="print-current-shift-report.php" method="POST">
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary btn-lg">Print Current Shift Report</button>
                            </form>
                            <br>
                            <br>
                            <form action="print-doctor-report.php" method="POST">
                                <div class="form-group">
                                    <select class="form-control" id="p_doctor" name="p_doctor" required tabindex="3">
                                        <option>Choose Doctor</option>
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
                                <button type="submit" class="btn btn-primary btn-lg">Print Doctor Report</button>
                            </form>
                            <br>
                            <br>
                            <form action="print-day-report.php" method="POST">
                                <button type="submit" class="btn btn-primary btn-lg">Print Day Report</button>
                            </form>
                            <?php
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                            <strong>Report Printed.</strong>
                            </div>
                            <a class="btn btn-danger btn-lg" href="logout.php">Logout</a>
                            <?php 
                            endif;
                            ?>
                        </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-5">
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