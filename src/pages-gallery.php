<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Gallery";
    include 'partials/title-meta.php'; ?>

<!-- Lightbox css -->
<link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Gallery";
    include 'partials/menu.php'; ?>
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portfolioFilter">
                                    <a href="#" data-filter="*" class="current waves-effect waves-primary">All</a>
                                    <a href="#" data-filter=".natural" class="waves-effect waves-primary">Natural</a>
                                    <a href="#" data-filter=".creative" class="waves-effect waves-primary">Creative</a>
                                    <a href="#" data-filter=".personal" class="waves-effect waves-primary">Personal</a>
                                    <a href="#" data-filter=".photography" class="waves-effect waves-primary">Photography</a>
                                </div>
                            </div>
                        </div>

                        <div class="port mb-2">
                            <div class="row portfolioContainer">
                                <div class="col-xl-3 col-lg-4 col-md-6 natural personal">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/1.jpg" class="image-popup" title="Screenshot-1">
                                            <img src="assets/images/gallery/1.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                    
                                        <div class="text-center">
                                            <h4>Nature Image</h4>
                                            <p class="font-13 text-muted mb-2">Natural, Personal</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 creative personal photography">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/2.jpg" class="image-popup" title="Screenshot-2">
                                            <img src="assets/images/gallery/2.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Creative, Personal, Photography</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 natural creative">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/3.jpg" class="image-popup" title="Screenshot-3">
                                            <img src="assets/images/gallery/3.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Natural, Creative</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 personal photography">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/4.jpg" class="image-popup" title="Screenshot-4">
                                            <img src="assets/images/gallery/4.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Personal, Photography</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 creative photography">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/5.jpg" class="image-popup" title="Screenshot-5">
                                            <img src="assets/images/gallery/5.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Creative, Photography</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 natural photography">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/6.jpg" class="image-popup" title="Screenshot-6">
                                            <img src="assets/images/gallery/6.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Natural, Photography</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 personal photography creative">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/7.jpg" class="image-popup" title="Screenshot-7">
                                            <img src="assets/images/gallery/7.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Personal, Photography, Creative</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 creative photography natural">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/8.jpg" class="image-popup" title="Screenshot-8">
                                            <img src="assets/images/gallery/8.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="text-muted mb-2">Creative, Photography, Natural</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 natural personal">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/9.jpg" class="image-popup" title="Screenshot-9">
                                            <img src="assets/images/gallery/9.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Natural, Personal</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 photography creative">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/10.jpg" class="image-popup" title="Screenshot-10">
                                            <img src="assets/images/gallery/10.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Photography, Creative</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 creative photography">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/11.jpg" class="image-popup" title="Screenshot-11">
                                            <img src="assets/images/gallery/11.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Creative, Photography</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-3 col-lg-4 natural creative personal">
                                    <div class="gal-detail thumb">
                                        <a href="assets/images/gallery/12.jpg" class="image-popup" title="Screenshot-12">
                                            <img src="assets/images/gallery/12.jpg" class="thumb-img img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="text-center">
                                            <h4>Gallary Image</h4>
                                            <p class="font-13 text-muted mb-2">Natural, Creative, Personal</p>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end portfoliocontainer-->
                        </div> <!-- End row -->
        
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

        <!-- isotope filter plugin -->
        <script src="assets/libs/isotope-layout/isotope.pkgd.min.js"></script>

        <!-- Magnific Popup-->
        <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Gallery Init-->
        <script src="assets/js/pages/gallery.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>