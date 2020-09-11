<div class="row">
    <form action="{{ route('availabilities.update', $data->id) }}" method="post" id="edit-availability-form">
        {{ csrf_field() }}
        <input type="hidden" value="PATCH" name="_method">
        <div class="form-group col-xs-12">
            <label for="" class="control-label col-md-3">Type: </label>
            <div class="col-md-4">
                <select name="type" id="" class="form-control" required="">
                    @foreach(config('constants.availabilities.types') as $key => $val)
                    <option value="{{ $key }}" {{ $data->type == $key ? 'selected':'' }}>{{ ucfirst($val) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- from to date -->
        <div class="form-group col-xs-12">
            <label class="control-label col-md-3">Date From: </label>
            <div class="col-md-4">
                <div class="input-group input-large date-picker input-daterange">

                    <input type="text" class="form-control" name="starts_at" required="" value="{{ Carbon\Carbon::parse($data->starts_at)->format('m/d/Y') }}">
                    <span class="input-group-addon"> To </span>
                    <input type="text" class="form-control" name="ends_at" required="" value="{{ Carbon\Carbon::parse($data->ends_at)->format('m/d/Y') }}">
                </div>
                <!-- /input-group -->
                <span class="help-block"> Select date range </span>
            </div>
        </div>
        <!-- end from to date-->
    </form>
</div>


<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
