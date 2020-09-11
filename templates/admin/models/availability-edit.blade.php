    <form action="{{ route('availabilities.update', $data->id) }}" method="post" id="edit-availability-form">
        {{ csrf_field() }}
        <div class="row">
        <input type="hidden" value="PATCH" name="_method">
        <div class="form-group col-12">
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
        <div class="form-group col-12">
            <label class="control-label col-12">Date From: </label>
            <div class="col-12">
                <div class="input-group input-large date-picker input-daterange">

                    <input type="text" class="form-control edit-availability-datepicker" name="starts_at" required="" value="{{ Carbon\Carbon::parse($data->starts_at)->format('m/d/Y') }}" readonly="readonly">
                    <span class="input-group-addon"> To </span>
                    <input type="text" class="form-control edit-availability-datepicker" name="ends_at" required="" value="{{ Carbon\Carbon::parse($data->ends_at)->format('m/d/Y') }}" readonly="readonly">
                </div>
                <!-- /input-group -->
                <span class="help-block"> Select date range </span>
            </div>
        </div>
        <!-- end from to date-->
    </div>
</form>

<script>
    $('.edit-availability-datepicker').datepicker({
        orientation: "left",
        autoclose: true
    });
</script>