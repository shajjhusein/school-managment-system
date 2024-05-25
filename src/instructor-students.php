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
    $students = $databaseService->fetchStudentsForCourse($course_id);
    $quizzes = $databaseService->fetchQuizzesForCourse($course_id);
} else {
    $course_id = 0; // Set a default value for course_id
    $class_id = 0; // Set a default value for class_id
    $students = []; // Initialize students as an empty array
    $quizzes = []; // Initialize quizzes as an empty array

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Manage Students";
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

        #add_quiz_form_container {
            display: none;
        }
    </style>

</head>

<?php include 'partials/body.php'; ?>
<script>
    function fetchStudentQuizzes(userId) {
        fetch(`manage_data.php?fetch_user_quiz_grades=${userId}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('student_quizzes_table_body');
                tableBody.innerHTML = ''; // Clear existing rows

                data.forEach(quiz => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${quiz.quiz_id}</td>
                    <td>${quiz.quiz_content}</td>
                    <td>${quiz.grade}</td>
                `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.log('Error fetching student quizzes:', error);
                alert('Failed to fetch student quizzes. Please try again.');
            });
    }

    function handleAddQuizGrade() {
        // Gather data for the new quiz
        const quiz_id = document.getElementById('quiz_id').value;
        const user_id = document.getElementById('user_id').value;
        const grade = document.getElementById('grade').value;

        // Validate inputs
        if (!quiz_id || !user_id || !grade) {
            alert('Please fill all fields');
            return; // Exit the function if validation fails
        }

        // Create FormData object
        const formData = new FormData();
        formData.append('action', 'add_student_quiz');
        formData.append('quiz_id', quiz_id);
        formData.append('user_id', user_id);
        formData.append('grade', grade);

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
                console.log(data); // Log response to console

                // Reset form values on successful submission
                document.getElementById('quiz_id').value = '';
                document.getElementById('user_id').value = '';
                document.getElementById('grade').value = '';
                fetchStudentQuizzes(user_id); // Fetch student quizzes when showing the form
                alert('Quiz grade added successfully!');
            })
            .catch(error => {
                // Handle error
                console.log('Error:', error);
                alert('Failed to handleAddQuizGrade. Please try again.'); // Show error message
            });
    }

    function showAddQuizForm(userId) {
        // Get student name
        const studentNameElement = document.querySelector(`#student-${userId} td:nth-child(2)`);
        const studentName = studentNameElement ? studentNameElement.textContent : 'Unknown';

        // Set student name
        document.getElementById('student_name').textContent = studentName;

        document.getElementById('user_id').value = userId;
        document.getElementById('add_quiz_form_container').style.display = 'block';
        fetchStudentQuizzes(userId); // Fetch student quizzes when showing the form
    }
</script>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Manage students";
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>DBO</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentsTableBody">
                                        <?php foreach ($students as $student) : ?>
                                            <tr id="student-<?php echo $student['id']; ?>">
                                                <td><?php echo $student['id']; ?></td>
                                                <td><?php echo $student['name']; ?></td>
                                                <td><?php echo $student['email']; ?></td>
                                                <td><?php echo $student['date_of_birth']; ?></td>
                                                <td>
                                                    <button class="btn btn-success" onclick="showAddQuizForm(<?php echo $student['id']; ?>)">Manage Quizzes</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->
                <!-- Form row -->
                <div class="row" id="add_quiz_form_container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Student Quizzes for <span id="student_name"></span></h5>
                                    <table id="student_quizzes_table" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Quiz ID</th>
                                                <th>Quiz Content</th>
                                                <th>Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student_quizzes_table_body">
                                            <!-- Table rows will be populated here -->
                                        </tbody>
                                    </table>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="content" class="form-label">Quiz</label>
                                                <select id="quiz_id" name="quiz_id" class="form-select" required>
                                                    <option value="">Select a Quiz</option>
                                                    <?php foreach ($quizzes as $quiz) : ?>
                                                        <option value="<?php echo $quiz['id']; ?>"><?php echo $quiz['content']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="grade" class="form-label">Grade</label>
                                                <input type="text" class="form-control" id="grade" name="grade" placeholder="Grade" required value="<?php echo htmlspecialchars($current_class['section'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" id="user_id" name="user_id">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="handleAddQuizGrade()">
                                            Add Grade
                                        </button>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
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