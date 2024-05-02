<!DOCTYPE html>
<html lang="en">
    <head>
    <?php $title = "Coming Soon";
    include 'partials/title-meta.php'; ?>

		<?php include 'partials/head-css.php'; ?>

    </head>

    <body class="loading authentication-bg">
        
        <div class="mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="text-center">
                            <a href="index.php" class="logo">
                                <img src="assets/images/logo-dark.png" alt="" height="22" class="logo-light mx-auto">
                            </a>

                            <h3 class="mt-4">Stay tunned, we're launching very soon</h3>
                            <p class="text-muted">We're making the system more awesome.</p>

                        </div>
                    </div>
                </div>
                <div class="row mt-5 justify-content-center">
                    <div class="col-md-8 text-center">
                        <div data-countdown="2022/11/19" class="counter-number"></div>
                    </div> <!-- end col-->
                </div> <!-- end row-->

            </div>
        </div>

        <?php include 'partials/footer-scripts.php'; ?>

        <!-- Plugins js-->
        <script src="assets/libs/jquery-countdown/jquery.countdown.min.js"></script>

        <!-- Countdown js -->
        <script src="assets/js/pages/coming-soon.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>