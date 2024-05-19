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
    $quizzes = $databaseService->fetchQuizzesForCourse($course_id);
} else {
    // Course_id and class_id not provided in the URL
    echo json_encode(array('error' => 'Course_id and class_id are required parameters.'));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_quiz'])) {
    // Process adding a new quiz here
    $dueDate = $_POST['dueDate'];
    $content = $_POST['content'];
    $courseId = $_GET['course_id'];

    // Call the addQuiz method to add the quiz
    $result = $databaseService->addQuiz($dueDate, $content, $courseId);

    if ($result) {
        // Quiz added successfully
        echo "Quiz added successfully.";
    } else {
        // Quiz addition failed
        echo "Failed to add quiz.";
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
        document.getElementById('add_quiz_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = new FormData(this);
            // Add the 'add_quiz' parameter to the form data
            formData.append('add_quiz', true);
            // Send form data via AJAX
            fetch('instructor-quizzes.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    debugger
                    // Display response message
                    console.log(data); // Log response to console
                    // fetchQuizzesForCourse(formData.get('course'))
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

            <!-- Start Content-->
            <div class="container-fluid">
                <!-- Form row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" id="add_quiz_form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="dueDate" class="form-label">Due Date</label>
                                            <input type="date" class="form-control" id="dueDate" name="dueDate" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Add Quiz
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
                                <h4 class="mt-0 header-title">Quizzes</h4>
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Posted Date</th>
                                            <th>Due Date</th>
                                            <th>Content</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="quizTableBody">
                                        <?php foreach ($quizzes as $quiz) : ?>
                                            <tr>
                                                <td><?php echo $quiz['id']; ?></td>
                                                <td><?php echo isset($quiz['date_posted']) ? $quiz['date_posted'] : 'N/A'; ?></td>
                                                <td><?php echo $quiz['due_date']; ?></td>
                                                <td><?php echo $quiz['content']; ?></td>
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