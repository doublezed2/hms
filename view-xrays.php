<?php
session_start();
if(!isset($_SESSION["user_type"])){
header("Location:index.php");
}
include("header.php");
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include("sidebar.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="container-fluid p-1" style="background-color:#333;">
                <div class="row">
                    <div class="col-md-12">
                    <ul class="nav"> <!-- class for justify-content-center -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="view-xrays.php">View X-Rays</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="add-xray.php">Add X-Rays</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div id="content" class="mt-4">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h3>View X-Rays</h3>
                            <div class="table-responsive">
                                <?php
                                if(isset($_GET['del'])):?>
                                <br>
                                <div class="alert alert-danger" style="width:400px;">
                                <strong>X-Ray deleted.</strong>
                                </div>
                                <?php 
                                endif;
                                ?>
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>X-Ray Name</th>
                                            <th>Fee</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include("db.php");
                                    $sql = "SELECT * FROM xrays ORDER BY xray_name";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $count=1;
                                        while($row = $result->fetch_assoc()):
                                        $xray_id = $row['xray_id'];
                                        ?>
                                        <tr>
                                        <td scope="row"><?php echo $count; ?></td>
                                        <td><?php echo $row['xray_name']; ?></td>
                                        <td><?php echo $row['xray_fee']; ?></td>
                                        <td>
                                            <a href="update-xray.php?id=<?php echo $xray_id;?>" class="btn btn-warning">Edit</a>
                                            <a href="del-xray.php?id=<?php echo $xray_id;?>" class="btn btn-danger">Delete</a>
                                        </td>
                                        </tr>
                                        <?php
                                        $count++;
                                        endwhile;
                                    } 
                                    $conn->close();
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
            <footer class="sticky-footer bg-white mt-5">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ali Hospital <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php include("footer.php"); ?>