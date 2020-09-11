<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">
     <!-- name -->
     <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Name</label>
          <input type="text" class="form-control" name="name" value="{!! isset($data->name) ? $data->name : old('name') !!}" readonly="">
          </div>
      </div>
     <!-- end name -->
     <!-- owner dd -->
     <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Owner</label>
          <select class="form-control" name="owner" disabled="">
          @foreach(config('constants.file_types.owner_types') as $key => $value)
          <option value="{{ $key }}" {{ (isset($data->owner_type) && ( $key == $data->owner_type ) || (old('owner') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
          @endforeach
          </select>
        </div>
     </div>
     <!-- end owner dd -->
   </div>

</div>
<!-- end form body -->

<div class="form-actions">
  <a href="{{ route('file_types.edit', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
  @if(Auth::guard('admin')->user()->role == 1)
  <a href="{{ route('file_types.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
  @endif
</div>

@push('js')
<script>
  $(function() {
    $('.btn-delete').click(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      bootbox.confirm({
        message: 'Are you sure you want to delete this?',
        buttons:{
          confirm: {
            label: 'Yes',
            className: 'btn-danger'
          },
          cancel: {
            label: 'No',
            className: 'btn-default'
          },
        },
        callback: function(result){
          if(result) {
            $.ajax({
              url:url,
              type:'DELETE',
              success: function(r) {
                r = JSON.parse(r);
                window.location.href = r.redirect;
              },
            });
          }
        },
      });
    });
  });

</script>
@endpush

