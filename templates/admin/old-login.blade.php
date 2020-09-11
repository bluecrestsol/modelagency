<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/font-awesome/css/font-awesome.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/simple-line-icons/simple-line-icons.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap/css/bootstrap.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css' !!}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/select2/css/select2.min.css' !!}" rel="stylesheet" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/select2/css/select2-bootstrap.min.css' !!}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/css/components.min.css' !!}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{!! 'http://assets.unitests.com/admin_assets/global/css/plugins.min.css' !!}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{!! 'http://assets.unitests.com/admin_assets/pages/css/login.min.css' !!}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        
        </head>
    <!-- END HEAD -->

    <body class=" login">
        
        <div class="content">



            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="{{ route('admin.login') }}" method="post">
            {!! csrf_field() !!}
                <h3 class="form-title font-green">Sign In</h3>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <span>{{$errors->first()}}</span>
                    </div>
                @endif
                @if(session()->has('fail'))
                    <div class="alert alert-danger">
                        <span>{{ session()->get('fail') }}</span>
                    </div>
                @endif
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" required value="{{ old('email') }}"/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Login</button>
                   
                </div>
            </form>
            <!-- END LOGIN FORM -->
            
            
        </div>
        <div class="copyright"> 2017 ©</div>
     
        <!-- BEGIN CORE PLUGINS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap/js/bootstrap.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/js.cookie.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery.blockui.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js' !!}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery-validation/js/jquery.validate.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery-validation/js/additional-methods.min.js' !!}" type="text/javascript"></script>
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/select2/js/select2.full.min.js' !!}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{!! 'http://assets.unitests.com/admin_assets/global/scripts/app.min.js' !!}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>