<div class="form-body">
   {!! csrf_field() !!}
   
   <div class="row">
    <!-- name -->
    <div class="col-md-4">
      <div class="form-group">
             <label class="control-label">Title</label>
           <input type="text" class="form-control" name="title" value="{!! isset($data->title) ? $data->title : old('title') !!}" required="">
       </div>
    </div>
    <!-- end name -->
     
     <!-- published_at -->
     <div class="col-md-4">
       <div class="form-group">
           <label class="control-label">Published At</label>
               <input class="form-control form-control-inline date-picker" size="16" type="text" value="{!! isset($data->published_at) ? $data->published_at : old('published_at') !!}" name="published_at" required=""/>
       </div>
     </div>
     <!-- end published_at -->

     <!-- published_at -->
     <div class="col-md-4">
       <div class="form-group">
           <label class="control-label">Thumb (600x800 jpg only)</label>
            <input type="file" name="thumb">
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
      <select name="model1_id" class="form-control">
        <option value="">Select Model 1 </option>
        @foreach($models as $model)
        <option value="{{ $model->id }}" {{ isset($data) && $data->model1_id == $model->id || $model->id == old('model1_id') ? 'selected' : '' }}>{{ $model->full_name }} ({{ $model->public_name }})</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label for=""></label>
      <select name="model2_id" class="form-control">
        <option value="">Select Model 2</option>
        @foreach($models as $model)
        <option value="{{ $model->id }}" {{ isset($data) && $data->model2_id == $model->id || $model->id == old('model2_id') ? 'selected' : '' }}>{{ $model->full_name }} ({{ $model->public_name }})</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-4">
      <label for=""></label>
      <select name="model3_id" class="form-control">
        <option value="">Select Model 3</option>
        @foreach($models as $model)
        <option value="{{ $model->id }}" {{ isset($data) && $data->model3_id == $model->id || $model->id == old('model3_id') ? 'selected' : '' }}>{{ $model->full_name }} ({{ $model->public_name }})</option>
        @endforeach
      </select>
    </div>

   </div>

</div>
<!-- end form body -->

<div class="form-actions">
    <button type="submit" class="btn btn-primary float-right">Save</button>
    <a href="{{ route('jobs.index') }}" class="btn btn-secondary float-right">Cancel</a>
</div>

@push('css')
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('js_plugins')
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
@endpush

@push('js')
<script src="http://assets.unitests.com/admin_assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
@endpush

