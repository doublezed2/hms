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
                            <h3>Delete Doctor</h3>
                            <?php
                            include("db.php");
                            $sql = "SELECT * FROM doctors WHERE doc_id =".$_GET['id'];
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0):
                            $row = $result->fetch_assoc();
                            ?>
                            <form action="del-doctor-process.php" method="POST">
                                <input type="hidden" name="doc_id" value="<?php echo $_GET['id'];?>">
                                <div class="form-group">
                                    <label>Name: <?php echo $row['doc_name'];?></label>
                                    <br>
                                    <label>Fee: <?php echo $row['doc_fee'];  ?></label>
                                </div>
                                <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                            </form>
                            <?php
                            endif; // $result->num_rows
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