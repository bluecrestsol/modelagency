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

        <link href="{{ 'http://assets.unitests.com/admin_assets/global/plugins/datatables/datatables.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css' !!}" rel="stylesheet" type="text/css" />
        
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
        font-size: 24px;
    }
    .admin-date {
        font-size: 12px;
    }
    .admin-title,
    .admin-date {
        color: #55616F;
        margin-top: 8px;
    }
    .page-logo {
        width: 600px !important;
    }

    /*FROM TASKS*/

    /*remove margin left*/
    .form-horizontal .form-group {
        margin-left: 0px;
    }



    </style>
    @stack('important_css')
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
                        <h2 class="admin-title">MORGAN & PRESTON MODELS ADMIN PANEL</h2>
                        <p class="admin-date">Bangkok {{ Carbon\Carbon::now('Asia/Bangkok')->toDayDateTimeString() }}</p>
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
                                    <span class="username username-hide-mobile">{!! Auth::guard('admin')->user()->full_name !!}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{!! route('admin.logout') !!}">
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
                            @if(auth('admin')->user()->role == 1)
                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'admins' ? 'active' : '' }}">
                                <a href="{{ route('admins.index') }}"> {{ strtoupper('admins') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>
                            @endif

                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'customers' ? 'active' : '' }}">
                                <a href="{{ route('customers.index') }}"> {{ strtoupper('customers') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>

                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'agencies' ? 'active' : '' }}">
                                <a href="{{ route('agencies.index') }}"> {{ strtoupper('agencies') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>
                            
                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'models' ? 'active' : '' }}">
                                <a href="{{ route('models.index') }}"> {{ strtoupper('models') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>

                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'talents' ? 'active' : '' }}">
                                <a href="{{ route('talents.index') }}"> {{ strtoupper('talents') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>
                            <!--  -->
                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'transaction' ? 'active' : '' }}">
                                <a href="{{ route('transactions.index') }}"> {{ strtoupper('transactions') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>
                            
                            @if(auth('admin')->user()->role == 1)
                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'file-types' || Request::segment(2) == 'transaction-types' ? 'active' : '' }}">
                                <a href="#"> {{ strtoupper('settings') }}
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">

                                    <li class="{{ Request::segment(2) == 'transaction-types' ? 'active' : '' }}">
                                        <a href="{{ route('transaction_types.index') }}" class="nav-link"> {{ strtoupper('transaction types') }}
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'file-types' ? 'active' : '' }}">
                                        <a href="{{ route('file_types.index') }}" class="nav-link"> {{ strtoupper('file types') }}
                                        </a>
                                    </li>
                                    {{--<li class="{{ Request::segment(2) == 'features' ? 'active' : '' }}">
                                        <a href="{{ route('features.index') }}" class="nav-link"> {{ strtoupper('features') }}
                                        </a>
                                    </li>--}}
                                    <li class="{{ Request::segment(2) == 'features' ? 'active' : '' }}">
                                        <a href="{{ route('features.index') }}" class="nav-link"> {{ strtoupper('features') }}
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'languages' ? 'active' : '' }}">
                                        <a href="{{ route('languages.index') }}" class="nav-link"> {{ strtoupper('languages') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            
                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'enquiries' ? 'active' : '' }}">
                                <a href="{{ route('enquiries.index') }}"> {{ strtoupper('enquiries') }}
                                    <span class="arrow"></span>
                                </a>
                            </li>

                            <li class="menu-dropdown classic-menu-dropdown {{ Request::segment(2) == 'jobs' ? 'active' : '' }}">
                                <a href="{{ route('jobs.index') }}"> {{ strtoupper('jobs') }}
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
                                <a href="{{ route('admin') }}">Home</a>
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
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/scripts/datatable.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/datatables/datatables.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js' !!}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
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

            var table = $('#dataTable');
            // begin first table
            table.DataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "No records found",
                    "infoFiltered": "(filtered1 from _MAX_ total records)",
                    "lengthMenu": "Show _MENU_",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous":"Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },

                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "columnDefs": [ {
                    "targets": ['_all'],
                    "orderable": false,
                    "searchable": false
                }],

                "lengthMenu": [
                    [15, 20, 50, 100, -1],
                    [15, 20, 50, 100, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 50,            
                "pagingType": "bootstrap_full_number",
                "searching": false,
                "columnDefs": [{  // set default column settings
                    'orderable': false,
                    'targets': ['_all']
                }, {
                    "searchable": false,
                    "targets": ['_all']
                }],
                /*"order": [
                    [1, "asc"]
                ]*/ // set first column as a default sort by asc
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