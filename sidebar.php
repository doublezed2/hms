        <ul class="navbar-nav ali-sidebar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3"> <img src="img/ali-hospital-sm.jpg" width="115px" alt="logo"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <p class="text-white p-3 m-0">User: <?php echo $_SESSION['shift_user_name'];?>
            <br>
            Shift: <?php echo $_SESSION['shift_type'];?></p>
            <hr class="sidebar-divider my-0">
            <?php
            if($_SESSION["user_type"] != 'admin_user'):
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="opd.php">
                <i class="fas fa-calendar-plus"></i>
                    <span>OPD</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="xray-token.php">
                <i class="fas fa-radiation"></i>
                    <span>Radiology</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="print-shift-reports.php">
                <i class="fas fa-calendar-plus"></i>
                    <span>Print Shift Reports</span>
                </a>
            </li>
            <?php
            endif;
            ?>
            <?php
            if($_SESSION["user_type"] == "admin_user"):?>
            <li class="nav-item active">
                <a class="nav-link" href="view-doctors.php">
                <i class="fas fa-align-justify"></i>
                    <span>Doctors</span></a>
            </li>
            <?php    
            endif;
            ?>
            <?php
            if($_SESSION["user_type"] == "admin_user"):?>
            <li class="nav-item active">
                <a class="nav-link" href="view-xrays.php">
                <i class="fas fa-align-justify"></i>
                    <span>X-Rays</span></a>
            </li>
            <?php    
            endif;
            ?>
            <?php
            if($_SESSION["user_type"] == "admin_user"):?>
            <li class="nav-item active">
                <a class="nav-link" href="view-appointments-all.php">
                <i class="fas fa-align-justify"></i>
                    <span>View Appointments</span></a>
            </li>
            <?php    
            endif;
            ?>
            <?php
            if($_SESSION["user_type"] == "admin_user"):?>
            <li class="nav-item active">
                <a class="nav-link" href="view-xapts-all.php">
                <i class="fas fa-align-justify"></i>
                    <span>View X-Rays</span></a>
            </li>
            <?php    
            endif;
            ?>
            <?php 
            if(isset($_SESSION["shift_id"]) && $_SESSION["shift_type"] !="Admin" ):?>
            <li class="nav-item active">
                <a class="nav-link" href="close-shift.php">
                <i class="fas fa-directions"></i>
                    <span>Close Shift</span></a>
            </li>
            <?php    
            else:
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">
                <i class="fas fa-directions"></i>
                    <span>Logout</span></a>
            </li>
            <?php    
            endif;
            ?>            
        </ul>