@extends('frontend.layout')

@push('css')
@endpush

@push('js')
<script>
    $(".contact_form").submit(function (e) {
        e.preventDefault();


        $.ajax({
            type: 'POST',
            url: '{!! url('send-contact-form') !!}',
            data: $(".contact_form").serialize()
        }).done(function(response) {
            if(response.success) {
                $('#myModal').modal('show');
            } else {
                alert('Capcha not clicked')
            }
        });
    })


    $(window).scroll(function () {
        if ($(".home").hasClass("active")) {
            $(".header").css("background-color", "rgba(0, 0, 0, 0.8)")
            if ($(window).width() > 768) {
                $("nav a").css("color", "white")
            }

            $(".logo").attr('src', "{{ asset('img/logo_white.svg') }}");
            $("nav a").css("border-bottom", "none")
            $("nav a.active").css("border-bottom", "1px solid white")
            $(".mobile_line").css("background-color", "white")
            $(".mobile_btn").click(function () {
                if ($(".navigation").css("display") == "block") {
                    $(".mobile_line").css("background-color", "black")
                } else {
                    $(".mobile_line").css("background-color", "white")
                }
            })
        } else if ($(".booking").hasClass("active")) {
            $(".header").css({
                "background-color": "white",

            })
            if ($(window).width() > 768) {
                $("nav a").css("color", "black")
            }
            $(".logo").attr('src', "{{ asset('img/logo_black.svg') }}");
            $("nav a").css("border-bottom", "none")
            $("nav a.active").css("border-bottom", "1px solid black")
            $(".mobile_line").css("background-color", "black")
            $(".mobile_btn").click(function () {
                if ($(".navigation").css("display") == "block") {
                    $(".mobile_line").css("background-color", "black")
                } else {
                    $(".mobile_line").css("background-color", "black")
                }
            })
        } else if ($(".contact").hasClass("active")) {
            $(".header").css({
                "background-color": "black",

            })
            if ($(window).width() > 768) {
                $("nav a").css("color", "white")
            }
            $(".logo").attr('src', "{{ asset('img/logo_white.svg') }}");
            $("nav a").css("border-bottom", "none")
            $("nav a.active").css("border-bottom", "1px solid white")
            $(".mobile_line").css("background-color", "white")
            $(".mobile_btn").click(function () {
                if ($(".navigation").css("display") == "block") {
                    $(".mobile_line").css("background-color", "black")
                } else {
                    $(".mobile_line").css("background-color", "white")
                    alert("zatvoreno")
                }
            })
        }
    })

    $(".mobile_btn").click(function () {
        if ($(".navigation").css("display") == "none") {
            $(".navigation").slideDown(500)
        } else {
            $(".navigation").slideUp(500)
        }

    })

    if ($(window).width() < 768) {
        $(".navigation a").click(function () {
            $(".navigation").slideUp(500)
        })
    }

    (function ($) {
        $(window).on("load", function () {
            $(".content").mCustomScrollbar();
        });
    })(jQuery);


</script>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    function recaptchaCallback() {
        $('#submitBtn').removeClass('disabled');
    }
</script>
@endpush

