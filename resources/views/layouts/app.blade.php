<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('')}}images/favicon.ico">
        <!-- App css -->
        <link href="{{asset('')}}css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('')}}css/app-modern.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{asset('')}}css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        
    </head>

    <body class="loading" data-layout="detached" data-layout-config='{"leftSidebarCondensed":false,"darkMode":false, "showRightSidebarOnStart": flase}'>

        <x-dash.topbar></x-dash.topbar>
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- Begin page -->
            <div class="wrapper">

                <x-dash.sidenav></x-dash.sidenav>
                <x-dash.content>
                    {{ $slot }}
                    <x-dash.footer></x-dash.footer>
                </x-dash.content>
                   

            </div> <!-- end wrapper-->

        </div>
        <!-- END Container -->
        
        <!-- Right Sidebar -->
        <div class="end-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar>

                <div class="p-3">
                    <!-- Settings -->
                    <h5 class="mt-3">Color Scheme</h5>
                    <hr class="mt-1" />

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="light"
                            id="light-mode-check" checked />
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="dark"
                            id="dark-mode-check" />
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>

                    <!-- Left Sidebar-->
                    <h5 class="mt-4">Left Sidebar</h5>
                    <hr class="mt-1" />

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="compact" value="fixed" id="fixed-check"
                            checked />
                        <label class="form-check-label" for="fixed-check">Scrollable</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="compact" value="condensed"
                            id="condensed-check" />
                        <label class="form-check-label" for="condensed-check">Condensed</label>
                    </div>

                   <div class="d-grid mt-4">
                    <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                   </div>
                </div> <!-- end padding-->
            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->


        <!-- bundle -->
        <script src="{{asset('')}}js/vendor.min.js"></script>
        <script src="{{asset('')}}js/app.min.js"></script>

        <!-- third party js -->
        <script src="{{asset('')}}js/vendor/apexcharts.min.js"></script>
        <script src="{{asset('')}}js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{asset('')}}js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{asset('')}}js/pages/demo.dashboard.js"></script>
        <!-- end demo js-->
        
    </body>
</html>
