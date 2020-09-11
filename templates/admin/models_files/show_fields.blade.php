<div class="form-body">
   {!! csrf_field() !!}
  <div class="row">
   <div class="col-md-6 col-md-offset-3">
     <div class="form-group">
       <label for="">Model</label>
       <select name="model_id" id="" required  class="form-control" disabled="">
          <option value="">Select Model</option>
          @foreach($models as $d)
          <option value="{{ $d->id }}" {{ (isset($data) && $data->model_id == $d->id) ? 'selected':'' }}>{{ $d->full_name }}</option>
          @endforeach         
       </select>
     </div>
     <div class="form-group">
       <label for="">File Type</label>
       <select name="file_type_id" id="" required class="form-control" disabled="">
          <option value="">Select File Type</option>
          @foreach($file_types as $d)
          <option value="{{ $d->id }}" {{ (isset($data) && $data->file_type_id == $d->id) ? 'selected':'' }}>{{ $d->name }}</option>
          @endforeach         
       </select>
     </div>
     <!-- <div class="form-group">
       <label for="">File</label>
       <input type="file" name="file">
     </div> -->
   </div> 
  </div>
   

</div>
<!-- end form body -->

<div class="form-actions right">
  <a href="{{ route('models_files.edit', ['id' => $data->id]) }}" class="btn btn-primary">Edit</a>
  @if(Auth::guard('admin')->user()->role == 1)
  <a href="{{ route('models_files.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger">Delete</a>
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

