<div class="form-body">
   {!! csrf_field() !!}
   <div class="form-group mb-3">
       <label class="control-label col-md-3">Upload Main Photo (600x800 jpg only)</label>
       <div class="col-md-9">
             <div class="fileinput fileinput-new" data-provides="fileinput">
                 <div class="fileinput-new thumbnail" style="width: 300px; height: 400px;">
                     <img src="{{ isset($data->main_photo) ? $data->profile_photo:'http://www.placehold.it/600x800/EFEFEF/AAAAAA'}}" alt="" /> </div>
                 <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 400px;"> </div>
                 <div>
                     <span class="btn btn-secondary btn-file">
                         <span class="fileinput-new"> Select image </span>
                         <span class="fileinput-exists"> Change </span>
                         <input type="file" name="main_photo"> </span>
                     <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                 </div>
             </div>
       </div>
   </div>
  <!-- first name -->
  <div class="row">
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">First Name</label>
             <input type="text" class="form-control" name="first_name" value="{!! isset($data->first_name) ? $data->first_name : old('first_name') !!}">
         </div>
     </div>
    <!-- end first name -->
    <!-- last name -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Last Name</label>
             <input type="text" class="form-control" name="last_name" value="{!! isset($data->last_name) ? $data->last_name : old('last_name') !!}">
         </div>
     </div>
    <!-- end last name -->
    <!-- public name -->
    <div class="form-group col-md-2">
         <div class="col-md-12">
           <label class="control-label">Public Name</label>
             <input type="text" class="form-control" name="public_name" value="{!! isset($data->public_name) ? $data->public_name : old('public_name') !!}">
         </div>
     </div>
    <!-- end public name -->
    <!-- sex dd -->
    <div class="form-group col-md-2">
        <div class="col-md-12">
          <label class="control-label">Sex</label>
           <select class="form-control" name="sex">
              <option value="">Select Sex</option>
            @foreach(config('constants.models.sex') as $key => $value)
              <option value="{{ $key }}" {{ (isset($data->sex) && ( $key == $data->sex ) || (old('sex') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end sex dd -->
    <!-- dob -->
    <div class="form-group col-md-2">
        <div class="col-md-12">
        <label class="control-label">Date of Birth</label>
            <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->dob) ? $data->dob : old('dob') !!}" name="dob" data-date-end-date="{{ Carbon\Carbon::now()->format('m/d/Y') }}"/>
        </div>
    </div>
    <!-- end dob -->
  </div>
  <!-- end row -->
  
  <div class="row">
    <!-- password -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Password</label>
             <input type="password" class="form-control" name="password" value="">
         </div>
     </div>
    <!-- end password -->
    <!-- model_share -->
    <div class="form-group col-md-2">
         <div class="col-md-12">
           <label class="control-label">Revenue Share %</label>
             <input type="text" class="form-control" name="model_share" value="{!! isset($data->model_share) ? $data->model_share : old('model_share') !!}">
         </div>
     </div>
    <!-- end model_share -->
    <!-- status dd -->
    <div class="form-group col-md-2">
        <div class="col-md-12">
          <label class="control-label">Status</label>
           <select class="form-control" name="status" required>
           <option value="">Select Status</option>
            @foreach(config('constants.models.status') as $key => $value)
              <option value="{{ $key }}" {{ (isset($data->status) && ( $key == $data->status ) || (old('status') !== null && old('status') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end status dd -->
  </div>
  <!-- end row -->
  <div class="row">
    <!-- province_id dd -->
    <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Location</label>
           <select class="form-control" name="province_id" required="">
           <option value="">Select Location</option>
            @foreach(App\Models\Province::all() as $item)
              <option value="{{ $item->id }}" {{ (isset($data->province_id) && ( $item->id == $data->province_id ) || (old('province_id') == $item->id)) ? 'selected' : ''}}>{{ ucfirst($item->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end province_id dd -->
    <!-- doc_type dd -->
    <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Doc Type</label>
           <select class="form-control" name="doc_type">
           <option value="">Select Doc Type</option>
            @foreach(config('constants.models.doc_type') as $key => $value)
              <option value="{{ $key }}" {{ (isset($data->doc_type) && ( $key == $data->doc_type ) || (old('doc_type') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end doc_type dd -->
    <!-- doc_number -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Doc Number</label>
             <input type="text" class="form-control" name="doc_number" value="{!! isset($data->doc_number) ? $data->doc_number : old('doc_number') !!}">
         </div>
     </div>
    <!-- end doc_number-->
    <!-- doc_expire -->
    <div class="form-group col-md-3">
        <div class="col-md-12">
        <label class="control-label">Doc Expire</label>
            <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->doc_expire) ? $data->doc_expire : old('doc_expire') !!}" name="doc_expire" data-date-start-date="{{ Carbon\Carbon::now()->format('m/d/Y') }}"/>
        </div>
    </div>
    <!-- end doc_expire -->
  </div>
  <!-- end row -->
  
  <div class="row">
    <!-- email -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
           <label class="control-label">Email</label>
             <input type="email" class="form-control" name="email" value="{!! isset($data->email) ? $data->email : old('email') !!}">
         </div>
     </div>
    <!-- end email -->
    <!-- Mobile -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
           <label class="control-label">Mobile</label>
             <input type="text" class="form-control" name="mobile" value="{!! isset($data->mobile) ? $data->mobile : old('mobile') !!}">
         </div>
     </div>
    <!-- end Mobile -->
    <!-- country dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Country</label>
           <select class="form-control" name="country">
           <option value="">Select Country</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}" {{ (isset($data->country_id) && ( $country->id == $data->country_id ) || (old('country') == $country->id)) ? 'selected' : ''}}>{{ ucfirst($country->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end country dd -->
  </div>
  <!-- end row -->
  <div class="row">
    <!-- ethnicity dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Ethnicity</label>
           <select class="form-control" name="ethnicity">
           <option value="">Select Ethnicity</option>
            @foreach($ethnicities as $ethnicity)
              <option value="{{ $ethnicity->id }}" {{ (isset($data->ethnicity_id) && ( $ethnicity->id == $data->ethnicity_id ) || (old('ethnicity') == $ethnicity->id)) ? 'selected' : ''}}>{{ ucfirst($ethnicity->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end ethnicity dd -->
    <!-- hair dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Hair</label>
           <select class="form-control" name="hair">
           <option value="">Select Hair</option>
            @foreach($hairs as $hair)
              <option value="{{ $hair->id }}" {{ (isset($data->hair_id) && ( $hair->id == $data->hair_id ) || (old('hair') == $hair->id)) ? 'selected' : ''}}>{{ ucfirst($hair->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end hair dd -->
    <!-- eyes dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Eyes</label>
           <select class="form-control" name="eyes">
           <option value="">Select Eyes</option>
            @foreach($eyes as $eye)
              <option value="{{ $eye->id }}" {{ (isset($data->eyes_id) && ( $eye->id == $data->eyes_id ) || (old('eyes') == $eye->id)) ? 'selected' : ''}}>{{ ucfirst($eye->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end eyes dd -->
  </div>
  <!-- end row -->
  
  <div class="row">
    <!-- Height -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Height (cm)</label>
             <input type="text" class="form-control" name="height" value="{!! isset($data->height) ? $data->height : old('height') !!}">
         </div>
     </div>
    <!-- end Height -->
    <!-- bust -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Bust (cm)</label>
             <input type="text" class="form-control" name="bust" value="{!! isset($data->bust) ? $data->bust : old('bust') !!}">
         </div>
     </div>
    <!-- end bust -->

    <!-- body dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Body Type</label>
           <select class="form-control" name="body">
           <option value="">Select Body Type</option>
            @foreach(\App\Models\Body::orderBy('name', 'asc')->get() as $i)
              <option value="{{ $i->id }}" {{ (isset($data->body) && ( $i->id == $data->body ) || (old('eyes') == $i->id)) ? 'selected' : ''}}>{{ ucfirst($i->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end body dd -->
    
    <!-- age_look_from -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Age Look From</label>
             <input type="number" min="1" max="99" class="form-control" name="age_look_from" value="{!! isset($data->age_look_from) ? $data->age_look_from : old('age_look_from') !!}">
         </div>
     </div>
    <!-- end age_look_from -->
    <!-- age_look_to -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Age Look To</label>
             <input type="number" min="1" max="99" class="form-control" name="age_look_to" value="{!! isset($data->age_look_to) ? $data->age_look_to : old('age_look_to') !!}">
         </div>
     </div>
    <!-- end age_look_to -->
  </div>
  <!-- end row -->
  
  <!-- Features -->
  <hr>
  <div class="row justify-content-center">

    <div class="row mb-5 justify-content-center">
    <div class="col-10">
      <h2 class="mb-3">Languages</h2>
      <div class="row justify-content-center">
        @foreach(\App\Models\Language::get() as $i)
        <div class="col-4">
            <div class="check-holder">
                <span class="input-holder">
                    <input class="check1" type="checkbox" name="languages[]" value="{{ $i->id }}" {{ isset($data) && $data->languages->contains($i->id) || ((old('languages') !== null) && in_array($i->id, old('languages'))) ? 'checked':''}}/>
                    <label class='logged'></label>
                </span>
                <div> {{ $i->name }} </div>
            </div>
        </div>
        <div class="col-8">
          <label>
            <select name="levels[{{$i->id}}]" class="form-control">
              @php
                $level=0;
                if(isset($data) && $data->languages->contains($i->id)) {
                  $level = $data->languages->find($i->id)->pivot->level;
                }
              @endphp
              @foreach(config('constants.models.level') as $k => $v)
              <option value="{{ $k }}" {{ isset($data) && $level == $k || old('levels')[$i->id] == $k ? 'selected' : '' }}>{{ $v }}</option>
              @endforeach
            </select>
          </label>
        </div>
        @endforeach
      </div>
    </div>
  </div>
      
      <!-- features -->
      <div class="row justify-content-center">

        <div class="col-10">
        <h2 class="mb-3">Features</h2>
        
        @foreach(App\Models\FeaturesCategory::orderBy('seq')->get() as $i)
        <div class="row mb-3">
            <div class="col-12">
              <h3>{{ $i->name }}</h3>
            </div>
        </div>
            <div class="row">
            @foreach($i->features as $j)
            <div class="col-md-2">
                <div class="check-holder">
                  <span class="input-holder">
                      <input class="check1" type="checkbox" name="features[]" value="{{ $j->id }}" {{ isset($data) && $data->features->contains($j->id) || (old('features') !== null && in_array($j->id, old('features')))? 'checked':''}}/>
                      <label class='logged'></label>
                  </span>
                  <div> {{ $j->name }} </div>
                </div>
            </div>
            @endforeach
            </div>
            
        <br>
        @endforeach
        </div>
        
      
        
      </div>

    </div>
    
  </div>

  <div class="col-12">
      <button type="submit" class="btn btn-primary float-right">Save</button>
      <a href="{{ route('talents.index') }}" class="btn btn-secondary float-right">Cancel</a>
  </div>

</div>
<!-- end form body -->


@push('css')
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endpush
@push('js_plugins')
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@endpush
@push('js')
<script src="http://assets.unitests.com/admin_assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@endpush
