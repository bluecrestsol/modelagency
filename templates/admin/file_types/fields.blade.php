<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">
     <!-- name -->
     <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Name</label>
          <input type="text" class="form-control" name="name" value="{!! isset($data->name) ? $data->name : old('name') !!}" required="">
          </div>
      </div>
     <!-- end name -->
     <!-- owner dd -->
     <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Owner</label>
          <select class="form-control" name="owner" required="">
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
    <button type="submit" class="btn btn-primary float-right">Save</button>
    <a href="{{ route('file_types.index') }}" class="btn btn-secondary float-right">Cancel</a>
</div>


