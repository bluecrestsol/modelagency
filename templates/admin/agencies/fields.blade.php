<div class="form-body">
   {!! csrf_field() !!}
   <div class="row">
     <!-- name -->
     <div class="form-group col-md-3">
          <div class="col-md-12">
            <label class="control-label">Name</label>
          <input type="text" class="form-control" name="name" value="{!! isset($data->name) ? $data->name : old('name') !!}">
          </div>
      </div>
     <!-- end name -->
     <!-- legal_name -->
     <div class="form-group col-md-3">
          <div class="col-md-12">
            <label class="control-label">Legal Name</label>
          <input type="text" class="form-control" name="legal_name" value="{!! isset($data->legal_name) ? $data->legal_name : old('legal_name') !!}">
          </div>
      </div>
     <!-- end legal_name -->
     <!-- password -->
     <div class="form-group col-md-2">
        <div class="col-md-12">
          <label class="control-label">Password</label>
          <input type="password" class="form-control" name="password" value="{!! isset($data->password) ? $data->password : old('password') !!}">
        </div>
      </div>
     <!-- end password -->
     <!-- status dd -->
     <div class="form-group col-md-2">
        <div class="col-md-12">
          <label class="control-label">Status</label>
          <select class="form-control" name="status">
          @foreach(config('constants.agencies.status') as $key => $value)
          <option value="{{ $key }}" {{ (isset($data->status) && ( $key == $data->status ) || (old('status') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
          @endforeach
          </select>
        </div>
     </div>
     <!-- end status dd -->
     <!-- share -->
     <div class="form-group col-md-2">
       <div class="col-md-12">
         <label class="control-label">Revenue Share %</label>
         <input type="text" class="form-control" name="share" value="{!! isset($data->share) ? $data->share : old('share') !!}">
       </div>
      </div>
     <!-- end share -->
   </div>
  

  <div class="row">
    <!-- address line 1 -->
    <div class="form-group col-md-6">
     <div class="col-md-12">
        <label class="control-label">Address Line 1</label>
        <input type="text" class="form-control" name="address_line_1" value="{!! isset($data->address_line_1) ? $data->address_line_1 : old('address_line_1') !!}">
     </div>
     </div>
    <!-- end address line 1 -->
    <!-- address line 2 -->
    <div class="form-group col-md-6">
     <div class="col-md-12">
     <label class="control-label">Address Line 2</label>
         <input type="text" class="form-control" name="address_line_2" value="{!! isset($data->address_line_2) ? $data->address_line_2 : old('address_line_2') !!}">
     </div>
   </div>
    <!-- end address line 2 -->
  </div>

  <div class="row">
    <!-- City -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
         <label class="control-label">City</label>
             <input type="text" class="form-control" name="city" value="{!! isset($data->city) ? $data->city : old('city') !!}">
         </div>
     </div>
    <!-- end city -->
    <!-- Zip -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
         <label class="control-label">Zip</label>
             <input type="text" class="form-control" name="zip" value="{!! isset($data->zip) ? $data->zip : old('zip') !!}">
         </div>
     </div>
    <!-- end zip -->
    <!-- province -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
             <label class="control-label">Province</label>
             <input type="text" class="form-control" name="province" value="{!! isset($data->province) ? $data->province : old('province') !!}">
         </div>
     </div>
    <!-- end province -->
    <!-- country dd -->
    <div class="form-group col-md-3">
        <div class="col-md-12">
         <label class="control-label">Country</label>
           <select class="form-control" name="country_id">
              <option value="">Select a Country</option>
            @foreach($countries as $country)
              <option value="{!! $country->id !!}" {{ (isset($data->country_id) && ($country->id == $data->country_id ) || old('country_id') == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
            @endforeach
           </select>
        </div>
    </div>
    <!-- end country dd -->
  </div>

  <div class="row">
    <!-- tax -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
         <label class="control-label">Tax ID</label>
             <input type="text" class="form-control" name="tax" value="{!! isset($data->tax) ? $data->tax : old('tax') !!}">
         </div>
     </div>
    <!-- end tax -->
    <!-- website -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
            <label class="control-label">Website</label>
             <input type="text" class="form-control" name="website" value="{!! isset($data->website) ? $data->website : old('website') !!}">
         </div>
     </div>
    <!-- end website -->
    <!-- email -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Email</label>
             <input type="email" class="form-control" name="email" value="{!! isset($data->email) ? $data->email : old('email') !!}">
         </div>
     </div>
    <!-- end email -->
    <!-- phone -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Phone</label>

             <input type="text" class="form-control" name="phone" value="{!! isset($data->phone) ? $data->phone : old('phone') !!}">
         </div>
     </div>
    <!-- end phone -->
  </div>
  
  <div class="row">
    <!-- Contact person -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
           <label class="control-label">Contact Person</label>
             <input type="text" class="form-control" name="contact_person" value="{!! isset($data->contact_person) ? $data->contact_person : old('contact_person') !!}">
         </div>
     </div>
    <!-- end contact person -->
    <!-- Contact email -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
           <label class="control-label">Contact Email</label>
             <input type="email" class="form-control" name="contact_email" value="{!! isset($data->contact_email) ? $data->contact_email : old('contact_email') !!}">
         </div>
     </div>
    <!-- end contact email -->
    <!-- Contact mobile -->
    <div class="form-group col-md-4">
         <div class="col-md-12">
           <label class="control-label">Contact Mobile</label>
             <input type="text" class="form-control" name="contact_mobile" value="{!! isset($data->contact_mobile) ? $data->contact_mobile : old('contact_mobile') !!}">
         </div>
     </div>
    <!-- end contact mobile -->
  </div>
  

</div>
<!-- end form body -->

<div class="row">
  <div class="col-12">
      <button type="submit" class="btn btn-primary float-right">Save</button>
      <a href="{{ route('models.index') }}" class="btn btn-secondary float-right">Cancel</a>
  </div>
</div>



