<div class="form-body row">
   {!! csrf_field() !!}
   
   <div class="col">
    <div class="form-group">
        <label class="control-label">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Title" value="{!! isset($data) ? $data->name : old('name') !!}" required> 
    </div>
   </div>
   
   <div class="col">
   <div class="form-group">
        <label class="control-label">Type</label>
        <div>
            <input type="checkbox" class="make-switch" name="type" data-size="large" checked data-on-color="success" data-off-color="warning" data-on-text="Booking" data-off-text="Expense">
        </div>
   </div>
   </div>
   

</div>  

<div class="form-actions">
    <button type="submit" class="btn btn-primary float-right">Save</button>
    <a href="{{ route('transaction_types.index') }}" class="btn btn-secondary float-right">Cancel</a>
</div>

@push('js')
<script>
    $(function () {
        $('.make-switch').bootstrapSwitch();
    });
</script>
@endpush



