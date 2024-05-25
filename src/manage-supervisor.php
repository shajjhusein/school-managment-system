<?php
include 'services/session.php';
require_once('./services/database.php');

$databaseService = DatabaseService::getInstance();
$classes = $databaseService->getClasses();  // Assume this method fetches all classes from your database

// Check if a specific instructor is set
$supervisor_id = $_GET['id'] ?? null;  // Get instructor ID from query parameters

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assign_class'])) {
    // Process course assignment to instructor here
    $selectedClassId = $_POST['class_id'];
    $result = $databaseService->assignClassToSupervisor($supervisor_id, $selectedClassId);
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
    function loadSupervisorClasses(supervisor_id) {
        if (supervisor_id) {
            // AJAX call to fetch courses for a given class
            fetch('manage_data.php?get_supervisor_classes_by_id=' + supervisor_id)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('classesTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(_class => {
                        const row = tableBody.insertRow();
                        row.id = `supervisor_class-${_class.supervisor_class_id}`
                        const cellId = row.insertCell(0);
                        const cellName = row.insertCell(1);
                        const cellSection = row.insertCell(2);
                        const cellActions = row.insertCell(3);


                        cellId.textContent = _class.id;
                        cellName.textContent = _class.name;
                        cellSection.textContent = _class.section;

                        // Create a button element
                        const deleteButton = document.createElement('button');
                        // Set button attributes
                        deleteButton.setAttribute('class', 'btn btn-danger delete-btn');
                        deleteButton.setAttribute('onclick', `handleDeleteClass(${_class.supervisor_class_id})`);
                        deleteButton.textContent = 'Delete';
                        cellActions.appendChild(deleteButton);

                    });
                }).catch(error => console.error('Error loading courses:', error));
        } else {
            const tableBody = document.getElementById('classesTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
        }
    }
    // Call the function on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Get the supervisor ID from the query parameter or any other source
        var supervisorId = <?php echo json_encode($supervisor_id); ?>;

        // Call the function to load supervisor classes
        loadSupervisorClasses(supervisorId);
    });

    function handleDeleteClass(id) {
        // Ask for confirmation before deleting the quiz
        if (confirm("Are you sure you want to delete this class?")) {
            const formData = new FormData(); // Create form data object
            formData.append('action', 'delete_supervisor_class'); // Set the action
            formData.append('id', id);

            // Send POST request to delete class
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
                    const row = document.getElementById(`supervisor_class-${id}`);
                    if (row) {
                        row.remove();
                    }
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                    alert('Failed to delete quiz. Please try again.'); // Show error message
                });
        }
    }
</script>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Manage Supervisor";
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
                                <h4 class="mt-0 header-title">Manage Supervisor Classes</h4>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="role" class="form-label">Class</label>
                                            <select id="class" name="class_id" class="form-select" required>
                                                <option value="">Select a Class</option>
                                                <?php foreach ($classes as $class) : ?>
                                                    <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" name="assign_class" class="btn btn-primary waves-effect waves-light">
                                        Assign Class
                                    </button>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Classes</h4>
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Section</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody id="classesTableBody">

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