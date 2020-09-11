<div class="form-body">
   {!! csrf_field() !!}
  <div class="row">
   <div class="col-md-6 col-md-offset-3">
     <div class="form-group">
       <label for="">Model</label>
       <select name="model_id" id="" required  class="form-control">
          <option value="">Select Model</option>
          @foreach($models as $d)
          <option value="{{ $d->id }}" {{ (isset($data) && $data->model_id == $d->id) ? 'selected':'' }}>{{ $d->full_name }}</option>
          @endforeach         
       </select>
     </div>
     <div class="form-group">
       <label for="">File Type</label>
       <select name="file_type_id" id="" required class="form-control">
          <option value="">Select File Type</option>
          @foreach($file_types as $d)
          <option value="{{ $d->id }}" {{ (isset($data) && $data->file_type_id == $d->id) ? 'selected':'' }}>{{ $d->name }}</option>
          @endforeach         
       </select>
     </div>
     <div class="form-group">
       <label for="">File</label>
       <input type="file" name="file">
     </div>
   </div> 
  </div>
   

</div>
<!-- end form body -->

<div class="form-actions right">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('models_files.index') }}" class="btn btn-default">Cancel</a>
</div>



