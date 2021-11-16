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
                            <h3>Update Doctor</h3>
                            <?php
                            $sql = "SELECT * FROM doctors WHERE doc_id =".$_GET['id'];
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0):
                            $row = $result->fetch_assoc();
                            ?>
                            <form action="update-doctor-process.php" method="POST">
                                <input type="hidden" name="doc_id" value="<?php echo $_GET['id'];?>">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="doc_name" class="form-control" value="<?php echo $row['doc_name'];  ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Fee</label>
                                    <input type="text" name="doc_fee" class="form-control" value="<?php echo $row['doc_fee'];  ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Clinic</label>
                                    <?php
                                    if($row['clinic'] == "Ground Floor"){
                                        $ground_floor = "Selected";    
                                        $first_floor = "";
                                        $basement = "";
                                    }
                                    elseif($row['clinic'] == "First Floor"){
                                        $ground_floor = "";
                                        $first_floor = "Selected";
                                        $basement = "";    
                                    }
                                    elseif($row['clinic'] == "Basement"){
                                        $ground_floor = "";
                                        $first_floor = "";
                                        $basement = "Selected";
                                           
                                    }
                                    ?>
                                    <select class="form-control" name="clinic" required>
                                        <option value="Ground Floor" <?php echo $ground_floor; ?>>Ground Floor</option>
                                        <option value="First Floor" <?php echo $first_floor; ?>>First Floor</option>
                                        <option value="Basement" <?php echo $basement; ?>>Basement</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            </form>
                            <?php
                            endif; // $result->num_rows
                            if(isset($_GET['success'])):?>
                            <br>
                            <div class="alert alert-success">
                            <strong>Doctor updated.</strong>
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