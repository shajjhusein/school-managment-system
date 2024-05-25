<?php
include 'services/session.php';
require_once('./services/database.php');

$databaseService = DatabaseService::getInstance();

if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}

$course_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$current_course = null;

if ($course_id) {
    $current_course = $databaseService->getCourseById($course_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description']; // Changed from 'section' to 'description'

    if ($course_id) {
        // Update existing course
        $success = $databaseService->updateCourse($course_id, $name, $description);
    } else {
        // Insert new course
        $success = $databaseService->addCourse($name, $description);
    }

    if ($success) {
        header('Location: courses.php');
        exit();
    } else {
        echo "Error adding or updating course.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Add/Edit Class";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var roleSelect = document.getElementById('role');
        var classContainer = document.getElementById('class-container');

        function toggleClassSelect() {
            // Display the class select box only if the selected role is 'student'
            classContainer.style.display = roleSelect.value === 'student' ? 'block' : 'none';
        }

        // Call toggleClassSelect on role change
        roleSelect.addEventListener('change', toggleClassSelect);

        // Also call toggleClassSelect initially in case the student is selected by default
        toggleClassSelect();
    });
</script>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Add Class";
    include 'partials/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->

            <div class="container-fluid">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Course Name" required value="<?php echo htmlspecialchars($current_course['name'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" required value="<?php echo htmlspecialchars($current_course['description'] ?? ''); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <?php echo $course_id ? 'Edit' : 'Add'; ?> Course
                    </button>
                </form>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <?php include 'partials/footer.php'; ?>

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->



<?php include 'partials/footer-scripts.php'; ?>

<!-- App js-->
<script src="assets/js/app.min.js"></script>

</body>

</html>