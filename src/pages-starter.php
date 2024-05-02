<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Starter";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Starter";
    include 'partials/menu.php'; ?>
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12"></div>
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

        <?php include 'partials/right-sidebar.php'; ?>

        <?php include 'partials/footer-scripts.php'; ?>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>