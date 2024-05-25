<?php
include 'services/session.php';
require_once('./services/database.php');

// Initialize the database service
$databaseService = DatabaseService::getInstance();

// Redirect if user is not set or not logged in
if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}

// Assuming $_SESSION['user'] is properly set from login
$user = $_SESSION['user'];
$login_user_role = $_SESSION['user']["role"];
$users = $databaseService->getUsers($user['role']);

// Handle deletion request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    echo "<script>console.log('Debug Info: Attempting to delete user with ID = $deleteId');</script>";

    // Call deleteUser method from DatabaseService
    $is_deleted = $databaseService->deleteUser($deleteId);
    if ($is_deleted) {
        echo "<script>console.log('Debug Info: User deleted successfully');</script>";
        header('Location: users.php');
        exit();
    } else {
        echo "<script>console.log('Debug Info: Failed to delete user');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Users";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>
    <style>
        .user-actions {
            display: flex;
            flex-direction: row;
        }

        .edit-action {
            margin-right: 5px;
        }

        .add-new-action {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            padding: 10px;
        }
    </style>
</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Users";
    include 'partials/menu.php'; ?>
    <!-- third party css -->
    <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row add-new-action">
                    <button style="width: 200px;" type="button" class="btn btn-primary waves-effect waves-light" onclick="window.location.href='edit-user.php';">Add New</button>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Class</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                                <td><?php echo htmlspecialchars($user['password']); ?></td>
                                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                                <td><?php echo htmlspecialchars($user['class_name'] ?? ''); ?></td>
                                                <td class="user-actions">
                                                    <a href="edit-user.php?id=<?php echo urlencode($user['id']); ?>" class="btn btn-success edit-action">Edit</a>
                                                    <form method="POST" action="users.php" class="edit-action">
                                                        <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                                    </form>
                                                    <?php if ($user['role'] === 'instructor' && $login_user_role === 'director') : ?>
                                                        <a href="manage-instructor.php?id=<?php echo urlencode($user['id']); ?>" class="btn btn-info">Manage Instructor</a>
                                                    <?php endif; ?>
                                                    <?php if ($user['role'] === 'supervisor' && $login_user_role === 'director') : ?>
                                                        <a href="manage-supervisor.php?id=<?php echo urlencode($user['id']); ?>" class="btn btn-info">Manage Supervisor</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->


            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <?php include 'partials/footer.php'; ?>

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php include 'partials/right-sidebar.php'; ?>

<?php include 'partials/footer-scripts.php'; ?>

<!-- third party js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="assets/js/pages/datatables.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>