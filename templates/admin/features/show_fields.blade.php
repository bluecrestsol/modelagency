<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">

     <!-- name -->
     <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Name</label>
          <input type="text" class="form-control" name="name" value="{!! isset($data->name) ? $data->name : old('name') !!}" required="" disabled="">
          </div>
      </div>
     <!-- end name -->
   </div>

</div>
<!-- end form body -->

<div class="form-actions">
  <a href="{{ route('features.edit-feature', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
  @if(Auth::guard('admin')->user()->role == 1)
  <a href="{{ route('features.destroy-feature', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
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
                window.location.href = r.redirect
              },
            });
          }
        },
      });
    });
  });

</script>
@endpush

