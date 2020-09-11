<div class="form-body">
   {!! csrf_field() !!}

   <div class="col-3">
     <img src="{{ $data->profile_photo }}" alt="" class="img-fluid" id="img_profile_photo" style="max-width: 70%;">
     <a href="#" class="btn btn-success" id="btn-reupload">Reupload</a>
     <form id="upload_img_form" enctype="multipart/form-data" action="{{ route('talents.update.profile_photo', ['id' => $data->id]) }}" class="form" style="display: none;">
     {{ csrf_field() }}
       <input type="file" name="main_image" class="form-control" required>
       <a type="submit" class="btn btn-success" id="btn-upload">Upload</a>
       <a class="btn btn-warning" id="btn-cancel-upload">Cancel</a>
     </form>
   </div>
  <div class="col-sm-10">
    <!-- first name -->
    <div class="row">
      <div class="form-group col-md-3">
           <div class="col-md-12">
             <label class="control-label">First Name</label>
               <input type="text" class="form-control" name="first_name" value="{!! isset($data->first_name) ? $data->first_name : old('first_name') !!}" readonly="">
           </div>
       </div>
      <!-- end first name -->
      <!-- last name -->
      <div class="form-group col-md-3">
           <div class="col-md-12">
             <label class="control-label">Last Name</label>
               <input type="text" class="form-control" name="last_name" value="{!! isset($data->last_name) ? $data->last_name : old('last_name') !!}" readonly="">
           </div>
       </div>
      <!-- end last name -->
      <!-- public name -->
      <div class="form-group col-md-2">
           <div class="col-md-12">
             <label class="control-label">Public Name</label>
               <input type="text" class="form-control" name="public_name" value="{!! isset($data->public_name) ? $data->public_name : old('public_name') !!}" readonly="">
           </div>
       </div>
      <!-- end public name -->
      <!-- sex dd -->
      <div class="form-group col-md-2">
          <div class="col-md-12">
            <label class="control-label">Sex</label>
             <select class="form-control" name="sex" disabled="">
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
              <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->dob) ? $data->dob : old('dob') !!}" name="dob" readonly=""/>
          </div>
      </div>
      <!-- end dob -->
    </div>
    <!-- end row -->
    
    <div class="row">
      <!-- password -->
      <div class="form-group col-md-4">
           <div class="col-md-12">
             <label class="control-label">Password</label>
               <input type="password" class="form-control" name="password" value="" disabled="">
           </div>
       </div>
      <!-- end password -->
      <!-- model_share -->
      <div class="form-group col-md-4">
           <div class="col-md-12">
             <label class="control-label">Revenue Share %</label>
               <input type="text" class="form-control" name="model_share" value="{!! isset($data->model_share) ? $data->model_share : old('model_share') !!}" disabled="">
           </div>
       </div>
      <!-- end model_share -->
      <!-- status dd -->
      <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Status</label>
             <select class="form-control" name="status" disabled="">
             <option value="">Select Status</option>
              @foreach(config('constants.models.status') as $key => $value)
                <option value="{{ $key }}" {{ (isset($data->status) && ( $key == $data->status ) || (old('status') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
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
             <select class="form-control" name="province_id" disabled="">
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
             <select class="form-control" name="doc_type" disabled="">
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
               <input type="text" class="form-control" name="doc_number" value="{!! isset($data->doc_number) ? $data->doc_number : old('doc_number') !!}" readonly="">
           </div>
       </div>
      <!-- end doc_number-->
      <!-- doc_expire -->
      <div class="form-group col-md-3">
          <div class="col-md-12">
          <label class="control-label">Doc Expire</label>
              <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="{!! isset($data->doc_expire) ? $data->doc_expire : old('doc_expire') !!}" name="doc_expire" readonly=""/>
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
               <input type="email" class="form-control" name="email" value="{!! isset($data->email) ? $data->email : old('email') !!}" readonly="">
           </div>
       </div>
      <!-- end email -->
      <!-- Mobile -->
      <div class="form-group col-md-4">
           <div class="col-md-12">
             <label class="control-label">Mobile</label>
               <input type="text" class="form-control" name="mobile" value="{!! isset($data->mobile) ? $data->mobile : old('mobile') !!}" readonly="">
           </div>
       </div>
      <!-- end Mobile -->
      <!-- country dd -->
      <div class="form-group col-md-4">
          <div class="col-md-12">
            <label class="control-label">Country</label>
             <select class="form-control" name="country_id" disabled="">
             <option value="">Select a Country</option>
              @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ (isset($data->country_id) && ( $country->id == $data->country_id ) || (old('country_id') == $country->id)) ? 'selected' : ''}}>{{ ucfirst($country->name) }}</option>
              @endforeach
             </select>
          </div>
      </div>
      <!-- end country dd -->
    </div>
    <!-- end row -->
  </div>
  <div class="row">
    <!-- ethnicity dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Ethnicity</label>
           <select class="form-control" name="ethnicity_id" disabled="">
           <option value="">Select Ethnicity</option>
            @foreach($ethnicities as $ethnicity)
              <option value="{{ $ethnicity->id }}" {{ (isset($data->ethnicity_id) && ( $ethnicity->id == $data->ethnicity_id ) || (old('ethnicity_id') == $ethnicity->id)) ? 'selected' : ''}}>{{ ucfirst($ethnicity->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end ethnicity dd -->
    <!-- hair dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Hair</label>
           <select class="form-control" name="hair_id" disabled="">
           <option value="">Select Hair</option>
            @foreach($hairs as $hair)
              <option value="{{ $hair->id }}" {{ (isset($data->hair_id) && ( $hair->id == $data->hair_id ) || (old('hair_id') == $hair->id)) ? 'selected' : ''}}>{{ ucfirst($hair->name) }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end hair dd -->
    <!-- eyes dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Eyes</label>
           <select class="form-control" name="eyes_id" disabled="">
           <option value="">Select Eyes</option>
            @foreach($eyes as $eye)
              <option value="{{ $eye->id }}" {{ (isset($data->eyes_id) && ( $eye->id == $data->eyes_id ) || (old('eyes_id') == $eye->id)) ? 'selected' : ''}}>{{ ucfirst($eye->name) }}</option>
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
             <input type="text" class="form-control" name="height" value="{!! isset($data->height) ? $data->height : old('height') !!}" readonly="">
         </div>
     </div>
    <!-- end Height -->
    <!-- bust -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Bust (cm)</label>
             <input type="text" class="form-control" name="bust" value="{!! isset($data->bust) ? $data->bust : old('bust') !!}" readonly="">
         </div>
     </div>
    <!-- end bust -->
    <!-- body dd -->
    <div class="form-group col-md-4">
        <div class="col-md-12">
          <label class="control-label">Body Type</label>
           <select class="form-control" name="body" disabled="">
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
             <input type="number" min="1" max="99" class="form-control" name="age_look_from" value="{!! isset($data->age_look_from) ? $data->age_look_from : old('age_look_from') !!}" readonly>
         </div>
     </div>
    <!-- end age_look_from -->
    <!-- age_look_to -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Age Look To</label>
             <input type="number" min="1" max="99" class="form-control" name="age_look_to" value="{!! isset($data->age_look_to) ? $data->age_look_to : old('age_look_to') !!}" readonly>
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
                    <input disabled class="check1" type="checkbox" name="languages[]" value="{{ $i->id }}" {{ isset($data) && $data->languages->contains($i->id) || ((old('languages') !== null) && in_array($i->id, old('languages'))) ? 'checked':''}}/>
                    <label class='logged'></label>
                </span>
                <div> {{ $i->name }} </div>
            </div>
        </div>
        <div class="col-8">
          <label>
            <select disabled name="levels[{{$i->id}}]" class="form-control">
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
                      <input disabled class="check1" type="checkbox" name="features[]" value="{{ $j->id }}" {{ isset($data) && $data->features->contains($j->id) || (old('features') !== null && in_array($j->id, old('features')))? 'checked':''}}/>
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

</div>
<!-- end form body -->

<hr>
<div class="row justify-content-center">
  <div class="col-8">
    <div class="tabbable-line">
        <ul class="nav nav-tabs ">
            <li class="nav-item">
                <a class="nav-link active" href="#tab_availabilities" data-toggle="tab" role="tab"> Availabilities </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab_notes" data-toggle="tab" role="tab"> Notes </a>
            </li>
            
        </ul>
        @if(Session::has('note-message'))
            <div class="alert alert-success">
                {{ Session::get('note-message') }}
            </div>
        @endif
        <div class="tab-content py-3">

            <div class="tab-pane" id="tab_notes">
                <div class="row justify-content-center">
                  <div class="col-8">
                    
                    <form action="{{ route('notes.store') }}" method="post">
                      <div class="input-group">
                        <textarea type="text" class="form-control" placeholder="New note..." name="note"></textarea>
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $data->id }}" name="owner_id">
                        <input type="hidden" value="2" name="owner">
                        <span class="input-group-btn">
                          <button class="btn btn-success" type="submit">Add Note</button>
                        </span>
                      </div>
                    </form>

                  </div>
                </div>
                <hr>
                <br>
                <div class="list-group">
                  @foreach($notes as $note)
                  <div class="row justify-content-center">
                    <div class="col-8">
                      <div href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">{{ 'By '.$note->created_by.' on '.$note->formatted_created_at }}</h4>
                        <p class="list-group-item-text">{!! nl2br($note->note) !!}</p>
                        <a href="{{ route('notes.update', ['id' => $note->id]) }}" data-content="{!! ($note->note) !!}" class="btn-edit-note btn btn-primary col-xs-2">Edit</a>
                        <a href="{{ route('notes.destroy', ['id' => $note->id]) }}" class="btn-delete-note btn btn-danger col-xs-2">Delete</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>

            <div class="tab-pane active" id="tab_availabilities">
                <div class="row justify-content-center">
                  <div class="col-9">
                    
                    <form action="{{ route('availabilities.store') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" value="{{ $data->id }}" name="model_id">
                      <div class="form-group">
                        <label for="" class="control-label col-md-3">Type: </label>
                        <div class="col-md-9">
                          <select name="type" id="" class="form-control" required="">
                            @foreach(config('constants.availabilities.types') as $key => $val)
                              <option value="{{ $key }}">{{ ucfirst($val) }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!-- from to date -->
                      <div class="form-group">
                          <label class="control-label col-md-3">Date From: </label>
                          <div class="col-md-9">
                              <div class="input-group input-large date-picker input-daterange">
                                  
                                  <input type="text" class="form-control" name="starts_at" required="">
                                  <span class="input-group-append input-group-text"> To </span>
                                  <input type="text" class="form-control" name="ends_at" required="">
                                  
                              </div>
                              <span class="input-group-append">
                                <button class="btn btn-success" type="submit">Add Availability</button>
                              </span>
                              <!-- /input-group -->
                              <span class="help-block"> Select date range </span>
                          </div>
                      </div>
                      <!-- end from to date-->
                    </form>

                  </div>
                </div>

                <hr>
                
                <div class="row justify-content-center">
                  <div class="col-8">
                    <table class="table">
                      <thead>
                        <th>Starts At</th>
                        <th>Ends At</th>
                        <th>Actions</th>
                      </thead>
                      <tbody>
                        @foreach($availabilities as $availability)
                          <tr>
                            <td>{{ Carbon\Carbon::parse($availability->starts_at)->format('m/d/Y')}}</td>
                            <td>{{ Carbon\Carbon::parse($availability->ends_at)->format('m/d/Y')}}</td>
                            <td>
                              <a href="{{ route('availabilities.edit', ['id' => $availability->id]) }}" class="btn btn-edit-availability btn-info">Edit</a>
                              <a href="{{ route('availabilities.destroy', ['id' => $availability->id]) }}" class="btn btn-delete-availability btn-danger">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                
            </div>
        </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-12">
  <a href="{{ route('talents.edit', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
    @if(Auth::guard('admin')->user()->role == 1)
    <a href="{{ route('talents.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
    @endif
  </div>
    
</div>



@push('css')
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@endpush
@push('js_plugins')
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
@endpush

@push('js')
<script src="http://assets.unitests.com/admin_assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="http://assets.unitests.com/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script>
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
                window.location.href = r.redirect;
              },
            });
          }
        },
      });
    }); 


    //edit note

    $('.btn-edit-note').click(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      var content = $(this).data('content');
      bootbox.prompt({
          title: "Edit Note",
          inputType: 'textarea',
          value: content,
          callback: function (result) {
              
              $.ajax({
                url:url,
                data:{note:result},
                type:'PATCH',
                success: function() {
                  location.reload();
                },
              });
          }
      });
    }); 

    // delete note

    $('.btn-delete-note').click(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      bootbox.confirm({
        message: 'Are you sure you want to delete this note?',
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
                location.reload();
              },
            });
          }
        },
      });
    });

    // delete availability

    $('.btn-delete-availability').click(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      bootbox.confirm({
        message: 'Are you sure you want to delete this availability?',
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
                location.reload();
              },
            });
          }
        },
      });
    });

    //edit availability

    $('.btn-edit-availability').click(function (e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $.get(url).done(function(r) {
        bootbox.dialog({
        title: "Edit Availability",
        message: r.view,
        buttons: {
          cancel: {
            label: 'Cancel',
            className: 'btn-default',
          },

          ok: {
            label: 'Save changes',
            className: 'btn-info',
            callback: function() {
              var form = $(r.target);
              form.submit();
            },
          },
        },
      });
      }).fail(function() {
        alert("edit error!")
      });
      
    });

    
    //reupload image
    $('#btn-reupload').click(function(e) {
      e.preventDefault();
      $(this).hide();
      $('#upload_img_form').show();
    });

    $('#btn-cancel-upload').click(function(e) {
      e.preventDefault();
      $('#upload_img_form').hide();
      $('#btn-reupload').show();
    });

    $('#btn-upload').click(function(e) {
      e.preventDefault();
      var form = $('#upload_img_form');
      var formData = new FormData(form[0]);
      var url = form.attr('action');
      console.log(formData);
      bootbox.dialog({
          message: '<p><i class="fa fa-spin fa-spinner"></i> Uploading...</p>'
      });
      $.ajax({
        type:'POST',
        data:formData,
        url:url,
        processData: false,
        contentType: false,
        success: function(r) {
          r = JSON.parse(r);
          location.reload();
          bootbox.hideAll();

        },
        error: function (r) {
          alert('Something went wrong');
          bootbox.hideAll();
        } 
      });
    });
</script>
@endpush

