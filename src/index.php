<?php include 'services/session.php';
require_once('./services/database.php');

if (!$_SESSION['user'] || !isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
$databaseService = DatabaseService::getInstance();
// Fetch user's classes from the database
// Assuming you have a method to fetch user's classes from the database
$userClass = $databaseService->getUserClassNameByUserId($user['id']);

// Fetch user's courses from the database
// Assuming you have a method to fetch user's courses from the database
$userCourses = $databaseService->fetchUserCourses($user['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Dashboard";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>
    <!-- Plugin css -->
    <link href="assets/libs/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">


    <?php $pagetitle = "Dashboard";
    include 'partials/menu.php';  ?>


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="card col-xl-4">
                        <img class="card-img-top img-fluid" src="assets/images/gallery/9.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"> <?php echo htmlspecialchars($user['name']); ?></h4>
                            <p class="card-text">Your Class Name: <?php echo htmlspecialchars($userClass); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>

                                <h4 class="header-title mt-0 mb-3">Courses</h4>

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($userCourses as $course) : ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($course['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($course['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($course['description']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div><!-- end col -->

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="card col-12">
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

<!-- knob plugin -->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>

<!--Morris Chart-->
<script src="assets/libs/morris.js06/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<!-- Dashboar init js-->
<script src="assets/js/pages/dashboard.init.js"></script>


<!-- plugin js -->
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/fullcalendar/main.min.js"></script>

<!-- Calendar init -->
<script src="assets/js/pages/calendar.init.js"></script>

<!-- App js-->
<script src="assets/js/app.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('sadek')
        fetch(`get_http_data.php?generate_schedule_for_student=${<?php echo $user['id']; ?>}`)
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

    });
</script>
</body>

</html>