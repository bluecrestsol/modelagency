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

<div class="form-actions right">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('skills.index') }}" class="btn btn-default">Cancel</a>
</div>


