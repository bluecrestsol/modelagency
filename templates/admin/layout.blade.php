<!DOCTYPE html>

<html>
    <head>
        <title>Morgan&Preston Models Theme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="{{ asset('mpmodelstheme/assets/dist/img/favicon.ico') }}"/>

        <link rel="stylesheet" href="{{ asset('mpmodelstheme/assets/dist/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('mpmodelstheme/assets/dist/css/bootstrap-switch.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('mpmodelstheme/assets/dist/css/bootstrap-datepicker.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('mpmodelstheme/assets/dist/css/datatables.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('mpmodelstheme/assets/dist/css/mp.css') }}"/>
        <link rel="stylesheet" href="{{ asset('mpmodelstheme/assets/dist/css/main.css') }}"/>

        <style>
            body {
                color:white;
            }

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
        @stack('css')

    </head>
    <body>

        <div class="container-fluid">

            <header>


                <nav class="navbar navbar-toggleable-md navbar-dark bg-black ">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <a class="navbar-brand hidden-lg-up" href="{{ url('/') }}"><img class="logo" src="{{ asset('mpmodelstheme/assets/dist/img/logo.svg') }}" alt="logo"/></a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <a class="navbar-brand hidden-md-down" href="{{ url('/') }}"><img class="logo" src="{{ asset('mpmodelstheme/assets/dist/img/logo.svg') }}" alt="logo"/></a>
                        <ul class="navbar-nav mr-auto">
                            @if(auth('admin')->user()->role == 1)
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'admins' ? 'active' : '' }}" href="{{ route('admins.index') }}"> 
                                    {{ ucfirst('admins') }}
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'customers' ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                    {{ ucfirst('customers') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'agencies' ? 'active' : '' }}" href="{{ route('agencies.index') }}">
                                    {{ ucfirst('agencies') }}
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'models' ? 'active' : '' }}" href="{{ route('models.index') }}">
                                    {{ ucfirst('models') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'talents' ? 'active' : '' }}" href="{{ route('talents.index') }}">
                                    {{ ucfirst('talents') }}
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'transaction' ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                                    {{ ucfirst('transactions') }}
                                </a>
                            </li>
                            
                            @if(auth('admin')->user()->role == 1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ ucfirst('settings') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <ul class="theme-menu">

                                        <li class="{{ Request::segment(2) == 'transaction-types' ? 'active' : '' }}">
                                            <a href="{{ route('transaction_types.index') }}" class="dropdown-item">
                                                {{ ucfirst('transaction types') }}
                                            </a>
                                        </li>
                                        <li class="{{ Request::segment(2) == 'file-types' ? 'active' : '' }}">
                                            <a href="{{ route('file_types.index') }}" class="dropdown-item">
                                                {{ ucfirst('file types') }}
                                            </a>
                                        </li>
                                        
                                        <li class="{{ Request::segment(2) == 'features' ? 'active' : '' }}">
                                            <a href="{{ route('features.index') }}" class="dropdown-item">
                                                {{ ucfirst('features') }}
                                            </a>
                                        </li>
                                        <li class="{{ Request::segment(2) == 'languages' ? 'active' : '' }}">
                                            <a href="{{ route('languages.index') }}" class="dropdown-item">
                                                {{ ucfirst('languages') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif
                            
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'enquiries' ? 'active' : '' }}" href="{{ route('enquiries.index') }}">
                                    {{ ucfirst('enquiries') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'jobs' ? 'active' : '' }}" href="{{ route('jobs.index') }}">
                                    {{ ucfirst('jobs') }}
                                </a>
                            </li>

                        </ul>

                        <div class="user-control float-right">
                            <div class="user">ALEX SCALIA - DIRECTOR
                            </div>
                            <div class="location-date">Bangkok Mon, Nov 13, 2017 10:26 AM</div>

                            <div class="profile-menu">
                                <div class="profile-img-holder"> <img alt="profile image" src="{{ asset('mpmodelstheme/assets/dist/img/icons/profile.svg') }}"/> </div>

                                <a>My Profile</a>
                                <a>Logout</a>
                            </div>
                        </div>
                    </div>
                </nav>




            </header>



            @yield('content')
            



            <div class="col-12">
                <footer>
                    Copyright 2017 - {{ date('Y') }} : Morgan & Preston Co., Ltd
                </footer>
            </div>
            


        </div>



        <!-- <script src="{{ asset('mpmodelstheme/assets/dist/js/jquery-1.11.0.min.js') }}" ></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="{{ asset('mpmodelstheme/assets/dist/js/tether.min.js') }}"></script>
        <script src="{{ asset('mpmodelstheme/assets/dist/js/bootstrap.min.js') }}"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

        <script src="{{ asset('mpmodelstheme/assets/dist/js/bootstrap-switch.min.js') }}"></script>
        <script src="{{ asset('mpmodelstheme/assets/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('mpmodelstheme/assets/dist/js/datatables.min.js') }}"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
        <!-- <script type="text/javascript" src="{{ asset('mpmodelstheme/assets/dist/js/jquery.form-validator.min.js') }}"></script> -->
        <script src="{{ asset('mpmodelstheme/assets/dist/js/script.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dataTable').DataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "<",
                        "sNext": ">"
                    }
                },
                "order": [],
                "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
                }]
            });

             $('.date-picker').datepicker({
                orientation: "left",
                autoclose: true
            });
        </script>

        @stack('js')

    </body>
</html>