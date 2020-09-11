<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">
     <!-- name -->
     <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Title</label>
          <input type="text" class="form-control" name="title" value="{!! isset($data->title) ? $data->title : old('title') !!}" required="">
          </div>
      </div>
     <!-- end name -->

     <!-- published_at -->
     <div class="form-group col-md-3">
         <div class="col-md-12">
         <label class="control-label">Published At</label>
             <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->published_at) ? $data->published_at : old('published_at') !!}" name="published_at" required=""/>
         </div>
     </div>
     <!-- end published_at -->

   </div>

</div>
<!-- end form body -->

<div class="form-actions right">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('news.index') }}" class="btn btn-default">Cancel</a>
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

