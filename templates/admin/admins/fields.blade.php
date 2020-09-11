<div class="form-body row">
   {!! csrf_field() !!}   
    <!-- title dd -->
    <div class="form-group col-md-3">
       <div class="col-md-12">
         <label class="control-label">Title</label>
         <select class="form-control" name="title" required="">
         <option value="">Select a Title</option>
         @foreach(config('constants.admins.title') as $key => $value)
         <option value="{{ $key }}" {{ (isset($data->title) && ( $key == $data->title ) || (old('title') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
         @endforeach
         </select>
       </div>
    </div>
    <!-- end title dd -->

     <!-- name -->
     <div class="form-group col-md-3">
          <div class="col-md-12">
            <label class="control-label">First Name</label>
          <input type="text" class="form-control" name="first_name" value="{!! isset($data->first_name) ? $data->first_name : old('first_name') !!}" required>
          </div>
      </div>
     <!-- end name -->
     <!-- last_name -->
     <div class="form-group col-md-3">
          <div class="col-md-12">
            <label class="control-label">Last Name</label>
          <input type="text" class="form-control" name="last_name" value="{!! isset($data->last_name) ? $data->last_name : old('last_name') !!}" required>
          </div>
      </div>
     <!-- end legal_name -->
     <!-- nick name -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Nick Name (Optional)</label>
          <input type="text" class="form-control" name="nick_name" value="{!! isset($data->nick_name) ? $data->nick_name : old('nick_name') !!}">
        </div>
      </div>
     <!-- end nick name -->

     <!-- email -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Email</label>
          <input type="email" class="form-control" name="email" value="{!! isset($data->email) ? $data->email : old('email') !!}" required="">
        </div>
      </div>
     <!-- end email -->

     <!-- email -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Password</label>
          <input type="password" class="form-control" name="password" value="{!! isset($data->password) ? $data->password : old('password') !!}">
        </div>
      </div>
     <!-- end email -->
     <!-- role dd -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Role</label>
          <select class="form-control" name="role" required="">
          <option value="">Select a Role</option>
          @foreach(config('constants.admins.roles') as $key => $value)
          <option value="{{ $key }}" {{ (isset($data->role) && ( $key == $data->role ) || (old('role') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
          @endforeach
          </select>
        </div>
     </div>
     <!-- end role dd -->

     <!-- status dd -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Status</label>
          <select class="form-control" name="status" required="">
          @foreach(config('constants.admins.status') as $key => $value)
          <option value="{{ $key }}" {{ (isset($data->status) && ( $key == $data->status ) || (old('status') == $key)) ? 'selected' : ''}}>{{ ucfirst($value) }}</option>
          @endforeach
          </select>
        </div>
     </div>
     <!-- end status dd -->

     <!-- mobile -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Mobile</label>
          <input type="text" class="form-control" name="mobile" value="{!! isset($data->mobile) ? $data->mobile : old('mobile') !!}" required="">
        </div>
      </div>
     <!-- end mobile -->
     <!-- line -->
     <div class="form-group col-md-3">
        <div class="col-md-12">
          <label class="control-label">Line (Optional)</label>
          <input type="text" class="form-control" name="line" value="{!! isset($data->line) ? $data->line : old('line') !!}">
        </div>
      </div>
     <!-- end line -->
     <div class="form-group col-12">
       <div class="col-12">
          <button type="submit" class="btn btn-primary float-right">Save</button>
          <a href="{{ route('admins.index') }}" class="btn btn-secondary float-right">Cancel</a>
       </div>
        
     </div>
</div>




