<div class="form-body row">
   {!! csrf_field() !!}
   
   <div class="col">
    <div class="form-group">
        <label class="control-label col-md-2">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Title" value="{!! isset($data) ? $data->name : old('name') !!}" readonly=""> 
    </div>
   </div>
   
   <div class="col">
   <div class="form-group">
      <label class="control-label">Type</label>
      <div class="div">
        <input type="checkbox" class="make-switch" data-size="large" name="type" data-on-color="success" data-off-color="warning" data-on-text="Booking" data-off-text="Expense" disabled="" {{ (isset($data) && $data->type == 'booking') ? 'checked':'' }}>
      </div>
   </div>
   </div>
   
</div>  


<div class="form-actions">
    <a href="{{ route('transaction_types.edit', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
    <a href="{{ route('transaction_types.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
</div>


@push('js')
<script>
  $(function() {

    $('.make-switch').bootstrapSwitch();

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
     
  });
</script>
@endpush
