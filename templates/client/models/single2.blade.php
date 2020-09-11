<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link href="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap/css/bootstrap.min.css' !!}" rel="stylesheet" type="text/css" />

	<style>
		.list-group-item {
			text-transform: uppercase;
		}
	</style>
</head>
<body>
	<div class="container">
		
		<div class="page-header"><h3>Model</h3></div>

			<p class="text-center"><a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#enquiryModal">BOOKING</a></p>
			<div class="col-md-4 col-md-offset-4">
				<div class="thumbnail">
					<img src="{{ $model->profile_photo }}" alt="">
					<div class="caption">
						<h4 class="text-center">{{ strtoupper($model->public_name) }}</h4>
					</div>
				</div>	
			</div>
			<!-- 

				Sex: ...
				Ethnicity: ...
				Eyes: ...
				Height: ...
				Mesurements: {bust-waist-hips}
				Shoes Size: ....
				Availability: {from - to of the availability with higher 'from' date for the model}

				All the model images (4 x row)
			 -->
			
			<div class="col-md-12">
				<ul class="list-group">
					<li class="list-group-item"><strong>Sex : </strong>{{ config('constants.models.sex.'.$model->sex) }}</li>
					<li class="list-group-item"><strong>Ethnicity : </strong>{{ $model->ethnicity->name }}</li>
					<li class="list-group-item"><strong>Eyes : </strong>{{ $model->eyes->name }}</li>
					<li class="list-group-item"><strong>Height : </strong>{{ $model->height }}</li>
					<li class="list-group-item"><strong>Measurements : </strong>{{ $model->bust }}-{{ $model->waist }}-{{ $model->hips }}</li>
					<li class="list-group-item"><strong>Shoe Size : </strong>{{ $model->shoes }}</li>
					<li class="list-group-item"><strong>Availabilities : </strong>
						<ul>
							@foreach($model->availabilities as $a)
							<li>{{ $a->starts_at }} - {{ $a->ends_at }}</li>
							@endforeach
						</ul>
					</li>
				</ul>
			</div>

			<div class="page-header col-md-12"><h4>Model Images</h4></div>
			
			@php
				$count=0;
			@endphp
			@foreach($model->images as $i)
				@php
					$count++;
				@endphp

			@if ($count == 1)
			<div class="row">
			@endif
			<div class="col-xs-3">
				<a class="thumbnail">
					<img src="{{ asset('storage/uploads/photos/' . $i->filename) }}" alt="" class="img-responsive">
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
			



			<!-- MODAL -->

			<!-- Modal -->
			<div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="enquiryModalLabel">Enquiry About Model {{ $model->public_name }}</h4>
			      </div>
			      <div class="modal-body">
			        
			        <div class="row">
				        <div class="col-md-4 col-md-offset-4">
				        	<a href="#" class="thumbnail"><img src="{{ $model->profile_photo }}" alt=""></a>
				        </div>	
			        </div>
					<div class="alert alert-danger" style="display: none;">
						<ul></ul>
					</div>
					<form action="{{ route('enquiries.store') }}" method="POST" class="form" id="enquiryForm">
						{{ csrf_field() }}
						<input type="hidden" name="model_id" value="{{ $model->id }}">
						<div class="form-group">
							<label for="">Name:</label>
							<input type="text" class="form-control" name="from_name" data-validation="required">
						</div>
						<div class="form-group">
							<label for="">Company:</label>
							<input type="text" class="form-control" name="from_company" data-validation="required">
						</div>
						<div class="form-group">
							<label for="">Mobile:</label>
							<input type="text" class="form-control" name="from_mobile" data-validation="required">
						</div>
						<div class="form-group">
							<label for="">Email:</label>
							<input type="email" class="form-control" name="from_email" data-validation="required">
						</div>
						<div class="form-group">
							<label for="">Message:</label>
							<input type="text" class="form-control" name="message" data-validation="required">
						</div>
						<button type="submit" class="btn btn-primary" id="btnSend">Send</button>
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
			
	</div>

	<script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/jquery.min.js' !!}" type="text/javascript"></script>
	<script src="{!! 'http://assets.unitests.com/admin_assets/global/plugins/bootstrap/js/bootstrap.min.js' !!}" type="text/javascript"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

	<script>
		$.validate({
		    form: '#enquiryForm',
		    modules : 'toggleDisabled',
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
</body>
</html>