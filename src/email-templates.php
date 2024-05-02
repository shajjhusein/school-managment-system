<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Email Tamplates";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Email Tamplates";
    include 'partials/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="mb-3 header-title">Basic action email</h4>
                                        <a href="email-templates-action.php" target="_blank"> <img
                                                src="assets/images/email/1.png" class="img-fluid" alt=""> </a>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="mb-3 header-title">Email alert</h4>
                                        <a href="email-templates-alertemail-templates-billing" target="_blank"> <img
                                                src="assets/images/email/2.png" class="img-fluid" alt=""> </a>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="mb-3 header-title">Billing email</h4>
                                        <a href="email-templates-billing.php" target="_blank"> <img
                                                src="assets/images/email/3.png" class="img-fluid" alt=""> </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- end col -->
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

<?php include 'partials/right-sidebar.php'; ?>

<?php include 'partials/footer-scripts.php'; ?>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>