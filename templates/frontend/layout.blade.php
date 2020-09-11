<!DOCTYPE html>

<html>
    <head>
        <title>{{ isset($title) ? $title:'Morgan & Preston Models Bangkok - Modelling and Talent Agency
' }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('img/favicon.ico') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
        @stack('css')
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}" ></script>
        <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

        <script src="{{ asset('js/tether.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
$(document).ready(function () {
    $('nav a').on('click', function () {

        var scrollAnchor = $(this).attr('data-scroll'),
                scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top + 20;

        $('body,html').animate({
            scrollTop: scrollPoint
        }, 500);

        return false;

    })
});




$(window).scroll(function () {
    var windscroll = $(window).scrollTop();
    if (windscroll >= 100) {
//        $('nav').addClass('fixed');
        $('.wrapper section').each(function (i) {
            if ($(this).position().top <= windscroll) {
                $('nav a.active').removeClass('active');
                $('nav a').eq(i).addClass('active');
            }
        });

    } else {


        $('nav a.active').removeClass('active');
        $('nav a:first').addClass('active');
    }

}).scroll();



$.validate({
    modules: 'toggleDisabled',
    disabledFormFilter: 'form.toggle-disabled',
    showErrorDialogs: true
});
// Restrict presentation length
$('#presentation').restrictLength($('#pres-max-length'));
        </script>
    </head>
    <body>

        <div class="header clearfix">
            <div class="container-fluid">
                <a href="{{ route('index') }}"><img class="logo" src="{{ asset('img/logo_white.svg') }}"></a>
                <button class="mobile_btn hidden-md-up">
                    <span class="mobile_line"></span>
                    <span class="mobile_line"></span>
                    <span class="mobile_line"></span>
                    <span class="mobile_line"></span>
                </button>
                <nav class="navigation">

                    <img class="mobile_logo hidden-md-up" src="{{ asset('img/logo_black.svg') }}"/>

                    <a href="{{ route('index') }}" data-scroll="home" class="home active">Home</a>


                    <a href="{{ route('index') . '/#models' }}" data-scroll="booking" class="booking">Our Models</a>

                    <a href="{{ route('index') . '/#contact' }}" data-scroll="contact" class="contact">Contact Us</a>

                </nav>
            </div>
        </div>
        @yield('content')
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>


                        Thank you for submitting <br/>
                        your message, we will be in touch shortly. 
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/swiper.min.js') }}"></script>
        <script src="{{ asset('js/slick.js') }}"></script>
        @stack('js')
        <script>

$.validate({
    modules: 'toggleDisabled',
    disabledFormFilter: 'form.toggle-disabled',
    showErrorDialogs: true
});


// Restrict presentation length
$('#presentation').restrictLength($('#pres-max-length'));

$(".regular").slick({
    dots: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    nextArrow: '<i class="fa fa-arrow-right"></i>',
    prevArrow: '<i class="fa fa-arrow-left"></i>'
});

        </script>
    </body>
</html>
