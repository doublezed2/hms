<?php
session_start();
include("db.php");
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
                            <h3>Update X-Ray</h3>
                            <?php
                            $sql = "SELECT * FROM xrays WHERE xray_id =".$_GET['id'];
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0):
                            $row = $result->fetch_assoc();
                            ?>
                            <form action="update-xray-process.php" method="POST">
                                <input type="hidden" name="xray_id" value="<?php echo $_GET['id'];?>">
                                <div class="form-group">
                                    <label>X-Ray</label>
                                    <input type="text" name="xray_name" class="form-control" value="<?php echo $row['xray_name'];  ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Fee</label>
                                    <input type="text" name="xray_fee" class="form-control" value="<?php echo $row['xray_fee'];  ?>" autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            </form>
                            <?php
                            endif; // $result->num_rows
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                                <strong>X-Ray updated.</strong>
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