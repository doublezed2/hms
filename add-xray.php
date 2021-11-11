<?php
session_start();
if($_SESSION["user_type"] != 'admin_user'){
    header("Location:opd.php");
}
include("header.php");
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include("sidebar.php"); ?>

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
                            <h3>Add X-Ray</h3>
                            <form action="add-xray-process.php" method="POST">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="x_name" class="form-control" autocomplete="off" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Fee</label>
                                    <input type="text" name="x_fee" class="form-control" autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </form>
                            <?php
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                            <strong>X-Ray added.</strong>
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