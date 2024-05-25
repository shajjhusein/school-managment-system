<?php
include 'services/session.php';
require_once('./services/database.php');


// Redirect if user is not set or not logged in
if (!isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
}

// Attempt to get user ID from URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$current_user = null;

$databaseService = DatabaseService::getInstance();
$classes = $databaseService->getClasses();
$isMyAccount = ($user_id && $user_id == $_SESSION['user']['id']);
// Check if we are updating an existing user
if ($user_id) {
    $current_user = $databaseService->getUserById($user_id);
} else {
    $current_user = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Consider hashing the password
    $role = $_POST['role'];
    $date_of_birth = $_POST['date_of_birth'];
    $class = $_POST['class'];

    if ($user_id) {
        // Update existing user
        $success = $databaseService->updateUser($user_id, $name, $email, $password, $role, $date_of_birth, $class);
    } else {
        // Insert new user
        $success = $databaseService->addUser($name, $email, $password, $role, $date_of_birth, $class);
    }

    if ($success) {
        header('Location: users.php');
        exit();
    } else {
        echo "Error adding or updating user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Add/Edit User";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>
    <style>
        .disable-event {
            pointer-events: none;
        }

        .hide-action {
            display: none;
        }
    </style>
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

    <?php
    $pagetitle = $isMyAccount ? "My Account" : $user_id = null ? "Add User" : "Edit User";
    include 'partials/menu.php'; ?>

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

                                <form method="post" <?php echo $isMyAccount ? 'class="disable-event"' : ''; ?>>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="<?php echo htmlspecialchars($current_user['name'] ?? ''); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($current_user['email'] ?? ''); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required value="<?php echo htmlspecialchars($current_user['password'] ?? ''); ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_birth" class="form-label">Date Of Birthday</label>
                                            <input class="form-control" id="date_of_birth" type="date" name="date_of_birth" required value="<?php echo htmlspecialchars($current_user['date_of_birth'] ?? ''); ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select id="role" name="role" class="form-select" required value="<?php echo htmlspecialchars($current_user['role'] ?? ''); ?>">
                                                <option value="director" <?php echo (isset($current_user['role']) && $current_user['role'] == 'director') ? 'selected' : ''; ?>>Director</option>
                                                <option value="supervisor" <?php echo (isset($current_user['role']) && $current_user['role'] == "supervisor") ? 'selected' : ''; ?>>Supervisor</option>
                                                <option value="instructor" <?php echo (isset($current_user['role']) && $current_user['role'] == 'instructor') ? 'selected' : ''; ?>>Instructor</option>
                                                <option value="student" <?php echo (isset($current_user['role']) && $current_user['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3" id="class-container" style="display: none;">
                                            <label for="class" class="form-label">Class Name</label>
                                            <select id="class" name="class" class="form-select">
                                                <option value="">Please select a class</option>
                                                <?php foreach ($classes as $class) : ?>
                                                    <option <?php echo (isset($current_user['class_id']) &&  htmlspecialchars($class['id']) == htmlspecialchars($current_user['class_id'])) ? 'selected' : ''; ?> value="<?php echo htmlspecialchars($class['id']); ?>"><?php echo htmlspecialchars($class['name']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light <?php echo $isMyAccount ? 'hide-action' : ''; ?>">

                                        <?php echo $user_id ? 'Edit' : 'Add'; ?>
                                    </button>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

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