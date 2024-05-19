<?php
// Include session and database files
include 'services/session.php';
require_once('./services/database.php');

// Initialize database service
$databaseService = DatabaseService::getInstance();

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}

// Fetch user data
$user = $_SESSION['user'];
$instructor_id = $_SESSION['user']["id"];

// // Check if course_id is provided in the URL
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Fetch materials for the specified course
    $materials = $databaseService->fetchMaterialsForCourse($course_id);
} else {
    // Course_id not provided in the URL
    // $materials = $databaseService->fetchMaterialsForCourse(3);

}
// Handle form submission to add new materials
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_material'])) {
    $content = $_POST['content'];
    $course_id = $_POST['course_id'];
    // Call the addMaterial method to add the material
    $result = $databaseService->addMaterial($content, $course_id);
    if ($result) {
        // Material added successfully
        echo "Material added successfully.";
        $materials = $databaseService->fetchMaterialsForCourse($course_id);
    } else {
        // Material addition failed
        echo "Failed to add material.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Manage Quizes";
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
            justify-content: flex-start;
            padding: 10px;
        }
    </style>
</head>

<?php include 'partials/body.php'; ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add_material_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = new FormData(this);
            // Add the 'add_quiz' parameter to the form data
            formData.append('add_material', true);
            // Send form data via AJAX
            fetch('instructor-materials.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    debugger
                    // Display response message
                    console.log(data); // Log response to console
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to add quiz. Please try again.'); // Show error message
                });
        });
    });
</script>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Manage Quizes";
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" id="add_material_form">
                                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="add_material">Add Material</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Materials</h4>
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Posted Date</th>
                                            <th>Content</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="materialTableBody">
                                        <?php foreach ($materials as $material) : ?>
                                            <tr>
                                                <td><?php echo $material['id']; ?></td>
                                                <td><?php echo isset($material['cate_posted']) ? $material['cate_posted'] : 'N/A'; ?></td>
                                                <td><?php echo $material['content']; ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm">Edit</button>
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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