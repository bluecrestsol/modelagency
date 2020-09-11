<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">

   <input type="hidden" value="{!! isset($data->features_category_id) ? $data->features_category_id : $category->id !!}" name="features_category_id">

   <!-- name -->
   <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Name</label>
        <input type="text" class="form-control" name="name" value="{!! isset($data->name) ? $data->name : old('name') !!}" required="">
        </div>
    </div>
   <!-- end name -->

</div>
<!-- end form body -->

<div class="form-actions">
    <button type="submit" class="btn btn-primary float-right">Save</button>
    <a href="#" class="btn btn-secondary float-right">Cancel</a>
</div>


