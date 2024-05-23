<?php
if (!$_SESSION['user'] || !isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">

            <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name  h5 mt-2 mb-1 d-block" aria-expanded="false">
                    <?php echo htmlspecialchars($user['name']); ?>
                </a>
            </div>

            <p class="text-muted left-user-info"> <?php echo htmlspecialchars($user['role']); ?></p>

            <ul class="list-inline">

                <li class="list-inline-item">
                    <a href="auth-logout.php">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <!-- Check user role and display menu items accordingly -->
                <?php if ($user['role'] == 'director' || $user['role'] == 'supervisor') : ?>
                    <li>
                        <a href="users.php">
                            <i class="mdi mdi-calendar-blank-outline"></i>
                            <span> Users </span>
                        </a>
                    </li>
                    <li>
                        <a href="classes.php">
                            <i class="mdi mdi-calendar-blank-outline"></i>
                            <span> Classes </span>
                        </a>
                    </li>
                    <li>
                        <a href="courses.php">
                            <i class="mdi mdi-calendar-blank-outline"></i>
                            <span> Courses </span>
                        </a>
                    </li>
                <?php elseif ($user['role'] == 'instructor') : ?>
                    <li>
                        <a href="instructor-management.php">
                            <i class="mdi mdi-calendar-blank-outline"></i>
                            <span> Instructor Management </span>
                        </a>
                    </li>
                <?php elseif ($user['role'] == 'student') : ?>
                    <li>
                        <a href="index.php">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="badge bg-success rounded-pill float-end">9+</span>
                            <span> Dashboard </span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->