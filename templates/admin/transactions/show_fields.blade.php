<div class="form-body">
   {!! csrf_field() !!}

  <input type="hidden" name="this_transaction_type" value="{{ $type }}">

  
  <div class="row">
  <!-- happened_at -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
        <label class="control-label">Happened At</label>
            <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->happened_at) ? $data->happened_at : old('happened_at') !!}" name="happened_at" readonly="" />
        </div>
    </div>
    <!-- end happened_at autocomplete with photo-->
    <!-- model -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
         <input type="hidden" id="model_id" name="model_id" value="{!! isset($data->model_id) ? $data->model_id : old('model_id') !!}" required="">
           <label class="control-label">Model</label>
             <input type="text" id="model_search" class="form-control" name="model" value="{!! isset($data->model->search_name) ? $data->model->search_name : old('model') !!}" required="" readonly="">
         </div>
     </div>
    <!-- end model -->

    

    @if(isset($data) ? $data->transaction_type_id == 1 : $type == 1)
    <!-- customer autocomplete-->
    <div class="form-group col-md-4">
         <div class="col-md-12">
            <input type="hidden" id="customer_id" value="{!! isset($data->customer) ? $data->customer_id : old('customer_id') !!}" required="">
           <label class="control-label">Customer</label>
             <input type="text" class="form-control" id="customer_search" name="customer" value="{!! isset($data->customer->search_name) ? $data->customer->search_name : old('customer') !!}" required="" readonly="">
         </div>
     </div>
    <!-- end customer -->
    @endif
  </div>

  <div class="row">
    <!-- transaction_types -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Transaction Type</label>
           <select class="form-control" name="transaction_type_id" required="" disabled="">
              <option value="">Select transaction type</option>
            @foreach(config('constants.transaction_types.types') as $key => $value)
              <option value="{{ $key }}" {{ (isset($data->transaction_type_id) && ( $key == $data->transaction_type_id ) || (old('transaction_type_id') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end transaction_types -->
    <!-- amount -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
           <label class="control-label">Amount</label>
             <input type="text" class="form-control" name="amount" value="{!! isset($data->amount) ? $data->amount : old('amount') !!}" required="" readonly="">
         </div>
     </div>
    <!-- end amount -->
    @if(isset($data) ? $data->transaction_type_id == 1 : $type == 1)
    <!-- invoice -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
            <label class="control-label">Invoice</label>
            <div class="clearfix"></div>
                <input type="checkbox" class="make-switch" name="invoice" data-on-color="success" data-off-color="default" data-on-text="Yes" data-off-text="No" disabled="" {{ (isset($data) && $data->invoice == 1) ? 'checked':'' }} >
        </div>
    </div>
    <!-- invoice -->
    @endif
  </div>
  
  <div class="row">
    <!-- note -->
    <div class="form-group col-md-12">
         <div class="col-md-10">
           <label class="control-label">Note</label>
           <textarea id="" cols="30" rows="5" class="form-control" name="note">{{ isset($data->note) ? $data->note:'' }}</textarea>
         </div>
     </div>
    <!-- end note -->
  </div>

  <!-- end row -->
  
</div>
<!-- end form body -->

<div class="form-actions">
    <a href="{{ route('transactions.edit', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
    <a href="{{ route('transactions.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
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
