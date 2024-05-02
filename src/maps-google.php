<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Google Maps";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Google Maps";
    include 'partials/menu.php'; ?>
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Markers</h4>
                                        <div id="gmaps-markers" class="gmaps"></div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Overlays</h4>
                                        <div id="gmaps-overlay" class="gmaps"></div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                        </div> <!-- end row -->


                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Street View Panoramas</h4>
                                        <div id="panorama" class="gmaps-panaroma"></div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Map Types</h4>
                                        <div id="gmaps-types" class="gmaps"></div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
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

        <!-- google maps api -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyDsucrEdmswqYrw0f6ej3bf4M4suDeRgNA"></script>

        <!-- google map plugin -->
        <script src="assets/libs/gmaps/gmaps.min.js"></script> 

        <!-- Init js-->
        <script src="assets/js/pages/google-maps.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>  