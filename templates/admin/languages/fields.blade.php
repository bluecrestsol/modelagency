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
   </div>

</div>
<!-- end form body -->

<div class="form-actions">
    <button type="submit" class="btn btn-primary float-right">Save</button>
    <a href="{{ route('languages.index') }}" class="btn btn-secondary float-right">Cancel</a>
</div>


