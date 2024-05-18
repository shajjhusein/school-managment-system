<?php
if (!$_SESSION['user'] || !isset($_SESSION['user'])) {
    header('Location: auth-login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">

            <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($user['name']); ?>
                </a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>

            <p class="text-muted left-user-info"> <?php echo htmlspecialchars($user['role']); ?></p>

            <ul class="list-inline">

                <li class="list-inline-item">
                    <a href="auth-logout.php">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="index.php">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end">9+</span>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="mdi mdi-calendar-blank-outline"></i>
                        <span> Users </span>
                    </a>
                </li>
                <li>
                    <a href="classes.php">
                        <i class="mdi mdi-calendar-blank-outline"></i>
                        <span> Classes </span>
                    </a>
                </li>
                <li>
                    <a href="courses.php">
                        <i class="mdi mdi-calendar-blank-outline"></i>
                        <span> Courses </span>
                    </a>
                </li>
                <li>
                    <a href="instructor-management.php">
                        <i class="mdi mdi-calendar-blank-outline"></i>
                        <span> Instructor Management </span>
                    </a>
                </li>
                <li>
                    <a href="apps-calendar.php">
                        <i class="mdi mdi-calendar-blank-outline"></i>
                        <span> Calendar </span>
                    </a>
                </li>

                <li>
                    <a href="apps-chat.php">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Chat </span>
                    </a>
                </li>

                <li>
                    <a href="#email" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-outline"></i>
                        <span> Email </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="email">
                        <ul class="nav-second-level">
                            <li>
                                <a href="email-inbox.php">Inbox</a>
                            </li>
                            <li>
                                <a href="email-templates.php">Email Templates</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTasks" data-bs-toggle="collapse">
                        <i class="mdi mdi-clipboard-outline"></i>
                        <span> Tasks </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTasks">
                        <ul class="nav-second-level">
                            <li>
                                <a href="task-kanban-board.php">Kanban Board</a>
                            </li>
                            <li>
                                <a href="task-details.php">Details</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="apps-projects.php">
                        <i class="mdi mdi-briefcase-variant-outline"></i>
                        <span> Projects </span>
                    </a>
                </li>

                <li>
                    <a href="#contacts" data-bs-toggle="collapse">
                        <i class="mdi mdi-book-open-page-variant-outline"></i>
                        <span> Contacts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="contacts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="contacts-list.php">Members List</a>
                            </li>
                            <li>
                                <a href="contacts-profile.php">Profile</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Custom</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span> Auth Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="auth-login.php">Log In</a>
                            </li>
                            <li>
                                <a href="auth-register.php">Register</a>
                            </li>
                            <li>
                                <a href="auth-recoverpw.php">Recover Password</a>
                            </li>
                            <li>
                                <a href="auth-lock-screen.php">Lock Screen</a>
                            </li>
                            <li>
                                <a href="auth-confirm-mail.php">Confirm Mail</a>
                            </li>
                            <li>
                                <a href="auth-logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i class="mdi mdi-file-multiple-outline"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="pages-starter.php">Starter</a>
                            </li>
                            <li>
                                <a href="pages-pricing.php">Pricing</a>
                            </li>
                            <li>
                                <a href="pages-timeline.php">Timeline</a>
                            </li>
                            <li>
                                <a href="pages-invoice.php">Invoice</a>
                            </li>
                            <li>
                                <a href="pages-faqs.php">FAQs</a>
                            </li>
                            <li>
                                <a href="pages-gallery.php">Gallery</a>
                            </li>
                            <li>
                                <a href="pages-404.php">Error 404</a>
                            </li>
                            <li>
                                <a href="pages-500.php">Error 500</a>
                            </li>
                            <li>
                                <a href="pages-maintenance.php">Maintenance</a>
                            </li>
                            <li>
                                <a href="pages-coming-soon.php">Coming Soon</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarLayouts" data-bs-toggle="collapse">
                        <i class="mdi mdi-dock-window"></i>
                        <span> Layouts </span>
                        <span class="menu-arrow"></span>

                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="layouts-horizontal.php">Horizontal</a>
                            </li>
                            <li>
                                <a href="layouts-preloader.php">Preloader</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Components</li>

                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i class="mdi mdi-briefcase-outline"></i>
                        <span> Base UI </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="ui-buttons.php">Buttons</a>
                            </li>
                            <li>
                                <a href="ui-cards.php">Cards</a>
                            </li>
                            <li>
                                <a href="ui-avatars.php">Avatars</a>
                            </li>
                            <li>
                                <a href="ui-tabs-accordions.php">Tabs & Accordions</a>
                            </li>
                            <li>
                                <a href="ui-modals.php">Modals</a>
                            </li>
                            <li>
                                <a href="ui-progress.php">Progress</a>
                            </li>
                            <li>
                                <a href="ui-notifications.php">Notifications</a>
                            </li>
                            <li>
                                <a href="ui-offcanvas.php">Offcanvas</a>
                            </li>
                            <li>
                                <a href="ui-placeholders.php">Placeholders</a>
                            </li>
                            <li>
                                <a href="ui-spinners.php">Spinners</a>
                            </li>
                            <li>
                                <a href="ui-images.php">Images</a>
                            </li>
                            <li>
                                <a href="ui-carousel.php">Carousel</a>
                            </li>
                            <li>
                                <a href="ui-video.php">Embed Video</a>
                            </li>
                            <li>
                                <a href="ui-dropdowns.php">Dropdowns</a>
                            </li>
                            <li>
                                <a href="ui-tooltips-popovers.php">Tooltips & Popovers</a>
                            </li>
                            <li>
                                <a href="ui-general.php">General UI</a>
                            </li>
                            <li>
                                <a href="ui-typography.php">Typography</a>
                            </li>
                            <li>
                                <a href="ui-grid.php">Grid</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="widgets.php">
                        <i class="mdi mdi-gift-outline"></i>
                        <span> Widgets </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarExtendedui" data-bs-toggle="collapse">
                        <i class="mdi mdi-layers-outline"></i>
                        <span class="badge bg-info float-end">Hot</span>
                        <span> Extended UI </span>
                    </a>
                    <div class="collapse" id="sidebarExtendedui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="extended-range-slider.php">Range Slider</a>
                            </li>
                            <li>
                                <a href="extended-sweet-alert.php">Sweet Alert</a>
                            </li>
                            <li>
                                <a href="extended-draggable-cards.php">Draggable Cards</a>
                            </li>
                            <li>
                                <a href="extended-tour.php">Tour Page</a>
                            </li>
                            <li>
                                <a href="extended-notification.php">Notification</a>
                            </li>
                            <li>
                                <a href="extended-treeview.php">Tree View</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarIcons" data-bs-toggle="collapse">
                        <i class="mdi mdi-shield-outline"></i>
                        <span> Icons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarIcons">
                        <ul class="nav-second-level">
                            <li>
                                <a href="icons-feather.php">Feather Icons</a>
                            </li>
                            <li>
                                <a href="icons-mdi.php">Material Design Icons</a>
                            </li>
                            <li>
                                <a href="icons-dripicons.php">Dripicons</a>
                            </li>
                            <li>
                                <a href="icons-font-awesome.php">Font Awesome 5</a>
                            </li>
                            <li>
                                <a href="icons-themify.php">Themify</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarForms" data-bs-toggle="collapse">
                        <i class="mdi mdi-texture"></i>
                        <span> Forms </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarForms">
                        <ul class="nav-second-level">
                            <li>
                                <a href="forms-elements.php">General Elements</a>
                            </li>
                            <li>
                                <a href="forms-advanced.php">Advanced</a>
                            </li>
                            <li>
                                <a href="forms-validation.php">Validation</a>
                            </li>
                            <li>
                                <a href="forms-wizard.php">Wizard</a>
                            </li>
                            <li>
                                <a href="forms-quilljs.php">Quilljs Editor</a>
                            </li>
                            <li>
                                <a href="forms-pickers.php">Picker</a>
                            </li>
                            <li>
                                <a href="forms-file-uploads.php">File Uploads</a>
                            </li>
                            <li>
                                <a href="forms-x-editable.php">X Editable</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTables" data-bs-toggle="collapse">
                        <i class="mdi mdi-table"></i>
                        <span> Tables </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                            <li>
                                <a href="tables-basic.php">Basic Tables</a>
                            </li>
                            <li>
                                <a href="tables-datatables.php">Data Tables</a>
                            </li>
                            <li>
                                <a href="tables-editable.php">Editable Tables</a>
                            </li>
                            <li>
                                <a href="tables-responsive.php">Responsive Tables</a>
                            </li>
                            <li>
                                <a href="tables-tablesaw.php">Tablesaw Tables</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCharts" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-donut-variant"></i>
                        <span> Charts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCharts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="charts-flot.php">Flot Charts</a>
                            </li>
                            <li>
                                <a href="charts-morris.php">Morris Charts</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.php">Chartjs Charts</a>
                            </li>
                            <li>
                                <a href="charts-chartist.php">Chartist Charts</a>
                            </li>
                            <li>
                                <a href="charts-sparklines.php">Sparkline Charts</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i class="mdi mdi-map-outline"></i>
                        <span> Maps </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="maps-google.php">Google Maps</a>
                            </li>
                            <li>
                                <a href="maps-vector.php">Vector Maps</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMultilevel" data-bs-toggle="collapse">
                        <i class="mdi mdi-share-variant"></i>
                        <span> Multi Level </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMultilevel">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                    Second Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);">Item 2</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMultilevel3" data-bs-toggle="collapse">
                                    Third Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel3">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li>
                                            <a href="#sidebarMultilevel4" data-bs-toggle="collapse">
                                                Item 2 <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel4">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="javascript: void(0);">Item 1</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript: void(0);">Item 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->