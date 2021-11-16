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
                            <h3>View X-Rays</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Token</th>
                                            <th>X-Ray</th>
                                            <th>Phone</th>
                                            <th>Doctor</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include("db.php");
                                    $sql = "SELECT xray_apts.xapt_id AS x_id, xray_apts.xapt_token AS x_token, xray_apts.xapt_xname AS x_xname, xray_apts.xapt_pname AS x_pname, xray_apts.xapt_phone AS x_phone, doctors.doc_name AS x_doc  FROM xray_apts INNER JOIN doctors ON xray_apts.xapt_doc=doctors.doc_id WHERE xray_apts.xapt_status=1 ORDER BY xray_apts.xapt_id DESC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $count=1;
                                        while($row = $result->fetch_assoc()):
                                        $x_id = $row['x_id'];
                                        ?>
                                        <tr>
                                        <td scope="row"><?php echo $count; ?></td>
                                        <td><?php echo $row['x_pname']; ?></td>
                                        <td><?php echo $row['x_token'];?></td>
                                        <td><?php echo $row['x_xname'];?></td>
                                        <td><?php echo $row['x_phone']; ?></td>
                                        <td><?php echo $row['x_doc']; ?></td>
                                        <?php
                                        /*
                                        <td>
                                            <a href="update-appointment.php?id=<?php echo $x_id;?>" class="btn btn-warning">Edit</a>
                                            <a href="del-appointment.php?id=<?php echo $x_id;?>" class="btn btn-danger">Cancel</a>
                                        </td>
                                        */?>
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