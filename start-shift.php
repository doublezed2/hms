<?php
session_start();
if(!isset($_SESSION["user_type"])){
    header("Location:index.php");
}
include("header.php");
include("db.php");
?>
<body id="page-top">
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" class="mt-4">

                <div class="container-fluid">

                    <div class="row mt-4">
                        <?php
                        $sql = "SELECT shift_id, shift_user_name, end_time FROM shifts ORDER BY shift_id DESC LIMIT 1";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        if($row['end_time'] == "0000-00-00 00:00:00"):
                        ?>
                        <div class="col-md-3 offset-md-1">
                            <h3>Resume Shift</h3>
                            <form action="resume-shift-process.php" method="POST">
                                <div class="form-group">
                                    <label>Shift No.</label>
                                    <input type="text" name="shift_id" value="<?php echo $row['shift_id']; ?>" class="form-control" readonly>
                                    <label>Name</label>
                                    <input type="text" name="shift_user_name" value="<?php echo $row['shift_user_name']; ?>" class="form-control" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Resume</button>
                            </form>
                        </div>
                        <?php
                        else:
                        ?>
                        <div class="col-md-3 offset-md-1">
                            <h3>Start Shift</h3>
                            <form action="start-shift-process.php" method="POST">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="shift_user_name" class="form-control" autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Start</button>
                            </form>
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
                        <span>Copyright &copy; Ali Hospital <?php echo date("Y"); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php include("footer.php"); ?>