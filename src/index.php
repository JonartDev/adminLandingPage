<!DOCTYPE html>
<html>

<head>
    <base href="">
    <title>Admin panel</title>
    <meta name="description" content="Ceres admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords" content="Ceres theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Ceres HTML Free - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/products/ceres-html-pro" />
    <meta property="og:site_name" content="Keenthemes | Ceres HTML Free" />
    <link rel="canonical" href="Https://preview.keenthemes.com/ceres-html-free" />
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!-- Add your CSS and other head elements here -->
</head>

<body id="kt_body" style="background-image: url(../assets/media/patterns/header-bg.png)" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <?php include 'templates/header.php'; ?>
                <?php include 'templates/navigation.php'; ?>

                <main>
                    <?php
                    // Determine the page to load based on the URL
                    $url = $_SERVER['REQUEST_URI'];
                    $page = '';

                    if ($url === '/phpTemplating/about') {
                        $page = 'about.php';
                    } elseif ($url === '/phpTemplating/contact') {
                        $page = 'contact.php';
                    } else {
                        $page = 'home.php';
                    }

                    // Load the content for the selected page
                    include 'templates/' . $page;
                    ?>
                </main>

                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2021©</span>
                            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://keenthemes.com/products/ceres-html-pro" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
                <!-- Add your footer content here -->

                <!-- Add your JavaScript and other body elements here -->
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "../assets/";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="../assets/plugins/global/plugins.bundle.js"></script>
    <script src="../assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="../assets/js/custom/widgets.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>

</html>