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

            <!-- Main Content -->
            <div id="content" class="mt-4">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h3>View Doctors</h3>
                            <div class="table-responsive">
                                <?php
                                if(isset($_GET['del'])):?>
                                <br>
                                <div class="alert alert-danger" style="width:400px;">
                                <strong>Doctor deleted.</strong>
                                </div>
                                <?php 
                                endif;
                                ?>
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Fee</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include("db.php");
                                    $sql = "SELECT * FROM doctors ORDER BY doc_name";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $count=1;
                                        while($row = $result->fetch_assoc()):
                                        $doc_id = $row['doc_id'];
                                        ?>
                                        <tr>
                                        <td scope="row"><?php echo $count; ?></td>
                                        <td><?php echo $row['doc_name']; ?></td>
                                        <td><?php echo $row['doc_fee']; ?></td>
                                        <td>
                                            <a href="update-doctor.php?id=<?php echo $doc_id;?>" class="btn btn-warning">Edit</a>
                                            <a href="del-doctor.php?id=<?php echo $doc_id;?>" class="btn btn-danger">Delete</a>
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