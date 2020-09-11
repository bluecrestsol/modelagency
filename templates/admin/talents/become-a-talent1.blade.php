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
                        <span class="caption-subject bold uppercase"> Become A Talent</span>
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

                    
                    <form action="{{ route('become-a-talent.store') }}" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
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
                          <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                              <div class="row">
                                <h4><strong>Languages</strong></h4>
                                <hr>
                                  <div class="col-md-6">
                                    @foreach(App\Models\Language::all() as $i)
                                    <div class="col-md-4 checkbox">
                                      <label><input type="checkbox" name="languages[]" value="{{ $i->id }}" {{ isset($data) && $data->languages->contains($i->id) ? 'checked':''}}>{{ $i->name }}</label>
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
                                          <option value="{{ $k }}" {{ isset($data) && $level == $k || old('levels[$i]') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                          @endforeach
                                        </select>
                                      </label>
                                    </div>
                                    @endforeach
                                  </div>
                              </div>
                              
                              <!-- features -->
                              <div class="row">
                                
                                <h4><strong>Features</strong></h4>
                                <hr>
                                @foreach(App\Models\FeaturesCategory::orderBy('seq')->get() as $i)
                                <div class="col-md-12"><strong>{{ $i->name }}</strong></div>
                                    @foreach($i->features as $j)
                                    <div class="col-md-2">
                                      <div class="checkbox">
                                        <label><input type="checkbox" name="features[]" value="{{ $j->id }}" {{ isset($data) && $data->features->contains($j->id) ? 'checked':''}}>{{ $j->name }}</label>
                                      </div>
                                    </div>
                                    @endforeach
                                <br>
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
