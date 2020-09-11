<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Modeling Agency Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/font-awesome/css/font-awesome.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/simple-line-icons/simple-line-icons.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap/css/bootstrap.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css' !!}" rel="stylesheet" type="text/css" />

        <link href="{{ 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ 'http://assets.unitests.com/admin_assets/global/plugins/jquery-ui/jquery-ui.min.css' }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        @stack('css')
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/css/components.min.css' !!}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/css/plugins.min.css' !!}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{!! 'http://assets.unitests.com/admin_assets/layouts/layout3/css/layout.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/layouts/layout3/css/themes/default.min.css' !!}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/layouts/layout3/css/custom.min.css' !!}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        
    <style type="text/css">
    .container {
        width: 100%;
    }
    .table-checkable tr > td:first-child, 
    .table-checkable tr > th:first-child {
        text-align: left;
        padding-left: 10px;
    }
    .form-control,
    .btn,
    .caption .caption-subject {
        font-size: 13px !important;
    }
    .admin-title {
        font-weight: 500;
    }
    .admin-date {
        font-size: 16px;
        text-transform: uppercase;
    }
    .admin-title,
    .admin-date {
        color: #55616F;
        margin-top: 8px;
    }
    .page-logo {
        width: 430px !important;
    }
    </style>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <h2 class="admin-title">Dashboard</h2>
                        <h4 class="admin-date">{{ Carbon\Carbon::now('EST')->toDayDateTimeString() . ' - EST' }}</h4>
                    </div>
                    <!-- END LOGO -->
                    
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            
                            <li class="droddown dropdown-separator">
                                <span class="separator"></span>
                            </li>
                            
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-mobile">{!! Auth::guard('agency')->user()->name !!}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{!! route('client.models.logout') !!}">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container" style="width: 100%;">
                    
                    <!-- BEGIN MEGA MENU -->
                    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                    <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                    <div class="hor-menu  ">
                        <ul class="nav navbar-nav">
                            <li class="menu-dropdown classic-menu-dropdow">
                                <a href="#"> DASHBOARD
                                    <span class="arrow"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        
                        <!-- BEGIN PAGE TOOLBAR -->
                        <div class="page-toolbar">
                            <!-- BEGIN THEME PANEL -->
                            <div class="btn-group btn-theme-panel">
                                
                            </div>
                            <!-- END THEME PANEL -->
                        </div>
                        <!-- END PAGE TOOLBAR -->
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="#">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span></span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        
                        <!-- BEGIN PAGE CONTENT INNER -->
                            @yield('content')
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        
        <!-- BEGIN INNER FOOTER -->
        <div class="page-footer">
            <div class="container"> 2017 &copy;
            </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END INNER FOOTER -->
        <!-- END FOOTER -->
       
        <!-- BEGIN CORE PLUGINS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap/js/bootstrap.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/js.cookie.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery.blockui.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js' !!}" type="text/javascript"></script>

        <script src="{{ 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js' }}" type="text/javascript"></script>
        <script src="{{ 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js' }}" type="text/javascript"></script>
        <script src="{{ 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js' }}" type="text/javascript"></script>

        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootbox/bootbox.min.js' !!}" type="text/javascript"></script>
        <script src="{{ 'http://assets.unitests.com/admin_assets/global/plugins/jquery-ui/jquery-ui.min.js' }}" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        @stack('js_plugins')
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/scripts/app.min.js' !!}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
         <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        </script>
        @stack('js')
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/layouts/layout3/scripts/layout.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/layouts/layout3/scripts/demo.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/layouts/global/scripts/quick-sidebar.min.js' !!}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>