@section('content')
<div class="wrapper">

    <section id="home" data-anchor="home">

    <div class="home-collage">
    </div>

    <div class="about_txt " >
            <div class="page_title white_txt">ABOUT US</div>

            <div class="row">

                <div class="col-sm-4 col-12">
                     We are a young top notch scouting agency working in the media and fashion industry and introducing talent, actors and models from all over the world.
                </div>
                <div class="col-sm-4 col-12">
                    Whether you’re looking for the right model for your video, photo shoot, catwalk or film, we can assist you with a rich catalogue of Thai and international talents for your selection. 
                </div>
                <div class="col-sm-4 col-12">
                    We can arrange castings, carefully handle talents selection and help you chose according to production needs.
                    – Headhunting can be really easy and fun!
                </div>

            </div>


        </div>

    <div class="scroll-hoolder">
        scroll down
        <br/>
        <img class="scroll-arrow" src="{{ asset('img/arrow.png') }}"/>
    </div>

        

    </section>




    <section id="models" data-anchor="booking">

        <div class="page_title">OUR MODELS</div>
        <div class="container ">

            <div class=" clearfix hidden-sm-down">
                @foreach($available_models as $model)
                <a href="{{ route('client.models.single', ['uuid' => $model->uuid, 'public_name' => $model->public_name]) }}">
                    <div class="model">
                        <div class="name_holder">
                            <div class="model_name">
                                {{ $model->public_name }}
                                <div class="available">
                                    {{ $model->availability }}
                                </div>
                            </div>
                        </div>
                        <img src="{{ $model->profile_photo }}" alt="Model {{ $model->public_name }} profile photo"/>
                    </div>
                </a>
                @endforeach
                @foreach($onrequest_models as $model)
                <a href="{{ route('client.models.single', ['uuid' => $model->uuid, 'public_name' => $model->public_name]) }}">
                    <div class="model">
                        <div class="name_holder">
                            <div class="model_name">
                                {{ $model->public_name }}
                                <div class="available">
                                    {{ $model->availability }}
                                </div>
                            </div>
                        </div>
                        <img src="{{ $model->profile_photo }}" alt="Model {{ $model->public_name }} profile photo"/>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="regular slider hidden-md-up">
                @foreach($available_models as $model)
                <div>
                    <a href="{{ route('client.models.single', ['uuid' => $model->uuid, 'public_name' => $model->public_name]) }}">
                        <img src="{{ $model->profile_photo }}"/>
                        <div class="mobile_info">{{ $model->public_name }}<br/>{{ $model->availability }}</div>
                    </a>
                </div>
                @endforeach
                @foreach($onrequest_models as $model)
                <div>
                    <a href="{{ route('client.models.single', ['uuid' => $model->uuid, 'public_name' => $model->public_name]) }}">
                        <img src="{{ $model->profile_photo }}"/>
                        <div class="mobile_info">{{ $model->public_name }}<br/>{{ $model->availability }}</div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <section id="contact" data-anchor="contact">

        <div class="page_title white_txt">CONTACT US</div>

        <div class="contact_small_txt">
            MORGAN & PRESTON<br/>
            MODEL MANAGEMENT
        </div>

        <form class="container toggle-disabled contact_form">
            {!! csrf_field() !!}
            <div class="row">


                <div class="col-md-6">
                    <input placeholder="Name" name="name" class="contact_input" data-validation="length" 
                           data-validation-length="min3" 
                           data-validation-error-msg="Name must contain a minimum of 3 characters">
                </div>
                <div class="col-md-6">
                    <input placeholder="Last Name" name="last_name" class="contact_input" data-validation="length"
                           data-validation-length="min3" 
                           data-validation-error-msg="Lastname must contain a minimum of 3 characters">
                </div>
                <div class="col-md-6">
                    <input placeholder="Subject" name="subject" class="contact_input" data-validation="length" 
                           data-validation-length="min3" 
                           data-validation-error-msg="Subject must contain a minimum of 3 characters">
                </div>
                <div class="col-md-6">
                    <input placeholder="Email" name="email" class="contact_input" data-validation="email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea name="msg_txt" placeholder="Message*" class="msg_txt" data-validation="length"
                              data-validation-length="min3" 
                              data-validation-error-msg="Message must  contain a minimum of 3 characters"></textarea>
                </div>

                <div class="col-md-12">

                    <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LfU83cUAAAAAFhlis17FIfPcktgNr1lwc30PEpy"></div>
                </div>
            </div>
            <div class="msg_btn_holder"><input type="submit" id="submitBtn" name="send_btn" value="Send" class="send_btn disabled"/></div>
        </form>



        <div class="map_holder">
            <div class="container">
                <div class="contact_info">
                    <div contact_info_top>
                        <img src="{{ asset('img/logo_white.svg') }}"/>

                        Room E, 5th floor<br/>
                        446/54 Park Avenue<br/>
                        Sukhumvit 71 Rd<br/>
                        Bangkok, 10110<br/>
                        <!-- Bangkok, Thailand<br/> -->
                        Call 02-1300357<br/><br/>

                       <!--  Morgan & Preston Co., Ltd<br/>
                        c/o The Owl Society<br/>
                        8/1 Sukhumvit 61<br/>
                        10110 Watthana<br/>
                        Bangkok, Thailand<br/>
                        Call 02 301 0862<br/><br/> -->


                    </div>
                    Bookers:<br/><br/>
                    <div class="contact_info_bot clearfix">
                        <div class="cib_left">
                            Lisa<br/>
                            <img src="{{ asset('img/mobile.svg') }}"/>+66 99 2399 745<br/>
                            <img src="{{ asset('img/envelope.svg') }}"/>lisa@mpmodelsbkk.com</br>
                            <img src="{{ asset('img/line.svg') }}"/>alisalisa2<br/><br/>

                            Bee<br/>
                            <img src="{{ asset('img/mobile.svg') }}"/>+66 81 5510 379<br/>
                            <img src="{{ asset('img/envelope.svg') }}"/>bee@mpmodelsbkk.com</br>
                            <img src="{{ asset('img/line.svg') }}"/>wanlapais<br/><br/>
                        </div>
                        <div class="cib_right">
                            Moana<br/>
                            <img src="{{ asset('img/mobile.svg') }}"/>+66 62 4455 897<br/>
                            <img src="{{ asset('img/envelope.svg') }}"/>moana@mpmodelsbkk.com</br>
                            <img src="{{ asset('img/line.svg') }}"/>mpmodelsbkk<br/><br/>
                            
                            Gie<br/>
                            <img src="{{ asset('img/mobile.svg') }}"/>+6661 228 8484<br/>
                            <img src="{{ asset('img/envelope.svg') }}"/>gie@mpmodelsbkk.com</br>
                            <img src="{{ asset('img/line.svg') }}"/>mpbkkfashion<br/><br/>
                        </div>
                    </div>


                </div>
            </div>


            <iframe class="map_frame hidden-sm-down" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d484.48839176889453!2d100.5961388!3d13.7240719!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7832e668b8e57c37!2sPark%20Avenue%20Home%20Office!5e0!3m2!1sen!2sph!4v1569394944021!5m2!1sen!2sph"  frameborder="0" style="border:0" allowfullscreen></iframe>
            
        </div>


        <iframe class="map hidden-md-up" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d484.48839176889453!2d100.5961388!3d13.7240719!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7832e668b8e57c37!2sPark%20Avenue%20Home%20Office!5e0!3m2!1sen!2sph!4v1569394944021!5m2!1sen!2sph"  frameborder="0" style="border:0" allowfullscreen></iframe>


    </section>

    <div class="footer">Copyright 2017 - {{ date('Y') }} : Morgan & Preston Co., Ltd</div>
</div>
@endsection
