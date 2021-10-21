<?php
session_start();
if(!isset($_SESSION["user_type"])){
    header("Location:index.php");
}
include("header.php");
?>
<body id="page-top">
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" class="mt-4">

                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-md-3 offset-md-1">
                            <h3>Close Shift</h3>
                            <?php
                            if(isset($_SESSION['shift_id'])):
                            ?>
                            <form action="close-shift-process.php" method="POST">
                                <div class="form-group">
                                    <label>Shift Number</label>
                                    <input type="text" name="shift_id" class="form-control" value="<?php echo $_SESSION['shift_id']; ?>" required readonly>
                                    <label>Name</label>
                                    <input type="text" name="shift_user_name" class="form-control" value="<?php echo $_SESSION['shift_user_name']; ?>" required readonly>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Close</button>
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