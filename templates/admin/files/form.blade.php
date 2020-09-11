@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')
<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <h1>Model File</h1>
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

                    <form action="{{ isset($data) ? route('files.update', ['id' => $data->id]) : route('models.files.store', ['id' => $owner_id]) }}" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                        @if(isset($data))
                        <input type="hidden" value="PATCH" name="_method">
                        @endif
                        <div class="form-body">
                            {!! csrf_field() !!}
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">File Type</label>
                                        <select name="file_type_id" id="" required class="form-control">
                                            <option value="">Select File Type</option>
                                            @foreach($file_types as $d)
                                            <option value="{{ $d->id }}" {{ (isset($data) && $data->file_type_id == $d->id) ? 'selected':'' }}>{{ $d->name }}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" required value="{{ isset($data) ? $data->name : '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">File</label>
                                        <input type="file" name="file">
                                    </div>
                                </div> 
                            </div>


                        </div>
                        <!-- end form body -->

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                @if(isset($data) && Auth::guard('admin')->user()->role == 1)
                                <a href="{{ route('files.destroy', ['id' => $data->id]) }}" class="btn-delete btn btn-danger float-right">Delete</a>
                                @endif
                                <a href="{{ route('models.files.index', $owner_id) }}" class="btn btn-secondary float-right">Cancel</a>
                            </div>
                            
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection

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
                window.location.href = r.redirect;
              },
            });
          }
        },
      });
    });
  });
</script>
@endpush
