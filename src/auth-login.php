<?php include 'services/session.php'; ?>
<?php
$_SESSION['error'] = null;
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strlen($email) == 0) {
        $_SESSION['error'] =  "Please enter a email";
        $_POST['email'] = null;
        $_POST['password'] = null;
    } else {
        if (checkAuth($email, $password) === true) {
            header('Location: index.php');
            die();
        } else {
            $_SESSION['error'] = "Email or Password is not valid";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Log In";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages my-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <a href="index.php">
                            <!-- <img src="assets/images/logo-dark.png" alt="" height="22" class="mx-auto"> -->
                        </a>
                        <p class="text-muted mt-2 mb-4">School Managment System</p>

                    </div>
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>

                            <form method="POST">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="emailaddress" placeholder="Enter your email" name="email" value="<?php echo ($_POST['email']) ?? "" ?>">
                                    <span class="text-danger"><?php echo $_SESSION['error'] ?></span>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" value="<?php echo ($_POST['password']) ?? "" ?>">
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <?php include 'partials/footer-scripts.php'; ?>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>