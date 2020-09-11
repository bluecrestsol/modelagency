<div class="form-body">
   {!! csrf_field() !!}
   
   <div class="row">
    <!-- name -->
    <div class="col-md-4">
      <div class="form-group">
             <label class="control-label">Title</label>
           <input type="text" class="form-control" name="title" value="{!! isset($data->title) ? $data->title : old('title') !!}" disabled="">
       </div>
    </div>
    <!-- end name -->
     
     <!-- published_at -->
     <div class="col-md-4">
       <div class="form-group">
           <label class="control-label">Published At</label>
               <input class="form-control form-control-inline date-picker" size="16" type="text" value="{!! isset($data->published_at) ? $data->published_at : old('published_at') !!}" name="published_at" disabled=""/>
       </div>
     </div>
     <!-- end published_at -->

     <!-- published_at -->
     <div class="col-md-4">
       <div class="form-group">
           <img src="{{ $data->thumb_link }}" alt="Thumbnail" style="max-width: 200px;">
       </div>
     </div>
     <!-- end published_at -->
   </div>

   <div class="row">
     
    @php
    $models = \App\Models\Model::orderBy('public_name')->get();
    @endphp

    <div class="col-md-4">
      <label for=""></label>
      <select name="model1_id" class="form-control" disabled="">
        <option value="">Select Model 1</option>
        @foreach($models as $model)
        <option value="{{ $model->id }}" {{ isset($data) && ($data->model1_id == $model->id || $model->id == old('model1_id')) ? 'selected' : '' }}>{{ $model->full_name }} ({{ $model->public_name }})</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label for=""></label>
      <select name="model2_id" class="form-control" disabled="">
        <option value="">Select Model 2</option>
        @foreach($models as $model)
        <option value="{{ $model->id }}" {{ isset($data) && ($data->model2_id == $model->id || $model->id == old('model2_id')) ? 'selected' : '' }}>{{ $model->full_name }} ({{ $model->public_name }})</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label for=""></label>
      <select name="model3_id" class="form-control" disabled="">
        <option value="">Select Model 3</option>
        @foreach($models as $model)
        <option value="{{ $model->id }}" {{ isset($data) && ($data->model3_id == $model->id || $model->id == old('model3_id')) ? 'selected' : '' }}>{{ $model->full_name }} ({{ $model->public_name }})</option>
        @endforeach
      </select>
    </div>

   </div>

</div>
<!-- end form body -->

<div class="form-actions">
  <a href="{{ route('jobs.edit', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
  @if(Auth::guard('admin')->user()->role == 1)
  <a href="{{ route('jobs.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
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
              error: function (r) {
                alert("Something went wrong!");
              }
            });
          }
        },
      });
    });
  });

</script>
@endpush

