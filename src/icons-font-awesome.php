<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Font Awesome Icons";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Font Awesome Icons";
    include 'partials/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Solid</h4>
                                <p class="sub-header">Use <code>&lt;i class="fas fa-ad"&gt;&lt;/i&gt;</code> <span
                                        class="badge bg-success">v 5.13.0</span>.</p>

                                <div class="row icons-list-demo" id="solid">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Regular</h4>
                                <p class="sub-header">Use <code>&lt;i class="far fa-address-book"&gt;&lt;/i&gt;</code>
                                    <span class="badge bg-success">v 5.13.0</span>.</p>

                                <div class="row icons-list-demo" id="regular">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Brands</h4>
                                <p class="sub-header">Use <code>&lt;i class="fab fa-500px"&gt;&lt;/i&gt;</code> <span
                                        class="badge bg-success">v 5.13.0</span>.</p>

                                <div class="row icons-list-demo" id="brand">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container -->

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

<!-- custom dmeo js-->
<script src="assets/js/pages/fontawesome.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>