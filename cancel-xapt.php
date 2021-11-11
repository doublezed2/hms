<?php
session_start();
if(!isset($_SESSION["user_type"])){
    header("Location:index.php");
}
include("header.php");
?>
<body id="page-top">
    <div id="wrapper">
        <?php include("sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="container-fluid p-2" style="background-color:#333;">
                <div class="row">
                    <div class="col-md-12">
                    <ul class="nav"> <!-- class for justify-content-center -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="xray-token.php">X-Ray Token</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>

            <div id="content" class="mt-4">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-md-3 offset-md-1">
                            <h3>Cancel X-Ray</h3>
                            <br>
                            <form action="cancel-xapt-process.php" method="POST">
                                <div class="form-group">
                                    <label>Serial Number</label>
                                    <input type="text" name="xapt-id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="cancel-free" id="cancel-xapt"  value="cancel" checked>
                                        <label class="form-check-label" for="cancel-xapt">Cancel</label>
                                    </div>
                                    <div class="form-group form-check-inline">
                                        <input class="form-check-input" type="radio" name="cancel-free" id="free-xapt" value="free">
                                        <label class="form-check-label" for="free-xapt">Free</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </form>
                            <?php
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                            <strong>X-Ray AH-<?php echo $_GET['id'] ?> Updated.</strong>
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