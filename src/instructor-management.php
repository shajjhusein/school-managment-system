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
$classes = $databaseService->getInstructorClassesByUserId($instructor_id);  // Assume this method fetches all classes from your database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assign_course'])) {
    // Process course assignment to instructor here
    $selectedClassId = $_POST['class_id'];
    $selectedCourseId = $_POST['course_id'];
    $result = $databaseService->assignCourseToInstructor($instructor_id, $selectedCourseId, $selectedClassId);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_quiz'])) {
    // Process adding a new quiz here
    $dueDate = $_POST['dueDate'];
    $content = $_POST['content'];
    $courseId = $_POST['course'];

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

    <?php $title = "Manage Instructor";
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
    let coursesData = [];

    function loadCourses(classId) {
        if (classId) {
            // AJAX call to fetch courses for a given class
            fetch('get_http_data.php?class_id=' + classId)
                .then(response => response.json())
                .then(data => {
                    let courseSelect = document.getElementById('course');
                    courseSelect.innerHTML = '<option value="">Select a Course</option>'; // Reset dropdown
                    data.forEach(function(course) {
                        let option = new Option(course.name, course.id);
                        courseSelect.add(option);
                    });
                }).catch(error => console.error('Error loading courses:', error));
        }
    }

    function loadInstructorCourses(classId, instructorId) {
        if (classId) {
            // AJAX call to fetch courses for a given class
            fetch('get_http_data.php?instructor_class_id=' + classId + '&instructor_id=' +
                    instructorId)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('coursesTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows
                    const courseDropdown = document.getElementById('course');
                    courseDropdown.innerHTML = '<option value="">Select a Course</option>'; // Reset dropdown
                    data.forEach(course => {
                        const row = tableBody.insertRow();
                        const cellId = row.insertCell(0);
                        const cellName = row.insertCell(1);
                        const cellAction = row.insertCell(2);
                        cellId.textContent = course.id;
                        cellName.textContent = course.name;
                        // Add button for managing quizzes
                        const manageQuizButton = document.createElement('button');
                        manageQuizButton.textContent = 'Manage Quiz';
                        manageQuizButton.classList.add('btn', 'btn-success');
                        manageQuizButton.onclick = function() {
                            // Implement logic to manage quizzes
                            fetchQuizzesForCourse(course.id);
                        };

                        cellAction.appendChild(manageQuizButton);
                        // Add option to the course dropdown
                        const option = document.createElement('option');
                        option.value = course.id;
                        option.textContent = course.name;
                        courseDropdown.appendChild(option);
                    });
                }).catch(error => console.error('Error loading courses:', error));
        } else {
            const tableBody = document.getElementById('coursesTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
        }
    }


    function fetchQuizzesForCourse(courseId) {
        // AJAX call to fetch quizzes for the selected course
        fetch('get_http_data.php?course_id_quiz=' + courseId)
            .then(response => response.json())
            .then(data => {
                // Display quizzes in a table
                const quizTableBody = document.getElementById('quizTableBody');
                quizTableBody.innerHTML = ''; // Clear existing rows

                data.forEach(quiz => {
                    const row = quizTableBody.insertRow();
                    const cellId = row.insertCell(0);
                    const cellDatePosted = row.insertCell(1);
                    const cellDueDate = row.insertCell(2);
                    const cellContent = row.insertCell(3);
                    const cellActions = row.insertCell(4);

                    cellId.textContent = quiz.id;
                    cellDatePosted.textContent = quiz.date_posted;
                    cellDueDate.textContent = quiz.due_date;
                    cellContent.textContent = quiz.content;

                    // Add action buttons for editing and deleting quizzes

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
                    // Add click event listener for deleting quiz
                    deleteButton.onclick = function() {
                        deleteQuiz(quiz.id);
                    };

                    cellActions.appendChild(deleteButton);
                });
            })
            .catch(error => console.error('Error fetching quizzes:', error));
    }



    function loadInstructorStudentsByClass(classId, instructorId) {
        if (classId) {
            // AJAX call to fetch courses for a given class
            fetch('get_http_data.php?instructor_student_class_id=' + classId + '&instructor_id=' +
                    instructorId)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('studentsTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(course => {
                        const row = tableBody.insertRow();
                        const cellId = row.insertCell(0);
                        const cellName = row.insertCell(1);
                        const cellEmail = row.insertCell(2);
                        cellId.textContent = course.id;
                        cellName.textContent = course.name;
                        cellEmail.textContent = course.email
                    });
                }).catch(error => console.error('Error loading student:', error));
            fetch('get_http_data.php?class_id=' + classId)
                .then(response => response.json())
                .then(data => {
                    let courseSelect = document.getElementById('student_course');
                    courseSelect.innerHTML = '<option value="">Select a Course</option>'; // Reset dropdown
                    data.forEach(function(course) {
                        let option = new Option(course.name, course.id);
                        courseSelect.add(option);
                    });
                }).catch(error => console.error('Error loading courses:', error));
        } else {
            const tableBody = document.getElementById('studentsTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
        }
    }

    function loadInstructorStudentsByClassByCourse(courseId, instructorId) {
        if (courseId) {
            // AJAX call to fetch courses for a given class
            var selectElement = document.getElementById('class_id_to_get');
            var selectedValue = selectElement.value;
            fetch('get_http_data.php?instructor_student_class_course_id=' + courseId + '&instructor_student_class_class_id=' +
                    selectedValue + '&instructor_id=' +
                    instructorId)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('studentsTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows


                    data.forEach(course => {
                        const row = tableBody.insertRow();
                        const cellId = row.insertCell(0);
                        const cellName = row.insertCell(1);
                        const cellEmail = row.insertCell(2);
                        cellId.textContent = course.id;
                        cellName.textContent = course.name;
                        cellEmail.textContent = course.email

                    });
                }).catch(error => console.error('Error loading student:', error));
        } else {
            const tableBody = document.getElementById('studentsTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add_quiz_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = new FormData(this);
            // Add the 'add_quiz' parameter to the form data
            formData.append('add_quiz', true);
            // Send form data via AJAX
            fetch('instructor-management.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    debugger
                    // Display response message
                    console.log(data); // Log response to console
                    fetchQuizzesForCourse(formData.get('course'))
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

    <?php $pagetitle = "Manage Instructor";
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
                                <h4 class="mt-0 header-title">Class Name</h4>
                                <p class="text-muted font-14 mb-3">
                                    <select id="class" name="class_id" style="max-width: 300px;" class="form-select" required onchange="loadInstructorCourses(this.value,<?php echo $instructor_id; ?>);">
                                        <option value="">Select a Class</option>
                                        <?php foreach ($classes as $class) : ?>
                                            <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="coursesTableBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->
                <!-- Form row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" id="add_quiz_form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="course" class="form-label">Course</label>
                                            <select id="course" name="course" class="form-select" required>

                                            </select>
                                        </div>
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