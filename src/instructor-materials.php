<?php
include 'services/session.php';
require_once('./services/database.php');

$databaseService = DatabaseService::getInstance();

// Redirect if user is not set or not logged in
if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}
$user = $_SESSION['user'];
$instructor_id = $_SESSION['user']["id"];

// Check if course_id and class_id are provided in the URL
if (isset($_GET['course_id']) && isset($_GET['class_id'])) {
    $course_id = $_GET['course_id'];
    $class_id = $_GET['class_id'];
    // Fetch quizzes for the specified class, course, and instructor
    $materials = $databaseService->fetchMaterialsForCourse($course_id);
} else {
    $course_id = 0; // Set a default value for course_id
    $class_id = 0; // Set a default value for class_id
    $materials = []; // Initialize quizzes as an empty array
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Manage Materials";
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
    <script>
        function handleDeleteMaterial(materialId) {
            // Ask for confirmation before deleting the quiz
            if (confirm("Are you sure you want to delete this material?")) {
                const formData = new FormData(); // Create form data object
                formData.append('action', 'delete_material'); // Set the action
                formData.append('material_id', materialId); // Set the quiz ID

                // Send POST request to delete quiz
                fetch('manage_data.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json(); // Parse response as JSON
                        }
                        throw new Error('Network response was not ok.');
                    })
                    .then(data => {
                        const row = document.getElementById(`material-${materialId}`);
                        if (row) {
                            row.remove();
                        }
                    })
                    .catch(error => {
                        // Handle error
                        console.error('Error:', error);
                        alert('Failed to delete material. Please try again.'); // Show error message
                    });
            }
        }

        function handleAddMaterial() {
            // Gather data for the new quiz
            const content = document.getElementById('content').value;
            const courseId = <?php echo json_encode($course_id); ?>; // Get the course_id from PHP
            // Create FormData object
            const formData = new FormData();
            formData.append('action', 'add_material');
            formData.append('content', content);
            formData.append('course_id', courseId);


            // Send POST request to add quiz
            fetch('manage_data.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json(); // Parse response as JSON
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    // Handle success response
                    debugger
                    console.log(data); // Log response to console
                    // Update the table to display the new quiz
                    const materialsTableBody = document.getElementById('materialsTableBody');
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.cate_posted || 'N/A'}</td>
                    <td>${content}</td>
                    <td>
                        <button class="btn btn-danger delete-btn" onclick="handleDeleteMaterial(${data.id})">Delete</button>
                    </td>
                `;
                    materialsTableBody.appendChild(newRow);

                    // Clear input fields
                    document.getElementById('dueDate').value = '';
                    document.getElementById('content').value = '';

                })
            // .catch(error => {
            //     // Handle error
            //     console.log('Error:', error);
            //     alert('Failed to add material. Please try again.'); // Show error message
            // });
        }
    </script>



</head>

<?php include 'partials/body.php'; ?>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Manage Materials";
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
                <!-- Form row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" id="add_quiz_form">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="handleAddMaterial()">
                                        Add Material
                                    </button>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Material</h4>
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Posted Date</th>
                                            <th>Content</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="materialsTableBody">
                                        <?php foreach ($materials as $material) : ?>
                                            <tr id="material-<?php echo $material['id']; ?>">
                                                <td><?php echo $material['id']; ?></td>
                                                <td><?php echo isset($material['cate_posted']) ? $material['cate_posted'] : 'N/A'; ?></td>
                                                <td><?php echo $material['content']; ?></td>
                                                <td>
                                                    <button class="btn btn-danger delete-btn" onclick="handleDeleteMaterial(<?php echo $material['id']; ?>)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->
                <!-- end row -->
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