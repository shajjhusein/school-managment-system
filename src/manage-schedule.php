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
$class_id = $_GET['id'] ?? null;  // Get class ID from query parameters
$class = $databaseService->getClassById($class_id);  // Assume this method fetches all classes from your database
$classe_name = $class["name"];  // Assume this method fetches all classes from your database


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Manage Schedule";
    include 'partials/title-meta.php'; ?>
    <!-- Plugin css -->
    <link href="assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />
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
    // Initialize the calendar with external event dat

    document.addEventListener('DOMContentLoaded', function() {
        // Automatically load the schedule when the page loads
        updateScheduleTable(<?php echo $class_id; ?>);

    });

    function generateSchedule(classId) {
        if (!classId) {
            alert('No class ID provided.');
            return;
        }

        fetch(`get_courses.php?generate_schedule_class_id=${classId}`)
            .then(data => {
                updateScheduleTable(classId);
                // Process the data here, e.g., display it in a table or process further
                // displayCourses(data);
            })
            .catch(error => {
                // Create a JSON object containing the error details
                const errorInfo = {
                    message: error.message,
                    stack: error.stack,
                    name: error.name
                };

                // Convert the error information to a JSON string
                const errorJson = JSON.stringify(errorInfo);

                // Log the JSON string
                console.log('Error fetching courses:', errorJson);
                alert('Failed to fetch courses.');
            });
    }

    function updateScheduleTable(classId) {
        if (!classId) {
            alert('Class ID is required.');
            return;
        }

        fetch(`get_courses.php?generate_schedule_class_id_details=${classId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data)
                const schedule = data;
                window.jQuery.CalendarApp.init(schedule);
            })
            .catch(error => {
                console.error('Error fetching schedule:', error);
                alert('Failed to fetch schedule: ' + error.message);
            });
    }
</script>
<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle =  "Manage Schedule For Class Name : " . htmlspecialchars($classe_name);
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
                    <button style="width: 200px;" type="button" class="btn btn-primary waves-effect waves-light" onclick="generateSchedule(<?php echo $class_id; ?>);">Generate Schedule</button>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-3" style="display: none;">
                                <button class="btn btn-lg font-16 btn-success w-100" id="btn-new-event"><i class="fa fa-plus me-1"></i> Create New</button>

                                <div id="external-events">

                                </div>

                            </div> <!-- end col-->

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div id="calendar"></div>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                        </div> <!-- end row -->


                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <h5 class="modal-title" id="modal-title">Event</h5>
                                    </div>
                                    <div class="modal-body px-4 pb-4 pt-0">
                                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Event Name</label>
                                                        <input class="form-control" placeholder="Insert Event Name" type="text" name="title" id="event-title" required />
                                                        <div class="invalid-feedback">Please provide a valid event name</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select class="form-select" name="category" id="event-category" required>
                                                            <option value="bg-danger" selected>Danger</option>
                                                            <option value="bg-success">Success</option>
                                                            <option value="bg-primary">Primary</option>
                                                            <option value="bg-info">Info</option>
                                                            <option value="bg-dark">Dark</option>
                                                            <option value="bg-warning">Warning</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid event category</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6 col-4">
                                                    <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                                </div>
                                                <div class="col-md-6 col-8 text-end">
                                                    <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end modal-content-->
                            </div> <!-- end modal dialog-->
                        </div>
                        <!-- end modal-->
                    </div>
                    <!-- end col-12 -->
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


<!-- plugin js -->
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/fullcalendar/main.min.js"></script>

<!-- Calendar init -->
<script src="assets/js/pages/calendar.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>