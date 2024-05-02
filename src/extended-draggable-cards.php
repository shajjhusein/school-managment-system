<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Draggable Cards";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Draggable Cards";
    include 'partials/menu.php'; ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="sortable">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="card card-draggable">
                                        <img class="card-img-top img-fluid" src="assets/images/gallery/1.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>

                                    <div class="card card-draggable text-white bg-primary">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                                    erat a ante.</p>
                                                <footer class="blockquote-footer text-white-50">Someone famous in <cite title="Source Title">Source Title</cite>
                                                </footer>
                                            </blockquote>
                                        </div>
                                    </div>

                                    <div class="card card-draggable">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card card-draggable">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>

                                    <div class="card card-draggable">
                                        <img class="card-img-top img-fluid" src="assets/images/gallery/3.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>

                                    <div class="card card-draggable">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="card card-draggable">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>


                                    <div class="card card-draggable">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>


                                    <div class="card card-draggable">
                                        <div class="card-body">
                                            <h4 class="card-title">Card title</h4>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                        </div>
                                    </div>

                                    <div class="card text-white bg-danger card-draggable">
                                        <div class="card-body">
                                            <blockquote class="card-bodyquote mb-0">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                                    erat a ante.</p>
                                                <footer class="blockquote-footer text-white-50">Someone famous in <cite title="Source Title">Source Title</cite>
                                                </footer>
                                            </blockquote>
                                        </div>
                                    </div>

                                </div>

                            </div><!-- Row -->
                        </div><!-- Sortable -->
                        
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

        <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>

        <!-- draggable init -->
        <script src="assets/js/pages/draggable.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
 
    </body>
</html>