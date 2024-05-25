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

$class_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$current_class = null;

// Check if we are updating an existing class
if ($class_id) {
    $current_class = $databaseService->getClassById($class_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $section = $_POST['section'];

    if ($class_id) {
        // Update existing class
        $success = $databaseService->updateClass($class_id, $name, $section);
    } else {
        // Insert new class
        $success = $databaseService->addClass($name, $section);
    }

    if ($success) {
        header('Location: classes.php');
        exit();
    } else {
        echo "Error adding or updating class.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Add/Edit User";
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
                            <label for="name" class="form-label">Class Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Class Name" required value="<?php echo htmlspecialchars($current_class['name'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="section" class="form-label">Section</label>
                            <input type="text" class="form-control" id="section" name="section" placeholder="Section" required value="<?php echo htmlspecialchars($current_class['section'] ?? ''); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <?php echo $class_id ? 'Edit' : 'Add'; ?> Class
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