<div class="form-body">
   {!! csrf_field() !!}

  <input type="hidden" name="this_transaction_type" value="{{ $type }}">

  
  <div class="row">
  <!-- happened_at -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
        <label class="control-label">Happened At</label>
            <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->happened_at) ? $data->happened_at : old('happened_at') !!}" name="happened_at" required="" />
        </div>
    </div>
    <!-- end happened_at autocomplete with photo-->
    <!-- model -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
         <input type="hidden" id="model_id" name="model_id" value="{!! isset($data->model_id) ? $data->model_id : old('model_id') !!}" required="">
           <label class="control-label">Model</label>
             <input type="text" id="model_search" class="form-control" name="model" value="{!! isset($data->model->search_name) ? $data->model->search_name : old('model') !!}" required="">
         </div>
     </div>
    <!-- end model -->

    

    @if(isset($data) ? $data->transaction_type_id == 1 : $type == 1)
    <!-- customer autocomplete-->
    <div class="form-group col-md-4">
         <div class="col-md-12">
            <input type="hidden" id="customer_id" name="customer_id" value="{!! isset($data->customer_id) ? $data->customer_id : old('customer_id') !!}" required="">
           <label class="control-label">Customer</label>
             <input type="text" class="form-control" id="customer_search" name="customer" value="{!! isset($data->customer->search_name) ? $data->customer->search_name : old('customer') !!}" required="">
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
           <select class="form-control" name="transaction_type_id" required="">
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
             <input type="text" class="form-control" name="amount" value="{!! isset($data->amount) ? $data->amount : old('amount') !!}" required="">
         </div>
     </div>
    <!-- end amount -->
    @if(isset($data) ? $data->transaction_type_id == 1 : $type == 1)
    <!-- invoice -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
            <label class="control-label">Invoice</label>
            <div class="clearfix"></div>
                <input type="checkbox" class="make-switch" name="invoice" data-on-color="success" data-off-color="default" data-on-text="Yes" data-off-text="No" {{ (isset($data) && $data->invoice == 1) ? 'checked':'' }}>
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
    <button type="submit" class="btn btn-primary float-right">Save</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary float-right">Cancel</a>
</div>

@push('css')
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="http://assets.unitests.com/admin_assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
@endpush
@push('important_css')
<style>
.ui-state-active h4,
.ui-state-active h4:visited {
    color: #26004d ;
}

.ui-menu-item{
    display: flex;
    border: 1px solid #ececf9;
}

.ui-widget-content .ui-state-active {
    background-color: white !important;
    border: none !important;
}
.list_item_container {
    display: flex;
    float: left;
    margin-left: 20px;
}
.ui-widget-content .ui-state-active .list_item_container {
    background-color: #f5f5f5;
}

.image img{
    width: 40px;
    height : 50px;
}
.label{
    width: 85%;
    float:right;
    white-space: nowrap;
    overflow: hidden;
    color: rgb(124,77,255);
    text-align: left;
}
input:focus{
    background-color: #f5f5f5;
}

</style>
@endpush
@push('js_plugins')
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
@endpush
@push('js')
<script src="http://assets.unitests.com/admin_assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function(){

      //model autocomplete
      $("#model_search").autocomplete({
              source: "{{ route('models.autocomplete') }}",
                  focus: function( event, ui ) {
                  $( "#model_search" ).val( ui.item.search_name );
                  //$( "#model_id" ).val( ui.item.id ); // uncomment this line if you want to select value to search box  
                  return false;
              },
              select: function( event, ui ) {
                event.preventDefault();
                  $( "#model_id" ).val( ui.item.id );
              }
          }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
              var inner_html = '<div class="list_item_container col-md-12"><div class="image col-xs-3"><img src="' + item.image + '" ></div><div class="label col-xs-9"><h4><b>' + item.search_name + '</b></h4></div></div>';
              return $( "<li></li>" )
                      .data( "item.autocomplete", item )
                      .append(inner_html)
                      .appendTo( ul );
          };

      $("#customer_search").autocomplete({
              source: "{{ route('customers.autocomplete') }}",
              focus: function( event, ui ) {
                  $( "#customer_search" ).val( ui.item.search_name );
                  return false;
              },
              select: function( event, ui ) {
                event.preventDefault();
                  $( "#customer_id" ).val( ui.item.id );
              }
          }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
              var inner_html = "<span>"+item.search_name+"</span>";
              return $( "<li></li>" )
                      .data( "item.autocomplete", item )
                      .append(inner_html)
                      .appendTo( ul );
          };

  });
</script>
@endpush
