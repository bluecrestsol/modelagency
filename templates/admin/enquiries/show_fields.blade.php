<div class="form-body">
	<div class="form-group">
		<label for="">UUID:</label>
		<input type="text" class="form-control" value="{{ $data->uuid }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">Model:</label>
		<input type="text" class="form-control" value="{{ $data->model->full_name }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">From Name:</label>
		<input type="text" class="form-control" value="{{ $data->from_name }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">From Company:</label>
		<input type="text" class="form-control" value="{{ $data->from_company }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">From Email:</label>
		<input type="text" class="form-control" value="{{ $data->from_email }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">From Mobile:</label>
		<input type="text" class="form-control" value="{{ $data->from_mobile }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">From IP:</label>
		<input type="text" class="form-control" value="{{ $data->from_ip }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">From GEO County:</label>
		<input type="text" class="form-control" value="{{ $data->from_geo_country_iso }}" readonly="">
	</div>
	<div class="form-group">
		<label for="">Message:</label>
		<input type="text" class="form-control" value="{{ $data->message }}" readonly="">
	</div>
	
	@if(auth('admin')->user()->role == 1)
	<div class="form-group">
		<a href="javascript:;" class="btn btn-danger" id="btnDelete" onclick="deleteEnquiry()">Delete</a>
		<form action="{{ route('enquiries.destroy', $data->id) }}" id="formDelete" style="display: none;" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
		</form>
	</div>
	@endif
</div>


@push('js')
	<script>
		function deleteEnquiry() 
		{
			bootbox.confirm("Are you sure you want to delete this?", function(result) {
				if (result) {
					$('#formDelete').submit();
				}
			});
		}
	</script>
@endpush
