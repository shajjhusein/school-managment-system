<?php
include 'services/session.php';
require_once('./services/database.php');

$databaseService = DatabaseService::getInstance();

// Redirect if user is not set or not logged in
if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}

// Fetch classes
$login_user_role = $_SESSION['user']["role"];
$classes = $databaseService->getClasses($_SESSION['user']);

// Handle class deletion request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_class_id'])) {
    $deleteId = $_POST['delete_class_id'];
    if ($databaseService->deleteClass($deleteId)) {
        header('Location: classes.php');  // Reload the page to reflect changes
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Manage Classes";
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

    <?php $pagetitle = "Manage Classes";
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

                <?php if ($login_user_role === 'director') : ?>
                    <div class="row add-new-action">
                        <button style="width: 200px;" type="button" class="btn btn-primary waves-effect waves-light" onclick="window.location.href='edit-class.php';">Add New</button>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Section</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($classes as $class) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($class['id']); ?></td>
                                                <td><?php echo htmlspecialchars($class['name']); ?></td>
                                                <td><?php echo htmlspecialchars($class['section']); ?></td>
                                                <td class="user-actions">
                                                    <?php if ($login_user_role === 'director') : ?>
                                                        <a href="edit-class.php?id=<?php echo urlencode($class['id']); ?>" class="btn btn-success edit-action">Edit</a>
                                                        <form method="POST" action="classes.php" class="edit-action">
                                                            <input type="hidden" name="delete_class_id" value="<?php echo $class['id']; ?>">
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this class?');">Delete</button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <a href="manage-course-assignments.php?class_id=<?php echo urlencode($class['id']); ?>" class="btn btn-info edit-action">Manage Courses</a>
                                                    <?php if ($login_user_role === 'director' || $login_user_role === 'supervisor') : ?>
                                                        <a href="manage-schedule.php?id=<?php echo urlencode($class['id']); ?>" class="btn btn-info">Manage Schedule</a>
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