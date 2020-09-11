@extends('client.layout')
@section('title', ucfirst(Request::segment(2)))

@push('css')
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script>
 //init date pickers
 $('.date-picker').datepicker({
     autoclose: true
 });
</script>
@endpush
@section('content')
 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Become A Model</span>
                    </div>
                    <div class="actions">
                        
                    </div>
                </div>
                <div class="portlet-body form">

                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
                    <form action="{{ route('become-a-model.store') }}" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="POST">
                        <div class="form-body">
                           {!! csrf_field() !!}
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
                                     <input type="password" class="form-control" name="password" value="{!! isset($data->password) ? $data->password : old('password') !!}">
                                 </div>
                             </div>
                            <!-- end password -->

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
                                    <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->doc_expire) ? $data->doc_expire : old('doc_expire') !!}" name="doc_expire"  data-date-start-date="{{ Carbon\Carbon::now()->format('m/d/Y') }}"/>
                                </div>
                            </div>
                            <!-- end doc_expire -->
                            <!-- email -->
                            <div class="form-group col-md-3">
                                 <div class="col-md-12">
                                   <label class="control-label">Email</label>
                                     <input type="email" class="form-control" name="email" value="{!! isset($data->email) ? $data->email : old('email') !!}">
                                 </div>
                             </div>
                            <!-- end email -->
                            <!-- Mobile -->
                            <div class="form-group col-md-3">
                                 <div class="col-md-12">
                                   <label class="control-label">Mobile</label>
                                     <input type="text" class="form-control" name="mobile" value="{!! isset($data->mobile) ? $data->mobile : old('mobile') !!}">
                                 </div>
                             </div>
                            <!-- end Mobile -->
                            <!-- country dd -->
                            <div class="form-group col-md-3">
                                <div class="col-md-12">
                                  <label class="control-label">Country</label>
                                   <select class="form-control" name="country">
                                   <option value="">Select Country</option>
                                    @foreach(\App\Models\Country::orderBy('name')->get() as $country)
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
                                    @foreach(\App\Models\Ethnicity::orderBy('name')->get() as $ethnicity)
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
                                    @foreach(\App\Models\Hair::orderBy('name')->get() as $hair)
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
                                    @foreach(\App\Models\Eyes::orderBy('name')->get() as $eye)
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
                            <!-- waist -->
                            <div class="form-group col-md-2">
                                 <div class="col-md-12">
                                   <label class="control-label">Waist (cm)</label>
                                     <input type="text" class="form-control" name="waist" value="{!! isset($data->waist) ? $data->waist : old('waist') !!}">
                                 </div>
                             </div>
                            <!-- end waist -->
                            <!-- hips -->
                            <div class="form-group col-md-2">
                                 <div class="col-md-12">
                                   <label class="control-label">Hips (cm)</label>
                                     <input type="text" class="form-control" name="hips" value="{!! isset($data->hips) ? $data->hips : old('hips') !!}">
                                 </div>
                             </div>
                            <!-- end hips -->
                            <!-- shoes -->
                            <div class="form-group col-md-2">
                                 <div class="col-md-12">
                                   <label class="control-label">Shoes</label>
                                     <input type="text" class="form-control" name="shoes" value="{!! isset($data->shoes) ? $data->shoes : old('shoes') !!}">
                                 </div>
                             </div>
                            <!-- end shoes -->
                            <!-- shoulder -->
                            <!-- <div class="form-group col-md-2">
                                 <div class="col-md-12">
                                   <label class="control-label">Shoulder</label>
                                     <input type="text" class="form-control" name="shoulder" value="{!! isset($data->shoulder) ? $data->shoulder : old('shoulder') !!}" required="">
                                 </div>
                             </div> -->
                            <!-- end shoulder -->
                            <!-- collar -->
                            <!-- <div class="form-group col-md-2">
                                 <div class="col-md-12">
                                   <label class="control-label">Collar</label>
                                     <input type="text" class="form-control" name="collar" value="{!! isset($data->collar) ? $data->collar : old('collar') !!}" required="">
                                 </div>
                             </div> -->
                            <!-- end collar -->

                          </div>
                          <!-- end row -->
                          <hr>
                          <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                              <div class="col-md-6">
                                <h4>Languages</h4>
                                @foreach(\App\Models\Language::orderBy('name')->get() as $i)
                                <div class="col-md-4 checkbox">
                                  <label><input type="checkbox" name="languages[]" value="{{ $i->id }}" {{ isset($data) && $data->languages->contains($i->id) || ((old('languages') !== null) && in_array($i->id, old('languages'))) ? 'checked':''}}>{{ $i->name }}</label>
                                </div>
                                <div class="col-md-8">
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

                        </div>
                        <!-- end form body -->

                        <div class="form-actions right">
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
