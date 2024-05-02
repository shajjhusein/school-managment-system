<?php include 'services/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php $title = "Dropdowns";
    include 'partials/title-meta.php'; ?>

    <?php include 'partials/head-css.php'; ?>

</head>

<?php include 'partials/body.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php $pagetitle = "Dropdowns";
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
                                        <h4 class="header-title">Examples</h4>
                                        <p class="sub-header">
                                            Toggle contextual overlays for displaying lists of links and more with the Bootstrap dropdown plugin.
                                        </p>

                                        <div class="row">
                                            <div class="col-xl-6">

                                                <p class="h5">Single button dropdowns</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Any single <code
                                                        class="highlighter-rouge">.btn</code> can be turned into a dropdown
                                                    toggle with some markup changes. Here’s how you can put them to work
                                                    with either <code class="highlighter-rouge">&lt;button&gt;</code>
                                                    elements:
                                                </p>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="dropdown">
                                                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Dropdown button <i class="mdi mdi-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="dropdown mt-sm-0 mt-2">
                                                            <a class="btn btn-light dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Dropdown link <i class="mdi mdi-chevron-down"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <p class="mb-1 mt-5 h5">Variant</p>
                                                <p class="text-muted font-13 mb-3">
                                                    The best part is you can do this with any button variant, too:
                                                </p>

                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Primary <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Secondary <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Success <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Warning <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danger <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->

                                                <p class="mb-1 mt-5 h5">Dropend variation</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Trigger dropdown menus at the right of the elements by adding <code>.dropend</code> to the parent element.
                                                </p>

                                                <!-- Default dropend button -->
                                                <div class="btn-group mb-2 dropend">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Dropend <i class="mdi mdi-chevron-right"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <!-- Split dropend button -->
                                                <div class="btn-group mb-2 dropend">
                                                    <button type="button" class="btn btn-success waves-effect waves-light">
                                                        Split dropend
                                                    </button>
                                                    <button type="button" class="btn btn-success waves-effect waves-light dropdown-toggle-split dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-right"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Dropup variation</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Trigger dropdown menus above elements
                                                    by adding <code class="highlighter-rouge">.dropup</code> to the parent
                                                    element.
                                                </p>

                                                <!-- Default dropup button -->
                                                <div class="btn-group dropup">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropup <i class="mdi mdi-chevron-up"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <!-- Split dropup button -->
                                                <div class="btn-group dropup">
                                                    <button type="button" class="btn btn-light">
                                                        Split dropup
                                                    </button>
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-up"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Active Item</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Add <code>.active</code> to item in the dropdown to <strong>style them as active</strong>.
                                                </p>

                                                <!-- Active Item -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Active Item <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Regular link</a>
                                                        <a class="dropdown-item active" href="#">Active link</a>
                                                        <a class="dropdown-item" href="#">Another link</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Headers</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Add a header to label sections of actions in any dropdown menu.
                                                </p>

                                                <!-- Header Item -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Header <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <h6 class="dropdown-header">Dropdown header</h6>
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Forms</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Put a form within a dropdown menu, or make it into a dropdown menu, and use margin or padding utilities to give it the negative space you require.
                                                </p>

                                                <!-- Forms -->
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Form <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form class="px-4 py-3">
                                                            <div class="mb-2">
                                                                <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                                                                <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                                                                <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                                                            </div>
                                                            <div class="mb-2">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                                                    <label class="form-check-label" for="dropdownCheck">
                                                                        Remember me
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Sign in</button>
                                                        </form>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">New around here? Sign up</a>
                                                        <a class="dropdown-item" href="#">Forgot password?</a>
                                                    </div>
                                                </div>

                                            </div> <!-- end col -->

                                            <div class="col-xl-6 mt-5 mt-xl-0">
                                                <p class="mb-1 h5">Split button dropdowns</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Similarly, create split button dropdowns with virtually the same markup as single button dropdowns, but with the addition of <code class="highlighter-rouge">.dropdown-toggle-split</code> for proper spacing around the dropdown caret.
                                                </p>

                                                <div class="btn-group dropdown mb-2">
                                                    <button type="button" class="btn btn-primary">Primary</button>
                                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-secondary">Secondary</button>
                                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-success">Success</button>
                                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-info">Info</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-warning">Warning</button>
                                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger">Danger</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div><!-- /btn-group -->

                                                <p class="mb-1 h5 mt-5">Sizing</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Button dropdowns work with buttons of all sizes, including default and split dropdown buttons.
                                                </p>

                                                <!-- Large button groups (default and split) -->
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Large button <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-light btn-lg" type="button">
                                                        Large button
                                                    </button>
                                                    <button type="button" class="btn btn-lg btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <!-- Small button groups (default and split) -->
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Small button <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>
                                                <div class="btn-group mb-2">
                                                    <button class="btn btn-light btn-sm" type="button">
                                                        Small button
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Dropstart variation</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Trigger dropdown menus at the right of the elements by adding <code>.dropstart</code> to the parent element.
                                                </p>

                                                <!-- Default dropstart button -->
                                                <div class="btn-group mb-2 dropstart">
                                                    <button type="button" class="btn btn-info waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-left"></i> Dropstart
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>

                                                <!-- Split dropstart button -->
                                                <div class="btn-group mb-2 dropstart">
                                                    <!-- Split dropstart button -->
                                                    <div class="btn-group">
                                                        <div class="btn-group dropstart" role="group">
                                                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="mdi mdi-chevron-left"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary">
                                                            Split dropstart
                                                        </button>
                                                    </div>
                                                </div>


                                                <p class="mb-1 h5 mt-5">Menu alignment</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Add <code class="highlighter-rouge">.dropdown-menu-end</code>
                                                    to a <code class="highlighter-rouge">.dropdown-menu</code> to right
                                                    align the dropdown menu.
                                                </p>


                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Right-aligned <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Disabled Item</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Add <code>.disabled</code> to items in the dropdown to <strong>style them as disabled</strong>.
                                                </p>

                                                <!-- Disabled -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Disabled <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Regular link</a>
                                                        <a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Disabled link</a>
                                                        <a class="dropdown-item" href="#">Another link</a>
                                                    </div>
                                                </div>

                                                <p class="mb-1 mt-5 h5">Text</p>
                                                <p class="text-muted font-13 mb-3">
                                                    Place any freeform text within a dropdown menu with text and use spacing utilities. Note that you’ll likely need additional sizing styles to constrain the menu width.
                                                </p>

                                                <!-- Text Example -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary   dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Text Dropdown <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu p-3 text-muted" style="max-width: 200px;">
                                                        <p>
                                                            Some example text that's free-flowing within the dropdown menu.
                                                        </p>
                                                        <p class="mb-0">
                                                            And this is more example text.
                                                        </p>
                                                    </div>
                                                </div>

                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                        
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