<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Task Details";
    include 'partials/title-meta.php'; ?>

    <!-- Plugins css -->
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />

    <link href="assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Task Details";
    include 'partials/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body task-detail">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <img class="flex-shrink-0 me-3 rounded-circle avatar-md" alt="64x64"
                                        src="assets/images/users/user-2.jpg">
                                    <div class="flex-grow-1">
                                        <h4 class="media-heading mt-0">Michael Zenaty</h4>
                                        <span class="badge bg-danger">Urgent</span>
                                    </div>
                                </div>

                                <h4>Code HTML email template for welcome email</h4>

                                <p class="text-muted">
                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                    praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                    excepturi sint cupiditate non sunt in culpa qui officia deserunt animi est laborum
                                    et
                                </p>

                                <p class="text-muted">
                                    Consectetur adipisicing elit. Voluptates, illo, iste
                                    itaque voluptas corrupti ratione reprehenderit magni similique Tempore quos
                                    delectus asperiores libero voluptas quod perferendis erum ipsum dolor sit.
                                </p>

                                <div class="row task-dates mb-0 mt-2">
                                    <div class="col-lg-6">
                                        <h5 class="font-600 m-b-5">Start Date</h5>
                                        <p> 22 March 2016 <small class="text-muted">1:00 PM</small></p>
                                    </div>

                                    <div class="col-lg-6">
                                        <h5 class="font-600 m-b-5">Due Date</h5>
                                        <p> 17 April 2016 <small class="text-muted">12:00 PM</small></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="task-tags mt-2">
                                    <h5>Tags</h5>
                                    <input type="text" class="selectize-close-btn" value="Amsterdam,Washington,Sydney"
                                        data-role="tagsinput" placeholder="add tags" />
                                </div>

                                <div class="assign-team mt-3">
                                    <h5>Assign to</h5>
                                    <div>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                src="assets/images/users/user-2.jpg"> </a>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                src="assets/images/users/user-3.jpg"> </a>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                src="assets/images/users/user-5.jpg"> </a>
                                        <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                src="assets/images/users/user-8.jpg"> </a>
                                        <a href="#"><span class="add-new-plus"><i class="mdi mdi-plus"></i> </span></a>
                                    </div>
                                </div>

                                <div class="attached-files mt-3">
                                    <h5>Attached Files </h5>
                                    <ul class="list-inline files-list">
                                        <li class="list-inline-item file-box">
                                            <a href=""><img src="assets/images/attached-files/img-1.jpg"
                                                    class="img-fluid img-thumbnail" alt="attached-img" width="80"></a>
                                            <p class="font-13 mb-1 text-muted"><small>File one</small></p>
                                        </li>
                                        <li class="list-inline-item file-box">
                                            <a href=""><img src="assets/images/attached-files/img-2.jpg"
                                                    class="img-fluid img-thumbnail" alt="attached-img" width="80"></a>
                                            <p class="font-13 mb-1 text-muted"><small>Attached-2</small></p>
                                        </li>
                                        <li class="list-inline-item file-box">
                                            <a href=""><img src="assets/images/attached-files/img-3.jpg"
                                                    class="img-fluid img-thumbnail" alt="attached-img" width="80"></a>
                                            <p class="font-13 mb-1 text-muted"><small>Dribbble shot</small></p>
                                        </li>
                                        <li class="list-inline-item file-box ms-2">
                                            <div class="fileupload add-new-plus">
                                                <span><i class="mdi-plus mdi"></i></span>
                                                <input type="file" class="upload">
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-end">
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light me-1">
                                                    Save
                                                </button>
                                                <button type="button" class="btn btn-light waves-effect">Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>

                                <h4 class="header-title mt-0 mb-3">Comments (6)</h4>

                                <div>

                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                    src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0">Mat Helme</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin commodo.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                    src="assets/images/users/user-2.jpg"> </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0">Media heading</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                sollicitudin purus odio.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>

                                            <div class="d-flex my-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                            src="assets/images/users/user-3.jpg"> </a>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="mt-0">Nested media heading</h5>
                                                    <p class="font-13 text-muted mb-0">
                                                        <a href="" class="text-primary">@Michael</a>
                                                        Cras sit amet nibh libero, in gravida nulla vel metus
                                                        scelerisque ante sollicitudin purus odio.
                                                    </p>
                                                    <a href="" class="text-success font-13">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                    src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0">Mat Helme</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin commodo cras purus.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                    src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0">Mat Helme</h5>
                                            <p class="font-13 text-muted mb-0">
                                                <a href="" class="text-primary">@Michael</a>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin commodo cras.
                                            </p>
                                            <a href="" class="text-success font-13">Reply</a>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <div class=" me-3">
                                            <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64"
                                                    src="assets/images/users/user-1.jpg"> </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control" placeholder="Some text value...">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div><!-- end col -->
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

<!-- Plugins js -->
<script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="assets/libs/multiselect/js/jquery.multi-select.js"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>

<script src="assets/js/pages/task-detail.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>

</html>