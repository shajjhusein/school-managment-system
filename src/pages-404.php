<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Error Page | 404 | Page not Found";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo-dark.png" alt="" height="22" class="logo-light mx-auto">
                        </a>
                        <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p>
                    </div>
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center">
                                <h1 class="text-error">404</h1>
                                <h3 class="mt-3 mb-2">Page not Found</h3>
                                <p class="text-muted mb-3">It's looking like you may have taken a wrong turn. Don't
                                    worry... it happens to
                                    the best of us. You might want to check your internet connection. Here's a little
                                    tip that might
                                    help you get back on track.</p>

                                <a href="index.php" class="btn btn-danger waves-effect waves-light"><i
                                        class="fas fa-home me-1"></i> Back to Home</a>
                            </div>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

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