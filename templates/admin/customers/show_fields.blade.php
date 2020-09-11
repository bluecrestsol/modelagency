<div class="form-body">
  {!! csrf_field() !!}

  <div class="row">
    <!-- name -->
    <div class="form-group col-md-3">
      <div class="col-md-12">
        <label class="control-label">Name</label>
        <input type="text" class="form-control" name="name" value="{!! isset($data->name) ? $data->name : old('name') !!}" readonly="">
      </div>
    </div>
    <!-- end name -->
    <!-- legal_name -->
    <div class="form-group col-md-3">
         <div class="col-md-12">
           <label class="control-label">Legal Name</label>
         <input type="text" class="form-control" name="legal_name" value="{!! isset($data->legal_name) ? $data->legal_name : old('legal_name') !!}" readonly="">
         </div>
     </div>
    <!-- end legal_name -->
    <!-- password -->
    <div class="form-group col-md-2">
      <div class="col-md-12">
        <label class="control-label">Password</label>
        <input type="password" class="form-control" name="password" value="" readonly="">
      </div>
    </div>
    <!-- end password -->
    <!-- status dd -->
    <div class="form-group col-md-2">
      <div class="col-md-12">
        <label class="control-label">Status</label>
        <select class="form-control" name="status" disabled="">
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
        <input type="text" class="form-control" name="share" value="{!! isset($data->share) ? $data->share : old('share') !!}" readonly="">
      </div>
    </div>
    <!-- end share -->
  </div> 
  <!-- end row -->

  <div class="row">
    <!-- address line 1 -->
    <div class="form-group col-md-6">
      <div class="col-md-12">
        <label class="control-label">Address Line 1</label>
        <input type="text" class="form-control" name="address_line_1" value="{!! isset($data->address_line_1) ? $data->address_line_1 : old('address_line_1') !!}" readonly="">
      </div>
    </div>
    <!-- end address line 1 -->
    <!-- address line 2 -->
    <div class="form-group col-md-6">
      <div class="col-md-12">
        <label class="control-label">Address Line 2</label>
        <input type="text" class="form-control" name="address_line_2" value="{!! isset($data->address_line_2) ? $data->address_line_2 : old('address_line_2') !!}" readonly="">
      </div>
    </div>
    <!-- end address line 2 -->
  </div>
  <!-- end row -->

  <div class="row">
    <!-- City -->
    <div class="form-group col-md-3">
      <div class="col-md-12">
        <label class="control-label">City</label>
        <input type="text" class="form-control" name="city" value="{!! isset($data->city) ? $data->city : old('city') !!}" readonly="">
      </div>
    </div>
    <!-- end city -->
    <!-- Zip -->
    <div class="form-group col-md-3">
      <div class="col-md-12">
        <label class="control-label">Zip</label>
        <input type="text" class="form-control" name="zip" value="{!! isset($data->zip) ? $data->zip : old('zip') !!}" readonly="">
      </div>
    </div>
    <!-- end zip -->
    <!-- province -->
    <div class="form-group col-md-3">
      <div class="col-md-12">
        <label class="control-label">Province</label>
        <input type="text" class="form-control" name="province" value="{!! isset($data->province) ? $data->province : old('province') !!}" readonly="">
      </div>
    </div>
    <!-- end province -->
    <!-- country dd -->
    <div class="form-group col-md-3">
      <div class="col-md-12">
        <label class="control-label">Country</label>
        <select class="form-control" name="country_id" disabled="">
          <option value="">Select a Country</option>
          @foreach($countries as $country)
          <option value="{!! $country->id !!}" {{ (isset($data->country_id) && ($country->id == $data->country_id ) || old('country_id') == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <!-- end country dd -->
  </div>
  <!-- end row -->

  <div class="row">
    <!-- website -->
    <div class="form-group col-md-4">
      <div class="col-md-12">
        <label class="control-label">Website</label>
        <input type="text" class="form-control" name="website" value="{!! isset($data->website) ? $data->website : old('website') !!}" readonly="">
      </div>
    </div>
    <!-- end website -->
    <!-- email -->
    <div class="form-group col-md-4">
      <div class="col-md-12">
        <label class="control-label">Email</label>
        <input type="email" class="form-control" name="email" value="{!! isset($data->email) ? $data->email : old('email') !!}" readonly="">
      </div>
    </div>
    <!-- end email -->
    <!-- phone -->
    <div class="form-group col-md-4">
      <div class="col-md-12">
        <label class="control-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{!! isset($data->phone) ? $data->phone : old('phone') !!}" readonly="">
      </div>
    </div>
    <!-- end phone -->
  </div>
  <!-- end row -->

  <div class="row">
    <!-- Contact person -->
    <div class="form-group col-md-4">
      <div class="col-md-12">
        <label class="control-label">Contact Person</label>
        <input type="text" class="form-control" name="contact_name" value="{!! isset($data->contact_name) ? $data->contact_name : old('contact_name') !!}" readonly="">
      </div>
    </div>
    <!-- end contact person -->
    <!-- Contact email -->
    <div class="form-group col-md-4">
      <div class="col-md-12">
        <label class="control-label">Email</label>
        <input type="text" class="form-control" name="contact_email" value="{!! isset($data->contact_email) ? $data->contact_email : old('contact_email') !!}" readonly="">
      </div>
    </div>
    <!-- end contact email -->
    <!-- Contact mobile -->
    <div class="form-group col-md-4">
      <div class="col-md-12">
        <label class="control-label">Mobile</label>
        <input type="text" class="form-control" name="mobile" value="{!! isset($data->mobile) ? $data->mobile : old('mobile') !!}" readonly="">
      </div>
    </div>
    <!-- end contact mobile -->
  </div>
</div>
<!-- end form body -->

<!-- notes / availabilities -->
<div class="row justify-content-center">
  <div class="col-8">
    <div class="tabbable-line">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_notes" data-toggle="tab"> Notes </a>
            </li>
        </ul>
        @if(Session::has('note-message'))
            <div class="alert alert-success">
                {{ Session::get('note-message') }}
            </div>
        @endif
        <div class="tab-content">
            <div class="tab-pane active pt-3" id="tab_notes">
                <div class="row justify-content-center">
                  <div class="col-8">
                    
                    <form action="{{ route('notes.store') }}" method="post">
                      <div class="input-group">
                        <textarea type="text" cols="30" class="form-control" placeholder="New note..." name="note"></textarea>
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $data->id }}" name="owner_id">
                        <input type="hidden" value="3" name="owner">
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
                      <div class="list-group-item">
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
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
      <a href="{{ route('customers.edit', ['id' => $data->id]) }}" class="btn btn-primary float-right">Edit</a>
      @if(Auth::guard('admin')->user()->role == 1)
      <a href="{{ route('customers.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
      @endif
  </div>
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
     
  });
</script>
@endpush

