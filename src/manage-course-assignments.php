<?php
include 'services/session.php';
require_once('./services/database.php');

$databaseService = DatabaseService::getInstance();

if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}
$allCourses = $databaseService->getCourses();  // Fetch all courses
$class_id = $_GET['class_id'] ?? null;
if (!$class_id) {
    header('Location: classes.php'); // Redirect if no class ID is provided
    exit();
}

// Fetch courses assigned to the class
$assignedCourses = $databaseService->getAssignedCourses($class_id);

// Handle course removal from class
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_course_id'])) {
    $courseId = $_POST['remove_course_id'];
    if ($databaseService->removeCourseFromClass($courseId, $class_id)) {
        header("Location: manage-course-assignments.php?class_id=$class_id"); // Refresh the page on success
        exit();
    } else {
        $error = "Failed to remove the course.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_course'])) {
    $selectedCourseId = $_POST['class'];
    // Add selected course to class
    if ($databaseService->assignCourseToClass($selectedCourseId, $class_id)) {
        // Fetch updated list of courses after addition
        $assignedCourses = $databaseService->getAssignedCourses($class_id);
    } else {
        $error = "Failed to add course.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Manage Classe Courses";
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
<script>
    function toggleAddCourseForm() {
        var form = document.getElementById('add-course-form');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Manage Classe Courses";
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
                    <button style="width: 200px;" type="button" class="btn btn-primary waves-effect waves-light" onclick="toggleAddCourseForm()">Add Course</button>
                </div>
                <div class="row" id="add-course-form" style="display: none;">
                    <?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
                    <form method="post" action="">
                        <div class="col-md-6 mb-3">
                            <label for="class" class="form-label">Courses</label>
                            <select id="class" name="class" class="form-select">
                                <option value="">Please select a course</option>
                                <?php foreach ($allCourses as $course) : ?>
                                    <option value="<?php echo htmlspecialchars($course['id']); ?>"><?php echo htmlspecialchars($course['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="submit" name="add_course" class="btn btn-primary waves-effect waves-light">Add Course</button>

                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Course ID</th>
                                            <th>Course Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assignedCourses as $course) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($course['id']); ?></td>
                                                <td><?php echo htmlspecialchars($course['name']); ?></td>
                                                <td><?php echo htmlspecialchars($course['description']); ?></td>
                                                <td>
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="remove_course_id" value="<?php echo htmlspecialchars($course['id']); ?>">
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>
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