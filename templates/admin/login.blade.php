<!DOCTYPE html>

<html>
    <head>
        <title>Morgan&Preston Models</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="{{ asset('mpmodelstheme/assets/dist/img/favicon.ico') }}"/>

        <link rel="stylesheet" href="{{ asset('mpmodelstheme/assets/dist/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('mpmodelstheme/assets/dist/css/mp.css') }}"/>
        <link rel="stylesheet" href="{{ asset('mpmodelstheme/assets/dist/css/main.css') }}"/>

    </head>
    <body style="padding: 0;">
        <div class="login-holder">
            <img alt="profile image" src="{{ asset('mpmodelstheme/assets/dist/img/logo.svg') }}"/>
            
            <form class="login-form" action="{{ route('admin.login') }}" method="post">
            {!! csrf_field() !!}
            <label>Login to your account</label>

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
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Enter email" name="email" required value="{{ old('email') }}"/> </div>
                <div class="form-group">
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
                <div class="form-actions clearfix">
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </div>
            </form>
            <!-- END LOGIN FORM -->

        </div>

        <script src="{{ asset('mpmodelstheme/assets/dist/js/jquery-1.11.0.min.js') }}" ></script>
        <script src="{{ asset('mpmodelstheme/assets/dist/js/tether.min.js') }}"></script>
        <script src="{{ asset('mpmodelstheme/assets/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('mpmodelstheme/assets/dist/js/jquery.form-validator.min.js') }}"></script>
        
        <!-- <script type="text/javascript" src="{{ asset('mpmodelstheme/assets/dist/js/script.js') }}"></script> -->

    </body>
</html>

