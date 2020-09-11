@extends('frontend.layout')

@push('css')

@endpush

@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
	$(".mobile_btn").click(function () {
		if ($(".navigation").css("display") == "none") {
			$(".navigation").slideDown(500)
		}
		else {
			$(".navigation").slideUp(500)
		}

	})

	$('.booking_input').focusout(function () {
		if ($(this).val().length >= 3) {
			$('.suc', $(this).parent()).fadeIn(500)
			$('.err', $(this).parent()).fadeOut(500)
		}
		else {
			$('.err', $(this).parent()).fadeIn(500)
			$('.suc', $(this).parent()).fadeOut(500)
		}
	});


	/*$('.email').focusout(function () {
		if ($(this).val().length >= 3) {
			$('.error_info').slideUp(500)
		}
		else {
			$('.error_info').slideDown(500)
		}
	}); */

	$('#enquiryForm').on('submit', function (e) {
		e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '{!! route('client.book.models.single', [$model->uuid, $model->public_name]) !!}',
            data: $(".booking_modal").serialize()
        }).done(function(response) {
            if(response.success) {
                $('#bookingModal').modal('hide');
                $('#promtModal').modal('show');
            }
        });
	});

</script>

<script>
	$.validate({
	    form: '#enquiryForm',
	    modules : 'toggleDisabled, security',
	    disabledFormFilter : 'form#enquiryForm',
	    showErrorDialogs : true,

	    onSuccess: function() {
	        var form = $('#enquiryForm');
	        var url = form.attr('action');
	        var data = form.serialize();
	        $.post(url, data).done(function(r) {
	                // test
	                console.log(r);

	                $("#enquiryModal").modal('hide');
	                $("#promptModal").modal('show');
	            }).fail(function (r) {
	                //test
	                console.log(r);

	                var errors = r.responseJSON;
	                var html="";
	                $.each(errors, function (key, value) {
	                    html+='<li>'+value+'</li>'
	                });

	                $('#errors_wrapper').fadeIn().find('ul').html(html);
	                $('#enquiryModal').animate({ scrollTop: 0 }, 'slow')
	            });
	            return false; //prevent form submission
	        }
	    })
</script>

<script>
	$(function () {
		$(".booking_btn.comp_card_btn").click(function(e) {
			e.preventDefault();
			window.location.href = $(this).data('url');
		});
	});
	
</script>
@endpush

@section('content')
<div class="container">
	<div class="model_name_big">{{ $model->public_name }}</div>

	<div class="clearfix">
		<div class="top_img"><img src="{{ $model->profile_photo }}" alt="Model {{ $model->public_name }} profile photo"/></div>
		<div class="model_details">

			<div class="">
				<div class="model_info"><span class="bolded"> Height </span>: {{ $model->height }} cm </div>      
				<div class="model_info"><span class="bolded"> Bust </span>: {{ $model->bust }} cm </div>	 
				<div class="model_info"><span class="bolded">  Waist </span>: {{ $model->waist }} cm </div>	 
			</div>
			<div class="">
				<div class="model_info"><span class="bolded"> Hips </span>: {{ $model->hips }} cm </div>
				<div class="model_info"><span class="bolded"> Hair color </span>: {{ ucfirst($model->hair->name) }} </div>  
				<div class="model_info"><span class="bolded"> Eyes color </span>: {{ ucfirst($model->eyes->name) }} </div> 
				<div class="model_info"><span class="bolded"> Shoe size </span>: {{ $model->shoes }} EU</div>
				<div class="model_info"><span class="bolded"> Location </span>: {{ $model->province && $model->availabilities->count() > 0 ? ucfirst($model->province->name) : 'Out of Thailand' }}</div>
				<div class="model_info"><span class="bolded"> {{ $model->availability }} </div> 
			</div>

			<div class=" booking_btn_holder">
				<button data-toggle="modal" data-target="#bookingModal" class="booking_btn">BOOKING</button>
				@if($model->comp_card)
				<button data-url="{{ route('client.models.download-company-card', $model->id) }}" class="booking_btn comp_card_btn">COMP CARD</button>
				@endif
			</div>

		</div>
	</div>
	
	<div class="clearfix">
		@php
			$count=0;
			$photo_count=0;
		@endphp
		@foreach($model->images as $i)
			@php
				$count++;
				$photo_count++;
			@endphp

		@if ($count == 1)
		<div class="row">
		@endif
		<div class="col-md-3">
			<a class="thumbnail">
				<img src="{{ asset('storage/uploads/photos/' . $i->filename) }}" alt="Model {{ $model->public_name }} photo {{ $photo_count }}" class="img-fluid">
			</a>
		</div>
		@if($count == 4)
			@php
				$count=0;
			@endphp
			</div> 
			<!-- close row -->
		@endif

		@endforeach
	</div>

	

	<a href="{{ route('index') . '/#models'}}"><button class="to_models">BACK TO MODELS</button></a>
</div>

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img src="{{ asset('img/close.png') }}"/>
				</button>

				<div class="modal_title">
					BOOKING FORM
					<h4>MODEL: {{ strtoupper($model->public_name) }}</h4>
				</div>

				
				<div class="alert alert-danger" style="display: none;">
					<ul></ul>
				</div>

				<form class="booking_modal" action="{{ route('enquiries.store') }}" method="POST" id="enquiryForm">
					
					{{ csrf_field() }}
					<input type="hidden" name="model_id" value="{{ $model->id }}">

					<div class="input_holder">
						<input type="text" name="name" placeholder="Name" class="booking_input name" data-validation="required"/>
						<img class="err" src="{{ asset('img/err.png') }}"/>
						<img class="suc" src="{{ asset('img/suc.png') }}"/>
					</div>

					<div class="input_holder">
						<input type="text" name="company" placeholder="Company" class="booking_input name" data-validation="required"/>
						<img class="err" src="{{ asset('img/err.png') }}"/>
						<img class="suc" src="{{ asset('img/suc.png') }}"/>
					</div>

					<div class="input_holder">
						<input type="text" name="mobile" placeholder="Mobile*" class="booking_input subject" data-validation="required"/>
						<img class="err" src="{{ asset('img/err.png') }}"/>
						<img class="suc" src="{{ asset('img/suc.png') }}"/>
					</div>

					<div class="input_holder">
						<input type="email" name="email" placeholder="Email*" class="booking_input email" data-validation="email"/>
						<img class="err" src="{{ asset('img/err.png') }}"/>
						<img class="suc" src="{{ asset('img/suc.png') }}"/>
					</div>

					<!-- <div class="error_info">
						Wrong email please try again
					</div>
 -->
					<textarea name="details" placeholder="Details about the Booking*" class="booking_txt" data-validation="required"></textarea>

					<div class="input_holder">
						<input data-validation="recaptcha" data-validation-recaptcha-sitekey="6LfU83cUAAAAAFhlis17FIfPcktgNr1lwc30PEpy">
					</div>

					<div class="msg_btn_holder">
						<input type="submit" name="send_booking" value="Send" class="booking_send" id="btnSend"/>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<!-- ÷\ PROMPT MODAL -->
<div class="modal fade" id="promtModal" tabindex="-1" role="dialog" aria-labelledby="promtModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="promtModalLabel"></h4>
      </div>
      <div class="modal-body">
        
		Thanks for your enquiry, our staff will get in touch with you soon
        
    </div>
  </div>
</div>
@endsection