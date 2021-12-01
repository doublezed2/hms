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
                            <h3>View Appointments</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Token</th>
                                            <th>Phone</th>
                                            <th>Doctor</th>
                                            <th>Date</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include("db.php");
                                    $sql = "SELECT appointments.pat_id AS p_id, appointments.pat_token AS p_token, appointments.pat_name AS p_name, appointments.pat_phone AS p_phone, appointments.pat_apt_time AS p_time, doctors.doc_name AS p_doc  FROM appointments INNER JOIN doctors ON appointments.pat_doctor=doctors.doc_id WHERE appointments.pat_shift=".$_SESSION['shift_id']." ORDER BY appointments.pat_created_on DESC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $count=1;
                                        while($row = $result->fetch_assoc()):
                                        $pat_id = $row['p_id'];
                                        ?>
                                        <tr>
                                        <td scope="row"><?php echo $count; ?></td>
                                        <td><?php echo $row['p_name'];?></td>
                                        <td><?php echo $row['p_token']; ?></td>
                                        <td><?php echo $row['p_phone']; ?></td>
                                        <td><?php echo $row['p_doc']; ?></td>
                                        <td>
                                        <?php
                                            $date = $row['p_time'];
                                            $dt = new DateTime($date);
                                            echo $dt->format('d-m-Y'); 
                                        ?>
                                        </td>
                                        <?php
                                        /*
                                        <td>
                                            <a href="update-appointment.php?id=<?php echo $pat_id;?>" class="btn btn-warning">Edit</a>
                                            <a href="del-appointment.php?id=<?php echo $pat_id;?>" class="btn btn-danger">Cancel</a>
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