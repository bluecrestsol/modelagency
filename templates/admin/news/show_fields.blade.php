<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">
     <!-- name -->
     <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Title</label>
          <input type="text" class="form-control" name="title" value="{!! isset($data->title) ? $data->title : old('title') !!}" readonly="">
          </div>
      </div>
     <!-- end name -->

     <!-- published_at -->
     <div class="form-group col-md-3">
         <div class="col-md-12">
         <label class="control-label">Published At</label>
             <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->published_at) ? $data->published_at : old('published_at') !!}" name="published_at" readonly=""/>
         </div>
     </div>
     <!-- end published_at -->

   </div>

</div>
<!-- end form body -->

<div class="form-actions right">
  <a href="{{ route('news.edit', ['id' => $data->id]) }}" class="btn btn-primary">Edit</a>
  @if(Auth::guard('admin')->user()->role == 1)
  <a href="{{ route('news.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger">Delete</a>
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

</script>
@endpush

