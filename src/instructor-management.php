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
    function loadInstructorCourses(classId, instructorId) {
        if (classId) {
            // AJAX call to fetch courses for a given class
            fetch('get_http_data.php?instructor_class_id=' + classId + '&instructor_id=' +
                    instructorId)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('coursesTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows

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
                        manageQuizButton.classList.add('btn', 'btn-success', 'edit-action');
                        manageQuizButton.onclick = function() {
                            // Redirect to add_new_quiz.php with course_id and instructor_id parameters
                            window.location.href = 'instructor-quizzes.php?course_id=' + course.id + '&class_id=' + classId;
                        };
                        const manageMaterialsButton = document.createElement('button');
                        manageMaterialsButton.textContent = 'Manage Materials';
                        manageMaterialsButton.classList.add('btn', 'btn-success', 'edit-action');
                        manageMaterialsButton.onclick = function() {

                            window.location.href = ' instructor-materials.php?course_id=' + course.id + '&class_id=' + classId;

                        };
                        const manageStudentsButton = document.createElement('button');
                        manageStudentsButton.textContent = 'Manage Students';
                        manageStudentsButton.classList.add('btn', 'btn-success', 'edit-action');
                        manageStudentsButton.onclick = function() {

                            window.location.href = ' instructor-students.php?course_id=' + course.id + '&class_id=' + classId;

                        };

                        cellAction.appendChild(manageQuizButton);
                        cellAction.appendChild(manageMaterialsButton);
                        cellAction.appendChild(manageStudentsButton);




                    });
                }).catch(error => console.error('Error loading courses:', error));
        } else {
            const tableBody = document.getElementById('coursesTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
        }
    }
    // Function to set the first option as selected if the list of classes is not empty
    function setFirstOptionSelected() {
        const classSelect = document.getElementById('class');
        if (classSelect.options.length > 0) {
            classSelect.selectedIndex = 0;
            const firstClassId = classSelect.options[1].value;
            loadInstructorCourses(firstClassId, <?php echo $instructor_id; ?>);
            classSelect.selectedIndex = 1; // Select the first option
        }
    }
    // Call the function when the page is loaded
    document.addEventListener('DOMContentLoaded', setFirstOptionSelected);
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
                <!-- end row -->
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